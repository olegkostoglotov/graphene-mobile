<?php do_action( 'mgraphene_search_form_before' ); ?>
<form id="searchform" class="searchform" method="get" action="<?php echo home_url(); ?>">
    <fieldset>
    	<?php do_action( 'mgraphene_search_form_top' ); ?>
        <input class="search-input" type="text" name="s" value="" />
        <?php do_action( 'mgraphene_search_form_fields' ); ?>
        <button class="search-submit" type="submit"><?php _e( 'Search', 'mgraphene' ); ?></button>
        <?php do_action( 'mgraphene_search_form_bottom' ); ?>
    </fieldset>
</form>
<?php do_action( 'mgraphene_search_form_after' ); ?>