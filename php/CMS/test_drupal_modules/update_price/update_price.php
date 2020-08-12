<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<?
//echo "<pre>";
//print_r ($_SERVER);
//print_r ($_REQUEST);
//echo "</pre>";

//=======================================================
	if (isset($_REQUEST['action']))
	{
		$action = $_REQUEST['action'];
	}
	else
		$action="";

//=======================================================
	switch($action)
	{
		case 'import_upload': 
			Nav();
			import_upload();
		break;

		case 'public_product': 
			Nav();
			service_product('public_product');
		break;

		case 'unpublic_product': 
			Nav();
			service_product('unpublic_product');
		break;

		case 'remove_product': 
			Nav();
			service_product('remove_product');
		break;

		case 'list_product': 
			Nav();
			service_product('list_product');
		break;

		default:
			Nav();
		break;
	}
//=======================================================

function Nav()
{
	$output =  "<div id='main'>";
	$output .= "<a href='../'>на главную страницу</a> | ";
	$output .= "<a href='".$_SERVER['PHP_SELF']."?action=public_product'>опубликовать все товары каталога</a> | ";
	$output .= "<a href='".$_SERVER['PHP_SELF']."?action=unpublic_product'>снятие товаров каталога с публикации</a> | ";
	//$output .= "<a href='".$_SERVER['PHP_SELF']."?action=remove_product'>удалить все товары каталога</a> | ";
	$output .= "<a href='../clear_catalog.php'>удалить все товары каталога</a> | ";
	//$output .= "<a href='parce_csv_price.php'>импорт из CSV</a> | ";
	$output .= "<a href='".$_SERVER['PHP_SELF']."?action=list_product'>list product</a>";

	$output .= "<a href='".$_SERVER['PHP_SELF']."'><h2>Обновление данных о товарах и ценах</h2></a>";
	$output .= "	<div id='block_upload_form'>";
	$output .= "		<form enctype='multipart/form-data' method='post' name='form_upload' action='".$_SERVER['PHP_SELF']
."'>Для начала импорта выберите прайс в формате XLS (Excel)<br>";
	$output .= "			<input type=file name=file>";
	$output .= "			<input type=hidden name=action value='import_upload'>";
	$output .= "			<input type=submit value='Загрузить'>";
	$output .= "		</form>";
	$output .= "	</div>";

	$output .= "</div>";
	echo $output;

} //---------------------------- end func

/*

UPLOAD_ERR_OK
    Значение: 0; Ошибок не возникло, файл был успешно загружен на сервер.
	
UPLOAD_ERR_INI_SIZE
    Значение: 1; Размер принятого файла превысил максимально допустимый размер, который задан директивой upload_max_filesize конфигурационного файла php.ini.

UPLOAD_ERR_FORM_SIZE
    Значение: 2; Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.
	
UPLOAD_ERR_PARTIAL
    Значение: 3; Загружаемый файл был получен только частично.
	
UPLOAD_ERR_NO_FILE
    Значение: 4; Файл не был загружен.
	
UPLOAD_ERR_NO_TMP_DIR
    Значение: 6; Отсутствует временная папка. Добавлено в PHP 4.3.10 и PHP 5.0.3.
	
UPLOAD_ERR_CANT_WRITE
    Значение: 7; Не удалось записать файл на диск. Добавлено в PHP 5.1.0.
	
UPLOAD_ERR_EXTENSION
    Значение: 8; PHP-расширение остановило загрузку файла. PHP не предоставляет способа определить какое расширение остановило загрузку файла; в этом может помочь просмотр списка загруженных расширений из phpinfo(). Добавлено в PHP 5.2.0.
*/

function import_upload()
{
//echo "<pre>";
//print_r ($_REQUEST);
//print_r ($_FILES);
//echo "</pre>";

	$path = '../sites/default/files/imports/';
	$perms=substr(sprintf('%o', fileperms($path)), -4);

	if (is_writable ($path))
	  {
		//echo "upload folder ".$path.", is_writable, ($perms)";
		//echo "<br>";
	
		// проверяем, что файл загружался
		if(isset($_FILES['file']) && $_FILES['file']['error'] != 4)
		  {
			// проверяем, что файл загрузился без ошибок
			if($_FILES['file']['error'] != 1 && $_FILES['file']['error'] != 0)
			  {
				$error = $_FILES['file']['error'];
				$errors []= 'Ошибка: Файл не загружен.'.' Код ошибки: ' . $error;
				echo $errors;
				return;
			  }
			else
			  {
				// файл загружен на сервер
				if (is_uploaded_file($_FILES['file']['tmp_name'])) 
				{
					if (move_uploaded_file($_FILES['file']['tmp_name'], $path.$_FILES['file']['name']))
					{
						//echo $path.$_FILES['file']['name'].", size= ".$_FILES['file']['size']." bytes upload successful<br>";
echo "- <b>Загружен файл прайс-листа ".$path.$_FILES['file']['name']."</b>";
echo "<br>";
					}
					else
					{
						echo "<br>".$_FILES['file']['name']."<font color=red><b> не загружен.<b></font><br>";
						return;
					}
				}
			  }//------------------------ end if
//--------------------------------------------------------------------------------------------------------------
			if (file_exists ($path.$_FILES['file']['name']))
			  {
				$filename = $path.$_FILES['file']['name'];
				$type = $_FILES['file']['type'];
				if ($_FILES['file']['type'] == 'application/zip')
				{
					echo "Extract from ".$filename;
					echo "<br>";
					//include 'ziplib.php';
					//$zipfile = new Ziplib;
					//$index = $zipfile->zl_index_file($path);
					$zip = new ZipArchive;
					$zip->open($path.$_FILES['file']['name']);
					$zip->extractTo($path);
					$zip->close();

					$type = 'application/vnd.ms-excel';
					//import_from_xls($filename,$type);
				}

				if (($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') OR 
					($type == 'application/vnd.ms-excel') OR
					($type == 'application/x-excel'))
				{
					echo "<font color=green>Ok, XLS format file,  продолжаем импорт...</font>";
					echo "<br>";
					import_from_xls($filename);
				}
				else
				{
				        echo "<br><font color=red>error,  only Excel  format!!!</font><br>";
					echo "<br>";
					if (unlink ($filename))
					  {
					        echo "Remove  ".$filename;
						echo "<br>";
					  }
				 }//------------------------------------- end elseif

			 }//------------------------------------- end if
//--------------------------------------------------------------------------------------------------------------
		  }

	  }
	else
	  {
	        echo "<br><font color=red>Error. upload folder ".$path.",(".$perms.") no is_writable</font><br>";
		echo "<br>";
	  }//------------------------ end if


}//----------------------- end func

function import_from_xls($filename)
{
	echo "- <b>Чтение данных из ".$filename."</b>";
	echo "<br>";
	echo "Используемый формат прайс-листа:
<ul>
	<li>1 колонка - Раздел</li>
	<li>2 колонка - Подраздел</li>
	<li>3 колонка - Группа</li>
	<li>4 колонка - Подгруппа</li>
	<li>5 колонка - Наименование товара </li>
	<li>6 колонка - Цена</li>
	<li>7 колонка - Единица измерения</li>
</ul>";

	require_once '../sites/all/libraries/PHPExcel/PHPExcel/IOFactory.php';
	$objPHPExcel = PHPExcel_IOFactory::load($filename);

	$output = "";
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
	{
		$worksheetTitle = $worksheet->getTitle(); //Лист1Лист2Лист3 

		$highestRow = $worksheet->getHighestRow(); 
		$highestColumn = $worksheet->getHighestColumn(); 
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		//$nrColumns = ord($highestColumn) - 64;
	
		//$output .= "<br>В таблице ".$worksheetTitle." ";
		//$output .= $nrColumns . ' колонок (A-' . $highestColumn . ') ';
		//$output .= ' и ' . $highestRow . ' строк.';

		//$output .= '<br>Данные: <table border="1"><tr>';
		$output .= '<table><tr>';
		for ($row = 1; $row <= $highestRow; ++ $row)
		{
//echo "row = ".$row;
//echo "<br>";
			$output .= '<tr>';
			for ($col = 0; $col < $highestColumnIndex; ++ $col)
			{
//echo "col = ".$col;
//echo "<br>";
				$cell = $worksheet->getCellByColumnAndRow($col, $row);
				$val = $cell->getValue();
				if (!empty($val))
				  {
					$price[$row-1][$col]= $val;
				  }
				$output .= '<td>'.$val.'</td>';
			}
			$output .= '</tr>';
		}
		$output .= '</table>';

	} //------------------------ enf foreach
	
	//$output = iconv("UTF-8", "windows-1251",$output);
//echo $output;
//echo "<br>";

	import_price_in_db($price); // Занести прайс из XLS-таблицы в базу данных

}//----------------------- end func

//=======================================
// Занести прайс из XLS-таблицы в базу данных
//=======================================
function import_price_in_db($price)
{
//echo "price = <pre>";
//print_r($price);
//echo "</pre>";
//echo count ($price);
//echo "<br>";
//--------------------------------------------------------------------------------------------------
//   Определяем начало блока разделов, наименований товаров, цен
//--------------------------------------------------------------------------------------------------
	//setlocale(LC_ALL, 'ru_RU.UTF8'); // Решение проблемы strtolower() strtoupper() в кириллице 

	for ($n1=0; $n1 < count($price); $n1++)
	  {
		if (isset($price[$n1]))
		{
//echo count ($price[$n1]);
//echo "<br>";
			for ($n2=0; $n2 < count($price[$n1]); $n2++)
			  {
//echo $n2;
//-------------------------------------------------------------------------------------------------------------------------
				if (isset($price[$n1][$n2]))
				{
					//$test_str = strtoupper($price[$n1][$n2]);
					$test_str = $price[$n1][$n2];
//echo $test_str;
					if (substr_count($test_str, "Раздел") > 0) 
					  {
						$start_num_row = $n1;
						$part1_num_col = $n2;
						echo "Найден столбец <b>".$price[$n1][$n2]."</b> в строке ".$start_num_row.", колонка ".$part1_num_col;
						echo "<br>";
					  } //------------------------------------- end if
				  } 
//-------------------------------------------------------------------------------------------------------------------------
				if (isset($price[$n1][$n2]))
				{
					$test_str = $price[$n1][$n2];
					if (substr_count($test_str, "Подраздел") > 0) 
					  {
						$start_num_row = $n1;
						$part2_num_col = $n2;
						echo "Найден столбец <b>".$price[$n1][$n2]."</b> в строке ".$start_num_row.", колонка ".$part2_num_col;
						echo "<br>";
					  } //------------------------------------- end if
				  } 
//-------------------------------------------------------------------------------------------------------------------------
				if (isset($price[$n1][$n2]))
				{
					$test_str = $price[$n1][$n2];
					if (substr_count($test_str, "Групп") > 0) 
					  {
						$start_num_row = $n1;
						$part3_num_col = $n2;
						echo "Найден столбец <b>".$price[$n1][$n2]."</b> в строке ".$start_num_row.", колонка ".$part3_num_col;
						echo "<br>";
					  } //------------------------------------- end if
				  } 
//-------------------------------------------------------------------------------------------------------------------------
				if (isset($price[$n1][$n2]))
				{
					$test_str = $price[$n1][$n2];
					if (substr_count($test_str, "Подгрупп") > 0) 
					  {
						$start_num_row = $n1;
						$part4_num_col = $n2;
						echo "Найден столбец <b>".$price[$n1][$n2]."</b> в строке ".$start_num_row.", колонка ".$part4_num_col;
						echo "<br>";
					  } //------------------------------------- end if
				  } 
//-------------------------------------------------------------------------------------------------------------------------
				if (isset($price[$n1][$n2]))
				{
					$test_str = $price[$n1][$n2];
					if (substr_count($test_str, "Наименование") > 0) 
					  {
						$start_num_row = $n1;
						$product_num_col = $n2;
						echo "Найден столбец <b>".$price[$n1][$n2]."</b> в строке ".$start_num_row.", колонка ".$product_num_col;
						echo "<br>";
					  } //------------------------------------- end if
				  } 
//-------------------------------------------------------------------------------------------------------------------------
				if (isset($price[$n1][$n2]))
				{
					$test_str = $price[$n1][$n2];
					if (($test_str == "Цена")  OR (substr_count($test_str, "Розничная цена") > 0))
					  {
						$start_num_row = $n1;
						$price_num_col = $n2;
						echo "Найден столбец <b>".$price[$n1][$n2]."</b> в строке ".$start_num_row.", колонка ".$price_num_col;
						echo "<br>";
					  } //------------------------------------- end if
				  } 
//-------------------------------------------------------------------------------------------------------------------------
				if (isset($price[$n1][$n2]))
				{
					$test_str = $price[$n1][$n2];
					if ((substr_count($test_str, "измерения") > 0))
					  {
						$start_num_row = $n1;
						$units_num_col = $n2;
						echo "Найден столбец <b>".$price[$n1][$n2]."</b> в строке ".$start_num_row.", колонка ".$units_num_col;
						echo "<br>";
					  } //------------------------------------- end if
				  } 
//-------------------------------------------------------------------------------------------------------------------------
			  } //------------------------------------- end for
//echo "<br>";

		  } //------------------------------------- end if

	  }//------------------------------------- end for

	if ($start_num_row) 
	  {
		if (isset ($part1_num_col)) 
		  {
			if (isset ($part2_num_col)) 
			  {
				if (isset ($part3_num_col)) 
				  {
					//if (isset ($part4_num_col)) 
					  //{
						if (isset ($product_num_col)) 
						  {
							if (isset ($price_num_col)) 
							  {
								if (isset ($units_num_col)) 
								  {
									echo "<font color='green'>Ok, формат прайса успешно определен</font>";
									echo "<br>";
								  }
							  }
						  }
					  //}
				  }
			  }
		  }
	  }

	if ($start_num_row > 0)
	  {
		chdir('../');
//echo getcwd();
		require_once './includes/bootstrap.inc';drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

		$start_num_row++; // Переход к первой строке с данными о товаре
		//echo "начало блока данных в строке ".$start_num_row;
		//echo "<br>";

//------------------------------------------------------------------------------------------------------- информация о кол-ве разделов, подразделов, товаров
//   Определяем кол-во разделов, подраздел, групп
//--------------------------------------------------------------------------------------------------
		$part1_name = "";
		$part1_num = 0;

		$part2_name = "";
		$part2_num = 0;

		$part3_name = "";
		$part3_num = 0;

		$part4_name = "";
		$part4_num = 0;

		$num_products = 0;

		$end_num = count($price) + $start_num_row;
		for ($n1 = $start_num_row; $n1 < $end_num ; $n1++)
		  {

			if (isset($price[$n1][$part1_num_col]))
			{
				if ($price[$n1][$part1_num_col] != $part1_name)
				  {
					$part1_name = $price[$n1][$part1_num_col];
					$part1_num ++;
				  }
				else
				  {
				        //echo $n1.". <font color=red>ошибка, не найден раздел товара</font><br>";
				  }//------------------------ end if
			  }

			if (isset($price[$n1][$part2_num_col]))
			{
				if ($price[$n1][$part2_num_col] != $part2_name)
				  {
					$part2_name = $price[$n1][$part2_num_col];
					$part2_num ++;
				  }
				else
				  {
				        //echo $n1.". <font color=red>ошибка, не найден подраздел товара</font><br>";
				  }//------------------------ end if
			  }

			if (isset($price[$n1][$part3_num_col]))
			{
				if ($price[$n1][$part3_num_col] != $part3_name)
				  {
					$part3_name = $price[$n1][$part3_num_col];
					$part3_num ++;
				  }
				else
				  {
				        //echo $n1.". <font color=red>ошибка, не найдена группа товара</font><br>";
				  }//------------------------ end if
			  }

			if ( isset($part4_num_col) )
			  {
				if ( isset($price[$n1][$part4_num_col]) )
				  {
					if ($price[$n1][$part4_num_col] != $part4_name)
					  {
						$part4_name = $price[$n1][$part4_num_col];
						$part4_num ++;
					  }
				  }
				else
				  {
				        //echo $n1.". <font color=red>ошибка, не найдена подгруппа товара</font><br>";
				  }//------------------------ end if
			  }

			if (isset($price[$n1][$product_num_col]))
			  {
				$num_products ++;
			  }

		  }//------------------------------------- end for

		echo "<ul>";

		echo "Количество разделов: ".$part1_num;
		echo "<br>";

		echo "Количество подразделов: ".$part2_num;
		echo "<br>";

		echo "Количество групп: ".$part3_num;
		echo "<br>";

		echo "Количество подгрупп: ".$part4_num;
		echo "<br>";

		echo "Количество товаров для импорта: ".$num_products;
		echo "<br>";

		echo "</ul>";
//-----------------------------------------------------------------------------------------------------------------------------

//----------------------------------- ИМПОРТ
		echo "- <b>Начало импорта</b>";
		echo "<br>";
		unpublic_product();// Снятие товаров каталога с публикации перед импортом
		// кол-во товаров + начальная строка блока товаров определяют номер последнего элемента массива прайса
		$end_num = $num_products + $start_num_row;  
		//$end_num = 5 + $start_num_row;
		for ($n1 = $start_num_row; $n1 < $end_num ; $n1++)
		  {
//echo $n1.". ";
//echo $n1 - $start_num_row;
//echo "<br>";
			if ( !empty($price[$n1][$part4_num_col])  ) // если у товара заполнена погруппа, используем ее как термин словаря
			  {
				$termin = $price[$n1][$part4_num_col];
			  }
			else
			  {
				if ( !empty($price[$n1][$part3_num_col])  ) // если у товара заполнена Группа, используем ее как термин словаря
				  {
					$termin = $price[$n1][$part3_num_col];
				  }
				else
				  {
					if ( !empty($price[$n1][$part2_num_col])  ) // если у товара заполнен Подраздел, используем его как термин словаря
					  {
						$termin = $price[$n1][$part2_num_col];
					  }
					else
					  {
						if ( !empty($price[$n1][$part1_num_col])  ) // если у товара заполнен  Раздел, используем его как термин словаря
						  {
							$termin = $price[$n1][$part1_num_col];
						  }
					  }
				  }
			  }//------------------------------------ end elseif

			$title = $price[$n1][$product_num_col];
			$body = $price[$n1][$product_num_col];

//-----------------------------------------------------------------------------------------------------------------
// SCU , Артикул - сумма ASCII кодов названия товара 
//(при следующем импорте, товар с существующим артикулом только обновится)
//-----------------------------------------------------------------------------------------------------------------
			$sku=0;
			for ($n2=0; $n2 < strlen($title); $n2++)
			  {
				$sku = $sku + ord($title[$n2]);
			  }
//echo "sku = ".$sku;
//echo "<br>";
			//$model = '123456';
			$model  = $sku;
//-----------------------------------------------------------------------------------------------------------------
			$product_price = $price[$n1][$price_num_col];
			$units = $price[$n1][$units_num_col];
			$num = ($n1 - $start_num_row) + 1;
			test_product($num, $title, $body, $model, $product_price, $termin, $units); // Обновление или создание  товара
		  }//------------------------------------- end for

	  } //------------------------------------- end if
	else
	  {
		echo "<font color='red'>Ошибка, не найден блок данных о товарах</font>, ";
		echo "неверный  формат прайса ";
		echo "<br>";
	  } //------------------------------------- end else if

}//----------------------- end func

//--------------------------------------------------------------------------------------------------
// Снятие товаров каталога с публикации перед импортом
//--------------------------------------------------------------------------------------------------
function unpublic_product()
{
	echo "<b>Снятие товаров каталога с публикации перед импортом</b>";
	echo "<br>";
	$type ="product";
	db_query("UPDATE node SET status = '0' WHERE type = '".$type."'");
}//----------------------- end func

//-----------------------------------------------------------
// Обновление или создание  товара
//-----------------------------------------------------------
function test_product($num, $title, $body, $model, $product_price, $termin, $units)
{
	$model_result = 0;
	//Узнать статус товара с текущим артикулом (существует или новый)
	//$type ="product";
	$query = "SELECT nid, model FROM {uc_products} WHERE model =".$model;
	$result = db_query($query);
//echo "query = ". $query;
//echo "<br>";
	while ($row = db_fetch_object($result)) 
	  {  
//echo "<pre>";
//print_r($row);
//echo "</pre>";
		$model_result = 1;
		//echo "<font color='darkblue'>найден товар с артикулом</font> ".$model."<br>";
		update_product($num, $title, $body, $model, $product_price, $termin, $units, $row->nid); // Обновление товара
	  }

	if ($model_result == 0)
	  {
		//echo "<font color='darkblue'>нет товара с артикулом</font> ".$model."<br>";
		new_product($num, $title, $body, $model, $product_price, $termin, $units); // Создание нового товара
	  }
}//----------------------- end func

//-----------------------------------------------------------
// Создание нового товара
//-----------------------------------------------------------
function new_product($num, $title, $body, $model, $price, $termin, $units)
{
	if (empty($termin))
	  {
		echo "<font color='red'>Ошибка, нет раздела товара!!!</font><br>";
		return;
	  }

	$vid = 1; //Словарь Каталог
	$terms = taxonomy_get_tree($vid);
// Определить по названию, tid термина таксономии
	$termin_tid = 0;
	foreach ( $terms as $term )
	  {
//echo $term->tid.", ".$term->name." == ".$termin;
//echo "<br>";
		if ($term->name == $termin)
		  {
			$termin_tid = $term->tid;
//echo "termin_tid = ".$termin_tid;
//echo "<br>";
		  }
	  }

	if ($termin_tid > 0)
	  {
		$node = new stdClass();

		//$node->taxonomy['tags'] = array(vid=>$termin);
		$node->taxonomy[] = array($termin_tid);

		$node->type = 'product';
		$node->title = $title;
		$node->body = $body;
	//	$node->teaser = 'Текст анонса';
		$node->model = $model;
		$node->list_price = $price;
		$node->cost = $price;
		$node->sell_price = $price;
		$node->field_units[]['value'] = $units;
		$node->uid = 1;                  // id автора
		$node->status = 1;               // 1 - опубликовано, 0 - нет
		$node->promote = 1;              // 1 - показывать на главной, 0 - нет
	 	node_save($node);

		echo $num.". Добавление нового товара ".$node->model
." <a href='../node/".$node->nid."' target=_blank><b>".$node->title."</b></a> ("
.$node->list_price
.") в раздел <b>".$termin."</b>";
		echo "<br>";
	  }
	else
	  {
		echo "<font color='red'>Ошибка, не найден раздел товара</font>.<br> "
."Проверьте наличие <b>".$termin."</b> в терминах словаря <b>Каталог</b> "
."( <a href='../admin/content/taxonomy/1'>Управление содержимым - Таксономия - Список - список терминов</a> )<br>"
."и повторите импорт";
		return;
	  } //------------------------------------- end else if
}//----------------------- end func

//-----------------------------------------------------------
// Обновление товара
//-----------------------------------------------------------
function update_product($num, $title, $body, $model, $price, $termin, $units, $product_nid)
{
	$node = node_load($product_nid);

	//$node->taxonomy[] = array($termin_tid);

	$node->title = $title;
	//$node->body = $body;
	//$node->model = $model;
	$node->list_price = $price;
	$node->cost = $price;
	$node->sell_price = $price;
	$node->field_units[]['value'] = $units;
	//$node->uid = 1;                  // id автора
	$node->status = 1;               // 1 - опубликовано, 0 - нет
	//$node->promote = 1;              // 1 - показывать на главной, 0 - нет
	 node_save($node);

	echo $num.". Обновление товара ".$node->model
." <a href='../node/".$node->nid."' target=_blank><b>".$node->title."</b></a> ("
.$node->list_price
.") в раздел <b>".$termin."</b>";
	echo "<br>";

	$result = db_query("UPDATE node SET status = '1' WHERE nid = '".$product_nid."'"); //Опубликовать товар
}//----------------------- end func

//-----------------------------------------------------------
//Опубликовать все товары каталога
//-----------------------------------------------------------
function service_product($op)
{
	chdir('../');
//echo getcwd();
	require_once './includes/bootstrap.inc';drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

	switch ($op)
	{
//-------------------------------------------------------------------------
		case "public_product":
			$type ="product";
			$result = db_query("UPDATE node SET status = '1' WHERE type = '".$type."'");
			if ($result >0)
			  {
				echo "<b>Опубликовать все товары каталога</b>";
				echo "<br>";
			}
			else
			  {
			        echo "<br><font color=red>error publish nodes</font><br>";
				echo "<br>";
			  }//------------------------ end if
		break;
//-------------------------------------------------------------------------

		case "unpublic_product":
			unpublic_product();// Снятие товаров каталога с публикации перед импортом
		break;
//-------------------------------------------------------------------------

//-------------------------------------------------------------------------
		case "remove_product":
			echo "Remove product nodes";
			echo "<br>";
			$type ="product";
			$query = db_query("SELECT nid FROM {node} AS n WHERE type = '%s'",$type);
			while ($row = db_fetch_object($query)) 
			  {  
echo "<pre>";
print_r($row);  
echo "</pre>";
				node_delete($row->nid);
			  }
			//echo "Clear uc_product_stock"; // Очистить таблицу складских остатков
			//echo "<br>";
			//$query = db_query("TRUNCATE TABLE {uc_product_stock}");
		break;
//-------------------------------------------------------------------------

//-------------------------------------------------------------------------
		case "list_product":
			$type ="product";
			$query = db_query("SELECT nid FROM {node} AS n WHERE type = '%s'",$type);

			$output = "<table border=1>";
			$output .= "<tr>";
			$output .= "	<td>Nid</td>";
			$output .= "	<td>Title</td>";
			$output .= "	<td>Body</td>";
			$output .= "	<td>SKU (model)</td>";
			$output .= "	<td>list_price</td>";
			$output .= "	<td>cost</td>";
			$output .= "	<td>sell_price</td>";
			$output .= "	<td>taxonomy</td>";
			$output .= "	<td>status</td>";
			$output .= "	</tr>";

			while ($row = db_fetch_object($query)) 
			  {  
				$node = node_load($row->nid);
//echo "<pre>";
//print_r($node);
//echo "</pre>";
				$output .= "<tr>";

				$output .= "<td>".$node->nid."</td>";
				$output .= "<td>".$node->title."</td>";
				$output .= "<td>".$node->body."</td>";
				$output .= "<td>".$node->model."</td>";
				$output .= "<td>".$node->list_price."</td>";
				$output .= "<td>".$node->cost."</td>";
				$output .= "<td>".$node->sell_price."</td>";

				$output .= "<td>".$node->taxonomy[55]->name."</td>";

				$output .= "<td>".$node->status."</td>";

				$output .= "</tr>";
			  } //--------------------------------- end while

			$output .= "</table>";

			echo $output;

		break;
//-------------------------------------------------------------------------

	  }//------------------------ end  switch

}

?>

</body>
</html>


