<?php
/**
 * @package change_sender_email
Plugin Name: Change sender email
Description: "change original email address (webmaster@yourdreammovie.com) to info@yourdreammovie.com"
*/

//https://wpincode.com/kak-izmenit-defoltnoe-imya-i-email-adres-otpravitelya-dlya-isxodyashhix-pisem-v-wordpress/
add_filter( 'wp_mail_from', 'devise_sender_email' );
add_filter( 'wp_mail_from_name', 'devise_sender_name' );

//==========================================
function devise_sender_email( $original_email_address ) {
    return 'info@yourdreammovie.com';
}

function devise_sender_name( $original_email_from ) {
	return 'info, yourdreammovie.com';
}
?>

