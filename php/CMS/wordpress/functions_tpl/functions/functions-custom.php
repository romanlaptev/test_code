<?php
//	Файл с частными настройками functions.php
//	Версия 1.0.0 от 31.10.2018

//	Обрезка фото по своим размерам
//	============================================================
if ( function_exists( 'add_image_size' ) ) {
	//add_image_size( 'post-image', 720, 480, true); //изображения для страниц
	add_image_size( 'review', 289, 408, true); //отзывы 
	add_image_size( 'full', 1200, 9999 ); //большое изображение для статей
}


//	Добавление фото своего размера в админку
//	============================================================
/*function my_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'post-image' => 'Страница',
	) );
}
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
*/


//	Регистрация областей меню
//	============================================================
add_action('after_setup_theme', function(){
	register_nav_menus( array(
		'main_menu' => 'Основное меню',
		'footer_menu-1' => 'Меню в подвале-1',
		'footer_menu-2' => 'Меню в подвале-2',
		'footer_menu-3' => 'Меню в подвале-3',
		'footer_menu-4' => 'Меню в подвале-4',
		'sidebar' => 'Сайдбар слева',
	) );
});


//	Удаление пунктов меню в админке
//	============================================================
function remove_menus() {
    remove_menu_page( 'edit-comments.php'); // Удаляем пункт "Комментарии"
	//remove_menu_page( 'index.php' );                  // Консоль
	remove_menu_page( 'upload.php' );                 // Медиафайлы 
	//remove_menu_page( 'tools.php' );                 // Инструменты 
	//remove_menu_page( 'edit.php' );                 // Записи 
	//remove_submenu_page( 'edit.php','edit-tags.php?taxonomy=post_tag' );
	//remove_menu_page( 'themes.php' );                 // Внешний вид 
	remove_submenu_page('themes.php','customize.php' );                 // Настройки темы 
	remove_submenu_page('themes.php','theme-editor.php' );              // редактор 
	remove_submenu_page('themes.php','page=custom-background');
}
add_action( 'admin_menu', 'remove_menus' );



//	Cтраница настроек с произвольными полями
//	============================================================
if( function_exists('acf_add_options_page') ) {
	//acf_add_options_page('Опции');
	
	acf_add_options_page(array(
		'page_title' => 	'Скрипты',
		'menu_title' => 	'Скрипты',
		//'menu_slug' => 	'thanks',
		'menu_slug' => 		'option',
		'icon_url' => 		'dashicons-admin-generic',
		'position' => 		27,
		//'parent_slug'     => 'options-general.php',
		'redirect' 	=> 		false
	));
	
	acf_add_options_page(array( 
		'page_title' => 	'Контакты',
		'icon_url' => 		'dashicons-location',
		'position' => 		26,
		'redirect' 	=> 		false
	));
	
	/*acf_add_options_page(array( 
		'page_title' => 	'Преимущества',
		'icon_url' => 		'dashicons-heart',
		'position' => 		24,
		'redirect' 	=> 		false
	));
	
	acf_add_options_page(array( 
		'page_title' => 	'Клиенты',
		'icon_url' => 		'dashicons-archive',
		'position' => 		23,
		'redirect' 	=> 		false
	));
	
	acf_add_options_page(array( 
		'page_title' => 	'Отзывы',
		'icon_url' => 		'dashicons-format-quote',
		'position' => 		22,
		'redirect' 	=> 		false
	));
	
	acf_add_options_page(array( 
		'page_title' => 	'Способы оплаты',
		'icon_url' => 		'dashicons-cart',
		'position' => 		25,
		'redirect' 	=> 		false
	));
	
	acf_add_options_page(array( 
		'page_title' => 	'Способы заказа',
		'icon_url' => 		'dashicons-info',
		'position' => 		24,
		'redirect' 	=> 		false
	));
	
	acf_add_options_page(array( 
		'page_title' => 	'Флаги стран',
		'parent_slug'     => 'edit.php?post_type=lang',
		'redirect' 	=> 		false
	));
	
	acf_add_options_page(array( 
		'page_title' => 	'Прайс',
		'parent_slug'     => 'edit.php?post_type=lang',
		'redirect' 	=> 		false
	));*/
	
	/*
 	// add parent
	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title' 	=> 'Theme Settings',
		'redirect' 		=> false
	));
	
	
	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Social Settings',
		'menu_title' 	=> 'Social',
		'parent_slug' 	=> $parent['menu_slug'],
	));*/
}/*
if ( function_exists( 'acf_add_options_sub_page' ) ){
	acf_add_options_sub_page(array(
		'title'      => 'Event Settings',
		'parent'     => 'edit.php?post_type=team',
		'capability' => 'manage_options'
	));
}*/

// Переименование пунктов меню
function change_post_menu_label() {
    global $menu, $submenu;
    $menu[5][0] = 'Услуги';
    $submenu['edit.php'][5][0] = 'Услуги';
    $submenu['edit.php'][10][0] = 'Добавить улугу';
    $submenu['edit.php'][15][0] = 'Категории';
    $submenu['edit.php'][16][0] = 'Метки';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );
function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Услуги';
    $labels->singular_name = 'Услуги';
    $labels->add_new = 'Добавить услугу';
    $labels->add_new_item = 'Добавить услугу';
    $labels->edit_item = 'Редактировать услугу';
    $labels->new_item = 'Добавить услугу';
    $labels->view_item = 'Посмотреть услугу';
    $labels->search_items = 'Найти услугу';
    $labels->not_found = 'Не найдено';
    $labels->not_found_in_trash = 'Корзина пуста';
}
add_action( 'init', 'change_post_object_label' );
//	Произвольный тип записи
//	============================================================


//	Команда
//	===============
add_action( 'init', 'post_type_team' );
 
function post_type_team() {
	$labels = array(
		'name' => 'Команда',
		'singular_name' => 'Команда',
		'menu_name' => 'Команда',
		'all_items' => 'Команда',
		'add_new' => 'Добавить сотрудника',
		'add_new_item' => 'Добавить нового сотрудника',
		'edit_item' => 'Редактировать сотрудника',
		'new_item' => 'Новый сотрудник',
		'view_item' => 'Посмотреть на сайте',
		'search_items' => 'Искать',
		'not_found' =>  'Не найдено',
		'not_found_in_trash' => 'Корзина пуста',
	);
	$args = array(
		'rewrite' => array('slug' => 'team'),
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-groups', // иконка в меню
		'menu_position' => 23, // порядок в меню
		'supports' => array( 'title', 'editor')
	);
	register_post_type('team', $args);
}


//	Вакансии
//	===============
/*add_action( 'init', 'post_type_vacancy' );
function post_type_vacancy() {
	$labels = array(
		'name' => 'Вакансии',
		'singular_name' => 'Вакансии',
		'menu_name' => 'Вакансии',
		'all_items' => 'Вакансии',
		'add_new' => 'Добавить вакансию',
		'add_new_item' => 'Добавить новую вакансию',
		'edit_item' => 'Редактировать вакансию',
		'new_item' => 'Новая вакансия',
		'view_item' => 'Посмотреть на сайте',
		'search_items' => 'Искать',
		'not_found' =>  'Не найдено',
		'not_found_in_trash' => 'Корзина пуста',
	);
	$args = array(
		'rewrite' => array('slug' => 'vacancy'),
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-welcome-widgets-menus', // иконка в меню
		'menu_position' => 24, // порядок в меню
		'supports' => array( 'title', 'editor')
	);
	register_post_type('vacancy', $args);
}*/

//	Услуги
//	===============
/*add_action( 'init', 'post_type_services' );
function post_type_services() {
	$labels = array(
		'name' => 'Услуги',
		'singular_name' => 'Услуги',
		'menu_name' => 'Услуги',
		'all_items' => 'Услуги',
		'add_new' => 'Добавить усулгу',
		'add_new_item' => 'Добавить новую усулгу',
		'edit_item' => 'Редактировать усулгу',
		'new_item' => 'Новая усулга',
		'view_item' => 'Посмотреть на сайте',
		'search_items' => 'Искать',
		'not_found' =>  'Не найдено',
		'not_found_in_trash' => 'Корзина пуста',
	);
	$args = array(
		'rewrite' => array('slug' => 'services'),
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-clipboard', // иконка в меню
		'menu_position' => 25, // порядок в меню
		'supports' => array( 'title', 'editor')
	);
	register_post_type('services', $args);
}*/

//	Работы
//	===============
add_action( 'init', 'post_type_docs' );
 
function post_type_docs() {
	$labels = array(
		'name' => 'Результаты работы',
		'singular_name' => 'Результат',
		'menu_name' => 'Результат',
		'all_items' => 'Результаты',
		'add_new' => 'Добавить проект',
		'add_new_item' => 'Добавить новый проект',
		'edit_item' => 'Редактировать проект',
		'new_item' => 'Новый проект',
		'view_item' => 'Посмотреть на сайте',
		'search_items' => 'Искать',
		'not_found' =>  'Не найдено',
		'not_found_in_trash' => 'Корзина пуста',
	);
	$args = array(
		'rewrite' => array('slug' => 'docs'),
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-edit', // иконка в меню
		'menu_position' => 22, // порядок в меню
		'supports' => array( 'title', 'editor')
	);
	register_post_type('docs', $args);
}

/*
//	Цены
//	===============
add_action( 'init', 'post_type_prices' );
 
function post_type_prices() {
	$labels = array(
		'name' => 'Цены',
		'singular_name' => 'Цены',
		'menu_name' => 'Цены',
		'all_items' => 'Цены',
		'add_new' => 'Добавить расценки',
		'add_new_item' => 'Добавить новую услугу',
		'edit_item' => 'Редактировать услугу',
		'new_item' => 'Новая услуга',
		'view_item' => 'Посмотреть на сайте',
		'search_items' => 'Искать',
		'not_found' =>  'Не найдено',
		'not_found_in_trash' => 'Корзина пуста',
	);
	$args = array(
		'rewrite' => array('slug' => 'prices'),
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true, 
		'menu_icon' => 'dashicons-media-spreadsheet', // иконка в меню
		'menu_position' => 22, // порядок в меню
		'supports' => array( 'title', 'editor','page-attributes'),
		'show_in_rest' => true,
		'hierarchical' => true,
	);
	register_post_type('prices', $args);
}*/


