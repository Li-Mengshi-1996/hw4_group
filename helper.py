import socket
import random
from struct import *
import array


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


def parse_url(url):
    url = url.replace("http://", "")
    url = url.replace("https://", "")
    url_list = url.split("/")
    host = url_list[0]

    print(url_list)

    if url.endswith("/") or len(url_list) == 1 or url_list[1] == "":
        file = "index.html"
    else:
        file = url_list[len(url_list) - 1]

    path = url.replace(host, "")
    if path == "":
        path = "/"

    return host, file, path


def checksum(s):
    if len(s) & 1:
        s = s + b'\0'
    words = array.array('h', s)
    sum = 0
    for word in words:
        sum = sum + (word & 0xffff)
    hi = sum >> 16
    lo = sum & 0xffff
    sum = hi + lo
    sum = sum + (sum >> 16)
    return (~sum) & 0xffff


def check_tcp(data, source_ip, destination_ip):
    [src_port, dest_port, seq_num, ack_num, offset_res, tcp_flags, window] = unpack('!HHLLBBH', data[0:16])
    [checksum] = unpack('H', data[16:18])
    [urg_ptr] = unpack('!H', data[18:20])

    len_header = offset_res >> 4
    # self.fin = tcp_flags & 0x01
    # self.syn = (tcp_flags & 0x02) >> 1
    # self.rst = (tcp_flags & 0x04) >> 2
    # self.psh = (tcp_flags & 0x08) >> 3
    # self.ack = (tcp_flags & 0x16) >> 4
    # self.urg = (tcp_flags & 0x32) >> 5
    payload = data[len_header * 4:]
    # do the checksum
    # 1. set the pesudo header
    src_ip = socket.inet_aton(source_ip)
    dest_ip = socket.inet_aton(destination_ip)
    placeholder = 0
    protocol = socket.IPPROTO_TCP
    # tcp_length should be the length inside the header * 4 and plust the length of the data
    tcp_length = len_header * 4 + len(payload)

    pesudo_header = pack('!4s4sBBH', src_ip, dest_ip, placeholder, protocol, tcp_length)
    tcp_header_and_data = data[:16] + pack('H', 0) + data[18:]
    temp = pesudo_header + tcp_header_and_data
    new_checksum = checksum(temp)

    print("check")
    print(checksum == new_checksum)










    # tcp_source_port, tcp_dest_port, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags, tcp_window, tcp_check, tcp_urg_ptr \
    #     = unpack('!HHLLBBHHH', data[:20])
    # tcp_doff = tcp_offset_res >> 4
    #
    # payload = data[20:]
    #
    # saddr = socket.inet_aton(source_ip)
    # daddr = socket.inet_aton(destination_ip)
    #
    # # total_length = tcp_doff * 4 + len(payload)
    # #
    # # psh = pack('!4s4sBBH', saddr, daddr, 0, socket.IPPROTO_TCP, total_length)
    # #
    # # psh = psh + data[:16] + pack('H', 0) + data[18:]
    #
    # tcp_header = pack('!HHLLBBHHH', tcp_source_port, tcp_dest_port, tcp_seq, tcp_ack_seq, tcp_offset_res,
    #                   tcp_flags, tcp_window, 0, tcp_urg_ptr)
    #
    # tcp_length = len(tcp_header) + len(payload)
    #
    # psh = create_psh(source_ip, destination_ip, socket.IPPROTO_TCP, tcp_length)
    # psh = psh + tcp_header + payload
    #
    # we_check = check_sum(psh)
    #
    #
    #
    # print("check:")
    #
    # print(tcp_check & we_check)

# print(split_data_to_send("1234567891234567891234567891234",9,0))
# print(get_tcp_flags(ack=1))
