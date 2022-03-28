import socket
from helper import *

host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
s = socket.socket()
s.connect((host, 80))
s.send(request.encode())


content = b""
while True:
    temp = s.recv(65536)
    content += temp
    print(temp)
    print("break")

    if content.find(b"/html>") != -1:
        break

with open("hello.php", 'wb') as file:
    file.write(content)