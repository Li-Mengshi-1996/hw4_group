import socket
import struct
def sniffer_dog():

    rawSocket = socket.socket(socket.AF_INET, socket.SOCK_RAW, socket.IPPROTO_RAW)
    rawSocket.bind(('127.0.0.1',0))

    receivedPacket = rawSocket.recv(2048)

    ipHeader = receivedPacket[0:20]
    ipHdr = struct.unpack("!12s4s4s",ipHeader)
    sourceIP = socket.inet_ntoa(ipHdr[0])
    destinationIP = socket.inet_ntoa(ipHdr[2])

    tcpHeader = receivedPacket[34:54]
    tcpHdr = struct.unpack("!2s2s16s",tcpHeader)
    sourcePort = socket.inet_ntoa(tcpHdr[0])
    destinationPort = socket.inet_ntoa(tcpHdr[1])
    return list(sourceIP, destinationIP, sourcePort, destinationPort)

sniffer_dog()