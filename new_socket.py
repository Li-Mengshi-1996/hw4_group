import sys
import socket
from struct import *
from helper import *
import time
from random import randint
from IP_TCP import *
import re


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
            self.buff_size = 65535
            self.packet_id = 0
            self.suppose_to_send = dict()
            self.recv_dict = dict()

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
            end = min(pointer + self.cwnd, len(data))
            piece = data[pointer: end]

            payload = piece.encode('ascii')

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
            pointer = end
            self.tcp_seq = tcp_data.tcp_ack_seq
            self.cwnd = min(1000, self.cwnd * 2)

    def _send(self, data, flag):
        payload = data.encode('ascii')
        tcp_data = TCPHeader(self.source_port, self.destination_port, self.tcp_seq, self.tcp_ack, flag, payload=payload)
        ip_tcp_data = IPHeader(self.packet_id, self.source_ip, self.destination_ip,
                               tcp_data.create_tcp_header(self.source_ip, self.destination_ip))
        self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))

        if flag == get_tcp_flags(ack=1):
            print("\n\n\n")
            print("This is local send ACK")
            tcp_data.print()
            print("-------------------")
            ip_tcp_data.print()
            print("-------------------")
        elif flag == get_tcp_flags(syn=1):
            print("\n\n\n")
            print("This is local send SYN")
            tcp_data.print()
            print("-------------------")
            ip_tcp_data.print()
            print("-------------------")

    # def _recv_ack(self):

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
                # print("ip data: ")
                # ip_tcp_data.print()
                # print("----------")
                print("success")
                # print(data)
                return ip_tcp_data.payload
        except:

            return None

    def _recv(self, delay=60):
        tcp_data = self._recv_ip_tcp_data(delay=delay)
        if tcp_data is None:
            self.cwnd = 1
            print("Time Out.")
            return None
        # psh = get_pseudo_ip_header(self.destination_ip, self.source_ip, len(tcp_data))

        if not check_tcp(tcp_data, self.source_ip, self.destination_ip):
            # self._send("", get_tcp_flags(ack=1))
            result = extract_tcp_header(tcp_data)
            result.tcp_flags = -1
            return result

        # print("check: " + str(calculate_checksum(psh + tcp_data)))

        # if check_sum(psh) != 0:
        #     print("TCP checksum error")
        #     return None

        return extract_tcp_header(tcp_data)

    def receive(self):
        print("receive")

        while True:
            tcp_data = self._recv(delay=180)
            if tcp_data is None:
                print("Connection lost.")
                sys.exit(1)

            if tcp_data.tcp_flags == -1:
                self._send("", get_tcp_flags(ack=1))
                print("retry")
                continue

            # tcp_offset_res = (tcp_data.tcp_doff << 4) + 0
            #
            # tcp_header = pack('!HHLLBBHHH', tcp_data.tcp_source, tcp_data.tcp_dest, tcp_data.tcp_seq,
            #                   tcp_data.tcp_ack_seq, tcp_offset_res,
            #                   tcp_data.tcp_flags, tcp_data.tcp_window, tcp_data.tcp_check, tcp_data.tcp_urg_ptr)
            #
            # tcp_length = len(tcp_header) + len(tcp_data.payload)
            #
            # psh = create_psh(self.destination_ip, self.source_ip, socket.IPPROTO_TCP, tcp_length)
            # psh = psh + tcp_header + tcp_data.payload
            #
            # # psh = create_psh(self.source_ip, self.destination_ip, socket.IPPROTO_TCP, len(tcp_data))
            # print("check sum check")
            # print(check_sum(psh))
            # check = check_tcp_checksum(tcp_data, self.destination_ip, self.source_ip)
            # if check != 0:
            #     self.cwnd = 1
            #     self._send("", get_tcp_flags(ack=1))
            #     continue

            if tcp_data.tcp_flags & get_tcp_flags(fin=1):
                self.tcp_seq = tcp_data.tcp_ack_seq
                self.tcp_ack = tcp_data.tcp_seq + 1
                self._send("", get_tcp_flags(fin=1, ack=1))
                if len(tcp_data.payload) != 0:
                    self.recv_dict[tcp_data.tcp_seq] = tcp_data.payload
                # tcp_data.print()
                print(tcp_data.payload)
                break
            if tcp_data.tcp_flags & get_tcp_flags(ack=1) and tcp_data.payload:
                if tcp_data.tcp_seq == self.tcp_ack:
                    # tcp_data.print()
                    print(tcp_data.payload)
                    self.cwnd = min(1000, self.cwnd * 2)
                    self.recv_dict[tcp_data.tcp_seq] = tcp_data.payload
                    self.tcp_seq = tcp_data.tcp_ack_seq
                    self.tcp_ack = self.tcp_ack + len(tcp_data.payload)
                    self._send("", get_tcp_flags(ack=1))
                else:
                    self.cwnd = 1
                    self._send("", get_tcp_flags(ack=1))

            # tcp_data.print()
            # print(tcp_data.payload)
            # print("packet length: " + str(len(tcp_data.payload)))
            # before_ack = self.tcp_ack
            # print("ACK before update: " + str(before_ack))
            # self.tcp_seq = tcp_data.tcp_ack_seq
            # # self.tcp_ack = tcp_data.tcp_seq + 1
            # self.tcp_ack = self.tcp_ack + len(tcp_data.payload)
            #
            # after_ack = self.tcp_ack
            # print("ACK after update: " + str(after_ack))
            # print("ACK change: " + str(after_ack - before_ack))
            # self._send('', get_tcp_flags(ack=1))
            # if tcp_data.tcp_flags & get_tcp_flags(fin=1):
            #     break
            # self.recv_dict[tcp_data.tcp_seq] = tcp_data.payload

        tuple_list = []

        for seq in self.recv_dict.keys():
            tuple_list.append((seq, self.recv_dict[seq]))

        sorted_list = sorted(tuple_list, key=lambda t: t[0])

        result = b""

        for item in sorted_list:
            result += item[1]

        self.recv_dict.clear()
        return result

    def teardown(self):
        self._send("", get_tcp_flags(fin=1, ack=1))
        tcp_data = self._recv()
        if tcp_data is None or tcp_data.tcp_flags & get_tcp_flags(ack=1) == 0:
            print("Teardown fails.")
            return False
        self.tcp_seq = tcp_data.tcp_ack_seq
        self.tcp_ack = tcp_data.tcp_seq + 1
        if tcp_data.tcp_flags & get_tcp_flags(fin=1):
            self._send("", get_tcp_flags(ack=1))

        return True

    def close(self):
        if self.teardown():
            self.recv_socket.close()
            self.send_socket.close()
        else:
            print("Teardown fails. Please try again.")


#
#
#
def main():
    # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
    # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/2MB.log")
    # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/10MB.log")
    host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/50MB.log")
    # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/")
    # print(file_name)
    # return
    t = RawSocket()
    t.connect(host)

    #
    request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'

    t.send(request)
    content = t.receive()

    print(content[0:200])

    if not content.startswith(b"HTTP/1.1 200 OK"):
        print("Non-200 status code")
        sys.exit()

    left = content.find(b'4000\r\n')
    right = left + len(b'4000\r\n')

    if left != -1:
        content = content[0:left] + content[right:]

    content = re.sub(rb'\r\n0\r\n\r\n', b"", content)

    # content = re.sub(rb'\r\n[0-9]\d*\r\n', b"", content)
    #
    # content = re.sub(rb'\r\n4f\w\r\n', b"", content)

    temp = content.split(b"\r\n")
    diff = len(b"\r\n")

    result = b""

    for item in temp:
        try:
            in_ten = int(item, 16)
            result = result[0:len(result) - diff]
            print("find garbage")
        except:
            result = result + item + b"\r\n"

    content = result[0:len(result) - diff]

    parse = content.find(b"\r\n\r\n")
    content = content[parse + len(b"\r\n\r\n"):]

    t.close()

    with open(file_name, 'wb') as file:
        file.write(content)


main()
