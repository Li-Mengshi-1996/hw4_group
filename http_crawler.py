from helper import *
from new_socket import *
import sys


def main():
    # print(sys.argv)

    url = sys.argv[1]
    host, file_name, path = parse_url(url)
    t = RawSocket()
    t.connect(host, 80)

    request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'

    t.send(request)

    content = t.receive()

    print(content[0:200])

    if not content.startswith(b"HTTP/1.1 200 OK"):
        print("Non-200 status code")
        sys.exit()

    left = content.find(b'4000\r\n')
    right = left + len(b'4000\r\n')

    if left != -1:
        content = content[0:left] + content[right:]

    content = re.sub(rb'\r\n0\r\n\r\n', b"", content)

    # content = re.sub(rb'\r\n[0-9]\d*\r\n', b"", content)
    #
    # content = re.sub(rb'\r\n4f\w\r\n', b"", content)

    temp = content.split(b"\r\n")
    diff = len(b"\r\n")

    result = b""

    for item in temp:
        try:
            in_ten = int(item,16)
            result = result[0:len(result) - diff]
            print("find garbage")
        except:
            result = result + item + b"\r\n"

    content = result[0:len(result) - diff]

    parse = content.find(b"\r\n\r\n")
    content = content[parse + len(b"\r\n\r\n"):]

    t.close()

    with open(file_name, 'wb') as file:
        file.write(content)





main()
