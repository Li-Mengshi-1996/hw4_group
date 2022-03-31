from helper import *
from new_socket import *
import sys

def handle_content(content):
    return


def main():
    print(sys.argv)

    url = sys.argv[1]
    host, file_name, path = parse_url(url)
    t = RawSocket()
    t.connect(host, 80)

    request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'

    t.send(request)

    content = t.receive()





main()
