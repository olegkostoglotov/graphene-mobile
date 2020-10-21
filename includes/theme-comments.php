<?php 
/**
 * Adds the functionality to count comments by type, eg. comments, pingbacks, tracbacks.
 * Based on the code at WPCanyon (http://wpcanyon.com/tipsandtricks/get-separate-count-for-comments-trackbacks-and-pingbacks-in-wordpress/)
*/
function mgraphene_get_comment_count( $type = 'comments', $only_approved_comments = true ){
	if( $type == 'comments' ) :
		$typeSql = 'comment_type = ""';
	elseif( $type == 'pings' ) :
		$typeSql = 'comment_type != ""';
	elseif( $type == 'trackbacks' ) :
		$typeSql = 'comment_type = "trackback"';
	elseif( $type == 'pingbacks' ) :
		$typeSql = 'comment_type = "pingback"';
	endif;
	
	$typeSql = apply_filters( 'mgraphene_comments_typesql', $typeSql, $type );
    $approvedSql = $only_approved_comments ? ' AND comment_approved="1"' : '';
        
	global $wpdb;

    $result = $wpdb->get_var( '
        SELECT
            COUNT(comment_ID)
        FROM
            ' . $wpdb->comments . '
        WHERE
            ' . $typeSql . $approvedSql . ' AND           
            comment_post_ID= ' . get_the_ID() );
	
	return $result;
}


/**
 * Prints the comment count text
 */
function mgraphene_comment_count( $type = 'comments', $none_text = '', $only_approved_comments = true, $format = '' ){
	$count = mgraphene_get_comment_count( $type, $only_approved_comments );
	if ( ! $format ){
		if ( $type == 'comments' ) $format = _n( '%d comment', '%d comments', $count, 'mgraphene' );
		if ( $type == 'pings' ) $format = _n( '%d ping', '%d pings', $count, 'mgraphene' );
		if ( $type == 'trackbacks' ) $format = _n( '%d trackback', '%d trackbacks', $count, 'mgraphene' );
		if ( $type == 'pingbacks' ) $format = _n( '%d pingback', '%d pingbacks', $count, 'mgraphene' );
	}
	$count_text = ( $count ) ? sprintf( $format, number_format_i18n( $count ) ) : $none_text;
	echo apply_filters( 'mgraphene_comment_count', $count_text, $type, $count, $none_text, $only_approved_comments, $format );
}


/**
 * Insert the script for comments toggle if post/page has comments enabled
*/
function mgraphene_comments_script(){ ?>
	<!-- Comments tabs -->
    <script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.comments-count a').click(function(){
				$('.comments-wrap .comments').slideDown();
				$('.comments-wrap .pings').slideUp();
				$('.comments-wrap .comment-form').slideUp();
				return false;
			});
			$('.pings-count a').click(function(){
				$('.comments-wrap .comments').slideUp();
				$('.comments-wrap .pings').slideDown();
				$('.comments-wrap .comment-form').slideUp();
				return false;
			});
			$('.add-comment a').click(function(){
				$('.comments-wrap .comment-form').slideToggle();
				return false;
			});
		});
	</script>
<?php
}
function mgraphene_add_comments_script(){
	add_action( 'wp_footer', 'mgraphene_comments_script' );	
}


if ( ! function_exists( 'mgraphene_comments' ) ) :
/**
 * Comments list callback function
*/
function mgraphene_comments( $comment, $args, $depth ){
	$GLOBALS['comment'] = $comment; ?>
    
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class('clearfix'); ?>>
    	
        <?php do_action( 'mgraphene_comment_top' ); ?>
        
    	<?php /* The gravatar */ ?>
        <?php echo get_avatar($comment, apply_filters('mgraphene_gravatar_size', 40)); ?>

		<?php /* Comment meta */ ?>
        <div class="comment-meta clearfix">
            <p class="comment-author"><?php comment_author_link(); ?> <?php _e( 'says:', 'mgraphene' ); ?></p>
            <?php /* translators: %1$s will be replaced by the date, and %2$s will be replaced by the time. Example: 27 June 2011 at 2.03pm */ ?>
            <p class="comment-date"><?php printf( __( '%1$s at %2$s', 'mgraphene' ), get_comment_date(), get_comment_time() ); ?></p>
            
            <?php do_action( 'mgraphene_comment_meta' ); ?>
        </div>

		<?php /* Comment content */ ?>
        <div class="comment-entry">
        	<?php do_action( 'mgraphene_comment_entry_top' ); ?>
            <?php 
			if ( $comment->comment_approved == '0' )
               echo '<p><em>' . __( 'Your comment is awaiting moderation.', 'mgraphene' ) . '</em></p>';
            else
                comment_text();
            ?>
            <?php do_action( 'mgraphene_comment_entry_bottom' ); ?>
        </div>
    
<?php
}
endif;


if ( ! function_exists( 'mgraphene_comments_nav' ) ) :
/**
 * This function provides the comments navigation
*/
function mgraphene_comments_nav(){
	if ( get_comment_pages_count() > 1 ) : ?>
    	<div class="top-shadow">&nbsp;</div>
        <div class="comments-nav clearfix">
            <p><?php paginate_comments_links(); ?></p>

            <?php do_action( 'mgraphene_comments_nav' ); ?>
        </div>
<?php
	endif;
}
endif;


if ( ! function_exists( 'mgraphene_should_show_comments' ) ) :
/**
 * Helps to determine if the comments should be shown.
 */
function mgraphene_should_show_comments( $post_id = '' ) {
    global $mgraphene_settings, $post;
	if ( ! $post_id ) $post_id = $post->ID;
    
	if ( $mgraphene_settings['comments_setting'] == 'disabled_completely' )
        return false;
    
	if ( $mgraphene_settings['comments_setting'] == 'disabled_pages' && get_post_type( $post_id ) == 'page' )
        return false;
	
	if ( ! is_singular() && $mgraphene_settings['hide_post_commentcount'] )
		return false;
	
	if ( ! comments_open( $post_id ) && have_comments() && ! is_singular() )
		return false;
	
    return true;
}
endif;