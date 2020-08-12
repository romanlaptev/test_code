<?php
//array_combine, создать новый массив, используя отд. массивы  ключей/значений
$field_arr_keys[] = "fs_root_dest";
$field_arr_values[] = "/mnt/terra/0_sites/site-content";

$images_path = array_combine($field_arr_keys, $field_arr_values);

echo "images_path = <pre>";
print_r($images_path);
echo "</pre>";

//====================== test var, create link
$first = 5;
$link = &$first;
$link = 77;

echo $first."\n";//77

//======================
$some_var = "Hello PHP!!!";
$arr1 = (array)$some_var;
print_r( $arr1 );
echo "\n";

//================
$arr1 = [ 1 => "one", 2 => "two", 3 => "three" ];
$arr2 = [ 4 => "four", 5 => "five", 1 => "one" ];

$arr3 = $arr1 + $arr2;
print_r( $arr3 );
echo "\n";

$arr4 = array_merge ($arr1, $arr2);
print_r( $arr4 );
echo "\n";

//===============
$arr1 = [ 1 => "one", 2 => "two", 3 => "three" ];
$arr2 = [ 1 => "one", 2 => "two", 3 => "three" ];
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
