<?php get_header(); ?>

<?php if ( isset( $_GET['search_404'] ) ) : ?>
	<?php do_action( 'mgraphene_search_top' ); ?>
    <div class="archive-wrap">
        
        <?php do_action( 'mgraphene_search_header_before' ); ?>
        
        <div class="archive-header entry-header">
        	<?php do_action( 'mgraphene_search_header_top' ); ?>

            <?php /* The post title */ ?>
            <h2 class="archive-title"><?php _e( 'Error 404 - Not Found', 'mgraphene' ); ?></h2>

            <?php do_action( 'mgraphene_search_header_bottom' ); ?>
        </div>
        
        <?php do_action( 'mgraphene_search_header_after' ); ?>
        
        <div class="entry-wrap clearfix">
        	<?php do_action( 'mgraphene_search_content_before' ); ?>
        	
            <div class="entry-content">
            	<?php do_action( 'mgraphene_search_content_top' ); ?>
            
                <p><?php _e( "Sorry, I've looked everywhere but I can't find the content you're looking for.", 'mgraphene' ); ?></p>
                <p><?php _e( "If you follow the link from another website, I may have removed or renamed the page some time ago.", 'mgraphene' ); ?></p>
                
                <?php do_action( 'mgraphene_search_content_bottom' ); ?>
            </div>
            
            <?php do_action( 'mgraphene_search_content_after' ); ?>
        </div>
        
        <?php do_action( 'mgraphene_search_entry_after' ); ?>
        
    </div><!-- .arcive-wrap -->
    <?php do_action( 'mgraphene_search_after' ); ?>
<?php endif; ?>

<?php do_action( 'mgraphene_search_results_before' ); ?>

<div class="archive-wrap" id="results">
	<?php do_action( 'mgraphene_search_results_top' ); ?>

    <div class="archive-header entry-header">
    	<?php do_action( 'mgraphene_search_results_header_top' ); ?>
    	<?php /* Get the archive title */ 
		$title = __( 'Search results:', 'mgraphene' ) . ' <strong>' . get_search_query() . '</strong>';
		?>
       	<h2 class="archive-title"><?php echo $title; ?></h2>
        <?php do_action( 'mgraphene_search_results_header_bottom' ); ?>
    </div>
    
    <div class="top-shadow">&nbsp;</div>
    <?php do_action( 'mgraphene_search_results_loop_before' ); ?>
    
    <?php 
		if ( have_posts() ){
			while ( have_posts() ){
				the_post();
				get_template_part( 'loop', 'search' );
			}
		} else {
			get_template_part( 'not-found', 'search' );
		}
	?>
    
    <?php do_action( 'mgraphene_search_results_loop_after' ); ?>
    <div class="bottom-shadow"></div>
        
    <?php mgraphene_posts_nav(); ?>
    
    <?php do_action( 'mgraphene_search_results_bottom' ); ?>
    
</div>

<?php do_action( 'mgraphene_search_results_after' ); ?>

<?php get_footer(); ?>