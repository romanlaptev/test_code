<?php
echo "Your PHP version: ". PHP_VERSION;//5.6.40-0+deb8u7
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

//send variable $a to the function as link
$a = 1;
$d = 100;

$b = func1( $a );

echo "a = ".$a;//2, function func1( &$a )!!!!!
echo "<br/>\n";

echo "b = ".$b;//2
echo "<br/>\n";

echo "d = ".$d;//101
echo "<br/>\n";

echo "e = ".$e;
echo "<br/>\n";

function func1( &$a ){//!!!!!

	global $d;//use global variable
	$d += $a;

	global $e;//define new global variable
	$e = 200;

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

//========================== Return array
function formatSize($bytes)
{
    $kbytes = $bytes / 1024;
    $mbytes = $kbytes / 1024;
    $gbytes = $mbytes / 1024;

	//return ["bytes" => $bytes, "kbytes" => $kbytes, "mbytes" => $mbytes, "gbytes" => $gbytes];
    return [$bytes, $kbytes, $mbytes, $gbytes];
}
//-------- dynamic creation of variables
list ($bytes, $kbytes, $mbytes, $gbytes) = formatSize(18642678);
echo "Mbytes: " . $mbytes;
echo "<br/>\n";

//--------
function formatSize2($bytes)
{
	list ($bytes, $kbytes, $mbytes, $gbytes) = formatSize($bytes);
	return ["bytes" => $bytes, "kbytes" => $kbytes, "mbytes" => $mbytes, "gbytes" => $gbytes];
}

echo "File size:";
echo "<pre>\n";
print_r( formatSize2( 2097152 ) );
echo "</pre>\n";



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

//============================= STATIC variable
function counter()
{
    static $counter = 0;//!!!!!!!!!!!!!!!!!!!!!!!!
    return ++$counter;
}

echo counter();//1
echo "<br/>\n";

echo counter();//2
echo "<br/>\n";

//=============================== Dynamic function
function hello()
{
    return 'Hello!';
}
function bye()
{
    return 'Bye!';
}

$var = rand(0, 1) ? 'hello' : 'bye';
echo $var();
echo "<br/>\n";

?>
