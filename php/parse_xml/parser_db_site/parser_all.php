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

	if ($_REQUEST['save'] == 'on')
	  {
		$save='on';
		if (!isset($_REQUEST['fs_pages']) OR empty($_REQUEST['fs_pages']))
		  {
			echo "<font color=red>Need fs_pages..... </font>";
			echo "<br>";
			exit();
		  }
		$fs_pages = $_REQUEST['fs_pages'];
	  }

	if ($_REQUEST['tpl_page']=="" OR empty($_REQUEST['tpl_page']))
	  {
		echo "<font color=red>need tpl_page..... </font>";
		echo "<br>";
		exit();
	  }
	$tpl_page=	$_REQUEST['tpl_page'];

	if ($_REQUEST['css_styles']=="" OR empty($_REQUEST['css_styles']))
	  {
		echo "<font color=red>need css_styles..... </font>";
		echo "<br>";
		//exit();
	  }
	$css_styles	=	$_REQUEST['css_styles'];

	if ($_REQUEST['js_location']=="" OR empty($_REQUEST['js_location']))
	  {
		echo "<font color=red>need js_location..... </font>";
		echo "<br>";
		//exit();
	  }
	$js_location	=$_REQUEST['js_location'];

	if ($_REQUEST['img_path'])
	  {
		$img_path = $_REQUEST['img_path']; 
	  }
	if ($_REQUEST['preview_img_path'])
	  {
		$preview_img_path = $_REQUEST['preview_img_path']; 
	  }

	// ПЕРЕХОД к парсингу XML согласно переданным параметрам
	switch ($action)
	  {
//==========================================================================
		case form_portfolio:
			$xml_portfolio_section = $xml->xpath('//main/portfolio');
			$page = parse_portfolio($xml_portfolio_section[0]);
			//echo $page;
			if ($charset == "windows-1251")
			  {
				$page = iconv("UTF-8", "windows-1251",$page);
			  }

			//-----------------------------------------------
			// Сохранить страницу в файл
			//-----------------------------------------------
			if ($save == 'on')
			  {
				$filename = $fs_pages;
				if (file_put_contents ($filename, $page))
				  {
					echo "<b><font color=green>Save page in </font>".$filename."</b>";
					echo "<br>";
					readfile($filename);
				  }
				else
				  {
					echo "<b><font color=red>Error save in </font>".$filename."</b>";
					echo "<br>";
				  }
			  }
		break;
//==========================================================================
		case form_films:
			echo "form_films";
		break;

		case form_articles:
			echo "form_articles";
		break;

		case form_books:
			echo "form_books";
		break;

		case form_music:
			echo "form_music";
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
<style>
div
{
	border:1px solid;
	margin:10px;
	padding:10px;
}
</style>
</head>
<body>
<form name=form_parse_pages method=post action='".$_SERVER['SCRIPT_NAME']."' target=_blank>
	<fieldset>
	<legend><b>Формирование страниц</b></legend>

	<fieldset>
	<div>xml_file:		
		<input type='text'  name='xml_file' size='50' value=''><br><br>
		<p>
			http://mycomp/pages/xml/mydb.xml<br>
		</p>
	</div>

	<p>charset:
		<select name='charset'>
			<option value='utf-8' selected >utf-8</option>
			<option value='windows-1251'>windows-1251</option>
		</select>
	<p>
	</fieldset>

	<div>tpl_page
	 	<input type='text'  name='tpl_page' size='50' 	value=''><br>
http://mycomp/pages/tpl/portfolio_page.tpl<br>
<br>
	</div>

	<div>css_styles: 		
		<input type='text'  name='css_styles' size='50'	value=''><br><br>
		<p>
/pages/css/portfolio-style.css<br/>
/pages/css/list_films.css<br/>
/pages/css/list_articles.css<br/>
/pages/css/list_books.css<br/>
/pages/css/list_music.css<br/>
		</p>

		<p>js_location: 		
			<input type='text'  name='js_location' size='50'		value='/pages/js'><br><br>
		</p>
	</div>

	<div>
img_path	<input type='text'  name='img_path' size='50'	value=''><br><br>
/pages/img/portfolio/<br/>
<br>
preview_img_path	<input type='text'  name='preview_img_path' size='50'	value=''><br><br>
/pages/img/portfolio/preview_img/<br/>
	</div>

	<div>fs_pages (файловый путь для сохранения страницы. Относительно парсера!!!!):<br/> 		
		<input type='text'  name='fs_pages' size='50' 		value=''><br><br>
		<p>
../../pages/portfolio.html<br>
../pages/list_books.html<br/>
../pages/list_films.html<br/>
../pages/list_articles.html<br/>
../pages/list_music.html<br/>
		</p>

<!--
	<p>
html_page:		<input type='text'  name='html_page' size='50' 		value='../pages/list_books.html'><br><br>
../pages/list_books.html<br/>
../pages/list_films.html<br/>
../pages/list_articles.html<br/>
../pages/list_music.html<br/>
	</p>
-->
		<p>save in files: 		
			<input type='checkbox'  name='save'>
		</p>
	</div>

	<div>action:
		<input type='text' name='action' value=''><br>
form_portfolio (Формирование страницы портфолио)<br>
form_films<br>
form_articles<br>
form_books<br>
form_music<br> 
		<input type=submit value='run script'>
	</div>

	</fieldset>
</form>
</body>
</html>";
} //-------------------------- end func

//---------------------------------------------
// Формирование страницы портфолио
//--------------------------------------------
function parse_portfolio($xml)
  {
	global 	$charset,
			$css_styles,
			$js_location,
			$tpl_page,
			$img_path,
			$preview_img_path;
/*
echo "function parse_portfolio()";
echo "<br>";

echo "<pre>";
print_r ($xml);
echo "</pre>";

echo "js_location = ".$js_location;
echo "<br>";
*/
	$title=$xml->title;

	$page = file_get_contents($tpl_page); // Считать в переменную шаблон страницы
	$page = str_replace ('<!--{CHARSET}-->', $charset, $page); // Заменить теги шаблона, данными
	$page = str_replace ('<!--{TITLE}-->', $title, $page);
	$page = str_replace ('<!--{CSS_STYLES}-->', $css_styles, $page);
	$page = str_replace ('<!--{JS_LOCATION}-->', $js_location, $page);

	// Считать шаблон вывода информации о проекте в переменную
	$project_start = "<!--{PROJECT_COLUMN_START}-->";
	$project_end = "<!--{PROJECT_COLUMN_END}-->";
	$pos1 = strpos($page, $project_start) + strlen($project_start);// получить нач. позицию шаблона (исключая метку начала)
	$length = strpos($page, $project_end) - $pos1;// получить длину шаблона
	$project_tpl = substr($page, $pos1, $length); // считать строку с шаблоном в переменную
//echo "project_tpl = ".$project_tpl;
//echo "<br>";
	// удалить из страницы, ненужный шаблон ссылок
	//$page = str_replace($project_tpl, "", $page);

	$num_projects = count($xml->project);
//echo $num_projects;
//echo "<br>";
	$project_list = ""; 
	for ($n1=0; $n1<$num_projects; $n1++)
	  {
		$project = $project_tpl; 
		$project = str_replace ('<!--{PROJECT_NAME}-->', $xml->project[$n1]->name, $project);
		$project = str_replace ('<!--{PROJECT_REPORT}-->', $xml->project[$n1]->report, $project);
		$project = str_replace ('<!--{PROJECT_URL}-->', $xml->project[$n1]->url, $project);

		if ($xml->project[$n1]->img)
		  {
			$project_img = $img_path.$xml->project[$n1]->img;
			$project = str_replace ('<!--{PROJECT_IMG}-->', $project_img, $project);
			$project_preview_img = $preview_img_path.$xml->project[$n1]->img;
			$project = str_replace ('<!--{PROJECT_PREVIEW_IMG}-->', $project_preview_img, $project);
		  }
		$project_list .= $project; 
	  }
	$page = str_replace($project_tpl, $project_list, $page);

	$today = date("H:i:s, d.m.Y");
	$page = str_replace ('<!--{LAST MODIFIED}-->', $today, $page);

	return $page;
} //-------------------------- end func


?>

