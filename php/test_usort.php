<?php
//PHP => 5.3.0
//https://www.youtube.com/watch?v=IhPkWLRCjvQ
//https://www.php.net/manual/ru/functions.anonymous.php
//https://www.php.net/manual/ru/function.usort.php
$urls = [
	"http://htmllab.ru",
	"http://www.sepcialist.ru",
	"http://youtube.com/htmllabru"
];

function func1( $a, $b){
    if ($a == $b) {
        return 0;
    }
	return $a < $b ? 1 : -1;
}

usort( $urls, "func1");

echo "<pre>";
print_r( $urls );
echo "</pre>";

//============================
$arr2 = [	"c",	"b",	"a",	"d" ];
usort( $arr2, function ( $a, $b){
    if ($a == $b) {
        return 0;
    }	return $a > $b ? 1 : -1;
});

echo "<pre>";
print_r( $arr2);
echo "</pre>";

//============================
$arr3 = [7,	2,	4,	1 ];

$sort_func = function ( $a, $b){
    if ($a == $b) {
        return 0;
    }	return $a > $b ? 1 : -1;
};

usort( $arr3, $sort_func );

echo "<pre>";
print_r( $arr3);
echo "</pre>";

//============================
$arr4 = [
	["name" => "five", "num" => 5],
	["name" => "two", "num" => 2],
	["name" => "four", "num" => 4],
	["name" => "three", "num" => 3],
	["name" => "one", "num" => 1]
];

$sort_func2 = function ( $a, $b){
    if ($a["num"] == $b["num"]) {
        return 0;
    }	return $a["num"] > $b["num"] ? 1 : -1;
};

usort( $arr4, $sort_func2 );

for ( $n = 0; $n < count( $arr4); $n++ ){
	$line = $arr4[ $n ];
echo $line["name"]." - ".$line["num"];
echo "\n";
}//next

?>
