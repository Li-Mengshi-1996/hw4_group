# import socket, sys, time
# from struct import *
#
#
# # checksum functions needed for calculation checksum
# def checksum(msg):
#     s = 0
#
#     # loop taking 2 characters at a time
#     for i in range(0, len(msg), 2):
#         if i == len(msg)-1:
#             w = ord(msg[i])
#         else:
#             w = ord(msg[i]) + (ord(msg[i + 1]) << 8)
#         s = s + w
#
#     s = (s >> 16) + (s & 0xffff)
#     s = s + (s >> 16)
#
#     # complement and mask to 4 byte short
#     s = ~s & 0xffff
#
#     return s
#
# def get_local_ip():
#     s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
#     # google dns
#     s.connect(("8.8.8.8", 80))
#     ip = s.getsockname()[0]
#     s.close()
#     print(ip)
#     return ip
#
# # the main function
# def main():
#     # create a raw socket
#     try:
#         s = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_TCP)
#     except socket.error, msg:
#         print 'Socket could not be created. Error Code : ' + str(msg[0]) + ' Message ' + msg[1]
#         sys.exit()
#
#     # tell kernel not to put in headers, since we are providing it, when using IPPROTO_RAW this is not necessary
#     # s.setsockopt(socket.IPPROTO_IP, socket.IP_HDRINCL, 1)
#
#     # now start constructing the packet
#     packet = '';
#     host = "david.choffnes.com"
#     path = "/classes/cs4700sp22/project4.php"
#
#     source_ip = get_local_ip()
#     # dest_ip = '192.168.1.1'  # or socket.gethostbyname('www.google.com')
#     dest_ip = socket.gethostbyname(host)
#
#
#
#     # ip header fields
#     ip_ihl = 5
#     ip_ver = 4
#     ip_tos = 0
#     ip_tot_len = 0  # kernel will fill the correct total length
#     ip_id = 54321  # Id of this packet
#     ip_frag_off = 0
#     ip_ttl = 255
#     ip_proto = socket.IPPROTO_TCP
#     ip_check = 0  # kernel will fill the correct checksum
#     ip_saddr = socket.inet_aton(source_ip)  # Spoof the source ip address if you want to
#     ip_daddr = socket.inet_aton(dest_ip)
#
#     ip_ihl_ver = (ip_ver << 4) + ip_ihl
#
#     # the ! in the pack format string means network order
#     ip_header = pack('!BBHHHBBH4s4s', ip_ihl_ver, ip_tos, ip_tot_len, ip_id, ip_frag_off, ip_ttl, ip_proto, ip_check,
#                      ip_saddr, ip_daddr)
#
#     # tcp header fields
#     tcp_source = 1234  # source port
#     tcp_dest = 80  # destination port
#     tcp_seq = 454
#     tcp_ack_seq = 0
#     tcp_doff = 5  # 4 bit field, size of tcp header, 5 * 4 = 20 bytes
#     # tcp flags
#     tcp_fin = 0
#     tcp_syn = 1
#     tcp_rst = 0
#     tcp_psh = 0
#     tcp_ack = 0
#     tcp_urg = 0
#     tcp_window = socket.htons(5840)  # maximum allowed window size
#     tcp_check = 0
#     tcp_urg_ptr = 0
#
#     tcp_offset_res = (tcp_doff << 4) + 0
#     tcp_flags = tcp_fin + (tcp_syn << 1) + (tcp_rst << 2) + (tcp_psh << 3) + (tcp_ack << 4) + (tcp_urg << 5)
#
#     # the ! in the pack format string means network order
#     tcp_header = pack('!HHLLBBHHH', tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags, tcp_window,
#                       tcp_check, tcp_urg_ptr)
#
#
#     user_data = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
#
#     # pseudo header fields
#     source_address = socket.inet_aton(source_ip)
#     dest_address = socket.inet_aton(dest_ip)
#     placeholder = 0
#     protocol = socket.IPPROTO_TCP
#     tcp_length = len(tcp_header) + len(user_data)
#
#     psh = pack('!4s4sBBH', source_address, dest_address, placeholder, protocol, tcp_length);
#     psh = psh + tcp_header + user_data;
#
#     tcp_check = checksum(psh)
#     # print tcp_checksum
#
#     # make the tcp header again and fill the correct checksum - remember checksum is NOT in network byte order
#     tcp_header = pack('!HHLLBBH', tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags,
#                       tcp_window) + pack('H', tcp_check) + pack('!H', tcp_urg_ptr)
#
#     # final full packet - syn packets dont have any data
#     packet = ip_header + tcp_header + user_data
#
#     # increase count to send more packets
#     count = 1
#
#     s1 = socket.socket()
#     s1.connect((host, 80))
#
#     s1.send(user_data)
#     # print(s1.recv(1024))
#
#     s2 = socket.socket()
#     s2.connect((host, 80))
#
#     # print(s2.recv(1024))
#
#     r = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_TCP)
#
#     # s.connect((host, 80))
#
#     for i in range(count):
#         print 'sending packet...'
#         # Send the packet finally - the port specified has no effect
#         s.sendto(packet, (dest_ip ,0 ))  # put this in a loop if you want to flood the target
#         data = r.recv(1024)
#         print data
#         print 'send'
#         time.sleep(1)
#
#     print 'all packets send'
#
#
# main()

import re

# content = b'nt-Type: text/html; charset=UTF-8\r\n\r\n4000\r\n<!DOCTYPE html>\n<html lang="en">\n<head>\n<meta charset="utf-8">\n<title>'
# flag = re.search(rb'\r\n\r\n[0-9a-fA-F]\d*\r\n', content)
#
# if flag is not None:
#     left = flag.span()[0] + len(b"\r\n\r\n")
#     right = flag.span()[1]
#     content = content[0:left] + content[right:]
#
# print(content)

from helper import *

url = "https://david.choffnes.com/"
host, file_name, path = parse_url(url)

print(host)
print(file_name)
print(path)