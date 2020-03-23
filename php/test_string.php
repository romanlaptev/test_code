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
?>

