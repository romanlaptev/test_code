CC = gcc
INCLUDES = -I/usr/include/mysql
LIBS = -L/usr/lib/i386-linux-gnu -lmysqlclient
BIN = /home/roman/bin
all: examples
#connect.o: connect.c
#		$(CC) -c $(INCLUDES) connect.c
#connect: connect.o
#		$(CC) -o $(BIN)/app connect.o $(LIBS)

#examples: connect.c
#		$(CC)  $(INCLUDES) $(LIBS) connect.c -o $(BIN)/connect

examples:
		$(CC)  $(INCLUDES) $(LIBS) connect.c -o $(BIN)/connect
		$(CC)  $(INCLUDES) $(LIBS) add_record.c -o $(BIN)/add_record

