<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);
	
$_vars=array();
$_vars["config"]["dsn"] = "sqlite:".dirname(__FILE__)."/db1.sqlite";

$_vars["config"]["tableName"] = "taxonomy_index";

$_vars["sql"]["createTable"] = "CREATE TABLE IF NOT EXISTS `".$_vars["config"]["tableName"]."` (
`content_id` INTEGER  NOT NULL CHECK (content_id>= 0) DEFAULT 0,
`term_id` INTEGER NOT NULL CHECK (term_id>= 0) DEFAULT 0
);";

$_vars["sql"]["insertData"] = "REPLACE INTO `taxonomy_index` (`content_id`,`term_id`)VALUES ('724','137');";
$_vars["sql"]["insertData"] .= "REPLACE INTO `taxonomy_index` (`content_id`,`term_id`)VALUES ('726','137');";
$_vars["sql"]["insertData"] .= "REPLACE INTO `taxonomy_index` (`content_id`,`term_id`)VALUES ('727','137');";


//------------------------------ create table
$arg = array(
	//"connection" => $connection,
	"sql_query" => $_vars["sql"]["createTable"]
);
$response = runDBquery($arg);
//echo _logWrap($response);
if( $response["status"] ){
		$msg = "table ".$_vars["config"]["tableName"]." was created.";
		$_vars["log"][] = array("message" => $msg, "type" => "error");
} else {
		$msg = "error: table ".$_vars["config"]["tableName"]." was NOT created.";
		$_vars["log"][] = array("message" => $msg, "type" => "error");
}

//------------------------------ insert data
$arg = array(
	"sql_query" => $_vars["sql"]["insertData"],
	"query_type" => "exec"
);
$response = runDBquery($arg);
//echo _logWrap($response);
if( $response["status"] ){
		$msg = "data records inserted....";
		$_vars["log"][] = array("message" => $msg, "type" => "error");
} else {
		$msg = "error: data records NOT added.";
		$_vars["log"][] = array("message" => $msg, "type" => "error");
}


// LOG
if ( !empty( $_vars["log"] ) ) {
	for( $n = 0; $n < count( $_vars["log"] ); $n++){
	//for( $n = count( $_vars["log"] ) - 1; $n >= 0; $n--){
		$record = $_vars["log"][$n];
		echo _logWrap( $record["message"], $record["type"] );
	}//next
}

//======================================
function db_connect( $dsn ){
		global $_vars;
		try {
			$connection = new PDO( $dsn );
			$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			return $connection;
		} catch (Exception $e) {
			$_vars["log"][] = array("message" => $e, "type" => "error");
			return false;
		}	
}//end db_connect()


function runDBquery( $params=array() ){
	global $_vars;

	$p = array(
		"connection" => false,
		"sql_query" => "",
		"query_type" => "query" //"exec"
	);
	//extend options object $p
	foreach( $params as $key=>$item ){
		$p[ $key ] = $item;
	}//next
//echo _logWrap($p);

	$connection = $p["connection"];
	if( !$connection ){
		echo _logWrap("try connect to ".$_vars["config"]["dsn"] );
		//------------------------------ connect to DB
		$connection = db_connect( $_vars["config"]["dsn"] );
		if( !$connection){
			$msg = "error:  not connected to  ".$_vars["config"]["dsn"];
			$_vars["log"][] = array("message" => $msg, "type" => "error");
			//exit();
			return false;
		}
	}
//echo _logWrap($connection);

	if( empty( $p["sql_query"] ) ){
		echo _logWrap("wrong sql query");
		return false;
	} else {
		$sql_query = $p["sql_query"];
	}

	$result=false;
	switch ( $p["query_type"] ) {
		case "query":
			try{
				$result  = $connection->query( $sql_query );
			} catch( PDOException $e ) {
				//echo "Exception:". _logWrap($e);
				$msg =  "error info: ". $e->getMessage();
				$_vars["log"][] = array("message" => $msg, "type" => "error");
			}
		break;

		case "exec":
			try{
				$result  = $connection->exec( $sql_query );
			} catch( PDOException $e ) {
				//echo "Exception:". _logWrap($e);
				$msg =  "error info: ". $e->getMessage();
				$_vars["log"][] = array("message" => $msg, "type" => "error");
			}
		break;
		
	}//end switch

	if( !$result ){
		$msg =  "error, query: ".$sql_query;
		$_vars["log"][] = array("message" => $msg, "type" => "error");

		$msg =  "error info: ". _logWrap( $connection->errorInfo() );
		$_vars["log"][] = array("message" => $msg, "type" => "error");

		$arr = $connection->errorInfo();
		$desc = $arr[2];
		return array(
			"status" => false,
			"type" => "error",
			"description" => $desc
		);
	}

	$response = array(
		"status" => true,
		"type" => "success",
	);

	if( $p["query_type"] == "query" ){
		//$rows  = $result->fetchAll( PDO::FETCH_NUM );
		$rows  = $result->fetchAll( PDO::FETCH_ASSOC );
//echo count( $rows );
		if( count( $rows ) > 0 ){
			$response["data"] = $rows;
		}
	}

	return $response;
}//end runDBquery()



function _logWrap( $msg, $level = "info" ){

	// check API type
	$sapi_type = php_sapi_name();
//echo "php_sapi_name: ". $sapi_type;
//echo "<br/>\n";
//echo "type: ". gettype( $msg);
//echo "<br/>\n";

//-------------
	//$runType = "";
	//if ( $sapi_type == 'apache2handler' || 
	//		$sapi_type == 'cli-server'
		//) {
		$runType = "web";
	//}

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

	//if( gettype( $msg) !== "string"){
		//return false;
	//}

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

}//end _logWrap()

?>
