<?php

/**
 * Embed custom fonts
 */
add_action( 'wp_enqueue_scripts', 'wlgx_enqueue_fonts' );
function wlgx_enqueue_fonts() {
	$prefixes = array( 'heading', 'body', 'menu' );

	$fonts = array();

	foreach ( $prefixes as $prefix ) {
		$font = explode( '|', wlgx_get_option( $prefix . '_font_family', 'none' ), 2 );
		if ( ! isset( $font[1] ) OR empty( $font[1] ) ) {
			// Fault tolerance for missing font-variants
			$font[1] = '400,700';
		}
		$selected_font_variants = explode( ',', $font[1] );
		// Empty font or web safe combination selected
		if ( $font[0] == 'none' OR strpos( $font[0], ',' ) !== FALSE ) {
			continue;
		}

		$font[0] = str_replace( ' ', '+', $font[0] );
		if ( ! isset( $fonts[$font[0]] ) ) {
			$fonts[$font[0]] = array();
		}

		foreach ( $selected_font_variants as $font_variant ) {
			$fonts[$font[0]][] = $font_variant;
		}
	}

	$subset = '&subset=' . wlgx_get_option( 'font_subset', 'latin' );
	$font_index = 1;
	foreach ( $fonts as $font_name => $font_variants ) {
		if ( count( $font_variants ) == 0 ) {
			continue;
		}
		$font_variants = array_unique( $font_variants );

		// Google font url
		$font_url = 'https://fonts.googleapis.com/css?family=' . $font_name . ':' . implode( ',', $font_variants ) . $subset;
		wp_enqueue_style( 'wlgx-font-' . $font_index, $font_url );
		$font_index ++;
	}

	wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
}

add_action( 'wp_enqueue_scripts', 'wlgx_styles', 12 );
function wlgx_styles() {
	global $wlgx_template_directory_uri;

	$min_ext = ( wlgx_get_option( 'minify_css', 1 ) == 1 ) ? '.min' : '';

	wp_register_style( 'wlgx-base', $wlgx_template_directory_uri . '/framework/css/wlgx-base' . $min_ext . '.css', array(), wlgx_THEMEVERSION, 'all' );
	wp_enqueue_style( 'wlgx-base' );

	wp_register_style( 'wlgx-style', $wlgx_template_directory_uri . '/css/style' . $min_ext . '.css', array(), wlgx_THEMEVERSION, 'all' );
	wp_enqueue_style( 'wlgx-style' );

	if ( is_rtl() ) {
		wp_register_style( 'wlgx-rtl', $wlgx_template_directory_uri . '/css/rtl' . $min_ext . '.css', array(), wlgx_THEMEVERSION, 'all' );
		wp_enqueue_style( 'wlgx-rtl' );
	}
}

if ( wlgx_get_option( 'responsive_layout', TRUE ) ) {
	add_action( 'wp_enqueue_scripts', 'wlgx_responsive_styles', 16 );
	function wlgx_responsive_styles() {
		global $wlgx_template_directory_uri;

		$min_ext = ( wlgx_get_option( 'minify_css', 1 ) == 1 ) ? '.min' : '';

		wp_register_style( 'wlgx-responsive', $wlgx_template_directory_uri . '/css/responsive' . $min_ext . '.css', array(), wlgx_THEMEVERSION, 'all' );
		wp_enqueue_style( 'wlgx-responsive' );
	}
}
add_action( 'wp_enqueue_scripts', 'wlgx_custom_styles', 18 );
function wlgx_custom_styles() {

	if ( is_child_theme() ) {
		global $wlgx_stylesheet_directory_uri;
		wp_enqueue_style( 'theme-style', $wlgx_stylesheet_directory_uri . '/style.css', array(), wlgx_THEMEVERSION, 'all' );
	}

	global $wlgx_generate_css_file;
	$wlgx_generate_css_file = wlgx_get_option( 'generate_css_file', TRUE );
	if ( $wlgx_generate_css_file ) {
		$wp_upload_dir = wp_upload_dir();
		$styles_dir = $wp_upload_dir['basedir'] . '/wlgx-assets';
		$styles_dir = str_replace( '\\', '/', $styles_dir );
		$site_url_parts = parse_url( site_url() );
		$styles_file_suffix = ( ! empty( $site_url_parts['host'] ) ) ? $site_url_parts['host'] : '';
		$styles_file_suffix .= ( ! empty( $site_url_parts['path'] ) ) ? str_replace( '/', '_', $site_url_parts['host'] ) : '';
		$styles_file_suffix = ( ! empty( $styles_file_suffix ) ) ? '-' . $styles_file_suffix : '';
		$styles_file = $styles_dir . '/' . wlgx_THEMENAME . $styles_file_suffix . '-theme-options.css';
		if ( file_exists( $styles_file ) ) {
			$styles_file_uri = $wp_upload_dir['baseurl'] . '/wlgx-assets/' . wlgx_THEMENAME . $styles_file_suffix . '-theme-options.css';
			// Removing protocols for better compatibility with caching plugins and services
			$styles_file_uri = str_replace( array( 'http:', 'https:' ), '', $styles_file_uri );
			wp_enqueue_style( 'wlgx-theme-options', $styles_file_uri, array(), wlgx_THEMEVERSION, 'all' );
		} else {
			$wlgx_generate_css_file = FALSE;
		}
	}
}

if ( wlgx_get_option( 'jquery_footer', 1 ) == 1 ) {
	add_action( 'wp_default_scripts', 'wlgx_move_jquery_to_footer' );
}
function wlgx_move_jquery_to_footer( $wp_scripts ) {
	if ( is_admin() ) {
		return;
	}

	$wp_scripts->add_data( 'jquery', 'group', 1 );
	$wp_scripts->add_data( 'jquery-core', 'group', 1 );
	$wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
}

add_action( 'wp_enqueue_scripts', 'wlgx_jscripts' );
function wlgx_jscripts() {
	global $wlgx_template_directory_uri;

	wp_register_script( 'wlgx-google-maps', '//maps.googleapis.com/maps/api/js', array(), '', FALSE );

	if ( wlgx_get_option( 'ajax_load_js', 0 ) == 0 ) {
		wp_register_script( 'wlgx-isotope', $wlgx_template_directory_uri . '/framework/js/jquery.isotope.js', array( 'jquery' ), '2.2.2', TRUE );

		wp_register_script( 'wlgx-royalslider', $wlgx_template_directory_uri . '/framework/js/jquery.royalslider.min.js', array( 'jquery' ), '9.5.7', TRUE );

		wp_register_script( 'wlgx-owl', $wlgx_template_directory_uri . '/framework/js/owl.carousel.min.js', array( 'jquery' ), '2.0.0', TRUE );

		wp_register_script( 'wlgx-magnific-popup', $wlgx_template_directory_uri . '/framework/js/jquery.magnific-popup.js', array( 'jquery' ), '1.1.0', TRUE );
		wp_enqueue_script( 'wlgx-magnific-popup' );

		wp_register_script( 'wlgx-gmap', $wlgx_template_directory_uri . '/framework/js/gmaps.min.js', array( 'jquery' ), '', TRUE );
	}

	if ( defined( 'wlgx_DEV' ) AND wlgx_DEV ) {
		wp_register_script( 'wlgx-core', $wlgx_template_directory_uri . '/framework/js/wlgx.core.js', array( 'jquery' ), wlgx_THEMEVERSION, TRUE );
	} else {
		wp_register_script( 'wlgx-core', $wlgx_template_directory_uri . '/framework/js/wlgx.core.min.js', array( 'jquery' ), wlgx_THEMEVERSION, TRUE );
	}
	wp_enqueue_script( 'wlgx-core' );
}

add_action( 'wp_footer', 'wlgx_theme_js', 98 );
function wlgx_theme_js() {
	$buffer = wlgx_get_template( 'config/theme-js' );
	echo $buffer;
}

add_action( 'wp_footer', 'wlgx_custom_html_output', 99 );
function wlgx_custom_html_output() {
	echo wlgx_get_option( 'custom_html', '' );
}
