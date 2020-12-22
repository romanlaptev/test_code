<?php
/*
Plugin Name: Test Option
Description: add simply site option
*/

//http://vbox1/sd2/sites/cms/wordpress/webpad/wp-admin/options.php
//https://wp-kama.ru/function/add_option
add_option("_test_option", "test1");
//update_option()
//get_option()
//delete_option()

//https://wp-kama.ru/function/register_setting
//register_setting()

//https://wp-kama.ru/function/add_settings_field
//add_settings_field()

//https://wp-kama.ru/function/add_settings_section
//add_settings_section()

//register_activation_hook( __FILE__, '_activate');
add_action("admin_init", "_first_option");
//==============================

function _first_option(){
	
	$option_group = "general";
	$option_name = "first_option";
	register_setting (
		$option_group,
		$option_name//,
		//$sanitize_callback
	);
	
	$id = "first-option";
	$title = "First option";
	$callback = "_create_html_field"; 
	$page = $option_group;
	$section = "default";
	$args = array(
		'id' => $id, 
		'name' => $option_name
	);
	add_settings_field(
		$id,
		$title,
		$callback,
		$page,
		$section,
		$args
	);
	
}//end

function _create_html_field($args){
	$value = esc_attr( get_option( $args['name'] ) );
	
	$html = "
<input type='text' 
id='".$args['id']."' 
name='".$args['name']."' 
class='regular-text'
value='".$value."' />";

	echo $html;
}//end

?>
