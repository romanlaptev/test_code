<?php
// the message
$msg = "TESTMAIL";
$headers = "From: test@santeh-expert.kz " . "\r\n";
$rr = mail("telhin@inbox.ru","My subject",$msg, $headers);
print_r(error_get_last());
print_r($rr);
var_dump($rr);
?>