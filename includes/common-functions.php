<?php 
/**
 * Includes the theme's utility functions and shared shortcodes
 */
require_once( MGRAPHENE_ROOTDIR . '/includes/theme-utils.php' ); 
require_once( MGRAPHENE_ROOTDIR . '/includes/theme-shortcodes-shared.php' ); 
 
/**
 * Returns the site title and description for diplay in the header
*/
if ( ! function_exists( 'mgraphene_get_bloginfo' ) ) :

function mgraphene_get_bloginfo( $type = '' ){
	global $mgraphene_settings;
	
	if ( $type == 'name' )
		$html = ( $mgraphene_settings['alt_site_title'] ) ? $mgraphene_settings['alt_site_title'] : get_bloginfo( 'name' );
	elseif ( $type == 'description' )
		$html = ( $mgraphene_settings['alt_site_desc'] ) ? $mgraphene_settings['alt_site_desc'] : get_bloginfo( 'description' );
	else
		$html = false;
	
	return apply_filters( 'mgraphene_get_bloginfo', $html, $type );
}

endif;


/**
 * Prints the site title and description for diplay in the header
*/
if ( ! function_exists( 'mgraphene_bloginfo' ) ) :

function mgraphene_bloginfo( $type = '' ){
	echo mgraphene_get_bloginfo( $type );
}

endif;


/**
 * Prints out the content of a variable wrapped in <pre> elements.
 * For development and debugging use
*/
if ( ! function_exists( 'disect_it' ) ) :

function disect_it( $var = NULL, $exit = true, $comment = false ){
	if ( $var !== NULL ){
		if ( $comment ) { echo '<!--'; }
		echo '<pre>';
		print_r($var );
		echo '</pre>';
		if ( $comment ) {echo '-->';}
		if ( $exit ) {exit();}
	} else {
		echo '<strong>ERROR:</strong> You must pass a variable as argument to the <code>disect_it()</code> function.';	
	}
}

endif;


/**
 * Add customisable options CSS to the theme's options page
*/
function mgraphene_custom_css_options_page() {
	if ( strstr( $_SERVER["REQUEST_URI"], 'page=mgraphene_options&tab=colours' ) ) :

		global $mgraphene_settings, $mgraphene_defaults;
		
		$style = '';
		
		// Custom background
		$custom_bg = '';
		if ( $mgraphene_settings['bg_imgurl'] ) $custom_bg .= sprintf( '%s %s %s %s ', ' url(' . $mgraphene_settings['bg_imgurl'] . ')', $mgraphene_settings['bg_position'], $mgraphene_settings['bg_repeat'], $mgraphene_settings['bg_attachment'] );
		if ( $mgraphene_settings['bg_colour'] != $mgraphene_defaults['bg_colour'] ) $custom_bg .= $mgraphene_settings['bg_colour'];
		if ( $custom_bg ) $style .= "#mgraphene-bg-preview {background:$custom_bg}";
		
		// Header colour options
		$header = '';
		if ( $mgraphene_settings['header_top'] != $mgraphene_defaults['header_top'] || $mgraphene_settings['header_bottom'] != $mgraphene_defaults['header_bottom'] ) 
			$header .= '#header {
						background: ' . $mgraphene_settings['header_top'] . ';
						background: -moz-linear-gradient( ' . $mgraphene_settings['header_top'] . ', ' . $mgraphene_settings['header_bottom'] . ' );
						background: -webkit-gradient(linear, left top, left bottom, from(' . $mgraphene_settings['header_top'] . '), to(' . $mgraphene_settings['header_bottom'] . '));
						background: -webkit-linear-gradient( ' . $mgraphene_settings['header_top'] . ', ' . $mgraphene_settings['header_bottom'] . ' );
						background: linear-gradient( ' . $mgraphene_settings['header_top'] . ', ' . $mgraphene_settings['header_bottom'] . ' );
						}';
		if ( $mgraphene_settings['header_title'] != $mgraphene_defaults['header_title'] ) $header .= '.site-title a {color:' . $mgraphene_settings['header_title'] . '}';
		if ( $mgraphene_settings['header_desc'] != $mgraphene_defaults['header_desc'] ) $header .= '.mgraphene-header-preview .site-desc {color:' . $mgraphene_settings['header_desc'] . '}';
		if ( $mgraphene_settings['nav_bg'] != $mgraphene_defaults['nav_bg'] ) $header .= '#nav {background-color:' . $mgraphene_settings['nav_bg'] . '}';
		if ( $mgraphene_settings['nav_bg_current'] != $mgraphene_defaults['nav_bg_current'] ) $header .= '#header-menu li.current-menu-item a, #header-menu li.current-menu-ancestor a {background-color:' . $mgraphene_settings['nav_bg_current'] . '}';
		if ( $mgraphene_settings['nav_text'] != $mgraphene_defaults['nav_text'] ) $header .= '#header-menu li a {color:' . $mgraphene_settings['nav_text'] . '}';
		if ( $mgraphene_settings['nav_text_current'] != $mgraphene_defaults['nav_text_current'] ) $header .= '#header-menu li.current-menu-item a, #header-menu li.current-menu-ancestor > a {color:' . $mgraphene_settings['nav_text_current'] . '}';
		if ( $header ) $style .= $header;
		
		// Footer colour options
		$footer = '';
		if ( $mgraphene_settings['copyright_bg'] != $mgraphene_defaults['copyright_bg'] ) $footer .= '.footer-menu-wrap {background-color:' . $mgraphene_settings['copyright_bg'] . '}';
		if ( $mgraphene_settings['copyright_text'] != $mgraphene_defaults['copyright_text'] ) $footer .= '#mgraphene-footer p {color:' . $mgraphene_settings['copyright_text'] . '}';
		if ( $mgraphene_settings['footer_menu_text'] != $mgraphene_defaults['footer_menu_text'] ) $footer .= '#footer-menu a {color:' . $mgraphene_settings['footer_menu_text'] . '}';
		if ( $mgraphene_settings['credit_bg'] != $mgraphene_defaults['credit_bg'] ) $footer .= '#mgraphene-footer .credit {background-color:' . $mgraphene_settings['credit_bg'] . '}';
		if ( $mgraphene_settings['credit_text'] != $mgraphene_defaults['credit_text'] ) $footer .= '#mgraphene-footer .credit p {color:' . $mgraphene_settings['credit_text'] . '}';
		if ( $mgraphene_settings['credit_link_text'] != $mgraphene_defaults['credit_link_text'] ) $footer .= '#mgraphene-footer .credit a {color:' . $mgraphene_settings['credit_link_text'] . '}';
		if ( $footer ) $style .= $footer;
		
		// Content colour options (top half)
		$content = '';
		if ( $mgraphene_settings['content_title_bg'] != $mgraphene_defaults['content_title_bg'] ) $content .= '.entry-header {background-color:' . $mgraphene_settings['content_title_bg'] . '}';
		if ( $mgraphene_settings['content_title_text'] != $mgraphene_defaults['content_title_text'] ) $content .= '.entry-header a {color:' . $mgraphene_settings['content_title_text'] . '}';
		if ( $mgraphene_settings['content_meta_text'] != $mgraphene_defaults['content_meta_text'] ) $content .= '.entry-header .entry-meta {color:' . $mgraphene_settings['content_meta_text'] . '}';
		if ( $mgraphene_settings['content_cat_bg'] != $mgraphene_defaults['content_cat_bg'] ) $content .= '.entry-cats {background-color:' . $mgraphene_settings['content_cat_bg'] . '}';
		if ( $mgraphene_settings['content_cat_text'] != $mgraphene_defaults['content_cat_text'] ) $content .= '.entry-cats {color:' . $mgraphene_settings['content_cat_text'] . '}';
		if ( $mgraphene_settings['content_cat_link_bg'] != $mgraphene_defaults['content_cat_link_bg'] ) $content .= '.entry-cats a {background-color:' . $mgraphene_settings['content_cat_link_bg'] . '}';
		if ( $mgraphene_settings['content_cat_link_text'] != $mgraphene_defaults['content_cat_link_text'] ) $content .= '.entry-cats a {color:' . $mgraphene_settings['content_cat_link_text'] . '}';
		if ( $mgraphene_settings['content_bg'] != $mgraphene_defaults['content_bg'] ) $content .= '.entry {background-color:' . $mgraphene_settings['content_bg'] . '}';
		if ( $mgraphene_settings['content_text'] != $mgraphene_defaults['content_text'] ) $content .= '.entry-content p {color:' . $mgraphene_settings['content_text'] . '}';
		if ( $mgraphene_settings['content_link'] != $mgraphene_defaults['content_link'] ) $content .= '.entry-content a {color:' . $mgraphene_settings['content_link'] . '}';
		if ( $content ) $style .= $content;
		
		// Content colour options (bottom half)
		$content = '';
		if ( $mgraphene_settings['content_pages_bg'] != $mgraphene_defaults['content_pages_bg'] ) $content .= '.pages-links a {background-color:' . $mgraphene_settings['content_pages_bg'] . '}';
		if ( $mgraphene_settings['content_pages_text'] != $mgraphene_defaults['content_pages_text'] ) $content .= '.pages-links p {color:' . $mgraphene_settings['content_pages_text'] . '}';
		if ( $mgraphene_settings['content_pages_link'] != $mgraphene_defaults['content_pages_link'] ) $content .= '.pages-links a {color:' . $mgraphene_settings['content_pages_link'] . '}';
		if ( $mgraphene_settings['content_tag_bg'] != $mgraphene_defaults['content_tag_bg'] ) $content .= '.entry-tags {background-color:' . $mgraphene_settings['content_tag_bg'] . '}';
		if ( $mgraphene_settings['content_tag_text'] != $mgraphene_defaults['content_tag_text'] ) $content .= '.entry-tags p {color:' . $mgraphene_settings['content_tag_text'] . '}';
		if ( $mgraphene_settings['content_tag_link_bg'] != $mgraphene_defaults['content_tag_link_bg'] ) $content .= '.entry-tags a {background-color:' . $mgraphene_settings['content_tag_link_bg'] . '}';
		if ( $mgraphene_settings['content_tag_link_text'] != $mgraphene_defaults['content_tag_link_text'] ) $content .= '.entry-tags a {color:' . $mgraphene_settings['content_tag_link_text'] . '}';
		if ( $mgraphene_settings['content_nav_bg'] != $mgraphene_defaults['content_nav_bg'] ) $content .= '.post .entry-nav {background-color:' . $mgraphene_settings['content_nav_bg'] . '}';
		if ( $mgraphene_settings['content_nav_next_bg'] != $mgraphene_defaults['content_nav_next_bg'] ) $content .= '.post .entry-nav .next {background-color:' . $mgraphene_settings['content_nav_next_bg'] . '}';
		if ( $mgraphene_settings['content_nav_text'] != $mgraphene_defaults['content_nav_text'] ) $content .= '.entry-nav .post-title a {color:' . $mgraphene_settings['content_nav_text'] . '}';
		if ( $mgraphene_settings['content_nav_link'] != $mgraphene_defaults['content_nav_link'] ) $content .= '.entry-nav .post-link a {color:' . $mgraphene_settings['content_nav_link'] . '}';
		if ( $content ) $style .= $content;
		
		// Other sections colour options
		$content = '';
		if ( $mgraphene_settings['section_title_bg_top'] != $mgraphene_defaults['section_title_bg_top'] || $mgraphene_settings['section_title_bg_bottom'] != $mgraphene_defaults['section_title_bg_bottom'] ) 
			$content .= '.post-list-title {
						background: ' . $mgraphene_settings['section_title_bg_top'] . ';
						background: -moz-linear-gradient( ' . $mgraphene_settings['section_title_bg_top'] . ', ' . $mgraphene_settings['section_title_bg_bottom'] . ' );
						background: -webkit-gradient(linear, left top, left bottom, from(' . $mgraphene_settings['section_title_bg_top'] . '), to(' . $mgraphene_settings['section_title_bg_bottom'] . '));
						background: -webkit-linear-gradient( ' . $mgraphene_settings['section_title_bg_top'] . ', ' . $mgraphene_settings['section_title_bg_bottom'] . ' );
						background: linear-gradient( ' . $mgraphene_settings['section_title_bg_top'] . ', ' . $mgraphene_settings['section_title_bg_bottom'] . ' );
						}';
		if ( $mgraphene_settings['section_title_text'] != $mgraphene_defaults['section_title_text'] ) $content .= '.post-list-title, .post-list-wrap .post-list-title a {color:' . $mgraphene_settings['section_title_text'] . '}';
		if ( $mgraphene_settings['section_bg'] != $mgraphene_defaults['section_bg'] ) $content .= '.post-list-wrap {background-color:' . $mgraphene_settings['section_bg'] . '}';
		if ( $mgraphene_settings['section_text'] != $mgraphene_defaults['section_text'] ) $content .= '.wrap .post-list-content, .wrap .post-list-content li {color:' . $mgraphene_settings['section_text'] . '}';
		if ( $mgraphene_settings['section_link'] != $mgraphene_defaults['section_link'] ) $content .= '.post-list-wrap a {color:' . $mgraphene_settings['section_link'] . '}';
		if ( $mgraphene_settings['section_list_border'] != $mgraphene_defaults['section_list_border'] ) $content .= '.post-list-wrap li {border-color:' . $mgraphene_settings['section_list_border'] . '}';
		if ( $mgraphene_settings['section_nav_bg'] != $mgraphene_defaults['section_nav_bg'] ) $content .= '.mgraphene-sections-preview .posts-nav {background-color:' . $mgraphene_settings['section_nav_bg'] . '}';
		if ( $mgraphene_settings['section_nav_text'] != $mgraphene_defaults['section_nav_text'] ) $content .= '.mgraphene-sections-preview .posts-nav a {color:' . $mgraphene_settings['section_nav_text'] . '}';
		if ( $content ) $style .= $content;
		
		// Comments section colour options
		$content = '';
		if ( $mgraphene_settings['comments_title_bg_top'] != $mgraphene_defaults['comments_title_bg_top'] || $mgraphene_settings['comments_title_bg_bottom'] != $mgraphene_defaults['comments_title_bg_bottom'] ) 
			$content .= '.comments-wrap-header {
						background: ' . $mgraphene_settings['comments_title_bg_top'] . ';
						background: -moz-linear-gradient( ' . $mgraphene_settings['comments_title_bg_top'] . ', ' . $mgraphene_settings['comments_title_bg_bottom'] . ' );
						background: -webkit-gradient(linear, left top, left bottom, from(' . $mgraphene_settings['comments_title_bg_top'] . '), to(' . $mgraphene_settings['comments_title_bg_bottom'] . '));
						background: -webkit-linear-gradient( ' . $mgraphene_settings['comments_title_bg_top'] . ', ' . $mgraphene_settings['comments_title_bg_bottom'] . ' );
						background: linear-gradient( ' . $mgraphene_settings['comments_title_bg_top'] . ', ' . $mgraphene_settings['comments_title_bg_bottom'] . ' );
						}';
		if ( $mgraphene_settings['comments_title_text'] != $mgraphene_defaults['comments_title_text'] ) $content .= '.comments-wrap-header a {color:' . $mgraphene_settings['comments_title_text'] . '}';
		if ( $mgraphene_settings['comments_title_divider'] != $mgraphene_defaults['comments_title_divider'] ) $content .= '.comments-wrap-header .pings-count {border-color:' . $mgraphene_settings['comments_title_divider'] . '}';
		if ( $mgraphene_settings['comments_reply_bg'] != $mgraphene_defaults['comments_reply_bg'] ) $content .= '.comments-wrap .add-comment {background-color:' . $mgraphene_settings['comments_reply_bg'] . '}';
		if ( $mgraphene_settings['comments_reply_text'] != $mgraphene_defaults['comments_reply_text'] ) $content .= '.comments-wrap .add-comment a {color:' . $mgraphene_settings['comments_reply_text'] . '}';
		if ( $mgraphene_settings['comments_meta_text'] != $mgraphene_defaults['comments_meta_text'] ) $content .= '.wrap .comments-list .comment-meta {color:' . $mgraphene_settings['comments_meta_text'] . '}';
		if ( $mgraphene_settings['comments_bg'] != $mgraphene_defaults['comments_bg'] ) $content .= '.comments-wrap {background-color:' . $mgraphene_settings['comments_bg'] . '}';
		if ( $mgraphene_settings['comments_text'] != $mgraphene_defaults['comments_text'] ) $content .= '.wrap .comments-list .comment-entry {color:' . $mgraphene_settings['comments_text'] . '}';
		if ( $mgraphene_settings['comments_link'] != $mgraphene_defaults['comments_link'] ) $content .= '.comments-list a {color:' . $mgraphene_settings['comments_link'] . '}';
		if ( $mgraphene_settings['comments_list_border'] != $mgraphene_defaults['comments_list_border'] ) $content .= '.comments-list li {border-color:' . $mgraphene_settings['comments_list_border'] . '}';
		if ( $content ) $style .= $content;
		
		// Print the styles
		if ( $style ) echo '<style type="text/css">' . $style . '</style>';
	
	endif;
}	
add_action( 'admin_head', 'mgraphene_custom_css_options_page' );