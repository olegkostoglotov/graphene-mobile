<?php 
/**
 * This functions adds additional classes to the <body> element. The additional classes
 * are added by filtering the WordPress body_class() function.
*/
function mgraphene_body_class( $classes ){
    
    if ( is_singular() ) 
	    $classes[] = 'single';
	if ( is_search() )
		$classes[] = 'archive';
    
    // Prints the body class
    return $classes;
}
add_filter('body_class', 'mgraphene_body_class');


/**
 * This function provides the previous and next post navigation in single posts
*/
if ( ! function_exists( 'mgraphene_post_nav' ) ) :

function mgraphene_post_nav(){ ?>

	<?php do_action( 'mgraphene_post_nav_before' ); ?>

	<div class="entry-nav clearfix">
        <p class="prev">
            <?php previous_post_link( '<span class="post-link">%link</span>', '&laquo; ' . __( 'Previous Post', 'mgraphene' ) ); ?><br />
            <span class="post-title"><?php previous_post_link( '%link', '%title' ); ?></span>
            
            <?php do_action( 'mgraphene_post_nav_prev' ); ?>
        </p>
        <p class="next">
            <?php next_post_link( '<span class="post-link">%link</span>', __( 'Next Post', 'mgraphene' ) . ' &raquo;' ); ?><br />
            <span class="post-title"><?php next_post_link( '%link', '%title' ); ?></span>
            
            <?php do_action( 'mgraphene_post_nav_next' ); ?>
        </p>
    </div>
    
    <?php do_action( 'mgraphene_post_nav_after' ); ?>
    
<?php
}

endif;


/**
 * This function provides the posts navigation in archive and search results pages
*/
if ( ! function_exists( 'mgraphene_posts_nav' ) ) :

function mgraphene_posts_nav(){
	$prev_link = str_replace( '<a ', '<a class="prev-link" ', get_previous_posts_link( '&laquo; ' . __( 'Previous Page', 'mgraphene' ) ) );
	$next_link = str_replace( '<a ', '<a class="next-link" ', get_next_posts_link( __( 'Next Page', 'mgraphene' ) . ' &raquo;' ) );
	if ( $prev_link || $next_link ) :
?>    
	<div class="entry-nav posts-nav clearfix">
    	<?php do_action( 'mgraphene_posts_nav_before' ); ?>
    
    	<?php if ( $prev_link ) : ?>
	        <p class="prev">
				<?php echo $prev_link; ?>
            	<?php do_action( 'mgraphene_posts_nav_prev' ); ?>
            </p>
        <?php endif; ?>
        <?php if ( $next_link ) : ?>
        	<p class="next">
				<?php echo $next_link; ?>
            	<?php do_action( 'mgraphene_posts_nav_next' ); ?>
            </p>
        <?php endif; ?>
        
        <?php do_action( 'mgraphene_posts_nav_after' ); ?>
    </div>
    
<?php
	endif;
}

endif;


/**
 * This function gets the first image (as ordered in the post's media gallery) attached to
 * the current post. It outputs the complete <img> tag, with height and width attributes.
 * The function returns the thumbnail of the original image, linked to the post's 
 * permalink. Returns FALSE if the current post has no image.
 *
 * This function requires the post ID to get the image from to be supplied as the
 * argument. If no post ID is supplied, it outputs an error message. An optional argument
 * size can be used to determine the size of the image to be used.
 *
 * Based on code snippets by John Crenshaw 
 * (http://www.rlmseo.com/blog/get-images-attached-to-post/)
*/
if (!function_exists('mgraphene_get_post_image')) :
	function mgraphene_get_post_image($post_id = NULL, $size = 'thumbnail', $context = '', $urlonly = false, $attr = ''){
		
		/* Display error message if no post ID is supplied */
		if ($post_id == NULL){
			_e( '<strong>ERROR: You must supply the post ID to get the image from as an argument when calling the mgraphene_get_post_image() function.</strong>', 'mgraphene' );
			return;
		}
		
		$html = '';
		
		/* Get the post thumbnail, if present */
		if ( has_post_thumbnail( $post_id ) )
			$html = get_the_post_thumbnail( $post_id, $size, $attr );
		
		if ( empty( $html ) ) {
		
		/* Get the first image in post */
			$images = get_children(array(
						'post_type' 		=> 'attachment',
						'post_mime_type' 	=> 'image',
						'post_parent' 	 	=> $post_id,
						'orderby'			=> 'menu_order',
						'order'				=> 'ASC',
						'numberposts'		=> 1,
							 ), ARRAY_A);
		
			$html = '';
			
			/* Build the <img> tag if there is an image */
			foreach ( $images as $image ){
				if ( ! $urlonly ) {
					$html .= wp_get_attachment_image( $image['ID'], $size, false, $attr );
				} else {
					$html = wp_get_attachment_image_src( $image['ID'], $size, false, $attr );
				}
			}
		}
		
		/* Returns the image HTMl */
		return apply_filters( 'mgraphene_get_post_image', $html, $post_id, $size, $context, $urlonly, $attr );
}
endif;


/**
 * Shorten the length of automatic excerpts
*/
function mgraphene_auto_excerpt_length(){
	return apply_filters( 'mgraphene_auto_excerpt_length', 20 );
}
add_filter( 'excerpt_length', 'mgraphene_auto_excerpt_length' );


/**
 * Determine if the parent page should be shown or not
*/
if ( ! function_exists( 'mgraphene_should_show_parent' ) ) :

function mgraphene_should_show_parent(){
	global $mgraphene_settings, $post, $is_page;
	
	if ( $is_page )	// Check if this is a page
		if ( get_pages( array( 'child_of' => $post->ID, 'parent' => $post->ID, 'hierarchichal' => 0 ) ) )	// Check if this page has any child
			if ( $mgraphene_settings['hide_parent_content_if_empty'] && $post->post_content == '' )		// Check if page is empty and empty parent should not be shown
				return false;
		
	return true;
}

endif;


/**
 * Determine if the child pages should be shown or not
*/
if ( ! function_exists( 'mgraphene_should_show_children' ) ) :

function mgraphene_should_show_children(){
	global $mgraphene_settings, $post, $is_page;
	
	if ( $is_page )	{	// Check if this is a page 
		if ( $mgraphene_settings['child_page_listing'] == 'hide' )
			return false;
		if ( $mgraphene_settings['child_page_listing'] == 'show_if_parent_empty' && $post->post_content != '' )
			return false;
	}
		
	return true;
}

endif;


/**
 * Improves the WordPress default excerpt output. This function will retain HTML tags inside the excerpt.
 * Based on codes by Aaron Russell at http://www.aaronrussell.co.uk/blog/improving-wordpress-the_excerpt/
*/
function mgraphene_improved_excerpt( $text ){
	global $mgraphene_settings, $post;
	
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content( '' );
		$text = strip_shortcodes( $text );
		$text = apply_filters( 'the_content', $text);
		$text = str_replace( ']]>', ']]&gt;', $text);
		
		/* Remove unwanted JS code */
		$text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text);
		
		/* Strip HTML tags, but allow certain tags */
		$text = strip_tags( $text, $mgraphene_settings['excerpt_html_tags']);

		$excerpt_length = apply_filters( 'excerpt_length', 55);
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count( $words) > $excerpt_length ) {
			array_pop( $words);
			$text = implode( ' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode( ' ', $words);
		}
	}
	
	// Try to balance the HTML tags
	$text = force_balance_tags( $text );
	
	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt);
}

/**
 * Only use the custom excerpt trimming function if user decides to retain html tags.
*/
if ( $mgraphene_settings['excerpt_html_tags'] ) {
	remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
	add_filter( 'get_the_excerpt', 'mgraphene_improved_excerpt' );
}
?>