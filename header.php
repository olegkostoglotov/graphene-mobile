<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section. Unclosed elements: body, #container
 */
global $mgraphene_settings;
?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php mgraphene_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1<?php if ( ! $mgraphene_settings['allow_zoom'] ) { echo ', maximum-scale=1'; } ?>" />
    
    <?php wp_head(); ?>

</head><?php flush(); ?>

<body <?php body_class(); ?>>
	<div id="container">
    	
        <?php do_action( 'mgraphene_header_before' ); ?>
            
		<div id="header">
        	<?php do_action( 'mgraphene_header_top' ); ?>
            
            <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php mgraphene_bloginfo( 'name' ); ?></a></h1>
            <?php if ( $site_desc = mgraphene_get_bloginfo( 'description' ) ) : ?>
	            <h2 class="site-desc"><?php echo $site_desc; ?></h2>
            <?php endif; ?>
            
            <?php do_action( 'mgraphene_header_bottom' ); ?>
		</div>
        
        <div class="bottom-shadow">&nbsp;</div>
        
        <?php do_action( 'mgraphene_nav_before' ); ?>
        
        <div id="nav">
        	<?php do_action( 'mgraphene_nav_top' ); ?>
            
            <?php /* Header menu */
				$args = array(
					'container'			=> '',
					'menu_id'			=> 'header-menu',
					'menu_class' 		=> 'menu clearfix',
					'fallback_cb' 		=> 'mgraphene_default_menu',
					'depth' 			=> 2,
					'theme_location'	=> 'mgraphene-header-menu',
				);
				
				if ( $mgraphene_settings['header_menu_use_select'] ) {
					$args['depth'] = 0;
					mgraphene_dropdown_menu( apply_filters( 'mgraphene_header_menu_args', $args ) );
				} else {
					wp_nav_menu( apply_filters( 'mgraphene_header_menu_args', $args ) );
				}
			?>
            
            <?php do_action( 'mgraphene_nav_bottom' ); ?>
        </div><!-- #nav -->
        
        <?php do_action( 'mgraphene_nav_after' ); ?>
        
        <div class="bottom-shadow">&nbsp;</div>
        
        <?php if ( ! $mgraphene_settings['disable_search_bar'] ) : ?>
			<?php do_action( 'mgraphene_top_search_before' ); ?>
            <div id="top-search">
                <?php 
                    do_action( 'mgraphene_top_search_top' ); 
                    get_search_form();
                    do_action( 'mgraphene_top_search_bottom' );
                ?>
            </div><!-- #top-search -->
            <?php do_action( 'mgraphene_top_search_after' ); ?>
            <div class="bottom-shadow">&nbsp;</div>
        <?php endif; ?>
        
        <?php do_action( 'mgraphene_before_content' ); ?>