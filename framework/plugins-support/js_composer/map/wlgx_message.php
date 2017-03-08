<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_message
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 * @param $config    ['content'] string Shortcode's default content
 */
vc_map(
	array(
		'base' => 'wlgx_message',
		'name' => __( 'Message Box', 'wlgx' ),
		'icon' => 'icon-wpb-information-white',
		'wrapper_class' => 'alert',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 200,
		'params' => array(
			array(
				'param_name' => 'color',
				'heading' => __( 'Color Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Notification (blue)', 'wlgx' ) => 'info',
					__( 'Attention (yellow)', 'wlgx' ) => 'attention',
					__( 'Success (green)', 'wlgx' ) => 'success',
					__( 'Error (red)', 'wlgx' ) => 'error',
					__( 'Custom colors', 'wlgx' ) => 'custom',
				),
				'std' => $config['atts']['color'],
				'weight' => 70,
			),
			array(
				'param_name' => 'bg_color',
				'heading' => __( 'Background Color', 'wlgx' ),
				'type' => 'colorpicker',
				'std' => $config['atts']['bg_color'],
				'holder' => 'div',
				'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
				'weight' => 60,
			),
			array(
				'param_name' => 'text_color',
				'heading' => __( 'Text Color', 'wlgx' ),
				'type' => 'colorpicker',
				'std' => $config['atts']['text_color'],
				'holder' => 'div',
				'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
				'weight' => 50,
			),
			array(
				'param_name' => 'content',
				'heading' => __( 'Message Text', 'wlgx' ),
				'type' => 'textarea',
				'value' => 'I am message box. Click edit button to change this text.',
				'std' => $config['content'],
				'holder' => 'div',
				'class' => 'content',
				'weight' => 40,
			),
			array(
				'param_name' => 'icon',
				'heading' => __( 'Icon', 'wlgx' ),
				'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
				'type' => 'textfield',
				'std' => $config['atts']['icon'],
				'weight' => 30,
			),
			array(
				'param_name' => 'closing',
				'type' => 'checkbox',
				'value' => array( __( 'Enable closing', 'wlgx' ) => TRUE ),
				( ( $config['atts']['closing'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['closing'],
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
		'js_view' => 'VcMessageView',
	)
);
vc_remove_element( 'vc_message' );
