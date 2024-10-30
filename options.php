<?php

/**
 * Settings.
 *
 * This plugin uses the Settings API to keep track of the settings.
 *
 * @package Chick_Comic_Embedder
 * @since 1.0
 */

/**
 * Add the settings page to the admin menu.
 *
 * @since 1.0
 *
 * @action admin_menu
 */
function chickcomic_settings_menu() {

	add_options_page(
		'Comic Settings',
		'Chick Comics',
		'manage_options',
		'chick_comics',
		'chickcomic_settings_page'
	);
}
add_action( 'admin_menu', 'chickcomic_settings_menu' );

/**
 * Display the settings page.
 *
 * @since 1.0
 */
function chickcomic_settings_page() {

	?>

	<div class="wrap">
		<?php screen_icon(); ?>
		<h2>Comic Settings</h2>
		<p>
			The three parameters of the <code>[chickcomic]</code> shortcode are optional. Here you can set the default values for these parameters.<br />
			These settings can be overridden by using the paremeters in the shortcode. The values in [braces] are what you need to use in the shortcode.<br />
			The exception is the comic titles, which can be used instead of the id numbers.
		</p>
		<p>Some examples:</p>
		<ul>
			<li><code>[chickcomic comic="This was your life"]</code> will display the comic titled "This Was Your Life".</li>
			<li><code>[chickcomic comic="1"]</code> will also display the comic "This Was Your Life."</li>
			<li><code>[chickcomic comic="random"]</code> will display a random comic.</li>
			<li><code>[chickcomic comic="5" unavailable="none"]</code> This will display the comic titled "Unloved". If that comic becomes unavailable, then the shortcode will display nothing.</li>
			<li><code>[chickcomic style="inset-box"]</code> This will display the default comic with the inset box style.</li>
		</ul>
		<form method="post" action="options.php">

		<?php
			settings_fields( 'chickcomic_settings_group' );
			do_settings_sections( 'chick_comics' );
			submit_button();
		?>

		</form>

		<br /><br />
		<i>For information on this plugin, see <a href="http://codesymphony.co/comic-embedder/">here</a>.</i>
	</div>

	<?php
}

/**
 * Initialize settings.
 *
 * @since 1.0
 *
 * @action admin_init
 */
function chickcomic_settings_init() {

	/*
	 * Default comic.
	 */

	add_settings_section(
		'cce_default_comic_section',
		'Default Comic',
		'cce_default_comic_section_callback',
		'chick_comics'
	);

	add_settings_field(
		'cce_default_comic',
		'Default Comic',
		'cce_default_comic_input',
		'chick_comics',
		'cce_default_comic_section'
	);

	register_setting( 'chickcomic_settings_group', 'cce_default_comic' );

	/*
	 * Default unavailable action.
	 */

	add_settings_section(
		'cce_default_unavailable_section',
		'Comic Unavailable',
		'cce_default_unavailable_section_callback',
		'chick_comics'
	);

	add_settings_field(
		'cce_default_unavailable',
		'Comic Unavailable',
		'cce_default_unavailable_input',
		'chick_comics',
		'cce_default_unavailable_section'
	);

	register_setting( 'chickcomic_settings_group', 'cce_default_unavailable' );

	/*
	 * Default style.
	 */

	add_settings_section(
		'cce_default_style_section',
		'Default Style',
		'cce_default_style_section_callback',
		'chick_comics'
	);

	add_settings_field(
		'cce_default_style',
		'Default Style',
		'cce_default_style_input',
		'chick_comics',
		'cce_default_style_section'
	);

	register_setting( 'chickcomic_settings_group', 'cce_default_style' );
}
add_action( 'admin_init', 'chickcomic_settings_init' );

/**
 * Callback to display the default commic section description.
 *
 * @since 1.0
 */
function cce_default_comic_section_callback() {

	echo( 'What comic should the shortcode display by default? You can choose a particular title, or have the shortcode display a random comic, or the latest comic. <a href="http://www.chick.com/cartoons/embed.asp" target="_blank">Preview the available comics on chick.com</a>' );
}

/**
 * Callback to display the default commic unavailabe section description.
 *
 * @since 1.0
 */
function cce_default_unavailable_section_callback() {

	echo( 'The available comics change occasionally. (That is entirely outside of the plugin author\'s control). By default, what should be displayed if the comic specified in the shortcode is unavailable?' );
}

/**
 * Callback to display the default style section description.
 *
 * @since 1.0
 */
function cce_default_style_section_callback() {

	echo( 'Choose a default style for the comics. <a href="' . add_query_arg( 'cce_preview_styles', 1, site_url() ) . '" target="_blank">Preview the different styles</a>.' );
}

/**
 * Display default comic form field.
 *
 * @since 1.0
 */
function cce_default_comic_input() {

	// Available comics.
	$comics = cce_available_comics();
	$comics['random'] = 'A Random Comic';
	$comics['latest'] = 'The Latest Comic';

	// Current default.
	$current = get_option( 'cce_default_comic' );

	// Build <select> element.
	$html = '<select id="cce_default_comic" name="cce_default_comic">';

	foreach ( $comics as $id => $title ) {

		$html .= '<option value="' . $id . '"';
		if ( $id == $current ) $html .= ' selected="selected"';
		$html .= '>[' . $id . '] ' . $title . '</option>';
	}

	$html .= '</select>';

	echo( $html );
}

/**
 * Display default comic unavailable form field.
 *
 * @since 1.0
 */
function cce_default_unavailable_input() {

	// Available options.
	$options = array(
		'random'  => 'Random Comic',
		'default' => 'Default Comic',
		'none'    => 'Nothing',
	);

	// Current default.
	$current = get_option( 'cce_default_unavailable' );

	// Build <select> element.
	$html = '<select id="cce_default_unavailable" name="cce_default_unavailable">';

	foreach ( $options as $value => $text ) {

		$html .= '<option value="' . $value . '"';
		if ( $value == $current ) $html .= ' selected="selected"';
		$html .= '>[' . $value . '] ' . $text . '</option>';
	}

	$html .= '</select>';

	echo( $html );
}

/**
 * Display default style form field.
 *
 * @since 1.0
 */
function cce_default_style_input() {

	// Available options.
	$options = cce_available_styles();

	// Current default.
	$current = get_option( 'cce_default_style' );

	// Build <select> element.
	$html = '<select id="cce_default_style" name="cce_default_style">';

	foreach ( $options as $value => $name ) {

		$html .= '<option value="' . $value . '"';
		if ( $value == $current ) $html .= ' selected="selected"';
		$html .= '>[' . $value . '] ' . $name . '</option>';
	}

	$html .= '</select>';

	echo( $html );
}
