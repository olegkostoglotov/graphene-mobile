<?php get_header(); ?>

<div class="archive-wrap">        
    <div class="archive-header entry-header">
    	<?php /* Get the archive title */ 
		$title = __( 'Archive for:', 'mgraphene' ) . ' <strong>';
		
		if ( is_day() )
			$title .= get_the_date();
		elseif ( is_month() )
			/* translators: This string is for the monthly archive page. F will be replaced by the month name, Y will be replaced by the year */
			$title .= single_month_title( '', false );
		elseif ( is_year() )
			$title .= get_the_date( 'Y' );
		elseif ( is_archive() )
			$title .= single_term_title( '', false );
		
		$title .= '</strong>';
		?>
       	<h2 class="archive-title"><?php echo apply_filters( 'mgraphene_archive_title', $title ); ?></h2>
    </div>
    
    <div class="top-shadow">&nbsp;</div>
    
    <?php do_action( 'mgraphene_archive_top' ); ?>
    
    <?php 
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'loop', 'archive' );
			}
		} else {
			get_template_part( 'not-found', 'archive' );
		}
	?>
    
    <div class="top-shadow">&nbsp;</div>
        
    <?php mgraphene_posts_nav(); ?>
    
    <?php do_action( 'mgraphene_archive_bottom' ); ?>
    
</div>
	
<?php get_footer(); ?>