<?php
session_start();

echo "session.save_handler: ". ini_get("session.save_handler");
echo "<br>";
echo "session.save_path: ". ini_get("session.save_path");
echo "<br>";

$_SESSION['username'] = "Roman";
echo "Hi, ".$_SESSION['username']."<br>";
?>
<a href="page2.php">next page >></a>

