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

//========================
   $str = "one; two; three; four; five";
   $arr = explode(";", $str);
echo "<pre>";
print_r( $arr );
echo "</pre>";
echo "\n";

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

