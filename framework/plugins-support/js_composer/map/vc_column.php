<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Extending shortcode: vc_column
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_remove_param( 'vc_column', 'css_animation' );
vc_add_params(
	'vc_column', array(
	array(
		'param_name' => 'text_color',
		'heading' => __( 'Text Color', 'wlgx' ),
		'type' => 'colorpicker',
		'std' => $config['atts']['text_color'],
		'weight' => 30,
	),
	array(
		'param_name' => 'animate',
		'heading' => __( 'Animation', 'wlgx' ),
		'description' => __( 'Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'No Animation', 'wlgx' ) => '',
			__( 'Fade', 'wlgx' ) => 'fade',
			__( 'Appear From Center', 'wlgx' ) => 'afc',
			__( 'Appear From Left', 'wlgx' ) => 'afl',
			__( 'Appear From Right', 'wlgx' ) => 'afr',
			__( 'Appear From Bottom', 'wlgx' ) => 'afb',
			__( 'Appear From Top', 'wlgx' ) => 'aft',
			__( 'Height From Center', 'wlgx' ) => 'hfc',
			__( 'Width From Center', 'wlgx' ) => 'wfc',
		),
		'std' => $config['atts']['animate'],
		'admin_label' => TRUE,
		'weight' => 20,
	),
	array(
		'param_name' => 'animate_delay',
		'heading' => __( 'Animation Delay', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'None', 'wlgx' ) => '',
			__( '0.2 second', 'wlgx' ) => '0.2',
			__( '0.4 second', 'wlgx' ) => '0.4',
			__( '0.6 second', 'wlgx' ) => '0.6',
			__( '0.8 second', 'wlgx' ) => '0.8',
			__( '1 second', 'wlgx' ) => '1',
		),
		'std' => $config['atts']['animate_delay'],
		'dependency' => array( 'element' => 'animate', 'not_empty' => TRUE ),
		'admin_label' => TRUE,
		'weight' => 10,
	),
)
);
