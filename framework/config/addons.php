<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
require_once ('class-tgm.php');

 * Addons configuration
 *
 * @filter wlgx_config_addons
 */

global $wlgx_template_directory;

return array(
	array(
		'name' => 'Visual Composer',
		'description' => __( 'Most popular drag & drop WordPress page builder. Save tons of time working on your website content.', 'wlgx' ),
		'slug' => 'js_composer',
		'source' => $wlgx_template_directory . '/vendor/plugins/js_composer.zip',
		'version' => '5.0.1',
		'changelog_url' => 'https://wpbakery.atlassian.net/wiki/display/VC/Release+Notes',
	),
	array(
		'name' => 'Slider Revolution',
		'description' => __( 'Most advanced responsive WordPress slider plugin, which allows to create beautiful and interactive sliders and presentations.', 'wlgx' ),
		'slug' => 'revslider',
		'source' => '',
		'version' => '',
		'changelog_url' => 'http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380',
	),
	array(
		'name' => 'CodeLights Widgets and&nbsp;Elements',
		'description' => __( 'Flexible high-end easy-to-use widgets and content elements for Visual Composer.', 'wlgx' ),
		'slug' => 'codelights-shortcodes-and-widgets',
		'source' => 'https://downloads.wordpress.org/plugin/codelights-shortcodes-and-widgets.1.1.3.zip',
		'version' => '1.1.3',
		'changelog_url' => 'https://wordpress.org/plugins/codelights-shortcodes-and-widgets/changelog/',
	)
);
