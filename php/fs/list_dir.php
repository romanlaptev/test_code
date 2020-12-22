<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$sapi_type = php_sapi_name();

$_vars["runType"] = "";
if ( $sapi_type == 'apache2handler' || $sapi_type == 'cli-server') {
	$_vars["runType"] = "web";
	$msg = "Run method (php_sapi_name): ". $sapi_type;
	echo $msg."<br/>";

	$dir = getcwd();
}

if ( $sapi_type == 'cli') {
	$_vars["runType"] = "console";
}
if ( $sapi_type == 'cgi') {
	$_vars["runType"] = "console";
}

if ( $_vars["runType"] == "console") {
	$msg = "Run method (php_sapi_name): ". $sapi_type;
	echo $msg."\n";

	print_r( $argv );
	echo "\n";
//echo $argc;
//echo "\n";
	if ($argc == 1) {
		$dir = getcwd();
	} else {
		$dir = $argv[1];
	}
}


//$dir = dirname(__FILE__);
//$dir = $dir."sites/default/files";
echo "Index of ". $dir;
echo "<br>\n";

$files = array(); 
$files = DirFiles($dir);

echo "<pre>";
print_r($files);
echo "</pre>\n";

function DirFiles($dir) { 

	$handle = opendir($dir) or die("Can't open directory $dir"); 
	$files = Array(); 
	$subfiles = Array(); 

	while (false !== ($file = readdir($handle))) 
	{ 
		if ($file != "." && $file != "..") 
		{ 

			if(is_dir($dir."/".$file)) { 
				$subfiles = DirFiles($dir."/".$file); 
				$files = array_merge( $files, $subfiles );
			} 

             if (is_file($dir."/".$file)) { 
				$files[] = $file;
			}

		} 
	  } 
	closedir($handle); 
	return $files; 
}//--------------------- end func

/*
function list_dir ($dirname)
  {
    //echo $dirname;
    global $dirs;
    global $files;

    $dh  = opendir($dirname);
    while (false !== ($filename = readdir($dh))) 
     {
       if (($filename!=".") && ($filename!=".."))
         {

             if (is_dir ($dirname."/".$filename) ) 
               { 
//                  $dirs[] = $dirname."/".$filename;
                  $dirs[] = $filename;
//    print_r ($dirs)."<br>\n";
               }
//----------------------------------------------------------------------------------------------
             if (is_file($dirname."/".$filename)) 
               { 
                  $files[] = $filename;
               }
          }
      }

  }
*/

/*
  print "<b>Directory:</b></br>\n";
  $handle=opendir(".");

  while ($file = readdir($handle)) 
    {
     if (is_dir("$file")) 
       { 
        print "$file</br>\n";
       }
    }

  closedir($handle);

  print "######################</br>\n";

  print "<b>Files:</b></br>\n";

  $handle=opendir(".");
  while ($file = readdir($handle)) 
    {
     if (is_file("$file")) 
       { 
        print "$file</br>\n";
       }
    }
  closedir($handle);
*/

/*
  $handle=opendir(".");
  print "Directory handle: $handle</br>\n";
  print "Files:</br>\n";
  while ($file = readdir($handle)) 
    {
     print "$file</br>\n";

     $filename="$file";
     $fd=fopen($filename,"r");
     $current=fread($fd,filesize($filename));
     fclose($fd);

     print("$current </br>\n");
    }
  closedir($handle);
*/
?>
