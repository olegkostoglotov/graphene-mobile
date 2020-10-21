<?php
/**
 * Check the currently installed version of WordPress
 *
 * @param string $version The version to check
 * @return bool True is WordPress version is equal to or greater than the passed version, false otherwise
 *
 * @package Graphene Mobile
 * @since 1.2
*/
if ( ! function_exists( 'mgraphene_is_wp_version' ) ) :

function mgraphene_is_wp_version( $is_ver = '' ) {

    $wp_ver = explode( '.', get_bloginfo( 'version' ) );
    $is_ver = explode( '.', $is_ver );
    for( $i=0; $i<=count( $is_ver ); $i++ )
        if( !isset( $wp_ver[$i] ) ) array_push( $wp_ver, 0 );
 
    foreach( $is_ver as $i => $is_val )
        if( $wp_ver[$i] < $is_val ) return false;
    return true;
}

endif;


/**
 * Gets all action hooks available in the Graphene Mobile theme.
 * @param boolean $hooksonly
 * @return array 
 *
 * @package Graphene Mobile
 * @since 1.2
 */
function mgraphene_get_action_hooks( $hooksonly = false ) {    

	if ( isset( $_GET['rescan_hooks'] ) && $_GET['rescan_hooks'] == 'true' ){
		delete_transient( 'mgraphene-action-hooks-list' );
		delete_transient( 'mgraphene-action-hooks' );
	}
	
	// Get the cached action hooks list, if available
	if ( $hooksonly )
		$hooks = get_transient( 'mgraphene-action-hooks-list' );
	else
		$hooks = get_transient( 'mgraphene-action-hooks' );
		
	if ( $hooks ) 
		return $hooks;
	else
		$hooks = array();
	
    // as all the hooks are defined in php files get a list of the themes php files
    $files = @glob( MGRAPHENE_ROOTDIR . "/*.php" );
	$files = array_merge( $files, @glob( MGRAPHENE_ROOTDIR . "/includes/*.php" ) );

    if ( $files !== false ) {
        foreach ( $files as $file ) {

            // read the file and scan it's contents for do_action();
            $content = file( $file );
			$content = implode( '', $content );
			
            if ($content !== false) {
                if (preg_match_all("/do_action\([ ]*'(mgraphene_[^']*)'[ ]*\)/", $content, $matches) > 0) {
					$matches = array_unique( $matches[1] );
                    if ( $hooksonly ){ $hooks = array_merge( $hooks, $matches ); }
                    else {
						$filename = basename( $file );
						if ( stripos( $filename, 'theme-' ) === 0 ) { $filename = 'includes/' . $filename; }
						$hooks[] = array( 'file' => $filename, 'hooks' => $matches );
					}
                }                                
            }
        }
    }
	
	// Cache the found action hooks as WordPress transients
	if ( $hooksonly )
		set_transient( 'mgraphene-action-hooks-list', $hooks, 60*60*24 );
	else
		set_transient( 'mgraphene-action-hooks', $hooks, 60*60*24 );
		
    return $hooks;
}


if ( ! function_exists( 'mgraphene_manual_switcher' ) ) :
/**
 * Display the manual switcher link if enabled
 */
function mgraphene_manual_switcher(){
	global $mobile_smart, $mgraphene_settings;
	if ( $mobile_smart ) {
		$opts = get_option( $mobile_smart->admin_optionsName, '' );
		if ( $opts && $opts['enable_manual_switch'] ) {
			printf( '<a href="%1$s" rel="nofollow" class="switcher">%2$s</a>', 
						$mobile_smart->get_switcherLink(MOBILESMART_SWITCHER_DESKTOP_STR), 
						__( 'Switch to desktop version', 'mgraphene' ) );
		}
	} elseif ( function_exists( 'amtsp_start' ) && ! $mgraphene_settings['hide_amts_manual_switcher'] ) {
		echo do_shortcode( '[show_theme_switch_link]' );
	}
}
endif;