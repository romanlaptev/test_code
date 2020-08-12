<?php
echo "Your PHP version: ". PHP_VERSION;//5.6.40-0+deb8u7
echo "<br/>\n";
//echo phpversion();
//echo "<br/>\n";

//====================== anonymous function
// PHP => 5.3.0
//https://www.php.net/manual/ru/functions.anonymous.php

$echoList = function ($str)
{
    foreach ($str as $v) {
        echo "$v<br />\n";
    }
};
$echoList( ['PHP', 'Python', 'Ruby', 'JavaScript'] );


//=============================== closures
$message = "Работа не может быть продолжена из-за ошибок:<br />\n";
$check = function(array $errors) use ($message)
{
    if (isset($errors) && count($errors) > 0) {
        echo $message;
        foreach($errors as $error) {
            echo "$error<br />\n";
        }
    }
};

$check([]);

$erorrs[] = "Заполните имя пользователя";
$check( $erorrs );

$message = 'Список требований'; // Уже не изменить (in $check old value "Работа не может быть продолжена из-за ошибок:<br />\n")

$erorrs = ['PHP', 'PostgreSQL', 'Redis'];
$check( $erorrs );
?>
