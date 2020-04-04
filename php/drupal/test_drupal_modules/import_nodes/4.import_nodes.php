<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<style>
legend
{
	color:green;
	font-size:16px;
}
.section
{
	border:1px solid;
	margin:20px;
	padding:5px;
	width:870px;
}
.param
{
	color:darkblue;
}
.error
{
	font-weight:bold;
	color:red;
}
.ok
{
	color:green;
}
.warning
{
	color:blue;
}
.info
{
	position:absolute;
	top:20px;
	right:20px;
	/*background:silver;*/
}

	</style>
</head>
<body>
<?
//---------------------------
// Bootstrap Drupal.
//---------------------------
chdir ("../");
//echo getcwd();
//echo "<br>";
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
//---------------------------

global $base_url;
//echo $base_url;

echo "<pre>";
//print_r($_SERVER);
print_r($_REQUEST);
//print_r($_FILES);
echo "</pre>";

/*
$db_name = "albums";
$username = "root";
$password = "master";
$server = "localhost";
*/

/*
//it-works.16mb.ru, albums
$db_name = "u754457009_db2";
$username = "u754457009_user2";
$password = "m2ster";
$server = "mysql.hostinger.ru";
*/

//директория с файлами для импорта
if (!empty($_REQUEST['dir']))
{
	$dir = $_REQUEST['dir'];
}
else
{
	//$dir ='../sites/default/files/imports';
	$dir ='sites/default/files/imports';
}

view_form($dir); // вывод формы
// Извлекаем параметры из запроса
//if (!isset($_REQUEST['action']) && empty($_REQUEST['action']))
if (empty($_REQUEST['action']))
  {
  }
else // Параметр action определен
  {
	$action = $_REQUEST['action'];

	switch ($action)
	  {
//==========================================================================
		case import_upload:
			if (!empty($_FILES['import_file']))
			{
echo "<span class='ok'>-- Чтение данных из </span>".$_FILES['import_file']['name'];
echo "<br>";
				$file_arr = $_FILES['import_file'];

				$test1=0;
				$test1 = upload_file ($dir, $file_arr);
				if ($test1==1)
				{
					$test2 = test_file_format($dir, $file_arr);
/*
					if ($test2==1)
					{
echo "<span class='ok'>-- продолжаем импорт...</span>";
echo "<br>";
						$filename = $dir."/".$file_arr['name'];
						import_from_xml($filename);
					}
*/
					$redirect="<a href=\"javascript:location.href='".$_SERVER['SCRIPT_NAME']."'\">обновить список файлов</a>";
					//$redirect="<script>location.href='".$_SERVER['SCRIPT_NAME']."'</script>";
					echo $redirect;
				}
			}
		break;
//==========================================================================
		case test_xml:
			if (!empty($_REQUEST['filename']))
			{
				$filename=$dir."/".$_REQUEST['filename'];
				$out=test_xml($filename);
				echo "<div class='info'>";
				echo $out;
				echo "<div>";
			}
			else
			{
				echo "<span class='error'>var filename is empty!!!!</span>";
				echo "<br>";
			}
		break;
//==========================================================================
		case import_xml:
			if (!empty($_REQUEST['filename']))
			{
				$filename = $dir."/".$_REQUEST['filename'];
				import_from_xml($filename);
			}
			else
			{
				echo "<span class='error'>var filename is empty!!!!</span>";
				echo "<br>";
			}
		break;
//==========================================================================
		case import_xml_albums:
			if (!empty($_REQUEST['filename']))
			{
//$base_url = "/transcend/0_sites/albums";
				$filename = $dir."/".$_REQUEST['filename'];
				import_from_xml_albums($filename);
			}
			else
			{
				echo "<span class='error'>var filename is empty!!!!</span>";
				echo "<br>";
			}
		break;
//==========================================================================
		case delete:
			if (!empty($_REQUEST['filename']))
			{
				$filename=$dir."/".$_REQUEST['filename'];
				if (unlink ($filename))
				{
					echo "Remove  ".$filename;
					echo "<br>";
					$redirect="<script>location.href='".$_SERVER['SCRIPT_NAME']."'</script>";
					echo $redirect;
				}
			}
			else
			{
				echo "<span class='error'>var filename is empty!!!!</span>";
				echo "<br>";
			}
		break;
//==========================================================================
	  }//------------------------------ end switch


  }//--------------------------------- end elseif action
//=================================================================================

//====================
// FUNCTIONS
//====================

//-------------------------
// вывод загруженных файлов для импорта
//-------------------------
/*
function scan_import_folders($dir)
{

	echo "<form method=post name=form_import_files action='".$_SERVER['SCRIPT_NAME']."'>
<fieldset>
	<legend><b>Список файлов для импорта</b></legend>
		<div class='section'>";
echo "index of ".$dir;
echo "<br>";
	echo "<ul>";
	$handle  = opendir($dir);
	while (false !== ($filename = readdir($handle))) 
	{
		if (($filename!=".") && ($filename!=".."))
		{
			if (is_dir($dir."/".$filename)) 
			{ 
				$num_dir=$num_dir+1;
echo "+".$filename;
echo "<br>";
			}
//----------------------------------------------------------------------------------------------
			if (is_file($dir."/".$filename)) 
			{ 
				$num_file=$num_file+1;
//echo "<li>".$filename." <a href='".$_SERVER['SCRIPT_NAME']."?action=import_xml&filename=".$filename."'>импорт</a> |";
//echo "<a href='".$_SERVER['SCRIPT_NAME']."?action=delete&filename=".$filename."'>удалить</a></li>";
				echo "<input type=checkbox name=filename value='".$filename."'/>".$filename."<br>";
			}
		}
	}//----------------------- end while
	echo "
<select size=4 name=action onChange='javascript:document.forms.form_import_files.submit();'>
	<option value='' selected></option>
	<option value='import_xml'> import_xml</option>
	<option value='import_xml_albums'> import_xml_albums</option>
	<option value='delete'> delete</option>
</select>";
	echo "</ul>";
	print "<b> Directory: ".$num_dir."<br> Files: </b>".$num_file."<br>";
	echo "</div>
	</fieldset>
</form>";

   closedir ($handle);

} //-------------------------- end func
*/
function drupal_scan_import_folders($dir)
{
	$out = "";
	$out .= "index of ".$dir;
	$out .= "<br>";
	$out .= "<ul>";

	//$dir = "sites/default/files/imports";
	//$dir = "/mnt/disk2/temp";
	//$mask='\.*.css';
	$mask='\.*';
	$nomask = array('.', '..', 'CVS');
	$callback = 0;
	//$recurse = TRUE;
	$recurse = false;
	$key = 'filename';
	$min_depth = 0;
	$depth = 0;
	$files = file_scan_directory($dir, $mask, $nomask, $callback, $recurse, $key, $min_depth, $depth);
//echo "<pre>";
//print_r($files);
//echo "</pre>";
/*
Array
(
    [export_photogallery_image_nodes] => stdClass Object
        (
            [filename] => sites/default/files/imports/export_photogallery_image_nodes.xml
            [basename] => export_photogallery_image_nodes.xml
            [name] => export_photogallery_image_nodes
        )

)

*/
	foreach ($files as $file)
	{
		$out .= "<input type=checkbox name=filename value='".$file->basename."'/>".$file->basename.", ";
		$out .= "<a href='".$_SERVER['SCRIPT_NAME']."/?action=delete&filename=".$file->basename."'>удалить</a>, ";
		$out .= "<a href='".$_SERVER['SCRIPT_NAME']."/?action=test_xml&filename=".$file->basename."'>проверить</a><br>";
	}
	$out .= "</ul>";
	return $out;
} //-------------------------- end func


//-------------------------
// ВЫВОД ФОРМЫ 
//-------------------------
function view_form($dir)
{
	$out="";
//------------------------------------- upload form
	$out .= "
<form enctype='multipart/form-data' method=post name=form_upload action='".$_SERVER['SCRIPT_NAME']."'>
<fieldset><legend><b>Файл для импорта (формат XML)</b></legend>
		<div class='section'>
Директория импорта: <input type=text name=dir size=40 value='".$dir."'/><br>
Файл импорта: <input type=file name=import_file>
<input type=hidden name=action value='import_upload'>
<input type=submit value='Загрузить'>
		</div>";
	$out .= "</fieldset></form>";
	
//------------------------------------- taxonomy form
	$out .= "<form method=post name=form_taxonomy_import action='".$_SERVER['SCRIPT_NAME']."'>
<fieldset><legend><b>Таксономия</b></legend>";

	$out .= "<div class='section'>";
	//scan_import_folders($dir); // вывод загруженных файлов для импорта
	$out .= drupal_scan_import_folders($dir); // вывод загруженных файлов для импорта
	$out .= "</div>";

	$out .= "<div class='section'>";
	$out .= drupal_view_taxonomy_voc(); //вывод имеющихся словарей таксономии
	$out .= "<input type=hidden name=action value='drupal_import_xml_taxonomy'>";
	$out .= "<input type=submit value='импорт'>";
	$out .= "</div>";
	$out .= "</fieldset></form>";
	
//------------------------------------- nodes form
	$out .= "<form method=post name=form_nodes_import action='".$_SERVER['SCRIPT_NAME']."'>
<fieldset><legend><b>Материалы</b></legend>";

	$out .= "<div class='section'>";
	$out .= drupal_scan_import_folders($dir); // вывод загруженных файлов для импорта
	$out .= "</div>";

	$out .= "<div class='section'>";
	$out .= drupal_view_node_type();
	$out .= "<input type=hidden name=action value='drupal_import_xml_nodes'>";
	$out .= "<input type=submit value='импорт'>";
	$out .= "</div>";
	$out .= "</fieldset></form>";

	echo $out;
} //-------------------------- end func

//-------------------------
// ЗАГРУЗИТЬ ФАЙЛ
//-------------------------
function upload_file($dir, $file_arr)
{
//echo "file_arr = <pre>";
//print_r($file_arr);
//echo "</pre>";

	$res=0;
	$perms=substr(sprintf('%o', fileperms($dir)), -4);
        if (is_writable ($dir))
          {
echo "-- Upload folder ".$dir.", <span class='ok'>is_writable</span>, ($perms)";
echo "<br>";
                if(isset($file_arr))
                  {
                        $errors ="";
                        switch ($file_arr['error'])
                        {
                                case 0:
echo "-- <span class='ok'>UPLOAD_ERR_OK</span>, Ошибок не возникло.";
echo "<br>";
                                        if (is_uploaded_file($file_arr['tmp_name']))
                                        {
                                                if (move_uploaded_file($file_arr['tmp_name'], $dir."/".$file_arr['name']))
                                                {
echo $dir."/".$file_arr['name'].", size= ".$file_arr['size']." bytes <span class='ok'>move_uploaded_file ok</span>";
echo "<br>";
                                                }
                                                else
                                                {
							$errors .= "move_uploaded_file error";
                                                }
                                        }
					$res=1;
                                break;

                                case 1:
                                        $error = $file_arr['error'];
$errors .= 'Ошибка UPLOAD_ERR_INI_SIZE, Размер принятого файла превысил максимально допустимый размер, который задан директивой upload_max_filesize конфигурационного файла php.ini.';
                                        $errors .= ' Код ошибки: ' . $error;
                                break;

                                case 2:
                                        $error = $file_arr['error'];
                                        $errors .= 'Ошибка UPLOAD_ERR_FORM_SIZE,  Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.';
                                        $errors .= ' Код ошибки: ' . $error;
                                break;

                                case 3:
                                        $error = $file_arr['error'];
                                        $errors .= 'Ошибка UPLOAD_ERR_PARTIAL, Загружаемый файл был получен только частично.';
                                        $errors .= ' Код ошибки: ' . $error;
                                break;

                                case 4:
                                        $error = $file_arr['error'];
                                        $errors .= 'Ошибка UPLOAD_ERR_NO_FILE,  Файл не был загружен.';
                                        $errors .= ' Код ошибки: ' . $error;
                                break;

                                case 6:
                                        $error = $file_arr['error'];
                                        $errors .= 'Ошибка UPLOAD_ERR_NO_TMP_DIR, Отсутствует временная папка. Добавлено в PHP 4.3.10 и PHP 5.0.3.';
                                        $errors .= ' Код ошибки: ' . $error;
                                break;

                                case 7:
                                        $error = $file_arr['error'];
                                        $errors .= 'Ошибка UPLOAD_ERR_CANT_WRITE, Не удалось записать файл на диск. Добавлено в PHP 5.1.0.';
                                        $errors .= ' Код ошибки: ' . $error;
                                break;

                                case 8:
                                        $error = $file_arr['error'];
$errors .= 'Ошибка UPLOAD_ERR_EXTENSION, PHP-расширение остановило загрузку файла. PHP не предоставляет способа определить какое расширение остановило загрузку файла; в этом может помочь просмотр списка загруженных расширений из phpinfo(). Добавлено в PHP 5.2.0.';
                                        $errors .= ' Код ошибки: ' . $error;
                                break;

                        }//------------------------ end switch
                        if (!empty($errors))
                          {
                                echo "<span class=error>".$errors."</span>";
                                echo "<br>";
                          }
                  }

          }
        else
          {
echo "<br><span class='error'>Error</span>, upload folder ".$dir."("
.$perms."), <span class='error'>no is_writable</span><br>";
echo "<br>";
          }//------------------------ end if
	return $res;
} //-------------------------- end func

//------------------------------------
// Проверить формат файла для импорта
//------------------------------------
function test_file_format($dir, $file_arr)
{
	$res=0;
	$filename = $dir."/".$file_arr['name'];
	$type = $file_arr['type'];
	if ($type == 'text/xml')
	{
echo "<span class='ok'>-- OK, формат файла XML</span>";
echo "<br>";
		$res=1;
	}
	else
	{
echo "<span class='error'>-- Error,  для импорта нужен XML файл!!!</span>";
echo "<br>";
		if (unlink ($filename))
		{
			echo "Remove  ".$filename;
			echo "<br>";
		}
	}//------------------------------------- end elseif
	return $res;
} //-------------------------- end func

//------------------------------------ 
//список типов материалов
//------------------------------------ 
function drupal_view_node_type()
{
	global $db_prefix;
	$out = "";
	$query = "SELECT * FROM ".$db_prefix."node_type;";
//echo $query;
//echo "<br>";
	$res = db_query($query);
	while($row = db_fetch_object($res))
	{
		$out .= "<input type=checkbox name=node_type value='".$row->type."'/>".$row->type.", ".$row->name."<br>";
	}
	return $out;
} //-------------------------- end func

//------------------------------------ 
//список имеющихся словарей таксономии
//------------------------------------ 
function drupal_view_taxonomy_voc()
{
	global $db_prefix;
	$out = "";
	$query = "SELECT * FROM ".$db_prefix."vocabulary;";
//echo $query;
//echo "<br>";
	$out .= "Импортировать термины в<br>";
	$res = db_query($query);
	while($row = db_fetch_object($res))
	{
//echo "<pre>";
//print_r($row);
//echo "</pre>";
		$out .= "<input type=checkbox name=vocabulary value='".$row->vid."'/>".$row->name."<br>";
	}
	$out .= "или в новый словарь с названием ";
	$out .= "<input type=text name=new_vocabulary value=''/>";
	$out .= "<br>";
	//$out .= "<input type=checkbox name=use_vocabulary value='1'/>не использовать таксономию<br>";
	//$out .= "<br>";
	return $out;
} //-------------------------- end func

//------------------------------------
// Проверка файла импорта (подсчет нод, терминов)
//------------------------------------
function test_xml($filename)
{
	$xml = simplexml_load_file($filename);
	if ($xml == FALSE) 
	{
		exit("Failed to open ".$filename);
	}
//echo "<pre>";
//print_r ($xml);
//echo "</pre>";

//$num_items = 2;
//---------------------------------------------------------------------
	$n1=0;
	$num_nodes=0;
	foreach ($xml->album as $album)
	{
		$n1++;
//echo $n1.". ".$album[@name];
//echo "<br>";
		$n2=0;
//echo "		<ul>";
		foreach ($album->node as $node)
		{
			$n2++;
//echo $n2.". ".$node->title;
//echo "<br>";
		}
		$num_nodes = $num_nodes + $n2;
//echo "		</ul>";

	}//----------------- end foreach

	$num_albums=$n1;
	$output="";
	$output .= "В XML-файле найдено: "; 
	$output .= "<ul>";

	$output .= "альбомов - ".$num_albums; 
	$output .= "<br>";
	$output .= "изображений - ".$num_nodes; 
	$output .= "<br>";

	$output .= "</ul>";
//---------------------------------------------------------------------
	return $output;
} //-------------------------- end func

//------------------------------------
// Выполнить импорт
//------------------------------------
function import_from_xml($filename)
{
	$xml = simplexml_load_file($filename);
	if ($xml == FALSE) 
	{
		exit("Failed to open ".$filename);
	}
//echo "<pre>";
//print_r ($xml);
//echo "</pre>";

} //-------------------------- end func

function drupal_import_from_xml_albums($filename)
{
	global $db_prefix;
	$xml = simplexml_load_file($filename);
	if ($xml == FALSE) 
	{
		exit("Failed to open ".$filename);
	}
//echo "<pre>";
//print_r ($xml);
//echo "</pre>";
//$num_items = 2;
//---------------------------------------------------------------------
	$n1=0;
	$num_nodes=0;
	foreach ($xml->album as $album)
	{
		$n1++;
//echo $n1.". ".$album[@name];
//echo "<br>";
		$n2=0;
//echo "		<ul>";
		foreach ($album->node as $node)
		{
			$n2++;
//echo $n2.". ".$node->title;
//echo "<br>";
		}
		$num_nodes = $num_nodes + $n2;
//echo "		</ul>";

	}//----------------- end foreach

	$num_albums=$n1;
	$output="";
	$output .= "В XML-файле найдено: "; 
	$output .= "<ul>";

	$output .= "альбомов - ".$num_albums; 
	$output .= "<br>";
	$output .= "изображений - ".$num_nodes; 
	$output .= "<br>";

	$output .= "</ul>";
//---------------------------------------------------------------------

	//db_connect();
	
//---------------------- запрос терминов
	$vid=1;
	$query = "SELECT tid, name, description FROM ".$db_prefix."term_data WHERE vid=".$vid.";";

	//$termin_res = mysql_query($query) or die("<font color=red>Query error: </font>".mysql_error());
	//$num_termin = mysql_num_rows($termin_res);

	$num_termin=0;
	$termin_res = db_query($query);
	while ($row = db_fetch_object($termin_res))
	{
		$num_termin++;
	}//---------------------- end while

//---------------------- запрос материалов
	$node_type="photogallery_image";
	$query = "SELECT * FROM ".$db_prefix."node WHERE type='".$node_type."';";
//echo $query;
//echo "<br>";
	
	$num_nodes_db=0;

	//$node_res = mysql_query($query) or die("<font color=red>Query error: </font>".mysql_error());
	//$num_nodes_db = mysql_num_rows($node_res);

	$node_res = db_query($query);
	while ($row = db_fetch_object($node_res))
	{
		$num_nodes_db++;
		$node_arr[]=$row;
	}//---------------------- end while

	$output .= "В базе данных найдено: "; 
	$output .= "<ul>";

	$output .= "терминов - ".$num_termin; 
	$output .= "<br>";
	$output .= "материалов - ".$num_nodes_db; 
	$output .= "<br>";

	$output .= "</ul>";
//--------------------------------------------------------
	// Обновление или создание материала
	$num_node=0;
	foreach ($xml->album as $album)
	{
		foreach ($album->node as $node_xml)
		{
			$num_node++;
			$output .= test_node($num_node,
						$node_type,
						$node_xml,
						$node_arr);
						//$node_res);
			//mysql_data_seek($node_res, 0);
		}

	}//----------------- end foreach
echo $output;
} //-------------------------- end func

/*
function db_connect()
{
	global $db_name;
	global $username;
	global $password;
	global $server;

	$db = mysql_connect ($server, $username, $password);
	if ($db)
	{
		mysql_query('SET NAMES utf8');

//character_set_client = latin1 / utf8
//mysql_query("SET CHARACTER_SET_CLIENT=utf8");

//character_set_connection = latin1 / utf8
//mysql_query("SET CHARACTER_SET_CONNECTION=utf8");

//character_set_database = latin1 / utf8

//character_set_results = latin1 / utf8
//character_set_server = latin1 / utf8

//collation_connection = latin1_swedish_ci / utf8_unicode_ci
//collation_database = latin1_swedish_ci / utf8_unicode_ci
//collation_server = latin1_swedish_ci / utf8_unicode_ci

		echo "-- <font color=green>Connect to the </font>".$server;
		echo "<br>";
//-----------------------------------------------------------
		if (!mysql_select_db($db_name))
		{
			echo "-- <font color=red>Dont select database </font>".$db_name;
			echo "<br>";
		}
	}
	else
  	{
		echo "-- <font color=red>Dont connect to the  </font>".$server;
		echo "<br>";
	}

} //-------------------------- end func
*/

//-----------------------------------
// Обновление или создание материала
//-----------------------------------
function test_node($num_node,
			$node_type,
			$node_xml,
			$node_arr)
			//$node_res)
{
	global $base_url;
	$test=0;
	$output="";
	$output .= $num_node.". Проверяем изображение с заголовком ".$node_xml->title;
	$output .= "<br>";

	//$num_rows = mysql_num_rows($node_res);
	//if ($num_rows > 0)
	//{
		//while ($row = mysql_fetch_assoc($node_res))
		for ($n1=0; $n1 < count($node_arr); $n1++)
		{
			//if ($node_title == $row['title'])
			if ($node_xml->title == $node_arr[$n1]->title)
			{
				$test=1;
				$test_row=$node_arr[$n1];
			}
		}//---------------------- end while

		if ($test == 1)
		{
			$output .= "в базе данных <span class='ok'>найден соответ. материал</span> "
."<a href='".$base_url."/node/".$test_row->nid."'>".$test_row->title."</a>";
			$output .= update_node(); //обновить ноду, если в XML более поздняя дата изменения изображения
		}
		else
		{
			$output .= "в базе данных <span class='error'>нет соответствий</span>";
			//$output .= new_node($node_type,$node_xml);
		}

	//}//---------------------- end if

	$output .= "<br>";
	$output .= "<br>";
	return $output;
} //-------------------------- end func

//-------------------------------------------------------------------
//обновить  материал, если в XML более поздняя дата изменения изображения
//-------------------------------------------------------------------
function update_node()
{
//$output = "";
//$output .= "обновить материал";
//$output .= "<br>";

	return $output;
} //-------------------------- end func

//-------------------------------------------------------------------
//Создать  материал из  XML-полей изображения
//-------------------------------------------------------------------
function new_node($node_type,$node_xml)
{
	$output="";
	$output .= "Создать  материал";
	$output .= "<br>";
//echo "node_xml = <pre>";
//print_r($node_xml);
//echo "</pre>";
/*
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [num] => 274
            [nid] => 252
        )

    [status] => 1
    [created] => 28-Oct-2012 14:51:54
    [changed] => 28-Oct-2012 14:52:43
    [title] => Король Кастилии Альфонсо
    [termin] => Cantigas de Santa Maria
    [author] => SimpleXMLElement Object
        (
        )

    [field_title_value] => Король Кастилии Альфонсо - поэт и музыкант
    [teaser] => 
Король Кастилии Альфонсо - поэт и музыкант
view img_original


    [body] => 
http://www.liveinternet.ru/community/2281209/post115196341/
    [year] => SimpleXMLElement Object
        (
        )

    [style] => SimpleXMLElement Object
        (
        )

    [genre] => SimpleXMLElement Object
        (
        )

    [technique] => миниатюра
    [preview_img] => /content/albums/gallery_images/imagecache/preview_gallery_img/gallery_images/
    [big_img] => /content/albums/gallery_images/imagecache/w1024/gallery_images/
    [original_img] => /content/albums/gallery_images/
)
*/
	$node = new stdClass();
	$node->type = $node_type;
	$node->title = $node_xml->title;
	$node->teaser = $node_xml->teaser;
	$node->body = $node_xml->body;

	$node->taxonomy[] = array($node_xml->termin[@tid]);

	$node->uid = 1;                  // id автора
	$node->status = $node_xml->status;     // 1 - опубликовано, 0 - нет
 	node_save($node);

	$output .= ". Добавлен материал "
." <a href='".$base_url."/node/".$node->nid."' target=_blank><b>".$node->title."</b></a> в раздел <b>"
.$node_xml->termin."</b>";
	$output .= "<br>";

/*
echo "<pre>";
print_r($node);
echo "</pre>";
stdClass Object
(
    [type] => photogallery_image
    [title] => SimpleXMLElement Object
        (
            [0] => Король Кастилии Альфонсо
        )

    [teaser] => SimpleXMLElement Object
        (
            [0] => 
Король Кастилии Альфонсо - поэт и музыкант
view img_original


        )

    [body] => SimpleXMLElement Object
        (
            [0] => 
http://www.liveinternet.ru/community/2281209/post115196341/
        )

    [taxonomy] => Array
        (
            [0] => Array
                (
                    [0] => SimpleXMLElement Object
                        (
                            [0] => 87
                        )

                )

        )

    [uid] => 1
    [status] => SimpleXMLElement Object
        (
            [0] => 1
        )

    [book] => Array
        (
            [mlid] => 
        )

    [field_img1_gallery] => Array
        (
            [0] => 
        )

    [field_preview_img] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_big_img] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_original_img] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_title] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_num_page] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_author] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_create_date] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_style] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_genre] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [field_technique] => Array
        (
            [0] => Array
                (
                    [value] => 
                )

        )

    [is_new] => 1
    [log] => 
    [created] => 1352030830
    [changed] => 1352030830
    [timestamp] => 1352030830
    [format] => 0
    [vid] => 253
    [language] => 
    [comment] => 0
    [promote] => 0
    [moderate] => 0
    [sticky] => 0
    [tnid] => 0
    [translate] => 0
    [nid] => 253
)

*/
	return $output;
} //-------------------------- end func
?>
</body>
</html>

