<?php
/*
Template Name: test1
*/
?>

<?php //get_header(); ?>

<h3>Product type filter</h3>
<ul>
	<li><a href="?product_type=video">get video</a></li>
	<li><a href="?product_type=photoset">get photoset</a></li>
</ul>
<?php
//echo "<pre>";
//print_r($post);
//echo "</pre>";

//$categories = get_the_category( $post->ID );
//echo "categories: <pre>";
//print_r( $categories );
//echo "</pre>";


//$posttags = get_the_tags();
//echo "tags: <pre>";
//print_r( $posttags );
//echo "</pre>";

//if ($posttags) {
  //foreach($posttags as $tag) {
	//echo $tag->name . ' '; 
  //}
//}


//https://coderun.ru/blog/kak-v-woocommerce-vybrat-tovary-po-atributam/
//https://wp-kama.ru/function/wp_query

$productType = "video";
if ( isset($_REQUEST['product_type']) ) {
    $productType = $_REQUEST['product_type'];
}

$args = array(
    'post_type' => array('product'),
    'tax_query' => array(
        //'relation' => 'OR',
        array(
            'taxonomy' => 'pa_product_type', 
            'field' => 'name',
            'terms' => $productType//'photoset'//'video',
            //'operator' => 'IN',
        )
    )
);
$result = new WP_Query($args);
echo "products: <pre>";
print_r( $result->posts );
echo "</pre>";

//$query = new WP_Query('tag=video');
//echo "products with tag VIDEO: <pre>";
//print_r( $query );
//echo "</pre>";

/*
$query_obj = new WP_Query();
$result = $query_obj->query( array(
	'post_type' => 'product'//page
) );
foreach( $result as $item ){
	echo esc_html( $item->post_title );
}
*/

/*
$products = new WP_Query(
	array(
		"post_type" => "product"
	)
);
echo "products: <pre>";
print_r( $products->posts );
echo "</pre>";
*/

/*
$products = new WP_Query(
	//'product_tag=photoset'
	'product_tag=video'
);
echo "products: <pre>";
print_r( $products->posts );
echo "</pre>";
*/

?>

<?php //get_sidebar(); ?>
<?php //get_footer(); ?>
