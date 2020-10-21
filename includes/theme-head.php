<?php
/**
 * Prints out custom <head> tags
 *
 * @package Graphene Mobile
 * @since 1.2
 */
function mgraphene_custom_head_tags(){
	global $mgraphene_settings;
	echo $mgraphene_settings['head_tags'];
}
add_action( 'wp_head', 'mgraphene_custom_head_tags', 100 );