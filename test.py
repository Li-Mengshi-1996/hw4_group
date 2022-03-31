import socket




# host = "david.choffnes.com"
# path = "/classes/cs4700sp22/project4.php"
#
# socket = socket.socket()
# socket.connect((host,80))
#
# get_msg = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
#
# socket.send(get_msg.encode())
#
# print(socket.recv(1024).decode())

# a = (2 << 4)
# print(a)

# iptables -A OUTPUT -p tcp --tcp-flags RST RST -j DROP

# a6020a2bd05e9217f52bc1568cc28077
# a6020a2bd05e9217f52bc1568cc28077

import re
pattern = re.compile(rb'\\r\\n[1-9]\d*\\r\\n')
a = b"123434\r\n234\r\n3abc4\r"

content = re.sub(rb'\r\n[1-9]\d*\r\n', b"", a)



print(content)


