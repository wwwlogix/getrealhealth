<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_counter
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_counter',
		'name' => __( 'Counter', 'wlgx' ),
		'icon' => 'icon-wpb-ui-separator',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 190,
		'params' => array(
			array(
				'param_name' => 'initial',
				'heading' => __( 'The initial number value', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['initial'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 120,
			),
			array(
				'param_name' => 'target',
				'heading' => __( 'The final number value', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['target'],
				'holder' => 'span',
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 110,
			),
			array(
				'param_name' => 'prefix',
				'heading' => __( 'Prefix (optional)', 'wlgx' ),
				'description' => __( 'Text before number', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['prefix'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 100,
			),
			array(
				'param_name' => 'suffix',
				'heading' => __( 'Suffix (optional)', 'wlgx' ),
				'description' => __( 'Text after number', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['suffix'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 90,
			),
			array(
				'param_name' => 'color',
				'heading' => __( 'Number Color', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Heading (theme color)', 'wlgx' ) => 'text',
					__( 'Primary (theme color)', 'wlgx' ) => 'primary',
					__( 'Secondary (theme color)', 'wlgx' ) => 'secondary',
					__( 'Custom Color', 'wlgx' ) => 'custom',
				),
				'std' => $config['atts']['color'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 80,
			),
			array(
				'param_name' => 'size',
				'heading' => __( 'Number Size', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Small', 'wlgx' ) => 'small',
					__( 'Medium', 'wlgx' ) => 'medium',
					__( 'Large', 'wlgx' ) => 'large',
				),
				'std' => $config['atts']['size'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 70,
			),
			array(
				'param_name' => 'custom_color',
				'type' => 'colorpicker',
				'std' => $config['atts']['custom_color'],
				'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
				'weight' => 60,
			),
			array(
				'param_name' => 'title',
				'heading' => __( 'Title', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['title'],
				'holder' => 'span',
				'weight' => 50,
			),
			array(
				'param_name' => 'title_tag',
				'heading' => __( 'Title Tag Name', 'wlgx' ),
				'description' => __( 'Used for SEO purposes', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'p' => 'p',
					'div' => 'div',
				),
				'std' => $config['atts']['title_tag'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'title', 'not_empty' => TRUE ),
				'weight' => 40,
			),
			array(
				'param_name' => 'title_size',
				'heading' => __( 'Title Size', 'wlgx' ),
				'description' => sprintf( __( 'Examples: %s', 'wlgx' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['title_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'title', 'not_empty' => TRUE ),
				'weight' => 30,
			),
			array(
				'param_name' => 'align',
				'heading' => __( 'Alignment', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Left', 'wlgx' ) => 'left',
					__( 'Center', 'wlgx' ) => 'center',
					__( 'Right', 'wlgx' ) => 'right',
				),
				'std' => $config['atts']['align'],
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

