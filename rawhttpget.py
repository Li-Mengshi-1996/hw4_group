#!/usr/bin/python3
from helper import *
import sys
import os

def main():
    if len(sys.argv) != 2:
        print("Invalid input")
        return
    # os.system("sudo iptables -A OUTPUT -p tcp --tcp-flags RST RST -j DROP")
    # os.system("sudo ethtool -K ens33 tx off rx off gro off")
    command = "sudo python3 http_crawler.py " + sys.argv[1]
    os.system(command)

main()
