#include <my_global.h>
#include <mysql.h>
//#include <stdio.h>

int main(int argc, char *argv[]){
	//printf("hello\n");
	printf("MySQL client version: %s\n", mysql_get_client_info() );
	//exit(0);
}//end main
