<?php
//http://php.net/manual/ru/ref.pdo-mysql.php
//http://php.net/manual/ru/ref.pdo-mysql.php
//https://nix-tips.ru/php-pdo-rabotaem-s-bazami-dannyx-pravilno.html
//https://stackoverflow.com/questions/36073703/mysql-to-pdo-comparison-table

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$_vars=array();
require_once("./inc/db_auth.php");

echo "<h3>";
echo "test MySQL connection: PDO driver";
echo "</h3>\n";

echo "PHP version: ".PHP_VERSION;
echo "<br/>\n";
echo "OS: ". PHP_OS;
echo "<br/>\n";

$loadedExt = get_loaded_extensions();

$module_name = "mysql";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);

$module_name = "mysqli";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);

$module_name = "PDO";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);
if( !$_vars["support"][$module_name] ){
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
}

$module_name = "pdo_mysql";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);
if( !$_vars["support"][$module_name] ){
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
}

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


//=================================================
function runTest(){
	global $_vars;

	$dbHost = $_vars["config"]["mysql"]["dbHost"];
	$dbUser = $_vars["config"]["mysql"]["dbUser"];
	$dbPassword = $_vars["config"]["mysql"]["dbPassword"];
	//$dbName = $_vars["config"]["mysql"]["dbName"];
	//	$dbPort = $_vars["config"]["mysql"]["dbPort"];

	//$dsn = "mysql:host={$dbHost};dbname={$dbName}";
	$dsn = "mysql:host={$dbHost}";
	try{
		$connection = new PDO( $dsn, $dbUser, $dbPassword );

		echo "-- ok, connected to the server <b>".$dbHost."</b> as ";
		echo "<b> ".$dbUser."</b>";
		echo "<br/>\n";

//----------------------------------------------
// echo "PDOdrivers: <pre>";	
// print_r($connection->getAvailableDrivers());
// echo "</pre>";
// echo "<br/>\n";

		$out = "<ul>\n";

		$sql_query = "SELECT VERSION()";
		$result  = $connection->query( $sql_query );
		if( !$result ){
			echo "-- error, query: ".$sql_query;
			echo "<br/>\n";
echo "error info: <pre>";	
print_r( $connection->errorInfo() );
echo "</pre>";
		} else {
			$row = $result->fetch( PDO::FETCH_NUM );
			$out .= "<li>server version: " .$row[0] ."</li>\n";
		}
//----------------------------------------------
	
		//$coll = $connection->query( "SELECT COLLATION('$dbName')" )->fetchColumn();
		//echo $coll->fetch(PDO::FETCH_NUM)[0];
		//echo $coll;
		//$_vars["dbInfo"] .= "<li>database '$dbName', collation_connection : " . $coll ."</li>";
	
		$sql_query = "SELECT CHARSET('')";
		$charset = $connection->query( $sql_query )->fetchColumn();
		$out .= "<li>Charset : " . $charset ."</li>\n";
	
		$out .= "</ul>\n";
		echo $out;

//----------------------------------------------
		$sql_query = "SHOW DATABASES";
		$result  = $connection->query( $sql_query );
		if( !$result ){
			echo "-- error, query: ".$sql_query;
			echo "<br/>\n";
echo "error info: <pre>";	
print_r( $connection->errorInfo() );
echo "</pre>";
		} else {
			$out = "Database list: <ol>\n";
			//$row = $result->fetch( PDO::FETCH_NUM );
			//$totRows = $stmt->rowCount();
			$rows  = $result->fetchAll( PDO::FETCH_NUM );
// echo "<pre>";	
// print_r($rows);
// echo "</pre>";	
			for( $n = 0; $n < count($rows); $n++){
				$out .= "<li>" . $rows[$n][0] ."</li>\n";
			}//next
			$out .= "</ol>\n";
			echo $out;
		}
	
//----------------------------------------------	

		unset ($connection);
	} catch( PDOException $exception ) {
		echo "-- error connection, ".$exception->getMessage();
		echo "<br/>\n";
	}

}//end runTest()
	
	
/*
MySQL_ way:
$result = mysql_query( $query, [$dbh] ) or die( mysql_error() );
//$result  = $connection->query( $query ) or die( $connection->errorInfo()[2] );
$result  = $connection->query( $query ) or die( $connection->errorInfo() );
----------

MySQL_ way:
$row = mysql_fetch_row( $result );

PDO way:
$row = $result->fetch( PDO::FETCH_NUM );

PDO::FETCH_ASSOC     Associative array
PDO::FETCH_BOTH      Array indexed by both numeric and associative keys (default)
PDO::FETCH_BOUND     Boolean TRUE (and assigns columns values to variables to which  
                     they were bound with the PDOStatement::bindColumn() method)
PDO::FETCH_LAZY      combines PDO::FETCH_BOTH and PDO::FETCH_OBJ
PDO::FETCH_NAMED     same form as PDO::FETCH_ASSOC, but if there are multiple columns 
                     with same name, the value referred to by that key will be an 
                     array of all the values in the row that had that column name
PDO::FETCH_NUM       Enumerated array
PDO::FETCH_OBJ       Anonymous object with column names as property names
---------

$result   = $connection->query( $query, PDO::FETCH_OBJ ) or die( $connection->errorInfo()[2] );
------------
MySQL_ way:

$totRows = mysql_num_rows( $result );
$totRows = affected_rows( $result );

PDO way:

$totRows = $stmt->rowCount();
-------------
MySQL_ way:

$row   = mysql_result( $result, $numRow );
$field = mysql_result( $result, $numRow, $numField );

PDO way:

$rows  = $stmt->fetchAll( FETCH_NUM );
$row   = $rows[ $numRow ];
$field = $rows[ $numRow ][ $numField ];
------------
MySQL_ way:

$result    = mysql_list_tables( $dbName );
$tableName = mysql_tablename( $result, $tableNum );

PDO way:
$stmt      = $dbh->query( "SHOW TABLES FROM test" )->fetchAll(PDO::FETCH_NUM);
$tableName = $stmt[1][0];

*/

/*
function _testPDO(){
	global $_vars;
	
	$connection = $_vars["link"];
	
//----------------------------------------------	

	$_vars["dbVars"] = "";
	$query = "SHOW VARIABLES";
	
	//$result  = $connection->query( $query ) or die( $connection->errorInfo()[2] );
	$result  = $connection->query( $query ) or die( $connection->errorInfo() );
	
	$rows  = $result->fetchAll( PDO::FETCH_ASSOC );
//echo count($rows);	
	$vars = "";
	for( $n = 0; $n < count($rows); $n++){
		$name = $rows[$n]["Variable_name"];
		$value = $rows[$n]["Value"];
		$item = $name." = " .$value;
		
		if ($name == "character_set_system"){
			$item = "<p class='mark'>DEFAULT CHARSET, <b>".$name."</b> : ".$value."</p>";
		}
		// if ($name == "table_type"){
			// $item = "<p class='mark'>ENGINE, <b>".$name."</b> : ".$value."</p>";
		// }
		
		if ($name == "storage_engine"){
			$item = "<p class='mark'>ENGINE, <b>".$name."</b> : ".$value."</p>";
		}

		$vars .= "<li>".$item. "</li>";
	}//next	
	$_vars["dbVars"] = "<ul>".$vars."</ul>";
	
//----------------------------------------------
	$_vars["dbTables"] = "";
	$query = "SHOW TABLES";
	
	//$result  = $connection->query( $query ) or die( $connection->errorInfo()[2] );
	$result  = $connection->query( $query ) or die( $connection->errorInfo() );
	
	$rows  = $result->fetchAll( PDO::FETCH_NUM );
	for( $n = 0; $n < count($rows); $n++){
		$_vars["dbTables"] .= "<li>" . $rows[$n][0] ."</li>";
	}//next
	
// echo "<pre>";	
// print_r($rows);
// echo "</pre>";	
	
}//end _testPDO()
*/
?>
