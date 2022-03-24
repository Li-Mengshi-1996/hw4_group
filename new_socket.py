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
            self.segment_size = 10
            self.adwnd = 5840

            self.buffer = ""

            self.test = ""
            self.buff_size = 10240
            self.packet_id = 0
            self.suppose_to_send = dict()

        except:
            print("ERROR when creating sockets.")
            sys.exit()

    def connect(self, host, port=80):
        self.destination_port = port
        self.destination_host = host
        self.destination_ip = socket.gethostbyname(host)
        self._send("", get_tcp_flags(syn=1))

        # print("\n\n\n\n\n")
        # print("After send:")

        tcp_data = self._recv()
        if tcp_data is None or tcp_data.tcp_flags != get_tcp_flags(syn=1, ack=1):
            print("Fail to connect")
            sys.exit()

        print("After send SYN to server, I get:")
        tcp_data.print()

        self.tcp_seq = tcp_data.tcp_ack_seq
        self.tcp_ack = tcp_data.tcp_seq + 1

        self._send('', get_tcp_flags(ack=1))

        print("connected")

    def send(self, data):
        flag = get_tcp_flags(psh=1, ack=1)
        data_pieces = split_data_to_send(data, self.segment_size, self.tcp_seq)

        # p = data.encode()
        # tcp_data = TCPHeader(self.source_port, self.destination_port, 1, self.tcp_ack, flag, payload=p)
        # print("this is fake data")
        # tcp_data.print()
        # ip_tcp_data = IPHeader(self.packet_id, self.source_ip, self.destination_ip,
        #                        tcp_data.create_tcp_header(self.source_ip, self.destination_ip))
        # self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))
        # self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))
        # self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))

        # while len(data_pieces) != 0:
        #     seq_no, split_data = data_pieces.pop(0)
        #     payload = split_data.encode()
        #     tcp_data = TCPHeader(self.source_port, self.destination_port,seq_no, self.tcp_ack,flag, payload=payload)
        #     print("\nthis is actual data")
        #     tcp_data.print()
        #
        #     ip_tcp_data = IPHeader(self.packet_id, self.source_ip, self.destination_ip,
        #                            tcp_data.create_tcp_header(self.source_ip, self.destination_ip))
        #     self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))
        # print("sending data:")
        # print(split_data)

        pointer = 0

        while pointer < len(data):
            piece = data[pointer: pointer + self.cwnd]

            payload = piece.encode()

            tcp_data = TCPHeader(self.source_port, self.destination_port, self.tcp_seq, self.tcp_ack, flag,
                                 payload=payload)
            ip_tcp_data = IPHeader(self.packet_id, self.source_ip, self.destination_ip,
                                   tcp_data.create_tcp_header(self.source_ip, self.destination_ip))
            self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))

            tcp_data = self._recv()

            if tcp_data is None:
                print("No ack receive")
                self.cwnd = 1
                continue
            pointer = pointer + self.cwnd
            self.tcp_seq = tcp_data.tcp_ack_seq
            self.cwnd = min(1000, self.cwnd * 2)


    def _send(self, data, flag):
        payload = data.encode()
        tcp_data = TCPHeader(self.source_port, self.destination_port, self.tcp_seq, self.tcp_ack, flag, payload=payload)
        ip_tcp_data = IPHeader(self.packet_id, self.source_ip, self.destination_ip,
                               tcp_data.create_tcp_header(self.source_ip, self.destination_ip))
        self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))

        # if flag == get_tcp_flags(ack=1):
        #     print("\n\n\n")
        #     print("This is local send ACK")
        #     tcp_data.print()
        #     print("-------------------")
        #     ip_tcp_data.print()
        #     print("-------------------")
        # elif flag == get_tcp_flags(syn=1):
        #     print("\n\n\n")
        #     print("This is local send SYN")
        #     tcp_data.print()
        #     print("-------------------")
        #     ip_tcp_data.print()
        #     print("-------------------")

    # def _recv_ack(self):

    def _recv_ip_tcp_data(self, delay=60):
        self.recv_socket.settimeout(delay)
        try:
            while True:

                data = self.recv_socket.recv(self.buff_size)
                ip_header_data = data[0:20]
                ip_tcp_data = extract_ip_header(data)
                print("success")

                if ip_tcp_data.source_ip != self.destination_ip or ip_tcp_data.destination_ip != self.source_ip:
                    continue
                if check_sum(ip_header_data) != 0:
                    print("IP checksum error")
                    continue
                # print("ip data: ")
                # ip_tcp_data.print()
                # print("----------")
                return ip_tcp_data.payload
        except:
            self.cwnd = 1
            print("ERROR")
            return None

    def _recv(self, delay=60):
        tcp_data = self._recv_ip_tcp_data(delay=delay)
        if tcp_data is None:
            return None
        psh = create_psh(self.source_ip, self.destination_ip, socket.IPPROTO_TCP, len(tcp_data))
        # print("check sum check")
        # print(check_sum(psh))

        # if check_sum(psh) != 0:
        #     print("TCP checksum error")
        #     return None

        return extract_tcp_header(tcp_data)

    def receive(self):
        print("receive")

        for i in range(0, 15):
            tcp_data = self._recv()
            tcp_data.print()
            print(tcp_data.payload)

        # print(tcp_data.payload)

        # tcp_data = self._recv()
        # tcp_data.print()
        # # print(tcp_data.payload)
        #
        # tcp_data = self._recv()
        # tcp_data.print()
        # # print(tcp_data.payload)
        #
        # tcp_data = self._recv()
        # tcp_data.print()
        # # print(tcp_data.payload)
        #
        # tcp_data = self._recv()
        # tcp_data.print()
        # # print(tcp_data.payload)
        #
        # tcp_data = self._recv()
        # tcp_data.print()
        # # print(tcp_data.payload)
        #
        # tcp_data = self._recv()
        # tcp_data.print()
        # # print(tcp_data.payload)
        #
        # tcp_data = self._recv()
        # tcp_data.print()
        # # print(tcp_data.payload)


def main():
    host, file, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
    t = RawSocket()
    t.connect(host)

    #
    request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
    t.send(request)
    t.receive()
    # print("request")
    # print(len(request))
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
