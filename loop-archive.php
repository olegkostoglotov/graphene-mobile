<?php global $mgraphene_settings; do_action( 'mgraphene_loop_archive_top' ); ?>
	<div <?php post_class( array( 'entry-wrap', 'clearfix' ) ); ?>>
        
        <?php do_action( 'mgraphene_loop_archive_entry_top' ); ?>
        
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        
        <?php do_action( 'mgraphene_loop_archive_content_before' ); ?>
        
        <div class="entry-content clearfix">
        	<?php do_action( 'mgraphene_loop_archive_content_top' ); ?>
            
			<?php 
				if ( $mgraphene_settings['archive_full_content'] )
					the_content();
				else
					the_excerpt();
			?>
            
            <?php do_action( 'mgraphene_loop_archive_content_bottom' ); ?>
        </div>
        
        <?php do_action( 'mgraphene_loop_archive_footer_before' ); ?>
        
        <div class="entry-footer">
        	<?php if ( comments_open( get_the_ID() ) && mgraphene_should_show_comments() && ! $mgraphene_settings['hide_post_commentcount'] ) : ?>
            	<p class="comment-link"><a href="<?php comments_link(); ?>"><?php mgraphene_comment_count( 'comments', __( 'No comment yet', 'mgraphene' ) ); ?></a></p>
            <?php endif; ?>
            <p class="view-link">
            <?php /* The view post link. Will automatically use the post type's singular name, e.g. "View Post" or "View Page" */ 
			$post_type = get_post_type_object( get_post_type() );
			$post_type = $post_type->labels->singular_name;
			?>
            <a href="<?php the_permalink(); ?>"><?php printf( __( 'View %s', 'mgraphene' ), $post_type ); ?> &raquo;</a>
</p>
        </div>
        
        <?php do_action( 'mgraphene_loop_archive_entry_bottom' ); ?>
        
    </div>
<?php do_action( 'mgraphene_loop_archive_bottom' ); ?>    