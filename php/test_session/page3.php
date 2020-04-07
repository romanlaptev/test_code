<?php
  session_start();
  unset($_SESSION['username']);
  echo "Hello, ".$_SESSION['username'];

  session_destroy(); 
?>
  <a href="page2.php"> << page 2 </a>
