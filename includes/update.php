<?php
/**/
// TEMP: Enable update check on every request. Normally you don't need this! This is for testing only!
//set_site_transient( 'update_themes', null);

// NOTE: All variables and functions will need to be prefixed properly to allow multiple plugins to be updated

/******************Change this*******************/
$mgraphene_api_url = 'http://updates.graphene-theme.com/';
/************************************************/

/*******************Child Theme******************
//Use this section to provide updates for a child theme
//If using on child theme be sure to prefix all functions properly to avoid 
//function exists errors
if ( function_exists( 'wp_get_theme' ) ){
    $mgraphene_theme_data = wp_get_theme(get_option( 'stylesheet' ) );
    $mgraphene_theme_version = $mgraphene_theme_data->Version;  
} else {
    $mgraphene_theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
    $mgraphene_theme_version = $mgraphene_theme_data['Version'];
}    
$mgraphene_theme_base = get_option( 'stylesheet' );
**************************************************/

$mgraphene_theme_base = basename( MGRAPHENE_ROOTDIR );
if ( function_exists( 'wp_get_theme' ) ){
    $mgraphene_theme_data = wp_get_theme( $mgraphene_theme_base );
    $mgraphene_theme_version = $mgraphene_theme_data->Version;  
} else {
    $mgraphene_theme_data = get_theme_data( MGRAPHENE_ROOTDIR . '/style.css' );
    $mgraphene_theme_version = $mgraphene_theme_data['Version'];
}    


//Uncomment below to find the theme slug that will need to be setup on the api server
//var_dump( $mgraphene_theme_base);


/**
 * Take over the theme update check
 *
 * @package Graphene Mobile
 * @since 1.2.4
 */
function mgraphene_check_for_update( $checked_data ) {
	global $wp_version, $mgraphene_theme_version, $mgraphene_theme_base, $mgraphene_api_url, $mgraphene_settings;

	$request = array(
		'slug' => $mgraphene_theme_base,
		'version' => $mgraphene_theme_version 
	);
	
	/* Start checking for an update */
	$send_for_check = array(
						'body' => array(
							'action' 			=> 'theme_update', 
							'request' 			=> serialize( $request ),
							'api-key' 			=> md5( get_bloginfo( 'url' ) ),
							'client-api-key' 	=> $mgraphene_settings['api_key'],
						),
						'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' ) . ' graphene-mobile'
					);
	$raw_response = wp_remote_post( $mgraphene_api_url, $send_for_check);
	if ( !is_wp_error( $raw_response) && ( $raw_response['response']['code'] == 200) )
		$response = unserialize( $raw_response['body']);

	/* Feed the update data into WP updater */
	if ( !empty( $response ) ) 
		$checked_data->response[$mgraphene_theme_base] = $response;

	return $checked_data;
}
add_filter( 'pre_set_site_transient_update_themes', 'mgraphene_check_for_update' );


/**
 * Take over the Theme info screen on WP multisite
 *
 * @package Graphene Mobile
 * @since 1.2.4
 */
function mgraphene_api_call( $def, $action, $args ) {
	global $mgraphene_theme_base, $mgraphene_api_url, $mgraphene_theme_version;
	
	if ( $args->slug != $mgraphene_theme_base )
		return false;
	
	/* Get the current version */
	$args->version = $mgraphene_theme_version;
	$request_string = prepare_request( $action, $args );
	$request = wp_remote_post( $mgraphene_api_url, $request_string );

	if (is_wp_error( $request ) ) {
		$res = new WP_Error( 'themes_api_failed', __( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>' ), $request->get_error_message() );
	} else {
		$res = unserialize( $request['body'] );
		if ( $res === false ) $res = new WP_Error( 'themes_api_failed', __( 'An unknown error occurred' ), $request['body'] );
	}
	
	return $res;
}
add_filter( 'themes_api', 'mgraphene_api_call', 10, 3 );