<?php

/**
 * A custom page template used to display the page of all available comic styles.
 *
 * @package Chick_Commic_Embedder
 * @since 1.0
 */

get_header();

?>

<div class="entry-content">
	<h2>Chick Comic Styles</h2>
	<br />
	<p>Preview all available styles for the Chick comics. You can also create your own styles. For more information, see <a href="http://codesymphony.co/comic-embedder/#cusom-styles">here</a>, or read the developers.txt file included with the plugin.</p>
	<br />
	<br />

	<?php

	$styles = cce_available_styles();

	$lorem_ipsum = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

	foreach ( $styles as $style => $name ) {

		echo( '<h3>' . $name . '</h3><br />' );
		echo( $lorem_ipsum . $lorem_ipsum );
		echo( display_chickcomic( '1', 'random', $style ) );
		echo( $lorem_ipsum . $lorem_ipsum . $lorem_ipsum );
		echo( '<br /><br /><hr /><br />' );
	}

	?>

</div>

<?php get_footer(); ?>
