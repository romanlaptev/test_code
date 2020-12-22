<?php
error_reporting(1);
/**
 * Define and require all the necessary 'bits and pieces'
 * and build all necessary Static Homepage and Featured area functions.
 * 
 * Note that many of the Home and Featured Widget Area functions have already
 * been created and are located in the /catalyst/lib/ez-structures/ directory.
 * In such cases this file only requires/calls these functions in.
 * No need to re-invent the wheel. :)
 *
 * @package Catalyst
 */

//ob_start('final_output');
 function final_output($content){
    return apply_filters('final_output', $content);
}


// This lets Catalyst know that a non-Dynamik Child Theme is active.
define( 'CHILD_ACTIVE', true );
// This lets Catalyst know that a HTML5 ready Child Theme is active.
define( 'CATALYST_HTML_FIVE', true );

// Call Catalyst's core functions. 
	//require_once( get_template_directory() . '/lib/catalyse.php' );

// Re-Declare the $catalyst_child_home global variable
// This variable is declared in /catalyst/lib/catlyse.php based on whether or not
// a Child Theme is active and a home.php file present in that Child Theme's root.
// By re-declaring this variable we can turn the Static Homepage On and Off.
	//global $catalyst_child_home;

// Manage the placement of open/close wrap tags.
	//remove_action( 'init', 'catalyst_open_close_wrap' );
	//add_action( 'init', 'catalyst_child_open_close_wrap' );
/**
 * Hook in the opening and closgin wrap tags.
 *
 * @since 1.0
 */
function catalyst_child_open_close_wrap()
{
	add_action( 'catalyst_hook_before_before_header', 'catalyst_open_site_wrap' );
	add_action( 'catalyst_hook_after_after_footer', 'catalyst_close_site_wrap' );
}

// Manage the placement of navbars.
	//remove_action( 'init', 'catalyst_hook_navbars' );
	//add_action( 'init', 'catalyst_child_hook_navbars' );
/**
 * Hook in Navbar 1 and Navbar 2.
 *
 * @since 1.0
 */
function catalyst_child_hook_navbars()
{
	add_action( 'catalyst_hook_before_html', 'catalyst_build_navbar1' ); /* new design2 */
	//add_action( 'catalyst_hook_before_content', 'catalyst_build_navbar1' ); /* new design */
	add_action( 'catalyst_hook_before_header', 'catalyst_build_navbar2' );
}


// Filter in specific body classes based on option values.
	//add_filter( 'body_class', 'catalyst_child_body_classes' );
/**
 * Determine which classes will be filtered into the body class.
 *
 * @since 1.0
 * @return array of all classes to be filtered into the body class.
 */
function catalyst_child_body_classes( $classes )
{
	if( is_front_page() )
	{
		
		
		
		
		
		
		
		
	}
	
	
	
	
	
	return $classes;
}

/* Put Any Custom PHP Functions For Your WordPress Site In This File */

require_once 'functions-homepage.php';
require_once 'functions-forms.php';
require_once 'functions-new-design.php';
require_once 'functions-mobile-design.php';


//load js lib only frontpage
add_action('wp_print_scripts', 'load_my_scripts4');
add_action('wp_print_styles', 'load_my_styles');

function load_my_styles(){

	
	if( !is_admin() ){

		//google fonts
		//wp_enqueue_style('fonts-google-Lobster', 'http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic');
		//wp_enqueue_style('fonts-google-Scada', 'http://fonts.googleapis.com/css?family=Scada&subset=latin,cyrillic');
		wp_enqueue_style('fonts-google-Oranienbaum', 'https://fonts.googleapis.com/css?family=Oranienbaum&subset=cyrillic');
		//wp_enqueue_style('fonts-google-Marmelad', 'http://fonts.googleapis.com/css?family=Marmelad&subset=cyrillic');
		//wp_enqueue_style('fonts-google-Ubuntu-Mono', 'http://fonts.googleapis.com/css?family=Ubuntu+Mono:400,400italic&subset=cyrillic');
		//wp_enqueue_style('fonts-google-Open-Sans-Condensed', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic&subset=cyrillic');
		wp_enqueue_style('fonts-google-Marck-Script', 'https://fonts.googleapis.com/css?family=Marck+Script&subset=cyrillic');
		//wp_enqueue_style('fonts-google-Comfortaa', 'http://fonts.googleapis.com/css?family=Comfortaa&subset=cyrillic');
		//Comfortaa, 'Marck Script', Lobster, 'Open Sans Condensed', 'Ubuntu Mono', 'Oranienbaum','Scada', 'Marmelad', sans-serif;
		
		//wp_enqueue_style('opentip', '/wp-content/uploads/jquery-plugins/opentip/opentip.css');
		wp_enqueue_style('tooltipster', '/wp-content/themes/theme_agropit/css/tooltipster.css');
		wp_enqueue_style('tooltipster-light', '/wp-content/themes/theme_agropit/css/tooltipster-light.css');
	}
	
	if ( is_front_page() ){


		//add print css
		//wp_enqueue_style( 'print', '/wp-content/uploads/print.css', array(), false, 'print' );

		//add nivo-slider css
		//wp_enqueue_style('nivo-slider', '/wp-content/uploads/nivo-slider/nivo-slider.css');
		//wp_enqueue_style('nivo-slider-landscape500', '/wp-content/uploads/nivo-slider/themes/landscape500/landscape500.css');
		//wp_enqueue_style('nivo-slider-portrait460', '/wp-content/uploads/nivo-slider/themes/portrait460/portrait460.css');

		//add slimbox2 css
			//wp_enqueue_style('slimbox2', '/wp-content/uploads/slimbox2/slimbox2.css');

		//add yandex map css
			
	}
}

function load_my_scripts4(){

	if ( !is_admin() ){
	
		wp_enqueue_script('jquery');
	
		wp_register_script('kiCookies', "/wp-content/themes/theme_agropit/scripts/ki.Cookies.js", false);
		wp_enqueue_script('kiCookies');
	
		wp_register_script('kiJSCart', "/wp-content/themes/theme_agropit/scripts/ki.JSCart.js", false);
		wp_enqueue_script('kiJSCart');
		
		//wp_register_script('opentip', '/wp-content/uploads/jquery-plugins/opentip/opentip-jquery-excanvas.min.js', false);
		//wp_enqueue_script('opentip');
		
		wp_register_script('tooltipster', '/wp-content/themes/theme_agropit/scripts/jquery.tooltipster.min.js', false);
		wp_enqueue_script('tooltipster');
		
		wp_register_script('theme_script', '/wp-content/themes/theme_agropit/scripts/theme_script.js', false);
		wp_enqueue_script('theme_script');
	}	

	if ( is_front_page() ){

		//add nivo-slider
		//wp_register_script('nivo-slider-pack', "/wp-content/uploads/nivo-slider/jquery.nivo.slider.pack.js", false);
		//wp_enqueue_script('nivo-slider-pack');

		//add slimbox2 for jquery
		wp_register_script('slimbox-jquery', get_template_directory_uri() ."/scripts/slimbox2/slimbox2.js", false);
		wp_enqueue_script('slimbox-jquery');

	}
	


	//load_yandex_map();
}
//=================================================================
//customise search

//via $search
add_filter( 'posts_search', 'my_super_search', 10, 2 );
function my_super_search( $search, &$wp_query ) {

	var_dump($search);
	return $search;
}

//via $where
add_filter('posts_where', 'agropit_where_postmeta');
function agropit_where_postmeta($where = '') {
	
	if( is_search() ){
		
		global $wpdb;
		
		$keyword = get_search_query();
		 
		$post_ids_meta = $wpdb->get_col( "SELECT DISTINCT post_id FROM {$wpdb->postmeta} WHERE $wpdb->postmeta.meta_value LIKE '%{$keyword}%'" );
		
		//$where = $where . " OR 29agropit_posts.ID = 34 OR 29agropit_posts.ID = 32 OR 29agropit_posts.ID = 30 OR 29agropit_posts.ID = 28 ";
		foreach( $post_ids_meta as $post_id_meta ){
			$where .= " OR {$wpdb->posts}.ID = " . $post_id_meta;
		}
		//var_dump($post_ids_meta);//debug
	}
		
	//var_dump($where);//debug
	return $where;
}

//=================================================================
//in category show only children post and children category
	add_action( 'catalyst_hook_before_loop','agropit_show_posts_in_cat' );
function agropit_show_posts_in_cat(){

	if ( !is_admin() && !is_singular() ){
		
		$thisCat = get_category( get_query_var( 'cat' ), false ); // get cat ID
		// if curr page is cat
		if( !is_wp_error( $thisCat ) ){
			
			//echo category title
			echo '<div id="content"><header class="entry-header"><h1 class="entry-title">'.$thisCat->name.'</h1></header></div>';
			
			//echo category description
			echo '<p class="description-cat">'.$thisCat->category_description.'</p>';
			
			//$agropit_cat = wp_list_categories( 'orderby=ID&style=list&child_of=' . $thisCat->term_id . '&show_count=1&hide_empty=1&show_option_none=&title_li=&use_desc_for_title=0&echo=0' );
			
			$args=array(
				'child_of' => $thisCat->term_id,
			  'orderby' => 'slug', //'count',
			  'order' => 'ASC' //'DESC'
			);
			$agropit_cat = '';
			
			$categories=get_categories($args);
			
			foreach($categories as $category) {
				$agropit_cat .= '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name . '</a> <span class="amount-item">Документов ' . $category->count . '</span></li>' . "\n";
			}
			
			
			if( $agropit_cat ){
				echo '<ul class="list-cat">' . $agropit_cat . '</ul>';
			}
			
			//var_dump( array ( 'paged=', get_query_var( 'paged' ) ) ); // debug
			
			//global $wp_query; var_dump( $wp_query->query ); // debug
			query_posts(
				//array_merge(
					//array( 'category__in' => (int) $thisCat->term_id , 'paged' => get_query_var( 'paged' ) )
					array( 'category__in' => (int) $thisCat->term_id , 'paged' => get_query_var( 'paged' ), 'meta_query' => array( array( 'key' => 'agropit_only_kupitu', 'value' => 'on', 'compare' => 'NOT EXISTS' ) ) )
					//$wp_query->query
				//)
			);
				
			//print_r( $thisCat ); // debug
				
		}

	}

}

//if no post in catalyst theme, print ''
	add_filter( 'catalyst_nopost_content', 'agropit_nopost_content' );
function agropit_nopost_content(){
	return '';
}

//show tags after post title
	add_filter( 'catalyst_byline_meta', 'agropit_show_tags' );
function agropit_show_tags( $byline_meta ){
	
	global $post;
	$cur_terms = get_the_terms( $post->ID, 'post_tag' );
	
	if( !is_wp_error( $cur_terms ) && $cur_terms ){

		$arr_tags = array();
		foreach( $cur_terms as $cur_term ){
			array_push( $arr_tags, $cur_term->name );
		}
		$str_tags = implode( ', ', $arr_tags ) . '<br />';
	}
	else{ $str_tags = ''; }
			
	return $str_tags . $byline_meta;
}


//rewrite title post in catalyst theme
//if home page then hide post title
	remove_action( 'catalyst_hook_post_title', 'catalyst_post_title' );
	add_action( 'catalyst_hook_post_title', 'agropit_post_title_action' );
function agropit_post_title_action()
{
	$num_tu = get_post_meta( get_the_ID(), 'agropit_ntu_post', 1 );
	
        //var_dump( strpos( $num_tu, 'СТО' ) === false ); var_dump( strpos( $num_tu, 'ТТК' ) === false );
        
        if( strpos( $num_tu, 'СТО' ) !== false || strpos( $num_tu, 'ТТК' ) !== false ) {
            $str_num_tu = $num_tu;	
        }elseif( $num_tu != "" ) {
            $str_num_tu = 'ТУ ' . $num_tu;	
        }else{
            $str_num_tu = $num_tu;
           }
	
	if( is_front_page() ){
		$post_title = '';
	}
	elseif( is_singular() )
	{
		//$post_title = '<h1 class="entry-title">' . $str_num_tu . ' «' . get_the_title() . '»</h1>' . "\n";
		$post_title = '<h1 class="entry-title">' . $str_num_tu . ' ' . get_the_title() . '</h1>' . "\n";
	}
	elseif( is_category( 'reviews' ) )
	{
		$post_title = '<h2 class="entry-title">' . get_the_title() . '</h2>' . "\n";
	}
	else
	{
		//$post_title = '<h2 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark">' . $str_num_tu. ' «' . get_the_title() . '»</a></h2>' . "\n";
		$post_title = '<h2 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark">' . $str_num_tu. ' ' . get_the_title() . '</a></h2>' . "\n";
	}

	echo $post_title;//my
	//echo apply_filters( 'catalyst_post_title', $post_title );// as catalyst
}

//rewrite title post in admin
//if home page then hide post title
	add_filter( 'the_title', 'agropit_admin_post_title' );
function agropit_admin_post_title( $title ){

	//$title = str_replace ( '<h2 class="entry-title">', '<strong>' . $str_num_tu . ' ', $title );
	//$title = str_replace ( '</h2>', '</strong>', $title );

	if( is_admin() ){
		
		if ( get_post_meta( get_the_ID(), 'agropit_ntu_post', 1 ) != "" ) {
			
			$str_num_tu = 'ТУ ' . get_post_meta( get_the_ID(), 'agropit_ntu_post', 1 ) . ' ';
			
		}else{
			$str_num_tu = '';
		}
		//$title = str_replace ( '<h1 class="entry-title">', '<h1 class="entry-title"><span style="background-color:#fff;">' . $str_num_tu . '</span>' . ' ', $title );
		$title = $str_num_tu . $title;
	}

	return $title;
}

//=====================================================================================
//print titles of last news on home page
add_action( 'catalyst_hook_after_post_content','agropit_show_news_blog' );
function agropit_show_news_blog(){

	if ( is_front_page() ){
				
		//echo last news post
		$args = array( 
		   'numberposts' => (int) get_option( 'posts_per_page', 10 ) 
		  ,'category' => 5 
		  ,'post_status' => 'publish' 
		);
 
		$result = wp_get_recent_posts($args); 

		?><div id="content"><header class="entry-header"><h1 class="entry-title">Новости</h1></header></div><?php 
					
		foreach( $result as $p ){ 
?> 
<?php echo date_i18n( get_option('date_format') ,strtotime( $p['post_modified'] ) ) ?> <a href="<?php echo get_permalink($p['ID']) ?>"><?php echo $p['post_title'] ?></a><br /> 
<?php
		//print_r( $p ); // debug 
		}

		}
		
}


//=============================================================
//add meta field for posts
	add_action('admin_init', 'my_extra_fields', 1);

function my_extra_fields() {
	
	/*$curr_post = wp_get_single_post( $post->ID );
	$category_is_parent = false;
	foreach( $curr_post->post_category as $parent_category ){
		if( cat_is_ancestor_of( 4, $parent_category ) ){
			$category_is_parent = true;
		};
		//$mystr .= "<p>cat2=".$parent_category." - ".(int)$category_is_parent."</p>"; // debug
	}*/
	
	if( true ){
		add_meta_box( 'extra_fields', 'Параметры документа', 'extra_fields_box_func', 'post', 'normal', 'high' );
	}
}
 
function extra_fields_box_func( $post ){
	
	?>
  <p><label>Цена - <input type="text" name="agropit_price_post" value="<?php echo get_post_meta( $post->ID, 'agropit_price_post', 1 ); ?>" style="width:50%" /> руб.</label></p> 
 	<p><label>№ ТУ - <input type="text" name="agropit_ntu_post" value="<?php echo get_post_meta( $post->ID, 'agropit_ntu_post', 1 ); ?>" style="width:50%" /></label></p>
 	<p><label>Только для kupi-tu - <input type="checkbox" name="agropit_only_kupitu" <?php if(get_post_meta( $post->ID, 'agropit_only_kupitu', 1 )=='on'){echo 'checked="checked"';} ?> ></label></p>
  <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" /> 
<?php
} 


	add_action('save_post', 'my_extra_fields_update', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update( $post_id ){
	if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false; // выходим если это автосохранение
	if ( !current_user_can( 'edit_post', $post_id ) ) return false; // выходим если юзер не имеет право редактировать запись

	if( !isset( $_POST['agropit_price_post'] ) && !isset( $_POST['agropit_ntu_post'] ) ) return false; // выходим если данных нет

	// Все ОК! Теперь, нужно сохранить/удалить данные
	//$_POST['extra'] = array_map('trim', $_POST['extra']); // для массива чистим все данные от пробелов по краям
	//$_POST['agropit_price_post'] = trim( $_POST['agropit_price_post'] ); // чистим все данные от пробелов по краям
	if( empty( $_POST['agropit_price_post'] ) ){
		delete_post_meta( $post_id, 'agropit_price_post' ); // удаляем поле если значение пустое
	}
	else{
		update_post_meta( $post_id, 'agropit_price_post', $_POST['agropit_price_post'] ); // add_post_meta() работает автоматически
	}
	
	if( empty( $_POST['agropit_ntu_post'] ) ){
		delete_post_meta( $post_id, 'agropit_ntu_post' );
	}
	else{
		update_post_meta( $post_id, 'agropit_ntu_post', $_POST['agropit_ntu_post'] );
	}
	
	if( empty( $_POST['agropit_only_kupitu'] ) ){
		delete_post_meta( $post_id, 'agropit_only_kupitu' );
	}
	else{
		update_post_meta( $post_id, 'agropit_only_kupitu', $_POST['agropit_only_kupitu'] );
	}
	
	return $post_id;
}

//====================================================================
//add cart button in post
	add_action('catalyst_hook_post_content','agropit_add_cart_in_post', 1);
function agropit_add_cart_in_post(){
	
	if( is_single() ){
		
		$agropit_post_id = get_the_ID();
		
		$agropit_post_price = get_post_meta( $agropit_post_id, 'agropit_price_post', 1 );
		
		if( $agropit_post_price > 0 ){			
			?>
		
		<div class="btn-cart-block">	
			<div class="wrap-btn-add-cart">
			<?php 
			$str_cookie_cart = stripslashes ( $_COOKIE['cookiesCart'] );
			preg_match_all( "/idItem\":(\d*),/", $str_cookie_cart, $matches );
			if ( !in_array( $agropit_post_id, $matches[1] ) ){
			?>	
				<div id="btn-add-tu">
				Стоимость:<div class="amount"><?php echo $agropit_post_price ?> руб.</div>
				<span style="color:#eee;font-size:10px;">НДС не облагается</span>
				<a href="#" class="btn-add" title="Добавить Техническое условие в заказ" onclick="jQuery('.amountItemsCart').text(jsCartChangeItem('cookiesCart', '<?php echo $agropit_post_id; ?>', 1, <?php echo $agropit_post_price; ?> , 'add')); document.getElementById('btn-add-tu').innerHTML='ТУ успешно добовлено в заказ<br><a title=\'Перейти к заказу...\' class=\'btn-view\' href=\'/cart\'>Оформить</a>';">Купить</a>
				</div>
				
			<?php }
			else {
				?>
				Это ТУ уже добовлено в заказ
				<br><a title="Перейти к заказу..." class="btn-view" href="/cart">Посмотреть</a>
				<?php
			}
			
		?>
		</div>

<!-- SLIDER -->			
<?php 
$view_slider = false;
//if( post_is_in_descendant_category( get_term_by( 'slug', 'sell-tu', 'category' )->term_id ) and is_single() ){ 
if( is_single() ){ 
 $view_slider = true;
}

//echo "<div style='display:none;'>";
//echo get_term_by( 'slug', 'tehnicheskie-usloviya-tu-na-produkti', 'category' )->term_id;
//echo "</div>";

$term_name = 'tehnicheskie-usloviya-tu-na-produkti';
//if( post_is_in_descendant_category( get_term_by( 'slug', $term_name, 'category' )->term_id ) and is_single() ){ 
if( is_single() ){ 
 $view_slider = true;
}

if( $view_slider ){ 
?>
			<div class="sale" id="sale-tu"><?php //layerslider(2) ?></div>
<?php 
} 
?>
<!--  SLIDER -->			
			
		</div>

		<?php 
		}
		
	}
	
}



//initialise cart
	add_action( 'catalyst_hook_after_after_footer', 'agropit_initialise_cart' );
function agropit_initialise_cart(){

	if( true ){
		
		?>
<script type="text/javascript">
jQuery('.amountItemsCart').text(jsCartGetAmountItems("cookiesCart"));
</script>
		
		<?php
		
	}
	
}





//=====================================================================================
//rewrite catalyst seo functions - title
//rewrite catalyst seo functions - meta description and meta keywords

// off catalyst SEO

require_once(__DIR__.'/functions-seo.php');

//-----------------
add_action( 'after_setup_theme', function(){
	if( remove_action( 'wp_title', 'catalyst_build_site_title' ) ){
		//echo "-- remove hook action 'catalyst_build_site_title'";
		add_filter( 'wp_title', 'agropit_filter_page_title', 10, 3 );
	} else {
		echo "-- fail remove hook action 'catalyst_build_site_title'";
	}

	if( remove_action( 'catalyst_meta', 'catalyst_build_seo_description' ) ){
		//echo "-- remove hook action 'catalyst_build_seo_description'";
		add_action( 'catalyst_meta', 'agropit_build_seo_description', 11 );
	} else {
		echo "-- fail remove hook action 'catalyst_build_seo_description'";
	}
	
	if( remove_action( 'admin_init', 'catalyst_add_taxonomy_seo_options' ) ){
		//echo "-- remove hook action 'catalyst_add_taxonomy_seo_options'";
		add_action( 'admin_init', 'agropit_add_taxonomy_seo_options' );
	} else {
		echo "-- fail remove hook action 'catalyst_add_taxonomy_seo_options'";
	}
	
});

function agropit_add_taxonomy_seo_options(){
	global $catalyst_seo_active;
	
	if( !$catalyst_seo_active )
		return;
		
	foreach ( get_taxonomies( array( 'show_ui' => true ) ) as $tax_name )
	{
		add_action( $tax_name . '_edit_form', 'agropit_taxonomy_seo_options', 11, 2 );
	}
}//end
	
function agropit_taxonomy_seo_options( $tag, $taxonomy ){
	$tax = get_taxonomy( $taxonomy );
?>
	<h3><?php _e('Catalyst SEO Options', 'catalyst'); ?></h3>
	<p><span class="description"><?php _e('These SEO options will be applied to this Taxonomy\'s archive pages.', 'catalyst'); ?></span></p>
	<table class="form-table"><tbody>
<?php 
if( isset( $tag->meta['doctitle'] ) ) { 
	$doctitle = esc_attr( $tag->meta['doctitle'] ); 
} else { 
	$doctitle = ''; 
} 
?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta[doctitle]"><?php _e( 'Document Title', 'catalyst' ); ?></label></th>
		<td>
			<input name="meta[doctitle]" 
id="meta[doctitle]" 
type="text" 
value="<?php echo $doctitle; ?>" 
size="40" />
<pre>
При составлении шаблонов используйте следующие переменные:
%название материала%
%цена%
%номер ТУ%

- данные переменные применимы к товарам категории, включая вложенные, 
если для них не определен собственный шаблон.
- при незаполненном поле данные берутся из родительской категории/рубрики
</pre>
		</td>
	</tr>
	
	<?php 
if( isset( $tag->meta['description'] ) ) { 
	$description = esc_attr( $tag->meta['description'] ); 
} else { 
	$description = ''; 
} ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta[description]"><?php _e( 'Meta Description', 'catalyst' ); ?></label></th>
		<td>
			<textarea name="meta[description]" 
id="meta[description]" rows="3" cols="50">
<?php echo $description; ?>
</textarea>
<pre>
%название материала%
%цена%
%номер ТУ%
</pre>

		</td>
	</tr>
	<?php if( isset( $tag->meta['keywords'] ) ) { $keywords = esc_attr( $tag->meta['keywords'] ); } else { $keywords = ''; } ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta[keywords]"><?php _e( 'Meta Keywords', 'catalyst' ); ?></label></th>
		<td><input name="meta[keywords]" id="meta[keywords]" type="text" value="<?php echo $keywords; ?>" size="40" />
		<p class="description"><?php _e('Comma separated list', 'catalyst'); ?></p></td>
	</tr>

	<tr>
		<th scope="row" valign="top"><label><?php _e('Robots Meta', 'catalyst'); ?></label></th>
		<td>
			<label><input name="meta[noindex]" id="meta[noindex]" type="checkbox" value="1" <?php if( isset( $tag->meta['noindex'] ) && checked( 1, $tag->meta['noindex'] ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>noindex</code>' ); ?></label><br />
			<label><input name="meta[nofollow]" id="meta[nofollow]" type="checkbox" value="1" <?php if( isset( $tag->meta['nofollow'] ) && checked( 1, $tag->meta['nofollow'] ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>nofollow</code>' ); ?></label><br />
			<label><input name="meta[noarchive]" id="meta[noarchive]" type="checkbox" value="1" <?php if( isset( $tag->meta['noarchive'] ) && checked( 1, $tag->meta['noarchive'] ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>noarchive</code>' ); ?></label>
		</td>
	</tr>

	</tbody></table>
<?php
}//end

function agropit_filter_page_title( $title, $sep, $seplocation ){
	//$numargs = func_num_args();	
	//$arg_list = func_get_args();
//echo "argument list:<pre>";	
//print_r($arg_list);
//echo "</pre>";
	global $wp_query;
	global $post;
	
	if( is_feed() ) return trim( $title );
	
	$separator = catalyst_get_core( 'title_tag_separator' ) ? catalyst_get_core( 'title_tag_separator' ) : '|';
	$separator_location = catalyst_get_core( 'title_append_location' ) == 'Right' ? 'Right' : 'Left';
	
	if( is_front_page() )
	{
		$title = catalyst_get_core( 'home_title' ) ? catalyst_get_core( 'home_title' ) : get_bloginfo( 'name' );
		$title = catalyst_get_core( 'append_description_title' ) ? $title . " $separator " . get_bloginfo( 'description' ) : $title;
$title = 'is_front_page';
	}
	
	if( is_singular() )
	{	
		// Catalyst
		if( catalyst_get_custom_field( '_catalyst_title' ) )
		{
			$title = catalyst_get_custom_field( '_catalyst_title' );
		} else {
			
			$postCategories = get_the_category();
			$titleTpl = _getCategoryTitleTemplate( $postCategories[0]->term_id ); 
//echo "titleTpl = ".$titleTpl;
			if( !empty( $titleTpl ) ){
				$title = _formPageTitle( $titleTpl );
			}
		}
	}

	
	if( is_category() )
	{
		$term = $wp_query->get_queried_object();
		if( !empty( $term->meta['doctitle'] ) ){
			$title = $term->meta['doctitle'];
		} else {
			$title = _getCategoryTitleTemplate( $term->parent ); 
		}
		
		$title = str_replace("%название материала%", "", $title );
		$title = str_replace("%цена%", "", $title);
		$title = str_replace("%номер ТУ%", "", $title);
	}
	
	if( is_tag() )
	{
		//$term = $wp_query->get_queried_object();
		//$title = !empty( $term->meta['doctitle'] ) ? $term->meta['doctitle'] : $title;
$title = 'is_tag';
	}
	
	if( is_tax() )
	{
		//$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		//$title = !empty( $term->meta['doctitle'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['doctitle'] ) ) : $title;
$title = 'is_tax';
	}
	
	if( is_author() )
	{
		//$user_title = get_the_author_meta( 'doctitle', (int)get_query_var( 'author' ) );
		//$title = $user_title ? $user_title : $title;
$title = 'is_author';
	}
	
	if( !catalyst_get_core( 'append_site_name' ) || is_front_page() ){
		return esc_html ( trim( $title ) );
	}
	
	if( $separator_location == 'Right' ){
		$title = $title . " $separator " . get_bloginfo( 'name' );
	} else {
		$title = get_bloginfo( 'name' ) . " $separator " . $title;
	}
//echo htmlspecialchars($title);
	
	return esc_html( trim( $title ) );
}//end


function agropit_build_seo_description(){
	global $wp_query, $post;
	
	$description = '';
	
	if( is_front_page() )
	{
		//$description = catalyst_get_core( 'home_description' ) ? catalyst_get_core( 'home_description' ) : get_bloginfo( 'description' );
$description = 'is_front_page';
	}
	
	if( is_singular() )
	{
		//$description = catalyst_get_custom_field( '_catalyst_description' );
		//$description = $description ? $description : catalyst_get_core( 'home_description' );
$description = 'is_singular';
	}

	if( is_category() )
	{
		//$term = $wp_query->get_queried_object();
		//$description = !empty( $term->meta['description'] ) ? $term->meta['description'] : catalyst_get_core( 'home_description' );
$description = 'is_category';
	}
	
	if( is_tag() )
	{
		//$term = $wp_query->get_queried_object();
		//$description = !empty( $term->meta['description'] ) ? $term->meta['description'] : catalyst_get_core( 'home_description' );
$description = 'is_tag';
	}

	if( is_tax() )
	{
		//$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		//$description = !empty( $term->meta['description'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['description'] ) ) : catalyst_get_core( 'home_description' );
$description = 'is_tax';
	}
	
	if( is_author() )
	{
		//$user_description = get_the_author_meta( 'meta_description', (int)get_query_var( 'author' ) );
		//$description = $user_description ? $user_description : catalyst_get_core( 'home_description' );
$description = 'is_author';
	}
	
	if( !empty( $description ) )
	{
		echo '<meta name="description" content="' . esc_attr( stripslashes( $description ) ) . '" />' . "\n";
	}
}//end


function _getCategoryTitleTemplate( $catId ){
	global $post;
	
	$titleTpl = "";
	$categoryInfo = get_category( $catId );
	if( !empty( $categoryInfo->meta["doctitle"] ) ){
		$titleTpl = $categoryInfo->meta["doctitle"];
	} else {
		if( $categoryInfo->parent > 0 ){
			$titleTpl = _getCategoryTitleTemplate( $categoryInfo->parent );
		}
	}
	return $titleTpl;
}//end

		
function _formPageTitle( $titleTpl ){
	global $post;
	
	$postTitle = $post->post_title;
	$price = get_post_meta( $post->ID, "agropit_price_post")[0];
	$tuNum = get_post_meta( $post->ID, "agropit_ntu_post")[0];;

	$title = str_replace("%название материала%", $postTitle, $titleTpl );
	$title = str_replace("%цена%", $price, $title);
	$title = str_replace("%номер ТУ%", $tuNum, $title);
	
	return $title;
}//end

//-----------------

remove_action( 'catalyst_meta','catalyst_build_robots_meta' );
remove_action( 'catalyst_meta', 'catalyst_build_seo_keywords' );

add_action( 'catalyst_meta', 'agropit_build_seo_keywords', 11 );
function agropit_build_seo_keywords()
{
	global $wp_query, $post;

	$keywords = '';
	
	if( is_front_page() )
	{
		$keywords = catalyst_get_core( 'home_keywords' );
	}
	
	if( is_singular() )
	{
		$keywords = catalyst_get_custom_field( '_catalyst_keywords' );
		$keywords = $keywords ? $keywords : catalyst_get_core( 'home_keywords' );

	}
	
	if( is_category() )
	{
		$term = $wp_query->get_queried_object();
		$keywords = !empty( $term->meta['keywords'] ) ? $term->meta['keywords'] : catalyst_get_core( 'home_keywords' );
	}
	
	if( is_tag() )
	{
		$term = $wp_query->get_queried_object();
		$keywords = !empty( $term->meta['keywords'] ) ? $term->meta['keywords'] : catalyst_get_core( 'home_keywords' );
	}
	
	if( is_tax() )
	{
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$keywords = !empty( $term->meta['keywords'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['keywords'] ) ) : catalyst_get_core( 'home_keywords' );
	}
	
	if( is_author() )
	{
		$user_keywords = get_the_author_meta( 'meta_keywords', (int)get_query_var( 'author' ) );
		$keywords = $user_keywords ? $user_keywords : catalyst_get_core( 'home_keywords' );
	}

	if( empty( $keywords ) )
		return;
	
	echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '" />' . "\n";
}

//add reviews form
	add_action( 'catalyst_hook_after_content', 'add_reviews_form' );
function add_reviews_form(){

	if ( !is_singular() && is_category( 'reviews' ) ){
		echo do_shortcode( '[contact-form-7 id="4499" title="Оставьте свой отзыв"]' );
	}
}

//if reviews submit add post in category
	add_action('wpcf7_before_send_mail','add_reviews_to_category');
function add_reviews_to_category( $WPCF7_ContactForm ) {

	$id_cat = get_cat_ID( 'reviews' );
	
	$submission = WPCF7_Submission::get_instance();
	$data =& $submission->get_posted_data();
	
	if( $WPCF7_ContactForm->id == 4499 ){

		$post_data = array(
			'post_title' => $data['your-name'],
			'post_content' => $data['your-reviews'],
			'post_status' => 'pending',
			'post_category' => array( $id_cat )
		);
		wp_insert_post( $post_data );
	}
}


//build content reviews
	add_filter('excerpt_length', 'reviews_excerpt_length');
function reviews_excerpt_length( $length ) {

        if( in_category( 'reviews' ) ){    
		$length = 20000;
	}
	
	return $length;
}


add_filter( 'flamingo_map_meta_cap', 'flamingo_caps' );
function flamingo_caps( $meta_caps ){
    
    foreach( $meta_caps as $key => $cap ){ $meta_caps[$key] = 'read_post'; }
    //var_dump($meta_caps);//debug

    return $meta_caps;
}







/*
catalyst_register_sidebar( array(
	'name'=>'Sidebar 1',
	'id' => 'catalyst_default_sidebar_1',
	'before_title'  => '<div class="widgettitle">',
	'after_title'   => "</div>\n"
) );

catalyst_register_sidebar( array(
	'name'=>'Sidebar 2',
	'id' => 'catalyst_default_sidebar_2',
	'before_title'  => '<div class="widgettitle">',
	'after_title'   => "</div>\n"
) );
*/
	remove_action( 'catalyst_hook_post_content', 'catalyst_build_the_content' );
	add_action( 'catalyst_hook_post_content', 'catalyst_build_the_content_function' );
/**
 * Build the main content structure based on Catalyst options and page/post types/locations.
 *
 * @since 1.0
 */
function catalyst_build_the_content_function()
{
	$read_more_text = apply_filters( 'read_more_text', __( 'Read more &raquo;', 'catalyst' ) );
		
	if( !is_singular() && catalyst_get_core( 'archive_thumbnails' ) )
	{
		$thumbnail_alignment = ( catalyst_get_core( 'thumbnail_alignment' ) == 'None' ) ? '' : 'align' . strtolower( catalyst_get_core( 'thumbnail_alignment' ) );
	}
	
	if( is_singular() || ( class_exists( 'bbPress' ) && is_bbpress() ) )
	{
		echo the_content( $read_more_text ) . '<div style="clear:both;"></div>' . "\n";
		wp_link_pages( array( 'before' => '<p class="pages">' . __( 'Pages:', 'catalyst' ), 'after' => '</p>' ) );
		
		if( is_single() )
		{
			echo '<!--'; trackback_rdf(); echo '-->' ."\n";
		}
		
		if( is_page() && catalyst_get_core( 'page_edit_link' ) )
		{
			edit_post_link(__( '(Edit)', 'catalyst' ), '', '' );
		}
	}
	elseif( ( is_archive() && catalyst_get_core( 'archive_content_type' ) == "Excerpt" ) ||
			( is_search() && catalyst_get_core( 'archive_content_type' ) == "Excerpt" ) ||
			( !is_archive() && !is_search() && catalyst_get_core( 'default_content_type' ) == "Excerpt" ) ||
			( ( ( is_archive() && catalyst_get_core( 'archive_content_type' ) == "Hybrid" ) || ( is_search() && catalyst_get_core( 'archive_content_type' ) == "Hybrid" ) || ( !is_archive() && !is_search() && catalyst_get_core( 'default_content_type' ) == "Hybrid" ) ) && !in_array( 'catalyst-feature', get_post_class() ) ) )
	{
		if( function_exists( 'has_post_thumbnail' ) )
		{
			if( has_post_thumbnail() && catalyst_get_core( 'archive_thumbnails' ) && catalyst_get_core( 'thumbnail_location' ) == "Inside" )
			{
				ob_start();
				the_post_thumbnail( ( catalyst_get_core( 'thumbnail_size' ) ), array( 'class' => $thumbnail_alignment ) );
				$the_post_thumbnail = ob_get_clean();
				
				printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $the_post_thumbnail );
			}
		}
		$excerpt_content = get_the_excerpt();
		if( !empty( $read_more_text ) )
		{
			$read_more_text = ' <a class="excerpt-read-more" rel="nofollow" href="' . get_permalink() . '">' . $read_more_text . '</a>';
		}
		else
		{
			$read_more_text = '';
		}
		if( catalyst_get_core( 'excerpt_read_more_placement' ) != 'New Line' )
		{
			echo '<p>' . $excerpt_content . $read_more_text . '</p>' . "\n";
		}
		else
		{
			echo '<p>' . $excerpt_content . '</p>' . "\n";
			echo '<p>' . $read_more_text . '</p>' . "\n";
		}
	}
	else
	{
		echo the_content( $read_more_text ) . '<div style="clear:both;"></div>' . "\n";
	}
}




/**
 * Initialize output buffering.
 */
function ws_set_up_buffer(){
    //Don't filter Dashboard pages and the feed
    if ( is_feed() || is_admin() ){
        return;
    }
    //Start buffering. Note that we don't need to
    //explicitly close the buffer - WP will do that
    //for use in the "shutdown" hook.
    
	global $breadcrumbs_html;
	$breadcrumbs_html = get_breadcrumbs();
	
    ob_start('ws_filter_page');
}
	add_action('wp', 'ws_set_up_buffer', 10, 0);
 


/**
 * Buffer callback.
 *
 * @param string $html Current contents of the output buffer.
 * @return string New buffer contents.
 */
function ws_filter_page($html){
	//Удаляет keywords
    $html = preg_replace('/<meta name=\"keywords\".*?\/>/s', '', $html);
    
	require_once( __DIR__.'/simple_html_dom.php' );

	$dom = str_get_html($html, true, true, DEFAULT_TARGET_CHARSET, false);

	//Меняем h2 в сайдбаре на div
	foreach($dom->find('.widget h2.entry-title') as $element){
		$element->outertext = '<div class="h2 entry-title">'.$element->innertext.'</div>';
	}


	//Удаляем циклические ссылки из меню
	$request = urldecode( trim(preg_replace('/\?(.*)$/', '', $_SERVER['REQUEST_URI']), '/') );
	if ( empty($request) ){
		$request = '/';
	}

	foreach($dom->find('.menu-item>a') as $element){
		$href = $element->href;
		$href = urldecode($href);
		$href = preg_replace("/^(.*?)".$_SERVER['HTTP_HOST']."/", '', $href);
		$href = trim($href, '/');
		if ( empty($href) ){
			$href = '/';
		}

		if ( $request == $href ){
			$element->tag = 'span';
		}

		$cont .= $href . "\r\n\r\n";
	}



	//Разметка schema
	if ( is_single() ){
		foreach($dom->find('#content') as $element){
			$element->itemtype = 'http://schema.org/Product';
		}

		foreach($dom->find('#content h1') as $element){
			$element->itemtype = 'name';
		}

		foreach($dom->find('.entry-content') as $element){
			$element->itemtype = 'description';
		}

		foreach($dom->find('#btn-add-tu .amount') as $element){
			$element->itemtype = 'price';
		}
	}


	//Корзина
	foreach($dom->find('#menu-item-5565 a') as $element){
		$element->innertext = 'Корзина (<span class="amountItemsCart" style="display:inline">0</span>)';
	}


	//Хлебные крошки
	global $breadcrumbs_html;
	foreach($dom->find('#content') as $element){
		$element->innertext = $breadcrumbs_html . $element->innertext;
	}
	
	$html = $dom->save();

    return $html;
}

function get_breadcrumbs(){
	ob_start();
	include(__DIR__.'/templates/breadcrumbs.php');
	$breadcrumbs_content = ob_get_contents();
	ob_clean();

	return $breadcrumbs_content;
}




	//add_action('wp_footer', 'add_google_remarketing');
function add_google_remarketing(){
	?>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 970631367;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/970631367/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
	<?php 
}

//add_action('wp_footer', 'add_google_counter');
function add_google_counter(){
	?>
<!-- google counter -->
<!--<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39235516-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>-->

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-39235516-1', 'auto');
	ga('send', 'pageview');
</script>


<!-- /google counter -->
	<?php 
}

	add_action('wp_footer', 'add_footer_counter');
function add_footer_counter(){
//echo get_template_directory();	
}

//add_action('wp_footer', 'add_yandex_metrika');
function add_yandex_metrika(){
	?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter15298192 = new Ya.Metrika({id:15298192,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/15298192" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

	<?php 
}

	//add_action('wp_footer', 'add_crm_pixel');
function add_crm_pixel(){
	?>
<!-- Pixel -->
<script type="text/javascript">
    (function (d, w) {
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://qoopler.ru/index.php?ref="+d.referrer+"&cookie=" + encodeURIComponent(document.cookie);

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
    })(document, window);
</script>
<!-- /Pixel -->

	<?php 
}

//end custom-functions.php






//YML
	add_action('init', 'yml_init_function');
function yml_init_function(){
	if ( $_SERVER['REQUEST_URI'] != '/yml' ){
		return;
	}


	global $wpdb;

	$posts = $wpdb->get_results("SELECT p.*, m.meta_value AS price, rel.term_taxonomy_id AS category_id, terms.name AS category_name, m2.meta_value AS tu_number 
		FROM {$wpdb->prefix}posts AS p 
		INNER JOIN {$wpdb->prefix}postmeta AS m ON m.post_id = p.ID AND m.meta_key = 'agropit_price_post' 
		LEFT JOIN {$wpdb->prefix}postmeta AS m2 ON m2.post_id = p.ID AND m2.meta_key = 'agropit_ntu_post'
		LEFT JOIN {$wpdb->prefix}term_relationships AS rel ON p.ID = rel.object_id 
		INNER JOIN {$wpdb->prefix}terms AS terms ON terms.term_id = rel.term_taxonomy_id
		INNER JOIN {$wpdb->prefix}term_taxonomy AS tax ON tax.term_id = terms.term_id AND tax.taxonomy = 'category'");
	//var_dump($posts); die();
	$categories = get_categories();
	
	foreach($posts as $post){
		if ( empty($products[$post->ID]) ){
			$products[$post->ID] = $post;
			$products[$post->ID]->categories = array($post->category_id);
		}else{
			$products[$post->ID]->categories[] = $post->category_id;
		}
	}

	//var_dump($posts); die();
	
	if (file_exists(__DIR__.'/templates/yml.php')){
		include(__DIR__.'/templates/yml.php');
	}
	die();

}




//Yandex turbo
require_once(__DIR__.'/yandex_turbo_functions.php');


//Cache
require_once(__DIR__.'/cache_functions.php');







// Disables Kses only for textarea saves
foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
	remove_filter($filter, 'wp_filter_kses');
}

// Disables Kses only for textarea admin displays
foreach (array('term_description', 'link_description', 'link_notes', 'user_description') as $filter) {
	remove_filter($filter, 'wp_kses_data');
}

//Additional links on the plugin page
add_filter('plugin_row_meta', 'RegisterPluginLinks', 10, 2);

function RegisterPluginLinks ($links, $file) {
	if ($file == plugin_basename(__FILE__)) {
		$links[] = '<a href="http://wordpress.org/support/plugin/allow-html-in-category-descriptions">Support</a>';
		$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SGS5KSM9N4D3Y">Donate</a>';
	}
	return $links;
}	






//end functions.php
