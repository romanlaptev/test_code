<?php
//https://www.php.net/manual/ru/language.exceptions.php
//https://www.php.net/manual/ru/class.errorexception.php

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

echo "Your PHP version: ". PHP_VERSION;
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

$a = 1;
try{
	if( $a === 1 ){

		$err_message="error, variable must be not equal to 1";
		$err_code=1;
		throw new Exception(
			$err_message, 
			$err_code
		);

	}
} catch( Exception $e){

	echo "Catch exception, code: ".$e->getCode().", message: ".$e->getMessage();
	echo "<br/>\n";

    echo "File: ".$e->getFile();
	echo "<br/>\n";

    echo "line: ".$e->getLine();
	echo "<br/>\n";

    echo "trace: ".$e->getTraceAsString();
	echo "<br/>\n";

echo "<pre>\n";
print_r( $e );
echo "</pre>\n";

//} finally {//=>PHP 5.5 
	//echo "this is the end....";
	//echo "<br/>\n";
}//end catch

?>
