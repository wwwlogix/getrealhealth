<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Extending shortcode: vc_row_inner
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_remove_param( 'vc_row_inner', 'equal_height' );
vc_remove_param( 'vc_row_inner', 'content_placement' );
vc_update_shortcode_param(
	'vc_row_inner', array(
	'param_name' => 'gap',
	'description' => '',
	'weight' => 10,
)
);
vc_add_params(
	'vc_row_inner', array(
	array(
		'param_name' => 'content_placement',
		'heading' => __( 'Columns Content Position', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'Default', 'wlgx' ) => 'default',
			__( 'Top', 'wlgx' ) => 'top',
			__( 'Middle', 'wlgx' ) => 'middle',
			__( 'Bottom', 'wlgx' ) => 'bottom',
		),
		'std' => $config['atts']['content_placement'],
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 20,
	),
	array(
		'param_name' => 'columns_type',
		'heading' => __( 'Columns Layout', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'Default', 'wlgx' ) => 'default',
			__( 'Boxes', 'wlgx' ) => 'boxes',
		),
		'std' => $config['atts']['columns_type'],
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 15,
	),
)
);
