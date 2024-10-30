<?php

/**
 * @package Chick_Commic_Embedder
 * @author J.D. Grimes
 * @license GPLv2
 * @version 1.1
 *
 * Plugin Name: Chick Comic Embedder
 * Plugin URI: http://codesymphony.co/comic-embedder/
 * Version: 1.1
 * Author: J.D. Grimes
 * Author URI: http://codesymphony.co/
 * License: GPL2
 * Description: This plugin allows you to embed Jack Chick's great comics into your posts and pages using shortcode.
 *
 * ---------------------------------------------------------------------------------|
 * Copyright 2013  J.D. Grimes  (email : jdg@codesymphony.co)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * ---------------------------------------------------------------------------------|
 *
 * Developers: for information on adding custom CSS styles, see developers.txt
 *
 * Let the symphony begin!
 */

/**
 * @const string The plugin's directory.
 */
define( 'CC_EMBEDDER_DIR', dirname( __FILE__ ) );

/**
 * Install the plugin.
 *
 * Adds default settings on activation if they don't already exist.
 *
 * @since 1.0
 */
function chickcomic_activation() {

	add_option( 'cce_default_comic', '1' );
	add_option( 'cce_default_unavailable', 'random' );
	add_option( 'cce_default_style', 'center' );
}
register_activation_hook( __FILE__, 'chickcomic_activation' );

/**
 * Contains the shortcode functions.
 *
 * @since 1.0
 */
include_once( CC_EMBEDDER_DIR . '/shortcode.php' );

/**
 * Enables the style preview page.
 *
 * @since 1.0
 */
include_once( CC_EMBEDDER_DIR . '/style-preview.php' );

// Only load this on the admin side.
if ( is_admin() ) {

	/**
	 * Settings.
	 *
	 * @since 1.0
	 */
	include_once( CC_EMBEDDER_DIR . '/options.php' );
}

/**
 * Get all available comics.
 *
 * @since 1.0
 *
 * @return array All comics that are currently available.
 */
function cce_available_comics() {

	return array(
		// id => name
		'1' => 'This Was Your Life',
		'5' => 'Unloved',
		'6' => 'It\'s A Deal',
		'7' => 'Creator Or Liar?',
		'8' => 'The Choice',
		'9' => 'The Greatest Story Ever Told',
	);
}

/**
 * Get available comic styles.
 *
 * @since 1.0
 *
 * @return array All available comic styles.
 */
function cce_available_styles() {

	// Included styles.
	$styles = array(
		'none'       => 'None',
		'center'     => 'Center',
		'wrap-left'  => 'Wrap text (left)',
		'wrap-right' => 'Wrap text (right)',
		'inset-box'  => 'Inset Box',
	);

	// Allow this to be filtered, so developers can add their own style options.
	return apply_filters( 'chickcomic_styles_filter', $styles );
}

/**
 * Enqueue the plugin's stylesheets.
 *
 * @since 1.0
 *
 * @action wp_enqueue_scripts
 */
function cce_enqueue_styles() {

	wp_enqueue_style( 'cce_comics', plugins_url( 'styles.css', __FILE__ ) );

	// Let developers add their styles after these are registered.
	do_action( 'cce_after_styles_enqueue' );
}
add_action( 'wp_enqueue_scripts', 'cce_enqueue_styles' );
