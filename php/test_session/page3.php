<?php
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

  
  
  unset($_SESSION['username']);
if( isset($_SESSION['username']) ){
  echo "<h1>Hello, ".$_SESSION['username']."</h1>";
} else {
  echo "<h1>Hello, anonymous...</h1>";
}
  session_destroy(); 
?>
<ul>
	<li><a href="page1.php">page1</a></li>
	<li><a href="page2.php">page2</a></li>
</ul>
