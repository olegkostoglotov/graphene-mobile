<?php 
function mgraphene_options_display() { global $mgraphene_settings;	?>
        
    <input type="hidden" name="mgraphene_display" value="true" />
        
    <?php /* Header options */ ?>
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Header Options', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
        	<h4><?php _e( 'Alternate site title and description', 'mgraphene' ); ?></h4>
            <p><?php _e( 'Short site title and description work best for display on a mobile device. If your site has a long site title and description (anything that spans more than a single line when displayed on a mobile device), you can use this option to specify an alternate site title and description for display in the header.', 'mgraphene' ); ?></p>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="alt_site_title"><?php _e( 'Alternate site title', 'mgraphene' ); ?></label></th>
                    <td>
                    	<input type="text" name="mgraphene_settings[alt_site_title]" id="alt_site_title" size="60" value="<?php echo stripslashes( $mgraphene_settings['alt_site_title'] ); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="alt_site_desc"><?php _e( 'Alternate site description', 'mgraphene' ); ?></label></th>
                    <td>
                    	<input type="text" name="mgraphene_settings[alt_site_desc]" id="alt_site_desc" size="60" value="<?php echo stripslashes( $mgraphene_settings['alt_site_desc'] ); ?>" />
                    </td>
                </tr>
            </table>
            
            <h4><?php _e( 'Search bar', 'mgraphene' ); ?></h4>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="disable_search_bar"><?php _e( 'Disable search bar', 'mgraphene' ); ?></label></th>
                    <td>
                    	<input type="checkbox" name="mgraphene_settings[disable_search_bar]" id="disable_search_bar" <?php checked( $mgraphene_settings['disable_search_bar'] ); ?> value="true" />
                    </td>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
    
    
    <?php /* Navigation Menu options */ ?>
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Navigation Menu Options', 'mgraphene' ); ?></h3>
        </div>
      	<div class="panel-wrap inside">
            <h4><?php esc_html_e( '<select> element for menu', 'mgraphene' ); ?></h4>
            <p><?php esc_html_e( 'Using <select> element for menu allows you to have any number of menu items without crowding the layout.', 'mgraphene' ); ?></p>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="alt_site_title"><?php _e( 'Enable for Header Menu', 'mgraphene' ); ?></label></th>
                    <td>
                    	<input type="checkbox" name="mgraphene_settings[header_menu_use_select]" <?php checked( $mgraphene_settings['header_menu_use_select'] ); ?> value="true" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="alt_site_title"><?php _e( 'Enable for Footer Menu', 'mgraphene' ); ?></label></th>
                    <td>
                        <input type="checkbox" name="mgraphene_settings[footer_menu_use_select]" <?php checked( $mgraphene_settings['footer_menu_use_select'] ); ?> value="true" />
                    </td>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
    
    
    <?php /* Posts Display Options */ ?>
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Posts Display Options', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Hide post author and date', 'mgraphene' ); ?></label>
                    </th>
                    <td><input type="checkbox" name="mgraphene_settings[hide_post_meta]" <?php if ( $mgraphene_settings['hide_post_meta'] == true ) echo 'checked="checked"' ?> value="true" /></td>
                </tr>                
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Hide post categories', 'mgraphene' ); ?></label>
                    </th>
                    <td><input type="checkbox" name="mgraphene_settings[hide_post_cat]" <?php if ( $mgraphene_settings['hide_post_cat'] == true ) echo 'checked="checked"' ?> value="true" /></td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Hide post tags', 'mgraphene' ); ?></label>
                    </th>
                    <td><input type="checkbox" name="mgraphene_settings[hide_post_tags]" <?php if ( $mgraphene_settings['hide_post_tags'] == true ) echo 'checked="checked"' ?> value="true" /></td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Hide post comment count', 'mgraphene' ); ?></label><br />
                        <small><?php _e( 'Only affects posts listing (such as search and archive pages) and not single post view.', 'mgraphene' ); ?></small>                        
                    </th>
                    <td><input type="checkbox" name="mgraphene_settings[hide_post_commentcount]" <?php if ( $mgraphene_settings['hide_post_commentcount'] == true ) echo 'checked="checked"' ?> value="true" /></td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Hide automatic image at the top of posts', 'mgraphene' ); ?></label><br />
                    </th>
                    <td><input type="checkbox" name="mgraphene_settings[hide_post_image]" <?php if ( $mgraphene_settings['hide_post_image'] == true ) echo 'checked="checked"' ?> value="true" /></td>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
    
    
    <?php /* Excerpts Display Options */ ?>
    <div class="postbox non-essential-option">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Excerpts Display Options', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="archive_full_content"><?php _e( 'Show full content in archive pages', 'mgraphene' ); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="mgraphene_settings[archive_full_content]" id="archive_full_content" <?php checked( $mgraphene_settings['archive_full_content'] ); ?> value="true" /><br />
                        <span class="description"><?php _e( 'Note: Archive pages include the archive for category, tags, time, and search results pages. Enabling this option will cause the full content of posts and pages listed in those archives to displayed instead of the excerpt, and truncated by the Read More tag if used.', 'mgraphene' ); ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="excerpt_html_tags"><?php _e("Retain these HTML tags in excerpts", 'mgraphene' ); ?></label></th>
                    <td>
                        <input type="text" class="widefat code" name="mgraphene_settings[excerpt_html_tags]" id="excerpt_html_tags" value="<?php echo $mgraphene_settings['excerpt_html_tags']; ?>" /><br />
                        <span class="description"><?php _e("Enter the HTML tags you'd like to retain in excerpts. For example, enter <code>&lt;p&gt;&lt;ul&gt;&lt;li&gt;</code> to retain <code>&lt;p&gt;</code>, <code>&lt;ul&gt;</code>, and <code>&lt;li&gt;</code> HTML tags.", 'mgraphene' ); ?></span>
                    </td>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
    
    
    <?php /* Custom Background Options */ ?>
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Custom Background Options', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            <table class="form-table">
            	<tr>
                	<th scope="row"><?php _e( 'Preview', 'mgraphene' ); ?></th>
                    <td><div id="mgraphene-bg-preview" class="widefat"></div></td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Background image URL', 'mgraphene' ); ?></label>
                    </th>
                    <td>
                    	<input type="text" name="mgraphene_settings[bg_imgurl]" class="widefat code" id="bg-imgurl" value="<?php echo $mgraphene_settings['bg_imgurl']; ?>" /><br />
                        <span class="description">
							<?php _e( 'Hint: You can use the <a href="media-new.php">Media Library</a> to upload an image to be used here.', 'mgraphene' ); ?>
                            <?php _e( "If you do not wish the background to be repeated, use an image at least as wide as 640 pixels (Apple's retina display)", 'mgraphene' ); ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Position', 'mgraphene' ); ?></label>
                    </th>
                    <td class="bg-position-wrap">
                    	<input type="radio" name="mgraphene_settings[bg_position]" value="left top" id="bg-position-left" <?php if ( $mgraphene_settings['bg_position'] == 'left top' ) echo 'checked="checked"' ?> />
                        <label for="bg-position-left"><?php _e( 'Left', 'mgraphene' ); ?></label>
                        
                        <input type="radio" name="mgraphene_settings[bg_position]" value="center top" id="bg-position-center" <?php if ( $mgraphene_settings['bg_position'] == 'center top' ) echo 'checked="checked"' ?> />
                        <label for="bg-position-center"><?php _e( 'Center', 'mgraphene' ); ?></label>
                        
                        <input type="radio" name="mgraphene_settings[bg_position]" value="right top" id="bg-position-right" <?php if ( $mgraphene_settings['bg_position'] == 'right top' ) echo 'checked="checked"' ?> />
                        <label for="bg-position-right"><?php _e( 'Right', 'mgraphene' ); ?></label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Repeat', 'mgraphene' ); ?></label>
                    </th>
                    <td class="bg-repeat-wrap">
                    	<input type="radio" name="mgraphene_settings[bg_repeat]" value="no-repeat" id="bg-repeat-no-repeat" <?php if ( $mgraphene_settings['bg_repeat'] == 'no-repeat' ) echo 'checked="checked"' ?> />
                        <label for="bg-repeat-no-repeat"><?php _e( 'No Repeat', 'mgraphene' ); ?></label>
                        
                        <input type="radio" name="mgraphene_settings[bg_repeat]" value="repeat" id="bg-repeat-tile" <?php if ( $mgraphene_settings['bg_repeat'] == 'repeat' ) echo 'checked="checked"' ?> />
                        <label for="bg-repeat-tile"><?php _e( 'Tile', 'mgraphene' ); ?></label>
                        
                        <input type="radio" name="mgraphene_settings[bg_repeat]" value="repeat-x" id="bg-repeat-tile-x" <?php if ( $mgraphene_settings['bg_repeat'] == 'repeat-x' ) echo 'checked="checked"' ?> />
                        <label for="bg-repeat-tile-x"><?php _e( 'Tile Horizontally', 'mgraphene' ); ?></label>
                        
                        <input type="radio" name="mgraphene_settings[bg_repeat]" value="repeat-y" id="bg-repeat-tile-y" <?php if ( $mgraphene_settings['bg_repeat'] == 'repeat-y' ) echo 'checked="checked"' ?> />
                        <label for="bg-repeat-tile-y"><?php _e( 'Tile Vertically', 'mgraphene' ); ?></label>
                    </td>
                </tr>
                <!-- CSS background attachment is not supported by Android and iPhone. Until they do, this option will achieve nothing
                <tr>
                    <th scope="row">
                        <label><?php _e( 'Attachment', 'mgraphene' ); ?></label>
                    </th>
                    <td class="bg-attachment-wrap">
                    	<input type="radio" name="mgraphene_settings[bg_attachment]" value="scroll" id="bg-attach-scroll" <?php if ( $mgraphene_settings['bg_attachment'] == 'scroll' ) echo 'checked="checked"' ?> />
                        <label for="bg-attach-scroll"><?php _e( 'Scroll', 'mgraphene' ); ?></label>
                        
                        <input type="radio" name="mgraphene_settings[bg_attachment]" value="fixed" id="bg-attach-fixed" <?php if ( $mgraphene_settings['bg_attachment'] == 'fixed' ) echo 'checked="checked"' ?> />
                        <label for="bg-attach-fixed"><?php _e( 'Fixed', 'mgraphene' ); ?></label>
                    </td>
                </tr>
                -->
                <tr>
                    <th scope="row"><label><?php _e( 'Colour', 'mgraphene' ); ?></label></th>
                    <td>
                        <input type="text" class="code color" name="mgraphene_settings[bg_colour]" id="bg_colour" value="<?php echo $mgraphene_settings['bg_colour']; ?>" />
                        <a href="#" class="clear-color"><?php _e( 'Clear', 'mgraphene' ); ?></a>
                        <div class="colorpicker" id="picker_bg_colour"></div>
                    </td>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
        
	
    <?php /* Miscellaneous options  */ ?>
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Miscellaneous Display Options', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            <h4><?php _e( 'Site title options', 'mgraphene' ); ?></h4>
            <p><?php _e( 'This option allows you to customise how your site title is displayed in the browser bar, tabs, and bookmarks.', 'mgraphene' ); ?></p>
            <p><?php _e( 'Use these tags to customise your own site title structure: <code>#site-name</code>, <code>#site-desc</code>, <code>#post-title</code>', 'mgraphene' ); ?></p>
            <table class="form-table">
                <tr>
                    <th scope="row" style="width:250px;">
                        <label><?php _e( 'Custom front page site title', 'mgraphene' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="mgraphene_settings[custom_site_title_frontpage]" id="custom_site_title_frontpage" class="widefat code" value="<?php echo stripslashes( $mgraphene_settings['custom_site_title_frontpage'] ); ?>" />
                        <span class="description"><?php printf( __( 'Defaults to %1$s. The %2$s tag cannot be used here.', 'mgraphene' ), '<code>#site-name &raquo; #site-desc</code>',  '<code>#post-title</code>' ); ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="width:250px;">
                        <label><?php _e( 'Custom content pages site title', 'mgraphene' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="mgraphene_settings[custom_site_title_content]" id="custom_site_title_content" class="widefat code" value="<?php echo stripslashes( $mgraphene_settings['custom_site_title_content'] ); ?>" />
                        <span class="description"><?php printf( __('Defaults to %s.', 'mgraphene'), '<code>#post-title &raquo; #site-name</code>' ); ?></span>
                    </td>
                </tr>
            </table>
            
            <h4><?php _e( 'Favicon options', 'mgraphene' ); ?></h4>
            <table class="form-table">
                <tr>
                    <th scope="row" style="width:250px;">
                        <label for="favicon_url"><?php _e( 'Favicon URL', 'mgraphene' ); ?></label>
                    </th>
                    <td>
                        <input type="text" class="widefat code" value="<?php echo $mgraphene_settings['favicon_url']; ?>" name="mgraphene_settings[favicon_url]" id="favicon_url" />
                        <span class="description"><?php _e( 'Simply enter the full URL to your favicon file here to enable favicon.', 'mgraphene' ); ?></span>
                    </td>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
    
    
	<?php /* Custom CSS */ ?>
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Custom CSS', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            <table class="form-table">
                <tr>
                    <th scope="row"><label><?php _e( 'Custom CSS styles', 'mgraphene' ); ?></label></th>
                    <td>
                        <span class="description"><?php _e( "You can enter your own CSS codes below to modify any other aspects of the theme's appearance that is not included in the options.", 'mgraphene' ); ?></span>
                        <textarea name="mgraphene_settings[custom_css]" cols="60" rows="20" class="widefat code"><?php echo stripslashes( $mgraphene_settings['custom_css'] ); ?></textarea>
                    </td>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
        
<?php } // Closes the mgraphene_options_display() function definition 