<?php
//https://www.php.net/manual/ru/ziparchive.open.php
//https://webfanat.com/article_id/?id=186
//error_reporting (E_ERROR | E_WARNING | E_PARSE);

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$module_name = "zip";
$loadedExt = get_loaded_extensions();
if ( !in_array( $module_name, $loadedExt ) ) {
	$msg = "<p>-- error, <b>".$module_name."</b> module  is not in the list of loaded extensions...</p>\n";
	echo $msg;
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
}

echo "Create zip archive<br>\n";

$zip = new ZipArchive();
$filePath = __DIR__."/new.zip";
$zippedFileName = __FILE__;

$res = $zip->open( $filePath, ZIPARCHIVE::CREATE);
if( $res === true ){
	$zip->addFile( basename( $zippedFileName ) );
	echo "Create ".$filePath." and add ". $zippedFileName."<br>\n";
} else {
	echo "-- error code: ". $res;
/*
ZipArchive::ER_SEEK     4    Seek error.
ZipArchive::ER_READ     5    Read error.
ZipArchive::ER_NOENT     9    No such file.
ZipArchive::ER_OPEN     11    Can't open file.
ZipArchive::ER_EXISTS     10    File already exists.
ZipArchive::ER_MEMORY 14    Malloc failure.
ZipArchive::ER_INVAL     18    Invalid argument.
ZipArchive::ER_NOZIP     19    Not a zip archive.
ZipArchive::ER_INCONS     21    Zip archive inconsistent
*/
}

$zip->close();
?>
