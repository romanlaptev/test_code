//https://rtfm.co.ua/c-libmysqlclient-primery-raboty-s-mysql-api/
#include <my_global.h>
#include <mysql.h>

int main(int argc, char *argv[]){

	MYSQL *conn;

	conn = mysql_init( NULL );
	if(conn == NULL){
		fprintf( stderr, "error: can not create MySQL-descriptor\n");
		fprintf( stderr, "%s\n", mysql_error(conn) );
		exit(1);
	}

	if( !mysql_real_connect( conn, 
			"localhost", "root", "master", 
			NULL, //char *db
			0, //unsigned int port
			NULL, //char *unix_socket
			0	//int client_flag
		)  	) {
		fprintf( stderr, "error: can not conect to DB server %s\n", mysql_error(conn) );
		fprintf( stderr, "error number: %s\n", mysql_errno(conn) );
		mysql_close( conn);
		exit(1);
	}
	fprintf( stdout, "ok, connect to DB server\n" );
	printf("MySQL client version: %s\n", mysql_get_client_info() );

	mysql_close( conn);
	exit(0);

}//end main
