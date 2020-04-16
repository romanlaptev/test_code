<?php
ini_set("session.gc_maxlifetime", 60 );//86400 sec
ini_set("session.gc_probability", 10 );
ini_set("session.gc_divisor", 1 );

ini_set("session.use_cookies", 0 );
//+ini_set("session.cookie_lifetime", 90);
//$lifetime=90;
//session_set_cookie_params($lifetime);

session_start();

echo "session.save_handler: ". ini_get("session.save_handler");
echo "<br>";
echo "session.save_path: ". ini_get("session.save_path");
echo "<br>";

echo "session.gc_maxlifetime: ". ini_get("session.gc_maxlifetime") . "sec";
echo "<br>";
echo "session.gc_probability: ". ini_get("session.gc_probability");
echo "<br>";
echo "session.gc_divisor: ". ini_get("session.gc_divisor");
echo "<br>";
echo "session.use_cookies: ". ini_get("session.use_cookies");
echo "<br>";
echo "session.cookie_lifetime: ". ini_get("session.cookie_lifetime");
echo "<br>";


$_SESSION['username'] = "Roman";
echo "<h1>Hi, ".$_SESSION['username']."</h1>";

echo "SESSION:<pre>";
print_r($_SESSION);
echo "</pre>";

echo "COOKIE:<pre>";
print_r($_COOKIE);
echo "</pre>";

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

<ul>
	<li><a href="page2.php">page2</a></li>
</ul>

<pre>
https://www.php.net/manual/ru/function.session-set-cookie-params
//https://www.php.net/manual/ru/session.configuration.php#ini.session.gc-divisor
 session.gc_probability integer
    session.gc_probability в сочетании с session.gc_divisor 
	определяет вероятность запуска функции сборщика мусора 
	(gc, garbage collection). По умолчанию равен 1. 
	См. подробнее в session.gc_divisor. 
session.gc_divisor integer
    session.gc_divisor в сочетании с session.gc_probability 
	определяет вероятность запуска функции сборщика мусора 
	(gc, garbage collection) при каждой инициализации сессии. 
	Вероятность рассчитывается как gc_probability/gc_divisor, 
	то есть 1/100 означает, что функция gc запускается в одном случае из ста, 
	или 1% при каждом запросе. 
	session.gc_divisor по умолчанию имеет значение 100. 
session.gc_maxlifetime integer
    session.gc_maxlifetime задает отсрочку времени в секундах, 
	после которой данные будут рассматриваться как "мусор" и 
	потенциально будут удалены. Сбор мусора может произойти 
	в течение старта сессии 
	(в зависимости от значений session.gc_probability и session.gc_divisor).
    Замечание: Если разные скрипты имеют разные значения session.gc_maxlifetime, но при этом одни и те же места для хранения данных сессии, то скрипт с минимальным значением уничтожит все данные. В таком случае следует использовать эту директиву вместе с session.save_path. 

   [session.gc_divisor] => Array
        (
            [global_value] => 1000
            [local_value] => 1000
            [access] => 7
        )

    [session.gc_maxlifetime] => Array
        (
            [global_value] => 1440
            [local_value] => 1440
            [access] => 7
        )

    [session.gc_probability] => Array
        (
            [global_value] => 1
            [local_value] => 1
            [access] => 7
        )
---------------------
https://rmcreative.ru/blog/post/blokirovanie-sessiy-v-php
Блокирование сессий в PHP 
</pre>

</body>
</html>
