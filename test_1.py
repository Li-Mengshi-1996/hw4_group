import socket
from helper import *

host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
s = socket.socket()
s.connect((host, 80))
s.send(request.encode())
content = ""
while True:
    content += s.recv(65536).decode()

    if content.find("/html>") != -1:
        break

with open("test.php", 'w') as file:
    file.write(content)