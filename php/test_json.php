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
$rpc_request = '{ "request_data": [ { "title":"item1", "content_type":"page", "body_format":"plain_text", "body_value":"test1" }, { "title":"item2", "content_type":"note", "body_format":"full_html", "body_value":"test2" } ] }';

		//https://www.php.net/manual/ru/function.json-decode.php
		$request_data = json_decode($rpc_request, true);
		
		$msg_type = "error";
		switch ( json_last_error() ) {
			case JSON_ERROR_NONE:
				$msg_type = "success";
				$msg = "No errors";
echo _logWrap( $request_data );
			break;
			case JSON_ERROR_DEPTH:
				$msg = "Maximum stack depth exceeded";
			break;
			case JSON_ERROR_STATE_MISMATCH:
				$msg = "Underflow or the modes mismatch";
			break;
			case JSON_ERROR_CTRL_CHAR:
				$msg = "Unexpected control character found";
			break;
			case JSON_ERROR_SYNTAX:
				$msg = "Syntax error, malformed JSON";
			break;
			case JSON_ERROR_UTF8:
				$msg = "Malformed UTF-8 characters, possibly incorrectly encoded";
			break;
			default:
				$msg = "Unknown error";
			break;
		}
		$_vars["log"][] = array("message" => $msg, "type" => $msg_type);
echo "<pre>";
print_r($_vars["log"]);
echo "</pre>\n";

*/

?>

