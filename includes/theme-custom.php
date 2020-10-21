<?php 
/**
 * Load custom functions.php file if it exists. This is a temporary measure for the mobile detection
 * plugin's inability to use child theme.
*/
$uploads_dir = wp_upload_dir();
if ( file_exists( $uploads_dir['basedir'] . '/graphene-mobile-custom/functions.php' ) ){
	include( $uploads_dir['basedir'] . '/graphene-mobile-custom/functions.php' );
}

/**
 * Load custom style.css file
*/
function mgraphene_custom_style(){
	$uploads_dir = wp_upload_dir();
	if ( file_exists( $uploads_dir['basedir'] . '/graphene-mobile-custom/style.css' ) ){
		wp_register_style( 'mgraphene-custom-styles', $uploads_dir['baseurl'] . '/graphene-mobile-custom/style.css' );
		wp_enqueue_style( 'mgraphene-custom-styles' );
	}
}
add_action( 'wp_print_styles', 'mgraphene_custom_style', 100 );