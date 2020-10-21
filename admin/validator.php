<?php
/**
 * Settings Validator
 * 
 * This file defines the function that validates the theme's options
 * upon submission.
*/
function mgraphene_settings_validator( $input ){
	
	global $mgraphene_options_validated;
	if ( $mgraphene_options_validated == true ) return $input;
	
	global $mgraphene_defaults, $allowedposttags;
	
	// Add <script> tag to the allowed tags in code
	$allowedposttags = array_merge( $allowedposttags, array( 'script' => array( 'type' => array(), 'src' => array() ) ) );
	
	if ( isset( $_POST['mgraphene_general'] ) ) {
	
		/* =API Key
		--------------------------------------------------------------------------------------*/
		$input['api_key'] = trim( $input['api_key'] );
		if ( ! empty( $input['api_key'] ) ) {
			if ( ! ctype_alnum( $input['api_key'] ) || strlen( $input['api_key'] ) != 32 ) {
				unset( $input['api_key'] );
				add_settings_error( 'mgraphene_options', 2, 'ERROR: Invalid API Key inserted.' );
			}
		}
		
		/* =Front Page Options 
		--------------------------------------------------------------------------------------*/
		$input = mgraphene_validate_digits( $input, 'frontpage_full_post_count', 'ERROR: The value for the number of posts to show with excerpt in front page must be an integer.' );
		$input = mgraphene_validate_dropdown( $input, 'frontpage_show_cats', array( '', 'all', 'selected' ), 'ERROR: Invalid option selected for the "Display recent posts by category" option.' );
		$input = mgraphene_validate_digits( $input, 'frontpage_cats_numposts', 'ERROR: The value for the number of posts to show per category must be an integer.' );
		
		/* =Comments Options
		--------------------------------------------------------------------------------------*/		
		$input = mgraphene_validate_dropdown( $input, 'comments_setting', array( 'wordpress', 'disabled_pages', 'disabled_completely' ), __( 'ERROR: Invalid option for the comments option.', 'mgraphene' ) );
		
		/* =Child Page Options
		--------------------------------------------------------------------------------------*/		
		$input['hide_parent_content_if_empty'] = ( isset( $input['hide_parent_content_if_empty'] ) ) ? true : false;                        
		$input = mgraphene_validate_dropdown( $input, 'child_page_listing', array( 'hide', 'show_always', 'show_if_parent_empty' ), __( 'ERROR: Invalid option for the child page listings.', 'mgraphene' ) );
		
		/* =Google Analytics Options
		--------------------------------------------------------------------------------------*/
		$input['show_ga'] = ( isset( $input['show_ga'] ) ) ? true : false;
		$input['ga_code'] = wp_kses_post( $input['ga_code'] );
		
		/* =Footer Options
		--------------------------------------------------------------------------------------*/
		$input['copy_text'] = wp_kses_post ( $input['copy_text'] );
		$input['hide_copyright'] = ( isset( $input['hide_copyright'] ) ) ? true : false;
		$input['hide_return_top'] = ( isset( $input['hide_return_top'] ) ) ? true : false;
		
		/* =Miscellaneous General Options
		--------------------------------------------------------------------------------------*/
		$input['allow_zoom'] = ( isset( $input['allow_zoom'] ) ) ? true : false;
		
	
	} // End the General options
	
	
	if ( isset( $_POST['mgraphene_display'] ) ) { 
	
		/* =Header Options 
		--------------------------------------------------------------------------------------*/
		$input['alt_site_title'] = wp_kses_post( $input['alt_site_title'] );
		$input['alt_site_desc'] = wp_kses_post( $input['alt_site_desc'] );
		$input['disable_search_bar'] = ( isset( $input['disable_search_bar'] ) ) ? true : false;
		
		/* =Navigation Menu Options
		--------------------------------------------------------------------------------------*/                        
		$input['header_menu_use_select'] = ( isset( $input['header_menu_use_select'] ) ) ? true : false;
		$input['footer_menu_use_select'] = ( isset( $input['footer_menu_use_select'] ) ) ? true : false;
		
		/* =Post Display Options
		--------------------------------------------------------------------------------------*/                        
		$input['hide_post_meta'] = ( isset( $input['hide_post_meta'] ) ) ? true : false;
		$input['hide_post_cat'] = ( isset( $input['hide_post_cat'] ) ) ? true : false;
		$input['hide_post_tags'] = ( isset( $input['hide_post_tags'] ) ) ? true : false;
		$input['hide_post_commentcount'] = ( isset( $input['hide_post_commentcount'] ) ) ? true : false;
		$input['hide_post_image'] = ( isset( $input['hide_post_image'] ) ) ? true : false;
		
		/* =Excerpts Display Options
		--------------------------------------------------------------------------------------*/     
		$input['archive_full_content'] = ( isset( $input['archive_full_content'] ) ) ? true : false;
		
		/* =Custom Background Options
		--------------------------------------------------------------------------------------*/
		$input = mgraphene_validate_url( $input, 'bg_imgurl', __( 'ERROR: Bad URL entered for the background image.', 'mgraphene' ) );
		$input = mgraphene_validate_dropdown( $input, 'bg_position', array( 'left top', 'center top', 'right top' ), __( 'ERROR: Invalid option for the background position.', 'mgraphene' ) );
		$input = mgraphene_validate_dropdown( $input, 'bg_repeat', array( 'no-repeat', 'repeat', 'repeat-x', 'repeat-y' ), __( 'ERROR: Invalid option for the background repeat.', 'mgraphene' ) );
		$input = mgraphene_validate_dropdown( $input, 'bg_attachment', array( 'scroll', 'fixed' ), __( 'ERROR: Invalid option for the background attachment.', 'mgraphene' ) );
		if ( empty( $input['bg_colour'] ) ) $input['bg_colour'] = $mgraphene_defaults['bg_colour'];
		
		/* =Miscellaneous Options 
		--------------------------------------------------------------------------------------*/
		$input['custom_site_title_frontpage'] = strip_tags( $input['custom_site_title_frontpage'] );
		$input['custom_site_title_content'] = strip_tags( $input['custom_site_title_content'] );
		$input = mgraphene_validate_url( $input, 'favicon_url', __( 'ERROR: Bad URL entered for the favicon URL.', 'mgraphene' ) );
		
		/* =Custom CSS Options 
		--------------------------------------------------------------------------------------*/
		$input['custom_css'] = strip_tags( $input['custom_css'] );
	
	} // End the Display options
	
	
	if ( isset( $_POST['mgraphene_colours'] ) ) {
		$input = mgraphene_validate_colours( $input );
	} // Ends the Colours options
	
	if ( isset( $_POST['mgraphene_advanced'] ) ) {
		
		$input['head_tags'] = trim( $input['head_tags'] );
			
		if ( isset( $input['widget_hooks'] ) && is_array( $input['widget_hooks'] ) ) {
			if ( ! ( array_intersect( $input['widget_hooks'], mgraphene_get_action_hooks( true ) ) === $input['widget_hooks'] ) ) {
				unset( $input['widget_hooks'] );
				add_settings_error( 'mgraphene_options', 2, __( 'ERROR: Invalid action hook selected widget action hooks.', 'mgraphene' ) );
			}
		} else {
			$input['widget_hooks'] = $mgraphene_defaults['widget_hooks'];
		}
	} // Ends the Advanced options
	
	$mgraphene_options_validated = true;
		
	// Merge the new settings with the previous one (if exists) before saving
	$input = array_merge( get_option('mgraphene_settings', array() ), (array) $input );
	
	/* Only save options that have different values than the default values */
	foreach ( $input as $key => $value ){
		if ( ( $mgraphene_defaults[$key] === $value || $value === '' ) )
			unset( $input[$key] );
	}

	if ( $input ) {
		$input = array_merge( array( 'db_version' => $mgraphene_defaults['db_version'] ), $input );
	} else {
		delete_option( 'mgraphene_settings' );
		return false;
	}
	
	return $input;	
}

/**
 * Define the data validation functions
*/
function mgraphene_validate_digits( $input, $option_name, $error_message ){
	global $mgraphene_defaults;
	if ( '0' === $input[$option_name] || ! empty( $input[$option_name] ) ){
		if (!ctype_digit( $input[$option_name] ) ) {
			$input[$option_name] = $mgraphene_defaults[$option_name];
			add_settings_error('mgraphene_options', 2, $error_message);
		}
	} else {
		$input[$option_name] = $mgraphene_defaults[$option_name];
	}
	
	return $input;
}

function mgraphene_validate_dropdown( $input, $option_name, $possible_values, $error_message ){
	
	if ( isset( $input[$option_name] ) && !in_array( $input[$option_name], $possible_values) ){
		unset( $input[$option_name] );
		add_settings_error('mgraphene_options', 2, $error_message);
	}
	return $input;
	
}

function mgraphene_validate_url( $input, $option_name, $error_message ) {
	global $mgraphene_defaults;
	if (!empty( $input[$option_name] ) ){
		$input[$option_name] = esc_url_raw( $input[$option_name] );
		if ( $input[$option_name] == '') {
			$input[$option_name] = $mgraphene_defaults[$option_name];
			add_settings_error('mgraphene_options', 2, $error_message);
		}	
	}	
	return $input;
	
}

function mgraphene_validate_colours( $options ) {
	global $mgraphene_defaults;
	foreach ( $options as $key => $option ){
		if ( $key == 'colour_preset' ) continue;
		if ( ! empty( $option ) ){
			if ( stripos( $option, '#' ) !== 0 ) {
				$options[$key] = '#' . $option;
			}	
		} else {
			$options[$key] = $mgraphene_defaults[$key];
		}
	}
	return $options;
}
?>