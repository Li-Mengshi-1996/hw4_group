import sys
from random import randint
from IP_TCP import *


class RawSocket:
    """
    This is the raw socket class which will handle packet send and receive.
    """

    def __init__(self):
        try:
            self.send_socket = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_RAW)
            self.recv_socket = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_TCP)
            self.source_address = get_source_address()
            self.source_ip = self.source_address[0]
            self.source_port = self.source_address[1]
            self.destination_host = ""
            self.destination_ip = ""
            self.destination_port = 80

            self.tcp_seq = randint(0, int(pow(2, 31)) - 1)
            self.tcp_ack = 0
            self.cwnd = 1
            self.adwnd = 5840

            self.buff_size = 65535
            self.packet_id = 0
            self.recv_dict = dict()

        except:
            print("ERROR when creating sockets.")
            sys.exit()

    def connect(self, host, port=80):
        """
        Connect to the remote server with three-way handshake.
        :param host: the host of the remote server
        :param port: the port of the remote server
        :return: nothing.
        """
        self.destination_port = port
        self.destination_host = host
        self.destination_ip = socket.gethostbyname(host)

        # Three-way handshake
        self._send("", get_tcp_flags(syn=1))
        tcp_data = self._recv()
        if tcp_data is None or tcp_data.tcp_flags != get_tcp_flags(syn=1, ack=1):
            print("Fail to connect")
            sys.exit()

        self.tcp_seq = tcp_data.tcp_ack_seq
        self.tcp_ack = tcp_data.tcp_seq + 1
        self._send('', get_tcp_flags(ack=1))

        print("connected")

    def send(self, data):
        """
        Users will use this function to send data to the remote server.
        :param data: the data to be sent.\
        :return: nothing
        """
        flag = get_tcp_flags(psh=1, ack=1)
        pointer = 0

        while pointer < len(data):
            end = min(pointer + self.cwnd, len(data))
            piece = data[pointer: end]

            # Send a piece of data.
            self._send(piece, flag)

            # payload = piece.encode()
            #
            # # Wrap data with IP header and TCP header.
            # tcp_data = TCPHeader(self.source_port, self.destination_port, self.tcp_seq, self.tcp_ack, flag,
            #                      payload=payload)
            # ip_tcp_data = IPHeader(self.packet_id, self.source_ip, self.destination_ip,
            #                        tcp_data.create_tcp_header(self.source_ip, self.destination_ip))
            # self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))

            tcp_data = self._recv()

            # If we can't get the ACK in 60 seconds, we think it's lost,
            # we will set congestion window to 1 and retransmit.
            if tcp_data is None:
                self.cwnd = 1
                continue
            pointer = end
            # If everything is good, we will update the sequence number and the congestion window.
            self.tcp_seq = tcp_data.tcp_ack_seq
            self.cwnd = min(1000, self.cwnd * 2)

    def _send(self, data, flag):
        """
        Send data or ACKs to the remote server
        :param data: the data to be sent
        :param flag: the flag this packet has
        :return: nothing
        """
        payload = data.encode()
        # Wrap data with IP header and TCP header.
        tcp_data = TCPHeader(self.source_port, self.destination_port, self.tcp_seq, self.tcp_ack, flag, payload=payload)
        ip_tcp_data = IPHeader(self.packet_id, self.source_ip, self.destination_ip,
                               tcp_data.create_tcp_header(self.source_ip, self.destination_ip))
        self.send_socket.sendto(ip_tcp_data.create_ip_header(), (self.destination_ip, self.destination_port))

    def _recv_ip_tcp_data(self, delay=60):
        """
        Receive the raw data from the remote server and change it to an IPHeader object.
        :param delay: the delay time, default value is 60 seconds.
        :return: a packet with TCP header and data
        """
        self.recv_socket.settimeout(delay)
        try:
            while True:
                data = self.recv_socket.recv(self.buff_size)
                ip_header_data = data[0:20]
                ip_tcp_data = extract_ip_header(data)
                # Check the remote IP and local IP to make sure it's from the remote server and sent to local.
                if ip_tcp_data.source_ip != self.destination_ip or ip_tcp_data.destination_ip != self.source_ip:
                    continue
                # Check whether the IP checksum is valid.
                if check_sum(ip_header_data) != 0:
                    print("IP checksum error")
                    continue
                return ip_tcp_data.payload
        except:
            # If we didn't receive in delay seconds, we will return None and handle it as connection lost in receive().
            return None

    def _recv(self, delay=60, choice=0):
        """
        Handle IPHeader object and get TCPHeader object.
        :param delay: the delay time, default is 60 seconds.
        :param choice: TCP checksum
        :return: a TCPHeader object
        """
        tcp_data = self._recv_ip_tcp_data(delay=delay)

        # If we didn't get the data in delay seconds, we will return None and handle it as connection lost in receive().
        if tcp_data is None:
            self.cwnd = 1
            return None

        # Do TCP checksum.
        if choice == 1:
            if not check_tcp(tcp_data, self.source_ip, self.destination_ip):
                result = extract_tcp_header(tcp_data)
                result.tcp_flags = -1
                return result

        return extract_tcp_header(tcp_data)

    def receive(self):
        """
        Users will call this function to receive data from remote server.
        This function will handle connection lost and invalid TCP checksum.
        :return: pure data
        """
        while True:
            tcp_data = self._recv(delay=180, choice=1)

            # If does not receive any data from the remote server for 180 seconds, the connection is lost.
            if tcp_data is None:
                print("Connection lost.")
                sys.exit(1)

            # If the TCP checksum is invalid, we will not store it.
            if tcp_data.tcp_flags == -1:
                self._send("", get_tcp_flags(ack=1))
                continue

            # When we get the last packet.
            if len(tcp_data.payload) == 0 and (tcp_data.tcp_flags & get_tcp_flags(fin=1)):
                self.tcp_seq = tcp_data.tcp_ack_seq
                self.tcp_ack = tcp_data.tcp_seq + 1
                self._send("", get_tcp_flags(fin=1, ack=1))
                break
            # We get a valid packet.
            if tcp_data.tcp_flags & get_tcp_flags(ack=1) and tcp_data.payload:
                if tcp_data.tcp_seq == self.tcp_ack:
                    self.cwnd = min(1000, self.cwnd * 2)
                    self.recv_dict[tcp_data.tcp_seq] = tcp_data.payload
                    self.tcp_seq = tcp_data.tcp_ack_seq
                    self.tcp_ack = self.tcp_ack + len(tcp_data.payload)
                    self._send("", get_tcp_flags(ack=1))
                else:
                    self.cwnd = 1
                    self._send("", get_tcp_flags(ack=1))

        # After we got all packets, we will sort them by sequence number.
        tuple_list = []
        for seq in self.recv_dict.keys():
            tuple_list.append((seq, self.recv_dict[seq]))
        sorted_list = sorted(tuple_list, key=lambda t: t[0])

        # Concat the sorted result.
        result = b""
        for item in sorted_list:
            result += item[1]

        self.recv_dict.clear()
        return result

    def _teardown(self):
        """
        Teardown the connection.
        :return: whether the teardown successes
        """
        self._send("", get_tcp_flags(fin=1, ack=1))
        tcp_data = self._recv()
        if tcp_data is None or tcp_data.tcp_flags & get_tcp_flags(ack=1) == 0:
            return False
        self.tcp_seq = tcp_data.tcp_ack_seq
        self.tcp_ack = tcp_data.tcp_seq + 1
        if tcp_data.tcp_flags & get_tcp_flags(fin=1):
            self._send("", get_tcp_flags(ack=1))

        return True

    def close(self):
        """
        Users will use this function to close the connection
        :return: nothing
        """
        result = self._teardown()
        if result:
            self.recv_socket.close()
            self.send_socket.close()
        else:
            print("Teardown fails.")
            sys.exit(1)
