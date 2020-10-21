<?php
/**
 * This file lists the child pages of the page currently being displayed,
 * if it has any.
*/    
    
	/* Get the child pages */
    $args = array(
        'order' 			=> 'ASC',
        'orderby' 			=> 'menu_order, title',
        'post_parent' 		=> $post->ID,
        'post_type' 		=> 'page',
		'posts_per_page' 	=> -1
    );
    $pages = new WP_Query( apply_filters('mgraphene_child_pages_args', $args ) );

    if ( $pages->have_posts() ) :

    ?>
    <?php do_action( 'mgraphene_loop_children_before' ); ?>
    <div class="post-list-wrap">
    	<?php do_action( 'mgraphene_loop_children_top' ); ?>
        <h3 class="post-list-title"><a href="#"><?php _e( 'In this section' , 'mgraphene' ); ?></a></h3>
        <div class="bottom-shadow"></div>
        <div class="post-list-content">
        	<ul class="post-list">
        	<?php do_action( 'mgraphene_loop_children_list_top' ); ?>
        
				<?php while ( $pages->have_posts() ) : $pages->the_post(); ?>
                <li>
                    <?php do_action( 'mgraphene_loop_children_title_top' ); ?>
                    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                    <?php do_action( 'mgraphene_loop_children_title_bottom' ); ?>
                </li>
                <?php endwhile; ?>
            
            <?php do_action( 'mgraphene_loop_children_list_bottom' ); ?>
        	</ul>
        </div>
        <?php do_action( 'mgraphene_loop_children_bottom' ); ?>
    </div>
    <?php do_action( 'mgraphene_loop_children_after' ); ?>
<?php 
    endif; wp_reset_postdata();
?>