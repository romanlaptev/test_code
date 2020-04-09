<?
//****************************
// MAIN
//****************************
echo "<pre>";
print_r ($_REQUEST);
//print_r ($_POST);
//print_r ($_SERVER);
echo "</pre>";

// Извлекаем параметры из запроса
if (!isset($_REQUEST['action']) OR empty($_REQUEST['action']))
  {
	view_form(); // вывод формы выбора параметров парсинга
  }
else // Параметр action определен
  {
	$action = $_REQUEST['action'];

	if (isset($_REQUEST['charset'])OR empty($_REQUEST['charset']))
	  {
		//$charset = "windows-1251";
		//$charset = "utf-8";
		$charset = $_REQUEST['charset'];
	  }
	else
	  {
		echo "<font color=red>charset..... </font>";
		exit();
	  }

	//-----------------------------------------------------
	// Считать из XML-файла данные 
	//-----------------------------------------------------
	if (!isset($_REQUEST['xml_file']) OR empty($_REQUEST['xml_file']))
  	{
		echo "<font color=red>Need xml_file...... </font>";
		exit();
	  }
	$xml_file = $_REQUEST['xml_file'];
	$xml = simplexml_load_file($xml_file);
	if ($xml == FALSE) 
	  {
		exit("Failed to open ".$xml_file);
	  }
//echo "<pre>";
//print_r ($xml);
//echo "</pre>";

	if (!isset($_REQUEST['fs_pages']) OR empty($_REQUEST['fs_pages']))
	  {
		echo "<font color=red>Need fs_pages..... </font>";
		exit();
	  }
	$fs_pages = $_REQUEST['fs_pages'];

	if ($_REQUEST['save'] == 'on')
	  {
		$save='on';
	  }

	if ($_REQUEST['tpl_page']=="" OR empty($_REQUEST['tpl_page']))
	  {
		echo "<font color=red>need tpl_page..... </font>";
		exit();
	  }
	$tpl_page=	$_REQUEST['tpl_page'];

	if ($_REQUEST['tpl_content']=="" OR empty($_REQUEST['tpl_content']))
	  {
		echo "<font color=red>need tpl_content..... </font>";
		exit();
	  }
	$tpl_content =	$_REQUEST['tpl_content'];

	if ($_REQUEST['css_styles']=="" OR empty($_REQUEST['css_styles']))
	  {
		echo "<font color=red>need css_styles..... </font>";
		exit();
	  }
	$css_styles	=	$_REQUEST['css_styles'];

	if ($_REQUEST['url_img']=="" OR empty($_REQUEST['url_img']))
	  {
		echo "<font color=red>need url_img..... </font>";
		exit();
	  }
	$url_img	=	$_REQUEST['url_img'];

	// ПЕРЕХОД к парсингу XML согласно переданным параметрам
	switch ($action)
	  {
		case parse_pages_book_history_art: 
				parse_book($xml);
		break;

	  }//------------------------------ end switch

  }//--------------------------------- end elseif action
//=================================================================================

//====================
// FUNCTIONS
//====================
//---------------------------------------------------------------------
// ВЫВОД ФОРМЫ ПАРАМЕТРОВ ПАРСИНГА
//---------------------------------------------------------------------
function view_form()
{
echo"
<html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<form name=form_parse_pages method=post action='".$_SERVER['SCRIPT_NAME']."' target=_blank>
	<fieldset>
	<legend><b>Формирование страниц</b></legend>

	<fieldset>
	<legend><b>общие переменные</b></legend>

	<div>xml_file:		
		<input type='text'  name='xml_file' size='50' value='book_history_art_t1.xml'><br><br>
		<p>
			book_history_art_t1.xml<br>
		<ul>
			../pages/xml/<br>
			http://vbox1/sites/www2/my_sites/pages/xml/<br>
			http://mycomp/pages/xml/<br>
		</ul>
		</p>

	</div>

	<p>charset:
	<select name='charset'>
			<option value='utf-8' selected >utf-8</option>
			<option value='windows-1251'>windows-1251</option>
		</select>
	<p>
	</fieldset>

<!-- ================================================= -->
	<fieldset>
	<legend><b>Формирование страниц книги, Т. В. Ильина. ИСТОРИЯ ИСКУССТВ (parse_pages_book_history_art)</b></legend>
		<div>
			<p>num_book: 		
			<input type='text'  name='num_book' size='5' 	value='0'><br><br>
num_book = 0;	//Западноевропейское искусство.<br>
num_book = 1;	//Отечественное искусство.<br>
			</p>
		</div>
	</fieldset>
<!-- ================================================= -->

	<div>
	 	tpl_page:		<input type='text'  name='tpl_page' size='50' 	value='page.tpl'><br><br>
	 	tpl_content:<input type='text'  name='tpl_content' size='50' 	value='content.tpl'><br>

		<p>p1
			<ul>
				http://mycomp/pages/book_history_art/tpl/<br>
				../pages/book_history_art/tpl/<br>
			</ul>
		</p>

		<p>p2
			<ul>
				/t1/<br>
				/t2/<br>
				page.tpl<br>
				page_index.tpl<br>
			</ul>
		</p>
	</div>

	<div>css_styles: 		
		<input type='text'  name='css_styles' size='50' 		value='book_style.css'><br><br>
		<p>
			/pages/book_history_art/css/<br>
			<ul>
				book_style.css<br>
			</ul>
		</p>

		<p>js_location: 		
			<input type='text'  name='js_location' size='50'		value='/pages/js'><br><br>
		</p>
	</div>

	<div>url_img: 
		<input type='text'  name='url_img' size='50' 		value=''><br><br>
		p1<p>
			../../content<br>
			http://mycomp/content<br>
		</p>

		p2<p>
			/book_history_art/t1<br>
			/book_history_art/t2<br>
		</p>
	</div>

	<div>fs_pages (файловый путь для сохранения страницы. Относительно парсера!!!!):<br/> 		
		<input type='text'  name='fs_pages' size='50' 		value=''><br><br>
		<p>
../pages/book_history_art/t1/<br>
../pages/book_history_art/t2/<br>
		</p>

		<p>save in files: 		
			<input type='checkbox'  name='save'>
		</p>
	</div>

	<div>action:
		<input type='text' name='action' value=''><br>
		<p>
parse_pages_book_history_art<br>
		<input type=submit value='run script'>
		</p>
	</div>

	</fieldset>
</form>
</body>
</html>";
} //-------------------------- end func


//---------------------------------------------
// Обработка страниц книги
//--------------------------------------------
function parse_book($xml)
  {
	global $save,
			$fs_pages, 
			$tpl_page,
			$tpl_content, 
			$charset,
			$css_styles;
/*
echo "function parse_book()";
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";

$xml, 
$num_book, 
$num_page, 
$base_url, 
$tpl_page,
$css_styles,
$js_location,
$url_pages,
$url_img,
$num_pages, 
$title,
*/

//<title>
	$book_title = $xml->title->author;
	$book_title .= ". ";
	$book_title .= $xml->title->name;
echo $book_title;
echo "<br>";
	$meta_keywords = $xml->meta['keywords'];
	$meta_description = $xml->meta['description'];

	//---------------------------------------------------------
	// Формируем страницу оглавления
	//---------------------------------------------------------
	form_content_page ($xml,
							$tpl_content,
							$charset,
							$book_title,
							$css_styles,	
							$meta_keywords,
							$meta_description,
							$fs_pages,
							$save);
//<info>
//echo "<pre>";
//echo $xml->info;
//echo "</pre>";
//echo "<br>";

//<foreword>
//echo "<pre>";
//echo $xml->foreword;
//echo "</pre>";
//echo "<br>";
//echo "<hr>";

	$num_parts = count($xml->part);

//================================================
	//-----------------------------------------------------------------------------------------------------
	// Сформировать верхний блок индекса из заголовков частей учебника
	//-----------------------------------------------------------------------------------------------------
	$index_content ="";
	for ($n1=0; $n1< $num_parts; $n1++)
	 {
		$page_title  = $xml->part[$n1]['title'];
		$page_name = "part-".$n1.".html";
		$top_index_content .="\t<a href='".$page_name."'>".$page_title."</a>\n";
	 }//---------------------- end for

//================================================
	for ($n1=0; $n1< $num_parts; $n1++)
	 {
//$n1=0;
		$part = parse_book_part($xml->part[$n1],$n1+1);// Обработка части книги
//echo $part."<hr/>";
		// Применить шаблон к содержанию части книги
		$page_part = file_get_contents($tpl_page); // Считать в переменную шаблон страницы
		$page_part = str_replace ('{CHARSET}', $charset, $page_part); // Заменить теги шаблона, данными
		$page_part = str_replace ('{TITLE}', $xml->part[$n1]['title'].", ".$book_title, $page_part);
		$page_part = str_replace ('{CSS_STYLES}', $css_styles, $page_part);
		$page_part = str_replace ('{KEYWORDS}', $meta_keywords, $page_part);
		$page_part = str_replace ('{DESCRIPTION}', $meta_description, $page_part);
		$page_part = str_replace ('{CONTENT}', $top_index_content, $page_part);
		$page_part = str_replace ('{TEXT}', $part, $page_part);

		if ($save == 'on')
		  {
			$page_name = "part-".$n1.".html";
			$filename = $fs_pages.$page_name;
			$result_save = file_put_contents ($filename, $page_part);
			if ($result_save > 0)
			  {
				echo "<font color=green>Save page in </font>".$filename.", ".$result_save." bytes";
				echo "<br>";
			  }
			else
			  {
				echo "<font color=red>Error! Dont save page </font>".$filename.", ".$result_save." bytes";
				echo "<br>";
			  }
		  }

	  }//---------------------- end for

//<close>
//echo "<pre>";
//echo $xml->close;
//echo "</pre>";

//<recommended_reading>
//echo "<pre>";
//echo $xml->recommended_reading;
//echo "</pre>";

} //-------------------- end function

//---------------------------------------------------------
// Формируем страницу оглавления
//---------------------------------------------------------
function form_content_page ($xml,
							$tpl_content,
							$charset,
							$book_title,
							$css_styles,	
							$meta_keywords,
							$meta_description,
							$fs_pages,
							$save)
{
/*
echo "function form_content_page";
echo "<br>";
echo "save = ".$save;
echo "<br>";
echo "fs_pages = ".$fs_pages;
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";
*/

// Применить шаблон к содержанию книги
	$page_index = file_get_contents($tpl_content); // Считать в переменную шаблон страницы
	$page_index = str_replace ('{CHARSET}', $charset, $page_index); // Заменить теги шаблона, данными
	$page_index = str_replace ('{TITLE}', $book_title, $page_index);
	$page_index = str_replace ('{CSS_STYLES}', $css_styles, $page_index);
	$page_index = str_replace ('{KEYWORDS}', $meta_keywords, $page_index);
	$page_index = str_replace ('{DESCRIPTION}', $meta_description, $page_index);
	$page_index = str_replace ('{BOOK_TITLE_AUTHOR}', $xml->title->author, $page_index);
	$page_index = str_replace ('{BOOK_TITLE_NAME}', $xml->title->name, $page_index);
//echo $page_index;


	// СЧИТАТЬ ШАБЛОН блока внешних ссылок в переменную
	$content_links_tpl_start = "<!-- CONTENT_LINKS_TPL_START -->";
	$content_links_tpl_end = "<!-- CONTENT_LINKS_TPL_END -->";
	//Возвращает позицию первого вхождения подстроки
	$pos1 = strpos($page_index, $content_links_tpl_start) + strlen($content_links_tpl_start);
	$length = strpos($page_index, $content_links_tpl_end) - $pos1;
	//Возвращает подстроку - шаблон
	$content_links_tpl = substr($page_index, $pos1, $length); // считать строку с шаблоном в переменную
//echo $content_links_tpl;
	$page_index = str_replace ($content_links_tpl, "", $page_index); // удалить шаблон внешних ссылок из шаблона книги

// Считать шаблоны подсекции, секции, главы, части из родительского шаблона

	// Считать шаблон ссылок для подсекций книги в отдельную переменную
	$section2_links_tpl_start = "<!-- SECTION2_LINKS_START -->";
	$section2_links_tpl_end = "<!-- SECTION2_LINKS_END -->";
	//Возвращает позицию первого вхождения подстроки
	$pos1 = strpos($content_links_tpl, $section2_links_tpl_start) + strlen($section2_links_tpl_start);
	$length = strpos($content_links_tpl, $section2_links_tpl_end) - $pos1;
	//Возвращает подстроку - шаблон
	$section2_links_tpl = substr($content_links_tpl, $pos1, $length); // скопировать строку с шаблоном ссылок в переменную
	$content_links_tpl = str_replace ($section2_links_tpl, "", $content_links_tpl); // удалить шаблон ссылок из родительского шаблона

	// Считать шаблон ссылок для секций книги в отдельную переменную
	$section_links_tpl_start = "<!-- SECTION_LINKS_START -->";
	$section_links_tpl_end = "<!-- SECTION_LINKS_END -->";
	$pos1 = strpos($content_links_tpl, $section_links_tpl_start) + strlen($section_links_tpl_start);
	$length = strpos($content_links_tpl, $section_links_tpl_end) - $pos1;
	//Возвращает подстроку - шаблон
	$section_links_tpl = substr($content_links_tpl, $pos1, $length); // скопировать строку с шаблоном ссылок в переменную
//echo "section_links_tpl = ".$section_links_tpl;
//echo "<br>";
	$content_links_tpl = str_replace ($section_links_tpl, "", $content_links_tpl); // удалить шаблон ссылок из родительского шаблона

	// Считать шаблон ссылок для глав книги в отдельную переменную
	$chapter_links_tpl_start = "<!-- CHAPTER_LINKS_START -->";
	$chapter_links_tpl_end = "<!-- CHAPTER_LINKS_END -->";

	$pos1 = strpos($content_links_tpl, $chapter_links_tpl_start) + strlen($chapter_links_tpl_start);
	$length = strpos($content_links_tpl, $chapter_links_tpl_end) - $pos1;
	//Возвращает подстроку - шаблон
	$chapter_links_tpl = substr($content_links_tpl, $pos1, $length); // скопировать строку с шаблоном ссылок в переменную
//echo "chapter_links_tpl = ".$chapter_links_tpl;
//echo "<br>";
	$content_links_tpl = str_replace ($chapter_links_tpl, "", $content_links_tpl); // удалить шаблон ссылок из родительского шаблона

	// СЧИТАТЬ ШАБЛОН внешних ссылок для части книги в отдельную переменную
	$part_links_tpl_start = "<!-- PART_LINKS_START -->";
	$part_links_tpl_end = "<!-- PART_LINKS_END -->";
	//Возвращает позицию первого вхождения подстроки
	$pos1 = strpos($content_links_tpl, $part_links_tpl_start) + strlen($part_links_tpl_start);
	$length = strpos($content_links_tpl, $part_links_tpl_end) - $pos1;
	//Возвращает подстроку - шаблон
	$part_links_tpl = substr($content_links_tpl, $pos1, $length); // скопировать строку с шаблоном ссылок в переменную
	$content_links_tpl = str_replace ($part_links_tpl, "", $content_links_tpl); // удалить шаблон ссылок из родительского шаблона

//-----------------------------------------------------------------------------------

	$num_parts = count($xml->part);
	for ($n1=0; $n1< $num_parts; $n1++)
	  {
		$part_title  = $xml->part[$n1]['title'];
		$part_url = "part-".$n1.".html";

		$part_links = $part_links_tpl; // скопировать строку с шаблоном ссылок в переменную
		$part_links = str_replace ('{NUM_PART}', $n1, $part_links); // вставить номер части книги в строку шаблона
		$part_links = str_replace ('{PART_URL}', $part_url, $part_links); // вставить расположение страницы части книги в строку шаблона
		$part_links = str_replace ('{PART_TITLE}', $part_title, $part_links); // вставить заголовок части книги в строку шаблона
		$base_index_content .= $part_links;

		$num_chapters = count($xml->part[$n1]->chapter);
		if ($num_chapters > 0)
		  {

			for ($n2=0; $n2< $num_chapters; $n2++)
			  {
				$chapter_title  = $xml->part[$n1]->chapter[$n2]['title'];
				$chapter_url = "chapter-".$n2.".html";

				$chapter_links = $chapter_links_tpl; // скопировать строку с шаблоном ссылок в переменную
				$chapter_links = str_replace ('{CHAPTER_URL}', $chapter_url, $chapter_links); // вставить расположение страницы книги в строку шаблона
				$chapter_links = str_replace ('{CHAPTER_TITLE}', $chapter_title, $chapter_links); // вставить заголовок в строку шаблона
				$base_index_content .= $chapter_links;

				$num_sections = count($xml->part[$n1]->chapter[$n2]->section);
				if ($num_sections > 0)
				  {
//echo "num_sections = ".$num_sections;
//echo "<br>";

					for ($n3=0; $n3< $num_sections; $n3++)
					  {
						$section_title  = $xml->part[$n1]->chapter[$n2]->section[$n3]['title'];
						$section_url = "section-".$n3.".html";

						$section_links = $section_links_tpl; // скопировать строку с шаблоном ссылок в переменную
						$section_links = str_replace ('{SECTION_URL}', $section_url, $section_links); // вставить расположение страницы книги в строку шаблона
						$section_links = str_replace ('{SECTION_TITLE}', $section_title, $section_links); // вставить заголовок в строку шаблона
						$base_index_content .= $section_links;

						$num_sections2 = count($xml->part[$n1]->chapter[$n2]->section[$n3]->section2);
						if ($num_sections2 > 0)
						  {
//echo "num_sections2 = ".$num_sections2;
//echo "<br>";

							for ($n4=0; $n4< $num_sections2; $n4++)
							  {
								$section2_title  = $xml->part[$n1]->chapter[$n2]->section[$n3]->section2[$n4]['title'];
								$section2_url = "section2-".$n4.".html";

								$section2_links = $section2_links_tpl; // скопировать строку с шаблоном ссылок в переменную
								$section2_links = str_replace ('{SECTION2_URL}', $section2_url, $section2_links); // вставить расположение страницы книги в строку шаблона
								$section2_links = str_replace ('{SECTION2_TITLE}', $section2_title, $section2_links); // вставить заголовок в строку шаблона
								$base_index_content .= $section2_links;
							  }//--------------------------------------- end for sections2

						  }//----------------------------------- end if

					  }//--------------------------------------- end for sections

				  }//----------------------------------- end if

			  }//--------------------------------------- end for chapters

		    }//----------------------------------- end if

	  }//--------------------------------------- end for parts


	$page_index = str_replace ('{CONTENT}', $base_index_content, $page_index);
// Записать оглавление в файл
	if ($save == 'on')
	  {
			$filename = $fs_pages."content.html";
			$result_save = file_put_contents ($filename, $page_index);
			if ($result_save > 0)
			  {
				echo "<font color=green>Save page in </font>".$filename.", ".$result_save." bytes";
				echo "<br>";
			  }
			else
			  {
				echo "<font color=red>Error! Dont save page </font>".$filename.", ".$result_save." bytes";
				echo "<br>";
			  }
	  }

} //-------------------- end function

//---------------------------------------------
// Обработка части книги
//---------------------------------------------
function parse_book_part($xml,$num_part)
{
/*
echo "function parse_book_part()";
echo "<br>";
echo "<pre>";
print_r ($xml);
echo "</pre>";
*/
	$content = "<h2>";
	$content .= $num_part.". ";
	$content .= $xml['title'];
	$content .= "</h2>";
//--------------------------------------- PART text
	$text = parse_book_p($xml);
	$content .= $text;

//--------------------------------------- CHAPTERS
	$num_chapters = count($xml->chapter);
	for ($n1=0; $n1< $num_chapters; $n1++)
	  {
		// Обработка главы книги
		$chapter = parse_book_chapter($xml->chapter[$n1],$n1+1);
		//echo $chapter."<hr/>";
		$content .= $chapter;
	  }
//--------------------------------------- PART PICTURES
	$pictures = parse_book_pictures($xml);
	$content .= $pictures;

	return $content;

} //-------------------- end function

//---------------------------------------------
// Обработка главы книги
//---------------------------------------------
function parse_book_chapter($xml,$num_chapter)
{
/*
echo "function parse_book_chapter()";
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";
*/
	$content = "<h3>";
	$content .= $num_chapter.". ";
	$content .= $xml['title'];
	$content .= "</h3>";

//--------------------------------------- CHAPTER text
	$text = parse_book_p($xml);
	$content .= $text;

//--------------------------------------- SECTION
	$num_sections = count($xml->section);
	for ($n1=0; $n1< $num_sections; $n1++)
	  {
		// Обработка секции главы книги
		$section = parse_book_section($xml->section[$n1],$n1+1);
		$content .= $section;
	  }
//--------------------------------------- CHAPTER PICTURE
	$pictures = parse_book_pictures($xml);
	$content .= $pictures;

	return $content;

} //-------------------- end function

//---------------------------------------------
// Обработка секции главы книги
//---------------------------------------------
function parse_book_section($xml,$num_section)
{
/*
echo "function parse_book_section()";
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";
*/
	$content = "<h4>";
	$content .= $num_section.". ";
	$content .= $xml['title'];
	$content .= "</h4>";
	$text = parse_book_p($xml);
	$content .= $text;

//--------------------------------------- SECTION2
	$num_sections2 = count($xml->section2);
	for ($n1=0; $n1< $num_sections2; $n1++)
	  {
		// Обработка секции главы книги
		$section2=parse_book_section2($xml->section2[$n1]);
//echo "<font color=red>";
//echo $section2;
//echo "</font>";
		$content .= $section2;
	  }
//--------------------------------------- 
	$pictures = parse_book_pictures($xml);
	$content .= $pictures;

	return $content;
} //-------------------- end function


//---------------------------------------------
// Обработка подсекции главы книги
//---------------------------------------------
function parse_book_section2($xml)
{
/*
echo "function parse_book_section2()";
echo "<br>";
echo "<pre>";
print_r ($xml);
echo "</pre>";
*/
	$content = "<h5>";
	$content .= $xml['title'];
	$content .= "</h5>";

	$text = parse_book_p($xml);
	$content .= $text;

	$pictures = parse_book_pictures($xml);
	$content .= $pictures;
	return $content;
} //-------------------- end function

//========================================================

//--------------------------------------------------------------------------------------------------------------------------
// Обработка тегов <P> элемента книги (глава, секция, подсекция)
//-------------------------------------------------------------------------------------------------------------------------
function parse_book_p($xml)
{
	$content = "";
	$num_p = count($xml->p);
	for ($n1=0; $n1< $num_p; $n1++)
	  {
		$content .= "<p>";
		$content .=  $xml->p[$n1];
		$content .= "</p>";
	  }
	return $content;
} //-------------------- end function

//--------------------------------------------------------------------------------------------------------------------------
// Обработка тегов <PICTURE> элемента книги (глава, секция, подсекция)
//-------------------------------------------------------------------------------------------------------------------------
function parse_book_pictures($xml)
{
	global $url_img;

	$content = "";
	$num_pics = count($xml->picture);
	for ($n1=0; $n1< $num_pics; $n1++)
	  {
		$content .= "<p>";
		$content .= "<img src='".$url_img."/".$xml->picture[$n1]->img['src']."'>";
		$content .= "<i>";
		$content .= $xml->picture[$n1]->title;
		$content .= "</i>";
		$content .= "</p>";
	  }
	return $content;
} //-------------------- end function

?>

