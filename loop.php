<?php global $mgraphene_settings; do_action( 'mgraphene_loop_before' ); ?>

	<?php if ( mgraphene_should_show_parent() ) : ?>
        <div <?php post_class( array( 'entry' ) ); ?>>
            
			<?php do_action( 'mgraphene_loop_top' ); ?>
            
            <div class="entry-header">
            	<?php do_action( 'mgraphene_loop_header_top' ); ?>
            
                <?php /* The post title */ ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                <?php /* The post meta */
                if ( ! $is_page && ! $mgraphene_settings['hide_post_meta'] ) { ?>
                <div class="entry-meta">
                    <?php printf( __( '%1$s by %2$s', 'mgraphene' ), '<span class="post-list-date">' . get_the_date() . '</span>', '<span class="post-list-author">' . get_the_author() . '</span>' ); ?>
                </div>
                <?php } ?>
                
                <?php do_action( 'mgraphene_loop_header_bottom' ); ?>
            </div>
            
            <div class="top-shadow">&nbsp;</div>
            
            <?php do_action( 'mgraphene_loop_categories_before' ); ?>
            
            <?php /* The categories */ ?>
            <?php if ( ! $is_page && ! $mgraphene_settings['hide_post_cat'] ) : ?>
            <div class="entry-cats">
            	<?php do_action( 'mgraphene_loop_categories_top' ); ?>
                <p><?php _e( 'Categories:' . ' ', 'mgraphene' ); the_category( ' ' ); ?></p>
                <?php do_action( 'mgraphene_loop_categories_bottom' ); ?>
            </div>
            
            <div class="bottom-shadow">&nbsp;</div>
            <?php endif; ?>
            
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
                	<?php do_action( 'mgraphene_loop_content_top' ); ?>
                    <?php /* The content */
                    if ( is_singular() ) 
                        the_content();
                    else
                        the_excerpt();
                    ?>
                    <?php do_action( 'mgraphene_loop_content_bottom' ); ?>
                </div>
                
                <?php do_action( 'mgraphene_loop_page_links_before' ); ?>
                
                <div class="pages-links"><?php wp_link_pages(); ?></div>
                
                <?php do_action( 'mgraphene_loop_entry_bottom' ); ?>
                
            </div>
            
            <?php do_action( 'mgraphene_loop_tags_before' ); ?>
            
            <?php /* The tags */ ?>
            <?php if ( ! $is_page && ! $mgraphene_settings['hide_post_tags'] && get_the_tags() ) : ?>
            <div class="top-shadow">&nbsp;</div>
            
            <div class="entry-tags">
            	<?php do_action( 'mgraphene_loop_tags_top' ); ?>
                <p><?php the_tags( __( 'Tags:' . ' ', 'mgraphene' ), ' ' ); ?></p>
                <?php do_action( 'mgraphene_loop_tags_bottom' ); ?>
            </div>
            
            <div class="top-shadow">&nbsp;</div>
            <?php endif; ?>
            
            <?php do_action( 'mgraphene_loop_tags_after' ); ?>
            
            <?php /* The post navigation */ 
            if ( ! $is_page ) { mgraphene_post_nav(); } ?>
            
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