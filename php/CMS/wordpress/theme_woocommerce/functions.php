<?php
//add_filter( 'init', 'wp_init' );

//add_action( 'init', 'register_post_types' );
add_action( 'init', 'keyhole_reg_banner_type' );

add_action( 'after_setup_theme', 'keyhole_after_setup' );
//add_action( 'wp_footer', 'keyhole_footer' );

//https://wp-kama.ru/function/get_search_form
add_filter( 'get_search_form', 'keyhole_search_form' );

$hookName = "wp_enqueue_scripts";
$actionName = "keyhole_reg_scripts";
add_action( $hookName, $actionName );

//https://wp-kama.ru/functions/functions-db
//https://wp-kama.ru/hooks/woocommerce-hooks-db
//https://wp-kama.ru/hook/woocommerce_before_output_product_categories
//https://wp-kama.ru/hook/woocommerce_after_output_product_categories
add_filter( 'woocommerce_before_output_product_categories', 'keyhole__before_output_product_categories' );
add_filter( 'woocommerce_after_output_product_categories', 'keyhole__after_output_product_categories' );


//=================================
function wp_init(){
	//echo "WP, plugins, theme loaded...";
	//echo "INIT functions, wp-content/themes/theme1/functions.php";
	//echo "<br>";
}//end

if ( ! function_exists( 'keyhole_after_setup' ) ) {
	function keyhole_after_setup(){

		//add_theme_support("menus");
		register_nav_menus( [
			'top_menu' => 'header menu',
			'bottom_menu' => 'footer menu'
		] );	

		//https://wp-kama.ru/function/add_theme_support#post-formats
		//https://misha.blog/wordpress/post-formats.html
		add_theme_support( 'post-formats', array( 'link', 'image' ) );	
	}//end
}



//function keyhole_footer(){
//}//end

function keyhole_reg_scripts(){

	$styleName = "base-style";
	$styleLocation = get_stylesheet_uri();//style.css
	wp_enqueue_style( $styleName, $styleLocation);

	//$handle = "script1";
	//$src = get_template_directory_uri() . "/js/script1.js";
	//wp_enqueue_script( $handle, $src);

}//end

//https://wp-kama.ru/function/get_search_form
function keyhole_search_form( $form ){
echo "keyhole_search_form()";
echo "<br>";
	return $form;
}//end


//https://wp-kama.ru/hook/woocommerce_before_output_product_categories
function keyhole__before_output_product_categories( $string ){
echo "keyhole__before_output_product_categories()";
echo "<br>";
	return $string;
}

//https://wp-kama.ru/hook/woocommerce_after_output_product_categories
function keyhole__after_output_product_categories( $string ){
echo "keyhole__after_output_product_categories()";
echo "<br>";
	return $string;
}

//https://wp-kama.ru/function/register_post_type
function register_post_types(){
	register_post_type( 'banner', [
		'label'  => "Banner",
//		'labels' => [
//			'name'               => '____', // основное название для типа записи
//			'singular_name'      => '____', // название для одной записи этого типа
//			'add_new'            => 'Добавить ____', // для добавления новой записи
//			'add_new_item'       => 'Добавление ____', // заголовка у вновь создаваемой записи в админ-панели.
//			'edit_item'          => 'Редактирование ____', // для редактирования типа записи
//			'new_item'           => 'Новое ____', // текст новой записи
//			'view_item'          => 'Смотреть ____', // для просмотра записи этого типа.
//			'search_items'       => 'Искать ____', // для поиска по этим типам записи
//			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
//			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
//			'parent_item_colon'  => '', // для родителей (у древовидных типов)
//			'menu_name'          => '____', // название меню
//		],
//		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		//'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		//'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		//'rest_base'           => null, // $post_type. C WP 4.7
		//'menu_position'       => null,
		//'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		//'hierarchical'        => false,
		//'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		//'taxonomies'          => [],
		//'has_archive'         => false,
		//'rewrite'             => true,
		//'query_var'           => true,
	] );
}//end

//https://hostenko.com/wpcafe/tutorials/dobavlyaem-banneryi-na-sayte-s-pomoshhyu-proizvolnyih-tipov-zapisey-wordpress/
// register a custom post type called 'banner'
function keyhole_reg_banner_type() {
    $labels = array(
        'name' => __( 'Banners' ),
        'singular_name' => __( 'banner' ),
        'add_new' => __( 'New banner' ),
        'add_new_item' => __( 'Add New banner' ),
        'edit_item' => __( 'Edit banner' ),
        'new_item' => __( 'New banner' ),
        'view_item' => __( 'View banner' ),
        'search_items' => __( 'Search banners' ),
        'not_found' =>  __( 'No banners Found' ),
        'not_found_in_trash' => __( 'No banners found in Trash' ),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'page-attributes'
        ),
        'taxonomies' => array( 'post_tag', 'category'),
    );
    register_post_type( 'banner', $args );
}//end

// function to show home page banner using query of banner post type
function keyhole_show_page_banner() {
  
    // start by setting up the query
    $query = new WP_Query( array(
        'post_type' => 'banner',
    ));
  
    // now check if the query has posts and if so, output their content in a banner-box div
    if ( $query->have_posts() ) { ?>
        <div class="banner-box">
<?php 
		 while ( $query->have_posts() ) : $query->the_post(); 
?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( 'banner' ); ?>><?php the_content(); ?></div>
            <?php endwhile; ?>
        </div>
    <?php 
}
    wp_reset_postdata();

}//end