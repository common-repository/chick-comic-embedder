<?php

/**
 * Enable a page where user's can preview all available styles.
 *
 * @package Chick_Comic_Embedder
 * @since 1.0
 */

/**
 * Add query var.
 *
 * @since 1.0
 *
 * @filter query_vars
 */
function cce_style_query_var( $query_vars ) {

    $query_vars[] = 'cce_preview_styles';
    return $query_vars;
}
add_filter( 'query_vars', 'cce_style_query_var' );

/**
 * Process request.
 *
 * @since 1.0
 *
 * @action parse_request
 */
function cce_styles_parse_request( &$wp ) {

	// If the style preview page is being requested, load the custom template.
	if ( array_key_exists( 'cce_preview_styles', $wp->query_vars ) ) {

		include( dirname( __FILE__ ) . '/styles-preview-template.php' );
		exit();
	}

	return;
}
add_action( 'parse_request', 'cce_styles_parse_request' );
