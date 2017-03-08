<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_separator
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_separator',
		'name' => __( 'Separator', 'wlgx' ),
		'icon' => 'icon-wpb-ui-separator',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'description' => __( 'Horizontal separator line', 'wlgx' ),
		'weight' => 340,
		'params' => array(
			array(
				'param_name' => 'type',
				'heading' => __( 'Separator Type', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Standard Line', 'wlgx' ) => 'default',
					__( 'Full Width Line', 'wlgx' ) => 'fullwidth',
					__( 'Short Line', 'wlgx' ) => 'short',
					__( 'Invisible', 'wlgx' ) => 'invisible',
				),
				'std' => $config['atts']['type'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 90,
			),
			array(
				'param_name' => 'size',
				'heading' => __( 'Separator Size', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Small', 'wlgx' ) => 'small',
					__( 'Medium', 'wlgx' ) => 'medium',
					__( 'Large', 'wlgx' ) => 'large',
					__( 'Huge', 'wlgx' ) => 'huge',
				),
				'std' => $config['atts']['size'],
				'holder' => 'div',
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 80,
			),
			array(
				'param_name' => 'thick',
				'heading' => __( 'Line Thickness', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					'1px' => '1',
					'2px' => '2',
					'3px' => '3',
					'4px' => '4',
					'5px' => '5',
				),
				'std' => $config['atts']['thick'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'default',
						'fullwidth',
						'short',
					),
				),
				'weight' => 70,
			),
			array(
				'param_name' => 'style',
				'heading' => __( 'Line Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Solid', 'wlgx' ) => 'solid',
					__( 'Dashed', 'wlgx' ) => 'dashed',
					__( 'Dotted', 'wlgx' ) => 'dotted',
					__( 'Double', 'wlgx' ) => 'double',
				),
				'std' => $config['atts']['style'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'default',
						'fullwidth',
						'short',
					),
				),
				'weight' => 60,
			),
			array(
				'param_name' => 'color',
				'heading' => __( 'Line Color', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Border (theme color)', 'wlgx' ) => 'border',
					__( 'Primary (theme color)', 'wlgx' ) => 'primary',
					__( 'Secondary (theme color)', 'wlgx' ) => 'secondary',
					__( 'Custom Color', 'wlgx' ) => 'custom',
				),
				'std' => $config['atts']['color'],
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'default',
						'fullwidth',
						'short',
					),
				),
				'weight' => 50,
			),
			array(
				'param_name' => 'bdcolor',
				'type' => 'colorpicker',
				'std' => $config['atts']['bdcolor'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'color',
					'value' => array(
						'custom',
					),
				),
				'weight' => 40,
			),
			array(
				'param_name' => 'icon',
				'heading' => __( 'Icon', 'wlgx' ),
				'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
				'type' => 'textfield',
				'std' => $config['atts']['icon'],
				'edit_field_class' => 'vc_col-sm-6 newline',
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'default',
						'fullwidth',
						'short',
					),
				),
				'weight' => 30,
			),
			array(
				'param_name' => 'text',
				'heading' => __( 'Title', 'wlgx' ),
				'description' => __( 'Displays text in the middle of this separator', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['text'],
				'holder' => 'div',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'default',
						'fullwidth',
						'short',
					),
				),
				'weight' => 20,
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
				'dependency' => array( 'element' => 'text', 'not_empty' => TRUE ),
				'weight' => 15,
			),
			array(
				'param_name' => 'title_size',
				'heading' => __( 'Title Size', 'wlgx' ),
				'description' => sprintf( __( 'Examples: %s', 'wlgx' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['title_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'text', 'not_empty' => TRUE ),
				'weight' => 14,
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
vc_remove_element( 'vc_separator' );
vc_remove_element( 'vc_text_separator' );
