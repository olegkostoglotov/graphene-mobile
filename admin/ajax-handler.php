<?php
/**
 * Process the AJAX call to save the theme's settings
 */
function mgraphene_ajax_update_handler() {
	global $wpdb;
	check_ajax_referer( 'mgraphene_options-options', '_wpnonce' );
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		echo '<div class="error fade"><p>' . __( "Sorry, but you don't have the necessary permission to modify theme options.", 'mgraphene' ) . '</p></div>';
		die();
	}
	
	$data = $_POST['mgraphene_settings'];
	$data = mgraphene_settings_validator( $data );
	
	if ( get_settings_errors( 'mgraphene_options' ) ){
		settings_errors( 'mgraphene_options' );
	} else {
		if ( $data ) update_option( 'mgraphene_settings', stripslashes_deep( $data ) );
		echo '<div class="updated fade"><p>' . __( 'Options saved.', 'mgraphene' ) . '</p></div>';
	}
		
	die();
}
add_action( 'wp_ajax_mgraphene_ajax_update', 'mgraphene_ajax_update_handler' );