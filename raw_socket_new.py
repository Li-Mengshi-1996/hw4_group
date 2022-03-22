import socket
import random
import struct
import sys
from IP_TCP import *
import time
from helper import *


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
            self.destination_path = ""

            self.outtput_file = ""
            self.recv_size = 65536

            self.tcp_seq_no = random.randint(0, int(pow(2, 31) - 1))
            self.tcp_ack_no = 0

            self.send_payload = dict()
            self_non_acked_payload = dict()
            self.cwnd = 1
            self.advertised_window = 5840

        except:
            print("ERROR when creating sockets.")
            sys.exit()

    def connect(self, url):
        self.destination_host, self.outtput_file, self.destination_ip, self.destination_path = get_destination_address(
            url)
        # send SYN first
        SYN = get_tcp_flags(syn=1)
        self._send('', SYN)
        tcp, payload = self._receive()

        if tcp is None or tcp.flag != get_tcp_flags(syn=1, ack=1):
            print("Fail to connect")
            sys.exit()

        self.tcp_seq_no = tcp.seq
        self.tcp_ack_no = tcp.ack_seq
        self._send("", get_tcp_flags(ack=1))

        print("connected")

    def _send(self, data, tcp_flag):
        # First send SYN
        if len(data) == 0:
            packet = get_ip_header(self.source_ip, self.destination_ip) \
                     + get_tcp_header(data, tcp_flag, self.source_port, self.destination_port, self.tcp_seq_no,
                                      self.tcp_ack_no, self.advertised_window, self.source_ip, self.destination_ip) \
                     + data.encode()
            self.send_socket.sendto(packet, (self.destination_ip, self.destination_port))
            return

    def _receive(self):
        delay = 60
        self.recv_socket.settimeout(delay)

        try:
            while True:
                data = self.recv_socket.recv(self.recv_size)

                ip_info = data[0:20]

                ip_unpack = struct.unpack("!BBHHHBBH4s4s", ip_info)

                ip = IP_Info(ip_unpack)

                if ip.destination != self.source_ip or ip.source != self.destination_ip:
                    continue

                tcp_info = data[20:40]
                tcp_unpack = struct.unpack('!HHLLBBHHH', tcp_info)

                tcp = TCP_Info(tcp_unpack)

                if tcp.destination != self.source_port or tcp.source != self.destination_port:
                    continue

                payload = data[40:]

                return tcp, payload
        except:
            print("Receive time out.")
            return None, None

def main():
    t = RawSocket()
    t.connect("http://david.choffnes.com/classes/cs4700sp22/project4.php")

main()