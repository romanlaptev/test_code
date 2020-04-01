<?php
if($argc != 4) {
	echo "Usage: path filename num";
	exit();
}

  // Извлекаем параметры из командной строки
  $path = $argv[1];
  $filename = $argv[2];
  $size = $argv[3];

  chdir ($path);

  $file1=fopen($filename,"r");

  if ($file1)
    {

     $n1 = 1;
     $last_pos= 1;

     while (!feof ($file1))
        {

         if ($last_pos > 0)
           {
            $file_name_arr = explode(".",$filename);
            $type = $file_name_arr[1]; 
            $file2 = fopen($file_name_arr[0]."-part0".$n1.".".$type, "w");
           }

         $buffer=fread ($file1, $size);

         // начало последней словарной статьи фрагмента текста
         $last_pos = strrpos($buffer, "#");

         // Достигнут конец буфера текста, но статья (признак #) не найдена
         if ($last_pos <= 0)
           {
            print ("Достигнут конец буфера текста, но статья не найдена \n");
            fwrite($file2, $buffer, $size);
//            break;
           }

         // В буфере текста размером size найдена статья (признак #)
         if ($last_pos > 0)
           {

            // Исключительная ситуация в конце файла 8-)
            $n3 = filesize($filename) - $pos;
            $pos = ftell($file1);
            if ($pos == filesize($filename))
              {
               $last_pos = filesize($filename) - $n3;
              }

            fwrite($file2, $buffer, $last_pos );

            if (feof ($file1))
              {
               $pos = ftell($file1);
               $size = filesize($filename) - $pos;
               break;
              }

            fseek ( $file1, ($size-$last_pos) * (-1) , SEEK_CUR );
            fseek ( $file1, -1 , SEEK_CUR );

            fclose($file2);

            $n1 = $n1 + 1;
           }

        }

      fclose ( $file1);

    }
  else
    {
      echo("Ошибка открытия файла");
    }

?>