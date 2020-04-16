<?php
ini_set("session.gc_maxlifetime", 60 );//86400 sec
ini_set("session.gc_probability", 10 );
ini_set("session.gc_divisor", 1 );

ini_set("session.use_cookies", 0 );
//+ini_set("session.cookie_lifetime", 90);
//$lifetime=90;
//session_set_cookie_params($lifetime);

session_start();

echo "session.save_handler: ". ini_get("session.save_handler");
echo "<br>";
echo "session.save_path: ". ini_get("session.save_path");
echo "<br>";

echo "session.gc_maxlifetime: ". ini_get("session.gc_maxlifetime") . "sec";
echo "<br>";
echo "session.gc_probability: ". ini_get("session.gc_probability");
echo "<br>";
echo "session.gc_divisor: ". ini_get("session.gc_divisor");
echo "<br>";
echo "session.use_cookies: ". ini_get("session.use_cookies");
echo "<br>";
echo "session.cookie_lifetime: ". ini_get("session.cookie_lifetime");
echo "<br>";

if( isset($_SESSION['username']) ){
  echo "<h1>Hello, ".$_SESSION['username'].", page2</h1>";
} else {
  echo "<h1>Hello, anonymous...</h1>";
}
echo "SESSION:<pre>";
print_r($_SESSION);
echo "</pre>";

echo "COOKIE:<pre>";
print_r($_COOKIE);
echo "</pre>";

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>


<ul>
	<li><a href="page1.php">page1</a></li>
	<li><a href="page3.php">page3</a></li>
</ul>

</body>
</html>
