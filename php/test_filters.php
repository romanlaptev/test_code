<?php
//https://www.php.net/manual/ru/function.filter-var.php
//(PHP 5 >= 5.2.0, PHP 7)

_filter( 'igorsimdyanov@gmail.com' );
_filter( 'igorsimdyanov@//gmail.com' );

function _filter( $addr ){
	$res = filter_var( $addr, FILTER_VALIDATE_EMAIL );
	if( !$res ){
		echo "Wrong email: ". $addr;
		echo "<br/>\n";
	} else {
		echo "Correct email: ". $res;
		echo "<br/>\n";
	}
}

//==========================
echo filter_var('params=Привет мир!', FILTER_SANITIZE_ENCODED);
// params%3D%D0%9F%D1%80%D0%B8%D0%B2%D0%B5%D1%82%20%D0%BC%D0%B8%D1%80%21
echo "<br/>\n";

//======================
$arr = [
    'Deb\'s files',
    'Symbol \\',
    'print "Hello world!"'
];
echo '<pre>';
print_r($arr);
$result = filter_var_array( $arr, FILTER_SANITIZE_MAGIC_QUOTES );
print_r( $result );
echo '</pre>';

echo "<br/>\n";

