<?php
/*
Plugin Name: Test Widget
Description: simply widget
*/
//register_activation_hook( __FILE__, '_activate');
add_action( "widgets_init", "_init_widget");
//==============================

//function _activate(){
//echo "Test";	
//exit();
//}//end

function _init_widget(){
	//https://wp-kama.ru/function/register_widget
	register_widget( "firstWidget" );
}//end

class firstWidget extends WP_Widget{
	
	function __construct(){
		parent::__construct(
			"first_widget", //widget ID
			"First widget", //__("First widget", "text_domain"),
			array(
				//"description" => __("a first test widget", "text_domain" )
				"description" => "a test first widget",
				"classname" => "class-first-widget"
			)
		);
	}//end
	
	public function widget( $args, $instance) {
//$arg_list = func_get_args();
//echo "argument list:<pre>";	
//print_r($arg_list);
//echo "</pre>";	
		//apply standart filters
		$title = apply_filters( "widget_title", $instance["title"] );
		$text = apply_filters( "widget_text", $instance["text"] );
		
		echo $args["before_widget"];
		
		if( !empty($title) ){
			echo $args["before_title"] .$title. $args["after_title"];
		}
		//echo __("Hello World!", "text_domain");
		echo $text;
		
		echo $args["after_widget"];
	}//end

	public function form( $instance) {
		
		$title = __("New Title", "text_domain");
		$text = "";
		//extract($instance);
		if( isset($instance["title"]) ){
			$title = $instance["title"];
		}
		
		if( isset($instance["text"]) ){
			$text = $instance["text"];
		}
		
		$html = "<p>
<label for='".$this->get_field_id("title")."'>Title:</label>
<input class='widefat' id='".$this->get_field_id("title")."' 
name='".$this->get_field_name("title")."' 
type='text' 
value='".$title."'>
</p>";
		echo $html;
		
		$html = "<p>
<label for='".$this->get_field_id("text")."'>Text:</label>
<textarea class='widefat' id='".$this->get_field_id("text")."' 
name='".$this->get_field_name("text")."' 
cols='20' rows='10'>".esc_attr($text)."</textarea>
</p>";
		echo $html;
		
	}//end
	

	public function update( $new_instance, $old_instance) {
		$instance = array();
		
		$instance["title"] = "";
		if( !empty( $new_instance["title"]) ){
			$instance["title"] = strip_tags( $new_instance["title"] );
		}
		
		$instance["text"] = "";
		if( !empty( $new_instance["text"]) ){
			$instance["text"] = "function update...-0-".$new_instance["text"] ;
		}
		
		return $instance;
	}//end

	
}//end class
?>
