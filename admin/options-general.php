<?php 
/**
 * This function displays the theme's General options
*/
function mgraphene_options_general() { global $mgraphene_settings;	?>
        
    <input type="hidden" name="mgraphene_general" value="true" />
        
        <?php /* API key  */ ?>
        <div class="postbox">
            <div class="head-wrap">
                <div title="Click to toggle" class="handlediv"><br /></div>
        		<h3 class="hndle"><?php _e( 'API Key', 'mgraphene' ); ?></h3>
            </div>
            <div class="panel-wrap inside">
            	<p><?php _e( 'Insert your Graphene Mobile\'s API key here to enable automatic updates.', 'mgraphene' ); ?></p>
                <table class="form-table">
                	<tr>
                        <th scope="row">
                        	<label for="api_key"><?php _e( 'Graphene Mobile API Key', 'mgraphene' ); ?></label>
                        </th>
                        <td>
                        	<input type="password" name="mgraphene_settings[api_key]" id="api_key" class="code" size="40" maxlength="32" value="<?php echo stripslashes( $mgraphene_settings['api_key'] ); ?>" />
                            <br /><span class="description"><?php printf( __( 'If you have lost your API key or have never received it, you can obtain it from your %s.', 'mgraphene' ), '<a href="http://www.khairul-syahir.com/products-page/your-account">' . __( 'Account Page', 'mgraphene' ) . '</a>' ); ?></span>
                        </td>
                    </tr>
                </table>
                
                <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
            </div>
        </div>
        
        
        <?php /* Front page options  */ ?>
        <div class="postbox">
            <div class="head-wrap">
                <div title="Click to toggle" class="handlediv"><br /></div>
        		<h3 class="hndle"><?php _e( 'Front Page Options', 'mgraphene' ); ?></h3>
            </div>
            <div class="panel-wrap inside">
            	<table class="form-table">
                    <tr>
                        <th scope="row" style="width:250px;">
                        	<label><?php _e( 'Number of posts to show with excerpt', 'mgraphene' ); ?></label>
                        </th>
                        <td>
                        	<input type="text" name="mgraphene_settings[frontpage_full_post_count]" id="frontpage_full_post_count" size="2" value="<?php echo stripslashes( $mgraphene_settings['frontpage_full_post_count'] ); ?>" />
                        </td>
                    </tr>
                </table>
            
            	<h4><?php _e( 'Posts by category listing options', 'mgraphene' ); ?></h4>
                <table class="form-table">
                	<tr>
                        <th scope="row">
                        	<label><?php _e( 'Display recent posts by category', 'mgraphene' ); ?></label>
                        </th>
                        <td>
                        	<select name="mgraphene_settings[frontpage_show_cats]">
                                <option value="" <?php if ( $mgraphene_settings['frontpage_show_cats'] == '' ) { echo 'selected="selected"'; } ?>><?php _e( 'Disabled', 'mgraphene' ); ?></option>
                                <option value="all" <?php if ( $mgraphene_settings['frontpage_show_cats'] == 'all' ) { echo 'selected="selected"'; } ?>><?php _e( 'Show all categories', 'mgraphene' ); ?></option>
                                <option value="selected" <?php if ( $mgraphene_settings['frontpage_show_cats'] == 'selected' ) { echo 'selected="selected"'; } ?>><?php _e( 'Show selected categories', 'mgraphene' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                        	<label><?php _e( 'Categories to show in front page', 'mgraphene' ); ?></label>
                        </th>
                        <td>
                        	<span class="description"><?php _e( 'This setting is only applicable if "Show selected categories" is selected above.', 'mgraphene' ); ?></span><br />
                        	<?php /* Get the current settings */ 
                            $frontpage_cats = $mgraphene_settings['frontpage_cats'];
                            
                            /* Get the list of categories and display as checkboxes */ 
                            $cats = get_categories();
                            foreach ($cats as $cat) : $cat_id = $cat->cat_ID;
                            ?>
                            <span class="input-wrap">
                            <input type="checkbox" name="mgraphene_settings[frontpage_cats][]" id="frontpage_cats-<?php echo $cat_id; ?>" value="<?php echo $cat_id; ?>" <?php if ( in_array( $cat_id, $frontpage_cats ) ) {echo 'checked="checked" ';} ?>/>
                            <label for="frontpage_cats-<?php echo $cat_id; ?>"><?php echo $cat->cat_name; ?></label>
                            </span>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="width:250px;">
                        	<label><?php _e( 'Number of posts to show per category', 'mgraphene' ); ?></label>
                        </th>
                        <td>
                        	<input type="text" name="mgraphene_settings[frontpage_cats_numposts]" id="frontpage_cats_numposts" size="2" value="<?php echo stripslashes( $mgraphene_settings['frontpage_cats_numposts'] ); ?>" />
                        </td>
                    </tr>
                </table>
                
                <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
            </div>
        </div>
        
        
        <?php /* Comments Options */ ?>
        <div class="postbox">
            <div class="head-wrap">
                <div title="Click to toggle" class="handlediv"><br /></div>
        		<h3 class="hndle"><?php _e( 'Comments Options', 'mgraphene' ); ?></h3>
            </div>
            <div class="panel-wrap inside">
                <table class="form-table">       	
                    <tr>
                        <th scope="row">
                            <label><?php _e( 'Commenting', 'mgraphene' ); ?></label>                            
                        </th>
                        <td>
                            <select name="mgraphene_settings[comments_setting]">
                                <option value="wordpress" <?php if ( $mgraphene_settings['comments_setting'] == 'wordpress' ) {echo 'selected="selected"';} ?>><?php _e( 'Use WordPress settings', 'mgraphene' ); ?></option>
                                <option value="disabled_pages" <?php if ( $mgraphene_settings['comments_setting'] == 'disabled_pages' ) {echo 'selected="selected"';} ?>><?php _e( 'Disabled for pages', 'mgraphene' ); ?></option>
                                <option value="disabled_completely" <?php if ( $mgraphene_settings['comments_setting'] == 'disabled_completely' ) {echo 'selected="selected"';} ?>><?php _e( 'Disabled completely', 'mgraphene' ); ?></option>                               
                            </select><br />
                            <span class="description"><?php _e( 'Note: this setting overrides the global WordPress Discussion Setting called "Allow people to post comments on new articles" and also the "Allow comments" option for individual posts/pages.', 'mgraphene' ); ?></span>
                        </td>
                    </tr>
                </table>
                
                <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
            </div>
        </div>
        
        
        <?php /* Child Page Options */ ?>
        <div class="postbox">
            <div class="head-wrap">
                <div title="Click to toggle" class="handlediv"><br /></div>
        		<h3 class="hndle"><?php _e( 'Child Page Options', 'mgraphene' ); ?></h3>
            </div>
            <div class="panel-wrap inside">
                <table class="form-table">       	
                    <tr>
                        <th scope="row">
                            <label><?php _e( 'Hide parent box if content is empty', 'mgraphene' ); ?></label>                            
                        </th>
                        <td><input type="checkbox" name="mgraphene_settings[hide_parent_content_if_empty]" <?php if ( $mgraphene_settings['hide_parent_content_if_empty'] == true) echo 'checked="checked"' ?> value="true" /></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php _e( 'Child page listings', 'mgraphene' ); ?></label>                            
                        </th>
                        <td>
                            <select name="mgraphene_settings[child_page_listing]">
                                <option value="show_always" <?php if ( $mgraphene_settings['child_page_listing'] == 'show_always' ) {echo 'selected="selected"';} ?>><?php _e( 'Show listing', 'mgraphene' ); ?></option>
                                <option value="hide" <?php if ( $mgraphene_settings['child_page_listing'] == 'hide' ) {echo 'selected="selected"';} ?>><?php _e( 'Hide listing', 'mgraphene' ); ?></option>
                                <option value="show_if_parent_empty" <?php if ( $mgraphene_settings['child_page_listing'] == 'show_if_parent_empty' ) {echo 'selected="selected"';} ?>><?php _e( 'Only show listing if parent content is empty', 'mgraphene' ); ?></option>
                            </select>
                        </td>                            
                    </tr>
                </table>
                
                <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
            </div>
        </div>
        
        
        <?php /* Google Analytics Options */ ?>
        <div class="postbox">
            <div class="head-wrap">
                <div title="Click to toggle" class="handlediv"><br /></div>
        		<h3 class="hndle"><?php _e( 'Google Analytics Options', 'mgraphene' ); ?></h3>
            </div>
            <div class="panel-wrap inside">
                <p><?php _e( '<strong>Note:</strong> the theme places the Google Analytics script in the <code>&lt;head&gt;</code> element to support the new asynchronous Google Analytics script. Please make sure you use the new asynchronous script from Google Analytics.', 'mgraphene' ); ?></p>
                <table class="form-table">       	
                    <tr>
                        <th scope="row"><label><?php _e( 'Enable Google Analytics tracking', 'mgraphene' ); ?></label></th>
                        <td><input type="checkbox" name="mgraphene_settings[show_ga]" <?php if ( $mgraphene_settings['show_ga'] == true) echo 'checked="checked"' ?> value="true" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label><?php _e("Google Analytics tracking code", 'mgraphene' ); ?></label><br />
                        <small><?php _e( 'Make sure you include the full tracking code (including the <code>&lt;script&gt;</code> and <code>&lt;/script&gt;</code> tags) and not just the <code>UA-#######-#</code> code.','mgraphene' ); ?></small>
                        </th>
                        <td><textarea name="mgraphene_settings[ga_code]" cols="60" rows="7" class="widefat code"><?php echo htmlentities(stripslashes( $mgraphene_settings['ga_code'] ) ); ?></textarea></td>
                    </tr>
                </table>
                
                <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
            </div>
        </div>
        
        
        <?php /* Footer Options */ ?>
        <div class="postbox">
            <div class="head-wrap">
                <div title="Click to toggle" class="handlediv"><br /></div>
        		<h3 class="hndle"><?php _e( 'Footer Options', 'mgraphene' ); ?></h3>
            </div>
            <div class="panel-wrap inside">
                <table class="form-table">       	
                    <tr>
                        <th scope="row"><label><?php _e( 'Copyright text (html allowed)' , 'mgraphene' ); ?></label>
                        <br /><small><?php _e( 'If this field is empty, the following default copyright text will be displayed:', 'mgraphene' ); ?></small>
                        <p style="background-color:#fff;padding:5px;border:1px solid #ddd;">
							<?php /* translators: %d will be replaced by the current year, %s will be replaced by the site title, &copy; will be replaced by the copyright symbol */ ?>
	                		<?php printf( __( 'Copyright &copy; %d %s', 'mgraphene' ), date( 'Y' ), mgraphene_get_bloginfo( 'name' ) ); ?>
                        </p>
                        </th>
                        <td><textarea name="mgraphene_settings[copy_text]" cols="60" rows="7"><?php echo stripslashes( $mgraphene_settings['copy_text'] ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label><?php _e( 'Do not show copyright info', 'mgraphene' ); ?></label></th>
                        <td><input type="checkbox" name="mgraphene_settings[hide_copyright]" <?php if ( $mgraphene_settings['hide_copyright'] == true) echo 'checked="checked"' ?> value="true" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label><?php _e( 'Do not show the "Return to top" link', 'mgraphene' ); ?></label></th>
                        <td><input type="checkbox" name="mgraphene_settings[hide_return_top]" <?php if ( $mgraphene_settings['hide_return_top'] == true ) echo 'checked="checked"' ?> value="true" /></td>
                    </tr>
                </table>
                
                <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
            </div>
        </div>
        
        
        <?php /* Miscellaneous general options  */ ?>
        <div class="postbox">
            <div class="head-wrap">
                <div title="Click to toggle" class="handlediv"><br /></div>
                <h3 class="hndle"><?php _e( 'Miscellaneous General Options', 'mgraphene' ); ?></h3>
            </div>
            <div class="panel-wrap inside">
                <table class="form-table">
                    <tr>
                        <th scope="row" style="width:250px;">
                            <label for="allow_zoom"><?php _e( 'Allow device to zoom in', 'mgraphene' ); ?></label>
                        </th>
                        <td><input type="checkbox" name="mgraphene_settings[allow_zoom]" <?php if ( $mgraphene_settings['allow_zoom'] == true ) echo 'checked="checked"' ?> value="true" /></td>
                    </tr>
                </table>
                
                <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
            </div>
        </div>
        
        
<?php } // Closes the mgraphene_options_general() function definition 