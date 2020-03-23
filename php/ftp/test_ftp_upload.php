<?php
//https://www.php.net/manual/ru/function.ftp-connect.php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$module_name = "ftp";
$loadedExt = get_loaded_extensions();
if ( !in_array( $module_name, $loadedExt ) ) {
	$msg = "<p>-- error, <b>".$module_name."</b> module  is not in the list of loaded extensions...</p>\n";
	echo $msg;
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
}

$local_file="_vsftpd.conf";
$remote_file= "test_upload.txt";

//$ftp_server='ftp.narod.ru';
//$ftp_username='roman-laptev';
//$ftp_pwd='';

$ftp_server="vbox1";
$ftp_username="anonymous";
$ftp_pwd="user@example.com";
$ftp_port = 21;
$ftp_timeout = 60;//sec.

$conn_id = ftp_connect($ftp_server, $ftp_port, $ftp_timeout);
if( !$conn_id ){
	echo "Could not connect to ".$ftp_server;
	echo "\n";
	exit;
}
	
$login_result = ftp_login( $conn_id, $ftp_username, $ftp_pwd );
if( !$login_result ){
	echo "Could not login to ".$ftp_server;
	echo "\n";
	ftp_close($conn_id);
	exit;
}

ftp_chdir ($conn_id,"pub");
echo ftp_pwd($conn_id)."\n";

$res = ftp_put( $conn_id, $remote_file, $local_file, FTP_ASCII);
if ( !$res ) {
	echo "Failed to upload $local_file as $remote_file to ".$ftp_server;
	echo "\n";
}

//----------------------------
$remote_file = "test_delete.txt";
$res = ftp_put( $conn_id, $remote_file, $local_file, FTP_ASCII);
if ( !$res ) {
	echo "Failed to upload $local_file as $remote_file to ".$ftp_server;
	echo "\n";
}

if ( ftp_delete($conn_id, $remote_file) ) {
    echo $remote_file." was deleted successful\n";
} else  {
    echo "could not delete $remote_file\n";
}

ftp_close($conn_id);

?>

