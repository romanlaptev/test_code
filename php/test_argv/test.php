<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

//echo $argc;
//echo "\n";
//echo count($argv);

$pos = -1;
$params = array();
$params["offset"] = 0;

for( $n = 1; $n < count($argv); $n++){
//echo $argv[$n]. ", ".gettype($argv[$n]);
//echo "\n";
	$pos = strpos( $argv[$n], "source-file=");
//echo "pos: ".$pos. ", ".gettype($pos);
//echo "\n";
	if( $pos !== false ){
		$arr = explode( "=", $argv[$n]);
		$params["source_file"] = $arr[1];
	}

	$pos = strpos( $argv[$n], "bytes=");
	if( $pos !== false ){
		$arr = explode( "=", $argv[$n]);
		$params["bytes"] = $arr[1];
	}
	$pos = strpos( $argv[$n], "offset=");
	if( $pos !== false ){
		$arr = explode( "=", $argv[$n]);
		$params["offset"] = $arr[1];
	}

}//next
//print_r($params);
//exit;

if( !isset($params["source_file"]) ){
	exit("-- error, required argument 'source-file' not defined\n");
}
if( !isset($params["bytes"]) ){
	exit("-- error, required argument 'bytes' not defined\n");
}
if( !isset($params["offset"]) ){
	$offset = 0;
} else {
	$offset = $params["offset"];
}

$filename = $params["source_file"];
$bytes = $params["bytes"];

//https://www.php.net/manual/ru/function.fseek.php
//$offset = 102400;

//echo "File: ".$filename.", file size(bytes):". filesize($filename);
//echo "\n";

$file1 = fopen( $filename, "r");
if(!$file1){
	echo "File open error..";
	echo "\n";
	exit;
}

fseek ( $file1, $offset , SEEK_SET );
$buffer=fread ($file1, $bytes);
echo $buffer;
echo "\n";

//fwrite($file2, $buffer, $size);
//fseek ( $file1, -1 , SEEK_CUR );
//fclose($file2);
fclose ( $file1 );

?>