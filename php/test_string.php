<?php
   $test_string = substr("Hello, world!", 7, 5);
   echo $test_string; 
   echo "<br/>\n"; 

   $str1 = "/mnt/win_e/lib/books/A";
   $str2 = "/mnt/win_e/lib/books/A/Adams.Douglas/A_science_fiction_hitch_1.txt ";
   $num = strlen( $str1 ); 
   $test_string = substr( $str2, $num );
   echo $test_string; 
   echo "<br/>\n"; 

	$testReplace = str_replace("o","O",$str1);
	echo $testReplace; 
	echo "<br/>\n"; 
/*
	$file = str_replace ('{$title/}', $title, $file);
	$file = str_replace ('{$head/}', $head, $file);
	$file = str_replace ('{$body/}', $body, $file);
	$file = str_replace ('{$menu/}', $catalog, $file);	
*/

//========================
//   $n1= strrpos($dir_path, "/"); //поиск последней позиции, где встречается символ "/".
//   $url = substr($dir_path, 0, $n1);
//	$report_line = rtrim ($report_line);// удалить в строке отчета конечный пробел
//strlen($string)

//$str=iconv("utf-8", "windows-1251", "Текст cp1251.");
//echo $str."<br/>\n";

//   $test_code = ord($str_res);
//   if (($test_code < 192) || ($test_code > 223)) {
//       echo .......; 
//     }
//   echo ($test_code); 

//$pos = strpos("Hello, world!", "world");
//echo $pos."<br>\n"; //7

//$str = "dfhd@ffs@dfskfk@asas";
//$substr_count = strspn($str,"df");
//echo ($substr_count);//2

//$url = "http://www.softtime.ru";
//$sub_str = strstr($url,"w");
//echo ($sub_str);

//$str1 = "@#$%^&*dsdfdfпапавп";
//$str2 = urlencode ($str1);
//echo($str2);

//========================
   $str = "one; two; three; four; five";
   $arr = explode(";", $str);
echo "<pre>";
print_r( $arr );
echo "</pre>";
echo "\n";

//$str = "one two three for five";
//$str_exp = split (" ", $str);

//======================== heredoc syntax
$nowDoc = 123;
echo <<<EOF
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>NowDoc support for PHP &lt; 5.3.0</title>
<meta name="author" content="Ultimater at gmail dot com" />
<meta name="about-this-page"
content="Note that I built this code explicitly for the
php.net documenation for demonstrative purposes." />
<style type="text/css">
body{text-align:center;}
table.border{background:#e0eaee;margin:1px auto;padding:1px;}
table.border td{padding:5px;border:1px solid #8880ff;text-align:left;
background-color:#eee;}
code ::selection{background:#5f5color:white;}
code ::-moz-selection{background:#5f5;color:white;}
a{color:#33a;text-decoration:none;}
a:hover{color:rgb(3,128,252);}
</style>
</head>
<body>
<h1 style="margin:1px auto;">
<a
href="http://php.net/manual/en/language.types.string.php#example-77">
Example #8 Simple syntax example
</a></h1>
<table class="border"><tr><td>
$nowDoc
</td></tr></table></body></html>
EOF;

?>
