<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Ajax method for casestudy ajax pagination.
 */
add_action( 'wp_ajax_nopriv_wlgx_ajax_casestudy', 'wlgx_ajax_casestudy' );
add_action( 'wp_ajax_wlgx_ajax_casestudy', 'wlgx_ajax_casestudy' );
function wlgx_ajax_casestudy() {

	if ( ! isset( $_POST['ids'] ) OR ! is_string( $_POST['ids'] ) OR empty( $_POST['ids'] ) ) {
		die( 'This ajax method should be used with a comma-separated list of IDs' );
	}

	// Preparing query
	$query_args = array(
		'post_type' => 'wlgx_casestudy',
		'post_status' => 'publish',
		'post__in' => array_map( 'absint', explode( ',', $_POST['ids'] ) ),
		'orderby' => 'post_in',
		'nopaging' => TRUE,
	);

	wlgx_open_wp_query_context();
	global $wp_query;
	$wp_query = new WP_Query( $query_args );
	if ( ! have_posts() ) {
		// TODO Move to a separate variable
		_e( 'No casestudy items were found.', 'wlgx' );

		return;
	}

	// Filtering $template_vars, as is will be extracted to the template as local variables
	$template_vars = shortcode_atts(
		array(
			'metas' => array( 'title' ),
			'ratio' => '3x2',
			'is_widget' => FALSE,
			'title_size' => '',
			'meta_size' => '',
			'text_color' => '',
			'bg_color' => '',
		), wlgx_maybe_get_post_json( 'template_vars' )
	);

	while ( have_posts() ) {
		the_post();

		wlgx_load_template( 'templates/casestudy/listing-post', $template_vars );
	}

	// We don't use JSON to reduce data size
	die;
}
