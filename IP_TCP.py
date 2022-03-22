import socket
from struct import *
from helper import *


class IP_Info():
    def __init__(self, ip_unpack):
        self.source = socket.inet_ntoa(ip_unpack[8])
        self.destination = socket.inet_ntoa(ip_unpack[9])


class TCP_Info():
    def __init__(self, tcp_unpack):
        self.source = tcp_unpack[0]
        self.destination = tcp_unpack[1]

        self.seq = tcp_unpack[2]
        self.ack_seq = tcp_unpack[3]
        self.advertised_window = tcp_unpack[6]

        self.flag = tcp_unpack[5]


def extract_ip_header(data):
    ip_ihl_ver, ip_tos, ip_tot_len, ip_id, ip_frag_off, ip_ttl, ip_proto, ip_check, ip_saddr, ip_daddr = unpack(
        '!BBHHHBBH4s4s', data[0:20])
    source_ip = socket.inet_ntoa(ip_saddr)
    destination_ip = socket.inet_ntoa(ip_daddr)

    ip_ver = ip_ihl_ver >> 4
    ip_ihl = ip_ihl_ver & (1 << 5 - 1)

    result = (ip_id, source_ip, destination_ip, data[20:], ip_ihl, ip_ver, ip_tos, ip_tot_len, ip_frag_off,
              ip_ttl, ip_proto)

    result.ip_check = ip_check
    return result


class IPHeader:
    def __init__(self, ip_id, source_ip, destination_ip, payload, ip_ihl=5, ip_ver=4, ip_tos=0, ip_tot_len=0,
                 ip_frag_off=0, ip_ttl=255, ip_proto=socket.IPPROTO_TCP):
        self.ip_ihl = ip_ihl
        self.ip_ver = ip_ver
        self.ip_tos = ip_tos
        self.ip_tot_len = ip_tot_len

        self.ip_id = ip_id
        self.ip_frag_off = ip_frag_off
        self.ip_ttl = ip_ttl
        self.ip_proto = ip_proto
        self.ip_check = 0

        self.source_ip = source_ip
        self.destination_ip = destination_ip

        self.ip_saddr = socket.inet_aton(source_ip)
        self.ip_daddr = socket.inet_aton(destination_ip)

        self.payload = payload

    def print(self):
        print("source ip: " + str(self.source_ip))
        print("destination ip: " + str(self.destination_ip))

    def create_ip_header(self):
        ip_ihl_ver = (self.ip_ver << 4) + self.ip_ihl
        ip_header = pack('!BBHHHBBH4s4s', ip_ihl_ver, self.ip_tos, self.ip_tot_len, self.ip_id, self.ip_frag_off,
                         self.ip_ttl, self.ip_proto, self.ip_check, self.ip_saddr, self.ip_daddr)

        return ip_header + self.payload


def extract_tcp_header(data):
    tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags, tcp_window, tcp_check, tcp_urg_ptr \
        = unpack('!HHLLBBHHH', data[:20])
    tcp_doff = tcp_offset_res >> 4
    adwnd = socket.ntohs(tcp_window)
    payload = data[20:]
    result = TCPHeader(tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_flags, tcp_doff, adwnd, tcp_urg_ptr, payload)

    return result


class TCPHeader:
    def __init__(self, tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, flag, tcp_doff=5, adwnd=64240, tcp_urg_ptr=0,
                 payload=b''):
        self.tcp_source = tcp_source
        self.tcp_dest = tcp_dest

        self.tcp_seq = tcp_seq
        self.tcp_ack_seq = tcp_ack_seq

        self.tcp_doff = tcp_doff
        self.tcp_window = socket.htons(adwnd)
        self.tcp_check = 0
        self.tcp_urg_ptr = tcp_urg_ptr

        self.tcp_flags = flag

        self.payload = payload

    def print(self):
        print("source port: " + str(self.tcp_source))
        print("destination port: " + str(self.tcp_dest))
        print("sequence number: " + str(self.tcp_seq))
        print("ACK sequence number: " + str(self.tcp_ack_seq))
        print("Flag: " + str(self.tcp_flags))

    def create_tcp_header(self, source_ip, destination_ip):
        tcp_offset_res = (self.tcp_doff << 4) + 0
        tcp_check = 0

        user_data = self.payload

        tcp_header = pack('!HHLLBBHHH', self.tcp_source, self.tcp_dest, self.tcp_seq, self.tcp_ack_seq, tcp_offset_res,
                          self.tcp_flags, self.tcp_window, tcp_check, self.tcp_urg_ptr)

        tcp_length = len(tcp_header) + len(user_data)

        psh = create_psh(source_ip, destination_ip, socket.IPPROTO_TCP, tcp_length)
        psh = psh + tcp_header + user_data

        tcp_check = check_sum(psh)

        tcp_header = pack('!HHLLBBH', self.tcp_source, self.tcp_dest, self.tcp_seq, self.tcp_ack_seq, tcp_offset_res,
                          self.tcp_flags, self.tcp_window) + pack('H', tcp_check) + pack('!H', self.tcp_urg_ptr)

        return tcp_header + self.payload
