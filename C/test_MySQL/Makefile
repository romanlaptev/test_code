CC = gcc
INCLUDES = -I/usr/include/mysql
LIBS = -L/usr/lib/i386-linux-gnu -lmysqlclient
BIN = /home/roman/bin
all: connect
#connect.o: connect.c
#		$(CC) -c $(INCLUDES) connect.c
#connect: connect.o
#		$(CC) -o $(BIN)/app connect.o $(LIBS)

connect: connect.c
		$(CC)  $(INCLUDES) $(LIBS) connect.c -o $(BIN)/app

