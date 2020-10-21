<?php do_action( 'mgraphene_comments_before' ); ?>

<?php if ( comments_open() || have_comments() ) : ?>
    <div id="comments" class="comments-wrap">
        
        <?php do_action( 'mgraphene_comments_top' ); ?>
        
        <?php /* Comment sections header */ ?>    
        <div class="comments-wrap-header clearfix">
        
            <?php do_action( 'mgraphene_comments_header_before' ); ?>
            
            <h3 class="comments-count"><a href="#"><?php mgraphene_comment_count( 'comments', __( 'No comment yet', 'mgraphene' ) ); ?></a></h3>
            
            <?php if ( pings_open() ) : ?>
            <h3 class="pings-count"><a href="#"><?php mgraphene_comment_count( 'pings', __( 'No ping yet', 'mgraphene' ) ); ?></h3>
            <?php endif; ?>
            
            <?php do_action( 'mgraphene_comments_header_after' ); ?>
        </div>
        
        <div class="bottom-shadow">&nbsp;</div>
        
        <?php /* Comment form */ ?>
        <div class="comment-form">
            <?php do_action( 'mgraphene_comment_form_before' ); ?>
        
            <?php 
                $args = array(
                            'comment_notes_after' => '',
                            );
                comment_form( apply_filters( 'mgraphene_comment_form_args', $args ) ); 
            ?>
            
            <?php do_action( 'mgraphene_comment_form_after' ); ?>
        </div>
        
        <div class="bottom-shadow">&nbsp;</div>
        
        <h3 class="add-comment">
        	<?php if ( comments_open() ) : ?>
	        	<a href="#"><?php _e( 'Leave a reply', 'mgraphene' ); ?></a>
            <?php else : ?>
    	        <?php _e( 'Comments have been closed', 'mgraphene' ); ?>
            <?php endif; ?>
        </h3>
        
        <div class="bottom-shadow">&nbsp;</div>
        
        <?php /* Pings list */ if ( pings_open() && $ping_count != __( 'No ping yet', 'mgraphene' ) ) : ?>
			<?php do_action( 'mgraphene_pings_list_before' ); ?>
            <ol class="comments-list pings">
                <?php do_action( 'mgraphene_pings_list_top' ); ?>
                
                <?php wp_list_comments( array( 'callback' => 'mgraphene_comments', 'style' => 'ol', 'type' => 'pings', 'max_depth' => 1, 'per_page' => 0 ) ); ?> 
                
                <?php do_action( 'mgraphene_pings_list_bottom' ); ?>
            </ol>
            <?php do_action( 'mgraphene_pings_list_after' ); ?>
        <?php endif; ?>
        
        <?php /* Comments list */ if ( $comment_count != __( 'No comment yet', 'mgraphene' ) ) : ?>
			<?php do_action( 'mgraphene_comments_list_before' ); ?>
            <ol class="comments-list comments">
                <?php do_action( 'mgraphene_comments_list_top' ); ?>
                
                <?php wp_list_comments( array( 'callback' => 'mgraphene_comments', 'style' => 'ol', 'type' => 'comment', 'max_depth' => 1 ) ); ?>
                
                <?php do_action( 'mgraphene_comments_list_bottom' ); ?>
            </ol>
            <?php do_action( 'mgraphene_comments_list_after' ); ?>
        <?php endif; ?>
        
        <?php mgraphene_comments_nav(); ?>
        
        <?php do_action( 'mgraphene_comments_bottom' ); ?>
        
    </div><!-- .comments-wrap -->
    
    <?php do_action( 'mgraphene_comments_after' ); ?>
	
<?php endif; ?>