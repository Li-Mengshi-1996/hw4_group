import socket
import random
import struct
import sys

SYN = 0 + (1 << 1) + (0 << 2) + (0 << 3) + (0 << 4) + (0 << 5)
FIN = 1 + (0 << 1) + (0 << 2) + (0 << 3) + (0 << 4) + (0 << 5)
ACK = 0 + (0 << 1) + (0 << 2) + (0 << 3) + (1 << 4) + (0 << 5)


class RawSocket:
    def __init__(self):
        try:
            self.send_socket = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_RAW)
            self.recv_socket = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_TCP)
            self.source_address = self.get_source_address()
            self.source_ip = self.source_address[0]
            self.source_port = self.source_address[1]
            self.destination_host = ""
            self.destination_ip = ""
            self.destination_port = 80
            self.destination_path = ""

            self.outtput_file = ""

        except:
            print("ERROR when creating sockets.")
            sys.exit()

    def get_source_address(self):
        s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        s.connect(('8.8.8.8', 80))
        address = s.getsockname()
        s.close()
        print(address)
        return address

    def get_destination_address(self, url):
        url = url.replace("http://", "")
        url = url.replace("https://", "")
        url_list = url.split("/")
        host = url_list[0]

        if len(url_list) == 1 or url_list[1] == "":
            file = "index.html"
        else:
            file = url_list[len(url_list) - 1]

        path = url.replace(host, "")
        if path == "":
            path = "/"

        ip = socket.gethostbyname(host)

        return host, file, ip, path

    def connect(self, url):
        self.destination_host, self.outtput_file, self.destination_ip, self.destination_path = self.get_destination_address(
            url)

        print("connected")

    def check_sum(self, msg):
        s = 0
        print(len(msg))
        for i in range(0, len(msg), 2):
            if i == len(msg) - 1:
                w = msg[i]
            else:
                w = msg[i] + (msg[i + 1] << 8)
            s = s + w

        s = (s >> 16) + (s & 0xffff)
        s = s + (s >> 16)

        s = ~s & 0xffff

        return s

    def get_ip_header(self):
        ip_ihl = 5
        ip_ver = 4
        ip_tos = 0
        ip_tot_len = 0

        ip_id = random.randint(10000, 40000)
        ip_frag_off = 0
        ip_ttl = 255
        ip_proto = socket.IPPROTO_TCP
        ip_check = 0
        ip_saddr = socket.inet_aton(self.source_ip)
        ip_daddr = socket.inet_aton(self.destination_ip)

        ip_ihl_ver = (ip_ver << 4) + ip_ihl

        ip_header = struct.pack('!BBHHHBBH4s4s', ip_ihl_ver, ip_tos, ip_tot_len,
                                ip_id, ip_frag_off, ip_ttl, ip_proto, ip_check, ip_saddr, ip_daddr)
        print(ip_header)
        return ip_header

    def get_tcp_header(self, user_data, tcp_flags):
        tcp_source = self.source_port
        tcp_dest = self.destination_port

        tcp_seq = 454
        tcp_ack_seq = 0

        tcp_doff = 5
        tcp_window = socket.htons(5840)
        tcp_check = 0
        tcp_urg_ptr = 0

        tcp_offset_res = (tcp_doff << 4) + 0

        tcp_header = struct.pack('!HHLLBBHHH', tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags,
                                 tcp_window, tcp_check, tcp_urg_ptr)

        source_address = socket.inet_aton(self.source_ip)
        dest_address = socket.inet_aton(self.destination_ip)

        placeholder = 0
        protocol = socket.IPPROTO_TCP
        tcp_length = len(tcp_header) + len(user_data)

        psh = struct.pack('!4s4sBBH', source_address, dest_address, placeholder, protocol, tcp_length)
        print(type(psh))
        print(type(tcp_header))
        psh = psh + tcp_header + user_data.encode()

        tcp_check = self.check_sum(psh)
        tcp_header = struct.pack('!HHLLBBH', tcp_source, tcp_dest, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flags,
                                 tcp_window) + struct.pack('H', tcp_check) + struct.pack('!H', tcp_urg_ptr)

        return tcp_header

    def send(self, user_data, tcp_flags):
        user_data = 'GET ' + self.destination_path + ' HTTP/1.1\r\n' + 'Host: ' + self.destination_host + '\r\n\r\n'
        print(user_data)
        packet = self.get_ip_header() + self.get_tcp_header(user_data, tcp_flags) + user_data.encode()
        self.send_socket.sendto(packet, (self.destination_ip, self.destination_port))
        print("sent")
        print(self.destination_ip)



    def receive(self):
        data = self.recv_socket.recv(1024)

        print(data)
        ipheader = data[0:20]
        ip_unpack = struct.unpack("!BBHHHBBH4s4s", ipheader)
        print(ip_unpack)
        print(socket.inet_ntoa(ip_unpack[8]))
        print(socket.inet_ntoa(ip_unpack[9]))
        print("finish")
        tcp = data[20:40]
        tcp_unpack = struct.unpack('!HHLLBBHHH', tcp)
        print(tcp_unpack)

        print(data[40:])
        print(len(data))
        print("hello")



def main():
    c = RawSocket()
    print(c.source_address)
    c.connect("http://david.choffnes.com/classes/cs4700sp22/project4.php")
    # c.get_ip_header()
    # print(c.check_sum("afadfadfadddffffffffffffffffffffffffffffffffffffffffaddddddddddddddd"))
    c.send("hello", SYN)
    c.receive()


main()
