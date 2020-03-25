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
