	<div class="footer container row">
		<div class="wrapper">

			<div class="row">
				
				<div class="float-left w30">
					<div class="panel">
		<?php 
			wp_nav_menu( array( 
				'menu' => 'top-menu'
			));
		?>
					</div>
				</div>
				
				<div class="float-left w30">
					<div class="panel">
	<?php 
		wp_nav_menu( array( 
			//'theme_location' => 'bottom_menu',
			//'items_wrap'     => '<ul>Menu 2: %3$s</ul>',
			'menu' => 'user-menu',
			//'menu_id'     => 'bottom-menu',
			//'menu_class'     => 'menu-bottom',
			//'container'     => 'div',
			//'container_class'     => 'menu-{menu slug}-container',
			//'container_id'     => 'block-bottom-menu',
			//'before'     => '***',
			//'after'     => '***',
			//'link_before'     => '---',
			//'link_after'     => '---'
		));
	?>
					</div>
				</div>

			</div>
		
		</div>
	</div><!-- end footer -->
	
<?php 
	wp_footer(); 
?>
</body>
</html>
