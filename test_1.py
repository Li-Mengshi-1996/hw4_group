import socket
# from helper import *
#
# host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
# request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
# s = socket.socket()
# s.connect((host, 80))
# s.send(request.encode())
# content = ""
# while True:
#     content += s.recv(65536).decode()
#
#     if content.find("/html>") != -1:
#         break
#
# with open("test.php", 'w') as file:
#     file.write(content)


# def split_data_to_send(data, segment_size, tcp_seq):
#     start = 0
#     temp = []
#     result = []
#     current_seq = tcp_seq
#
#     while start < len(data):
#         end = min(start + segment_size, len(data))
#         temp.append(data[start:end])
#         start = end
#
#     for data_piece in temp:
#         result.append((current_seq, data_piece))
#         current_seq += len(data_piece)
#
#     print(result)
#     return result

# def tcp_checksum(msg):
#     if len(msg) & 1:
#         msg = msg + b'\0'
#     infos = array.array('h', msg)
#
#     s = 0
#     for info in infos:
#         s = s + (info & 0xffff)
#
#     s = (s >> 16) + (s & 0xffff)
#     s = s + (s >> 16)
#     return (~s) & 0xffff