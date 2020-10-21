<?php global $mgraphene_settings; do_action( 'mgraphene_loop_before' ); ?>

	<?php if ( mgraphene_should_show_parent() ) : ?>
        <div <?php post_class( array( 'entry' ) ); ?>>
            
			<?php do_action( 'mgraphene_loop_top' ); ?>
            
            <div class="entry-header">
            	<?php do_action( 'mgraphene_loop_header_top' ); ?>
            
                <?php /* The post title */ ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                
                <?php do_action( 'mgraphene_loop_header_bottom' ); ?>
            </div>
            
            <div class="top-shadow">&nbsp;</div>
                       
            <?php do_action( 'mgraphene_loop_thumbnail_before' ); ?>
            
            <?php /* The post thumbnail */ global $page;
			if ( ! $mgraphene_settings['hide_post_image'] && ( $page == 1 || empty( $page ) ) ) :
	            $post_thumbnail =  mgraphene_get_post_image( get_the_ID(), 'mgraphene-single', '', false, array( 'class' => 'entry-thumbnail-single aligncenter' ) );
    	        if ($post_thumbnail) : ?>
					<?php echo $post_thumbnail; ?>
        	    	<div class="bottom-shadow">&nbsp;</div>
            	<?php endif; ?> 
			<?php endif; ?>
            
            <?php do_action( 'mgraphene_loop_entry_before' ); ?>
                
            <div class="entry-wrap clearfix">
                
                <?php do_action( 'mgraphene_loop_entry_top' ); ?>
                
                <div class="entry-content">
                	<?php 
						do_action( 'mgraphene_loop_content_top' );
	                    the_content();
    					do_action( 'mgraphene_loop_content_bottom' );
					?>
                </div>
                
                <?php do_action( 'mgraphene_loop_page_links_before' ); ?>
                
                <div class="pages-links"><?php wp_link_pages(); ?></div>
                
                <?php do_action( 'mgraphene_loop_entry_bottom' ); ?>
                
            </div>
            
            <?php do_action( 'mgraphene_loop_bottom' ); ?>
            
        </div><!-- .entry -->
    <?php endif; ?>
    
    <?php /* List child pages, if any */ 
	if ( mgraphene_should_show_children() )
        get_template_part( 'loop', 'children' );
	?>
    
    <?php /* The comments */ 
    if ( mgraphene_should_show_comments( get_the_ID() ) ) {
        comments_template();
        mgraphene_add_comments_script();
    }
    ?>
    
<?php do_action( 'mgraphene_loop_after' ); ?>