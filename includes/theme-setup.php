<?php
global $content_width;
if ( ! isset( $content_width ))
	$content_width = apply_filters( 'mgraphene_content_width', 520 );	// 785 divided by 1.5


if (!function_exists( 'mgraphene_setup' )):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function mgraphene_setup() {
	global $mgraphene_settings;
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'mgraphene', get_template_directory() . '/languages' );
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'mgraphene-header-menu' => __( 'Graphene Mobile Header Menu', 'mgraphene' ),
		'mgraphene-footer-menu' => __( 'Graphene Mobile Footer Menu', 'mgraphene' ),
	) );
	
	// Add custom image sizes
	add_image_size( 'mgraphene-single', apply_filters( 'mgraphene_single_width', 720 ), apply_filters( 'mgraphene_single_height', 300 ), true );

    do_action( 'mgraphene_setup' );
}
endif;
add_action( 'after_setup_theme', 'mgraphene_setup', 11 );


/**
 * Register widgetized areas
 */
function mgraphene_widgets_init() {
	if ( function_exists( 'register_sidebar' ) ) {
		global $mgraphene_settings;
		
		register_sidebar( array( 'name' => __( 'Graphene Mobile Header', 'mgraphene' ),
			'id' => 'mgraphene-header-widget-area',
			'description' => __( 'This widget area will be displayed before the content, but after the header and navigation.', 'graphene' ),
			'before_widget' => '<div id="%1$s" class="post-list-wrap widget-area-wrap clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="post-list-title"><span>',
			'after_title' => '</span></h3><div class="bottom-shadow"></div>',
		) );
		
		register_sidebar( array( 'name' => __( 'Graphene Mobile Footer', 'mgraphene' ),
			'id' => 'mgraphene-footer-widget-area',
			'description' => __( 'This widget area will be displayed after the content, but before the footer.', 'graphene' ),
			'before_widget' => '<div id="%1$s" class="post-list-wrap widget-area-wrap clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="post-list-title"><span>',
			'after_title' => '</span></h3><div class="bottom-shadow"></div>',
		) );
		
		/* Action hooks widget areas */
		if ( count( $mgraphene_settings['widget_hooks'] ) > 0 ) {
			$available_hooks = mgraphene_get_action_hooks( true );
			
			foreach ( $mgraphene_settings['widget_hooks'] as $hook ) {
				if ( in_array( $hook, $available_hooks ) ) {
					register_sidebar( array(
						'name' => ucwords( str_replace( 'mgraphene', 'Graphene Mobile', str_replace( '_', ' ', $hook ) ) ),
						'id' => $hook,
						'description' => sprintf( __("Dynamically added widget area. This widget area is attached to the %s action hook.", 'mgraphene'), "'$hook'" ),
						'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
						'after_widget' => '</div>',
						'before_title' => "<h3>",
						'after_title' => "</h3>",
					));
					// to display the widget dynamically attach the dynamic method
					add_action( $hook, 'mgraphene_display_dynamic_widget_hooks' );
				}
				
			}                    
		}
	}
}
add_action( 'widgets_init', 'mgraphene_widgets_init', 20 );


/**
 * Attach the footer widget area to the mgraphene_before_footer hook
*/
function mgraphene_footer_widgets(){
	if ( is_dynamic_sidebar( 'mgraphene-footer-widget-area' ) ) {
		echo '<div class="footer-widget-area widget-area">';
			do_action( 'mgraphene_footer_widgets_before' );

			dynamic_sidebar( 'mgraphene-footer-widget-area' );

			do_action( 'mgraphene_footer_widgets_after' );
		echo '</div>';
	}
}
add_action( 'mgraphene_footer_before', 'mgraphene_footer_widgets' );

/**
 * Attach the header widget area to the mgraphene_before_content hook
*/
function mgraphene_header_widgets(){
	if ( is_dynamic_sidebar( 'mgraphene-header-widget-area' ) ) {
		echo '<div class="header-widget-area widget-area">';
			do_action( 'mgraphene_header_widgets_before' );
			
			dynamic_sidebar( 'mgraphene-header-widget-area' );
			
			do_action( 'mgraphene_header_widgets_after' );
		echo '</div>';
	}
}
add_action( 'mgraphene_before_content', 'mgraphene_header_widgets' );


/**
 * Display a dynamic widget area, this is hooked to the user selected do_action() hooks available in Graphene.
 * @global array $mgraphene_settings 
 */
function mgraphene_display_dynamic_widget_hooks(){
    global $mgraphene_settings;
	
    // to find the current action
    $actionhook_id = current_filter();
    if ( in_array( $actionhook_id, $mgraphene_settings['widget_hooks'])  && is_active_sidebar( $actionhook_id ) ) : ?>
    <div class="mgraphene-dynamic-widget" id="mgraphene-dynamic-widget-<?php echo $actionhook_id; ?>">
        <?php dynamic_sidebar( $actionhook_id ); ?>
    </div>
    <?php endif;
}