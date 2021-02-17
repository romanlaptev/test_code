<?php
//	Файл работы setcookie functions.php
//	Версия 1.0.0 от 30.10.2020
	
//	Сохраняем UTM метку utm_source в cookie
//	============================================================
	function wp8p_UTM_set_cookies() {

		// проверка, если cookie уже заданы
		if( !isset( $_COOKIE['wp8p_utm_source'] ) ) {
			// действия, если есть UTM-метка utm_source
			if ( !isset ($_GET['utm_source'])){
				// установка cookie значение СЕО
				setcookie( 'wp8p_utm_source', 'SEO', time()+31556926, '/', 'nsk-finexpert.ru' );		
			} else {	
				// установка cookie значение utm_source
				setcookie( 'wp8p_utm_source', $_GET['utm_source'], time()+31556926, '/', 'nsk-finexpert.ru' );	
			}
		}
	}
	add_action( 'init', 'wp8p_UTM_set_cookies' );
	
	function wp8p_UTM_set() {
		if ( isset ($_GET['utm_source']) ) {
			$utm8p = $_GET['utm_source'];
		} else {
			if ( isset ($_COOKIE['wp8p_utm_source'])){
				$utm8p = $_COOKIE['wp8p_utm_source'];
			} else {
				$utm8p = "SEO";							
			};
		}
		return $utm8p;
	}
					