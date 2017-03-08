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
		'name' => __( 'Contacts', 'wlgx' ),
		'base' => 'wlgx_contacts',
		'icon' => 'icon-wpb-ui-separator',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 140,
		'params' => array(
			array(
				'param_name' => 'address',
				'heading' => __( 'Address', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['address'],
				'weight' => 50,
			),
			array(
				'param_name' => 'phone',
				'heading' => __( 'Phone', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['phone'],
				'weight' => 40,
			),
			array(
				'param_name' => 'fax',
				'heading' => __( 'Fax', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['fax'],
				'weight' => 30,
			),
			array(
				'param_name' => 'email',
				'heading' => __( 'Email', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['email'],
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
