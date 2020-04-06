<?php
//https://www.php.net/manual/ru/set.mysqlinfo.php
//http://php.net/manual/ru/function.mysql-db-query.php
//http://php.net/manual/ru/mysqli.select-db.php
//http://php.net/manual/ru/ref.pdo-mysql.php
//http://php.net/manual/ru/mysqli.examples-basic.php

//error_reporting(E_ALL ^ E_DEPRECATED);
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$_vars=array();
require_once("./inc/db_auth.php");

echo "<h3>";
echo "test MySQL connection";
echo "</h3>\n";

echo "PHP version: ".PHP_VERSION;
echo "<br/>\n";
echo "OS: ". PHP_OS;
echo "<br/>\n";

$loadedExt = get_loaded_extensions();

$module_name = "mysql";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);
if( !$_vars["support"][$module_name] ){
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
}

$module_name = "mysqli";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);

$module_name = "PDO";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);

$module_name = "pdo_mysql";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);

//echo "vars: <pre>";
//print_r( $_vars );
//echo "</pre>";
runTest();


//=================================================
function check_module( $module_name, $loadedExt){
	if ( !in_array( $module_name, $loadedExt ) ) {
		$msg = "-- error, module <b>".$module_name."</b>  not loaded...";
		echo $msg;
		echo "<br/>\n";
		return false;
	} else {
		$msg = "-- ok, module <b>".$module_name."</b> is available...";
		echo $msg;
		echo "<br/>\n";
	//https://www.php.net/manual/ru/function.get-extension-funcs.php
	//echo "list of functions in module <b>".$module_name."</b>:<pre>";
	//print_r(get_extension_funcs( $module_name ));
	//echo "</pre>";
		return true;
	}
}//end check_module()


//========================================
function runTest(){
	global $_vars;

	$host = $_vars["config"]["mysql"]["dbHost"];
//	$dbPort = $_vars["config"]["mysql"]["dbPort"];
	$user = $_vars["config"]["mysql"]["dbUser"];
	$password = $_vars["config"]["mysql"]["dbPassword"];
//	$dbName = $_vars["config"]["mysql"]["dbName"];

	$_vars["link"] = mysql_connect(
		$host, 
		$user, 
		$password);
	if(!$_vars["link"]){
		$msg = "<b>Connection error: </b>".mysql_error();
		exit($msg);
	}
	
//mysql_query('SET NAMES utf8');
//mysql_set_charset("utf8", $link);
	echo "-- ok, connected to the server ".$host;
	echo "<br/>\n";

	echo "<b>db user</b>: ".$user;
	echo "<br/>\n";

//-----------------------------------------------------------
	$db_info = "<ul>\n";
	$db_info .= "<li>MySQL server version: " . mysql_get_server_info() ."</li>\n";
	$db_info .= "<li>MySQL client info: " . mysql_get_client_info() ."</li>\n";
	$db_info .= "<li>MySQL host info: " . mysql_get_host_info() ."</li>\n";
	$db_info .= "<li>MySQL protocol version: " . mysql_get_proto_info() ."</li>\n";
	$db_info .= "<li>mysql_client_encoding: " . mysql_client_encoding( $_vars["link"] ) ."</li>\n";
	$db_info .= "</ul>\n";
	echo $db_info;
//-----------------------------------------------------------
	mysql_close( $_vars["link"] );

}//end runTest()

/*
//-----------------------------------------------------------
	$vars = "";
	
	$sql_query = "SHOW VARIABLES";
	$query = mysql_query($sql_query) or die( "<b class='text-danger'>Query error: </b>".mysql_error() );
	while( $result = mysql_fetch_assoc($query) ){
//echo "<pre>";	
//print_r($result);
//echo "</pre>";	
		$name = $result['Variable_name'];
		$value = $result['Value'];
		$item = $name." = " .$value;
		
		if ($name == "character_set_system"){
			$item = "<p class='mark'>DEFAULT CHARSET, <b>".$name."</b> : ".$value."</p>";
		}
		
		if ($name == "table_type"){
			$item = "<p class='mark'>ENGINE, <b>".$name."</b> : ".$value."</p>";
		}
		if ($name == "storage_engine"){
			$item = "<p class='mark'>ENGINE, <b>".$name."</b> : ".$value."</p>";
		}

		$vars .= "<li>".$item. "</li>";
	}// end while
	$list_vars = "<ul>".$vars."</ul>";
	

//-----------------------------------------------------------
	$ver = mysql_query("SELECT VERSION()");
	if($ver){
		$version = mysql_result($ver, 0);
	}

//-----------------------------------------------------------
	$db = mysql_select_db($db_name) or die( "<b class='text-danger'>Query error: </b>".mysql_error() );
	
	$sql = "SHOW TABLES";
	$data = get_db_data( $sql );
	
	$output="<ol>";
	//foreach( $data as $key => $value){
	for( $n = 0; $n < count($data); $n++ ){
		$row = $data[$n];
//echo "<pre>";
//print_r($row);
//echo "</pre>";
		$list_fields = show_fields( $row[0] );
		$output .="<li><b>Table</b> ".$row[0].", <b>fields:</b> ". $list_fields."</li>";
	}//next
	
	$output .= "<ol>";
	$test_query = $output;






function get_db_data( $sql ){
	$data = array();
	$res = mysql_query($sql) or die( "<b class='text-danger'>Query error: </b>".mysql_error() );

	//while ($row = mysql_fetch_array($res,MYSQL_BOTH)){
	//while ($row = mysql_fetch_array($res,MYSQL_ASSOC)){
	//while( $row = mysql_fetch_row($res)){
	//while ($row = mysql_fetch_assoc($res)){
//echo "<pre>";
//print_r($row);
//echo "</pre>";
	//}//end while

// $num_rows = mysql_num_rows($res);
// if ($num_rows > 0){
// } else {
	// echo "<p class='text-danger'>Empty result query ".$query."</p>";
// }
	
	for( $n = 0; $n < mysql_num_rows ($res); $n++){
		//$row = mysql_fetch_object($res);
		$row = mysql_fetch_row($res);
//echo "<pre>";
//print_r ($row);
//echo "</pre>";
		$data[] = $row;
	}//next row
	
	return $data;
}//end get_db_data()


function get_db_data_obj( $sql ){
	$data = array();
	$res = mysql_query($sql) or die( "<b class='text-danger'>Query error: </b>".mysql_error() );

	for( $n = 0; $n < mysql_num_rows ($res); $n++){
		$row = mysql_fetch_object($res);
//echo "<pre>";
//print_r ($row);
//echo "</pre>";
		$data[] = $row;
	}//next row
	
	return $data;
}//end get_db_data_obj()

function show_fields( $table_name ){
	$sql = "SHOW COLUMNS FROM ".$table_name;
	//$sql = "SHOW FIELDS FROM db ";
	$data = get_db_data_obj( $sql );
	$table_tpl ="<table class='table table-bordered small'><thead><tr class='list-header success'>{{thead}}</tr></thead><tbody>{{records}}</tbody></table>";
	$thead_tpl = "<th>{{column_name}}</th>";
	$record_tpl = "<tr>{{columns}}</tr>";
	$column_tpl = "<td class='list-body'>{{data}}</td>";
	
	$records = "";
	foreach( $data as $key => $row){
		$thead = "";
		$columns = "";
		foreach( $row as $field_name => $value){
			$thead .= str_replace('{{column_name}}', $field_name, $thead_tpl);
			$columns .= str_replace('{{data}}', $value, $column_tpl);
		}//next
		$records .= str_replace('{{columns}}', $columns, $record_tpl);
	}//next
	
	$table = str_replace('{{thead}}', $thead, $table_tpl);
	$table = str_replace('{{records}}', $records, $table);
	
	//$out .= $table;
	
	return $table;
}//end show_fields


printf("mysqli_get_client_info: %s\n", mysqli_get_client_info());
//$link = mysqli_connect( $host, $user, $password, $db_name);
$mysqli = new mysqli($host, $user, $password, $db_name);
echo "<pre>";	
print_r($mysqli);
echo "</pre>";	

if ($mysqli->connect_errno) {
    echo "Ошибка: Не удалсь создать соединение с базой MySQL и вот почему: \n";
    echo "Номер_ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
*/
?>