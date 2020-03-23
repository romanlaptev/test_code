<?php
//$dir = getcwd();
//$dir = dirname(__FILE__);
$dir = "C:\WebServers\home\site.test";
echo $dir;
echo "<br>";

$files = RemoveTree($dir);

function RemoveTree($dir) 
{ 
	$handle = opendir($dir) or die("Can't open directory $dir"); 
	while (false !== ($file = readdir($handle))) 
	{ 
		if ($file != "." && $file != "..") 
		{ 
			if(is_file($dir."/".$file)) 
			{ 
				if(unlink($dir."/".$file)) 
				{
echo "unlink ".$file;
echo "<br>";
				} 
			} 
			if(is_dir($dir."/".$file)) 
			{ 
				RemoveTree($dir."/".$file);
				if(rmdir($dir."/".$file))
				{
echo "rmdir ".$file;
echo "<br>";
				} 
			} 
			
		} 
	} 
	closedir($handle); 
	
	if(rmdir($dir))
	{
echo "rmdir ".$file;
echo "<br>";
		return true;
	} 
}//--------------------- end func
?>
