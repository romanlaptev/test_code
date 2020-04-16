<?php
ini_set("session.gc_maxlifetime", 60 );//86400 sec
ini_set("session.gc_probability", 10 );
ini_set("session.gc_divisor", 1 );

//ini_set("session.use_cookies", 0 );
//+ini_set("session.cookie_lifetime", 90);
$lifetime=90;
session_set_cookie_params($lifetime);

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
<ul>
	<li><a href="page2.php">page2</a></li>
</ul>

<pre>
https://www.php.net/manual/ru/function.session-set-cookie-params
//https://www.php.net/manual/ru/session.configuration.php#ini.session.gc-divisor
 session.gc_probability integer
    session.gc_probability � ��������� � session.gc_divisor 
	���������� ����������� ������� ������� �������� ������ 
	(gc, garbage collection). �� ��������� ����� 1. 
	��. ��������� � session.gc_divisor. 
session.gc_divisor integer
    session.gc_divisor � ��������� � session.gc_probability 
	���������� ����������� ������� ������� �������� ������ 
	(gc, garbage collection) ��� ������ ������������� ������. 
	����������� �������������� ��� gc_probability/gc_divisor, 
	�� ���� 1/100 ��������, ��� ������� gc ����������� � ����� ������ �� ���, 
	��� 1% ��� ������ �������. 
	session.gc_divisor �� ��������� ����� �������� 100. 
session.gc_maxlifetime integer
    session.gc_maxlifetime ������ �������� ������� � ��������, 
	����� ������� ������ ����� ��������������� ��� "�����" � 
	������������ ����� �������. ���� ������ ����� ��������� 
	� ������� ������ ������ 
	(� ����������� �� �������� session.gc_probability � session.gc_divisor).
    ���������: ���� ������ ������� ����� ������ �������� session.gc_maxlifetime, �� ��� ���� ���� � �� �� ����� ��� �������� ������ ������, �� ������ � ����������� ��������� ��������� ��� ������. � ����� ������ ������� ������������ ��� ��������� ������ � session.save_path. 

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
������������ ������ � PHP 
</pre>
