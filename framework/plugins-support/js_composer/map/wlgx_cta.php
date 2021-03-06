<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_cta
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_cta',
		'name' => __( 'ActionBox', 'wlgx' ),
		'icon' => 'icon-wpb-ui-separator-label',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'description' => __( 'Call to action', 'wlgx' ),
		'weight' => 220,
		'params' => array(
			array(
				'param_name' => 'title',
				'heading' => __( 'ActionBox Title', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['title'],
				'holder' => 'div',
				'weight' => 260,
			),
			array(
				'param_name' => 'content',
				'heading' => __( 'ActionBox Text', 'wlgx' ),
				'type' => 'textarea',
				'std' => '',
				'weight' => 250,
			),
			array(
				'param_name' => 'color',
				'heading' => __( 'ActionBox Color Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Primary bg & White text', 'wlgx' ) => 'primary',
					__( 'Secondary bg & White text', 'wlgx' ) => 'secondary',
					__( 'Alternate bg & Content text', 'wlgx' ) => 'light',
					__( 'Custom colors', 'wlgx' ) => 'custom',
				),
				'std' => $config['atts']['color'],
				'weight' => 240,
			),
			array(
				'param_name' => 'bg_color',
				'heading' => __( 'Background Color', 'wlgx' ),
				'type' => 'colorpicker',
				'std' => $config['atts']['bg_color'],
				'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
				'weight' => 230,
			),
			array(
				'param_name' => 'text_color',
				'heading' => __( 'Text Color', 'wlgx' ),
				'type' => 'colorpicker',
				'std' => $config['atts']['text_color'],
				'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
				'weight' => 220,
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
				'weight' => 215,
			),
			array(
				'param_name' => 'controls',
				'heading' => __( 'Button(s) Location', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'At Right', 'wlgx' ) => 'right',
					__( 'At Bottom', 'wlgx' ) => 'bottom',
				),
				'std' => $config['atts']['controls'],
				'weight' => 210,
			),
			array(
				'param_name' => 'btn_link',
				'heading' => __( 'Button Link', 'wlgx' ),
				'type' => 'vc_link',
				'std' => $config['atts']['btn_link'],
				'weight' => 200,
			),
			array(
				'param_name' => 'btn_label',
				'heading' => __( 'Button Label', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['btn_label'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 190,
			),
			array(
				'param_name' => 'btn_style',
				'heading' => __( 'Button Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Solid', 'wlgx' ) => 'solid',
					__( 'Outlined', 'wlgx' ) => 'outlined',
				),
				'std' => $config['atts']['btn_style'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 180,
			),
			array(
				'param_name' => 'btn_color',
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
				'std' => $config['atts']['btn_color'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 170,
			),
			array(
				'param_name' => 'btn_size',
				'heading' => __( 'Button Size', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['btn_size'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 140,
			),
			array(
				'param_name' => 'btn_icon',
				'heading' => __( 'Button Icon (optional)', 'wlgx' ),
				'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
				'type' => 'textfield',
				'std' => $config['atts']['btn_icon'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 130,
			),
			array(
				'param_name' => 'btn_iconpos',
				'heading' => __( 'Button Icon Position', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Left', 'wlgx' ) => 'left',
					__( 'Right', 'wlgx' ) => 'right',
				),
				'std' => $config['atts']['btn_iconpos'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 120,
			),
			array(
				'param_name' => 'second_button',
				'type' => 'checkbox',
				'value' => array( __( 'Display second button', 'wlgx' ) => TRUE ),
				( ( $config['atts']['second_button'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['second_button'],
				'weight' => 110,
			),
			array(
				'param_name' => 'btn2_link',
				'heading' => __( 'Button Link', 'wlgx' ),
				'type' => 'vc_link',
				'std' => $config['atts']['btn2_link'],
				'dependency' => array( 'element' => 'second_button', 'not_empty' => TRUE ),
				'weight' => 100,
			),
			array(
				'param_name' => 'btn2_label',
				'heading' => __( 'Button Label', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['btn2_label'],
				'dependency' => array( 'element' => 'second_button', 'not_empty' => TRUE ),
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 90,
			),
			array(
				'param_name' => 'btn2_style',
				'heading' => __( 'Button Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Solid', 'wlgx' ) => 'solid',
					__( 'Outlined', 'wlgx' ) => 'outlined',
				),
				'std' => $config['atts']['btn2_style'],
				'dependency' => array( 'element' => 'second_button', 'not_empty' => TRUE ),
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 80,
			),
			array(
				'param_name' => 'btn2_color',
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
				'std' => $config['atts']['btn2_color'],
				'dependency' => array( 'element' => 'second_button', 'not_empty' => TRUE ),
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 70,
			),
			array(
				'param_name' => 'btn2_size',
				'heading' => __( 'Button Size', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['btn2_size'],
				'dependency' => array( 'element' => 'second_button', 'not_empty' => TRUE ),
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 40,
			),
			array(
				'param_name' => 'btn2_icon',
				'heading' => __( 'Button Icon (optional)', 'wlgx' ),
				'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
				'type' => 'textfield',
				'std' => $config['atts']['btn2_icon'],
				'dependency' => array( 'element' => 'second_button', 'not_empty' => TRUE ),
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 30,
			),
			array(
				'param_name' => 'btn2_iconpos',
				'heading' => __( 'Button Icon Position', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Left', 'wlgx' ) => 'left',
					__( 'Right', 'wlgx' ) => 'right',
				),
				'std' => $config['atts']['btn2_iconpos'],
				'dependency' => array( 'element' => 'second_button', 'not_empty' => TRUE ),
				'edit_field_class' => 'vc_col-sm-4',
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
vc_remove_element( 'vc_cta' );

