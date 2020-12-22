<?php

//$from = "roman.v.laptev@gmail.com";
$from = "root";
$to_addr = "roman-laptev@yandex.ru";
$subject = "test message from ".$from;
$headers = "MIME-Version: 1.0\r\n";
$headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: ' . $from . "\r\n";
$body = "test message from ".$from;

if ( mail($to_addr, $subject, $body, $headers) ) {
	echo 'send letter';
} else {
  echo 'error send letter';
}

?>
