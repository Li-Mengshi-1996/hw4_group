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

def get_pseudo_ip_header(source_ip, dest_ip, tcp_length):
    source_address = socket.inet_aton(source_ip)
    dest_address = socket.inet_aton(dest_ip)
    protocol = socket.IPPROTO_TCP
    pseudo_ip_header = pack('!4s4sHH', source_address,
                            dest_address, protocol, tcp_length)
    return pseudo_ip_header

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


def calculate_checksum(packet):
    cks = 0
    if len(packet) % 2 != 0:
        packet += b'\0'
    for i in range(0, len(packet), 2):
        w = (packet[i] << 8) + (packet[i+1])
        cks += w

    cks = (cks >> 16) + (cks & 0xffff)
    cks = ~cks & 0xffff

    return cks


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

def parse_response(response):
    status_line, response = response.split(b'\r\n', 1)
    status_line = status_line.decode('ascii')
    version, code, reason_phrase = status_line.split(" ", 2)
    headers, content = response.split(b'\r\n\r\n', 1)
    headers = headers.decode('ascii')
    cookies = dict()
    parsed_headers = dict()
    for h in headers.split('\r\n'):
        key, value = h.split(': ', 1)
        if key == 'Set-Cookie':
            c = value.split("; ", 1)[0]
            cookie_key, cookie_value = c.split("=", 1)
            cookies[cookie_key] = cookie_value
        else:
            parsed_headers[key] = value
    return code, reason_phrase, content, cookies, parsed_headers

# print(split_data_to_send("1234567891234567891234567891234",9,0))
# print(get_tcp_flags(ack=1))
