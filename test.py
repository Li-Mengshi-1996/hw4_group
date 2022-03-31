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
# sudo ethtool -K ens33 tx off rx off

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

a = b'\r\n\r\n1375\r\nabc\r\nxyz\r\n'
result = re.findall(b'\r\n\w*\r\n',a)
print(result)

# print(int(b"1234",16))
# print(b"x".join([b'1',b'2']))
