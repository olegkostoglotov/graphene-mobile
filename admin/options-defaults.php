<?php
/**
 * Set the default values for all the settings. If no user-defined values
 * is available for any setting, these defaults will be used.
 */
$mgraphene_defaults = array(
	/* Theme's DB version */
	'db_version' => '1.0',
	
	/* API Key */
	'api_key' => '',
	
/* General Options Page */
	
	/* Front page options */
	'frontpage_full_post_count' => 1,
	'frontpage_show_cats' => '',
	'frontpage_cats' => array( '1' ),
	'frontpage_cats_numposts' => 5,
	
	/* Comment options */
    'comments_setting' => 'wordpress', // wordpress | disabled_pages | disabled_completely
	
	/* Child page options */    
    'hide_parent_content_if_empty' => false,
    'child_page_listing' => 'show_always', // hide | show_always | show_if_parent_empty
	
	/* Google Analytics options */
	'show_ga' => false,
	'ga_code' => '',
	
	/* Footer options */
	'copy_text' => '',
	'hide_copyright' => false,
	'hide_return_top' => false,
	
	/* Miscellaneous settings */
	'allow_zoom' => false,
	
/* Display Options Page */
	
	// Header options
	'alt_site_title' => '',
	'alt_site_desc' => '',
	'disable_search_bar'	=> false,
	
	/* Navigation Menu options */
	'header_menu_use_select'	=> false,
	'footer_menu_use_select'	=> false,
	
	/* Posts Display options */
	'hide_post_meta' => false,
	'hide_post_commentcount' => false,
	'hide_post_cat' => false,
	'hide_post_tags' => false,
	'hide_post_image' => false,
	
	/* Excerpt options */
	'excerpt_html_tags' 		=> '',
	
	// Background options
	'bg_imgurl' => '',
	'bg_position' => 'left top', // left top | center top | right top
	'bg_repeat' => 'repeat', // no-repeat | repeat | repeat-x | repeat-y
	'bg_attachment' => 'scroll', // scroll | fixed
	'bg_colour' => '#',
	
	// Header colour Options
	'header_top' => '#012b4c',
	'header_bottom' => '#0e395d',
	'header_title' => '#fff',
	'header_desc' => '#fff',
	'nav_bg' => '#253b4b',
	'nav_bg_current' => '#155687',
	'nav_text' => '#daecf7',
	'nav_text_current' => '#daecf7',
	
	// Footer colour options
	'copyright_bg' => '#1b2a35',
	'copyright_text' => '#bbb',
	'footer_menu_text' => '#cbdeee',
	'credit_bg' => '#022845',
	'credit_text' => '#8bb2d1',
	'credit_link_text' => '#fff',
	
	// Content colour options
	'content_title_bg' => '#053255',
	'content_title_text' => '#c2d4df',
	'content_meta_text' => '#608ba7',
	'content_cat_bg' => '#ddd',
	'content_cat_text' => '#222',
	'content_cat_link_bg' => '#444',
	'content_cat_link_text' => '#ddd',
	'content_bg' => '#fff',
	'content_text' => '#222',
	'content_link' => '#0a61a4',
	'content_pages_bg' => '#eee',
	'content_pages_text' => '#222',
	'content_pages_link' => '#0a61a4',
	'content_tag_bg' => '#053255',
	'content_tag_text' => '#ccc',
	'content_tag_link_bg' => '#8299aa',
	'content_tag_link_text' => '#053255',
	'content_nav_bg' => '#e5e5e5',
	'content_nav_next_bg' => '#d9d9d9',
	'content_nav_text' => '#616262',
	'content_nav_link' => '#012b4b',
	
	// Other sections colour options
	'section_title_bg_top' => '#084C81',
	'section_title_bg_bottom' => '#064575',
	'section_title_text' => '#FFFFFF',
	'section_bg' => '#FFFFFF',
	'section_text' => '#6A6A6A',
	'section_link' => '#0A61A4',
	'section_list_border' => '#D6D6D6',
	'section_nav_bg' => '#053255',
	'section_nav_text' => '#E5E5E5',
	
	// Comments section colour options
	'comments_title_bg_top' => '#084C81',
	'comments_title_bg_bottom' => '#064575',
	'comments_title_divider' => '#053255',
	'comments_title_text' => '#FFFFFF',
	'comments_reply_bg' => '#20303C',
	'comments_reply_text' => '#FFFFFF',
	'comments_meta_text' => '#7B7B7B',
	'comments_bg' => '#EEEEEE',
	'comments_text' => '#444444',
	'comments_link' => '#0A61A4',
	'comments_list_border' => '#B3B3B3',
	
	// Miscellaneous settings
	'custom_site_title_frontpage' => '',
	'custom_site_title_content' => '',
	'favicon_url' => '',
	'custom_css' => '',
	
	/* Advanced options */
	'widget_hooks' 				=> array(),
	'head_tags'					=> '',
	
	// The theme's root path
	'theme_root' => dirname( dirname( __FILE__ ) ),
);
?>