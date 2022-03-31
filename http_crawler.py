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


    # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/project4.php")
    # # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/2MB.log")
    # # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/10MB.log")
    # # host, file_name, path = parse_url("https://david.choffnes.com/classes/cs4700sp22/50MB.log")
    # t = RawSocket()
    # t.connect(host)
    #
    # #
    # request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'
    #
    # t.send(request)
    # content = t.receive()
    #
    # t.close()

    # with open(file_name, 'wb') as file:
    #     file.write(content)


main()
