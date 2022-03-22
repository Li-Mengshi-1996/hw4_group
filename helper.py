import socket
import random
from struct import *


def get_tcp_flags(fin=0, syn=0, rst=0, psh=0, ack=0, urg=0):
    return fin + (syn << 1) + (rst << 2) + (psh << 3) + (ack << 4) + (urg << 5)


def get_source_address():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect(('8.8.8.8', 80))
    address = s.getsockname()
    s.close()
    # print(address)
    return address


def get_destination_address(host):
    return host, socket.gethostbyname(host)


def parse_url(url):
    url = url.replace("http://", "")
    url = url.replace("https://", "")
    url_list = url.split("/")
    host = url_list[0]

    if len(url_list) == 1 or url_list[1] == "":
        file = "index.html"
    else:
        file = url_list[len(url_list) - 1]

    path = url.replace(host, "")
    if path == "":
        path = "/"


    return host, file, path


def check_sum(msg):
    s = 0
    for i in range(0, len(msg), 2):
        w = msg[i] + (msg[i + 1] << 8)
        s = s + w

    s = (s >> 16) + (s & 0xffff)
    s = s + (s >> 16)

    s = ~s & 0xffff
    return s


def get_ip_header(source_ip, destination_ip):
    ip_ihl = 5
    ip_ver = 4
    ip_tos = 0
    ip_tot_len = 0

    ip_id = random.randint(10000, 40000)
    ip_frag_off = 0
    ip_ttl = 255
    ip_proto = socket.IPPROTO_TCP
    ip_check = 0
    ip_saddr = socket.inet_aton(source_ip)
    ip_daddr = socket.inet_aton(destination_ip)

    ip_ihl_ver = (ip_ver << 4) + ip_ihl

    ip_header = pack('!BBHHHBBH4s4s', ip_ihl_ver, ip_tos, ip_tot_len,
                     ip_id, ip_frag_off, ip_ttl, ip_proto, ip_check, ip_saddr, ip_daddr)

    return ip_header


def get_tcp_header(user_data, tcp_flags, source_port, destination_port, tcp_seq_no, tcp_ack_no, advertised_window,
                   source_ip, destination_ip):
    tcp_source = source_port
    tcp_dest = destination_port

    tcp_seq = tcp_seq_no
    tcp_ack_seq = tcp_ack_no

    tcp_doff = 5
    tcp_window = socket.htons(advertised_window)
    tcp_check = 0
    tcp_urg_ptr = 0

    tcp_offset_res = (tcp_doff << 4) + 0

    tcp_header = pack('!HHLLBBHHH', tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags,
                      tcp_window, tcp_check, tcp_urg_ptr)

    source_address = socket.inet_aton(source_ip)
    dest_address = socket.inet_aton(destination_ip)

    placeholder = 0
    protocol = socket.IPPROTO_TCP
    tcp_length = len(tcp_header) + len(user_data)

    psh = pack('!4s4sBBH', source_address, dest_address, placeholder, protocol, tcp_length)
    psh = psh + tcp_header + user_data.encode()

    tcp_check = check_sum(psh)
    tcp_header = pack('!HHLLBBH', tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags,
                      tcp_window) + pack('H', tcp_check) + pack('!H', tcp_urg_ptr)

    return tcp_header

print(get_tcp_flags(rst=1))