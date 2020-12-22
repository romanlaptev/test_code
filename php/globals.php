<?php
echo "Content-type: text/html\n";
echo "\n";
echo "<h1> Server variables </h1>";
echo "<pre>\n";

echo "<h2>GLOBALS</h2>\n";
print_r ($GLOBALS);
echo "<hr>\n";

echo "<h2>SERVER</h2>\n";
print_r ($_SERVER);
echo "<hr>\n";

echo "<h2>REQUEST</h2>\n";
print_r ($_REQUEST);
echo "<hr>\n";

echo "<h2>GET</h2>\n";
print_r ($_GET);
echo "<hr>\n";

echo "<h2>POST</h2>\n";
print_r ($_POST);
echo "<hr>\n";

echo "<h2>COOKIE</h2>\n";
print_r ($_COOKIE);
echo "<hr>\n";

echo "<h2>SESSION</h2>\n";
print_r ($_SESSION);
echo "<hr>\n";

echo "<h2>FILES</h2>\n";
print_r ($_FILES);
echo "<hr>\n";

echo "<h2>ENV</h2>\n";
print_r ($_ENV);
echo "<hr>\n";

echo "</pre>\n";

echo "<h1> PHP info </h1>";
phpinfo ();
?>

