import sys
import socket
from struct import *
from helper import *
import time
from random import randint
from IP_TCP import *


class RawSocket:
    def __init__(self):
        try:
            self.send_socket = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_RAW)
            self.recv_socket = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_TCP)
            self.source_address = get_source_address()
            self.source_ip = self.source_address[0]
            self.source_port = self.source_address[1]
            self.destination_host = ""
            self.destination_ip = ""
            self.destination_port = 80

            self.tcp_seq = randint(0, int(pow(2, 31)) - 1)
            self.tcp_ack = 0
            self.cwnd = 1
            self.slow_start = True
            self.segment_size = 1000
            self.adwnd = 5840

            self.buffer = ""

            self.test = ""
            self.buff_size = 10240
            self.packet_id = 0

        except:
            print("ERROR when creating sockets.")
            sys.exit()

    def connect(self, host):
        self.destination_host, self.destination_ip = get_destination_address(host)
        self._send("", get_tcp_flags(syn=1))

        print("\n\n\n\n\n")
        print("After send:")

        tcp_data = self._recv()
        if tcp_data is None or tcp_data.tcp_flags != get_tcp_flags(syn=1, ack=1):
            print("Fail to connect")
            sys.exit()

        tcp_data.print()




    def _send(self, data, flag):
        payload = data.encode()
        tcp_data = TCPHeader(self.source_port, self.destination_port, self.tcp_seq, self.tcp_ack, flag, payload=payload)
        ip_tcp_data = IPHeader(self.packet_id, self.source_ip, self.destination_ip,
                               tcp_data.create_tcp_header(self.source_ip, self.destination_ip))
        self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))

        tcp_data.print()
        print("-------------------")
        ip_tcp_data.print()
        print("-------------------")

    def _recv_ip_tcp_data(self, delay=60):
        self.recv_socket.settimeout(delay)
        try:
            while True:

                data = self.recv_socket.recv(self.buff_size)
                ip_header_data = data[0:20]
                ip_tcp_data = extract_ip_header(data)

                if ip_tcp_data.source_ip != self.destination_ip or ip_tcp_data.destination_ip != self.source_ip:
                    continue
                if check_sum(ip_header_data) != 0:
                    print("IP checksum error")
                    continue
                ip_tcp_data.print()
                print("----------")
                return ip_tcp_data.payload
        except:
            print("ERROR")
            return None

    def _recv(self, delay=60):
        tcp_data = self._recv_ip_tcp_data(delay=delay)
        if tcp_data is None:
            return None
        psh = create_psh(self.source_ip, self.destination_ip, socket.IPPROTO_TCP, len(tcp_data))

        if check_sum(psh) != 0:
            print("TCP checksum error")
            return None

        return extract_tcp_header(tcp_data)


def main():
    host, file, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
    t = RawSocket()
    t.connect(host)

    t._send('', get_tcp_flags(syn=1))
    #
    # t.connect(host)
    #
    # request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
    # t.send(request)
    # t.receive()
    #
    # print("local ip: " + t.source_ip)
    # print("local port: " + str(t.source_port))
    #
    # print("remote ip: " + t.destination_ip)
    # print("remote port: " + str(t.destination_port))

    # s = socket.socket()
    # s.connect((host, 80))
    # s.send(t.test.encode())
    # print(s.recv(1024))


main()