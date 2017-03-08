<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_btn
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_btn',
		'name' => __( 'Button', 'wlgx' ),
		'icon' => 'icon-wpb-ui-button',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 330,
		'params' => array(
			array(
				'param_name' => 'text',
				'heading' => __( 'Button Label', 'wlgx' ),
				'type' => 'textfield',
				'value' => __( 'Click Me', 'wlgx' ),
				'std' => $config['atts']['text'],
				'edit_field_class' => 'vc_col-sm-6',
				'holder' => 'button',
				'class' => 'wpb_button',
				'weight' => 120,
			),
			array(
				'param_name' => 'link',
				'heading' => __( 'Button Link', 'wlgx' ),
				'type' => 'vc_link',
				'std' => $config['atts']['link'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 110,
			),
			array(
				'param_name' => 'style',
				'heading' => __( 'Button Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Solid', 'wlgx' ) => 'solid',
					__( 'Outlined', 'wlgx' ) => 'outlined',
				),
				'std' => $config['atts']['style'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 100,
			),
			array(
				'param_name' => 'color',
				'heading' => __( 'Button Color', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Primary (theme color)', 'wlgx' ) => 'primary',
					__( 'Secondary (theme color)', 'wlgx' ) => 'secondary',
					__( 'Light (theme color)', 'wlgx' ) => 'light',
					__( 'Contrast (theme color)', 'wlgx' ) => 'contrast',
					__( 'Black', 'wlgx' ) => 'black',
					__( 'White', 'wlgx' ) => 'white',
					__( 'Pink', 'wlgx' ) => 'pink',
					__( 'Blue', 'wlgx' ) => 'blue',
					__( 'Green', 'wlgx' ) => 'green',
					__( 'Yellow', 'wlgx' ) => 'yellow',
					__( 'Purple', 'wlgx' ) => 'purple',
					__( 'Red', 'wlgx' ) => 'red',
					__( 'Lime', 'wlgx' ) => 'lime',
					__( 'Navy', 'wlgx' ) => 'navy',
					__( 'Cream', 'wlgx' ) => 'cream',
					__( 'Brown', 'wlgx' ) => 'brown',
					__( 'Midnight', 'wlgx' ) => 'midnight',
					__( 'Teal', 'wlgx' ) => 'teal',
					__( 'Transparent', 'wlgx' ) => 'transparent',
				),
				'std' => $config['atts']['color'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 90,
			),
			array(
				'param_name' => 'size',
				'heading' => __( 'Button Size', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['size'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 60,
			),
			array(
				'param_name' => 'align',
				'heading' => __( 'Button Alignment', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Left', 'wlgx' ) => 'left',
					__( 'Center', 'wlgx' ) => 'center',
					__( 'Right', 'wlgx' ) => 'right',
				),
				'std' => $config['atts']['align'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Icon', 'wlgx' ),
				'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
				'param_name' => 'icon',
				'std' => $config['atts']['icon'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 40,
			),
			array(
				'param_name' => 'iconpos',
				'heading' => __( 'Icon Position', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Left', 'wlgx' ) => 'left',
					__( 'Right', 'wlgx' ) => 'right',
				),
				'std' => $config['atts']['iconpos'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 30,
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
		'js_view' => 'VcButtonView',
	)
);
vc_remove_element( 'vc_button' );
vc_remove_element( 'vc_button2' );
