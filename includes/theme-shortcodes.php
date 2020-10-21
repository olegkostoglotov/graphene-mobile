<?php
/**
 * Message blocks shortcodes
 */
function warning_block_shortcode_handler( $atts, $content = null, $code="" ) {
    return apply_filters( 'mgraphene_warning_shortcode', '<div class="warning_block">' . do_shortcode( $content ) . '</div>', $atts, $content, $code );
}
add_shortcode( 'warning', 'warning_block_shortcode_handler' );

function error_block_shortcode_handler( $atts, $content = null, $code="" ) {
    return apply_filters( 'mgraphene_error_shortcode', '<div class="error_block">' . do_shortcode( $content ) . '</div>', $atts, $content, $code );
}
add_shortcode( 'error', 'error_block_shortcode_handler' );

function notice_block_shortcode_handler( $atts, $content = null, $code="" ) {
	return apply_filters( 'mgraphene_notice_shortcode', '<div class="notice_block">' . do_shortcode( $content ) . '</div>', $atts, $content, $code );
}
add_shortcode( 'notice', 'notice_block_shortcode_handler' );

function important_block_shortcode_handler( $atts, $content = null, $code="" ) {
    return apply_filters( 'mgraphene_important_shortcode', '<div class="important_block">' . do_shortcode( $content ) . '</div>', $atts, $content, $code );
}
add_shortcode( 'important', 'important_block_shortcode_handler' );


/**
 * Pullquote shortcode
 */
function mgraphene_pullquote_handler( $atts, $content = NULL, $code = '' ) {
	if ( ! $content ) return;
	
	$style = array();
	
	$class = array( 'pullquote', 'align' => 'alignleft' );
	
	if ( $atts ) {
		if ( array_key_exists( 'align', $atts ) ) {
			if ( in_array( $atts['align'], array( 'left', 'center', 'right' ) ) )
				$class['align'] = 'align' . $atts['align'];
			if ( $atts['align'] == 'center' ) $style['text-align'] = 'center';
		}
		
		if ( array_key_exists( 'width', $atts ) ) {
			if ( $atts['width'] ) $style['width'] = trim( $atts['width'] );
		}
		
		if ( array_key_exists( 'textalign', $atts ) ) {
			if ( in_array( $atts['textalign'], array( 'left', 'center', 'right' ) ) )
				$style['text-align'] = $atts['textalign'];
		}
	}
	
	$style_attr = '';
	if ( $style ) {
		foreach ( $style as $prop => $val ) {
			$style_attr .= $prop . ':' . $val . ';';
		}
		if ( $style_attr ) $style_attr = ' style="' . $style_attr . '"';
	}
	
	$attr = 'class="' . implode( ' ', $class ) . '"' . $style_attr;
	
    return '<div ' . $attr . '>' . wpautop( do_shortcode( $content ) ) . '</div>';
}
add_shortcode( 'pullquote', 'mgraphene_pullquote_handler' );

?>