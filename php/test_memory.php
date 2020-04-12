<?php

require "utils.php";

$a = "abcdefgh";
echo _logWrap( "Memory usage: ","info");
echo _logWrap("- bytes: ". memory_get_usage(), "info" );
echo _logWrap("- Kbytes: ". memory_get_usage() / 1024, "info");
echo _logWrap("- Mbytes: ". ( memory_get_usage() / 1024 ) /1024, "info" );

?>