<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

//php -S localhost:8000
	require_once( __DIR__.'/../utils.php' );

//https://xdan.ru/uchimsya-parsit-saity-s-bibliotekoi-php-simple-html-dom-parser.html
//Учимся парсить сайты с библиотекой PHP Simple HTML DOM Parser

//https://simplehtmldom.sourceforge.io/manual.htm#section_quickstart
//PHP Simple HTML DOM Parser Manual
PageHead();

echo _logWrap( "<h2>PHP version: ".phpversion()."</h2>", "info");
echo _logWrap(__DIR__, "info");

$loadedExt = get_loaded_extensions();
echo _logWrap( "loaded extensions: ");
echo _logWrap( $loadedExt);

	require_once( __DIR__.'/simple_html_dom.php' );
	
	$dom = str_get_html('<html><body><div class="con-tent">Hello!</div></body></html>');
//$test = $dom->find(".con-tent");

	//$out = print_r($test, true);
	//echo _logWrap($out);
	
PageEnd();
?>
