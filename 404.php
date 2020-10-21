<?php
$search_term = substr($_SERVER['REQUEST_URI'],1);
$search_term = urldecode(stripslashes($search_term));
$find = array("'.html'", "'.+/'", "'[-/_]'");
$replace = " ";
$search_term = trim(preg_replace($find, $replace, $search_term));
$search_term_q = preg_replace('/ /', '%20', $search_term);
$redirect_location = get_home_url().'?s='.$search_term_q.'&search_404=1#results';

get_header();
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
		window.location.replace("<?php echo $redirect_location; ?>");
    });
</script>

<div class="archive-wrap">
        
    <div class="archive-header">
        <?php /* The post title */ ?>
        <h2 class="archive-title"><?php _e( 'Error 404 - Not Found', 'mgraphene' ); ?></h2>
        
        <?php do_action( 'mgraphene_404_header' ); ?>
    </div>    
    
    <div class="entry-wrap clearfix">
        <div class="entry-content">
        	<?php do_action( 'mgraphene_404_content_before' ); ?>
            <p><?php _e( "Sorry, I've looked everywhere but I can't find the content you're looking for.", 'graphene' ); ?></p>
            <p><?php _e( "If you follow the link from another website, I may have removed or renamed the page some time ago.", 'graphene' ); ?></p>
            <p><?php _e( 'I am now performing an automated search for you based on the URL you entered. Please wait a moment ...', 'mgraphene' ); ?></p>
            <?php do_action( 'mgraphene_404_content_after' ); ?>
        </div>
    </div>
    
</div><!-- .entry -->

<?php do_action( 'mgraphene_404_before_search' ); ?>

<div class="archive-wrap">
    <div class="archive-header">
       	<h2 class="archive-title"><?php _e( 'Automated search', 'mgraphene' ); ?></h2>
        <?php do_action( 'mgraphene_404_search_header' ); ?>
    </div>
    
    <div class="top-shadow">&nbsp;</div>
    
    <div class="entry-wrap clearfix">
        
        <div class="entry-content">
        	<?php do_action( 'mgraphene_404_search_content_before' ); ?>
            <p><?php printf(__('Searching for the terms <strong>%s</strong> ...', 'graphene'), $search_term); ?></p>
            <?php do_action( 'mgraphene_404_search_content_after' ); ?>
        </div>
               
    </div>
    
</div>
    
<?php get_footer(); ?>