<?php 
/**
 * Registers and enqueues the various CSS and JS scripts for the theme
*/


/* Register the CSS files */
function mgraphene_register_styles() {
	wp_register_style( 'mgraphene-main', get_stylesheet_uri());
}
add_action( 'init', 'mgraphene_register_styles' );


/* Enqueue the CSS files */
function mgraphene_enqueue_styles() {
	wp_enqueue_style( 'mgraphene-main' );
}
add_action( 'wp_print_styles', 'mgraphene_enqueue_styles' );


/* Register scripts */
function mgraphene_register_scripts() {

}
add_action( 'init', 'mgraphene_register_scripts' );


/* Enqueue scripts */
function mgraphene_enqueue_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'graphene-mobile', MGRAPHENE_ROOTURI . '/js/graphene-mobile.js', array( 'jquery' ) );
}
add_action( 'template_redirect', 'mgraphene_enqueue_scripts' );