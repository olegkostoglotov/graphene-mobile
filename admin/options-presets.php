<?php
/* Check authorisation */
$authorised = true;

if ( isset( $_POST['mgraphene-preset'] ) ){ 
	if ( ! wp_verify_nonce( $_POST['mgraphene-preset'], 'mgraphene-preset' ) ) { $authorised = false; } // Check nonce
	if ( ! current_user_can( 'edit_theme_options' ) ){ $authorised = false; } // Check permissions

} else { $authorised = false; }

if ($authorised) {
	global $mgraphene_settings, $mgraphene_defaults;
	
	/* Reset the options */	
	if ( $_POST['mgraphene_options_preset'] == 'reset' ) {
		delete_option( 'mgraphene_settings' );
		add_settings_error( 'mgraphene_options', 2, __( 'Settings have been reset.', 'mgraphene' ), 'updated' );
	}
	
	/* Copy the relevant Graphene theme settings */
	if ( $_POST['mgraphene_options_preset'] == 'graphene-settings' ) {
		global $graphene_settings;
		foreach ( $graphene_settings as $key => $value ) {
			if ( $value && array_key_exists( $key, $mgraphene_settings ) )
				$mgraphene_settings[$key] = $value;
		}
		
		$mgraphene_settings = array_merge( $mgraphene_defaults, $mgraphene_settings );
		update_option( 'mgraphene_settings', $mgraphene_settings );
		
		add_settings_error( 'mgraphene_options', 2, __( 'Relevant settings from the Graphene Options has been applied.', 'mgraphene' ), 'updated' );
	}
	
	// Update the global settings variable
	$mgraphene_settings = array_merge( $mgraphene_defaults, get_option( 'mgraphene_settings', array() ) );

} else {
	wp_die( __( 'ERROR: You are not authorised to perform that operation', 'mgraphene' ) );
}
?>