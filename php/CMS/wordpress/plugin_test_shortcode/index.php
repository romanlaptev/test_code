<?php
/*
Plugin Name: Test Shortcode
Description: simply shortcode

[calculator]
[testcode user="rOman" login="admin"]
<h1>...some content...</h1>
[/testcode]
*/

//register_activation_hook( __FILE__, '_activate');
add_shortcode( "testcode", "_insert_testcode");
add_shortcode( "calculator", "_insert_calculator");
//==============================

//function _activate(){
//echo "Test";	
//exit();
//}//end

function _insert_testcode( $arg, $content ){
	$html = "<p>Hello,".$arg['login']." - ".$arg['user']."</p>";
	$html .= htmlspecialchars($content);
	return $html;
}//end

function _insert_calculator(){
	return "<h1>Calculator...</h1>";
}//end
?>
