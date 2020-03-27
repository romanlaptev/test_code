<?php

$password = "sUPErPassw0rd";

//https://www.php.net/manual/ru/function.md5.php
echo "md5 hash: ".md5( $password );
echo "<br/>\n";

//https://www.php.net/manual/ru/function.sha1.php
echo "sha1 hash: ".sha1( $password );
echo "<br/>\n";

//https://www.php.net/manual/ru/function.password-hash.php
//(PHP 5 >= 5.5.0, PHP 7)
echo "BCRYPT hash: ". password_hash( $password, PASSWORD_DEFAULT);
echo "<br/>\n";

//https://www.php.net/manual/ru/function.crypt.php
$salt ="rl";
$hashed_password = crypt( $password, $salt );
echo "crypt hash: ". $hashed_password;
echo "<br/>\n";

$user_input = "sUPErPassw0rD";
if ( hash_equals ($hashed_password, crypt($user_input, $hashed_password))) {
   echo "Ok, you are is not an enemy...\n";
} else {
   echo "Access denied...\n";
}

$user_input = "SUPErPassw0rD";
if ( hash_equals ($hashed_password, crypt($user_input, $hashed_password))) {
   echo "Ok, you are is not an enemy...\n";
} else {
   echo "Access denied...\n";
}

?>


