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

echo "<h4>";
echo "old API, PHP < 7";
echo "</h4>\n";

echo "PHP version: ".PHP_VERSION;
echo "; ";
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

	$link = mysql_connect(
		$host, 
		$user, 
		$password);
	if(!$link){
		$msg = "<b>Connection error: </b>".mysql_error();
		exit($msg);
	}
	
//mysql_query('SET NAMES utf8');
//mysql_set_charset("utf8", $link);
	echo "-- ok, connected to the server <b>".$host."</b> as ";
	echo "<b> ".$user."</b>";
	echo "<br/>\n";

//-----------------------------------------------------------
	$db_info = "MySQL info:<ul>\n";
	$db_info .= "<li>server version: " . mysql_get_server_info() ."</li>\n";
	$db_info .= "<li>client info: " . mysql_get_client_info() ."</li>\n";
	$db_info .= "<li>host info: " . mysql_get_host_info() ."</li>\n";
	$db_info .= "<li>protocol version: " . mysql_get_proto_info() ."</li>\n";
	$db_info .= "<li>mysql_client_encoding: " . mysql_client_encoding( $link ) ."</li>\n";
	$db_info .= "</ul>\n";
	echo $db_info;
	
//-----------------------------------------------------------
	$list = "Database list:<ol>\n";
	$db_list = mysql_list_dbs ($link);
	while ($row = mysql_fetch_object($db_list)){
//echo "<pre>";	
//print_r($row);
//echo "</pre>";	
		$list .= "<li>".$row->Database."</li>\n";
	}//next
	$list .= "</ol>\n";
	echo $list;

//-----------------------------------------------------------
	mysql_close( $link );

}//end runTest()

?>
