#!/bin/sh
#gcc test_connection.c -o app

#http://zetcode.com/db/mysqlc/

# mysql_config --cflags --libs
#-I/usr/include/mysql -DBIG_JOINS=1  -fno-strict-aliasing   -g
#-L/usr/lib/i386-linux-gnu -lmysqlclient -lpthread -lz -lm -lrt -ldl

#gcc test_connection.c -o app `mysql_config --cflag --libs`

#gcc \
#-I/usr/include/mysql \
#-L/usr/lib/i386-linux-gnu -lmysqlclient \
#get_version.c \
#-o /home/roman/bin/app


INCLUDES="-I/usr/include/mysql"
LIBS="-L/usr/lib/i386-linux-gnu -lmysqlclient"
BIN="/home/roman/bin"
APP_NAME="get_version"
#gcc ${INCLUDES} ${LIBS} ${APP_NAME}.c -o ${BIN}/${APP_NAME}


INCLUDES="-I/usr/include/mysql"
#LIBS="-L/usr/lib/i386-linux-gnu -lmysqlclient -std=c99"
LIBS="-L/usr/lib/i386-linux-gnu -lmysqlclient -std=gnu99"
BIN="/home/roman/bin"
APP_NAME="select_query"
gcc ${INCLUDES} ${LIBS} ${APP_NAME}.c -o ${BIN}/${APP_NAME}

