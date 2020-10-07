<?php
//https://wp-kama.ru/id_2018/ajax-v-wordpress.html
add_action('wp_ajax__update_mini_cart', '_update_mini_cart__callback');
add_action('wp_ajax_nopriv__update_mini_cart', '_update_mini_cart__callback');
add_action('wp_enqueue_scripts', '_ajax_data', 99 );

//https://pluginrepublic.com/updating-the-woocommerce-mini-cart-via-ajax/
//add_filter( 'wp_ajax_nopriv_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );
//add_filter( 'wp_ajax_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );

//=================================
function _reg_scripts(){

	$styleName = "base-style";
	$styleLocation = get_stylesheet_uri();//style.css
	wp_enqueue_style( $styleName, $styleLocation);

	$handle = "theme-script";
	$src = get_template_directory_uri() . "/js/script.js";
	wp_enqueue_script( $handle, $src);

}//end


//------------- update mini-cart
//https://wp-kama.ru/id_2018/ajax-v-wordpress.html
//https://wp-kama.ru/id_2018/ajax-v-wordpress.html
//https://pluginrepublic.com/updating-the-woocommerce-mini-cart-via-ajax/
function _update_mini_cart__callback(){
	//echo wc_get_template( 'cart/mini-cart.php' );
	//echo WC()->cart->get_cart_contents_count();	
	global $woocommerce;
	//print_r($woocommerce->cart);
	//echo $woocommerce->cart->get_cart_total();
	echo $woocommerce->cart->get_cart_contents_count();
	die();	
}//end

function _ajax_data(){
	wp_localize_script( 'theme-script', '_ajax', 
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);  	
}//end

function _filter_add_to_cart_fragments( $array ){
	// filter...
	echo "<script>alert('Test')</script>";
	return $array;
}
