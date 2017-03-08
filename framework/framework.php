<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * wwwlogix Themes Framework
 *
 * Should be included in global context.
 */
global $wlgx_template_directory, $wlgx_stylesheet_directory, $wlgx_template_directory_uri, $wlgx_stylesheet_directory_uri;
$wlgx_template_directory = get_template_directory();
$wlgx_stylesheet_directory = get_stylesheet_directory();
// Removing protocols for better compatibility with caching plugins and services
$wlgx_template_directory_uri = str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() );
$wlgx_stylesheet_directory_uri = str_replace( array( 'http:', 'https:' ), '', get_stylesheet_directory_uri() );

if ( ! defined( 'wlgx_THEMENAME' ) OR ! defined( 'wlgx_THEMEVERSION' ) ) {
	$wlgx_theme = wp_get_theme();
	if ( is_child_theme() ) {
		$wlgx_theme = wp_get_theme( $wlgx_theme->get( 'Template' ) );
	}
	if ( ! defined( 'wlgx_THEMENAME' ) ) {
		define( 'wlgx_THEMENAME', $wlgx_theme->get( 'Name' ) );
	}
	if ( ! defined( 'wlgx_THEMEVERSION' ) ) {
		define( 'wlgx_THEMEVERSION', $wlgx_theme->get( 'Version' ) );
	}
	unset( $wlgx_theme );
}

if ( ! isset( $wlgx_theme_supports ) ) {
	$wlgx_theme_supports = array();
}

// wwwlogix helper functions
require $wlgx_template_directory . '/framework/functions/helpers.php';

// Theme Options
require $wlgx_template_directory . '/framework/functions/theme-options.php';

// Load shortcodes
require $wlgx_template_directory . '/framework/functions/shortcodes.php';

// wwwlogix Header definitions
require $wlgx_template_directory . '/framework/functions/header.php';

// wwwlogix Layout definitions
require $wlgx_template_directory . '/framework/functions/layout.php';

// Breadcrumbs function
require $wlgx_template_directory . '/framework/functions/breadcrumbs.php';

// Post formats
require $wlgx_template_directory . '/framework/functions/post.php';

// Custom Post types
require $wlgx_template_directory . '/framework/functions/post-types.php';

// Page Meta Tags
require $wlgx_template_directory . '/framework/functions/meta-tags.php';

// Menu and it's custom markup
require $wlgx_template_directory . '/framework/functions/menu.php';
// Comments custom markup
require $wlgx_template_directory . '/framework/functions/comments.php';
// wp_link_pages both next and numbers usage
require $wlgx_template_directory . '/framework/functions/pagination.php';

// Sidebars init
require $wlgx_template_directory . '/framework/functions/widget_areas.php';

// Plugins activation
if ( is_admin() ) {
	// Admin specific functions
	require $wlgx_template_directory . '/framework/admin/functions/functions.php';
} else {
	// Frontent CSS and JS enqueue
	require $wlgx_template_directory . '/framework/functions/enqueue.php';
}

// Widgets
require $wlgx_template_directory . '/framework/functions/widgets.php';
add_filter( 'widget_text', 'do_shortcode' );

if ( is_admin() ) {
	// Theme Dashboard page
	require $wlgx_template_directory . '/framework/admin/functions/dashboard.php';
	// Addons
	require $wlgx_template_directory . '/framework/admin/functions/addons.php';
}

if ( defined( 'DOING_AJAX' ) AND DOING_AJAX ) {
	require $wlgx_template_directory . '/framework/functions/ajax/blog.php';
	require $wlgx_template_directory . '/framework/functions/ajax/casestudy.php';
	require $wlgx_template_directory . '/framework/functions/ajax/cform.php';
	require $wlgx_template_directory . '/framework/functions/ajax/cart.php';
	require $wlgx_template_directory . '/framework/functions/ajax/user_info.php';
}

// Including plugins support files
if ( ! isset( $wlgx_theme_supports['plugins'] ) ) {
	$wlgx_theme_supports['plugins'] = array();
}
foreach ( $wlgx_theme_supports['plugins'] AS $wlgx_plugin_name => $wlgx_plugin_path ) {
	if ( $wlgx_plugin_path === NULL ) {
		continue;
	}
	include $wlgx_template_directory . $wlgx_plugin_path;
}

/**
 * Theme Setup
 */
add_action( 'after_setup_theme', 'wlgx_theme_setup' );
function wlgx_theme_setup() {
	global $content_width;

	if ( ! isset( $content_width ) ) {
		$content_width = 1500;
	}
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'image', 'quote', 'link' ) );

	// Add post thumbnail functionality
	add_theme_support( 'post-thumbnails' );

	/**
	 * Dev note: you can overload theme's image sizes config using filter 'wlgx_config_image-sizes'
	 */
	$tnail_sizes = wlgx_config( 'image-sizes', array() );
	foreach ( $tnail_sizes as $size_name => $size ) {
		add_image_size( $size_name, $size['width'], $size['height'], $size['crop'] );
	}

	// Excerpt length
	add_filter( 'excerpt_length', 'wlgx_excerpt_length', 100 );
	function wlgx_excerpt_length( $length ) {
		$excerpt_length = wlgx_get_option( 'excerpt_length' );
		if ( $excerpt_length === NULL ) {
			return $length;
		} elseif ( $excerpt_length === '' ) {
			// If not set, showing the full excerpt
			return 9999;
		} else {
			return intval( $excerpt_length );
		}
	}

	// Remove [...] from excerpt
	add_filter( 'excerpt_more', 'wlgx_excerpt_more' );
	function wlgx_excerpt_more( $more ) {
		return '...';
	}

	// Theme localization
	wlgx_maybe_load_theme_textdomain();
}

if ( ! defined( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS' ) ) {
	define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', TRUE );
}

if ( ! function_exists( 'wlgx_wp_title' ) ) {
	add_filter( 'wp_title', 'wlgx_wp_title' );
	function wlgx_wp_title( $title ) {
		if ( is_front_page() ) {
			return get_bloginfo( 'name' );
		} else {
			return trim( $title );
		}
	}
}

