<?php
//echo "Content-type: text/html\n";
//echo "\n";

// check API type
$sapi_type = php_sapi_name();
echo "php_sapi_name: ". $sapi_type;
echo "<br/>\n";

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
