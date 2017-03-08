<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_testimonials
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 * @param $config    ['content'] string Shortcode's default content
 */
vc_map(
	array(
		'base' => 'wlgx_testimonials',
		'name' => __( 'Testimonials', 'wlgx' ),
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 270,
		'params' => array(
			array(
				'param_name' => 'type',
				'heading' => __( 'Display items as', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Grid', 'wlgx' ) => 'grid',
					__( 'Masonry', 'wlgx' ) => 'masonry',
					__( 'Carousel', 'wlgx' ) => 'carousel',
				),
				'std' => $config['atts']['type'],
				'admin_label' => TRUE,
				'weight' => 100,
			),
			array(
				'param_name' => 'arrows',
				'type' => 'checkbox',
				'value' => array( __( 'Show Navigation Arrows', 'wlgx' ) => TRUE ),
				( ( $config['atts']['arrows'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['arrows'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'weight' => 90,
			),
			array(
				'param_name' => 'dots',
				'type' => 'checkbox',
				'value' => array( __( 'Show Navigation Dots', 'wlgx' ) => TRUE ),
				( ( $config['atts']['dots'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['dots'],
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'weight' => 90,
			),
			array(
				'param_name' => 'auto_scroll',
				'type' => 'checkbox',
				'value' => array( __( 'Enable Auto Rotation', 'wlgx' ) => TRUE ),
				( ( $config['atts']['auto_scroll'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['auto_scroll'],
				'dependency' => array( 'element' => 'type', 'value' => 'carousel' ),
				'weight' => 80,
			),
			array(
				'param_name' => 'interval',
				'heading' => __( 'Auto Rotation Interval (in seconds)', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['interval'],
				'dependency' => array( 'element' => 'auto_scroll', 'not_empty' => TRUE ),
				'weight' => 70,
			),
			array(
				'param_name' => 'columns',
				'heading' => __( 'Columns', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'std' => $config['atts']['columns'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 60,
			),
			array(
				'param_name' => 'orderby',
				'heading' => _x( 'Order', 'sequence of items', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'By date (newer first)', 'wlgx' ) => 'date',
					__( 'By date (older first)', 'wlgx' ) => 'date_asc',
					__( 'Random', 'wlgx' ) => 'rand',
				),
				'std' => $config['atts']['orderby'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
			),
			array(
				'param_name' => 'style',
				'heading' => __( 'Items Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					sprintf( __( 'Style %d', 'wlgx' ), 1 ) => '1',
					sprintf( __( 'Style %d', 'wlgx' ), 2 ) => '2',
					sprintf( __( 'Style %d', 'wlgx' ), 3 ) => '3',
					sprintf( __( 'Style %d', 'wlgx' ), 4 ) => '4',
					sprintf( __( 'Style %d', 'wlgx' ), 5 ) => '5',
					sprintf( __( 'Style %d', 'wlgx' ), 6 ) => '6',
				),
				'std' => $config['atts']['style'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 40,
			),
			array(
				'param_name' => 'text_size',
				'heading' => __( 'Items Text Size', 'wlgx' ),
				'description' => sprintf( __( 'Examples: %s', 'wlgx' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['text_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 30,
			),
			array(
				'param_name' => 'items',
				'heading' => __( 'Items Quantity', 'wlgx' ),
				'description' => __( 'If left blank, will output all the items', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['items'],
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
