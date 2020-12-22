<?php
/**
 * @package test_plugin
 * @version 1.0
 */
/*
Plugin Name: Test Plugin
Description: test send mail
*/


register_activation_hook( __FILE__, 'wfm_activate');
//register_deactivation_hook( __FILE__, 'wfm_deactivate');
//register_uninstall_hook( __FILE__, 'wfm_unistall');


//==========================================

function wfm_activate(){
	$d = date("Y-m-d H:i:s");
	error_log( 
		$d." - used hook 'register_activation_hook', function wfm_activate()\n", 
		3,
		dirname(__FILE__)."/log.log"
	);
	
	//wp_mail( get_bloginfo('admin_email'),  'test wp plugin', 'Test plugin has been activated...');
	wp_mail( "test098276@hotmail.com",  'test wp plugin', 'Test plugin has been activated...');
	wp_mail( "prog2@8-point.ru",  'test wp plugin', 'Test plugin has been activated...');
}//end
?>
