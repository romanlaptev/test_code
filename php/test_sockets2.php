<?php
$s = fsockopen("lib.wallst.ru",80);

//GET index.html (/)
fputs($s, "GET / HTTP/1.0\n\n");

while (!feof($s)) {
	echo fgets($s,1000);
}

fclose($s);
?>
