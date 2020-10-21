<?php get_header(); global $mgraphene_settings; do_action( 'mgraphene_index_before' ); ?>

	<?php /* First, display just the first post in the list */ 
	$count = 1;
	$full_post_count = $mgraphene_settings['frontpage_full_post_count'];
	if ( have_posts() ) : while( have_posts() ) : the_post(); if ( $count <= $full_post_count ) :	?>

	<div class="entry post latest-post" id="post-<?php the_ID(); ?>">
        
        <div class="entry-wrap clearfix">
        
            <?php /* The post thumbnail */
				echo mgraphene_get_post_image( get_the_ID(), 'thumbnail', '', false,  array( 'class' => 'entry-thumbnail' ) );
			?>
            
            <?php /* The post title */ ?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        
            <?php /* The post meta */ if ( get_post_type() != 'page' && ! $mgraphene_settings['hide_post_meta'] ) : ?>
            <div class="entry-meta">
            
            	<?php /* translators: %1$s will be replaced by the post date, %2$s will be replaced by the post author's name */ ?>
            	<?php printf( __( '%1$s by %2$s', 'mgraphene' ), '<span class="entry-updated">' . get_the_date() . '</span>', '<span class="entry-author">' . get_the_author() . '</span>' ); ?>
                
                <?php do_action( 'mgraphene_index_entry_meta_bottom' ); ?>
            </div>
            <?php endif; ?>
            
            <?php do_action( 'mgraphene_index_entry_content_before' ); ?>
            
            <?php /* The post excerpt */ ?>
            <div class="entry-content">
            	<?php do_action( 'mgraphene_index_entry_content_top' ); ?>
                <?php the_excerpt(); ?>
                <?php do_action( 'mgraphene_index_entry_content_bottom' ); ?>
            </div>
            
            <?php do_action( 'mgraphene_index_entry_content_after' ); ?>
        </div>
        
        <?php do_action( 'mgraphene_index_entry_footer_before' ); ?>
        
        <div class="entry-footer">
        	<?php do_action( 'mgraphene_index_entry_footer_top' ); ?>
        
        	<?php if ( mgraphene_should_show_comments() ) : ?>
            <p class="comment-link">
                <a href="<?php comments_link(); ?> ">
                	<span class="comment-count"><?php mgraphene_comment_count( 'comments', __( 'No comment yet', 'mgraphene' ) ); ?></span> 
                    <?php if ( pings_open() ) : ?>
                    <span class="pingback-count"><?php mgraphene_comment_count( 'pings', __( 'No ping yet', 'mgraphene' ) ); ?></span>
                    <?php endif; ?>
                </a>
            </p>
            <?php endif; ?>
            
            <p class="read-more"><a href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'mgraphene' ); ?></a></p>
            
            <?php do_action( 'mgraphene_index_entry_footer_bottom' ); ?>
        </div>
        
        <?php do_action( 'mgraphene_index_entry_bottom' ); ?>
        
    </div><!-- .entry -->
    
    <?php else : /* Then display the rest of the posts in the list */ ?>
    
    <?php if ( $count === ( $full_post_count + 1 ) ) : ?>
    
   	<?php do_action( 'mgraphene_index_post_list_before' ); ?>
    <div class="post-list-wrap recent-posts">
    	<h3 class="post-list-title"><a href="#"><?php _e( 'Recent posts' , 'mgraphene' ); ?></a></h3>
        <div class="bottom-shadow"></div>
        <div class="post-list-content">
        	<ul class="post-list">
    <?php endif; ?>
    
                <li>
                    <?php do_action( 'mgraphene_index_post_list_top' ); ?>
                
                    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a><br />
                    <?php if ( ! $mgraphene_settings['hide_post_meta'] ) : ?>
	                    <?php printf( __( '%1$s by %2$s', 'mgraphene' ), '<span class="post-list-date">' . get_the_date() . '</span>', '<span class="post-list-author">' . get_the_author() . '</span>' ); ?>
                    <?php endif; ?>
                    
                    <?php if ( mgraphene_should_show_comments() ) : ?>
                     &mdash; <a href="<?php comments_link(); ?>"><?php mgraphene_comment_count( 'comments', __( 'No comment yet', 'mgraphene' ) ); ?></a>
                    <?php endif; ?>
                    
                    <?php do_action( 'mgraphene_index_post_list_bottom' ); ?>
                </li>
    
    <?php endif; $count++; endwhile; endif; /* Ends the main loop */ ?>

    <?php if ( $count > $full_post_count ) : ?>
	    	</ul>
        </div>
    </div><!-- .post-list -->
    
    <div class="top-shadow">&nbsp;</div>
    <?php mgraphene_posts_nav(); ?>
    
    <?php do_action( 'mgraphene_index_post_list_after' ); ?>
    <?php endif; ?>
    
    <?php do_action( 'mgraphene_index_after' ); ?>
    
<?php get_footer(); ?>