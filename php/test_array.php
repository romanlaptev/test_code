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
?>
