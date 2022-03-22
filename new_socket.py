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

        except:
            print("ERROR when creating sockets.")
            sys.exit()

    def get_ip_header(self):
        ip_ihl = 5
        ip_ver = 4
        ip_tos = 0
        ip_tot_len = 0

        ip_id = random.randint(0, 40000)
        ip_frag_off = 0
        ip_ttl = 255
        ip_proto = socket.IPPROTO_TCP
        ip_check = 0
        ip_saddr = socket.inet_aton(self.source_ip)
        ip_daddr = socket.inet_aton(self.destination_ip)

        ip_ihl_ver = (ip_ver << 4) + ip_ihl

        ip_header = pack('!BBHHHBBH4s4s', ip_ihl_ver, ip_tos, ip_tot_len,
                         ip_id, ip_frag_off, ip_ttl, ip_proto, ip_check, ip_saddr, ip_daddr)

        return ip_header

    def get_tcp_header(self, user_data, flag):
        tcp_source = self.source_port
        tcp_dest = self.destination_port

        tcp_seq = self.tcp_seq
        tcp_ack_seq = self.tcp_ack

        tcp_doff = 5
        tcp_window = socket.htons(self.adwnd)
        tcp_check = 0
        tcp_urg_ptr = 0

        tcp_offset_res = (tcp_doff << 4) + 0
        tcp_flags = flag

        tcp_header = pack('!HHLLBBHHH', tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags,
                          tcp_window, tcp_check, tcp_urg_ptr)

        source_address = socket.inet_aton(self.source_ip)
        dest_address = socket.inet_aton(self.destination_ip)

        placeholder = 0
        protocol = socket.IPPROTO_TCP
        if len(user_data) % 2 != 0:
            user_data += " "

        tcp_length = len(tcp_header) + len(user_data)
        psh = pack('!4s4sBBH', source_address, dest_address, placeholder, protocol, tcp_length)
        psh = psh + tcp_header + user_data.encode()

        tcp_check = check_sum(psh)
        tcp_header = pack('!HHLLBBH', tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags,
                          tcp_window) + pack('H', tcp_check) + pack('!H', tcp_urg_ptr)

        return tcp_header

    def _send(self, data, flag):
        self.buffer = data
        current_index = 0
        if not data:
            packet = self.get_ip_header() + self.get_tcp_header(data, flag)
            self.send_socket.sendto(packet, (self.destination_ip, self.destination_port))
            return

        start = 0
        print(data)
        check = ""

        while len(data) - start > self.cwnd * self.segment_size:
            end = start + self.cwnd * self.segment_size
            part = data[start:end]
            packet = self.get_ip_header() + self.get_tcp_header(data, flag)
            self.send_socket.sendto(packet, (self.destination_ip, self.destination_port))
            start = end
            check += part

        final_part = data[start:]
        packet = self.get_ip_header() + self.get_tcp_header(data, flag)
        self.send_socket.sendto(packet, (self.destination_ip, self.destination_port))
        check += final_part
        print("finish")
        self.test = check

    def send(self, data):
        self._send(data, get_tcp_flags(psh=1, ack=1))

    def connect(self, host):
        self.destination_host, self.destination_ip = get_destination_address(host)
        self._send(data='', flag=get_tcp_flags(syn=1))
        if self._recv_ack(change=1):
            self._send(data='', flag=get_tcp_flags(ack=1))
            print("connected")
        else:
            print("Fail to connect")
            self.send_socket.close()
            self.recv_socket.close()
            sys.exit()

    def _recv_ack(self, change):
        start_time = time.time()
        while time.time() - start_time < 60:
            tcp, payload = self._receive()

            if tcp is None:
                break

            if tcp.flag & get_tcp_flags(ack=1) and tcp.ack_seq == self.tcp_seq + change:
                self.tcp_seq = tcp.ack_seq
                self.tcp_ack = tcp.seq + change
                return True

        return False

    def _receive(self):
        delay = 60
        self.recv_socket.settimeout(delay)
        try:
            data = self.recv_socket.recv(self.buff_size)
            while True:
                ip_info = data[0:20]

                ip_unpack = unpack("!BBHHHBBH4s4s", ip_info)

                ip = IP_Info(ip_unpack)

                if ip.destination != self.source_ip or ip.source != self.destination_ip:
                    continue

                tcp_info = data[20:40]
                tcp_unpack = unpack('!HHLLBBHHH', tcp_info)

                tcp = TCP_Info(tcp_unpack)

                if tcp.destination != self.source_port or tcp.source != self.destination_port:
                    continue

                payload = data[40:]

                return tcp, payload

        except:
            print("time out, congestion")
            return None, None

    def receive(self):
        while True:
            tcp, payload = self._receive()
            print(payload)

            if tcp is None:
                print("Time out")
                sys.exit()

            if tcp.flag & get_tcp_flags(fin=1):
                self.tcp_seq = tcp.ack_seq
                self.tcp_ack = tcp.seq + 1
                break


def main():
    host, file, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
    t = RawSocket()

    t.connect(host)

    request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
    t.send(request)
    t.receive()

    print("local ip: " + t.source_ip)
    print("local port: " + str(t.source_port))

    print("remote ip: " + t.destination_ip)
    print("remote port: " + str(t.destination_port))

    # s = socket.socket()
    # s.connect((host, 80))
    # s.send(t.test.encode())
    # print(s.recv(1024))


main()
