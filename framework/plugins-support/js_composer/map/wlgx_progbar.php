<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_contacts
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'name' => __( 'Progress Bar', 'wlgx' ),
		'base' => 'wlgx_progbar',
		'icon' => 'icon-wpb-graph',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 125,
		'params' => array(
			array(
				'param_name' => 'title',
				'heading' => __( 'Title', 'wlgx' ),
				'type' => 'textfield',
				'holder' => 'div',
				'std' => $config['atts']['title'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 80,
			),
			array(
				'param_name' => 'count',
				'heading' => __( 'Progress Value', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['count'],
				'holder' => 'span',
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 70,
			),
			array(
				'param_name' => 'style',
				'heading' => __( 'Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					sprintf( __( 'Style %d', 'wlgx' ), 1 ) => '1',
					sprintf( __( 'Style %d', 'wlgx' ), 2 ) => '2',
					sprintf( __( 'Style %d', 'wlgx' ), 3 ) => '3',
					sprintf( __( 'Style %d', 'wlgx' ), 4 ) => '4',
					sprintf( __( 'Style %d', 'wlgx' ), 5 ) => '5',
				),
				'std' => $config['atts']['style'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 60,
			),
			array(
				'param_name' => 'size',
				'heading' => __( 'Size', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Small', 'wlgx' ) => 'small',
					__( 'Medium', 'wlgx' ) => 'medium',
					__( 'Large', 'wlgx' ) => 'large',
				),
				'std' => $config['atts']['size'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
			),
			array(
				'param_name' => 'color',
				'heading' => __( 'Progress Bar Color', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Primary (theme color)', 'wlgx' ) => 'primary',
					__( 'Secondary (theme color)', 'wlgx' ) => 'secondary',
					__( 'Contrast (theme color)', 'wlgx' ) => 'contrast',
					__( 'Custom Color', 'wlgx' ) => 'custom',
				),
				'std' => $config['atts']['color'],
				'weight' => 40,
			),
			array(
				'param_name' => 'bar_color',
				'type' => 'colorpicker',
				'std' => $config['atts']['bar_color'],
				'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
				'weight' => 30,
			),
			array(
				'param_name' => 'hide_count',
				'type' => 'checkbox',
				'value' => array( __( 'Hide progress value counter', 'wlgx' ) => TRUE ),
				( ( $config['atts']['hide_count'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['hide_count'],
				'weight' => 20,
			),
			array(
				'param_name' => 'el_class',
				'heading' => wlgx_translate_with_external_domain( 'Extra class name', 'js_composer' ),
				'description' => wlgx_translate_with_external_domain( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
				'type' => 'textfield',
				'std' => $config['atts']['el_class'],
				'weight' => 10,
			),
		),
	)
);
