<?php
//https://www.php.net/manual/ru/function.fopen
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$filename = "test.txt";
if ( !$file_out = fopen( $filename, 'w')) {
	print "Cannot open $filename ";
	exit;
}
$today = date("H:i:s, d.m.Y");
fwrite($file_out, "<h1>Last modified: <b>" . $today."</b></h1>");
fclose($file_out);

echo "Size ".$filename.": " . filesize($filename)." bytes <br>\n";

//==========================
/*
if (file_exists($_SERVER['DOCUMENT_ROOT']."/log"))
{
	$filename = $_SERVER['DOCUMENT_ROOT']."/log/visits.txt";
	if ( unlink($filename))
	  {
	   echo  "Clear log file ".$filename;
	  }
	else
	  {
	   echo  "<font color='red'>Error!";
	   echo  "dont clear log file ".$filename;
	   echo  "</font>";
	  }
}	
*/

/*
$ip=$_SERVER["REMOTE_ADDR"];
//echo "document.write('<h2>$ip</h2>');";

$url="http://roman-laptev.narod.ru/index.html";
$filename='/home/far/r/l/a/rlaptev/public_html/log/roman-laptev.narod.ru.txt';
$today = date("H:i:s, d.m.Y");
$handle = fopen($filename, 'a');
fwrite($handle, $ip." visit ".$url." in ".$today."<br>\n");
fclose($handle);
*/

// $Reklama_file = file('Reklama.conf');

/*

		$output_filename = "correct_".$filename;
		$num_bytes = file_put_contents ($output_filename, $price_correct);
		if ($num_bytes > 0)
		  {
			echo "Write ".$num_bytes." bytes  in ".$output_filename;
			//echo $price_correct;
			echo "<pre>";
			readfile ($output_filename);
			echo "</pre>";
		  }
		else
		  {
			echo "Write error in ".$output_filename." (".$num_bytes.") bytes";
		  }
*/

/*

    echo "Size ".$filename.": " . filesize($filename)." bytes <br>\n";
    $input_file = fopen($filename, "r");
   while (!feof($input_file)) 
//    for ($n1=1;$n1<=4;$n1++) 
      {

         $report_line = fgets($input_file);
//         echo $report_line."<br>\n";
      }

  fclose ($input_file);

*/

/*
  $fd = fopen($filename,"r");
  while (!feof($fd)) 
    {
      $buffer = fgets($fd);
      echo $buffer;
    }
  fclose ($fd);
*/

/*
	$handle = fopen ($filename, "r");
	$content = fread ($handle, filesize ($filename));
	fclose ($handle);
*/


/*
//copy.php

  if ($argc != 3)
    {
     echo "Нужно 2 аргумента: infile, outfile";
     exit();
    }

  // Извлекаем параметры из командной строки

  $filename1 = $argv[1];
  $filename2 = $argv[2];

  $file1 = fopen($filename1,"r");

//Открытие двоичного файла
  $file2 = fopen($filename2,"w");

  if ($file1)
    {

      $size = (filesize($filename1));
      $buffer=fread ($file1, $size);
      fwrite($file2,$buffer);

      fclose ($file2);
      fclose ($file1);

    }
  else
    {
      echo("Ошибка открытия файла");
    }

*/

//2.copy.php
/*
  $filename1 = 'http://photo.sibnet.ru/upload/imgbig/121835122852.jpg';
  $filename2 = 'test.jpg';

  copy ('http://photo.sibnet.ru/upload/imgbig/121835122852.jpg', $filename2);
//  $file1 = fopen($filename1,"r");

//Открытие двоичного файла
//  $file2 = fopen($filename2,"w");

//  if ($file1)
//    {

//      $size = (filesize($filename1));
//echo $size;

//      $buffer=fread ($file1, $size);
//      $buffer=fread ($file1, 8388608);
//      fwrite($file2,$buffer);

//      fclose ($file2);
//      fclose ($file1);

//    }
//  else
//    {
//      echo("Ошибка открытия файла");
//    }

*/

/*

 $file1="copy.php";
 $file2="!copy.php";

 print ("Wait...<br>");

 if (!copy($file1, $file2)) {
     print ("failed to copy $file1...<br>\n");
   }
 else
   {
     print ("Ok");
   }

*/

/*
 $res = mkdir("my_directory",0755)
        or die ("Don't create my_directory");
   print ("create my_directory");

 $res = chdir("my_directory");

 $filename = 'test.txt';
               
 $fp = fopen($filename, "a+");

 for($k=1; $k<=10; $k++) {

   fwrite($fp, "Hi. This is a only test...8-) <br> \n");

  }

 fclose($fp);
*/


//header("Content-type: application/vnd.ms-excel");
//readfile("book1.xls");

//fwrite.php
/*
  $filename = 'test.txt';
  $fp = fopen($filename, "a+");
  for($k=1; $k<=10; $k++) {
   fwrite($fp, "Hi. This is a only test...8-) <br> \n");
  }

  fclose($fp);
  include ("test.txt"); 
*/
?>
