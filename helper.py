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


def create_psh(source_ip, destination_ip, protocol, tcp_length):
    source_address = socket.inet_aton(source_ip)
    dest_address = socket.inet_aton(destination_ip)
    placeholder = 0

    psh = pack('!4s4sBBH', source_address, dest_address, placeholder, protocol, tcp_length)
    return psh


def check_sum(msg):
    s = 0
    if len(msg) % 2 != 0:
        msg += b'\0'
    for i in range(0, len(msg), 2):
        w = msg[i] + (msg[i + 1] << 8)
        s = s + w

    s = (s >> 16) + (s & 0xffff)
    s = s + (s >> 16)

    s = ~s & 0xffff
    return s


def split_data_to_send(data, segment_size, tcp_seq):
    start = 0
    temp = []
    result = []
    current_seq = tcp_seq

    while start < len(data):
        end = min(start + segment_size, len(data))
        temp.append(data[start:end])
        start = end

    for data_piece in temp:
        result.append((current_seq, data_piece))
        current_seq += len(data_piece)

    print(result)
    return result


def check_tcp_checksum(tcp_data, destination_ip, source_ip):
    tcp_offset_res = (tcp_data.tcp_doff << 4) + 0

    tcp_header = pack('!HHLLBBHHH', tcp_data.tcp_source, tcp_data.tcp_dest, tcp_data.tcp_seq,
                      tcp_data.tcp_ack_seq, tcp_offset_res,
                      tcp_data.tcp_flags, tcp_data.tcp_window, tcp_data.tcp_check, tcp_data.tcp_urg_ptr)

    tcp_length = len(tcp_header) + len(tcp_data.payload)

    psh = create_psh(destination_ip, source_ip, socket.IPPROTO_TCP, tcp_length)
    psh = psh + tcp_header + tcp_data.payload

    print("check sum check")
    result = check_sum(psh)
    print(check_sum(psh))

    return result


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

# print(split_data_to_send("1234567891234567891234567891234",9,0))
# print(get_tcp_flags(ack=1))
