<?php
echo "Your PHP version: ". PHP_VERSION;//5.6.40-0+deb8u7
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

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
