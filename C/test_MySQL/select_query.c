//https://rtfm.co.ua/c-libmysqlclient-primery-raboty-s-mysql-api/
#include <my_global.h>
#include <mysql.h>

#define DB_HOST "localhost"
#define DB_USER "root"
#define DB_PASS "master"
#define DB_NAME "db1"

void finish_with_error( MYSQL *conn ){
	fprintf( stderr, "%s\n", mysql_error(conn) );
	fprintf( stderr, "error number: %s\n", mysql_errno(conn) );
	mysql_close( conn);
	exit(1);
}//end

int main( int argc, char *argv[] ){

	MYSQL *conn;
	MYSQL_RES *result;
	MYSQL_ROW row;
   char *sql_query;


	conn = mysql_init( NULL );
	if( conn == NULL ){
		fprintf( stderr, "error: can not create MySQL-descriptor\n");
		finish_with_error( conn );
	}

//===========================
	if( !mysql_real_connect( conn, 
			DB_HOST, DB_USER, DB_PASS, 
			DB_NAME, //char *db
			0, //unsigned int port
			NULL, //char *unix_socket
			0	//int client_flag
		)  	) {
		finish_with_error( conn );
	}

	fprintf( stdout, "ok, connect to DB server\n" );
	printf("MySQL client version: %s\n", mysql_get_client_info() );

//===========================
	sql_query = "SELECT * FROM table1;" ;
	if( mysql_query( conn, sql_query ) != 0){
		fprintf( stderr, "error, can not execute query: %s\n", sql_query);
		finish_with_error( conn );
	}

	result = mysql_store_result( conn );
	if( result == NULL ){
		fprintf( stderr, "warning, no records found... %s\n");
		finish_with_error( conn );
	}

	int num_fields = mysql_num_fields( result );
	while ( ( row = mysql_fetch_row(result) ) ){
		for( int n = 0; n < num_fields; n++){
			printf("%s ", row[n] ? row[n] : "null" );
		}//next
		printf("\n");
	}//next

	mysql_free_result( result );

//===========================
	mysql_close( conn);
	exit(0);

}//end main
