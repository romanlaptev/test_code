<?php
  session_start();
  $_SESSION['username'] = "Roman";
  echo "Hi, ".$_SESSION['username']."<br>";
?>
  <a href="page2.php">next page >></a>

