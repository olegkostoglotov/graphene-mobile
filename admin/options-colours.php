<?php 
function mgraphene_options_colours() { global $mgraphene_settings;	?>
	
	<input type="hidden" name="mgraphene_colours" value="true" />
    
    <p><?php _e( '<strong>Note:</strong> To reset any of the colours to their default value, just click on "Clear" beside the colour field and save the settings. The theme will automatically revert the value to the default colour.', 'mgraphene' ); ?></p>
    
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Header and navigation', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
        	
            <table class="form-table">
            	<tr>
                	<th scope="row"><?php _e( 'Preview', 'mgraphene' ); ?></th>
                    <td>
                    	<div class="mgraphene-preview mgraphene-header-preview widefat">
                        	<div id="header"><p class="site-title"><a href="#"><?php _e( 'Site title', 'mgraphene' ); ?></a></p><p class="site-desc"><?php _e( 'Site description', 'mgraphene' ); ?></p></div>
                            <div class="bottom-shadow">&nbsp;</div>
                            <div id="nav">
                                <ul class="menu clearfix" id="header-menu">
                                	<li class="current-menu-item menu-item"><a href="#"><?php _e( 'Current menu item', 'mgraphene' ); ?></a></li>
                                    <li class="menu-item"><a href="#"><?php _e( 'Menu item', 'mgraphene' ); ?></a></li>
                                    <li class="menu-item"><a href="#"><?php _e( 'Menu item', 'mgraphene' ); ?></a></li>
                    			</ul>            
                            </div>
                            <div class="bottom-shadow">&nbsp;</div>
                            <div id="top-search">
                            	<div class="searchform">
                                    <input type="text" value="" name="s" class="search-input" />
                                    <button type="submit" class="search-submit">Search</button>
                				</div>
                            </div>
                    	</div>
                    </td>
                    <?php 
						$colour_opts = array(
							'header_top' => array( 'title' => __( 'Header background (top)', 'mgraphene' ) ),
							'header_bottom' => array( 'title' => __( 'Header background (bottom)', 'mgraphene' ) ),
							'header_title' => array( 'title' => __( 'Site title text', 'mgraphene' ) ),
							'header_desc' => array( 'title' => __( 'Site description text', 'mgraphene' ) ),
							'nav_bg' => array( 'title' => __( 'Navigation menu background', 'mgraphene' ) ),
							'nav_bg_current' => array( 'title' => __( 'Current menu item background', 'mgraphene' ) ),
							'nav_text' => array( 'title' => __( 'Menu item text', 'mgraphene' ) ),
							'nav_text_current' => array( 'title' => __( 'Current menu item text', 'mgraphene' ) ),
						);
						
						$counter = 2;
						foreach ($colour_opts as $key => $colour_opt) :
					?>
                    <tr>
                        <th scope="row"><label><?php echo $colour_opt['title']; ?></label></th>
                        <td>
                        	<input type="text" class="code color" name="mgraphene_settings[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php echo $mgraphene_settings[$key]; ?>" />
                        	<a href="#" class="clear-color"><?php _e( 'Clear', 'mgraphene' ); ?></a>
                            <div class="colorpicker" id="picker_<?php echo $key; ?>"></div>
                        </td>
                    </tr>
                    <?php $counter++; endforeach; ?>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
         </div>
    </div>
    
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Footer', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            
            <table class="form-table">
            	<tr>
                	<th scope="row"><?php _e( 'Preview', 'mgraphene' ); ?></th>
                    <td>
                    	<div class="mgraphene-preview mgraphene-footer-preview widefat">
                        	<div id="mgraphene-footer">
                                <div class="footer-menu-wrap">
                                    <ul class="menu clearfix" id="footer-menu">
                                    	<li class="menu-item"><a href="#"><?php _e( 'Menu item', 'mgraphene' ); ?></a></li>
                                        <li class="menu-item"><a href="#"><?php _e( 'Menu item', 'mgraphene' ); ?></a></li>
				                    </ul>                
                                    <div class="copyright">                                                                      
                                    	<?php echo wpautop( sprintf( __( 'Copyright &copy; %d %s', 'mgraphene' ), date( 'Y' ), mgraphene_get_bloginfo( 'name' ) ) ); ?>
                                    </div>
                                </div>
                                <div class="top-shadow"></div>
                                <div class="credit">
                                	<p><?php printf( __( 'Powered by %s', 'mgraphene' ), '<a href="http://wordpress.org">WP</a> + <a href="http://www.khairul-syahir.com/wordpress-dev/graphene-mobile">Graphene Mobile</a>' ); ?></p>
                                </div>
                            </div>
                    	</div>
                    </td>
                    <?php 
						$colour_opts = array(
							'copyright_bg' => array( 'title' => __( 'Copyright background', 'mgraphene' ) ),
							'copyright_text' => array( 'title' => __( 'Copyright text', 'mgraphene' ) ),
							'footer_menu_text' => array( 'title' => __( 'Footer menu text', 'mgraphene' ) ),
							'credit_bg' => array( 'title' => __( 'Credit background', 'mgraphene' ) ),
							'credit_text' => array( 'title' => __( 'Credit text', 'mgraphene' ) ),
							'credit_link_text' => array( 'title' => __( 'Credit link text', 'mgraphene' ) ),
						);
						foreach ($colour_opts as $key => $colour_opt) :
					?>
                    <tr>
                        <th scope="row"><label><?php echo $colour_opt['title']; ?></label></th>
                        <td>
                        	<input type="text" class="code color" name="mgraphene_settings[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php echo $mgraphene_settings[$key]; ?>" />
                        	<a href="#" class="clear-color"><?php _e( 'Clear', 'mgraphene' ); ?></a>
                            <div class="colorpicker" id="picker_<?php echo $key; ?>"></div>
                        </td>
                    </tr>
                    <?php $counter++; endforeach; ?>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
    
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Content section', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            
            <table class="form-table">
            	<tr>
                	<th scope="row"><?php _e( 'Preview (top half)', 'mgraphene' ); ?></th>
                    <td>
                    	<div class="mgraphene-preview mgraphene-content-preview widefat">
                        	<div class="post entry">
					            <div class="entry-header">
            	            		<h2 class="entry-title"><a href="#"><?php _e( 'Layout Test', 'mgraphene' ); ?></a></h2>
	                                <div class="entry-meta"><?php printf( __( '%1$s by %2$s', 'mgraphene' ), '<span class="post-list-date">' . date( get_option( 'date_format' ) ) . '</span>', '<span class="post-list-author">' . __( 'the author', 'mgraphene' ) . '</span>' ); ?></div>
                            	</div>
					            <div class="top-shadow">&nbsp;</div>
                        		<div class="entry-cats">
            	                	<p><?php _e( 'Categories:', 'mgraphene' ); ?> <a href="#"><?php _e( 'Category 1', 'mgraphene' ); ?></a> <a href="#"><?php _e( 'Category 2', 'mgraphene' ); ?></a> <a href="#"><?php _e( 'Category 3', 'mgraphene' ); ?></a></p>
	                            </div>
					            <div class="bottom-shadow">&nbsp;</div>            	 
                                <div class="entry-wrap clearfix">
                                    <div class="entry-content">
                                     	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#">Suspendisse hendrerit</a> ornare risus quis venenatis. Donec nec nisi eu ligula lacinia viverra in ut elit. Donec convallis iaculis laoreet. In arcu velit, suscipit a imperdiet et, egestas non purus. Vestibulum felis libero, feugiat quis auctor eget, gravida vitae nisi.</p>
                                    </div>
                                </div>
				            </div>
    				    </div>
                    </td>
                </tr>
				<?php 
                    $colour_opts = array(
                        'content_title_bg' => array( 'title' => __( 'Title background', 'mgraphene' ) ),
                        'content_title_text' => array( 'title' => __( 'Title text', 'mgraphene' ) ),
                        'content_meta_text' => array( 'title' => __( 'Meta text', 'mgraphene' ) ),
                        'content_cat_bg' => array( 'title' => __( 'Categories background', 'mgraphene' ) ),
                        'content_cat_text' => array( 'title' => __( 'Categories text', 'mgraphene' ) ),
                        'content_cat_link_bg' => array( 'title' => __( 'Category items background', 'mgraphene' ) ),
                        'content_cat_link_text' => array( 'title' => __( 'Category items text', 'mgraphene' ) ),
						'content_bg' => array( 'title' => __( 'Content background', 'mgraphene' ) ),
                        'content_text' => array( 'title' => __( 'Content text', 'mgraphene' ) ),
                        'content_link' => array( 'title' => __( 'Content link', 'mgraphene' ) ),
                    );
                    foreach ($colour_opts as $key => $colour_opt) :
                ?>
                <tr>
                    <th scope="row"><label><?php echo $colour_opt['title']; ?></label></th>
                    <td>
                        	<input type="text" class="code color" name="mgraphene_settings[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php echo $mgraphene_settings[$key]; ?>" />
                        	<a href="#" class="clear-color"><?php _e( 'Clear', 'mgraphene' ); ?></a>
                            <div class="colorpicker" id="picker_<?php echo $key; ?>"></div>
                        </td>
                </tr>
                <?php $counter++; endforeach; ?>
                
                <tr>
                	<th scope="row"><?php _e( 'Preview (bottom half)', 'mgraphene' ); ?></th>
                    <td>
                    	<div class="mgraphene-preview mgraphene-content-preview widefat">
                        	<div class="post entry">       	 
                                <div class="entry-wrap clearfix">
	                				<div class="pages-links"><p><?php _e( 'Pages:', 'mgraphene' ); ?> 1 <a href="#">2</a> <a href="#">3</a></p></div>
                                </div>
				            </div>
                            <div class="top-shadow">&nbsp;</div>
				            <div class="entry-tags">
            	                <p><?php _e( 'Tags:', 'mgraphene' ); ?> <a href="#"><?php _e( 'Tag 1', 'mgraphene' ); ?></a> <a href="#"><?php _e( 'Tag 2', 'mgraphene' ); ?></a> <a href="#"><?php _e( 'Tag 3', 'mgraphene' ); ?></a></p>
                            </div>                            
                            <div class="top-shadow">&nbsp;</div>
                            <div class="entry-nav clearfix">
                                <p class="prev"><span class="post-link"><a href="#">&laquo; <?php _e( 'Previous Post', 'mgraphene' ); ?></a></span><br /><span class="post-title"><a href="#"><?php _e( 'Post title', 'mgraphene' ); ?></a></span></p>
                                <p class="next"><span class="post-link"><a href="#"><?php _e( 'Next Post', 'mgraphene' ); ?> &raquo;</a></span><br /><span class="post-title"><a href="#"><?php _e( 'Post title', 'mgraphene' ); ?></a></span></p>
                            </div>
    				    </div>
                    </td>
                </tr>
                
                <?php 
                    $colour_opts = array(
                        'content_pages_bg' => array( 'title' => __( 'Pagination background', 'mgraphene' ) ),
                        'content_pages_text' => array( 'title' => __( 'Pagination text', 'mgraphene' ) ),
						'content_pages_link' => array( 'title' => __( 'Pagination link', 'mgraphene' ) ),
                        'content_tag_bg' => array( 'title' => __( 'Tags background', 'mgraphene' ) ),
                        'content_tag_text' => array( 'title' => __( 'Tags text', 'mgraphene' ) ),
                        'content_tag_link_bg' => array( 'title' => __( 'Tag items background', 'mgraphene' ) ),
                        'content_tag_link_text' => array( 'title' => __( 'Tag items text', 'mgraphene' ) ),
                        'content_nav_bg' => array( 'title' => __( 'Posts navigation background', 'mgraphene' ) ),
                        'content_nav_next_bg' => array( 'title' => __( 'Posts navigation background (next)', 'mgraphene' ) ),
                        'content_nav_text' => array( 'title' => __( 'Posts navigation text', 'mgraphene' ) ),
                        'content_nav_link' => array( 'title' => __( 'Posts navigation link', 'mgraphene' ) ),
                    );
                    foreach ($colour_opts as $key => $colour_opt) :
                ?>
                <tr>
                    <th scope="row"><label><?php echo $colour_opt['title']; ?></label></th>
                    <td>
                        <input type="text" class="code color" name="mgraphene_settings[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php echo $mgraphene_settings[$key]; ?>" />
                        <a href="#" class="clear-color"><?php _e( 'Clear', 'mgraphene' ); ?></a>
                        <div class="colorpicker" id="picker_<?php echo $key; ?>"></div>
                    </td>
                </tr>
                <?php $counter++; endforeach; ?>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
    
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Other sections', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            
            <table class="form-table">
            	<tr>
                	<th scope="row"><?php _e( 'Preview', 'mgraphene' ); ?></th>
                    <td>
                    	<div class="mgraphene-preview mgraphene-sections-preview widefat">
                        	<div class="post-list-wrap">
                                <span class="post-list-title"><a href="#"><?php _e( 'Section title', 'mgraphene' ); ?></a></span>
                        		<div class="bottom-shadow"></div>
                                <div class="post-list-content">
                                    <ul class="post-list">
                                        <li><a class="post-title" href="#">Post title</a><br>
                                        <?php printf( __( '%1$s by %2$s', 'mgraphene' ), '<span class="post-list-date">' . date( get_option( 'date_format' ) ) . '</span>', '<span class="post-list-author">' . __( 'the author', 'mgraphene' ) . '</span>' ); ?> &mdash; <a href="#"><?php _e( 'Leave a comment', 'mgraphene' ); ?></a>
                                        </li>
                                        <li><a class="post-title" href="#">Post title</a><br>
                                        <?php printf( __( '%1$s by %2$s', 'mgraphene' ), '<span class="post-list-date">' . date( get_option( 'date_format' ) ) . '</span>', '<span class="post-list-author">' . __( 'the author', 'mgraphene' ) . '</span>' ); ?> &mdash; <a href="#"><?php _e( 'Leave a comment', 'mgraphene' ); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="top-shadow"></div>
                            <div class="entry-nav posts-nav clearfix">
                            	<p class="prev"><a href="#" class="prev-link">« <?php _e( 'Previous Page', 'mgraphene' ); ?></a></p>
                            	<p class="next"><a href="#" class="next-link"><?php _e( 'Next Page', 'mgraphene' ); ?> »</a></p>
                            </div>
                    	</div>
                    </td>
                    <?php 
						$colour_opts = array(
							'section_title_bg_top' => array( 'title' => __( 'Title background (top)', 'mgraphene' ) ),
							'section_title_bg_bottom' => array( 'title' => __( 'Title background (bottom)', 'mgraphene' ) ),
							'section_title_text' => array( 'title' => __( 'Title text', 'mgraphene' ) ),
							'section_bg' => array( 'title' => __( 'Content background', 'mgraphene' ) ),
							'section_text' => array( 'title' => __( 'Content text', 'mgraphene' ) ),
							'section_link' => array( 'title' => __( 'Content link', 'mgraphene' ) ),
							'section_list_border' => array( 'title' => __( 'Content list border', 'mgraphene' ) ),
							'section_nav_bg' => array( 'title' => __( 'Navigation background', 'mgraphene' ) ),
							'section_nav_text' => array( 'title' => __( 'Navigation text', 'mgraphene' ) ),
						);
						foreach ($colour_opts as $key => $colour_opt) :
					?>
                    <tr>
                        <th scope="row"><label><?php echo $colour_opt['title']; ?></label></th>
                        <td>
                        	<input type="text" class="code color" name="mgraphene_settings[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php echo $mgraphene_settings[$key]; ?>" />
                        	<a href="#" class="clear-color"><?php _e( 'Clear', 'mgraphene' ); ?></a>
                            <div class="colorpicker" id="picker_<?php echo $key; ?>"></div>
                        </td>
                    </tr>
                    <?php $counter++; endforeach; ?>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
    
    <div class="postbox">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
            <h3 class="hndle"><?php _e( 'Comments section', 'mgraphene' ); ?></h3>
        </div>
        <div class="panel-wrap inside">
            
            <table class="form-table">
            	<tr>
                	<th scope="row"><?php _e( 'Preview', 'mgraphene' ); ?></th>
                    <td>
                    	<div class="mgraphene-preview mgraphene-comments-preview">
                        	<div class="comments-wrap" id="comments">
                                <div class="comments-wrap-header clearfix">
                                    <span class="comments-count"><a href="#">1 comment</a></span>
                                    <span class="pings-count"><a href="#">No ping yet</a></span>
                                </div>
                                <div class="bottom-shadow">&nbsp;</div>                                
                                <span class="add-comment"><a href="#">Leave a reply</a></span>
                                <div class="bottom-shadow">&nbsp;</div>
                                <ol class="comments-list comments">
									<li class="comment even thread-even depth-1 clearfix" id="comment-1">
                                    <img width="40" height="40" class="avatar avatar-40 photo avatar-default" src="http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=40" alt="">
                                    	<div class="comment-meta clearfix">
                                        	<p class="comment-author"><a class="url" rel="external nofollow" href="http://wordpress.org/">Mr WordPress</a> says:</p>
                                            <p class="comment-date">July 6, 2011 at 4:41 am</p>
                                        </div>
                                        <div class="comment-entry">
                                            <p>Hi, this is a comment.<br>To delete a comment, just log in and view the post's comments. There you will have the option to edit or delete them.</p>
                                        </div>                               
                                    </li>
                                </ol>
                            </div>
                    	</div>
                    </td>
                    <?php 
						$colour_opts = array(
							'comments_title_bg_top' => array( 'title' => __( 'Heading background (top)', 'mgraphene' ) ),
							'comments_title_bg_bottom' => array( 'title' => __( 'Heading background (bottom)', 'mgraphene' ) ),
							'comments_title_divider' => array( 'title' => __( 'Heading divider', 'mgraphene' ) ),
							'comments_title_text' => array( 'title' => __( 'Heading text', 'mgraphene' ) ),
							'comments_reply_bg' => array( 'title' => __( 'Reply background', 'mgraphene' ) ),
							'comments_reply_text' => array( 'title' => __( 'Reply text', 'mgraphene' ) ),
							'comments_meta_text' => array( 'title' => __( 'Meta text', 'mgraphene' ) ),
							'comments_bg' => array( 'title' => __( 'Content background', 'mgraphene' ) ),
							'comments_text' => array( 'title' => __( 'Content text', 'mgraphene' ) ),
							'comments_link' => array( 'title' => __( 'Content link', 'mgraphene' ) ),
							'comments_list_border' => array( 'title' => __( 'Content list border', 'mgraphene' ) ),
						);
						foreach ($colour_opts as $key => $colour_opt) :
					?>
                    <tr>
                        <th scope="row"><label><?php echo $colour_opt['title']; ?></label></th>
                        <td>
                        	<input type="text" class="code color" name="mgraphene_settings[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php echo $mgraphene_settings[$key]; ?>" />
                        	<a href="#" class="clear-color"><?php _e( 'Clear', 'mgraphene' ); ?></a>
                            <div class="colorpicker" id="picker_<?php echo $key; ?>"></div>
                        </td>
                    </tr>
                    <?php $counter++; endforeach; ?>
                </tr>
            </table>
            
            <p class="submit clearfix"><input type="submit" class="button" value="<?php _e( 'Save All Options', 'graphene' ); ?>" /></p>
        </div>
    </div>
	
<?php } // Closes the mgraphene_options_colours() function definition 