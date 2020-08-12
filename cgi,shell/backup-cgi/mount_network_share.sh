#!/bin/sh
ping -c 3 192.168.56.1
mount -t cifs //192.168.56.1/backup /mnt/net -o username=vbox1,password=vbox1
ls /mnt/net

