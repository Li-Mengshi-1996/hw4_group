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

# import re
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

print(len(b'HTTP/1.1 200 OK\r\nDate: Thu, 31 Mar 2022 22:33:53 GMT\r\nServer: Apache\r\nUpgrade: h2,h2c\r\nConnection: Upgrade\r\nVary: Accept-Encoding,User-Agent\r\nTransfer-Encoding: chunked\r\nContent-Type: text/html; charset=UTF-8\r\n'))
print(len(b'<!DOCTYPE html>\n<html lang="en">\n<head>\n<meta charset="utf-8">\n<title>Project 4: CS 5700 Fundamentals of Computer Networking: David Choffnes, Ph.D.</title>\n<meta name="viewport" content="width=device-width, initial-scale=1.0">\n<meta name="description" content="Homepage for David Choffnes, Ph.D., Associate Professor in Computer Science, Executive Director of the Cybersecurity and Privacy Institute at Northeastern University">\n<meta name="author" content="">\n<!--script type="text/javascript">\n\n  var _gaq = _gaq || [];\n  _gaq.push([\'_setAccount\', \'UA-2830907-1\']);\n  _gaq.push([\'_setDomainName\', \'choffnes.com\']);\n  _gaq.push([\'_trackPageview\']);\n\n  (function() {\n    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;\n    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';\n    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);\n  })();\n\n</script-->\n\n\n\n<!-- Le styles -->\n<link href="https://david.choffnes.com/bootstrap/css/bootstrap.css" rel="stylesheet">\n<style>\nbody {\n    padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */\n\tpadding-bottom: 60'))
