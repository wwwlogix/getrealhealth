<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_image_slider
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_image_slider',
		'name' => __( 'Image Slider', 'wlgx' ),
		'icon' => 'icon-wpb-images-stack',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 350,
		'params' => array(
			array(
				'param_name' => 'ids',
				'heading' => __( 'Images', 'wlgx' ),
				'description' => __( 'Select images from media library.', 'wlgx' ),
				'type' => 'attach_images',
				'std' => $config['atts']['ids'],
				'weight' => 110,
			),
			array(
				'param_name' => 'arrows',
				'heading' => __( 'Navigation Arrows', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Show always', 'wlgx' ) => 'always',
					__( 'Show on hover', 'wlgx' ) => 'hover',
					__( 'Hide', 'wlgx' ) => 'hide',
				),
				'std' => $config['atts']['arrows'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 100,
			),
			array(
				'param_name' => 'nav',
				'heading' => __( 'Additional Navigation', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'None', 'wlgx' ) => 'none',
					__( 'Dots', 'wlgx' ) => 'dots',
					__( 'Thumbs', 'wlgx' ) => 'thumbs',
				),
				'std' => $config['atts']['nav'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 90,
			),
			array(
				'param_name' => 'transition',
				'heading' => __( 'Transition Effect', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Slide', 'wlgx' ) => 'slide',
					__( 'Fade', 'wlgx' ) => 'crossfade',
				),
				'std' => $config['atts']['transition'],
				'edit_field_class' => 'vc_col-sm-4',
				'weight' => 80,
			),
			array(
				'param_name' => 'meta',
				'type' => 'checkbox',
				'value' => array( __( 'Show items titles and description', 'wlgx' ) => TRUE ),
				( ( $config['atts']['meta'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['meta'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 70,
			),
			array(
				'param_name' => 'orderby',
				'type' => 'checkbox',
				'value' => array( __( 'Display items in random order', 'wlgx' ) => 'rand' ),
				( ( $config['atts']['orderby'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['orderby'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 60,
			),
			array(
				'param_name' => 'autoplay',
				'type' => 'checkbox',
				'value' => array( __( 'Enable Auto Rotation', 'wlgx' ) => TRUE ),
				( ( $config['atts']['autoplay'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['autoplay'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 55,
			),
			array(
				'param_name' => 'fullscreen',
				'type' => 'checkbox',
				'value' => array( __( 'Allow Full Screen view', 'wlgx' ) => TRUE ),
				( ( $config['atts']['fullscreen'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['fullscreen'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
			),
			array(
				'param_name' => 'autoplay_period',
				'heading' => __( 'Auto Rotation Period (milliseconds)', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['autoplay_period'],
				'dependency' => array( 'element' => 'autoplay', 'not_empty' => TRUE ),
				'weight' => 40,
			),
			array(
				'param_name' => 'img_size',
				'heading' => __( 'Images Size', 'wlgx' ),
				'type' => 'dropdown',
				'value' => wlgx_image_sizes_select_values(),
				'std' => $config['atts']['img_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 30,
			),
			array(
				'param_name' => 'img_fit',
				'heading' => __( 'Images Fit', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Scaledown - Image won\'t be stretched if it\'s smaller than the area', 'wlgx' ) => 'scaledown',
					__( 'Contain - Image will fit inside the area', 'wlgx' ) => 'contain',
					__( 'Cover - Image will cover the whole area', 'wlgx' ) => 'cover',
				),
				'std' => $config['atts']['img_fit'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 20,
			),
			array(
				'param_name' => 'frame',
				'heading' => __( 'Images Frame Mockup', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'None', 'wlgx' ) => 'none',
					__( 'Phone 6 Black Realistic', 'wlgx' ) => 'phone6-1',
					__( 'Phone 6 White Realistic', 'wlgx' ) => 'phone6-2',
					__( 'Phone 6 Black Flat', 'wlgx' ) => 'phone6-3',
					__( 'Phone 6 White Flat', 'wlgx' ) => 'phone6-4',
				),
				'std' => $config['atts']['frame'],
				'weight' => 15,
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
vc_remove_element( 'vc_simple_slider' );

