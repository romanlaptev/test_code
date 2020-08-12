<?php
   $_str1 = "123456";

 //  $err = "";
//	echo bin2hex($err);
//	echo "<br/>\n"; 

//echo chr(0x3082);
//echo "<br/>\n"; 

	//$value = str_replace('', '', $value);
	//$value = str_replace( chr(0x0C), '', $value);//remove Form Feed

//$testReplace = str_replace("","---Form Feed---",$_str1);
$testReplace = str_replace( chr(0x0C), "---Form Feed---", $_str1);
echo $testReplace; 
echo "\n"; 

			//$body = str_replace("&quot;", "\"", $body);
			//$body = str_replace("&amp;", "&", $body);
			//$body = str_replace("&lt;", "<", $body);
			//$body = str_replace("&gt;", ">", $body);

//------------------------ filter
			//$text_message = str_replace('', '', $text_message);
			//$text_message = str_replace('&', '&amp;', $text_message);
			
			//remove old special symbols
			// $text_message = str_replace("&quot;", "\"", $text_message);
			// $text_message = str_replace("&amp;", "&", $text_message);
			// $text_message = str_replace("&lt;", "<", $text_message);
			// $text_message = str_replace("&gt;", ">", $text_message);
			
			// //insert special symbols re-new
			// $text_message = str_replace("&", "&amp;", $text_message);
			// $text_message = str_replace("<", "&lt;", $text_message);
			// $text_message = str_replace(">", "&gt;", $text_message);
			// $text_message = str_replace("\"", "&quot;", $text_message);
//------------------------------

?>

