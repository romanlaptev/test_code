<?php
get_header();

//https://wp-kama.ru/function/the_widget
the_widget( 'WP_Widget_Text', 'title=text2 &text=<b>Text 2</b>' );

	$type = "page"; //"post"
	$count_posts = wp_count_posts( $type );
//echo "<pre>";
//print_r($count_posts);
//echo "</pre>";

	if( $type == "page"){
			//get_pages();
		wp_list_pages();
	}

	if( $type == "post"){
		if ( have_posts() ) {
		/*
				$num = 0;
				while ( have_posts() ) {
					$num++;
					if ( $num > 1 ) {
						echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
					}
					the_post();
					//get_template_part( 'template-parts/content', get_post_type() );
					the_title();
					the_content();
				}//next
		*/
			for( $n = 0; $n < $count_posts->publish; $n++){
					if ( $n > 1 ) {
						echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
					}

						the_post();
						the_title();
						the_content();
			}//next
		}
	}

//https://wp-kama.ru/function/the_widget
the_widget( 'WP_Widget_Pages');//, $instance, $args );
//the_widget( 'WP_Widget_Calendar' );

//the_widget( 'WP_Nav_Menu_Widget', $instance, $args );
the_widget( 'WP_Nav_Menu_Widget', array('nav_menu' => 'menu1') );
//the_widget('WP_Widget_Tag_Cloud');

get_footer();
?>
