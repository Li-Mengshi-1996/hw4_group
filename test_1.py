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


# def main():
#     # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
#     # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/2MB.log")
#     # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/10MB.log")
#     host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/50MB.log")
#     # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/")
#     # print(file_name)
#     # return
#     t = RawSocket()
#     t.connect(host)
#
#     #
#     request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
#
#     t.send(request)
#     content = t.receive()
#
#     print(content[0:200])
#
#     if not content.startswith(b"HTTP/1.1 200 OK"):
#         print("Non-200 status code")
#         sys.exit()
#
#     left = content.find(b'4000\r\n')
#     right = left + len(b'4000\r\n')
#
#     if left != -1:
#         content = content[0:left] + content[right:]
#
#     content = re.sub(rb'\r\n0\r\n\r\n', b"", content)
#
#     # content = re.sub(rb'\r\n[0-9]\d*\r\n', b"", content)
#     #
#     # content = re.sub(rb'\r\n4f\w\r\n', b"", content)
#
#     temp = content.split(b"\r\n")
#     diff = len(b"\r\n")
#
#     result = b""
#
#     for item in temp:
#         try:
#             in_ten = int(item, 16)
#             result = result[0:len(result) - diff]
#             print("find garbage")
#         except:
#             result = result + item + b"\r\n"
#
#     content = result[0:len(result) - diff]
#
#     parse = content.find(b"\r\n\r\n")
#     content = content[parse + len(b"\r\n\r\n"):]
#
#     t.close()
#
#     with open(file_name, 'wb') as file:
#         file.write(content)
#
#
# main()