<?php
/**
 * Register the settings for the theme. This is required for using the
 * WordPress Settings API.
*/
function mgraphene_settings_init(){
    // register options set and store it in mgraphene_settings db entry
    register_setting( 'mgraphene_options', 'mgraphene_settings', 'mgraphene_settings_validator' );
}
add_action( 'admin_init', 'mgraphene_settings_init' );


/**
 * This function generates the theme's general options page in WordPress administration.
*/
function mgraphene_options(){
	
	global $mgraphene_settings, $mgraphene_defaults;  
	$theme_root = $mgraphene_settings['theme_root'];
	
	/* Checks if the form has just been submitted */
	if ( ! isset( $_REQUEST['settings-updated'] ) ) { $_REQUEST['settings-updated'] = false; }
	
	/* Apply options preset if submitted */ 
	if ( isset( $_POST['mgraphene_preset'] ) ) {
		include( $theme_root . '/admin/options-presets.php' );
	}
        
	/* Get the updated settings before outputting the options page */
	$mgraphene_settings = array_merge( $mgraphene_defaults, get_option( 'mgraphene_settings', array() ) );
	
	/* This where we start outputting the options page */ ?>
	<div class="wrap meta-box-sortables">
		<div class="icon32" id="icon-themes"><br /></div>
        <h2><?php _e( 'Graphene Mobile Theme Options', 'mgraphene' ); ?></h2>
        
        <?php /* Settings updated and error messages */ ?>
		<?php settings_errors(); ?>
        
        <?php /* Print the options tabs */ ?>
        <?php 
			if ( $_GET['page'] == 'mgraphene_options' ) :
				$tabs = array(
					'general' => __( 'General', 'mgraphene' ),
					'display' => __( 'Display', 'mgraphene' ),
					'colours' => __( 'Colours', 'mgraphene' ),
					'advanced' => __( 'Advanced', 'mgraphene' ),
					);
				$current_tab = ( isset( $_GET['tab'] ) ) ? $_GET['tab'] : 'general';
				mgraphene_options_tabs( $current_tab, $tabs );         
			endif;
		?>
        
        <div class="left-wrap">
        
        <?php /* Begin the main form */ ?>
        <form method="post" action="options.php" class="mainform clearfix" id="mgraphene-options-form">
		
            <?php /* Output wordpress hidden form fields, e.g. nonce etc. */ ?>
            <?php settings_fields( 'mgraphene_options' ); ?>
            
            <?php /* Display the current tab */ ?>
            <?php mgraphene_options_tabs_content( $current_tab ); ?>  
            
        
            <?php /* The form submit button */ ?>
            <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Options', 'mgraphene'); ?>" /></p>
        
        <?php /* Close the main form */ ?>
        </form>
        
        <div class="mgraphene-ajax-response"></div>
        
        </div><!-- #left-wrap -->
        
        <div class="side-wrap">
        
        <?php /* Options Presets. This uses separate form than the main form */ ?>
        <div class="postbox preset">
            <div class="head-wrap">
                <div title="Click to toggle" class="handlediv"><br /></div>
                <h3 class="hndle"><?php _e( 'Options Presets', 'mgraphene' ); ?></h3>
            </div>
            <div class="panel-wrap inside">
                <p><?php _e( 'Note that you can still configure the individual settings after you apply any preset.', 'mgraphene' ); ?></p>
                <form action="" method="post">
                    <?php wp_nonce_field( 'mgraphene-preset', 'mgraphene-preset' ); ?>
                	<table class="form-table">
                        <tr>
                        	<th scope="col" style="width: 140px;"><?php _e( 'Select Options Preset', 'mgraphene' ); ?></th>
                        </tr>
                        <tr>
                            <td class="options-cat-list">
                            	<?php if ( function_exists( 'graphene_setup' ) ) : ?>
                                	<input type="radio" name="mgraphene_options_preset" value="graphene-settings" id="mgraphene_options_preset-graphene-settings" />
	                                <label for="mgraphene_options_preset-graphene-settings"><?php _e( 'Copy relevant Graphene settings', 'mgraphene' ); ?></label><br />
                                <?php endif; ?>
                                <input type="radio" name="mgraphene_options_preset" value="reset" id="mgraphene_options_preset-reset" />
                                <label for="mgraphene_options_preset-reset"><?php _e( 'Reset to default settings', 'mgraphene' ); ?></label>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="mgraphene_preset" value="true" />
                    <input type="submit" class="button mgraphene_preset" value="<?php _e( 'Apply Options Preset', 'mgraphene' ); ?>" />
                </form>
            </div>
        </div>

        </div><!-- #side-wrap -->   
            
    </div><!-- #wrap -->
<?php    
} // Closes the mgraphene_options() function definition 