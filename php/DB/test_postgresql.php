<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$_vars=array();
require_once("./inc/db_auth.php");

echo "<h3>";
echo "test PostgreSQL PDO";
echo "</h3>\n";

echo "PHP version: ".PHP_VERSION;
echo "<br/>\n";
echo "OS: ". PHP_OS;
echo "<br/>\n";

$loadedExt = get_loaded_extensions();

$module_name = "pgsql";
if ( !in_array( $module_name, $loadedExt ) ) {
	$msg = "-- error, module <b>".$module_name."</b>  not loaded...";
	echo $msg;
	echo "<br/>\n";
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
} else {
	$msg = "-- ok, module <b>".$module_name."</b> is available...";
	echo $msg;
	echo "<br/>\n";
//https://www.php.net/manual/ru/function.get-extension-funcs.php
//echo "list of functions in module <b>".$module_name."</b>:<pre>";
//print_r(get_extension_funcs( $module_name ));
//echo "</pre>";
}

//------------------
$module_name = "PDO";
if ( !in_array( $module_name, $loadedExt ) ) {
	$msg = "-- error, module <b>".$module_name."</b> not loaded...";
	echo $msg;
	echo "<br/>\n";
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
} else {
	$msg = "-- ok, module <b>".$module_name."</b> is available...";
	echo $msg;
	echo "<br/>\n";
//https://www.php.net/manual/ru/function.get-extension-funcs.php
//echo "list of functions in module <b>".$module_name."</b>:<pre>";
//print_r(get_extension_funcs( $module_name ));
//echo "</pre>";
}

$module_name = "pdo_pgsql";
if ( !in_array( $module_name, $loadedExt ) ) {
	$msg = "-- error, <b>".$module_name."</b> module  not loaded...";
	echo $msg;
	echo "<br/>\n";
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
} else {
	$msg = "-- ok, module <b>".$module_name."</b> is available...";
	echo $msg;
	echo "<br/>\n";
}

runTest();

//========================================
function runTest(){
	global $_vars;

	$dbHost = $_vars["config"]["dbHost"];
	$dbPort = $_vars["config"]["dbPort"];
	$dbUser = $_vars["config"]["dbUser"];
	$dbPassword = $_vars["config"]["dbPassword"];
	$dbName = $_vars["config"]["dbName"];
	
	$dsn = "pgsql:dbname='{$dbName}'; host='{$dbHost}'; port='{$dbPort}'";

	try{
		$_vars["link"] = new PDO( $dsn, $dbUser, $dbPassword );
		echo "-- ok, connected to the server.";
		echo "<br/>\n";

		echo "<b>DSN</b>: ".$dsn;
		echo "<br/>\n";

		echo "<b>dbUser</b>: ".$dbUser;
		echo "<br/>\n";

//----------------------------------------------
		$_vars["dbVersion"] = _getVersion( $_vars["link"] );
		if( $_vars["dbVersion"] ){
echo "<b>version DB server</b>: ".$_vars["dbVersion"];
echo "<br/>\n";
		}
//----------------------------------------------
		unset ($connection);

	} catch( PDOException $exception ) {
		echo "-- error connection, ".$exception->getMessage();
		echo "<br/>\n";
	}//end catch

	
}//end runTest()

function _getVersion( $connection ){
// echo "PDOdrivers: <pre>";	
// print_r($connection->getAvailableDrivers());
// echo "</pre>";
// echo "<br/>\n";

	$query = "SELECT version() as version";
	$result  = $connection->query( $query );
	if( !$result ){
		echo "-- error, query: ".$query;
		echo "<br/>\n";
echo "error info: <pre>";	
print_r($connection->errorInfo() );
echo "</pre>";
		return false;
	}
	
	//$row = $result->fetch( PDO::FETCH_NUM );
	//return $row[0];
	$ver  = $result->fetchAll( PDO::FETCH_ASSOC );
	return $ver[0]["version"];
}//end _getVersion()


//----------------------------------------------
/*
	$_vars["dbVars"] = "";
	
	$query = "SELECT * FROM PG_SETTINGS";
	$result  = $connection->query( $query ) or die( $connection->errorInfo()[2] );
	$rows  = $result->fetchAll( PDO::FETCH_ASSOC );
//echo count($rows);	
//echo "<br/>\n";
	$vars = "";
	for( $n = 0; $n < count($rows); $n++){
		$name = $rows[$n]["name"];
		$value = $rows[$n]["setting"];
		$cat = $rows[$n]["category"];
		$shDesc = $rows[$n]["short_desc"];
		$item = "<b>Category</b>: ".$cat.", <b>name</b>: ".$name." = " .$value. ", <small>".$shDesc."</small>";

		$vars .= "<li>".$item. "</li>\n";
	}//next	
	$_vars["dbVars"] = "<ul>".$vars."</ul>";

echo 	$_vars["dbVars"];
echo "<br/>\n";
//echo "<pre>";	
//print_r($rows);
//echo "</pre>";	
*/

		
?>
