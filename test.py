import socket




# host = "david.choffnes.com"
# path = "/classes/cs4700sp22/project4.php"
# #
# socket = socket.socket()
# socket.connect((host,80))
# #
# get_msg = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + "\r\n"+"Accept: text/html"+'\r\n\r\n'
#
# socket.send(get_msg.encode())
#
# print(socket.recv(1024).decode())

# a = (2 << 4)
# print(a)

# iptables -A OUTPUT -p tcp --tcp-flags RST RST -j DROP
# sudo ethtool -K ens33 tx off rx off gro off

# a6020a2bd05e9217f52bc1568cc28077
# a6020a2bd05e9217f52bc1568cc28077

import re
# pattern = re.compile(rb'\\r\\n[1-9]\d*\\r\\n')
# a = b"123434\r\n2\r\n3abc4\r"
#
# content = re.sub(rb'\r\n\w\r\n', b"", a)
#
#
#
# print(content)

# import urllib.request
# with urllib.request.urlopen('https://david.choffnes.com/classes/cs4700sp22/project4.php') as response:
#    html = response.read()
#    print(html)

a = b'\r\n\r\n4000\r\nabc\r\n4000\r\n'
result = re.search(rb'4000\r\n',a)
print(result.group(1))

# print(int(b"1234",16))
# print(b"x".join([b'1',b'2']))

# file = open("index.html","rb")
# content = file.read()
# print(content)
