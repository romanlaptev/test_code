<?php
echo "Your PHP version: ". PHP_VERSION;//5.6.40-0+deb8u7
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

$res = version_compare( PHP_VERSION, '5.3.0' );
echo "version_compare: ". $res;
echo "<br/>\n";

switch( $res ){

	case -1:
//echo PHP_VERSION;
echo phpversion();
echo "Your PHP version < 5.3.0" ;
echo "<br/>\n";
exit;
	break;
/*
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
*/
}//end switch

//====================== anonymous function
// PHP => 5.3.0
//https://www.php.net/manual/ru/functions.anonymous.php

$echoList = function ($str)
{
    foreach ($str as $v) {
        echo "$v<br />\n";
    }
};
$echoList( ['PHP', 'Python', 'Ruby', 'JavaScript'] );
?>
