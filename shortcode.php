<?php

/**
 * Shortcode.
 *
 * This file contains the shortcode handler and the display_chickcomic() function.
 *
 * @package Chick_Commic_Embedder
 * @since 1.0
 */

/**
 * Shortcode handler.
 *
 * @since 1.0
 *
 * @shortcode chickcomic
 *
 * @uses display_chickcomic() To get the commic.
 *
 * @param array $atts The shortcode atts.
 *
 * @return string HTML for a commic.
 */
function chickcomic_shortcode( $atts ) {

	extract(
		shortcode_atts(
			array(
				'comic'       => get_option( 'cce_default_comic' ),
				'unavailable' => get_option( 'cce_default_unavailable' ),
				'style'       => get_option( 'cce_default_style' ),
			),
			$atts
		)
	);

	return display_chickcomic( $comic, $unavailable, $style );
}
add_shortcode( 'chickcomic', 'chickcomic_shortcode' );

/**
 * Get a comic to display.
 *
 * Despite it's unfortunate name, this function does not actually output anything,
 * but instead returns a string of HTML that can be used to display a commic.
 *
 * @param numeric|string $id The id or title of the comic or 'random' or 'latest'.
 * @param string $unavailable What to do if the requested comic is unavailable.
 * @param string $style The HTML class to apply to the comic container element.
 *
 * @return string|bool The HTML for a comic, or false if the comic is unavailable and
 *         $unavailable is set to 'none'.
 */
function display_chickcomic( $comic = null, $unavailable = null, $style = null ) {

	// Get the array of available comics.
	$comics = cce_available_comics();

	// If the $comic isn't set we use the default.
	if ( empty( $comic ) ) {

		$comic = get_option( 'cce_default_comic' );

	 // If it's set, but not a valid id
	} elseif ( !isset( $comics[ $comic ] ) && $comic != 'random' && $comic != 'latest' ) {

		// Check if it's a comic title. Capitalize the first letter of each word.
		$comic = ucwords( strtolower( $comic ) );

		if ( in_array( $comic, $comics ) ) {

			$comic = array_search( $comic, $comics );

		 // If it's not, then the comic is unavailable.
		} else {

			// If $unavailble isn't set, we use the default.
			if ( empty( $unavailable ) )
				$unavailable = get_option( 'cce_default_unavailable' );

			switch ( $unavailable ) {

				case 'random':
					$comic = 'random';
				break;

				case 'default':
					$comic = get_option( 'cce_default_comic' );
				break;

				case 'none':
					return false;

				default:
					$comic = 'random';
			}
		}
	}

	switch ( $comic ) {

		// If we are going to display the latest comic.
		case 'latest':
			$comic_file = 'preview';
		break;

		// If we are going to display a random comic, pick a random one to display.
		case 'random':
			$comic = array_rand( $comics );

		default:
			$comic_file = 'tract_' . $comic;
	}

	// Get the available styles.
	$styles = cce_available_styles();

	// If this one isn't value use the default.
	if ( ! isset( $styles[ $style ] ) && $style != 'none' )
		$style = get_option( 'cce_default_style' );

	if ( 'none' == $style )
		$style = '';

	// Return the HTML for the comic.
	return '<div class="chickcomic-container ' . $style . '">
			<object width="425" height="240">
				<param name="movie" value="http://media.chick.com/' . $comic_file . '.swf"></param>
				<param name="wmode" value="transparent"></param>
				<embed src="http://media.chick.com/' . $comic_file . '.swf" type="application/x-shockwave-flash" wmode="transparent" width="425" height="240"></embed>
			</object>
		</div>';
}
