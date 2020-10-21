<?php
function mgraphene_options_advanced() { 
    global $mgraphene_settings;
    ?>
        
    <input type="hidden" name="mgraphene_advanced" value="true" />    
    
    <?php /* <head> tags */ ?>
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php esc_html_e( 'Custom <head> Tags', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="head_tags"><?php esc_html_e( 'Code to insert into the <head> element', 'mgraphene' ); ?></label></th>
                    <td><textarea name="mgraphene_settings[head_tags]" id="head_tags" cols="60" rows="7" class="widefat code"><?php echo htmlentities( stripslashes( $mgraphene_settings['head_tags'] ) ); ?></textarea></td>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'mgraphene' ); ?>" /></p>
        </div>
    </div>  
    
    
    <?php /* Action hooks widgets areas */ ?>
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Action Hooks Widget Areas', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
        	<p><?php _e("This option enables you to place virtually any content to every nook and cranny in the theme, by attaching widget areas to the theme's action hooks.", 'mgraphene' ); ?></p>
            <p><?php _e("All action hooks available in the Graphene Mobile Theme are listed below. Click on the filename to display all the action hooks available in that file. Then, tick the checkbox next to an action hook to make a widget area available for that action hook.", 'mgraphene' ); ?></p>
            
            <ul class="mgraphene-action-hooks">    
                <?php                
                $actionhooks = mgraphene_get_action_hooks();
                foreach ( $actionhooks as $actionhook) : 
                    $file = $actionhook['file']; 
                ?>
                    <li>
                        <p class="hooks-file"><a href="#" class="toggle-widget-hooks" title="<?php _e( 'Click to show/hide the action hooks for this file', 'mgraphene' ); ?>"><?php echo $file; ?></a></p>
                        <ul class="hooks-list">
                            <li class="widget-hooks<?php if(count(array_intersect( $actionhook['hooks'], $mgraphene_settings['widget_hooks'] ) ) == 0) echo ' hide'; ?>">
								<?php foreach ( $actionhook['hooks'] as $hook) : ?>
                                    <input type="checkbox" name="mgraphene_settings[widget_hooks][]" value="<?php echo $hook; ?>" id="hook_<?php echo $hook; ?>" <?php if ( in_array( $hook, $mgraphene_settings['widget_hooks'] ) ) echo 'checked="checked"'; ?> /> <label for="hook_<?php echo $hook; ?>"><?php echo $hook; ?></label><br />
                                <?php endforeach; ?>
                            </li>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <p class="submit clearfix">
            	<a href="themes.php?page=mgraphene_options&tab=advanced&rescan_hooks=true" class="button"><?php _e( 'Rescan action hooks', 'mgraphene' ); ?></a>
            	<input type="submit" class="button" value="<?php _e( 'Save All Options', 'mgraphene' ); ?>" />
            </p>
        </div>
    </div>
    
<?php } // Closes the mgraphene_options_advanced() function definition