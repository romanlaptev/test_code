<?php
//echo "PHP version: ".PHP_VERSION;
//echo "; ";
//echo "OS: ". PHP_OS;
//echo "<br/>\n";

//error_reporting(E_ALL|E_STRICT);
//ini_set('display_errors', 1);

/*
$sapi_type = php_sapi_name();

$_vars["runType"] = "";
if ( $sapi_type == 'apache2handler' || $sapi_type == 'cli-server') {
	$_vars["runType"] = "web";
	formPageHeader();
}
if ( $sapi_type == 'cli') {
	$_vars["runType"] = "console";
}
if ( $sapi_type == 'cgi') {
	$_vars["runType"] = "console";
}
$msg = "Run method (php_sapi_name): ". $sapi_type;
echo logAlert($msg, "info");
*/


//============================
function logAlert( $msg, $level){
//global $sapi_type;
global $_vars;
	switch ($level) {
		case "info":
			if ( $_vars["runType"] == "web" ) {
				return "<div class='alert alert-info'>".$msg."</div>";
			}
			if ( $_vars["runType"] == "console" ) {
				return $msg."\n";
			}
		break;
		
		case "warning":
			if ( $_vars["runType"] == "web" ) {
				return "<div class='alert alert-warning'>".$msg. "</div>";
			}
			if ( $_vars["runType"] == "console" ) {
				return $msg."\n";
			}
		break;
		
		case "danger":
		case "error":
			if ( $_vars["runType"] == "web" ) {
				return "<div class='alert alert-danger'>".$msg. "</div>";
			}
			if ( $_vars["runType"] == "console" ) {
				return $msg."\n";
			}
		break;
		
		case "success":
			if ( $_vars["runType"] == "web" ) {
				return "<div class='alert alert-success'>".$msg. "</div>";
			}
			if ( $_vars["runType"] == "console" ) {
				return $msg."\n";
			}
		break;
		
		default:
			if ( $_vars["runType"] == "web" ) {
				return $msg. "<br/>";
			}
			if ( $_vars["runType"] == "console" ) {
				return $msg."\n";
			}
		break;
	}//end switch

}//end logAlert()


function _log($arr){
	$out = "<pre>".print_r($arr,1)."</pre>\n";
	return $out;
}

?>
