<?php
echo "Your PHP version: ". PHP_VERSION;//5.6.40-0+deb8u7
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";


//========================
$c = func3();
echo "c = ".$c;
echo "<br/>\n";

function func3() : int //PHP 7
{
	$_a = 8;
	return ++$_a;
}//end

?>
