<?php
function _log($arr){
	$out = "<pre>".print_r($arr,1)."</pre>\n";
	return $out;
}

//=======================================
//array_combine, создать новый массив, используя отд. массивы  ключей/значений
$field_arr_keys[] = "fs_root_dest";
$field_arr_values[] = "/mnt/terra/0_sites/site-content";

$images_path = array_combine($field_arr_keys, $field_arr_values);
echo "array_combine: "._log($images_path);

//====================== test var, create link
$first = 5;
$link = &$first;
$link = 77;

echo $first."\n";//77

//======================
$some_var = "Hello PHP!!!";
$arr1 = (array)$some_var;
echo "type string to array: "._log($arr1);

//================
$arr1 = array( 1 => "one", 2 => "two", 3 => "three" );
$arr2 = array( 4 => "four", 5 => "five", 1 => "one" );

$arr3 = $arr1 + $arr2;
echo "concat arrays: "._log($arr3);

$arr4 = array_merge ($arr1, $arr2);
echo "array_merge: "._log($arr4);

//===============
$arr1 = array( 1 => "one", 2 => "two", 3 => "three" );
$arr2 = array( 1 => "one", 2 => "two", 3 => "three" );
if( $arr1 === $arr2 ){
echo "arr1 == ar2...";
echo "\n";
} else {
echo "arr1 != ar2...";
echo "\n";
}

 //=======================
echo "Arr1 is array: ". is_array($arr1);
echo "\n";

echo "Value 'two' in arr1: ". in_array( "two", $arr1);
echo "\n";

 //=======================
// Эта функция сортирует массив. После завершения работы функции 
// элементы массива будут расположены в порядке возрастания.
//sort($files);
//Эта функция сортирует массив в обратном порядке (от большего к меньшему).
//rsort($files);

?>
