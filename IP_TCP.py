import socket

class IP_Info():
    def __init__(self, ip_unpack):
        self.source = socket.inet_ntoa(ip_unpack[8])
        self.destination = socket.inet_ntoa(ip_unpack[9])

class TCP_Info():
    def __init__(self, tcp_unpack):
        self.source = tcp_unpack[0]
        self.destination = tcp_unpack[1]

        self.seq = tcp_unpack[2]
        self.ack_seq = tcp_unpack[3]
        self.advertised_window = tcp_unpack[6]

        self.flag = tcp_unpack[5]