#!/bin/bash
ping -c 3 192.168.56.1
#echo $?
if [ $? -ne "0" ]; then
echo "error!, ping failed"
#exit 1
else
echo "all right"
fi

