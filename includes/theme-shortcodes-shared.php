<?php
/**
 * Mobile-only content shortcode
 */
function mgraphene_sc_mobile_only( $atts, $content = null, $code="" ) {
	$theme = ( function_exists( 'wp_get_theme' ) ) ? wp_get_theme() : get_current_theme();
	if ( $theme->stylesheet == basename( MGRAPHENE_ROOTDIR ) ) return do_shortcode( $content );
	else return;
}
add_shortcode( 'mobile-only', 'mgraphene_sc_mobile_only' );


/**
 * Mobile-excluded content shortcode
 */
function mgraphene_sc_mobile_exclude( $atts, $content = null, $code="" ) {
	$theme = ( function_exists( 'wp_get_theme' ) ) ? wp_get_theme() : get_current_theme();
	if ( $theme->stylesheet != basename( MGRAPHENE_ROOTDIR ) ) return do_shortcode( $content );
	else return;
}
add_shortcode( 'mobile-exclude', 'mgraphene_sc_mobile_exclude' );
