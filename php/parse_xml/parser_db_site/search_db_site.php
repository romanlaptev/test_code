<?
//"grep -R italian ./*"
//"grep  Тьеполо *"
//****************************
// MAIN
//****************************
/*
echo "<pre>";
print_r ($_REQUEST);
//print_r ($_POST);
//print_r ($_SERVER);
echo "</pre>";
*/

// Извлекаем параметры из запроса
if (!isset($_REQUEST['action']) OR empty($_REQUEST['action']))
  {
	view_form_seacrh(); // вывод формы выбора параметров
  }
else // Параметр action определен
  {
	$action = $_REQUEST['action'];
//===============================================================================
	switch ($action)
	  {
		case search:
			//$filename = "/mnt/POCKI-DRIVE/opt/www/pages/xml/book_history_engraving.xml";
			//$txt = file_get_contents ($filename); 
			$tpl_page = "../pages/book_history_engraving/tpl/search_results.tpl"; 
			$charset = "utf-8";
			$css_styles = "/pages/book_history_engraving/css/search_results.css";
			$css_filter_text = "/pages/book_history_engraving/css/filter_text.css";

			if (!isset($_REQUEST['book_name']) OR empty($_REQUEST['book_name']))
			  {
				//echo "<font color=red>Need book_name.... </font>";
				//exit();
				$book_name[0] = "german_engraving";
				$book_name[1] = "netherlandish_engraving";
				$book_name[2] = "italian_engraving";
				$book_name[3] = "french_engraving_15_17";
				$book_name[4] = "06.French_engraving_18th";
				$book_name[5] = "japanese_colour_prints";
				$book_name[6] = "book_Beardsley";
			  }
			else
				$book_name = $_REQUEST['book_name'];

			if (!isset($_REQUEST['search_txt']) OR empty($_REQUEST['search_txt']))
			  {
				echo "<font color=red>Need search_txt.... </font>";
				exit();
			  }
			else
				$search_txt = $_REQUEST['search_txt'];

			if ($_REQUEST['tpl_page'])
			  {
				$tpl_page = $_REQUEST['tpl_page']; 
			  }
			if ($_REQUEST['charset'])
			  {
				$charset = $_REQUEST['charset']; 
			  }
			if ($_REQUEST['css_styles'])
			  {
				$css_styles = $_REQUEST['css_styles']; 
			  }
			if ($_REQUEST['css_filter_text'])
			  {
				$css_filter_text = $_REQUEST['css_filter_text']; 
			  }

			if (!isset($_REQUEST['xml_file']) OR empty($_REQUEST['xml_file']))
		  	  {
				//echo "<font color=red>Need xml_file...... </font>";
				//exit();
				$xml_file = "../pages/xml/db_site.xml";
			  }
			else
				$xml_file = $_REQUEST['xml_file'];

			//-----------------------------------------------------
			// Считать из XML-файла данные 
			//-----------------------------------------------------
			$xml = simplexml_load_file($xml_file);
			if ($xml == FALSE) 
			  {
				exit("<font color=red>Failed to open</font> ".$xml_file);
			  }
//echo "<pre>";
//print_r ($xml);
//echo "</pre>";

			$all_result = 0;// общий счетчик для кол-ва совпадений на всех страницах всех книг
			$count_result_pages = 0; // общий счетчик для всех страниц с результатами поиска
			$result_search_content = ""; // переменная для результатов поиска (ссылки и текст)
			for ($n1=0; $n1 < count($book_name); $n1++)
			  {
//echo $book_name[$n1];
				$xml_book = $xml->xpath('//art_books/book[@name="'.$book_name[$n1].'"]');
//echo "<pre>";
//print_r ($xml_book);
//echo "</pre>";
				$result = 0;
				$book_result_info = search_in_book($xml_book,$search_txt); // Поиск ключевой фразы в тексте параграфов книги
				if ($book_result_info[0] > 0)
				  {
//echo "In '".$book_name[$n1]."' find ".$book_result_info[0]." results (book_result_info[0])";
//echo "<br>";
					//echo "<p>";
					//echo "В тетради '".$book_name[$n1]."' найдено ".$book_result_info[0]." совпадений";
					//echo "</p>";
					$all_result = $all_result + $book_result_info[0];// общий счетчик для кол-ва совпадений на всех страницах всех книг
					$count_result_pages = $count_result_pages + $book_result_info[1]; // общий счетчик для всех страниц с результатами поиска
				 }
			  }//--------------------------------- end for


			if ($all_result == 0)
			  {
				$result_search = "Нет результатов поиска для - \"".$search_txt."\"";
			 }
			else
			  {
				$result_search = "Всего найдено ".$all_result." совпадений на ".$count_result_pages." страницах";
			 }

//------------------------------------------------------------------------------------------------------------------------------
			if ($tpl_page)
			  {
				$page = file_get_contents($tpl_page); // Считать в переменную шаблон страницы
				$page = str_replace ('<!--{CHARSET}-->', $charset, $page);
				$page = str_replace ('<!--{CSS_STYLES}-->', $css_styles, $page);
				$page = str_replace ('<!--{CSS_FILTER_TEXT}-->', $css_filter_text, $page);
				$page = str_replace ('<!--{COUNT_RESULT_SEARCH}-->', $result_search, $page);
				$page = str_replace ('<!--{RESULT_SEARCH_CONTENT}-->', $result_search_content, $page);
			  }
echo $page;
//------------------------------------------------------------------------------------------------------------------------------
		break;
//===============================================================================
	  }//------------------------------ end switch

  }//--------------------------------- end elseif action

//=================================================================================
// FUNCTIONS
//=================================================================================
//---------------------------------------------------
// ВЫВОД ФОРМЫ ПАРАМЕТРОВ 
//---------------------------------------------------
function view_form_seacrh()
{
echo"
<html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
<style>
legend
{
	color:red;
	font-size:16px;
}
</style>
</head>
<body>
<form name=form_search method=post action=".$_SERVER['PHP_SELF']." target=_blank>
	<fieldset>
	<legend><b>Поиск по страницам книги</b></legend>

	<div style='display:block;'>xml_file:		
		<input type='text'  name='xml_file' size='50' value=''><br><br>
		<p>
			db_site.xml<br>
		<ul>
			../pages/xml/<br>
			http://mycomp/pages/xml/<br>
		</ul>
		</p>
	</div>

	<div style='display:block;'>
	<p>tpl_page:
			<input type='text'  name='tpl_page' size='50' value='../pages/book_history_engraving/tpl/search_results.tpl'>
	</p>
	<p>css_styles:
			<input type='text'  name='css_styles' size='50' value='/pages/book_history_engraving/css/search_results.css'>
			<input type='text'  name='css_filter_text' size='50' value='/pages/book_history_engraving/css/filter_text.css'>
	</p>

	<p>charset:
	<select name='charset'>
			<option value='utf-8' selected >utf-8</option>
			<option value='windows-1251'>windows-1251</option>
		</select>
	<p>
	</div>

	<div style='display:none;'>
	<fieldset>
		<legend><b>Выбор книги (book_name)</b></legend>
		<p>
<!--			<input type='text'  name='book_name' size='20' value=''><br><br>-->
			<input type='checkbox'  name='book_name[]' size='20' value='german_engraving' checked >german_engraving<br>
			<input type='checkbox'  name='book_name[]' size='20' value='netherlandish_engraving' checked>netherlandish_engraving<br>
			<input type='checkbox'  name='book_name[]' size='20' value='italian_engraving' checked>italian_engraving		<br>
			<input type='checkbox'  name='book_name[]' size='20' value='french_engraving_15_17' checked>french_engraving_15_17<br>
			<input type='checkbox'  name='book_name[]' size='20' value='06.French_engraving_18th' checked>06.French_engraving_18th<br>
			<input type='checkbox'  name='book_name[]' size='20' value='japanese_colour_prints' checked>japanese_colour_prints	<br>
			<input type='checkbox'  name='book_name[]' size='20' value='book_Beardsley' checked>book_Beardsley			<br>
		</p>
	</fieldset>
	</div>

	<fieldset>
		<legend><b>Поисковая фраза (search_txt)</b></legend>
		<p>
			<input type='text'  name='search_txt' size='20' value=''><br>
Тьеполо<br>
Кастильоне<br>
Пармиджанино<br>
Дюрер<br>
Ars moriendi<br>
Лука Лейденский<br>
Госсарт<br>
Харунобу<br>
Судзуки Харунобу<br>
строгой каноничности в изображении черт лиц<br>
Калло<br>
Победы Александра Македонского<br>
рококо<br>
Буше<br>
Обри Винсент<br>
считается классическим образцом<br>
кьяроскуро<br>
chiaroscuro<br>
блочные книги<br>
Изобретенный в середине 15 века Гуттенбергом<br>
Гравюра на дереве<br>
Самсон<br>
		</p>
	</fieldset>

	<input type='hidden' name='action' value='search'><br>
	<input type=submit value='search'>

</form>
</body>
</html>";
} //-------------------------- end func

//-----------------------------------------------------------------------------------
// Поиск ключевой фразы в тексте параграфов книги
//----------------------------------------------------------------------------------
function search_in_book ($xml_book,$search_txt)
{
	global $result_search_content;
	$num_pages = sizeof($xml_book[0]->page);// подсчитать количество страниц книги
//echo "num_pages = ".$num_pages;
//echo "<br>";

	$replace_txt="<span class='replace_text'>".$search_txt."</span>";
	$book_result_info[0] = 0; //счетчик результатов поиска в одной книге
	$book_result_info[1] = 0; //счетчик страниц с результатами поиска в одной книге

	for ($n1=0; $n1 < $num_pages; $n1++)
	  {
//---------------------------------------------------------------------------------------------------------------------------------------------------
		//Получить текст всех тегов страниы (заголовки, параграфы, описания изображений)
		$title = "";
		$paragraph_text = "";
		$pictures_text = "";

		$title="<h2>".$xml_book[0]->page[$n1]->title."</h2>";

		$num_paragraph = sizeof($xml_book[0]->page[$n1]->text_column->p);
		for ($n2=0; $n2 < $num_paragraph; $n2++)
		  {
			$paragraph_text = str_replace("[notes]", "<span class='notes'>", $paragraph_text);
			$paragraph_text = str_replace("[/notes]", "</span>", $paragraph_text);

			$paragraph_text = str_replace("[term]", "<span class='term'>", $paragraph_text);
			$paragraph_text = str_replace("[/term]", "</span>", $paragraph_text);

			$paragraph_text = str_replace("[name]", "<span class='name'>", $paragraph_text);
			$paragraph_text = str_replace("[/name]", "</span>", $paragraph_text);

			$paragraph_text = str_replace("[date]", "<span class='date'>", $paragraph_text);
			$paragraph_text = str_replace("[/date]", "</span>", $paragraph_text);

			$paragraph_text = str_replace("[picture_text]", "<span class='picture_text'>", $paragraph_text);
			$paragraph_text = str_replace("[/picture_text]", "</span>", $paragraph_text);
			$paragraph_text = str_replace("[picture_txt]", "<span class='picture_txt'>", $paragraph_text);
			$paragraph_text = str_replace("[/picture_txt]", "</span>", $paragraph_text);

			$paragraph_text .= "<p>".$xml_book[0]->page[$n1]->text_column->p[$n2]."</p>";
		  } //------------------------ end for

		$num_img = sizeof($xml_book[0]->page[$n1]->picture_column->img);
		for ($n2=0; $n2 < $num_img; $n2++)
		  {
			//$loc = $xml_book[0]->location_content."/w300/";
			//$url = $xml_book[0]->page[$n1]->picture_column->img[$n2]['src'];
			//$pictures_text .= "<div class='picture'>";
			//$pictures_text .= "<img src='".$loc.$url."'>";
			$pictures_text .= $xml_book[0]->page[$n1]->picture_column->img[$n2]['alt'];
			//$pictures_text .= "</div>";
		  } //------------------------ end for

		$page_text=$title.$paragraph_text.$pictures_text;
		$page_text = str_replace ($search_txt, $replace_txt, $page_text,$count);

//---------------------------------------------------------------------------------------------------------------------------------------------------

		if ($count > 0)
		  {
			$num_page = $n1 +1;
			$book_result_info[1]++; //увеличение счетчика страниц с поисковой фразой
			$result_search_content .= "<div class='search_result'>";
			$loc = $xml_book[0]->location;
			$url = $xml_book[0]->page[$n1]->url;
			$url_title = $xml_book[0]->page[$n1]->title; //включить в текст результатов поиска, заголовок страницы
			if (empty($url_title))
			  {
				$url_title= $loc.$url;
			  }
			$result_search_content .= "<div class='search_result_url'>";
			$result_search_content .= $book_result_info[1].". <a href='".$loc.$url."'>".$url_title."</a>";
			$result_search_content .= "</div>";

			$result_search_content .= "<div class='search_result_text'>";
			$result_search_content .= $page_text;
			$result_search_content .= "</div>";

			$result_search_content .= "</div>";
//echo "count = ".$count;
//echo "<br>";
			$book_result_info[0] = $book_result_info[0] + $count;
		  }
	  } //------------------------ end for

	if ($book_result_info[1] > 0)
	  {
		$result_search_content .= "<br><br>";
	  } 

	return $book_result_info;
}//----------------------- end function

?>

