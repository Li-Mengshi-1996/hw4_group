import socket
from helper import *
import ssl


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


host, file_name, path = parse_url("https://david.choffnes.com")
request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'

context = ssl.create_default_context()

s = socket.socket()

s.connect((host, 80))
s.send(request.encode())
temp = s.recv(65536)

print(temp)

# with socket.create_connection((host, 443)) as sock:
#     with context.wrap_socket(sock, server_hostname=host) as ssock:
#         ssock.send(request.encode())
#
#         content = b""
#
#         while True:
#             temp = ssock.recv(65536)
#             content += temp
#             break
#             # print(temp)
#             # print("break")
#
#             if content.find(b"/html>") != -1:
#                 break
#
#         # code, reason_phrase, content, cookies, parsed_headers = parse_response(content)
#
#         print(content)

# with open("hello.php", 'wb') as file:
#     file.write(content)


# file_new = open("hello.php", 'rb')
#
# lines = file_new.readlines()
#
# for line in lines:
#     temp = line.strip()
#
#     try:
#         print(int(temp))
#     except:
#         continue


# s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
# s.connect((host, 443))
# s.send(request.encode())
#
#
# content = b""
# while True:
#     temp = s.recv(65536)
#     content += temp
#     print(temp)
#     print("break")
#
#     if content.find(b"/html>") != -1:
#         break
#
# with open("hello.php", 'wb') as file:
#     file.write(content)
