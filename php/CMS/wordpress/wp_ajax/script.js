jQuery(document).ready(function($){

	
	$("#top-mini-cart").on("click", function() {
    	$("#top-mini-cart .topcart_content").toggle(500);
	});//end event



	//$("a[href$='?add-to-cart']").on("click", function(e) {
	$(".ajax_add_to_cart").on("click", function(e) {
console.log("TEST, ", e);	
//--------------------------
//https://pluginrepublic.com/updating-the-woocommerce-mini-cart-via-ajax/
		var data = {
			'action': '_update_mini_cart'
		};
		$.post(
			_ajax.url, // var _ajax = {"url":"https://clip4custom.com/wp-admin/admin-ajax.php"};
			data, // Send our PHP function
			function(response){
console.log(response);
		});		
//--------------------------    	
	});//end event	

	
});//end of document ready

