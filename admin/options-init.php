<?php
/**
 * Retrieve the theme's user settings and default settings. Individual files can access
 * these setting via a global variable call, so database query is only
 * done once.
*/
require( MGRAPHENE_ROOTDIR . '/admin/options-defaults.php' );
$mgraphene_defaults = apply_filters( 'mgraphene_defaults', $mgraphene_defaults );
function mgraphene_get_settings(){
	global $mgraphene_defaults;
	$mgraphene_settings = array_merge( $mgraphene_defaults, (array) get_option( 'mgraphene_settings', array() ) );
	return apply_filters( 'mgraphene_settings', $mgraphene_settings );
}
global $mgraphene_settings;
$mgraphene_settings = mgraphene_get_settings();


/**
 * Add options page in the Administration panel
*/
function mgraphene_options_init() {
	global $mgraphene_settings;
	$mgraphene_settings['hook_suffix'] = add_theme_page( __('Graphene Mobile', 'mgraphene'), __('Graphene Mobile', 'mgraphene'), 'edit_theme_options', 'mgraphene_options', 'mgraphene_options');
	
	add_action( 'admin_print_styles-' . $mgraphene_settings['hook_suffix'], 'mgraphene_admin_options_style' );
	add_action( 'admin_print_scripts-' . $mgraphene_settings['hook_suffix'], 'mgraphene_admin_scripts' );
	do_action('mgraphene_options_init');
}
add_action('admin_menu', 'mgraphene_options_init', 9);

include( MGRAPHENE_ROOTDIR . '/admin/validator.php' );			// The settings validator
include( MGRAPHENE_ROOTDIR . "/admin/options.php" );
include( MGRAPHENE_ROOTDIR . '/admin/ajax-handler.php');


/**
 * Enqueue style for admin page
*/
if ( ! function_exists('mgraphene_admin_options_style')) :
function mgraphene_admin_options_style() {
	
	wp_enqueue_style( 'mgraphene-admin-style', get_theme_root_uri() . '/graphene-mobile/admin/admin.css' );
	if ( is_rtl() ) {
		wp_enqueue_style( 'mgraphene-admin-style-rtl', get_theme_root_uri() . '/graphene-mobile/admin/admin-rtl.css' );
	}
	if ( isset( $_GET['tab'] ) && in_array( $_GET['tab'], array( 'display', 'colours' ) ) )
		wp_enqueue_style( 'farbtastic' );
	
}
endif;


/**
 * Script required for the theme options page
 */
function mgraphene_admin_scripts() {
		
	/* Enqueue scripts */
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_script( 'thickbox' );
	wp_enqueue_script( 'mgraphene-admin-js', MGRAPHENE_ROOTURI . '/admin/js/admin.dev.js' );
	
	if ( isset( $_GET['tab'] ) && in_array( $_GET['tab'], array( 'display', 'colours' ) ) )
		wp_enqueue_script( 'farbtastic' );
}


/**
 * Allow users with 'edit_theme_options' capability to be able to modify the theme's options
 */
function mgraphene_options_page_capability( $cap ){
	return apply_filters( 'mgraphene_options_page_capability', 'edit_theme_options' );
}
add_filter( 'option_page_capability_graphene_options', 'mgraphene_options_page_capability' );


/**
 * Add JavaScript for the theme's options page
*/
function mgraphene_options_js(){ 
    global $mgraphene_settings;
	
	$tab = 'general';
	if ( isset( $_GET['tab'] ) && in_array( $_GET['tab'], array( 'general', 'display', 'colours', 'advanced' ) ) ){ $tab = $_GET['tab']; }
	?>
	<script type="text/javascript">
	//<![CDATA[
		var mgraphene_tab = '<?php echo $tab; ?>';
		var mgraphene_settings = <?php echo json_encode( $mgraphene_settings ); ?>;
		var mgraphene_uri = '<?php echo MGRAPHENE_ROOTURI; ?>';
	//]]>
	</script>
	<?php
}


/**
 * Admin footer
 */
function mgraphene_admin_footer(){
	global $mgraphene_settings;
	add_action( 'admin_footer-' . $mgraphene_settings['hook_suffix'], 'mgraphene_options_js' );
}
add_action( 'admin_menu', 'mgraphene_admin_footer' );


/**
 * Function that generate the tabs in the theme's options page
*/
if ( ! function_exists('mgraphene_options_tabs')) :
function mgraphene_options_tabs( $current = 'general', $tabs = array( 'general' => 'General' ) ){
	$links = array();
	foreach( $tabs as $tab => $name) :
		if ( $tab == $current ) :
			$links[] = "<a class='nav-tab nav-tab-active' href='?page=mgraphene_options&amp;tab=$tab'>$name</a>";
		else :
			$links[] = "<a class='nav-tab' href='?page=mgraphene_options&amp;tab=$tab'>$name</a>";
		endif;
	endforeach;
	
	echo '<h3 class="options-tab">';
	foreach ($links as $link)
		echo $link;
	echo '<a class="toggle-all" href="#">' . __( 'Toggle all tabs', 'graphene' ) . '</a>';
	echo '</h3>';
}
endif;


/**
 * Output the options content
 *
 * @param string $tab The slug of the option tab to display
 *
 * @package Graphene Mobile
 * @since Graphene Mobile 1.2
 */
if ( ! function_exists( 'mgraphene_options_tabs_content' ) ) :
function mgraphene_options_tabs_content( $tab ){
	require( MGRAPHENE_ROOTDIR . '/admin/options-' . $tab . '.php' );
	call_user_func( 'mgraphene_options_' . $tab );
}
endif;