<?php
//https://www.php.net/manual/ru/function.date.php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

echo "Your PHP version: ". PHP_VERSION;
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

date_default_timezone_set('Asia/Novosibirsk');

//Last modified: March 31 2020 22:21:09.
echo "Last modified: " . date ("F d Y H:i:s.");
echo "<br>\n";

//Last modified: 22:21:09, 31.03.2020
$today = date("H:i:s, d.m.Y");
echo "Last modified: " . $today;
echo "<br>\n";

//Last modified: 31-03-2020_22-21
$today = date("d-m-Y_H-i");
echo "Last modified: " . $today;
echo "<br>\n";

//2020 Mar 31 22:21:09
echo date("Y M j H:i:s");//current date
echo "<br>\n";

//2023 May 2 08:20:00
$time_stamp1 = 1682990400;
echo date("Y M j H:i:s", $time_stamp1);//2023 May 2 10:20:00
echo "<br>\n";

//2015 Jul 15 22:00:00
$time_stamp2 = 1436972400;
echo date("Y M j H:i:s", $time_stamp2);//2015 Jul 16 00:00:00
echo "<br>\n";

?>
