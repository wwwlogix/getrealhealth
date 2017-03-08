<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_gallery
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_gallery',
		'name' => __( 'Image Gallery', 'wlgx' ),
		'icon' => 'icon-wpb-images-stack',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'description' => __( 'Responsive image gallery', 'wlgx' ),
		'weight' => 360,
		'params' => array(
			array(
				'param_name' => 'ids',
				'heading' => __( 'Images', 'wlgx' ),
				'description' => __( 'Select images from media library.', 'wlgx' ),
				'type' => 'attach_images',
				'std' => $config['atts']['ids'],
				'weight' => 60,
			),
			array(
				'param_name' => 'layout',
				'heading' => __( 'Layout', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Default (square thumbnails)', 'wlgx' ) => 'default',
					__( 'Masonry (thumbnails with initial proportions)', 'wlgx' ) => 'masonry',
				),
				'std' => $config['atts']['layout'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
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
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
				),
				'std' => $config['atts']['columns'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 40,
			),
			array(
				'param_name' => 'orderby',
				'type' => 'checkbox',
				'value' => array( __( 'Display items in random order', 'wlgx' ) => 'rand' ),
				( ( $config['atts']['orderby'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['orderby'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 30,
			),
			array(
				'param_name' => 'indents',
				'type' => 'checkbox',
				'value' => array( __( 'Add indents between items', 'wlgx' ) => TRUE ),
				( ( $config['atts']['indents'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['indents'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 20,
			),
			array(
				'param_name' => 'meta',
				'type' => 'checkbox',
				'value' => array( __( 'Show items titles and description', 'wlgx' ) => TRUE ),
				( ( $config['atts']['meta'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['meta'],
				'weight' => 19,
			),
			array(
				'param_name' => 'meta_style',
				'heading' => __( 'Title and Description Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Simple', 'wlgx' ) => 'simple',
					__( 'Modern', 'wlgx' ) => 'modern',
				),
				'std' => $config['atts']['meta_style'],
				'dependency' => array( 'element' => 'meta', 'not_empty' => TRUE ),
				'weight' => 18,
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
vc_remove_element( 'vc_gallery' );
