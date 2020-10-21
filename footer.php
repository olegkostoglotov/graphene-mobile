<?php global $mgraphene_settings; do_action( 'mgraphene_footer_before' ); ?>
		
        <div id="footer">
            <div class="top-shadow"></div>
            
            <div class="footer-menu-wrap">
            	<?php /* Footer menu */
					$args = array(
						'container'			=> '',
						'menu_id'			=> 'footer-menu',
						'menu_class' 		=> 'menu clearfix',
						'fallback_cb' 		=> '',
						'depth' 			=> 1,
						'theme_location'	=> 'mgraphene-footer-menu',
					);

					if ( $mgraphene_settings['footer_menu_use_select'] ) {
						$args['depth'] = 0;
						mgraphene_dropdown_menu( apply_filters( 'mgraphene_footer_menu_args', $args ) );
					} else {
						wp_nav_menu( apply_filters( 'mgraphene_footer_menu_args', $args ) );
					}
				?>
                
                <div class="copyright">
                	<?php do_action( 'mgraphene_copyright_top' ); ?>
                    
                	<?php if ( ! $mgraphene_settings['hide_copyright'] ) : ?>
	                	<?php if ( $mgraphene_settings['copy_text'] ) : echo $mgraphene_settings['copy_text']; else :?>
                        	<?php /* translators: %d will be replaced by the current year, %s will be replaced by the site title, &copy; will be replaced by the copyright symbol */ ?>
	                		<?php echo wpautop( sprintf( __( 'Copyright &copy; %d %s', 'mgraphene' ), date( 'Y' ), mgraphene_get_bloginfo( 'name' ) ) ); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    
					<?php do_action( 'mgraphene_copyright_bottom' ); ?>
                </div>
            </div>
            
            <div class="top-shadow"></div>
            
            <div class="credit">
            	<?php do_action( 'mgraphene_credit_top' ); ?>
            
            	<?php /* translators: %s will be replaced by the link to WordPress.org and Graphene Mobile page */ ?>
                <p><?php printf( __( 'Powered by %s', 'mgraphene' ), '<a href="http://wordpress.org">WP</a> + <a href="http://www.khairul-syahir.com/wordpress-dev/graphene-mobile">Graphene Mobile</a>' ); ?>
                	<?php if ( ! $mgraphene_settings['hide_return_top'] ) : ?>
	                    | <a href="#" class="top-return"><?php _e( 'Return to top', 'mgraphene' ); ?></a>
                    <?php endif; ?>
                </p>
                
                <?php do_action( 'mgraphene_manual_switcher_before' ); ?>
                
                <p><?php mgraphene_manual_switcher(); ?></p>
                
                <?php do_action( 'mgraphene_credit_bottom' ); ?>
            </div>
            
        </div><!-- #footer -->
        
        <?php do_action( 'mgraphene_footer_after' ); ?>
        
    </div><!-- #container -->
    
    <?php wp_footer(); ?>
<?php do_action( 'mgraphene_footer_after' ); ?>
</body>
</html>