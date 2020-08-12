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
		echo "<font color=red> Need parametr CHARSET...... </font>";
		echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?charset=";
		echo " <br>";
		echo " =\"utf-8\"";
		echo " or <br>";
		echo " =\"windows-1251\"";
		echo " <br>";
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

	//----------------------------------------------------------------------------------------------
	// Считать из XML-файла данные  о скрипте яндекс-метрики
	//----------------------------------------------------------------------------------------------
	if ($_REQUEST['ya_metrika_title'])
	  {
		$yandex_metrika_title = $_REQUEST['ya_metrika_title'];
		$yandex_metrika_file = $_REQUEST['ya_metrika_file'];
		$yandex_metrika_xml = simplexml_load_file($yandex_metrika_file);
		if ($yandex_metrika_xml == FALSE) 
		  {
			exit("Failed to open ".$yandex_metrika_file);
		  }
//echo "yandex_metrika_xml = <pre>";
//print_r ($yandex_metrika_xml);
//echo "</pre>";
		for ($n1=0; $n1 < count($yandex_metrika_xml->item); $n1++)
		  {
			if ($yandex_metrika_xml->item[$n1]['title'] == $yandex_metrika_title)
			  {
				$yandex_metrika = $yandex_metrika_xml->item[$n1]->code;
//echo $yandex_metrika;
//echo "<br>";
//echo "<pre>";
//print_r ($yandex_metrika_xml->item[$n1]);
//echo "</pre>";
			  }
		  }
	  }
	//----------------------------------------------------------

	if ($_REQUEST['save'] == 'on')
	  {
		$save='on';
		if (!isset($_REQUEST['fs_pages']) OR empty($_REQUEST['fs_pages']))
		  {
			echo "<font color=red>Need fs_pages..... </font>";
			echo "<br>";
			exit();
		  }
		else
			$fs_pages = $_REQUEST['fs_pages'];
	  }

	if ($_REQUEST['tpl_page']=="" OR empty($_REQUEST['tpl_page']))
	  {
		echo "<font color=red>need tpl_page..... </font>";
		exit();
	  }
	$tpl_page=	$_REQUEST['tpl_page'];

//------------Sitemap.xml---------------------------------------------------------------------------------
	if ($_REQUEST['sitemap_name'])
	  {
		if ($_REQUEST['sitemap_tpl_file'])
		  {
			//подготовка шаблонов для формирования карты  ссылок
			prep_sitemap_tpl($_REQUEST['sitemap_name'], $_REQUEST['sitemap_tpl_file']); 
		  }
		else
			echo "<font color=red>need sitemap_tpl_file.... </font><br>";
	  }
//-------------------------------------------------------------------------------------------------------

//------------STYLES----------------------------------------------------------------------------------
	if ($_REQUEST['css_styles']=="" OR empty($_REQUEST['css_styles']))
	  {
		echo "<font color=red>need css_styles..... </font>";
		exit();
	  }
	$css_styles	=	$_REQUEST['css_styles'];

	if ($_REQUEST['css_pager'])
	  {
		$css_pager	=	$_REQUEST['css_pager'];
	  }
//---------------------------------------------------------------------------------------------------

	// ПЕРЕХОД к парсингу XML согласно переданным параметрам
	switch ($action)
	  {
		case parse_lib_book_pages_index: // создание индексной страницы

			if ($_REQUEST['xml_base_path'])
			  {
				$xml_base_path	=	$_REQUEST['xml_base_path'];
			  }
			else
			  {
				echo "<font color=red>need xml_base_path..... </font>";
				exit();
			  }

			if ($_REQUEST['xml_item'])
			  {
				$xml_item	=	$_REQUEST['xml_item'];
			  }
			else
			  {
				echo "<font color=red>need xml_item.... </font>";
				exit();
			  }

			if ($_REQUEST['xml_keywords_value'])
			  {
				$xml_keywords_value=$_REQUEST['xml_keywords_value'];
			  }
			else
			  {
				echo "<font color=red>need xml_keywords_value.... </font>";
				exit();
			  }

			if (!isset($_REQUEST['lib_location']) OR empty($_REQUEST['lib_location']))
			  {
				echo "<font color=red>Need lib_location.... </font>";
				exit();
			  }
			$lib_location = $_REQUEST['lib_location'];

			if ($_REQUEST['tpl_index']=="" OR empty($_REQUEST['tpl_index']))
			  {
				echo "<font color=red>need tpl_index.... </font>";
				exit();
			  }
			$tpl_index=	$_REQUEST['tpl_index'];

			$page = file_get_contents($tpl_index); // Считать в переменную шаблон индексной страницы
			$page = str_replace ('{CHARSET}', $charset, $page); // Заменить теги шаблона, данными
			$page = str_replace ('{CSS_STYLES}', $css_styles, $page);

			$xml_result = $xml->xpath('//'.$xml_base_path."/".$xml_item); // Применение XPath 
			$num_items = sizeof($xml_result);
			echo "Всего элементов ($xml_item): ".$num_items; 
			echo "<br>";

			$xml_keywords = $xml->xpath('//'.$xml_keywords_value); // Считать блок поисковых слов для раздела
			echo "Всего поисковых слов для раздела ($xml_keywords_value): ".sizeof($xml_keywords);
			echo "<br>";

			$page = str_replace ('{NUM_ITEMS}', $num_items, $page);

			// СЧИТАТЬ ШАБЛОН поискового ключевого слова в переменную
			$book_tpl_keyword_start = "<!--{BOOK_TPL_KEYWORD_START}-->";
			$book_tpl_keyword_end = "<!--{BOOK_TPL_KEYWORD_END}-->";
			//Возвращает позицию первого вхождения подстроки
			$pos1 = strpos($page, $book_tpl_keyword_start) + strlen($book_tpl_keyword_start);
			$length = strpos($page, $book_tpl_keyword_end) - $pos1;
			//Возвращает подстроку - шаблон абзаца
			$book_tpl_keyword = substr($page, $pos1, $length); // считать строку с шаблоном в переменную
			//echo $book_tpl_keyword; 
			$page = str_replace ($book_tpl_keyword, "", $page); // удалить шаблон ключевого слова из шаблона книги

			//------------------------------------------------------------------------------
			// Список книг
			//------------------------------------------------------------------------------
			$num_keywords = sizeof($xml_keywords);// Кол-во поисковых ключевых слов
echo "num_keywords = ".$num_keywords;
echo "<br>";
			$block_keywords = "";
			for ($n2=0; $n2<$num_keywords; $n2++)
			  {
				$keyword = $xml_keywords[$n2];
				echo "keyword = ".$keyword;
				echo "<br>";

				$count_book_on_page = 0; // показать все книги на одной странице
				//echo "count_book_on_page = ".$count_book_on_page;
				//echo "<br>";
				
				if ($_REQUEST['save'] == 'on')
				  {
					$save='on';
				  }
				else
					$save='off'; // не сохранять сформированные страницы в файл
				$filename=$fs_pages."/".$keyword.'.html'; 
				$result = list_pages($xml_result,
									$lib_location,
									$tpl_page,
									$css_styles,
									$count_book_on_page,
									$keyword,
									$charset,
									$save,
									$filename); // Постраничный вывод списка книг
echo "result = ".$result;
echo "<br>";
				if ($result == 1)
				  {
					 // формирование ссылок (поисковые ключевые слова) на индексной странице
					$keyword_item = $book_tpl_keyword;
					//$keyword_item = str_replace ('{KEYWORD}', $xml->comp_books->keywords->item[$n2], $keyword_item);
					$url="<a href='";
					$url.=$url_pages."/".$keyword.".html";
					$url.="'>".$keyword."</a>";
					$keyword_item = str_replace ('{KEYWORD}', $url, $keyword_item);
					$block_keywords .= $keyword_item; // добавить ключевое слово к блоку
				  }
			  }//-------------------------------------- end for

			// добавить к странице, блок поисковых ключевых слов - ссылки на страницы с результатами поиска
			$page = str_replace ('{BLOCK_KEYWORDS}', $block_keywords, $page);
			$today = date("H:i:s, d.m.Y");
			$page = str_replace ('{LAST MODIFIED}', $today, $page);

			if ($charset == "windows-1251")
			  {
				$page = iconv("UTF-8", "windows-1251",$page);
			  }
			echo $page;

			if ($_REQUEST['save'] == 'on')
			  {
				$filename = $fs_pages."/index.html";
				file_put_contents ($filename, $page);
				echo "<font color=red>Save page in </font>".$filename;
				echo "<br>";
			  }

		break;

		case parse_lib_book_pages: 
			//echo "action = ".$action;
			//echo "<br>";

			if ($_REQUEST['xml_base_path'])
			  {
				$xml_base_path	=	$_REQUEST['xml_base_path'];
			  }
			else
			  {
				echo "<font color=red>need xml_base_path..... </font>";
				exit();
			  }

			if ($_REQUEST['xml_item'])
			  {
				$xml_item	=	$_REQUEST['xml_item'];
			  }
			else
			  {
				echo "<font color=red>need xml_item.... </font>";
				exit();
			  }

			if (!isset($_REQUEST['lib_location']) OR empty($_REQUEST['lib_location']))
			  {
				echo "<font color=red>Need lib_location.... </font>";
				exit();
			  }
			$lib_location = $_REQUEST['lib_location'];

			$keyword="";
			if (isset($_REQUEST['keyword']) OR !empty($_REQUEST['keyword']))
			  {
				$keyword=$_REQUEST['keyword'];
			  }

			//if (!isset($_REQUEST['count_book_on_page']) OR empty($_REQUEST['count_book_on_page']))
			  //{
				//echo "<font color=red>Need count_book_on_page.... </font>";
				//exit();
			  //}


			$xml_result = $xml->xpath('//'.$xml_base_path."/".$xml_item); // Применение XPath 
			$num_items = sizeof($xml_result);
			echo "Всего элементов ($xml_item): ".$num_items; 
			echo "<br>";

			$count_book_on_page = $_REQUEST['count_book_on_page'];
			echo "count_book_on_page = ".$count_book_on_page;
			echo "<br>";

			$pages = list_pages($xml_result,
								$lib_location,
								$tpl_page,
								$css_styles,
								$count_book_on_page,
								$keyword,
								$charset,
								$save,
								$fs_pages); // Постраничный вывод списка книг
		break;
//===============================================================================
//===============================================================================
		case parse_art_book_pages: 

			if (!isset($_REQUEST['url_pages']) OR empty($_REQUEST['url_pages']))
			  {
				echo "<font color=red>Need url_pages..... </font>";
				//exit();
			  }
			$url_pages = $_REQUEST['url_pages'];

			if (!isset($_REQUEST['book_name']))
			  {
				echo "<font color=red>book_name undefinded..... </font>";
				exit();
			  }

			if ($_REQUEST['book_name']=="")
			  {
				echo "<font color=red>need book_name..... </font>";
				exit();
			  }

//------------STYLES----------------------------------------------------------------------------------
			if ($_REQUEST['css_filter_text'])
			  {
				$css_filter_text	=	$_REQUEST['css_filter_text'];
			  }
				else
					echo "<font color=red>need css_filter_text.... </font><br>";
//---------------------------------------------------------------------------------------------------
			if (isset($_REQUEST['js_location']))
			  {
				$js_location	=	$_REQUEST['js_location'];
			  }
			else
			  {
				echo "<font color=red>need js_location..... </font>";
				exit();
			  }

			if (isset($_REQUEST['url_img1']))
			  {
				$url_img1	=	$_REQUEST['url_img1'];
			  }
			else
			  {
				echo "<font color=red>need url_img1... </font>";
				//exit();
			  }

			if (isset($_REQUEST['url_img2']))
			  {
				$url_img2	=	$_REQUEST['url_img2'];
			  }
			else
			  {
				echo "<font color=red>need url_img2... </font>";
				//exit();
			  }

			if (isset($_REQUEST['url_img3']))
			  {
				$url_img3	=	$_REQUEST['url_img3'];
			  }
			else
			  {
				echo "<font color=red>need url_img3... </font>";
				exit();
			  }

			if (isset($_REQUEST['url_img4']))
			  {
				$url_img4	=	$_REQUEST['url_img4'];
			  }
			else
			  {
				echo "<font color=red>need url_img4... </font>";
				//exit();
			  }

			if (isset($_REQUEST['url_img5']))
			  {
				$url_img5	=	$_REQUEST['url_img5'];
			  }
			else
			  {
				echo "<font color=red>need url_img5... </font>";
				//exit();
			  }

			if ($_REQUEST['use_pager'] == 'on')
			  {
				$use_pager	=	$_REQUEST['use_pager'];
			  }

			$book_name = $_REQUEST['book_name'];
			$xml_book = $xml->xpath('//art_books/book[@name="'.$book_name.'"]');
//echo "<pre>";
//print_r ($xml_book);
//echo "</pre>";
			$num_pages = sizeof($xml_book[0]->page);// подсчитать количество страниц книги
//echo "num_pages = ".$num_pages;
//echo "<br>";
			$count_pages = $num_pages;
//echo "count_pages = ".$count_pages."<br>";
//echo "<br>";
//$num_pages = 3;

//------------------------------------------------------------------------------------------------------------------------------------------------------
// Формируем список ссылок на тетради, исключая текущую,  URL_LIST
//------------------------------------------------------------------------------------------------------------------------------------------------------
			//$url_list=form_url_list($xml, $num_book);
			$url_list=form_url_list($xml->art_books,$book_name);
//echo $url_list;
//echo "<br>";

			for ($n2=0; $n2<$num_pages; $n2++)
			  {
//$num_page = 1;
				$num1_page = $n2;
				$num_page = $n2+1;
//echo "num1_page = ".$num1_page;
//echo "<br>";
//echo "num_page = ".$num_page;
//echo "<br>";

				$title = $xml_book[0]->title.', страница '.$num_page;
				if ($xml_book[0]->page[$n2]->title)
				  {
					$title = $xml_book[0]->title.". ".$xml_book[0]->page[$n2]->title;
					$title_page = $xml_book[0]->page[$n2]->title;
//echo "title = ".$title;
//echo "title_page = ".$title_page;
//echo "<br>";
				  }
				else
					$title_page = $xml_book[0]->title2;

				$page = parse_art_book_form_page ($xml_book[0], 
									$num1_page, 
									$num_page, 
									$num_pages, 
									$tpl_page,
									$css_styles,
									$js_location,
									$url_img1,
									$url_img2,
									$url_img3,
									$url_img4,
									$url_img5,
									$title,
									$title_page,
									$charset); // Обработка страницы книги
				//--------------------------------------------------------------------------------------
				// Добавить на каждую страницу поисковые теги
				//--------------------------------------------------------------------------------------
				if ($xml_book[0]->page[$n2]->meta)
				  {
					$meta_keywords = $xml_book[0]->page[$n2]->meta['keywords'];
					$meta_description = $xml_book[0]->page[$n2]->meta['description'];
				  }
				else
				  {
					$meta_keywords = $xml_book[0]->meta['keywords'];
					$meta_description = $xml_book[0]->meta['description'];
				  }
//echo $meta_keywords;
//echo $meta_description;
//echo "<br>";

				$page = str_replace ('{KEYWORDS}', $meta_keywords, $page);
				$page = str_replace ('{DESCRIPTION}', $meta_description, $page);

				//-------------------------------------------------------------------------------
				// Добавить на страницу список ссылок на другие тетради
				//-------------------------------------------------------------------------------
				if (!empty($url_list))
				  {
echo "<font color=green>Insert URL LIST.....</font>";
echo "<br>";
					$page = str_replace("<!--{URL_LIST}-->", $url_list, $page);
				  }

				//-------------------------------------------------------------------
				// Добавить на каждую страницу пейджер 
				//-------------------------------------------------------------------
				if ($use_pager == 'on')
				  {
					parse_art_book_add_pager ($xml_book[0]);
				  }//-------------------------------------- end if

				//-------------------------------------------------------------------------------
				// Добавить на каждую страницу Яндекс-метрику
				//-------------------------------------------------------------------------------
				if (!empty($yandex_metrika))
				  {
echo "Yandex-metrika, insert in page";
echo "<br>";
					$page = str_replace ('<!--{YA_METRIKA}-->', $yandex_metrika, $page);
				  }

				//----------------------------------------------------------------------------------------
				// Сформировать по шаблону ссылку для карты сайта
				//----------------------------------------------------------------------------------------
				if ($sitemap_tpl)
				  {
					$sitemap_url = form_sitemap_url ($xml_book[0], 
									$num_book, 
									$num1_page, 
									$num_page, 
									$url_img1,
									$url_img2,
									$url_img3,
									$url_img4,
									$url_img5,
									$url_pages);
//echo "sitemap_url = ".$sitemap_url;
//echo "<br>";
					$sitemap_urlset .=$sitemap_url;
				  }
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

				//-------------------------------------------------------------------------------
				// Добавить на первую страницу название книги
				//-------------------------------------------------------------------------------
				if (($num_page) == 1)
				  {
					$book_title = $xml->book[$num_book]->title;
					if (!empty($book_title))
					  {
						$page = str_replace ('<!--{BOOK_TITLE}-->', $book_title, $page);
					  }
				  }

				//----------------------------------------------------------------
				// Добавить на страницы дату создания
				//----------------------------------------------------------------
				$today = date("H:i:s, d.m.Y");
				$page = str_replace ('<!--{LAST MODIFIED}-->', $today, $page);

				if ($charset == "windows-1251")
				  {
					$page = iconv("UTF-8", "windows-1251",$page);
				  }
//echo $page;
				//-----------------------------------------------
				// Сохранить страницу в файл
				//-----------------------------------------------
				if ($save == 'on')
				  {
					//--------------------------------------------------------------------------------------
					// Если страница имеет тег с именем файла, использовать его
					//--------------------------------------------------------------------------------------
					if ($xml_book[0]->page[$n2]->url)
					  {
						//$filename = str_replace ('page-{NUM_PAGE}.html', "", $fs_pages);
						$filename = $fs_pages.$xml_book[0]->page[$n2]->url;
					  }

					if ($filename)
					  {
						file_put_contents ($filename, $page);
						echo "<b><font color=green>Save page in </font>".$filename."</b>";
						echo "<br>";
					  }
					else
					  {
						echo "<b><font color=red>Error! Need filename</font></b>";
						echo "<br>";
					  }

				  }
			  }//-------------------------------------- end for

			//-----------------------------------------------
			// Сохранить карту сайта
			//-----------------------------------------------
			if ($sitemap_tpl)
			  {
echo $sitemap_tpl;
echo "<br>";
				if ($sitemap_urlset)
				  {
//echo "sitemap_urlset = ".$sitemap_urlset;
//echo "<br>";
					$sitemap = str_replace ("<!--{SITEMAP_URL_START}--><!--{SITEMAP_URL_END}-->", $sitemap_urlset, $sitemap_tpl); 
//echo $sitemap;
//echo "<br>";
				  }
				$filename = str_replace ('page-{NUM_PAGE}.html', 'sitemap.xml', $fs_pages);
				file_put_contents ($filename, $sitemap);
				echo "<b><font color=green>Save site map in </font>".$filename."</b>";
				echo "<br>";
			  }
			//----------------------------------------------
		break;
//===============================================================================
//===============================================================================
		case parse_gallery_pages: 
//echo "action = ".$action;
//echo "<br>";
//echo "<pre>";
//print_r ($xml->albums);
//echo "</pre>";

			if (!isset($_REQUEST['gallery_name']))
			  {
				echo "<font color=red>GALLERY_NAME undefinded..... </font>";
				exit();
			  }

			if ($_REQUEST['gallery_name']=="")
			  {
				echo "<font color=red>need GALLERY_NAME..... </font>";
				exit();
			  }

//-------------------------------------------------------------------------------------------------------------------------
			if ($_REQUEST['url_img1']=="")
			  {
				echo "<font color=red>need url_img1..... </font>";
			  }
			if ($_REQUEST['url_img2']=="")
			  {
				echo "<font color=red>need url_img2..... </font>";
			  }
			if ($_REQUEST['url_img3']=="")
			  {
				echo "<font color=red>need url_img3..... </font>";
				exit();
			  }

			if ($_REQUEST['url_img4']=="")
			  {
				echo "<font color=red>need url_img4..... </font>";
			  }

			if ($_REQUEST['url_img5']=="")
			  {
				echo "<font color=red>need url_img5..... </font>";
			  }
//-------------------------------------------------------------------------------------------------------------------------
			if ($_REQUEST['js_location']=="")
			  {
				echo "<font color=red>need js_location..... </font>";
				exit();
			  }

			$gallery_name=	$_REQUEST['gallery_name'];
			$js_location	=	$_REQUEST['js_location'];
			$url_img1	=	$_REQUEST['url_img1'];
			$url_img2	=	$_REQUEST['url_img2'];
			$url_img3	=	$_REQUEST['url_img3'];
			$url_img4	=	$_REQUEST['url_img4'];
			$url_img5	=	$_REQUEST['url_img5'];

			$num_galleries = sizeof($xml->albums->gallery);
//echo "num_galleries = ".$num_galleries;
//echo "<br>";
			if ($_REQUEST['use_pager'] == 'on')
			  {
				//if (!empty($_REQUEST['tpl_pager']))
				  //{
					//$tpl_pager =	$_REQUEST['tpl_pager'];
					$use_pager='on';
					if (!empty($_REQUEST['count_img_on_page']))
					  {
						$count_img_on_page=$_REQUEST['count_img_on_page'];

						echo "<font color=green>постраничный вывод запроса</font>";
						echo "<br>";
						echo "<font color=green>Изображений на странице: </font>".$count_img_on_page;
						echo "<br>";
					  }
					else
						echo "<font color=red>count_img_on_page..... </font>";
				  //}
				//else
					//echo "<font color=red>need tpl_pager..... </font>";
			  }

//------------------------------------------------------------------------------------------------------------------------------------------------------
// Формируем список ссылок на галереи,  URL_LIST
//------------------------------------------------------------------------------------------------------------------------------------------------------
			for ($n1=0; $n1<$num_galleries; $n1++)
			  {
				if ($xml->albums->gallery[$n1]->location)
				  {
					$title_gallery = $xml->albums->gallery[$n1]['title'];
					$name_gallery = $xml->albums->gallery[$n1]['name'];
					$location = $xml->albums->gallery[$n1]->location;
					$num = $xml->albums->gallery[$n1]->num;
					$num = $num*1; //перевод в целый тип
					$gallery_url = "<a href='".$location."'>".$title_gallery."</a>";
					$gallery_url_list[$num][0] = $gallery_url;
					$gallery_url_list[$num][1] = $name_gallery;
				  }
			  } //---------------------------- end for

			$num_first_element=1;// для первого элемента не нужен разделитель ссылок
			if ($gallery_url_list[1][1] == $gallery_name) // если текущая исключаемая из спика, галерея первая, то увеличить $num_first_element
			  {
				$num_first_element=2;
			  }

			for ($n1=0; $n1 <= count($gallery_url_list); $n1++)
			  {
//echo $n1.". ";
//echo $gallery_url_list[$n1][0];
//echo $gallery_url_list[$n1][1];
//echo "<br>";
				if (!empty($gallery_url_list[$n1][0]))
				  {
					if ($gallery_url_list[$n1][1] != $gallery_name) // исключить из списка ссылок текущую галерею
					  {
						if ($n1!=$num_first_element)
						  {
							$url_list .= " | ".$gallery_url_list[$n1][0];
						  }
						else
							$url_list .= $gallery_url_list[$n1][0]; // для первого элемента не нужен разделитель ссылок
					  }
				  }
			  } //---------------------------- end for
//echo $url_list;
//echo "<br>";
//------------------------------------------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------------------------------------------
// Поиск галереи по названию
//------------------------------------------------------------------------------------------------------------------------------------------------------
			for ($n1=0; $n1<$num_galleries; $n1++)
			  {
				// Если найдена заданная галерея, сформировать для нее список страниц
				if ($gallery_name == $xml->albums->gallery[$n1]['name'])
				  {
					list_gallery_pages ($xml->albums->gallery[$n1], 
											$tpl_page,
											$css_styles,
											$js_location,
											$url_img1,
											$url_img2,
											$url_img3,
											$url_img4,
											$url_img5,
											$xml->albums->gallery[$n1]['title'],
											$charset,
											$count_img_on_page,
											$save,
											$fs_pages); // Постраничный вывод списка изображений
				  }//--------------------------------- end if
				else
				  {
					//echo "<font color=red>Gallery not find in XML.... </font>";
					//echo "<br>";
				  }
			  } //---------------------------- end for
			break;
//===============================================================================
//===============================================================================
		case parse_gallery-cross_pages:  // Формирование страниц для галереи с шаблоном Cross
echo "action = ".$action;
echo "<br>";
//-------------------------------------------------------------------------------------------------------------------------
			if (!isset($_REQUEST['gallery_name']) OR empty($_REQUEST['gallery_name']))
			  {
				echo "<font color=red>Need gallery_name.... </font>";
				echo "<br>";
				exit();
			  }
			else
				$gallery_name = $_REQUEST['gallery_name'];

			if ($_REQUEST['css_styles'])
			  {
				$css_styles = $_REQUEST['css_styles']; 
			  }
			if ($_REQUEST['css_styles_fix'])
			  {
				$css_styles_fix = $_REQUEST['css_styles_fix']; 
			  }
			if ($_REQUEST['js_location'])
			  {
				$js_location = $_REQUEST['js_location']; 
			  }
			$icon_img_path = $_REQUEST['icon_img_path']; 
			$full_img_path_preview = $_REQUEST['full_img_path_preview']; 
			$full_img_path = $_REQUEST['full_img_path']; 

			if ($_REQUEST['use_pager'] == 'on')
			  {
				$use_pager='on';
				if (!empty($_REQUEST['count_img_on_page']))
				  {
					$count_img_on_page=$_REQUEST['count_img_on_page'];
					echo "<font color=green>Изображений на странице: </font>".$count_img_on_page;
					echo "<br>";
				  }
				else
					echo "<font color=red>Need count_img_on_page..... </font><br>";
			  }
//-------------------------------------------------------------------------------------------------------------------------
			$num_galleries = sizeof($xml->albums->gallery);
//echo "num_galleries = ".$num_galleries;
//echo "<br>";
			//------------------------------------------------------------------------------------------------------------------------------------------------------
			// Поиск галереи по названию
			//------------------------------------------------------------------------------------------------------------------------------------------------------
			for ($n1=0; $n1<$num_galleries; $n1++)
			  {
				// Если найдена заданная галерея, сформировать для нее список страниц
				if ($gallery_name == $xml->albums->gallery[$n1]['name'])
				  {
					list_gallery_cross_pages ($xml->albums->gallery[$n1] 
											); // Постраничный вывод списка изображений
				  }//--------------------------------- end if
			  } //---------------------------- end for

//===============================================================================
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
	<script>
function processnode(id1)
{
	if (document.getElementById(id1).style.display == \"none\")
	 {
		document.getElementById(id1).style.display = \"\"
	 }
	else
	 {
		document.getElementById(id1).style.display = \"none\"
	 }
}
//------------------------ end func
	</script>
	<style>
legend
{
	color:red;
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
	</style>
</head>
<body>
<form name=form_parse_pages method=post action=parser_db_site.php target=_blank>
	<fieldset>
	<legend><b>Формирование страниц</b></legend>

	<fieldset>
	<p>sites<br>
http://mycomp/<br>
http://roman-laptev.narod.ru/<br>
http://blackcat.far.ru <br>
http://blackcat.hop.ru<br>
http://rex.hop.ru/<br>
http://wizardgraphics.dax.ru/<br>
http://rex.dax.ru/<br>
	</p>

	<div>xml_file:		
		<input type='text'  name='xml_file' size='50' value=''><br><br>
		<p>
			db_site.xml<br>
			mydb.xml<br>
		<ul>
			../pages/xml/<br>
			http://12nov.co.cc/site/pages/xml/<br>
			http://vbox1/sites/www2/my_sites/pages/xml/<br>
			http://mycomp/pages/xml/<br>
		</ul>
		</p>

		<p>
		<ul>
			../pages/xml/<br>
			http://12nov.co.cc/site/pages/xml/<br>
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

	<fieldset>
		<legend><b>Формирование страниц книги (parse_art_book_pages) </b></legend>
		<p>book_name: 		
			<input type='text'  name='book_name' size='20' value=''><br><br>
german_engraving		<br>
netherlandish_engraving<br>
italian_engraving		<br>
french_engraving_15_17<br>
06.French_engraving_18th<br>
japanese_colour_prints	<br>
book_Beardsley			<br>
		</p>
	</fieldset>
<!-- ================================================= -->

	<fieldset>
	<legend><b>Формирование страниц фотогалереи,  ГРАФИКА, АЛЬБОМЫ (parse_gallery_pages)</b><a href=\"javascript:processnode('form_parse_gallery_pages');\">+</a></legend>
	<div style='display: none;' id='form_parse_gallery_pages'>
	<p>gallery_name:		
		<input type='text'  name='gallery_name' size='30' 	value=''><br><br>
selected<br>
japan<br>
beardsley<br>
escher<br>
breugel<br>
fomenko1..8<br>
bilibin<br>
muha<br>
	</p>

	</div>

	</fieldset>
<!-- ================================================= -->

	<fieldset>
	<legend><b>Формирование страниц, для разделов <br>
КОМПЬЮТЕРНАЯ ЛИТЕРАТУРА, ХУДОЖЕСТВЕННАЯ ЛИТЕРАТУРА (parse_lib_book_pages)</b>
<a href=\"javascript:processnode('form_parse_lib_book_pages');\">+</a></legend>
	<div style='display: none;' id='form_parse_lib_book_pages'>

	<p>xml_base_path:<br>
		<input type='text' name='xml_base_path' value='lib/comp_books'><br><br>
lib/books<br>
lib/comp_books<br>
	</p>

	<p>xml_item:<br>
		<input type='text' name='xml_item' value='book'><br><br>
book<br>
article<br>
	</p>

	<p>xml_keywords_value:<br>
		<input type='text' name='xml_keywords_value' size='50'value='lib/comp_books/keywords/item'><br><br>
lib/books/keywords/item<br>
lib/comp_books/keywords/item<br>
	</p>

	<p>url_pages: 		
		<input type='text'  name='url_pages' size='50' 		value='/pages/lib/comp_books'><br><br>
/pages/lib/books<br>
/pages/lib/comp_books<br>
/pages/lib/articles<br>
	</p>

	<p>lib_location: 		
		<input type='text'  name='lib_location' size='50' 		value='http://12nov.co.cc/ext/lib/comp_books'><br><br>
http://lib.wallst.ru/lib/books<br>
http://roman-laptev.narod.ru/lib/books<br>
lib/books<br>
/sites/lib/books<br>
lib/comp_books<br>
	</p>

	<p>keyword:
		<input type='text'  name='keyword' size='30' 		value='all'><br><br>
all			<br>
program	<br>
php		<br>
PHP5		<br>
PHP4		<br>
python		<br>
MySQL		<br>
web		<br>
cms		<br>
drupal		<br>
security		<br>
admin		<br>
system		<br>
windows		<br>
linux		<br>

journal		<br>
sysadmin		<br>
linux format<br>

humor		<br>
fantasy		<br>
science_fiction		<br>
detective	<br>
stories		<br>
roman		<br>
	<p>

	<p>tpl_index: 		
		<input type='text'  name='tpl_index' size='50' 		value='index.tpl'><br><br>
/pages/lib/books/tpl/index.tpl<br>
/pages/lib/comp-books/tpl/index.tpl<br>
/pages/lib/articles/tpl/index.tpl<br>
	</p>

	</div>
	</fieldset>

	<div class='section'>
		<fieldset>
		<legend>tpl_page</legend>

		 	<input type='text'  name='tpl_page' size='50' 	value=''><br><br>
			Использовать пейджер, use_pager:
			<input type='checkbox' name='use_pager'>
		<fieldset>

<!--		 	tpl_pager:<input type='text'  name='tpl_pager' size='50' 	value=''><br><br>-->

			<p>Книг на странице (постраничный вывод запроса  parse_lib_book_pages): 		
				<input type='text'  name='count_book_on_page' size='10' 		value='0'>count_book_on_page
			</p>
			<p>Изображений на странице (постраничный вывод запроса  parse_gallery_pages): 		
				<input type='text'  name='count_img_on_page' size='10' 		value='3'>count_img_on_page,
			</p>
		</fieldset>

		<p>p1
	http://mycomp/<br>
	http://roman-laptev.narod.ru<br>
	http://wizard-graphics.co.cc<br>
	http://wizardgraphics.narod.ru<br>
	http://rex.hop.ru<br>
	http://blackcat.far.ru<br>
			<ul>
				../pages/book_history_engraving/tpl/<br>
				../pages/albums/tpl/<br>
				../pages/book_Beardsley/tpl/<br>
				../pages/lib/books/tpl/<br>
				../pages/lib/comp-books/tpl/<br>
				../pages/lib/articles/tpl/<br>
			</ul>
		</p>

		<p>p2
			<ul>
				page.tpl<br>
				page_res.tpl<br>
				pager.tpl<br>
				page_with-pager.tpl<br>
				page_jcarousel.tpl<br>
			</ul>
		</p>
		</fieldset>
	</div>

	<div class='section'>
		<fieldset>
		<legend>css_styles</legend>
		общие стили 			<input type='text'  name='css_styles' size='50' 	value='notebook.css'><br><br>
		стили пейджера страниц		<input type='text'  name='css_pager' size='50' 	value='pager.css'><br><br>
		стили фильтра текста		<input type='text'  name='css_filter_text' size='50' 	value='filter_text.css'><br><br>

		<p>p1<br>
			/pages/book_history_engraving/css/<br>
			/pages/book_Beardsley/css/book.css<br>
		</p>

		<p>p2
			<ul>
/11.japanese_colour_prints/css/<br>
/02.german_engraving/css/<br>
/03.netherlandish_engraving/css/<br>
/04.Italian_engraving/css/<br>
/05.French_engraving/css/<br>
/06.French_engraving_18th/css/<br>
			</ul>
		</p>

		<p>p3
			<ul>
				notebook<br>
				pager.css<br>
				filter_text.css<br>
			</ul>
		</p>

		<p>
		/pages/albums/css/
			<ul>
				style.css<br>
				style_red.css<br>
				style_black-red.css<br>
				style_silver.css<br>
				style_silver2.css<br>
				style_green.css<br>
				style_steelblue<br>
			</ul>
		</p>

		<p>
/pages/lib/books/css/style.css<br>
/pages/lib/comp-books/css/style.css<br>
/pages/lib/articles/css/style.css<br>
		</p>

		<p>js_location: 		
			<input type='text'  name='js_location' size='50'		value='/pages/js'><br><br>
		</p>
		</fieldset>
	</div>

	<div class='section'>
		<fieldset>
		<legend>папки изображений по размерам,  url_img</legend>
			<p>
			small size, preview, w300	<input type='text'  name='url_img3' size='50' 		value='w300/'><br>
			resize 2x, w600	<input type='text'  name='url_img4' size='50' 		value='w600/'><br>
			resize 3x, w1024	<input type='text'  name='url_img2' size='50' 		value='w1024/'><br>
			resize 4x, w1280	<input type='text'  name='url_img5' size='50' 		value='w1280/'><br>
			original size		<input type='text'  name='url_img1' size='50' 		value='original/'><br>

			p1<p>
/content<br>
http://mycomp/documents/0_sites/my_sites/content<br>
http://roman-laptev.narod.ru/content<br>
			</p>

			p2<p>
/book_history_engraving/11.japanese_colour_prints/<br>
/book_history_engraving/02.german_engraving/<br>
/book_history_engraving/03.netherlandish_engraving/<br>
/book_history_engraving/04.Italian_engraving/<br>
/book_history_engraving/05.French_engraving/<br>
/book_history_engraving/06.French_engraving_18th/<br>
				<hr>
/albums/selected<br>
/albums/japan<br>
/authors/Beardsley<br>
/authors/gallery_Escher<br>
/authors/Breugel<br>
/authors/Fomenko/p1...8<br>
/authors/gallery_Bilibin<br>
/authors/gallery_Muha<br>
/content/book_Beardsley			<br>
			</p>

			p3<p>
/original
/w1024
/w300
/w200px
			</p>
		</fieldset>
	</div>

	<div class='section'>
		<fieldset>
		<legend>Подключить на страницы, скрипт яндекс-метрики (очистить поля для отмены вставки)</legend>
			ya_metrika_title:<input type='text'  name='ya_metrika_title' size='50'  value=''><br><br>
для:<br>
	roman-laptev.narod.ru<br>
	roman-laptev.narod2.ru<br>
	blackcat.far.ru<br>
	blackcat.hop.ru<br>
	rex.hop.ru<br>
	wizardgraphics.dax.ru<br>
	gravura.ts6.ru<br>
	blackcat.px6.ru<br>
	limb.500mb.net<br>
			расположение файла с метриками<br>
			ya_metrika_file:<input type='text'  name='ya_metrika_file' size='50'  value='yandex_metrika.xml'><br><br>
http://mycomp/pages/xml/<br>
		</fieldset>
	</div>
<br>

	<div class='section'>
		<fieldset>
		<legend>Формировать ссылки для sitemap.xml</legend>
			sitemap_name: <input type='text'  name='sitemap_name' size='50'  value=''><br>
	http://gravura.ts6.ru<br>
	http://roman-laptev.narod.ru<br>
	http://blackcat.far.ru<br>
	http://blackcat.hop.ru<br>
	http://rex.hop.ru<br>
	http://wizardgraphics.dax.ru<br>
	http://limb.500mb.net<br>
	http://blackcat.px6.ru/<br>
			url_pages: <input type='text'  name='url_pages' size='50' 		value=''><br><br>
	<p>
/pages/book_history_engraving/
<ul>
	11.japanese_colour_prints/page-{NUM_PAGE}.html<br>
	02.german_engraving<br>
	03.netherlandish_engraving<br>
	04.Italian_engraving<br>
	05.French_engraving<br>
	06.French_engraving_18th/page-{NUM_PAGE}.html<br>
</ul>
	</p>

			sitemap_tpl_file:<input type='text'  name='sitemap_tpl_file' size='50'  value='sitemap.xml.tpl'><br><br>
http://mycomp/pages/book_history_engraving/tpl/<br>
		</p>
		</fieldset>
	</div>
<br>

	<div class='section'>
		<fieldset>
		<legend>fs_pages (файловый путь для сохранения страницы. Относительно парсера!!!!)</legend>
		<input type='text'  name='fs_pages' size='50' 		value=''><br><br>
	<p class='param'>
../pages/book_history_engraving/
<ul>
	11.japanese_colour_prints/<br>
	02.german_engraving/<br>
	03.netherlandish_engraving/<br>
	04.Italian_engraving/<br>
	05.French_engraving/<br>
	06.French_engraving_18th/<br>
</ul>
	</p>

	<p class='param'>
../pages/albums/
<ul>
	gallery1.html<br>
	gallery_japan.html<br>
	gallery_Escher.html<br>
	gallery_Breugel.html<br>
	gallery_Fomenko_p1...8.html<br>
	gallery_Bilibin.html<br>

../pages/book_Beardsley/<br>
	gallery_Beardsley<br>
	gallery_Beardsley.html<br>

	gallery_Muha<br>
</ul>
	</p>

	<p class='param'>
	page-{NUM_PAGE}.html<br>
	</p>

		<p class='param'>../pages/lib/
			<ul>
	books<br>
	articles<br>
	comp_books<br>
	comp_books/page-{NUM_PAGE}.html<br>
	comp_books/index.html<br>
			</ul>
		</p>

		<p>save in files: 		
			<input type='checkbox'  name='save'>
		</p>
		</fieldset>
	</div>

<br>
	<div class='section'>
		<fieldset>
		<legend>action</legend>
			<input type='text' name='action' value=''><br>
			<p class='param'>
parse_art_book_pages<br>
parse_gallery_pages<br>
parse_lib_book_pages (постраничный вывод запроса )<br>
parse_lib_book_pages_index (index.html + страницы поисковых запросов)<br>
			<input type=submit value='run script'>
			</p>
		</fieldset>
	</div>

	</fieldset>
</form>

<!-- ================================================= -->
<form name=form_parse_pages2 method=post action='".$_SERVER['SCRIPT_NAME']."' target=_blank>
	<fieldset>
		<legend><b>Parse gallery \"Cross\"</b></legend>

		<div class='section'><b>xml_file</b>:		<input type='text'  name='xml_file' size='50' value=''></p>
			<p class='param'>
http://mycomp/pages/xml/db_site.xml<br>
			</p>
		</div>

		<div class='section'><b>charset</b>:
			<select name='charset'>
				<option value='utf-8' selected >utf-8</option>
				<option value='windows-1251'>windows-1251</option>
			</select>
		</div>

		<div class='section'>
			<p><b>gallery_name</b>:	<input type='text'  name='gallery_name' size='30' 	value=''></p>
			<p class='param'>
bilibin<br>
bilibin2<br>
muha<br>
			</p>
		</div>

		<div class='section'>
		 	<p><b>tpl_page</b>:	<input type='text'  name='tpl_page' size='50' 	value=''></p>
			<p class='param'>
http://mycomp/pages/albums/tpl/page_cross.tpl<br>
			</p>
			<p><b>use_pager</b>:	<input type='checkbox' name='use_pager'>
				Изображений на странице (<b>count_img_on_page</b>):		
				<input type='text'  name='count_img_on_page' size='10' 	value='3'></p>
		</div>

		<div class='section'>
		 	<p><b>css_styles</b>: 		<input type='text'  name='css_styles' size='50' value=''></p>
		 	<p><b>css_styles_fix</b>: 	<input type='text'  name='css_styles_fix' size='50' value=''></p>
			<p class='param'>
/pages/albums/css/<br>
				<ul class='param'>
style_gallery-cross.css<br>
style_gallery-cross_fix-ie.css<br>
				</ul>
			</p>

			<p><b>js_location</b>: 		<input type='text'  name='js_location' size='50'	value='/pages/js'></p>
			<p><b>no_js_location</b>: 		<input type='text'  name='no_js_location' size='50'	value='/pages/no_js/redirect_no_js.html'></p>
		</div>


		<div class='section'><p>папки изображений по размерам:<br>
			
icon image (<b>icon_img_path</b>)	<input type='text'  name='icon_img_path' size='50' 		value='w120/'><br>
			<p class='param'>
w120<br>
h120<br>
w150<br>
			</p>
preview image(<b>full_img_path_preview</b>)	<input type='text'  name='full_img_path_preview' size='50' 		value='w300/'><br>
full image (<b>full_img_path</b>)	<input type='text'  name='full_img_path' size='50' 		value='original/'><br>
			</p>

			<p class='param'>
http://mycomp/content/authors/gallery_Bilibin/<br>
			</p>
		</div>

		<div class='section'>
			<p>Подключить на страницы, скрипт яндекс-метрики (очистить поля для отмены)<b>ya_metrika_title</b>:
				<input type='text'  name='ya_metrika_title' size='50'  value=''></p>
для:<br>
			<p class='param'>
	roman-laptev.narod.ru<br>
	roman-laptev.narod2.ru<br>
	blackcat.far.ru<br>
	blackcat.hop.ru<br>
	rex.hop.ru<br>
	wizardgraphics.dax.ru<br>
	gravura.ts6.ru<br>
	blackcat.px6.ru<br>
	limb.500mb.net<br>
			</p>

			<p>расположение XML-файла с метриками (<b>ya_metrika_file</b>):
				<input type='text'  name='ya_metrika_file' size='50'  value='yandex_metrika.xml'></p>
			<p class='param'>
http://mycomp/pages/xml/<br>
			</p>
		</div>

	<div class='section'>
		<p>файловый путь для сохранения страницы. Относительно парсера!!!! (<b>fs_pages</b>)<br>
			<input type='text'  name='fs_pages' size='50' 		value=''></p>
		<p class='param'>../pages/albums/
			<ul class='param'>
gallery_Bilibin/page-{NUM_PAGE}.html<br>
			</ul>
		</p>
		<p>save in files: 	<input type='checkbox'  name='save'></p>
	</div>

	<div class='section'>
		<p>action	<input type='text' name='action' value=''>
		<input type=submit value='run script'></p>
		<p class='param'>
parse_gallery-cross_pages<br>
		</p>
	</div>

	</fieldset>
</form>
<!-- ================================================= -->

</body>
</html>";
} //-------------------------- end func


//------------------------------------------------------------------------
// Постраничный вывод страниц фотогалереи 
//------------------------------------------------------------------------
function list_gallery_pages ($xml, 
					$tpl_page,
					$css_styles,
					$js_location,
					$url_img1,
					$url_img2,
					$url_img3,
					$url_img4,
					$url_img5,
					$title,
					$charset,
					$count_img_on_page,
					$save,
					$fs_pages)
{
	global $yandex_metrika, $use_pager, $url_list;
echo "<h2>function list_gallery_pages</h2>";
echo "<br>";
/*
echo "tpl_page = ".$tpl_page;
echo "<br>";
echo "css_styles = ".$css_styles;
echo "<br>";
echo "js_location = ".$js_location;
echo "<br>";
echo "url_img = ".$url_img;
echo "<br>";
echo "title = ".$title;
echo "<br>";
echo "charset = ".$charset;
echo "<br>";
echo "count_img_on_page = ".$count_img_on_page;
echo "<br>";

echo "save = ".$save;
echo "<br>";
echo "fs_pages = ".$fs_pages;
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";
*/

	$meta_keywords = $xml->meta['keywords'];
//echo "meta_keywords =".$meta_keywords;
//echo "<br>";
	$meta_description = $xml->meta['description'];
//echo "meta_description = ".$meta_description;
//echo "<br>";

	// подсчитать количество изображнией в галерее
	$num_pictures = sizeof($xml->picture);
//echo "num_pictures = ".$num_pictures."<br>";

	// определить количество страниц изображнией, при использовании пейджера
	if ($count_img_on_page <= 0)
	  {
		$count_img_on_page = $num_pictures;
	  }
	if ($count_img_on_page > $num_pictures)
	  {
		$count_img_on_page = $num_pictures;
	  }
echo "count_img_on_page = ".$count_img_on_page;
echo "<br>";

	$count_pages =  ceil($num_pictures / $count_img_on_page);
echo "count_pages = ".$count_pages;
echo "<br>";

	$start_num = 0; // номер изображения для начала вывода страницы списка
	$num_page = $n1+1;

	$picture_column = "";
	for ($n1=0; $n1<$count_pages; $n1++)
	  {
		$num_page = $n1+1;
		$page=form_page_gallery ($xml, 
						$tpl_page,
						$css_styles,
						$js_location,
						$url_img1,
						$url_img2,
						$url_img3,
						$url_img4,
						$url_img5,
						$title,
						$meta_keywords,
						$meta_description,
						$charset,
						$n1,
						$count_img_on_page,
						$start_num);
//echo $page;
		$start_num = $start_num + $count_img_on_page; // номер изображения для начала вывода новой страницы

//---------------------------------------------------------------------------------------------------------------------------------------------------------------
		//-------------------------------------------------------------------------------
		// Добавить на страницу Яндекс-метрику
		//-------------------------------------------------------------------------------
		if (!empty($yandex_metrika))
		  {
echo "Insert Yandex-metrika....";
echo "<br>";
			$page = str_replace ('<!--{YA_METRIKA}-->', $yandex_metrika, $page);
		  }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------

		// СЧИТАТЬ ШАБЛОН пейджера в переменную
		$pager_start = "<!--{PAGER_START}-->";
		$pager_end = "<!--{PAGER_END}-->";
		$pos1 = strpos($page, $pager_start) + strlen($pager_start);// получить нач. позицию шаблона (исключая метку начала)
		$length = strpos($page, $pager_end) - $pos1;// получить длину шаблона
		$pager_tpl = substr($page, $pos1, $length); // считать строку с шаблоном в переменную
//echo "pager_tpl = ".$pager_tpl;
//echo "<br>";
		// удалить из страницы, ненужный шаблон ссылок
		$page = str_replace($pager_tpl, "", $page);

		$filename = str_replace ('{NUM_PAGE}', "0".$num_page, $fs_pages);
		if (!$filename) // если результаты запроса будут сохранены в одном файле, т.е. не задана маска имени файла
		    {
				$filename = $fs_pages;
		    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
		if ($use_pager == 'on')
		  {
echo "Insert pager.....";
echo "<br>";
			// СЧИТАТЬ ШАБЛОН СПИСКА ССЫЛОК пейджера в переменную
			$page_list_start = "<!--{PAGE_LIST_START}-->";
			$page_list_end = "<!--{PAGE_LIST_END}-->";
			$pos1 = strpos($pager_tpl, $page_list_start) + strlen($page_list_start);// получить нач. позицию шаблона (исключая метку начала)
			$length = strpos($pager_tpl, $page_list_end) - $pos1;// получить длину шаблона
			$page_list_tpl = substr($pager_tpl, $pos1, $length); // считать строку с шаблоном в переменную
//echo "page_list_tpl = ".$page_list_tpl;
//echo "<br>";
			// удалить из страницы, ненужный шаблон ссылок
			$pager_tpl = str_replace($page_list_tpl, "", $pager_tpl);

			//---------------------------------------------------------------------------------
			// ВСТАВИТЬ В ПЕРЕМЕННУЮ ПЕЙДЖЕР СТРАНИЦ
			//---------------------------------------------------------------------------------
			$pager = $pager_tpl; 
			$page_list = ""; 
			// формируем список ссылок
			for ($n2=0; $n2<$count_pages; $n2++)
			  {
				$num_next_page = $n2+1;
				$filename_next =  str_replace($num_page, $num_next_page, basename($filename)); 
//echo "filename_next= ".$filename_next;
//echo "<br>";
				// добавить к списку ссылок, ссылку на следующую стр.
				$next_page_list = str_replace("{FILENAME}", $filename_next, $page_list_tpl); 

				//пометить активную страницу
				$num_active_page = $n2+1;
				if ($num_active_page == $num_page)
			  	  {
					$num_active_page="<span class='active_page'>".$num_active_page."</span>";
				  }

				$next_page_list = str_replace("{LIST_NUM_PAGE}", $num_active_page, $next_page_list); 
				$page_list .= $next_page_list; 
			  }//-------------------------------------- end for
//echo "page_list = ".$page_list;
//echo "<br>";
			$pager = str_replace("<!--{PAGE_LIST_START}-->",$page_list, $pager);
			$pager = str_replace("<!--{PAGE_LIST_END}-->","", $pager);

			//-------------------------------------------------------------------------------
			// Добавить на страницу список ссылок на другие галереи
			//-------------------------------------------------------------------------------
			if (!empty($url_list))
			  {
echo "Insert URL LIST.....";
echo "<br>";
				$pager = str_replace("<!--{URL_LIST}-->", $url_list, $pager);
			  }
			$pager = str_replace("{INDEX}", "../", $pager);

			// в имени файла заменить номер текущей страницы, номером предыдущей страницы
			$num_prev_page = $num_page-1;
			if ($num_prev_page < 1)
		  	  {
				$num_prev_page = $count_pages;
			  }
			$filename_prev =  str_replace($num_page, $num_prev_page, basename($filename)); 
			$pager = str_replace("{PREV_URL}", $filename_prev, $pager);

			// в имени файла заменить номер текущей страницы, номером следующей страницы
			$num_next_page = $num_page+1;
			if ($num_next_page > $count_pages)
		  	  {
				$num_next_page = 1;
			  }
			$filename_next =  str_replace($num_page, $num_next_page, basename($filename)); 
			//$filename_next =  basename($filename)."_next";
			$pager = str_replace("{NEXT_URL}", $filename_next, $pager);

			$page = str_replace ('<!--{PAGER_START}-->', $pager, $page);
			$page = str_replace ('<!--{PAGER_END}-->', "", $page);
		  }

		// когда не используется шаблон пейджера, удалить его строки со страницы
		$page = str_replace ('<!--{PAGER_START}--><!--{PAGER_END}-->', "", $page); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
		if ($charset == "windows-1251")
		  {
			$page = iconv("UTF-8", "windows-1251",$page);
		  }

		if ($save == 'on')
		  {
			file_put_contents ($filename, $page);
			echo "<font color=red>Save page in </font>".$filename;
			echo "<br>";
		  }
echo $page;
	  }

} //-------------------- end function

//---------------------------------------------------------------------------------------
// Формирование страницы фотогалереи (список jpg)
//--------------------------------------------------------------------------------------
function form_page_gallery ($xml, 
					$tpl_page,
					$css_styles,
					$js_location,
					$url_img1,
					$url_img2,
					$url_img3,
					$url_img4,
					$url_img5,
					$title,
					$meta_keywords,
					$meta_description,
					$charset,
					$num_page,
					$count_img_on_page,
					$start_num)
{
	global $css_pager;
echo "<h2>function form_page_gallery</h2>";
echo "<br>";
/*
echo "tpl_page = ".$tpl_page;
echo "<br>";
echo "css_styles = ".$css_styles;
echo "<br>";
echo "js_location = ".$js_location;
echo "<br>";
echo "url_img = ".$url_img;
echo "<br>";
echo "title = ".$title;
echo "<br>";
echo "charset = ".$charset;
echo "<br>";

echo "num_page = ".$num_page;
echo "<br>";
echo "start_num = ".$start_num;
echo "<br>";
echo "count_img_on_page = ".$count_img_on_page;
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";
*/

//echo "meta_keywords =".$meta_keywords;
//echo "<br>";
//echo "meta_description = ".$meta_description;
//echo "<br>";
$title_num = $num_page+1;
$title2 =$title. ", страница ".$title_num;
	$page = file_get_contents($tpl_page); // Считать в переменную шаблон страницы
	$page = str_replace ('{CHARSET}', $charset, $page); // Заменить теги шаблона, данными
	$page = str_replace ('{TITLE}', $title2, $page);
	$page = str_replace ('{TITLE2}', $title, $page);
	$page = str_replace ('{KEYWORDS}', $meta_keywords, $page);
	$page = str_replace ('{DESCRIPTION}', $meta_description, $page);
	$page = str_replace ('{JS_LOCATION}', $js_location, $page);
	$page = str_replace ('<!--{CSS_STYLES}-->', $css_styles, $page);
	$page = str_replace ('<!--{CSS_PAGER}-->', $css_pager, $page);
//	$page = str_replace ('<!--{CSS_FILTER_TEXT}-->', $css_filter_text, $page);
	$page = str_replace ('{URL_IMG1}', $url_img1, $page);
	$page = str_replace ('{URL_IMG2}', $url_img2, $page);
	$page = str_replace ('{URL_IMG3}', $url_img3, $page);
	$page = str_replace ('{URL_IMG4}', $url_img4, $page);
	$page = str_replace ('{URL_IMG5}', $url_img5, $page);
	$page = str_replace ('{NUM_PAGE}', $num_page+1, $page);

//------------------------
	// СЧИТАТЬ ШАБЛОН для вывода изображения в переменную (ссылка с pirobox)
	$picture_tpl_start = "<!--{PICTURE_URLBOX_START}-->";
	$picture_tpl_end = "<!--{PICTURE_URLBOX_END}-->";
	$pos1 = strpos($page, $picture_tpl_start) + strlen($picture_tpl_start);// получить нач. позицию шаблона
	$length = strpos($page, $picture_tpl_end) - $pos1;// получить длину шаблона
	//Возвращает подстроку - вывода изображения
	$picture_tpl = substr($page, $pos1, $length);  // считать строку с шаблоном в переменную
//echo $picture_tpl; 

	// СЧИТАТЬ ШАБЛОН для вывода изображения в переменную (обычная ссылка)
	$picture_tpl_start = "<!--{PICTURE_URL_START}-->";
	$picture_tpl_end = "<!--{PICTURE_URL_END}-->";
	$pos1 = strpos($page, $picture_tpl_start) + strlen($picture_tpl_start);// получить нач. позицию шаблона
	$length = strpos($page, $picture_tpl_end) - $pos1;// получить длину шаблона
	//Возвращает подстроку - шаблон
	$picture_tpl2 = substr($page, $pos1, $length);  // считать строку с шаблоном в переменную
	// удалить шаблон ссылки из родительского шаблона страницы
	$page = substr_replace($page, '', $pos1, $length);

//echo $sitemap_tpl;
//echo "sitemap_tpl_url = ".$sitemap_tpl_url;
//echo "<br>";

	$picture_column = "";
	for ($n1=$start_num; $n1<$start_num + $count_img_on_page; $n1++)
	  {
//echo $n1." ".$xml->picture[$n1]->filename;
//echo "<br>";
		if (!empty($xml->picture[$n1]->filename)) // если тег с именем файла заполнен
		  {
			// формируем шаблон для вывода одного изображения 
			$img=$xml->picture[$n1]->filename;
			//$img2=$xml->picture[$n1]->filename;
			//$img3=$xml->picture[$n1]->filename;

			$img_title_author	=	htmlspecialchars($xml->picture[$n1]->author);
			$img_title_date		=	htmlspecialchars($xml->picture[$n1]->date);
			$img_title			=	htmlspecialchars($xml->picture[$n1]->name);
			$img_info			=	htmlspecialchars($xml->picture[$n1]->info);

//--------------------------ФОРМИРОВАНИЕ ССЫЛОК НА ИЗОБРАЖЕНИЯ для вывода на страницу
			$picture = $picture_tpl;
			$picture = str_replace("{IMG}", $img, $picture);
			//$picture = str_replace("{IMG2}", $img2, $picture);
			//$picture = str_replace("{IMG3}", $img3, $picture);
			$picture = str_replace("<!--{IMG_TITLE_AUTHOR}-->", $img_title_author, $picture);
			$picture = str_replace("<!--{IMG_TITLE_DATE}-->", $img_title_date, $picture);
			$picture = str_replace("<!--{IMG_TITLE}-->", $img_title, $picture);
			$picture = str_replace("<!--{INFO}-->", $img_info, $picture);
			$picture_column .= $picture;
		  }// --------------------------------- end if
		else
		  {
			//echo "filename empty !";
			//echo "<br>";
		  }

		if (!empty($xml->picture[$n1]->a)) // если требуется сформировать обычную ссылку
		  {
			echo "form link a !";
			echo "<br>";
			$img=$xml->picture[$n1]->a;
			$url=$xml->picture[$n1]->a['href'];

			$img_title_author	=	htmlspecialchars($xml->picture[$n1]->author);
			$img_title_date		=	htmlspecialchars($xml->picture[$n1]->date);
			$img_title			=	htmlspecialchars($xml->picture[$n1]->name);
			$img_info			=	htmlspecialchars($xml->picture[$n1]->info);

			$picture = $picture_tpl2;
			$picture = str_replace("<!--{URL}-->", $url, $picture);
			$picture = str_replace("{IMG}", $img, $picture);
			$picture = str_replace("<!--{IMG_TITLE_AUTHOR}-->", $img_title_author, $picture);
			$picture = str_replace("<!--{IMG_TITLE_DATE}-->", $img_title_date, $picture);
			$picture = str_replace("<!--{IMG_TITLE}-->", $img_title, $picture);
			$picture = str_replace("<!--{INFO}-->", $img_info, $picture);
			$picture_column .= $picture;
		  }
	  }

	// вставить в шаблон страницы, полученный код  вывода изображений
	// заменяем фрагмент шаблона страницы на полученный код  вывода изображений
	$page = str_replace($picture_tpl, $picture_column, $page);

//echo $page;
	return $page;
} //-------------------- end function


//---------------------------------------------
// Обработка страницы книги
//--------------------------------------------
function parse_art_book_form_page ($xml, 
					$num_page, 
					$num1_page, 
					$num_pages, 
					$tpl_page,
					$css_styles,
					$js_location,
					$url_img1,
					$url_img2,
					$url_img3,
					$url_img4,
					$url_img5,
					$title,
					$title_page,
					$charset)
  {
	global $css_pager, $css_filter_text;

/*
echo "function parse_art_book_form_page";
echo "<br>";
echo "js_location = ".$js_location;
echo "<br>";
echo "tpl_page = ".$tpl_page;
echo "<br>";
echo "num_page = ".$num_page;
echo "<br>";
echo $sitemap_tpl;
echo "<br>";
echo "css_pager = ".$css_pager;
echo "<br>";
echo "base_url = ".$base_url;
echo "<br>";
echo "css_styles = ".$css_styles;
echo "<br>";
echo "url_img = ".$url_img;
echo "<br>";
echo "num_pages = ".$num_pages;
echo "<br>";
echo "$title = ".$$title;
echo "<br>";
echo "charset = ".$charset;
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";
*/
	$page = file_get_contents($tpl_page); // Считать в переменную шаблон страницы

// Проверяем ответ от сервера
/*
echo "<pre>";
print_r ($http_response_header); // Заголовки ответов HTTP
echo "</pre>";
echo 'http_response_header[0] = '.$http_response_header[0];
if ($http_response_header[0]=='HTTP/1.1 200 OK')
{
    echo "<font color='green'>";
    echo "Ok";
    echo "</font>";
    echo "<br>";
}
else
{
    echo "<font color='red'>";
    echo "FAIL";
    echo "</font>";
    echo "<br>";
} 
*/
	$page = str_replace ('{CHARSET}', $charset, $page); // Заменить теги шаблона, данными
	$page = str_replace ('{TITLE}', $title, $page);
	$page = str_replace ('{TITLE_PAGE}', $title_page, $page);
	$page = str_replace ('<!--{CSS_STYLES}-->', $css_styles, $page);
	$page = str_replace ('<!--{CSS_PAGER}-->', $css_pager, $page);
	$page = str_replace ('<!--{CSS_FILTER_TEXT}-->', $css_filter_text, $page);
	$page = str_replace ('{JS_LOCATION}', $js_location, $page);

	//$page = str_replace ('{URL_IMG}', $url_img, $page);
	$page = str_replace ('{URL_IMG1}', $url_img1, $page);
	$page = str_replace ('{URL_IMG2}', $url_img2, $page);
	$page = str_replace ('{URL_IMG3}', $url_img3, $page);
	$page = str_replace ('{URL_IMG4}', $url_img4, $page);
	$page = str_replace ('{URL_IMG5}', $url_img5, $page);

	$page = str_replace ('{NUM_PAGE}', $num1_page, $page);
//echo $page;
	// СЧИТАТЬ ШАБЛОН АБЗАЦА в переменную
	//Возвращает позицию первого вхождения подстроки
	$text_column_start = "<!--{TEXT_COLUMN_START}-->";
	$text_column_end = "<!--{TEXT_COLUMN_END}-->";
	$pos1 = strpos($page, $text_column_start) + strlen($text_column_start);
	$length = strpos($page, $text_column_end) - $pos1;
	//Возвращает подстроку - шаблон абзаца
	$paragraph_tpl = substr($page, $pos1, $length); // считать строку с шаблоном в переменную
//echo $paragraph_tpl; 

	// СЧИТАТЬ ШАБЛОН ПРИМЕЧАНИЙ в переменную
	$note_start = "<!--{NOTE_START}-->";
	$note_end = "<!--{NOTE_END}-->";
	$pos1 = strpos($paragraph_tpl, $note_start) + strlen($note_start);// получить нач. позицию шаблона
	$length = strpos($paragraph_tpl, $note_end) - $pos1;// получить длину шаблона
	//Возвращает подстроку - шаблон абзаца
	$note_tpl = substr($paragraph_tpl, $pos1, $length); // считать строку с шаблоном в переменную

	// удалить из шаблона параграфа, шаблон примечаний
	$paragraph_tpl = substr_replace($paragraph_tpl, '', $pos1, $length);
	// удалить из шаблона страницы, шаблон примечаний
	$pos1 = strpos($page, $note_start) + strlen($note_start);
	$length = strpos($page, $note_end) - $pos1;
	$page = substr_replace($page, '', $pos1, $length);

	//------------------------------------------
	// вывести текстовый блок (переменная text_column)
	//------------------------------------------
	// подсчитать количество абзацев на странице 
	$num_paragraph = sizeof($xml->page[$num_page]->text_column->p);
//echo "num_paragraph = ".$num_paragraph."<br>";

	$text_column = "";
	for ($n1=0; $n1<$num_paragraph; $n1++)
	  {
		$paragraph_text = $xml->page[$num_page]->text_column->p[$n1];
//echo "<b>paragraph_text</b> = ".$paragraph_text;
//echo "<br>";
//echo "<pre>";
//print_r ($xml->book[$num_book]->page[$num_page]->text_column->p[$n1]);
//echo "</pre>";

//-----------------------------------------------------------------------------------------------------------
// Если в параграфе есть термины, имена, названия работ, даты, то заменить их на <span class=""></span>
/*
Выделение в тексте терминов, названий, дат, 
<picture_text>«Несение креста»</picture_text>
&lt;span class="picture_text"&gt;	&lt;/span&gt;

<name>Мастером пряжек</name>
&lt;span class="name"&gt;	&lt;/span&gt;

<date>1425</date>
&lt;span class="date_text"&gt;	&lt;/span&gt;

<term>клейнмейстеров</term>
&lt;span class="term"&gt;	&lt;/span&gt;
*/
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
//-----------------------------------------------------------------------------------------------------------

		//в строку шаблона абзаца вставить текст абзаца
		$paragraph = $paragraph_tpl;
		$paragraph = str_replace("{PARAGRAPH}", $paragraph_text, $paragraph);

		// если к абзацу есть примечания, то добавить текст примечания к переменной
		if ($xml->page[$num_page]->text_column->p[$n1]->notes)
		  {
			$note_text = $xml->page[$num_page]->text_column->p[$n1]->notes;
			//в строку шаблона абзаца вставить текст примечания
			$note = $note_tpl;
			$note = str_replace("{NOTE}", $note_text, $note);
			$text_column .= $paragraph.$note;
		  }
		else
			//$text_column .= "<p>".$paragraph."</p>";
			$text_column .= $paragraph;

	 }
//-----------------------------------------
	$page = str_replace ('{PARAGRAPH}', $text_column, $page);
	//$page = str_replace ('{TEXT_COLUMN}', $text_column, $page);

//------------------------
	// СЧИТАТЬ ШАБЛОН для вывода ссылок на детальное изображние
	$details_tpl_start = "<!--{DETAILS_START}-->";
	$details_tpl_end = "<!--{DETAILS_END}-->";
	$pos1 = strpos($page, $details_tpl_start) + strlen($details_tpl_start); // получить нач. позицию шаблона
	$length = strpos($page, $details_tpl_end) - $pos1; // получить длину шаблона
	$details_tpl = substr($page, $pos1, $length);  // считать строку с шаблоном в переменную
	// удалить из шаблона для вывода одного изображения , шаблон вывода ссылок на детальное изображние
	$page = substr_replace($page, '', $pos1, $length);
//------------------------
	// СЧИТАТЬ ШАБЛОН для вывода изображения в переменную
	$picture_tpl_start = "<!--{PICTURE_START}-->";
	$picture_tpl_end = "<!--{PICTURE_END}-->";
	$pos1 = strpos($page, $picture_tpl_start) + strlen($picture_tpl_start);// получить нач. позицию шаблона
	$length = strpos($page, $picture_tpl_end) - $pos1;// получить длину шаблона
	//Возвращает подстроку - вывода изображения
	$picture_tpl = substr($page, $pos1, $length);  // считать строку с шаблоном в переменную
	//echo $picture_tpl; 

	// подсчитать количество изображнией на странице 
	$num_pictures = sizeof($xml->page[$num_page]->picture_column->img);
	//echo "num_pictures = ".$num_pictures."<br>";
	$picture_column = "";
	for ($n1=0; $n1<$num_pictures; $n1++)
	  {
		//echo $xml->book[0]->page[$num_page]->picture_column->img[$n1]['src'];
		//echo "<br>";

		// формируем шаблон для вывода одного изображения 
		$img = $xml->page[$num_page]->picture_column->img[$n1]['src'];

		if ($xml->page[$num_page]->picture_column->title[$n1])
		  {
			$img_title = htmlspecialchars($xml->page[$num_page]->picture_column->title[$n1]);
		  }
		else 
		  {
			echo "need img_title...";
		  }

		if ($xml->page[$num_page]->picture_column->img[$n1]['alt'])
		  {
			$img_title = htmlspecialchars($xml->page[$num_page]->picture_column->img[$n1]['alt']);
		  }

		//$img_title_author	=	htmlspecialchars($xml->page[$num_page]->picture_column->author[$n1]);
		//$img_title_date	=	htmlspecialchars($xml->page[$num_page]->picture_column->date[$n1]);
		$filesize = $xml->page[$num_page]->picture_column->details[$n1]->filesize;

//---------------------------ФОРМИРОВАНИЕ ССЫЛОК НА ДЕТАЛЬНОЕ ИЗОБРАЖЕНИЕ
		$url = $xml->page[$num_page]->picture_column->details->a[0]['href'];
		if ($url != "")
		  {
			// подсчитать количество ссылок на детальное изображние
			$num_details = sizeof($xml->page[$num_page]->picture_column->details[$n1]->a);
			$details = "";
			for ($n2=0; $n2<$num_details; $n2++)
			  {
				$url = $xml->page[$num_page]->picture_column->details[$n1]->a[$n2]['href'];
				$details .= str_replace("{URL_IMG_DETAILS}", $url, $details_tpl);
			  }
		  }

//--------------------------ФОРМИРОВАНИЕ ССЫЛОК НА ИЗОБРАЖЕНИЯ для вывода на страницу
		$picture = $picture_tpl;
		$picture = str_replace("{IMG}", $img, $picture);

		//if ($img_title)
		  //{
			$picture = str_replace("{IMG_TITLE}", $img_title, $picture);
		  //}

		//$picture = str_replace("{IMG_TITLE_AUTHOR}", $img_title_author, $picture);
		//$picture = str_replace("{IMG_TITLE_DATE}", $img_title_date, $picture);

		if ($details != "")
		  {
			$details .= $filesize;
		  }

		$picture = str_replace("{FILESIZE}", $details, $picture);
		$picture_column .= $picture;
	  }//----------------------------------- end for


	// вставить в шаблон страницы, полученный код  вывода изображений
	// заменяем фрагмент шаблона страницы на полученный код  вывода изображений
	$page = str_replace($picture_tpl, $picture_column, $page);

	return $page;
} //-------------------- end function

//----------------------------------------------------------
// Постраничный вывод списка книг
//----------------------------------------------------------
function list_pages($xml,
					$lib_location,
					$tpl_page,
					$css_styles,
					$count_book_on_page,
					$keyword,
					$charset,
					$save,
					$filename)
{
/*
	echo "function list_pages";
	echo "<br>";
echo "lib_location = ".$lib_location;
echo "<br>";
echo "tpl_page = ".$tpl_page;
echo "<br>";
echo "css_styles = ".$css_styles;
echo "<br>";
echo "count_book_on_page = ".$count_book_on_page;
echo "<br>";
echo "charset = ".$charset;
echo "<br>";
echo "keyword = ".$keyword;
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";
*/

//	$num_books = sizeof($xml->comp_books->book);
	$num_books = sizeof($xml);
	if ($count_book_on_page <= 0)
	  {
		$count_book_on_page = $num_books;
	  }
	if ($count_book_on_page > $num_books)
	  {
		$count_book_on_page = $num_books;
	  }
	echo "Всего элементов: ".$num_books; 
	echo "<br>";
			
	$count_pages = $num_books / $count_book_on_page;
	//echo "count_pages = ".$count_pages;
	//echo "<br>";

	$start_num = 0; // номер книги для начала вывода страницы списка
	$result=0; // флаг для результата поиска
	for ($n1=0; $n1<$count_pages; $n1++)
	  {
		$num_page = $n1;
		$page = form_page_comp_books ($xml, 
											$lib_location,
											$tpl_page,
											$css_styles,
											$num_page,
											$count_book_on_page,
											$start_num,
											$keyword,
											$charset); // вывод одной страницы списка книг
		if ($page !="") // если есть результат поиска
		  {
			$result=1;
			$page .= "<div style='clear:both'></div>";

			$today = date("H:i:s, d.m.Y");
			$page = str_replace ('{LAST MODIFIED}', $today, $page);
			//$filename = str_replace ('{NUM_PAGE}', "0".($num_page+1), $fs_pages);
			//if (!$filename) // если резудьтаты запроса будут сохранены в одном файле
			  //{
				//$filename = $fs_pages;
			  //}

			//echo "function list_pages, filename = ".$filename;
			//echo "<br>";

			if ($charset == "windows-1251")
			  {
				$page = iconv("UTF-8", "windows-1251",$page);
			  }
			echo $page;

			if ($save == 'on')
			  {
				file_put_contents ($filename, $page);
				echo "<font color=red>Save page in </font>".$filename;
				echo "<br>";
			  }
		  } //-------------------------- end if

		$start_num = $start_num + $count_book_on_page; // номер книги для начала вывода страницы списка
	  } //-------------------------- end for

	return $result;
} //----------------------------- end function

//----------------------------------------------------------------------------------------------------------------------------------
// ФОРМИРОВАНИЕ СТРАНИЦЫ для раздела КОМПЬЮТЕРНАЯ ЛИТЕРАТУРА - книги
//----------------------------------------------------------------------------------------------------------------------------------
function form_page_comp_books ($xml, 
								$lib_location,
								$tpl_page,
								$css_styles,
								$num_page,
								$count_book_on_page,
								$start_num,
								$keyword,
								$charset)
{
/*
	echo "function form_page_comp_books";
	echo "<br>";
echo "<pre>";
print_r ($xml);
echo "</pre>";
echo "lib_location = ".$lib_location;
echo "<br>";
echo "tpl_page = ".$tpl_page;
echo "<br>";
echo "css_styles = ".$css_styles;
echo "<br>";
echo "charset = ".$charset;
echo "<br>";
echo "keyword = ".$keyword;
echo "<br>";
*/

	//$num_books = sizeof($xml->comp_books->book);
	$num_books = sizeof($xml);

	$page = file_get_contents($tpl_page); // Считать в переменную шаблон страницы
	$page = str_replace ('{CHARSET}', $charset, $page); // Заменить теги шаблона, данными
	$page = str_replace ('{CSS_STYLES}', $css_styles, $page);
	$page = str_replace ('{NUM_PAGE}', $num_page+1, $page);
 
	// СЧИТАТЬ ШАБЛОН книги в переменную
	$book_tpl_start = "<!--{BOOK_TPL_START}-->";
	$book_tpl_end = "<!--{BOOK_TPL_END}-->";
	//Возвращает позицию первого вхождения подстроки
	$pos1 = strpos($page, $book_tpl_start) + strlen($book_tpl_start);
	$length = strpos($page, $book_tpl_end) - $pos1;
	//Возвращает подстроку - шаблон абзаца
	$book_tpl = substr($page, $pos1, $length); // считать строку с шаблоном в переменную
	//echo "book_tpl = ".$book_tpl; 
	//echo "<br>"; 

	// СЧИТАТЬ ШАБЛОН блока внешних ссылок в переменную
	$book_tpl_ext_links_start = "<!--{BOOK_TPL_EXT_LINKS_START}-->";
	$book_tpl_ext_links_end = "<!--{BOOK_TPL_EXT_LINKS_END}-->";
	//Возвращает позицию первого вхождения подстроки
	$pos1 = strpos($book_tpl, $book_tpl_ext_links_start) + strlen($book_tpl_ext_links_start);
	$length = strpos($book_tpl, $book_tpl_ext_links_end) - $pos1;
	//Возвращает подстроку - шаблон абзаца
	$book_tpl_ext_links = substr($book_tpl, $pos1, $length); // считать строку с шаблоном в переменную
	//echo $book_tpl_ext_links; 

	// СЧИТАТЬ ШАБЛОН поискового ключевого слова в переменную
	$book_tpl_keyword_start = "<!--{BOOK_TPL_KEYWORD_START}-->";
	$book_tpl_keyword_end = "<!--{BOOK_TPL_KEYWORD_END}-->";
	//Возвращает позицию первого вхождения подстроки
	$pos1 = strpos($book_tpl, $book_tpl_keyword_start) + strlen($book_tpl_keyword_start);
	$length = strpos($book_tpl, $book_tpl_keyword_end) - $pos1;
	//Возвращает подстроку - шаблон абзаца
	$book_tpl_keyword = substr($book_tpl, $pos1, $length); // считать строку с шаблоном в переменную
	//echo $book_tpl_keyword; 

	$page = str_replace ($book_tpl, "", $page); // удалить шаблон книги из шаблона страницы
	$book_tpl = str_replace ($book_tpl_ext_links, "", $book_tpl); // удалить шаблон внешних ссылок из шаблона книги
	$book_tpl = str_replace ($book_tpl_keyword, "", $book_tpl); // удалить шаблон ключевого слова из шаблона книги

	$books = "";
	$result=0; // флаг для результата поиска
	$end_num=$start_num + $count_book_on_page;
	for ($n1=$start_num;  $n1 < $end_num; $n1++)
	  {
//echo "n1 = ".$n1;
//echo "<br>";
		if (!empty($keyword))
		  {
			//if ($xml->comp_books->book[$n1])
			if ($xml[$n1])
			  {
				// Проверка блока поисковых ключевых слов для книги
				//$num_keywords = sizeof($xml->comp_books->book[$n1]->keywords->item);
				$num_keywords = sizeof($xml[$n1]->keywords->item);
				for ($n2=0; $n2<$num_keywords; $n2++)
				  {
//echo "n2 = ".$n2;
//echo " ---keyword = ".$keyword;
//echo $xml->comp_books->book[$n1]->keywords->item[$n2];
//echo "<br>";
					//if (strtoupper($xml->comp_books->book[$n1]->keywords->item[$n2]) == strtoupper($keyword))
					if (strtoupper($xml[$n1]->keywords->item[$n2]) == strtoupper($keyword))
					  {
						$book = $book_tpl;
						$book = form_book($xml,
											$n1,
											$book,
											$book_tpl_ext_links,
											$book_tpl_keyword,
											$lib_location);
						$books .= $book;// добавить к списку книг,  блок книги, сформированный по шаблону
						$result=1;
					  }
				  }//---------------end for

				if ($keyword =='all')
				  {
					$book = $book_tpl;
					$book = form_book($xml,
										$n1,
										$book,
										$book_tpl_ext_links,
										$book_tpl_keyword,
										$lib_location);
					$books .= $book;// добавить к списку книг,  блок книги, сформированный по шаблону
					$result=1;
				  }

			} //------------------ end if
  		  }
		else 
		  {
			echo "<p>no keyword!!!</p>";
		  }

	  }
//echo "result = ".$result;
//echo "<br>";

	if ($result !=1)
	  {
		$page = "";// ничего не найдено, очистить вывод
	  }
	else
		$page = str_replace ('{BOOKS_LIST}', $books, $page);// добавить к выводу страницы, список книг

//echo "page = ".$page;
//echo "<hr>";
	return $page;
} //-------------------- end function

//------------------------------------------------------------------
//  сформировать по шаблону  блок книги
//------------------------------------------------------------------
function form_book($xml,
					$num_book,
					$book,
					$book_tpl_ext_links,
					$book_tpl_keyword,
					$lib_location)
{
//	$num_books = sizeof($xml->comp_books->book);
	$num_books = sizeof($xml);
	$book = str_replace ('{NUM}',"№".($num_book+1)." из ".$num_books, $book);

//	$section = $xml->comp_books->book[$num_book]->section;
	$section = $xml[$num_book]->section;
	$book = str_replace ('{SECTION}', $section, $book);

//	$author = $xml->comp_books->book[$num_book]->author;
	$author = $xml[$num_book]->author;
	$book = str_replace ('{AUTHOR}', $author, $book);

//	$url = $lib_location."/".$xml->comp_books->book[$num_book]->location->folder;
	$url = $lib_location."/".$xml[$num_book]->location->folder;
//	$url .= "/".$xml->comp_books->book[$num_book]->location->a['href'];
	$url .= "/".$xml[$num_book]->location->a['href'];
//	$url_text = $xml->comp_books->book[$num_book]->name;
	$url_text = $xml[$num_book]->name;
	$book = str_replace ('{URL}', $url, $book);
	$book = str_replace ('{URL_TEXT}', $url_text, $book);

//	$comment = $xml->comp_books->book[$num_book]->comment;
	$comment = $xml[$num_book]->comment;
	$book = str_replace ('{COMMENT}', $comment, $book);

	// Вывод внешних ссылок
	$block_ext_links = "";
//	$num = sizeof($xml->comp_books->book[$num_book]->ext_links->a);
	$num = sizeof($xml[$num_book]->ext_links->a);
	for ($n2=0; $n2<$num; $n2++)
	  {
		$book_ext_links = $book_tpl_ext_links;
		//$url2 = $xml->comp_books->book[$num_book]->ext_links->a[$n2]['href'];
		$url2 = $xml[$num_book]->ext_links->a[$n2]['href'];
		//$url2_text = $xml->comp_books->book[$num_book]->ext_links->a[$n2];
		$url2_text = $xml[$num_book]->ext_links->a[$n2];
		$book_ext_links = str_replace ('{URL2}', $url2, $book_ext_links);
		$book_ext_links = str_replace ('{URL2_TEXT}', $url2_text, $book_ext_links);
		$block_ext_links .= $book_ext_links; // добавить сформированную ссылку к блоку
	  }
	$book = str_replace ('{BLOCK_EXT_LINKS}', $block_ext_links, $book);// добавить к блоку книги, блок внешних ссылок
	
	$format = $xml->comp_books->book[$num_book]->format;
	$book = str_replace ('{FORMAT}', $format, $book);

	// Вывод поисковых ключевых слов для этой книги
	//$num_keywords = sizeof($xml->comp_books->book[$num_book]->keywords->item);
	$num_keywords = sizeof($xml[$num_book]->keywords->item);
	$block_keywords = "";
	for ($n2=0; $n2<$num_keywords; $n2++)
	  {
		$keyword_item = $book_tpl_keyword;
		//$keyword_item = str_replace ('{KEYWORD}', $xml->comp_books->book[$num_book]->keywords->item[$n2], $keyword_item);
		$keyword_item = str_replace ('{KEYWORD}', $xml[$num_book]->keywords->item[$n2], $keyword_item);
		$block_keywords .= $keyword_item; // добавить ключевое слово к блоку
	  }
	$book = str_replace ('{BLOCK_KEYWORDS}', $block_keywords, $book);// добавить к блоку книги, блок поисковых ключевых слов
	return $book;
} //-------------------- end function

//------------------------------------------------------------------------------------------------------------------------------------------------------
// Формируем список ссылок на тетради....(исключая текущую),  URL_LIST
//------------------------------------------------------------------------------------------------------------------------------------------------------
function form_url_list($xml, $name)
{
/*
echo "function form_url_list";
echo "<br>";
echo "<pre>";
print_r ($xml);
echo "</pre>";
echo "<font color=green>Prep url list.... </font>";
echo "<br>";
echo "name = ".$name;
echo "<br>";
*/

//Сформировать массив name и title существующих тетрадей
	$num_elements = sizeof($xml->book);
//echo "num_elements = ".$num_elements;
//echo "<br>";
	for ($n1=0; $n1<$num_elements; $n1++)
	  {
//echo $xml->book[$n1]['name'];
//echo "<br>";
		if ($xml->book[$n1]->location)
		  {
			$title = $xml->book[$n1]->title2;
			$location = $xml->book[$n1]->location;
			$book_name = $xml->book[$n1]['name'];
			$num = $xml->book[$n1]->num_order;
			$num = $num*1; //перевод в целый тип
			$url = "<a href='".$location."'>".$title."</a>";
			$url_list[$num][0] = $url;
			$url_list[$num][1] = $book_name;
//echo $url_list[$num][0].", ".$url_list[$num][1];
//echo "<br>";
		  }
	  } //---------------------------- end for

	$num_first_element=1;// для первого элемента не нужен разделитель ссылок
	if ($url_list[1][1] == $name) // если текущая исключаемая из спика, тетрадь первая, то увеличить $num_first_element
	  {
		$num_first_element=2;
	  }

	for ($n1=0; $n1 <= count($url_list); $n1++)
	  {
//echo $n1.". ";
//echo $url_list[$n1][0].", ".$url_list[$n1][1];
//echo "<br>";
		if (!empty($url_list[$n1][0]))
		  {
//echo $url_list[$n1][1];
//echo "<br>";
			if ($url_list[$n1][1] != $name) // исключить из списка ссылок текущую тетрадь
			  {
				if ($n1!=$num_first_element)
				  {
					$url_list2 .= " | ".$url_list[$n1][0];
				  }
				else
					$url_list2 .= $url_list[$n1][0]; // для первого элемента не нужен разделитель ссылок
			  }
			//else
				//echo "url_list[$n1][1] = $name<br>";
		  }

	  } //---------------------------- end for
//echo $url_list2;
//echo "<br>";
	return $url_list2;
} //-------------------- end function

//----------------------------------------------------------------------------------------
// подготовка шаблонов для формирования карты  ссылок
//----------------------------------------------------------------------------------------
function prep_sitemap_tpl(
						$sitemap_name,
						$sitemap_tpl_file)
{
	global $sitemap_tpl, $sitemap_tpl_url, $sitemap_tpl_url_images;

	$sitemap_tpl = file_get_contents($sitemap_tpl_file);
	if ($sitemap_tpl) 
	  {
		$sitemap_tpl = str_replace ('<!--{SITE_NAME}-->', $sitemap_name, $sitemap_tpl);
		// СЧИТАТЬ ШАБЛОН ссылок карты сайта в переменную
		echo "<font color=green>Prep sitemap tpl urls.... </font>";
		echo "<br>";
		$sitemap_url_start = "<!--{SITEMAP_URL_START}-->";
		$sitemap_url_end = "<!--{SITEMAP_URL_END}-->";
		$pos1 = strpos($sitemap_tpl, $sitemap_url_start) + strlen($sitemap_url_start);// получить нач. позицию шаблона
		$length = strpos($sitemap_tpl, $sitemap_url_end) - $pos1;// получить длину шаблона
		//Возвращает подстроку - шаблон
		$sitemap_tpl_url = substr($sitemap_tpl, $pos1, $length); // считать строку с шаблоном в переменную

		// удалить из шаблона карты сайта, шаблон ссылки
		$sitemap_tpl = substr_replace($sitemap_tpl, '', $pos1, $length);
		//$sitemap_tpl = str_replace ("<!--{SITEMAP_URL_START}--><!--{SITEMAP_URL_END}-->", "", $sitemap_tpl); 

		$sitemap_url_images_start = "<!--{SITEMAP_IMAGE_START}-->";
		$sitemap_url_images_end = "<!--{SITEMAP_IMAGE_END}-->";
		$pos1 = strpos($sitemap_tpl_url, $sitemap_url_images_start) + strlen($sitemap_url_images_start);// получить нач. позицию шаблона
		$length = strpos($sitemap_tpl_url, $sitemap_url_images_end) - $pos1;// получить длину шаблона
		//Возвращает подстроку - шаблон
		$sitemap_tpl_url_images = substr($sitemap_tpl_url, $pos1, $length); // считать строку с шаблоном в переменную
		// удалить из шаблона карты сайта, шаблон ссылки
		$sitemap_tpl_url = substr_replace($sitemap_tpl_url, '', $pos1, $length);

//echo $sitemap_tpl;
//echo "sitemap_tpl_url = ".$sitemap_tpl_url;
//echo "<br>";
//echo "sitemap_tpl_url_images = ".$sitemap_tpl_url_images;
//echo "<br>";
	  }
	else
	  {
		echo "<font color=red>Error reading sitemap tpl.... </font>";
		echo "<br>";
	  }
} //-------------------- end function

//----------------------------------------------------------------------------------------
// Сформировать по шаблону ссылку для карты сайта
//----------------------------------------------------------------------------------------
function form_sitemap_url ($xml, 
						$num_book, 
						$num1_page, 
						$num_page, 
						$url_img1,
						$url_img2,
						$url_img3,
						$url_img4,
						$url_img5,
						$url_pages)
  {
	global $sitemap_tpl, $sitemap_tpl_url, $sitemap_tpl_url_images;
/*
echo "function form_sitemap_url";
echo "<br>";
echo $sitemap_tpl;
echo "<br>";
echo "sitemap_tpl_url = ".$sitemap_tpl_url;
echo "<br>";

echo "url_pages = ".$url_pages;
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";
*/

echo "<font color=green>Insert sitemap url.... </font>";
echo "<br>";

	// подсчитать количество изображнией на странице 
	$num_pictures = sizeof($xml->page[$num1_page]->picture_column->img);
//echo "num_pictures = ".$num_pictures."<br>";
//echo "<br>";

	$sitemap_url = $sitemap_tpl_url;
	$page_url = str_replace ('{NUM_PAGE}', "0".$num_page, $url_pages);
	$sitemap_url = str_replace("<!--{PAGE_URL}-->", $page_url, $sitemap_url);
	for ($n1=0; $n1<$num_pictures; $n1++)
	  {
//echo $xml->book[0]->page[$num_page]->picture_column->img[$n1]['src'];
//echo "<br>";
		$img = $xml->page[$num1_page]->picture_column->img[$n1]['src'];

		$sitemap_url_images = $sitemap_tpl_url_images;
		$sitemap_url_images = str_replace ('<!--{URL_IMG2}-->', $url_img2, $sitemap_url_images);
		$sitemap_url_images = str_replace ('<!--{URL_IMG4}-->', $url_img4, $sitemap_url_images);
		$sitemap_url_images = str_replace ('<!--{URL_IMG5}-->', $url_img5, $sitemap_url_images);
		$sitemap_url_images = str_replace("<!--{IMG}-->", $img, $sitemap_url_images);
//echo "sitemap_url_images = ".$sitemap_url_images;
//echo "<br>";
		$sitemap_url_pictures .= $sitemap_url_images;
	  }//----------------------------------- end for
	$sitemap_url = str_replace ("<!--{SITEMAP_IMAGE_START}--><!--{SITEMAP_IMAGE_END}-->", $sitemap_url_pictures, $sitemap_url); 

//echo "sitemap_url = ".$sitemap_url;
//echo "<br>";
	return $sitemap_url;
} //-------------------- end function


//---------------------------------------------------------------------------------
// ДОБАВИТЬ НА СТРАНИЦУ ПЕЙДЖЕР (art_books)
//---------------------------------------------------------------------------------
function parse_art_book_add_pager ($xml_book)
  {
	global $page,$num_page, $count_pages, $fs_pages, $use_pager;
echo "count_pages = ".$count_pages;
echo "<br>";
/*
echo "function parse_art_book_add_pager";
echo "<br>";
*/

//echo "Prep pager tpl.....";
//echo "<br>";
	// СЧИТАТЬ ШАБЛОН пейджера в переменную
	$pager_start = "<!--{PAGER_START}-->";
	$pager_end = "<!--{PAGER_END}-->";
	$pos1 = strpos($page, $pager_start) + strlen($pager_start);// получить нач. позицию шаблона (исключая метку начала)
	$length = strpos($page, $pager_end) - $pos1;// получить длину шаблона
	$pager_tpl = substr($page, $pos1, $length); // считать строку с шаблоном в переменную
//echo "pager_tpl = ".$pager_tpl;
//echo "<br>";
	// удалить из страницы, ненужный шаблон ссылок
	$page = str_replace($pager_tpl, "", $page);

	// СЧИТАТЬ ШАБЛОН СПИСКА ССЫЛОК пейджера в переменную
	$page_list_start = "<!--{PAGE_LIST_START}-->";
	$page_list_end = "<!--{PAGE_LIST_END}-->";
	$pos1 = strpos($pager_tpl, $page_list_start) + strlen($page_list_start);// получить нач. позицию шаблона (исключая метку начала)
	$length = strpos($pager_tpl, $page_list_end) - $pos1;// получить длину шаблона
	$page_list_tpl = substr($pager_tpl, $pos1, $length); // считать строку с шаблоном в переменную
//echo "page_list_tpl = ".$page_list_tpl;
//echo "<br>";
	// удалить из страницы, ненужный шаблон ссылок
	$pager_tpl = str_replace($page_list_tpl, "", $pager_tpl);

	if ($use_pager == 'on')
	  {
echo "<font color=green>Insert PAGER.....</font>";
echo "<br>";
		$pager = $pager_tpl; 
		$page_list = ""; 
//---------------------------------------------------------------------------------------------------------------------------------
//echo "url= ".$xml_book->page[$num_page-1]->url;
//echo "<br>";
//---------------------------------------------------------------------------------------------------------------------------------
		// формируем список ссылок
		for ($n3=0; $n3 < $count_pages; $n3++)
		  {
			$num_next_page = $n3+1;
			$filename =  $xml_book->page[$n3]->url; 
//echo "filename = ".$filename;
//echo "<br>";
			// добавить к списку ссылок, ссылку на следующую стр.
			$next_page_list = str_replace("{FILENAME}", $filename, $page_list_tpl); 

			//пометить активную страницу
			$num_active_page = $n3+1;
			if ($num_active_page == $num_page)
		  	  {
				$num_active_page="<span class='active_page'>".$num_active_page."</span>";
			  }

			$next_page_list = str_replace("{LIST_NUM_PAGE}", $num_active_page, $next_page_list); 
			$page_list .= $next_page_list; 
		  }//-------------------------------------- end for
//echo "page_list = ".$page_list;
//echo "<br>";
		$pager = str_replace("<!--{PAGE_LIST_START}-->",$page_list, $pager);
		$pager = str_replace("<!--{PAGE_LIST_END}-->","", $pager);
		$pager = str_replace("{INDEX}", "../", $pager);

		// определить имя файла для предыдущей страницы
		$num_prev_page = $num_page-2;
		if ($num_prev_page < 0)
	  	  {
			$num_prev_page = $count_pages-1;
		  }
//echo "num_prev_page = ".$num_prev_page;
//echo "<br>";
		$filename_prev =  $xml_book->page[$num_prev_page]->url; 
		$pager = str_replace("{PREV_URL}", $filename_prev, $pager);

		// определить имя файла для следующей страницы
		$num_next_page = $num_page;
		if ($num_next_page >= $count_pages)
	  	  {
			$num_next_page = 0;
		  }
//echo "num_next_page = ".$num_next_page;
//echo "<br>";
		$filename_next =  $xml_book->page[$num_next_page]->url; 
		$pager = str_replace("{NEXT_URL}", $filename_next, $pager);

		$page = str_replace ('<!--{PAGER_START}-->', $pager, $page);
		$page = str_replace ('<!--{PAGER_END}-->', "", $page);
	  }
	else
	  {
		// когда не используется шаблон пейджера, удалить его строки со страницы
		$page = str_replace ('<!--{PAGER_START}--><!--{PAGER_END}-->', "", $page); 
	  }
} //-------------------- end function

//------------------------------------------------------------------------
// Постраничный вывод страниц фотогалереи Cross
//------------------------------------------------------------------------
function list_gallery_cross_pages($xml)
{
	global 	$count_img_on_page,
			$use_pager,
			$yandex_metrika,
			$save,
			$fs_pages;

/*
echo "<h2>function list_gallery_cross_pages</h2>";
echo "<br>";
echo "<pre>";
print_r ($xml);
echo "</pre>";
*/
	// подсчитать количество изображений в галерее
	$num_pictures = sizeof($xml->picture);
//echo "num_pictures = ".$num_pictures."<br>";

	// определить количество страниц изображнией, при использовании пейджера
	if ($count_img_on_page <= 0)
	  {
		$count_img_on_page = $num_pictures;
	  }
	if ($count_img_on_page > $num_pictures)
	  {
		$count_img_on_page = $num_pictures;
	  }
//echo "count_img_on_page = ".$count_img_on_page;
//echo "<br>";

	$count_pages =  ceil($num_pictures / $count_img_on_page);
//echo "count_pages = ".$count_pages;
//echo "<br>";

	$start_num = 0; // номер изображения для начала вывода страницы списка
	$num_page = $n1+1;

	$picture_column = "";
	for ($n1=0; $n1<$count_pages; $n1++)
	  {
		$num_page = $n1+1;
		$page=form_page_gallery_cross ($xml,
						$n1,
						$count_img_on_page,
						$start_num);
//echo $page;
		$start_num = $start_num + $count_img_on_page; // номер изображения для начала вывода новой страницы
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
		//-------------------------------------------------------------------------------
		// Добавить на страницу Яндекс-метрику
		//-------------------------------------------------------------------------------
		if (!empty($yandex_metrika))
		  {
echo "Insert Yandex-metrika....";
echo "<br>";
			$page = str_replace ('<!--{YA_METRIKA}-->', $yandex_metrika, $page);
		  }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
		// СЧИТАТЬ ШАБЛОН пейджера в переменную
		$pager_start = "<!--{PAGER_START}-->";
		$pager_end = "<!--{PAGER_END}-->";
		$pos1 = strpos($page, $pager_start) + strlen($pager_start);// получить нач. позицию шаблона (исключая метку начала)
		$length = strpos($page, $pager_end) - $pos1;// получить длину шаблона
		$pager_tpl = substr($page, $pos1, $length); // считать строку с шаблоном в переменную
//echo "pager_tpl = ".$pager_tpl;
//echo "<br>";
		// удалить из страницы, ненужный шаблон ссылок
		$page = str_replace($pager_tpl, "", $page);

		$filename = str_replace ('{NUM_PAGE}', "0".$num_page, $fs_pages);
		if (!$filename) // если результаты запроса будут сохранены в одном файле, т.е. не задана маска имени файла
		    {
				$filename = $fs_pages;
		    }
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
		if ($use_pager == 'on')
		  {
echo "Insert pager.....";
echo "<br>";
			// СЧИТАТЬ ШАБЛОН СПИСКА ССЫЛОК пейджера в переменную
			$page_list_start = "<!--{PAGE_LIST_START}-->";
			$page_list_end = "<!--{PAGE_LIST_END}-->";
			$pos1 = strpos($pager_tpl, $page_list_start) + strlen($page_list_start);// получить нач. позицию шаблона (исключая метку начала)
			$length = strpos($pager_tpl, $page_list_end) - $pos1;// получить длину шаблона
			$page_list_tpl = substr($pager_tpl, $pos1, $length); // считать строку с шаблоном в переменную
//echo "page_list_tpl = ".$page_list_tpl;
//echo "<br>";
			// удалить из страницы, ненужный шаблон ссылок
			$pager_tpl = str_replace($page_list_tpl, "", $pager_tpl);
			//---------------------------------------------------------------------------------
			// ВСТАВИТЬ В ПЕРЕМЕННУЮ ПЕЙДЖЕР СТРАНИЦ
			//---------------------------------------------------------------------------------
			$pager = $pager_tpl; 
			$page_list = ""; 
			// формируем список ссылок
			for ($n2=0; $n2<$count_pages; $n2++)
			  {
				$num_next_page = $n2+1;
				$filename_next =  str_replace($num_page, $num_next_page, basename($filename)); 
//echo "filename_next= ".$filename_next;
//echo "<br>";
				// добавить к списку ссылок, ссылку на следующую стр.
				$next_page_list = str_replace("<!--{FILENAME}-->", $filename_next, $page_list_tpl); 

				//пометить активную страницу
				$num_active_page = $n2+1;
				if ($num_active_page == $num_page)
			  	  {
					$num_active_page="<span class='active_page'>".$num_active_page."</span>";
				  }

				$next_page_list = str_replace("<!--{LIST_NUM_PAGE}-->", $num_active_page, $next_page_list); 
				$page_list .= $next_page_list; 
			  }//-------------------------------------- end for
//echo "page_list = ".$page_list;
//echo "<br>";
			$pager = str_replace("<!--{PAGE_LIST_START}-->",$page_list, $pager);
			$pager = str_replace("<!--{PAGE_LIST_END}-->","", $pager);

			//-------------------------------------------------------------------------------
			// Добавить на страницу список ссылок на другие галереи
			//-------------------------------------------------------------------------------
			if (!empty($url_list))
			  {
echo "Insert URL LIST.....";
echo "<br>";
				$pager = str_replace("<!--{URL_LIST}-->", $url_list, $pager);
			  }
			//$pager = str_replace("{INDEX}", "../", $pager);

			// в имени файла заменить номер текущей страницы, номером предыдущей страницы
			$num_prev_page = $num_page-1;
			if ($num_prev_page < 1)
		  	  {
				$num_prev_page = $count_pages;
			  }
			$filename_prev =  str_replace($num_page, $num_prev_page, basename($filename)); 
			//$pager = str_replace("<!--{PREV_URL}-->", $filename_prev, $pager);
			$page = str_replace("<!--{PREV_URL}-->", $filename_prev, $page);

			// в имени файла заменить номер текущей страницы, номером следующей страницы
			$num_next_page = $num_page+1;
			if ($num_next_page > $count_pages)
		  	  {
				$num_next_page = 1;
			  }
			$filename_next =  str_replace($num_page, $num_next_page, basename($filename)); 
			//$filename_next =  basename($filename)."_next";
			//$pager = str_replace("<!--{NEXT_URL}-->", $filename_next, $pager);
			$page = str_replace("<!--{NEXT_URL}-->", $filename_next, $page);

			$page = str_replace ('<!--{PAGER_START}-->', $pager, $page);
			$page = str_replace ('<!--{PAGER_END}-->', "", $page);
		  }//------------------------------ end if

		// когда не используется шаблон пейджера, удалить его строки со страницы
		//$page = str_replace ('<!--{PAGER_START}--><!--{PAGER_END}-->', "", $page); 
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
		if ($charset == "windows-1251")
		  {
			$page = iconv("UTF-8", "windows-1251",$page);
		  }

		if ($save == 'on')
		  {
			file_put_contents ($filename, $page);
			echo "<font color=red>Save page in </font>".$filename;
			echo "<br>";
		  }
echo $page;

	  } //-------------------------- end for

} //-------------------- end function

//--------------------------------------------------------------------------
// Формирование страницы фотогалереи с шаблоном Cross
//--------------------------------------------------------------------------
function form_page_gallery_cross ($xml,
					$num_page,
					$count_img_on_page,
					$start_num)
{
	global 	$charset,
			$css_styles,
			$css_styles_fix,
			$js_location,
			$no_js_location,
			$tpl_page,
			$icon_img_path,
			$full_img_path_preview, 
			$full_img_path, 
			$count_img_on_page;

/*
echo "<b>function form_page_gallery_cross</b>";
echo "<br>";
echo "<pre>";
print_r ($xml);
echo "</pre>";
*/

	$title_num = $num_page+1;
	$title =$xml->title. ", страница ".$title_num;
	$title2 =$xml->title;
//echo $title;
//echo "<br>";
	$meta_keywords = $xml->meta['keywords'];
//echo "meta_keywords =".$meta_keywords;
//echo "<br>";
	$meta_description = $xml->meta['description'];
//echo "meta_description = ".$meta_description;
//echo "<br>";

	$page = file_get_contents($tpl_page); // Считать в переменную шаблон страницы
	$page = str_replace ('<!--{CHARSET}-->', $charset, $page); // Заменить теги шаблона, данными
	$page = str_replace ('<!--{TITLE}-->', $title, $page);
	$page = str_replace ('<!--{TITLE2}-->', $title2, $page);
	$page = str_replace ('<!--{KEYWORDS}-->', $meta_keywords, $page);
	$page = str_replace ('<!--{DESCRIPTION}-->', $meta_description, $page);

	$page = str_replace ('<!--{JS_LOCATION}-->', $js_location, $page);
	$page = str_replace ('<!--{NO_JS_LOCATION}-->', $no_js_location, $page);

	$page = str_replace ('<!--{CSS_STYLES}-->', $css_styles, $page);
	$page = str_replace ('<!--{CSS_STYLES_FIX-IE}-->', $css_styles_fix, $page);

	$page = str_replace ('<!--{ICON_IMG_PATH}-->', $icon_img_path, $page);
	$page = str_replace ('<!--{FULL_IMG_PATH_PREVIEW}-->', $full_img_path_preview, $page);
	$page = str_replace ('<!--{FULL_IMG_PATH}-->', $full_img_path, $page);

//------------------------

	// СЧИТАТЬ ШАБЛОН для вывода изображения,  в переменную
	$picture_tpl_start = "<!--{PICTURE_URL_START}-->";
	$picture_tpl_end = "<!--{PICTURE_URL_END}-->";
	$pos1 = strpos($page, $picture_tpl_start) + strlen($picture_tpl_start);// получить нач. позицию шаблона
	$length = strpos($page, $picture_tpl_end) - $pos1;// получить длину шаблона
	//Возвращает подстроку - шаблон
	$picture_tpl = substr($page, $pos1, $length);  // считать строку с шаблоном в переменную
	// удалить шаблон ссылки из родительского шаблона страницы
	//$page = substr_replace($page, '', $pos1, $length);

	$picture_column = "";
	$num_div_img = 0;
	for ($n1=$start_num; $n1<$start_num + $count_img_on_page; $n1++)
	  {
//echo $n1." ".$xml->picture[$n1]->filename;
//echo "<br>";
		if (!empty($xml->picture[$n1]->filename)) // если тег с именем файла заполнен
		  {
			// формируем шаблон для вывода одного изображения 
			$img=$xml->picture[$n1]->filename;

			$img_title_author	=	htmlspecialchars($xml->picture[$n1]->author);
			$img_title_date		=	htmlspecialchars($xml->picture[$n1]->date);
			$img_title			=	htmlspecialchars($xml->picture[$n1]->name);
			$img_info			=	htmlspecialchars($xml->picture[$n1]->info);

//--------------------------ФОРМИРОВАНИЕ ССЫЛОК НА ИЗОБРАЖЕНИЯ для вывода на страницу
			$picture = $picture_tpl;
			$picture = str_replace ('<!--{DIV_IMG}-->', "img".$num_div_img, $picture);
			$picture = str_replace("<!--{IMG}-->", $img, $picture);
			$picture = str_replace("<!--{IMG_TITLE_AUTHOR}-->", $img_title_author, $picture);
			$picture = str_replace("<!--{IMG_TITLE_DATE}-->", $img_title_date, $picture);
			$picture = str_replace("<!--{IMG_TITLE}-->", $img_title, $picture);
			$picture = str_replace("<!--{INFO}-->", $img_info, $picture);
			$picture_column .= $picture;
			$num_div_img ++;
		  }// --------------------------------- end if
		else
		  {
			//echo "filename empty !";
			//echo "<br>";
		  }

	  } //------------------ end for

//echo "picture_column = ".$picture_column;
//echo "<br>";

	// вставить в шаблон страницы, полученный код  вывода изображений
	// заменяем фрагмент шаблона страницы на полученный код  вывода изображений
	$page = str_replace($picture_tpl, $picture_column, $page);

//echo $page;
	return $page;

} //-------------------- end function

?>


