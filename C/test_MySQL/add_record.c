#include <my_global.h>
#include <mysql.h>
#include <errmsg.h>
#include <mysqld_error.h>

int main( int argc, char *argv[] ){

	MYSQL *conn;
   char *sql_query;

	conn = mysql_init( NULL );
	if(conn == NULL){
		fprintf( stderr, "error: can not create MySQL-descriptor\n");
		fprintf( stderr, "%s\n", mysql_error(conn) );
		fprintf( stderr, "error number: %s\n", mysql_errno(conn) );
		exit(1);
	}

	if( !mysql_real_connect( conn, 
			"localhost", "root", "master", 
			"db1", //char *db
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
	//printf("MySQL client version: %s\n", mysql_get_client_info() );

//define charset
//	if( mysql_query( &conn, "SET NAMES 'utf8'" ) != 0){
//		fprintf( stderr, "error, can not define charset\n");
//		exit(1);
//	}
	
	sql_query = "INSERT INTO table1(name) VALUES ('J');" ;

	if( mysql_query( conn, sql_query ) != 0){
		fprintf( stderr, "error, can not execute query: %s\n", sql_query);
		fprintf( stderr, "last error: %s\n", mysql_error(conn) );
		fprintf( stderr, "error number: %s\n", mysql_errno(conn) );
	}

	mysql_close( conn);
	exit(0);

}//end main
