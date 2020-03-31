<?php
//https://www.php.net/manual/ru/function.date.php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

echo "Your PHP version: ". PHP_VERSION;
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

echo date("Y M j H:i:s");//current date
echo "<br>\n";

$time_stamp1 = 1682990400;
echo date("Y M j H:i:s", $time_stamp1);//2023 May 2 10:20:00
echo "<br>\n";

$time_stamp2 = 1436972400;
echo date("Y M j H:i:s", $time_stamp2);//2015 Jul 16 00:00:00
echo "<br>\n";

?>
