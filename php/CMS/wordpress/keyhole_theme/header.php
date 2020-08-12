<?php
/**
  * @package WordPress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
<!--
	<title>test theme1</title>
-->
	<?php wp_head(); ?>
</head>

<body <?php body_class();?>>

	<div class="header container">
		<div class="wrapper">

	<div class="w50 float-left">
		<div class="padding20">
				<h1><?php bloginfo( 'name' ); ?></h1>
		</div>
	</div>

	<div class="w50 float-left text-right">
		<div class="padding-small">
	<?php
		wp_nav_menu( array( 
	// 		'theme_location' => 'top_menu',
			'menu' => 'top-menu',
			//'container_class'     => 'menu-{menu slug}-container',
			'container_class' => 'header-menu',
			'items_wrap' => '<ul id="%1$s" class="list-inline %2$s">%3$s</ul>'
		));
	?>
		</div>
		
		<div class="padding-small">
	<?php
		wp_nav_menu( array( 
			'menu' => 'user-menu',
			'container_class' => 'header-menu',
			'items_wrap' => '<ul id="%1$s" class="list-inline %2$s">%3$s</ul>'
		));
	?>
		</div>
		<div class="padding-small">
	<?php
echo get_search_form();
	?>
		</div>
	</div>
	
<div class="row"></div>

		</div>

		
		
	</div><!-- end header -->
