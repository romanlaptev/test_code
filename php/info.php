<?php

echo "getcwd = ".getcwd();
echo "<br/>\n";

echo "__FILE__ : ".__FILE__;
echo "<br/>\n";
echo "__LINE__, num line in script file: ".__LINE__;
echo "<br/>\n";

echo "__DIR__ = ".__DIR__;
echo "<br/>\n";
echo "dirname(__FILE__) = ".dirname(__FILE__);
echo "<br/>\n";

//https://www.php.net/manual/en/function.version-compare.php
//if (version_compare(PHP_VERSION, '5.0.0', '>=')) {
    //echo 'I am at least PHP version 5.0.0, my version: ' . PHP_VERSION . "\n";
//}
//By default, version_compare() returns -1 if the first version is lower than the second, 0 if they are equal, and 1 if the second is lower. 
$res = version_compare( PHP_VERSION, '5.6.0' );
//echo "version_compare: ". $res;
//echo "<br/>\n";

switch( $res ){

	case -1:
//echo PHP_VERSION;
echo phpversion();
echo "Your PHP version < 5.6.0" ;
echo "<br/>\n";
	break;

	case 0:
echo phpversion();
echo "Your PHP version === 5.6.0" ;
echo "<br/>\n";
	break;

	case 1:
echo phpversion();
echo "Your PHP version > 5.6.0" ;
echo "<br/>\n";
	break;

}//end switch


echo "<pre>";
//http://php.net/manual/ru/function.ini-get-all.php
print_r(ini_get_all());
echo "</pre>";
echo '\n';

echo "<pre>";
foreach (getallheaders() as $name => $value)
{
	echo $name.": ".$value."<br>\n";
}

echo "</pre>";
echo "<hr>";

echo "<h1>headers_list</h1>";
$arr=headers_list();
echo "<pre>";
print_r($arr);
echo "</pre>";
echo "<hr>";

echo "<h1> Server variables </h1>";
echo "<pre>\n";

echo "<h2>GLOBALS</h2>\n";
print_r ($GLOBALS);
echo "<hr>\n";

echo "<h2>SERVER</h2>\n";
print_r ($_SERVER);
echo "<hr>\n";

echo "<h2>REQUEST</h2>\n";
print_r ($_REQUEST);
echo "<hr>\n";

echo "<h2>GET</h2>\n";
print_r ($_GET);
echo "<hr>\n";

echo "<h2>POST</h2>\n";
print_r ($_POST);
echo "<hr>\n";

echo "<h2>COOKIE</h2>\n";
print_r ($_COOKIE);
echo "<hr>\n";

echo "<h2>SESSION</h2>\n";
print_r ($_SESSION);
echo "<hr>\n";

echo "<h2>FILES</h2>\n";
print_r ($_FILES);
echo "<hr>\n";

echo "<h2>ENV</h2>\n";
print_r ($_ENV);
echo "<hr>\n";

echo "</pre>";

echo "<hr>";

phpinfo();

echo "List of the defined constants: <pre>";
print_r( get_defined_constants() );
echo "<pre>\n";

?>
