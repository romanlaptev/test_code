<?php

$password = "sUPErPassw0rd";

//https://www.php.net/manual/ru/function.md5.php
echo "md5 hash: ".md5( $password );
echo "<br/>";

//https://www.php.net/manual/ru/function.sha1.php
echo "sha1 hash: ".sha1( $password );
echo "<br/>";

//https://www.php.net/manual/ru/function.password-hash.php
//(PHP 5 >= 5.5.0, PHP 7)
echo "BCRYPT hash: ". password_hash( $password, PASSWORD_DEFAULT);
echo "<br/>";


?>


