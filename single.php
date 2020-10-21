<?php get_header(); ?>
    
    <?php 
		do_action( 'mgraphene_single_loop_before' );
		if ( have_posts() ) {
			the_post(); 
			get_template_part( 'loop', 'single' );
        } else {
        	get_template_part( 'not-found', 'single' );
      	}
		do_action( 'mgraphene_single_loop_after' );
	?>

<?php get_footer(); ?>