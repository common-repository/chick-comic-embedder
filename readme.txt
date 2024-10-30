=== Chick Comic Embedder ===
Contributors: JD55
Donate link: http://codesymphony.co/
Tags: comics, shortcode, comic, chick, tract
Requires at least: 2.7.0
Tested up to: 3.5.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to embed Jack Chick's great comics into your posts and pages using shortcode.

== Description ==

This plugin enables a shortcode ([chickcomic]) that you can use to embed Jack Chick's comics in you pages and posts. You can have it include a particular comic, or a random comic. You can give the comic's container different styles, too.

Note: The plugin author is not affiliated with www.chick.com, and has no control over the availability of particular comics.

== Installation ==

1. Extract `chick-comic-embedder.zip` and upload it to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= What parameters can be set in the shortcode? =

There are three optional parameters that you can set when you use the shortcode in your pages and posts. Below are some examples. For a complete list of options, you can visit the plugin's settings page once it is installed. You can also set the default behavior of the shortcode there.

1. 'comic' - Use this parameter to tell the shorcode what comic to display. For example, [chickcomic comic="1"] or [chickcomic comic="unloved"] or [chickcomic comic="random"]
1. 'unavailable' - Use this parameter to tell the shortcode what to do if the specified comic is unavailable. (The availability of the comics is subject to change, and is outside of the plugin author's control). Example: [chickcomic comic="1" unavailable="none"] will cause the shortcode to display nothing if the comic becomes unavailable.
1. 'style' - Use this parameter to tell the shortcode how you want the comic displayed. For example, if you want it on the left with the other content wrapped around it, use [chickcomic comic="1" style="wrap-left"].

== Screenshots ==

1. A comic embedded with the "Inset Box" style.
2. The settings page.

== Changelog ==

= 1.1 =
* Removed support for the custom-styles.css and custom-styles.php files.
* Docblocked code and generally improved code formatting.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.1 =
**IMPORTANT!** If you are using the custom-styles.css and/or custom-styles.php files to customize this plugin, please move your code to a child theme **before** upgrading. Otherwise it will be overwritten.

= 1.0 =
The initial release.