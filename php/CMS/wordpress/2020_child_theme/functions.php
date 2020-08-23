<?php
//add_action( 'init', '_reg_banner_type' );
add_action( 'wp_enqueue_scripts', '_register_css_js' );
//add_filter( 'get_search_form', 'keyhole_search_form' );
//add_action( 'after_setup_theme', 'keyhole_after_setup' );
//add_action( 'wp_footer', 'keyhole_footer' );


add_action("init", function () {

});

//add_filter( 'woocommerce_before_output_product_categories', '_before_output_product_categories' );
//add_filter( 'woocommerce_after_output_product_categories', '_after_output_product_categories' );

//add_action( 'woocommerce_before_subcategory', 'change_product_category_view' );
//add_action( 'woocommerce_before_subcategory_title', 'test' );

//add_filter( 'woocommerce_shop_loop_subcategory_title', 'test' );
//wc-template-hooks.php, 
//add_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
// /wp-content/plugins/woocommerce/includes/wc-template-functions.php:		<h2 class="woocommerce-loop-category__title">

//'woocommerce_after_subcategory_title'
//'woocommerce_after_subcategory'

//add_action( 'wp_ajax_product_quickview', '_product_quickview' );
//add_action( 'wp_ajax_nopriv_product_quickview', '_product_quickview' );

//add_filter( 'woocommerce_product_categories_widget_args', '_product_categories_widget_args' );

//https://wp-kama.ru/hook/the_title
add_filter( 'the_title', '_filter_title' );

//https://wp-kama.ru/hook/the_content
add_filter( 'the_content', '_filter_content' );

//=========================================
function _register_css_js() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'parent-style' ),
        wp_get_theme()->get('Version')
    );

	$handle = "script";
	$src = get_stylesheet_directory_uri() . "/js/script.js";
	wp_enqueue_script( $handle, $src);
}//end


// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:
/*
if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_add_parent_dep' ) ):
function chld_thm_cfg_add_parent_dep() {
    global $wp_styles;
    array_unshift( $wp_styles->registered[ 'child-style' ]->deps, 'base-style' );
}
endif;
add_action( 'wp_head', 'chld_thm_cfg_add_parent_dep', 2 );
*/
// END ENQUEUE PARENT ACTION


function _filter_title( $title ) {
	return "<div>".htmlspecialchars( "---".$title."---" )."</div>";
	//return $title;
}//end

function _filter_content( $content ) {
	return "<dv>".htmlspecialchars( $content )."</div>";
	//return $content;
}//end

//add_filter( 'woocommerce_product_categories_widget_main_term', 'filter_function_name_8891', 10, 2 );
//function _product_categories_widget_main_term( $terms[0], $terms ){
	// filter...
	//return $terms[0];
//}

//add_filter( 'woocommerce_product_categories', '_product_categories' );
//function _product_categories( $terms ){
//echo "terms:<pre>";	
//print_r($terms);
//echo "</pre>";
	//return $terms;
//}

//add_filter( 'woocommerce_product_categories_widget_product_terms_args', 'filter_function_name_741' );
//function filter_function_name_741( $array ){
//echo "array:<pre>";	
//print_r($array);
//echo "</pre>";
	//return $array;
//}

