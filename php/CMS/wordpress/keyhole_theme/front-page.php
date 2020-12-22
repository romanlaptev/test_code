<?php
	get_header();
?>
	<div class="main container">

		<div class="content">
		  <div class="wrapper">
				<div class="panel">
<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
//echo "<pre>";
//print_r($post);
//echo "</pre>";
				get_template_part( 'template-parts/content/content' );
				//get_template_part( 'template-parts/page/content', 'front-page' );
			}//next
		} else {
			get_template_part( 'template-parts/content/content', 'none' );
		}
?>

				</div>
			</div>
		</div><!-- end content -->
	

		<div class="sidebar sidebar-right">
		  <div class="wrapper">
			<div class="panel">
				<h3>banners</h3>
<?php				
keyhole_show_page_banner();
?>				
			</div>
		  </div>
		</div>

		<!-- end sidebar -->

	</div><!-- end main -->


<?php
get_footer();