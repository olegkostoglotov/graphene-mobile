<?php
/**
 * Provides the functions to generate dropdown <select> menu.
 * Code by Robert O'Rourke @ interconnect/it (http://interconnectit.com)
 */
 

// useless without this
if ( ! function_exists( 'wp_nav_menu' ) )
	return false;


/**
 * Tack on the blank option for urls not in the menu
 */
add_filter( 'wp_nav_menu_items', 'dropdown_add_blank_item', 10, 2 );
function dropdown_add_blank_item( $items, $args ) {
	if ( isset( $args->walker ) && is_object( $args->walker ) && method_exists( $args->walker, 'is_dropdown' ) ) {
		if ( ( ! isset( $args->menu ) || empty( $args->menu ) ) && isset( $args->theme_location ) ) {
			$theme_locations = get_nav_menu_locations();
			$args->menu = wp_get_nav_menu_object( $theme_locations[ $args->theme_location ] );
		}
		$title = isset( $args->dropdown_title ) ? wptexturize( $args->dropdown_title ) : '&mdash; ' . $args->menu->name . ' &mdash;';
		if ( ! empty( $title ) )
			$items = '<option value="" class="blank">' . apply_filters( 'dropdown_blank_item_text', '&mdash; ' . __( 'Browse', 'mgraphene' ) . ' &mdash;', $args ) . '</option>' . $items;
	}
	return $items;
}


/**
 * Remove empty options created in the sub levels output
 */
add_filter( 'wp_nav_menu_items', 'dropdown_remove_empty_items', 10, 2 );
function dropdown_remove_empty_items( $items, $args ) {
	if ( isset( $args->walker ) && is_object( $args->walker ) && method_exists( $args->walker, 'is_dropdown' ) )
		$items = str_replace( "<option></option>", "", $items );
	return $items;
}


/**
 * Overrides the walker argument and container argument then calls wp_nav_menu
 */
function mgraphene_dropdown_menu( $args ) {
	// if non array supplied use as theme location
	if ( ! is_array( $args ) )
		$args = array( 'menu' => $args );

	// enforce these arguments so it actually works
	$args[ 'walker' ] = new DropDown_Nav_Menu();
	$args[ 'items_wrap' ] = '<select id="%1$s" class="%2$s ' . apply_filters( 'mgraphene_dropdown_menus_class', 'dropdown-menu' ) . '">%3$s</select>';

	// custom args for controlling indentation of sub menu items
	$args[ 'indent_string' ] = isset( $args[ 'indent_string' ] ) ? $args[ 'indent_string' ] : '&ndash;&nbsp;';
	$args[ 'indent_after' ] =  isset( $args[ 'indent_after' ] ) ? $args[ 'indent_after' ] : '';

	return wp_nav_menu( $args );
}


class DropDown_Nav_Menu extends Walker_Nav_Menu {

	// easy way to check it's this walker we're using to mod the output
	function is_dropdown() {
		return true;
	}

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth ) {
		$output .= "</option>";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth ) {
		$output .= "<option>";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'menu-item-depth-' . $depth;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_unique( array_filter( $classes ) ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		// select current item
		if ( apply_filters( 'mgraphene_dropdown_menus_select_current', true ) )
			$selected = in_array( 'current-menu-item', $classes ) ? ' selected="selected"' : '';

		$output .= $indent . '<option' . $class_names .' value="'. $item->url .'"'. $selected .'>';

		// push sub-menu items in as we can't nest optgroups
		$indent_string = str_repeat( apply_filters( 'mgraphene_dropdown_menus_indent_string', $args->indent_string, $item, $depth, $args ), ( $depth ) ? $depth : 0 );
		$indent_string .= !empty( $indent_string ) ? apply_filters( 'mgraphene_dropdown_menus_indent_after', $args->indent_after, $item, $depth, $args ) : '';

		$item_output = $args->before . $indent_string;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_dropdown_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth ) {
		$output .= apply_filters( 'walker_nav_menu_dropdown_end_el', "</option>\n", $item, $depth);
	}
}


class Mgraphene_Walker_Page extends Walker_Page {
    
    /**
     * Code exact copied from: wp-includes\post-template.php >> Walker_Page::start_el() 
     * @since 2.1.0
     */
	function start_el( &$output, $page, $depth, $args, $current_page = 0 ) {
		global $mgraphene_settings;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		extract( $args, EXTR_SKIP );
		$css_class = array('page_item', 'page-item-'.$page->ID);
		if ( ! empty( $current_page ) ) {
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
		}
		
		$selected = in_array( 'current_page_item', $css_class ) ? ' selected="selected"' : '';
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_unique( array_filter( $css_class ) ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		
		$output .= $indent . '<option' . $class_names .' value="'. get_permalink($page->ID) .'"'. $selected .'>';
		
		$indent_string = str_repeat( '&ndash; ', $depth );

		$item_output = $args->before . $indent_string;
		$item_output .= $args->link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $args->link_after;
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_dropdown_start_el', $item_output, $item, $depth, $args );
	}
	
	function end_el( &$output, $item, $depth ) {
		$output .= "</option>\n";
	}
}