<?php
/**
 * The main template file
 */
 
get_header();
//get_header("custom");// no wp_head();
?>

	<div class="main container">

		<div class="sidebar sidebar-left">
		  <div class="wrapper">
				<div class="panel product-categories">
<?php
//wp_list_categories();

////woocommerce_product_subcategories();
//woocommerce_product_loop_start();

//https://wp-kama.ru/hook/woocommerce_before_output_product_categories
woocommerce_output_product_categories();
?>
				</div>
		  </div>
		</div><!-- end sidebar -->

		<div class="content">
		  <div class="wrapper">
				<div class="panel">
<?php
//wp_page_menu();
//wp_list_pages();
?>
		<?php
		if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
//echo "<pre>";
//print_r($post);
//echo "</pre>";
				get_template_part( 'template-parts/content/content' );
			}

			// Previous/next page navigation.
			//twentynineteen_the_posts_navigation();

		} else {

			// If no content, include the "No posts found" template.
			//get_template_part( 'template-parts/content/content', 'none' );

		}
		?>

				</div>
			</div>
		</div><!-- end content -->

	</div><!-- end main -->


<?php
get_footer();
