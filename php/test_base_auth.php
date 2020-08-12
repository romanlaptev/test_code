<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

//$_SERVER['PHP_AUTH_USER'] = false;
//$_SERVER['PHP_AUTH_PW'] = false;
if( !empty($_REQUEST['q']) && $_REQUEST['q'] == "exit" ){
	//$_SERVER['PHP_AUTH_USER'] = false;
	//$_SERVER['PHP_AUTH_PW'] = false;
	unset($_SERVER['PHP_AUTH_USER']);
	unset($_SERVER['PHP_AUTH_PW']);

	//unset($_REQUEST['q']);
//echo "<pre>";
//print_r($_REQUEST);
//echo "</pre>";

	//$_SESSION['is_auth'] = false;
//echo "EXIT";
//echo "<br/>";
	//header("Location:".$_SERVER["SCRIPT_NAME"]);
}

//session_start();

//if( !isset($_SESSION['is_auth']) ){
	//$_SESSION['is_auth'] = false;
//}
//session_destroy();

//echo "<pre>";
//print_r($_REQUEST);
//print_r($_SESSION);
//print_r($_COOKIE);
//echo "</pre>";

echo "PHP_AUTH_USER: ".$_SERVER['PHP_AUTH_USER'];
echo "<br/>";
echo "PHP_AUTH_PW: ".$_SERVER['PHP_AUTH_PW'];
echo "<br/>";

if( $_SERVER['PHP_AUTH_USER'] !== "root" ){
	header("WWW-Authenticate: Basic realm=\"Admin page\"");
	header("HTTP/1.0 401 Unauthorized");
	exit();
}
//if( $_SERVER['PHP_AUTH_PW'] !== "master" ){
if( md5($_SERVER['PHP_AUTH_PW'])  !== "eb0a191797624dd3a48fa681d3061212"){
	header("WWW-Authenticate: Basic realm=\"Admin page\"");
	header("HTTP/1.0 401 Unauthorized");
	exit();
}
?>

<h1>Admin page</h1>
<h3>Hello <?php echo $_SERVER['PHP_AUTH_USER'] ?></h3>
<a href="?q=exit">Exit</a>
