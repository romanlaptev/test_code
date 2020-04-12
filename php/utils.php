<?php
//echo "PHP version: ".PHP_VERSION;
//echo "; ";
//echo "OS: ". PHP_OS;
//echo "<br/>\n";

//error_reporting(E_ALL|E_STRICT);
//ini_set('display_errors', 1);

/*
//https://www.php.net/manual/en/function.version-compare.php
//if (version_compare(PHP_VERSION, '5.0.0', '>=')) {
    //echo 'I am at least PHP version 5.0.0, my version: ' . PHP_VERSION . "\n";
//}
//By default, version_compare() returns -1 if the first version is lower than the second, 0 if they are equal, and 1 if the second is lower. 

$required_ver = '5.1.0';
$res = version_compare( PHP_VERSION,  $required_ver );
echo "version_compare: ". $res;
echo "<br/>\n";

switch( $res ){

	case -1:
//echo PHP_VERSION;
echo phpversion();
echo "Your PHP version < ".$required_ver ;
echo "<br/>\n";
	break;

	case 0:
echo phpversion();
echo "Your PHP version === ".$required_ver ;
echo "<br/>\n";
	break;

	case 1:
echo phpversion();
echo "Your PHP version > ".$required_ver ;
echo "<br/>\n";
	break;

}//end switch


*/

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
echo _log( $msg, "info" );
*/


//============================
function _log( $msg, $level){

	// check API type
	$sapi_type = php_sapi_name();
//echo "php_sapi_name: ". $sapi_type;
//echo "<br/>\n";
//echo "type: ". gettype( $msg);
//echo "<br/>\n";

//-------------
	$runType = "";
	if ( $sapi_type == 'apache2handler' || 
			$sapi_type == 'cli-server'
		) {
		$runType = "web";
	}

	if ( $sapi_type == "cli" ) { $runType = "console"; }
	if ( $sapi_type == "cgi" ) { $runType = "console"; }

//-------------
	if( gettype( $msg) === "array" || 
		gettype( $msg) === "object"
	){
			if ( $runType == "web" ) {
				$out = "<pre>".print_r($msg,1)."</pre>";
				return $out;
			} else {
				$out = print_r($msg,1)."\n";
				return $out;
			}
	}

	if( gettype( $msg) !== "string"){
		return false;
	}

//-------------
	switch ($level) {
		case "info":
			if ( $runType == "web" ) {
				return "<div class='alert alert-info'>".$msg."</div>";
			}
			if ( $runType == "console" ) {
				return $msg."\n";
			}
		break;
		
		case "warning":
			if ( $runType == "web" ) {
				return "<div class='alert alert-warning'>".$msg. "</div>";
			}
			if ( $runType == "console" ) {
				return $msg."\n";
			}
		break;
		
		case "danger":
		case "error":
			if ( $runType == "web" ) {
				return "<div class='alert alert-danger'>".$msg. "</div>";
			}
			if ( $runType == "console" ) {
				return $msg."\n";
			}
		break;
		
		case "success":
			if ( $runType == "web" ) {
				return "<div class='alert alert-success'>".$msg. "</div>";
			}
			if ( $runType == "console" ) {
				return $msg."\n";
			}
		break;
		
		default:
			if ( $runType == "web" ) {
				return $msg. "<br/>";
			}
			if ( $runType == "console" ) {
				return $msg."\n";
			}
		break;
	}//end switch

}//end _log()


?>
