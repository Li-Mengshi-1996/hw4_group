from new_socket import *
import sys
import re


def main():
    url = sys.argv[1]
    host, file_name, path = parse_url(url)
    t = RawSocket()
    t.connect(host, 80)

    request = 'GET ' + path + ' HTTP/1.1\r\n' + 'Host: ' + host + '\r\n\r\n'

    t.send(request)

    content = t.receive()

    # Handle non-200 status code.
    if not content.startswith(b"HTTP/1.1 200 OK"):
        print("Non-200 status code")
        sys.exit()

    # Handle chunked encoding.
    # left = content.find(b'4000\r\n')
    # right = left + len(b'4000\r\n')

    flag = re.search(rb'\r\n\r\n[0-9a-fA-F]\d*\r\n', content)

    if flag is not None:
        left = flag.span()[0] + len(b"\r\n\r\n")
        right = flag.span()[1]
        content = content[0:left] + content[right:]
    # if left != -1:
    #     content = content[0:left] + content[right:]
    content = re.sub(rb'\r\n0\r\n\r\n', b"", content)

    temp = content.split(b"\r\n")
    diff = len(b"\r\n")

    result = b""

    for item in temp:
        try:
            in_ten = int(item, 16)
            result = result[0:len(result) - diff]
            print("find garbage")
        except:
            result = result + item + b"\r\n"

    content = result[0:len(result) - diff]

    # Remove HTTP header.
    parse = content.find(b"\r\n\r\n")
    content = content[parse + len(b"\r\n\r\n"):]

    t.close()

    # Output the file.
    with open(file_name, 'wb') as file:
        file.write(content)


main()
