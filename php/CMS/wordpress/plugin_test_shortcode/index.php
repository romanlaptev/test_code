<?php
/*
Plugin Name: Test Shortcode
Description: simply shortcode
*/
//register_activation_hook( __FILE__, '_activate');
add_shortcode( "calculator", "_insert_calculator");
//==============================

//function _activate(){
//echo "Test";	
//exit();
//}//end

function _insert_calculator(){
	return "<h1>Calculator...</h1>";
}//end
?>
