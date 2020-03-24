<?php
//send variable $a to the function as link
$a = 1;

$b = func1( $a );

echo "a = ".$a;//2, function func1( &$a )!!!!!
echo "<br/>\n";

echo "b = ".$b;//2
echo "<br/>\n";

function func1( &$a ){//!!!!!
	return ++$a;
}

//========================
$arr1 = [1, 2, 3];

func2( $arr1 );

echo "<pre>\n";
print_r( $arr1 );
echo "</pre>\n";

function func2( array &$arr1 ){
	$arr1[0] = 4;
	$arr1[1] = 5;
	$arr1[2] = 6;
}//end

//========================
$c = func3();
echo "c = ".$c;
echo "<br/>\n";

//function func3() : int //PHP 7
function func3()
{
	$_a = 8;
	return ++$_a;
}//end


//======================== send OPTIONS array
//$arguments = [ "a" => 1, "b" => 2, "c" => 3];
$arguments = [
	"data" => [ "a" => 1, "b" => 2, "c" => 3],
	"wrapType" => "menu2",
	"templateID" =>  "tpl-copyright",
	"templateListItemID" => "tpl-schedule-table--tr"
];

func4( $arguments );

function func4( $params ) {
	$p = [
		"data" => null,
		"type"  =>  "list",
		"wrapType" => "menu",
		"templateID" =>  false,
		"templateListItemID" => false
	];

	//extend options object $p
	foreach( $params as $key=>$item ){
		$p[ $key ] = $item;
	}//next

echo "<pre>\n";
print_r( $p );
echo "</pre>\n";
}//end



?>
