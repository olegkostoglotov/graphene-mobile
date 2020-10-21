<?php 
/**
 * This file contains the function definitions that are required for the mobile
 * theme's options and settings in the WordPress administration panel. All functions
 * defined here can be used in both the front end and admin back-end. Functions that
 * are only required for front-end is defined in the theme's root folder functions.php
 * instead.
*/

 /**
 * Retrieve the theme's user settings and default settings. Individual files can access
 * these setting via a global variable call, so database query is only
 * done once.
 *
*/
define( 'MGRAPHENE_ROOTDIR', dirname( dirname( __FILE__ ) ) );
define( 'MGRAPHENE_ROOTURI', trailingslashit( get_theme_root_uri() ) . basename( dirname( dirname( __FILE__ ) ) ) );

// Load the theme setup
require( MGRAPHENE_ROOTDIR . '/includes/theme-setup.php' );

// Load the theme's custom functions
require( MGRAPHENE_ROOTDIR . '/includes/common-functions.php' );

// Load the theme's options page setup
require( MGRAPHENE_ROOTDIR . '/admin/options-init.php' );

// Load the theme update check
require( MGRAPHENE_ROOTDIR . '/includes/update.php' );