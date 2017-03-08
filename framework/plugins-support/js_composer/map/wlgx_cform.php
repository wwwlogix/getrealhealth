<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_cform
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_cform',
		'name' => __( 'Contact Form', 'wlgx' ),
		'icon' => 'icon-wpb-ui-separator',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 180,
		'params' => array(
			array(
				'param_name' => 'receiver_email',
				'heading' => __( 'Receiver Email', 'wlgx' ),
				'description' => sprintf( __( 'Requests will be sent to this Email. You can insert multiple comma-separated emails as well.', 'wlgx' ) ),
				'type' => 'textfield',
				'std' => $config['atts']['receiver_email'],
				'weight' => 130,
			),
			array(
				'param_name' => 'name_field',
				'heading' => __( 'Name field', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Shown, required', 'wlgx' ) => 'required',
					__( 'Shown, not required', 'wlgx' ) => 'shown',
					__( 'Hidden', 'wlgx' ) => 'hidden',
				),
				'std' => $config['atts']['name_field'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 120,
			),
			array(
				'param_name' => 'email_field',
				'heading' => __( 'Email field', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Shown, required', 'wlgx' ) => 'required',
					__( 'Shown, not required', 'wlgx' ) => 'shown',
					__( 'Hidden', 'wlgx' ) => 'hidden',
				),
				'std' => $config['atts']['email_field'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 110,
			),
			array(
				'param_name' => 'phone_field',
				'heading' => __( 'Phone field', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Shown, required', 'wlgx' ) => 'required',
					__( 'Shown, not required', 'wlgx' ) => 'shown',
					__( 'Hidden', 'wlgx' ) => 'hidden',
				),
				'std' => $config['atts']['phone_field'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 100,
			),
			array(
				'param_name' => 'message_field',
				'heading' => __( 'Message field', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Shown, required', 'wlgx' ) => 'required',
					__( 'Shown, not required', 'wlgx' ) => 'shown',
					__( 'Hidden', 'wlgx' ) => 'hidden',
				),
				'std' => $config['atts']['message_field'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 90,
			),
			array(
				'param_name' => 'captcha_field',
				'heading' => __( 'Captcha field', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Hidden', 'wlgx' ) => 'hidden',
					__( 'Shown, required', 'wlgx' ) => 'required',
				),
				'std' => $config['atts']['captcha_field'],
				'weight' => 80,
			),
			array(
				'param_name' => 'button_text',
				'heading' => __( 'Button Label', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['button_text'],
				'group' => __( 'Button', 'wlgx' ),
				'weight' => 70,
			),
			array(
				'param_name' => 'button_style',
				'heading' => __( 'Button Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Solid', 'wlgx' ) => 'solid',
					__( 'Outlined', 'wlgx' ) => 'outlined',
				),
				'std' => $config['atts']['button_style'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Button', 'wlgx' ),
				'weight' => 60,
			),
			array(
				'param_name' => 'button_color',
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
				'std' => $config['atts']['button_color'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Button', 'wlgx' ),
				'weight' => 50,
			),
			array(
				'param_name' => 'button_size',
				'heading' => __( 'Button Size', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['button_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Button', 'wlgx' ),
				'weight' => 30,
			),
			array(
				'param_name' => 'button_align',
				'heading' => __( 'Button Alignment', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Left', 'wlgx' ) => 'left',
					__( 'Center', 'wlgx' ) => 'center',
					__( 'Right', 'wlgx' ) => 'right',
				),
				'std' => $config['atts']['button_align'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Button', 'wlgx' ),
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
