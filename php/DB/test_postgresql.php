<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

//echo "<pre>";
//print_r ($_REQUEST);
//echo "</pre>";

echo "test PostgreSQL PDO";
echo "<br/>\n";

echo "PHP version: ".PHP_VERSION;
echo "<br/>\n";

echo "OS: ". PHP_OS;
echo "<br/>\n";

$_vars=array();
//	$_vars["config"]["dbHost"] = "ec2-184-73-189-190.compute-1.amazonaws.com";
//	$_vars["config"]["dbPort"] = "5432";
//	$_vars["config"]["dbUser"] = "aejvwysqgsboeb";
//	$_vars["config"]["dbPassword"] = "55b5c22131c1d612574edb5dea0b63433293d828ab1f77196f52eb0a849a577c";
//	$_vars["config"]["dbName"] = "d7c534mf7866o2";

$_vars["config"]["dbHost"] = "localhost";
$_vars["config"]["dbPort"] = "5432";
$_vars["config"]["dbUser"] = "postgres";
$_vars["config"]["dbPassword"] = "master";
$_vars["config"]["dbName"] = "";


//echo "PDO::ATTR_DRIVER_NAME: ".PDO::ATTR_DRIVER_NAME;
//echo "\n";

	
$dbHost = $_vars["config"]["dbHost"];
$dbPort = $_vars["config"]["dbPort"];
$dbUser = $_vars["config"]["dbUser"];
$dbPassword = $_vars["config"]["dbPassword"];
$dbName = $_vars["config"]["dbName"];
	
$dsn = "pgsql:dbname='{$dbName}'; host='{$dbHost}'; port='{$dbPort}'";
//$dsn = "pgsql:host='{$dbHost}'; port='{$dbPort}'";
	
try{

    $_vars["link"] = new PDO( $dsn, $dbUser, $dbPassword );
    echo "-- ok, connected to the server.... DSN: ".$dsn;
    echo "<br/>\n";

	_test();

	unset ($connection);

} catch( PDOException $exception ) {
    echo "-- error connection, ".$exception->getMessage();
    echo "<br/>\n";
}



function _test(){
	global $_vars;
	
	$connection = $_vars["link"];
	
//	$_vars["PDOdrivers"] = $connection->getAvailableDrivers();
//echo "PDOdrivers: <pre>";	
//print_r($connection->getAvailableDrivers());
//echo "</pre>";
//echo "<br/>\n";

//----------------------------------------------
	$_vars["dbVersion"] = "";
	$query = "SELECT version()";
	$result  = $connection->query( $query ) or die( $connection->errorInfo()[2] );
	$row = $result->fetch( PDO::FETCH_NUM );
	$_vars["dbVersion"] .= $row[0];
echo "version DB server: ".$_vars["dbVersion"];
echo "<br/>\n";
	

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
	
}//end _test()

		
?>
