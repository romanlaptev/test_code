<?php
$dbData = array( 
	1589594399 => array( 
		"id" => 550,
		"title" => "video1",
		"created" => 1589594399,
		"changed" => 1589594399,
		"body_value" => "test1",
		"type_id" => 7
	)
);

$xmlData = array( 
	1589594399 => array( 
		//"id" => 2458,
		"title" => "video1",
		"created" => 1589594399,
		"changed" => 1589594399,
		"body_value" => "test2",
		"type_id" => 0
	),
	1590213479 => array( 
		//"id" => 2459,
		"title" => "301 редирект, .htaccess",
		"created" => 1590213479,
		"changed" => 1590213479,
		"body_value" => "1111111111",
		"type_id" => 7
	),
	1590213459 => array( 
		//"id" => 2460,
		"title" => "Debian 7, wheezy, list repo",
		"created" => 1589594399,
		"changed" => 1589594399,
		"body_value" => "parent",
		"type_id" => 7
	),
);

//$new_table = array_merge ($dbData, $xmlData);
$new_table = $xmlData + $dbData;
print_r( $new_table );
echo "\n";

?>
