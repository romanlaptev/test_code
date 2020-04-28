#!/bin/sh
#gcc test_connection.c -o app

#http://zetcode.com/db/mysqlc/

# mysql_config --cflags --libs
#-I/usr/include/mysql -DBIG_JOINS=1  -fno-strict-aliasing   -g
#-L/usr/lib/i386-linux-gnu -lmysqlclient -lpthread -lz -lm -lrt -ldl

#gcc test_connection.c -o app `mysql_config --cflag --libs`

gcc \
-I/usr/include/mysql \
-L/usr/lib/i386-linux-gnu -lmysqlclient \
get_version.c \
-o /home/roman/bin/app

