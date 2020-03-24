<?php
echo PHP_VERSION;//5.6.40-0+deb8u7
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

//====================== send any number of arguments, https://github.com/igorsimdyanov
function echoList(...$items)// "..." -!!!!! PHP => 5.6
{
	foreach ($items as $v) {
	    echo "$v<br />\n";
	}
}
echoList( 'PHP', 'Python', 'Ruby', 'JavaScript' );

?>
