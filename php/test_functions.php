<?php
echo PHP_VERSION;//5.6.40-0+deb8u7
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

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


//========================== default parameters, https://github.com/igorsimdyanov
function getSum($left = 10, $right = 5)
{
    $sum = $left + $right;
    return $sum;
}
echo getSum();     // 5
echo "<br/>\n";

echo getSum(5);    //10
echo "<br/>\n";

echo getSum(5, 0); //5
echo "<br/>\n";


//====================== send any number of arguments, https://github.com/igorsimdyanov
//By default, version_compare() returns -1 if the first version is lower than the second, 0 if they are equal, and 1 if the second is lower. 
$res = version_compare( PHP_VERSION, '5.6.0' );
switch( $res ){
	case -1:
	break;

	case 0:
	case 1:
{
	function echoList(...$items)// "..." -!!!!! PHP => 5.6
	{
		foreach ($items as $v) {
		    echo "$v<br />\n";
		}
	}
	echoList('PHP', 'Python', 'Ruby', 'JavaScript');
}
	break;

}//end switch
?>
