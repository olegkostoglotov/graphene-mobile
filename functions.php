<?php 
/**
 * Graphene Mobile functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, mgraphene_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
*/

/**
 * This is a temporary measure for the mobile detection plugin's inability to use child theme.
*/
require_once( 'includes/theme-custom.php' );

/** 
 * Include the function definitions for functions that are required in both the front-end and
 * the admin back-end
*/
require('includes/functions.php');

require_once('includes/theme-setup.php');		// The theme setup
require_once('includes/theme-scripts.php');		// Theme's CSS and JS scripts
require_once('includes/theme-shortcodes.php');	// Theme's shortcodes
require_once('includes/theme-loops.php');		// Custom functions for post/page loops
require_once('includes/theme-menus.php');		// Custom functions for navigation menus
require_once('includes/theme-comments.php');	// Custom functions for comments
require_once('includes/theme-functions.php');	// Custom functions for the site in general
?>