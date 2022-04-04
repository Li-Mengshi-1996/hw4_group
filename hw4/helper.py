import socket
from struct import *
import array


def get_tcp_flags(fin=0, syn=0, rst=0, psh=0, ack=0, urg=0):
    """
    Generate tcp flags.
    :param fin: whether there is a FIN flag, 1 for yes, 0 for no
    :param syn: whether there is an SYN flag, 1 for yes, 0 for no
    :param rst: whether there is a RST flag, 1 for yes, 0 for no
    :param psh: whether there is a PSH flag, 1 for yes, 0 for no
    :param ack: whether there is an ACK flag, 1 for yes, 0 for no
    :param urg: whether there is a URG flag, 1 for yes, 0 for no
    :return: tcp flag
    """
    return fin + (syn << 1) + (rst << 2) + (psh << 3) + (ack << 4) + (urg << 5)


def get_source_address():
    """
    Get local ip address and an available port.
    :return: a tuple (ip_address, port)
    """
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect(('8.8.8.8', 80))
    address = s.getsockname()
    s.close()
    return address


def create_psh(source_ip, destination_ip, protocol, tcp_length):
    """
    Create a pseudo header.
    :param source_ip: the source ip of the header
    :param destination_ip: the destination ip of the header
    :param protocol: IP protocol this header use.
    :param tcp_length: the length of tcp header and the data.
    :return: a pseudo header
    """
    source_address = socket.inet_aton(source_ip)
    dest_address = socket.inet_aton(destination_ip)
    placeholder = 0

    psh = pack('!4s4sBBH', source_address, dest_address, placeholder, protocol, tcp_length)
    return psh


def check_sum(msg):
    """
    Calculate the checksum of msg.
    :param msg: data to be calculated checksum
    :return: the checksum of msg
    """
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


def parse_url(url):
    """
    Parse the url and get the host and path of the url and get the file name to save data.
    :param url: the url to be parsed
    :return: the host and path of the url and get the file name to save data
    """
    url = url.replace("http://", "")
    url = url.replace("https://", "")
    url_list = url.split("/")
    host = url_list[0]

    if url.endswith("/") or len(url_list) == 1 or url_list[1] == "":
        file = "index.html"
    else:
        file = url_list[len(url_list) - 1]

    path = url.replace(host, "")
    if path == "":
        path = "/"

    return host, file, path


def check_tcp(data, source_ip, destination_ip):
    """
    Calculate the tcp checksum when we get data.
    :param data: data we get
    :param source_ip: the source ip address
    :param destination_ip: the destination ip
    :return: whether the checksum we calculate is the same as the checksum the data has
    """

    # Parse the TCP header
    [tcp_source_port, tcp_destination_port, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags, tcp_window] = unpack(
        '!HHLLBBH', data[0:16])
    [tcp_check] = unpack('H', data[16:18])

    # Based on the info we get from TCP header, generate info we need.
    tcp_doff = tcp_offset_res >> 4
    payload = data[tcp_doff * 4:]
    saddr = socket.inet_aton(source_ip)
    daddr = socket.inet_aton(destination_ip)
    placeholder = 0
    protocol = socket.IPPROTO_TCP
    tcp_length = tcp_doff * 4 + len(payload)

    # Create pseudo header.
    psh = pack('!4s4sBBH', saddr, daddr, placeholder, protocol, tcp_length)
    tcp_data = data[:16] + pack('H', 0) + data[18:]
    msg = psh + tcp_data

    # Calculate the checksum.
    if len(msg) & 1:
        msg = msg + b'\0'
    infos = array.array('h', msg)

    s = 0
    for info in infos:
        s = s + (info & 0xffff)

    s = (s >> 16) + (s & 0xffff)
    s = s + (s >> 16)

    cal_checksum = (~s) & 0xffff

    return tcp_check == cal_checksum
