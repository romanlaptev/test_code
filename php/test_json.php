<?php

$arr = [
    'employee' => 'Иван Иванов',
    'phones' => [
        '916 153 2854',
        '916 643 8420'
    ]
];
echo json_encode($arr);
echo "<br />\n";
//------------

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
echo "<br />\n";

//------------
$json = '{"employee":"Иван Иванов","phones":["916 153 2854","916 643 8420"]}';
$arr = json_decode($json, false);
echo "<pre>";
print_r($arr);
echo "</pre>\n";

//------------
$arr = json_decode($json, true);
echo "<pre>";
print_r($arr);
echo "</pre>\n";

/*
		//http://php.net/manual/ru/function.json-encode.php
		//PHP 5 >= 5.2.0
		if ( !function_exists("json_decode") ){
$msg = "server error, not support function <b>json_decode(), required PHP >= 5.2.0, server PHP == ".phpversion();
			$msg_type = "error";
			$_vars["log"][] = array("message" => $msg, "type" => $msg_type);
			return false;
		}	
		//PHP 5 >= 5.3.0
		if ( !function_exists("json_last_error") ){ 
$msg = "server error, not support function <b>json_last_error()</b>, required PHP >= 5.3.0, server PHP == ".phpversion();
			$msg_type = "error";
			$_vars["log"][] = array("message" => $msg, "type" => $msg_type);
			return false;
		}	
*/

/*	
		$visited_products_cookies=$_COOKIE['visited_products_arr'];
		$visited_products_arr_cookies = json_decode($visited_products_cookies, true);
		switch (json_last_error()) 
		{
			case JSON_ERROR_NONE:
				echo ' - No errors';
			break;
			case JSON_ERROR_DEPTH:
				echo ' - Maximum stack depth exceeded';
			break;
			case JSON_ERROR_STATE_MISMATCH:
				echo ' - Underflow or the modes mismatch';
			break;
			case JSON_ERROR_CTRL_CHAR:
				echo ' - Unexpected control character found';
			break;
			case JSON_ERROR_SYNTAX:
				echo ' - Syntax error, malformed JSON';
			break;
			case JSON_ERROR_UTF8:
				echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
			break;
			default:
				echo ' - Unknown error';
			break;
		}
*/

?>

