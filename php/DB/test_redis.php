<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

echo "<h3>";
echo "test Redis Db";
echo "</h3>\n";

echo "PHP version: ".PHP_VERSION;
echo "; ";
echo "OS: ". PHP_OS;
echo "<br/>\n";

$loadedExt = get_loaded_extensions();

$module_name = "redis";
$_vars["support"][$module_name] = check_module( $module_name, $loadedExt);
if( !$_vars["support"][$module_name] ){
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
}

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

	$redis = new Redis();
	$redis->connect("127.0.0.1", 6379);
	echo $redis->ping();
	echo "<br/>\n";

	$info =  $redis->info();
	echo "Redis server version: ".$info['redis_version'];
	echo "<br/>\n";

	echo "List of key:";
	echo "<br/>\n";
	echo "<pre>\n";
	print_r( $redis->keys('*') );
	echo "<pre>\n";
	//$redis->getKeys();
	//return;

	$my_key =  $redis->get("key1");
	echo "get value for key1: ".$my_key;
	echo "<br/>\n";

	//set key on 1 min ( 1000 ms * 60 )
	echo "set value for test_key2: ";
	echo "<br/>\n";
	$redis->set("test_key2", "value2", 1000*60);


	//change database 0 -> db1
	//$redis->select(1);

	//echo "<pre>\n";
	//print_r( $redis );
	//echo "<pre>\n";

}//end runTest()


?>
