<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_testimonial
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 * @param $config    ['content'] string Shortcode's default content
 */
vc_map(
	array(
		'base' => 'wlgx_testimonial',
		'name' => __( 'Testimonial', 'wlgx' ),
		'icon' => 'icon-wpb-ui-separator-label',
		'deprecated' => 3.9,
		'weight' => 270,
		'params' => array(
			array(
				'param_name' => 'style',
				'heading' => __( 'Quote Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					sprintf( __( 'Style %d', 'wlgx' ), 1 ) => '1',
					sprintf( __( 'Style %d', 'wlgx' ), 2 ) => '2',
					sprintf( __( 'Style %d', 'wlgx' ), 3 ) => '3',
					sprintf( __( 'Style %d', 'wlgx' ), 4 ) => '4',
				),
				'std' => $config['atts']['style'],
				'weight' => 70,
			),
			array(
				'param_name' => 'content',
				'heading' => __( 'Quote Text', 'wlgx' ),
				'type' => 'textarea',
				'std' => $config['content'],
				'admin_label' => TRUE,
				'weight' => 60,
			),
			array(
				'param_name' => 'author',
				'heading' => __( 'Author Name', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['author'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
			),
			array(
				'param_name' => 'company',
				'heading' => __( 'Author Role', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['company'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 40,
			),
			array(
				'param_name' => 'img',
				'heading' => __( 'Author Photo', 'wlgx' ),
				'type' => 'attach_image',
				'std' => $config['atts']['img'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 30,
			),
			array(
				'param_name' => 'link',
				'heading' => __( 'Link (optional)', 'wlgx' ),
				'description' => __( 'Applies to the Name and to the Photo', 'wlgx' ),
				'type' => 'vc_link',
				'std' => $config['atts']['link'],
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
