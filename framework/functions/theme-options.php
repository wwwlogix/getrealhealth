<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme Options: USOF + wwwlogix extendings
 *
 * Should be included in global context.
 */

add_action( 'usof_after_save', 'wlgx_generate_theme_options_css_file' );
function wlgx_generate_theme_options_css_file() {

	global $usof_options;

	usof_load_options_once();

	if ( ! isset( $usof_options['generate_css_file'] ) OR ! $usof_options['generate_css_file'] ) {
		return;
	}

	// TODO Use WP_Filesystem instead
	$wp_upload_dir = wp_upload_dir();
	$styles_dir = wp_normalize_path( $wp_upload_dir['basedir'] . '/wlgx-assets' );
	$site_url_parts = parse_url( site_url() );
	$styles_file_suffix = ( ! empty( $site_url_parts['host'] ) ) ? $site_url_parts['host'] : '';
	$styles_file_suffix .= ( ! empty( $site_url_parts['path'] ) ) ? str_replace( '/', '_', $site_url_parts['host'] ) : '';
	$styles_file_suffix = ( ! empty( $styles_file_suffix ) ) ? '-' . $styles_file_suffix : '';
	$styles_file = $styles_dir . '/' . wlgx_THEMENAME . $styles_file_suffix . '-theme-options.css';
	global $output_styles_to_file;
	$output_styles_to_file = TRUE;

	$styles_css = wlgx_get_template( 'templates/theme-options.min.css' );

	if ( ! is_dir( $styles_dir ) ) {
		wp_mkdir_p( trailingslashit( $styles_dir ) );
	}
	$handle = @fopen( $styles_file, 'w' );
	if ( $handle ) {
		if ( ! fwrite( $handle, $styles_css ) ) {
			return FALSE;
		}
		fclose( $handle );

		return TRUE;
	}

	return FALSE;
}

// Flushing WP rewrite rules on casestudy slug changes
add_action( 'usof_before_save', 'wlgx_maybe_flush_rewrite_rules' );
add_action( 'usof_after_save', 'wlgx_maybe_flush_rewrite_rules' );
function wlgx_maybe_flush_rewrite_rules( $updated_options ) {
	// The function is called twice: before and after options change
	static $old_casestudy_slug = NULL;
	static $old_casestudy_category_slug = NULL;
	$flush_rules = FALSE;
	if ( ! isset( $updated_options['casestudy_slug'] ) ) {
		$updated_options['casestudy_slug'] = NULL;
	}
	if ( ! isset( $updated_options['casestudy_category_slug'] ) ) {
		$updated_options['casestudy_category_slug'] = NULL;
	}
	if ( $old_casestudy_slug === NULL ) {
		// At first call we're storing the previous casestudy slug
		$old_casestudy_slug = wlgx_get_option( 'casestudy_slug', 'casestudy' );
	} elseif ( $old_casestudy_slug != $updated_options['casestudy_slug'] ) {
		// At second call we're triggering flush rewrite rules at the next app execution
		// We're using transients to reduce the number of excess auto-loaded options
		$flush_rules = TRUE;
	}
	if ( $old_casestudy_category_slug === NULL ) {
		// At first call we're storing the previous casestudy slug
		$old_casestudy_category_slug = wlgx_get_option( 'casestudy_category_slug', 'casestudy_category' );
	} elseif ( $old_casestudy_slug != $updated_options['casestudy_category_slug'] ) {
		// At second call we're triggering flush rewrite rules at the next app execution
		// We're using transients to reduce the number of excess auto-loaded options
		$flush_rules = TRUE;
	}

	if ( $flush_rules ) {
		set_transient( 'wlgx_flush_rules', TRUE, DAY_IN_SECONDS );
	}
}

// Using USOF for theme options
$usof_directory = $wlgx_template_directory . '/framework/vendor/usof';
$usof_directory_uri = $wlgx_template_directory_uri . '/framework/vendor/usof';
$usof_version = wlgx_THEMEVERSION;
require $wlgx_template_directory . '/framework/vendor/usof/usof.php';
