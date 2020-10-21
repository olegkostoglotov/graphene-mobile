<?php 
require_once( MGRAPHENE_ROOTDIR . '/includes/theme-menus-dropdown.php' );

/**
 * Define the callback menu, if there is no custom menu.
 * This menu automatically lists all Pages as menu items, including their
 * direct descendant, which will only be displayed for the current parent.
*/
if (!function_exists('mgraphene_default_menu')) :

function mgraphene_default_menu(){ 
	global $mgraphene_settings;
	if ( $mgraphene_settings['header_menu_use_select'] ) :
	?>
    	<select class="menu clearfix dropdown-menu" id="header-menu">
        	<option class="blank" value="" <?php selected( is_front_page(), true ); ?>>&mdash; <?php _e( 'Browse', 'mgraphene' ); ?> &mdash;</option>
            <option class="home" value="<?php echo home_url(); ?>"><?php _e( 'Home', 'mgraphene' ); ?></option>
            <?php 
				$args = array(
							'walker'	=> new Mgraphene_Walker_Page(),
							'title_li'	=> '',
						);
				wp_list_pages( $args );
			?>
        </select>
        
    <?php else : ?>
    
        <ul id="header-menu" class="menu clearfix">
            <?php do_action( 'mgraphene_default_menu_before' ); ?>
        
            <?php if (get_option('show_on_front') == 'posts') : ?>
            <li <?php if ( is_single() || is_front_page()) { echo 'class="current_page_item"'; } ?>><a href="<?php echo get_home_url(); ?>"><?php _e('Home','mgraphene'); ?></a></li>
            <?php endif; ?>
            <?php 
                $args = array(
                            'echo' => 1,
                            'sort_column' => 'menu_order, post_title',
                            'depth' => 1,
                            'title_li' => ''
                        );
            wp_list_pages( apply_filters( 'mgraphene_default_menu_args', $args ) );
            ?>
            
            <?php do_action( 'mgraphene_default_menu_after' ); ?>
        </ul>
	<?php endif;
    do_action('mgraphene_default_menu');
} 

endif;


/*
 * Adds a menu-item-ancestor class to menu items with children for styling.
 * Code taken from the Menu-item-ancestor plugin by Valentinas Bakaitis
*/
function mgraphene_add_ancestor_class( $classlist, $item){
	global $wp_query, $wpdb;

	$id = get_post_meta( $item->ID, '_menu_item_object_id', true);
	$children = $wpdb->get_var( 'SELECT post_id FROM '.$wpdb->postmeta.' WHERE meta_key like "_menu_item_menu_item_parent" AND meta_value='.$item->ID.' LIMIT 1' );
	if( $children > 0)
		$classlist[] = 'menu-item-ancestor';
	return $classlist;
}
add_filter( 'nav_menu_css_class', 'mgraphene_add_ancestor_class', 2, 10);