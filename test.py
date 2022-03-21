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

a = (2 << 4)
print(a)

# iptables -A OUTPUT -p tcp --tcp-flags RST RST -j DROP