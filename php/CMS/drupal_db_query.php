<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);


chdir ("/home/www/sites/mydb");
//echo getcwd(); 
//echo "<br>";

// Define default settings.
define('DRUPAL_ROOT', getcwd() );
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

// Bootstrap Drupal.
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

//------------------------------- get exists DB nodes
	//$sql_query = "SELECT nid, title, created FROM node GROUP BY created;";
	$sql_query = "SELECT nid, title, created FROM node ORDER BY created;";
echo "sql: ".  $sql_query;
echo "<br/>";

	$result = db_query($sql_query);
	foreach ($result as $row) {
		$content[] = $row;
	}//next

echo "Num elements: ".  count( $content );
echo "<br/>";

echo "<pre>";
print_r($content);
echo "</pre>";
	

?>
