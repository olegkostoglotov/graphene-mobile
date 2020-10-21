<?php do_action( 'mgraphene_not_found_before' ); ?>

<?php if ( ! is_archive() && ! is_search() ) : ?>

<div class="entry not-found">
	
    <?php do_action( 'mgraphene_not_found_entry_top' ); ?>
    
    <div class="entry-header">
    	<?php do_action( 'mgraphene_not_found_header_top' ); ?>
        <h2 class="entry-title"><?php _e( 'Not Found', 'mgraphene' ); ?></h2>
        <?php do_action( 'mgraphene_not_found_header_bottom' ); ?>
    </div>
    
    <div class="top-shadow"></div>    
    
    <?php do_action( 'mgraphene_not_found_entry_wrap_before' ); ?>
    
    <div class="entry-wrap clearfix">
    
    	<?php do_action( 'mgraphene_not_found_content_before' ); ?>
        
        <div class="entry-content">
        	<?php do_action( 'mgraphene_not_found_content_top' ); ?>
            
            <p><?php _e( "Sorry, I've searched everywhere but the content you're looking for could not be found.", 'mgraphene' ); ?></p>
            <h3><?php _e( 'Try a search?', 'mgraphene' ); ?></h3>
            <?php get_search_form(); ?>
            
            <?php do_action( 'mgraphene_not_found_content_bottom' ); ?>
        </div>
        
        <?php do_action( 'mgraphene_not_found_content_after' ); ?>
        
    </div>
    
    <?php do_action( 'mgraphene_not_found_entry_bottom' ); ?>
    
</div><!-- .entry -->

<?php else : ?>

<div class="entry-wrap clearfix not-found">

	<?php do_action( 'mgraphene_not_found_entry_wrap_top' ); ?>

    <h2><?php _e( 'Not Found', 'mgraphene' ); ?></h2>
    
    <?php do_action( 'mgraphene_not_found_content_before' ); ?>
    
    <div class="entry-content">
    	<?php do_action( 'mgraphene_not_found_content_top' ); ?>	
    
        <p><?php _e( "Sorry, I've searched everywhere but the content you're looking for could not be found.", 'mgraphene' ); ?></p>
        <h3><?php _e( 'Try a search?', 'mgraphene' ); ?></h3>
        <?php get_search_form(); ?>
        
        <?php do_action( 'mgraphene_not_found_content_bottom' ); ?>
    </div>
    
    <?php do_action( 'mgraphene_not_found_content_after' ); ?>
    
</div>
<?php endif; ?>

<?php do_action( 'mgraphene_not_found_after' ); ?>