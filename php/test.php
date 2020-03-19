<?php
//echo "Content-type: text/html\n";
//echo "\n";

//echo "<pre>";
//print_r(PDO::getAvailableDrivers());
//echo "</pre>";

$loadedExt = get_loaded_extensions();
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";

phpinfo ();
phpinfo(INFO_MODULES);


//for ($n1=0;$n1<10;$n1++){
//	echo $n1." Hello PHP world!<br>\n";
//}
?>
