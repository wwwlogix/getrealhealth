<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Extending shortcode: vc_row
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_remove_param( 'vc_row', 'full_width' );
vc_remove_param( 'vc_row', 'full_height' );
vc_remove_param( 'vc_row', 'content_placement' );
vc_remove_param( 'vc_row', 'video_bg' );
vc_remove_param( 'vc_row', 'video_bg_url' );
vc_remove_param( 'vc_row', 'video_bg_parallax' );
vc_remove_param( 'vc_row', 'columns_placement' );
vc_remove_param( 'vc_row', 'equal_height' );
vc_remove_param( 'vc_row', 'parallax_speed_video' );
vc_remove_param( 'vc_row', 'parallax_speed_bg' );
vc_remove_param( 'vc_row', 'css_animation' );
if ( ! vc_is_page_editable() ) {
	vc_remove_param( 'vc_row', 'parallax' );
	vc_remove_param( 'vc_row', 'parallax_image' );
}
vc_update_shortcode_param(
	'vc_row', array(
	'param_name' => 'gap',
	'description' => '',
	'edit_field_class' => 'vc_col-sm-6',
	'weight' => 165,
)
);
vc_add_params(
	'vc_row', array(
	array(
		'param_name' => 'content_placement',
		'heading' => __( 'Columns Content Position', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'Default', 'wlgx' ) => 'default',
			__( 'Top', 'wlgx' ) => 'top',
			__( 'Middle', 'wlgx' ) => 'middle',
			__( 'Bottom', 'wlgx' ) => 'bottom',
		),
		'std' => $config['atts']['content_placement'],
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 190,
	),
	array(
		'param_name' => 'columns_type',
		'heading' => __( 'Columns Layout', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'Default', 'wlgx' ) => 'default',
			__( 'Boxes', 'wlgx' ) => 'boxes',
		),
		'std' => $config['atts']['columns_type'],
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 180,
	),
	array(
		'param_name' => 'height',
		'heading' => __( 'Row Height', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'No paddings', 'wlgx' ) => 'auto',
			__( 'Small paddings', 'wlgx' ) => 'small',
			__( 'Medium paddings', 'wlgx' ) => 'medium',
			__( 'Large paddings', 'wlgx' ) => 'large',
			__( 'Huge paddings', 'wlgx' ) => 'huge',
			__( 'Full Screen', 'wlgx' ) => 'full',
		),
		'std' => $config['atts']['height'],
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 170,
	),
	array(
		'param_name' => 'valign',
		'type' => 'checkbox',
		'dependency' => array( 'element' => 'height', 'value' => 'full' ),
		'value' => array( __( 'Center content of this row vertically', 'wlgx' ) => 'center' ),
		( ( $config['atts']['valign'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['valign'],
		'weight' => 160,
	),
	array(
		'param_name' => 'width',
		'heading' => __( 'Full Width Content', 'wlgx' ),
		'type' => 'checkbox',
		'value' => array( __( 'Stretch content of this row to the screen width', 'wlgx' ) => 'full' ),
		( ( $config['atts']['width'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['width'],
		'weight' => 150,
	),
	array(
		'param_name' => 'color_scheme',
		'heading' => __( 'Row Color Style', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'Content colors', 'wlgx' ) => '',
			__( 'Alternate Content colors', 'wlgx' ) => 'alternate',
			__( 'Primary bg & White text', 'wlgx' ) => 'primary',
			__( 'Secondary bg & White text', 'wlgx' ) => 'secondary',
			__( 'Custom colors', 'wlgx' ) => 'custom',
		),
		'std' => $config['atts']['color_scheme'],
		'weight' => 140,
	),
	array(
		'param_name' => 'wlgx_bg_color',
		'heading' => __( 'Background Color', 'wlgx' ),
		'type' => 'colorpicker',
		'std' => $config['atts']['wlgx_bg_color'],
		'edit_field_class' => 'vc_col-sm-6',
		'dependency' => array( 'element' => 'color_scheme', 'value' => 'custom' ),
		'weight' => 130,
	),
	array(
		'param_name' => 'wlgx_text_color',
		'heading' => __( 'Text Color', 'wlgx' ),
		'type' => 'colorpicker',
		'std' => $config['atts']['wlgx_text_color'],
		'dependency' => array( 'element' => 'color_scheme', 'value' => 'custom' ),
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 120,
	),
	array(
		'param_name' => 'wlgx_bg_image',
		'heading' => __( 'Background Image', 'wlgx' ),
		'type' => 'attach_image',
		'std' => $config['atts']['wlgx_bg_image'],
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 100,
	),
	array(
		'param_name' => 'wlgx_bg_size',
		'heading' => __( 'Background Image Size', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'Cover - Image will cover the whole area', 'wlgx' ) => 'cover',
			__( 'Contain - Image will fit inside the area', 'wlgx' ) => 'contain',
			__( 'Initial', 'wlgx' ) => 'initial',
		),
		'std' => $config['atts']['wlgx_bg_size'],
		'dependency' => array( 'element' => 'wlgx_bg_image', 'not_empty' => TRUE ),
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 90,
	),
	array(
		'param_name' => 'wlgx_bg_repeat',
		'heading' => __( 'Background Image Repeat', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'Repeat', 'wlgx' ) => 'repeat',
			__( 'Repeat Horizontally', 'wlgx' ) => 'repeat-x',
			__( 'Repeat Vertically', 'wlgx' ) => 'repeat-y',
			__( 'Do Not Repeat', 'wlgx' ) => 'no-repeat',
		),
		'std' => $config['atts']['wlgx_bg_repeat'],
		'dependency' => array( 'element' => 'wlgx_bg_image', 'not_empty' => TRUE ),
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 88,
	),
	array(
		'param_name' => 'wlgx_bg_pos',
		'heading' => __( 'Background Image Position', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'Top Left', 'wlgx' ) => 'top left',
			__( 'Top Center', 'wlgx' ) => 'top center',
			__( 'Top Right', 'wlgx' ) => 'top right',
			__( 'Center Left', 'wlgx' ) => 'center left',
			__( 'Center Center', 'wlgx' ) => 'center center',
			__( 'Center Right', 'wlgx' ) => 'center right',
			__( 'Bottom Left', 'wlgx' ) => 'bottom left',
			__( 'Bottom Center', 'wlgx' ) => 'bottom center',
			__( 'Bottom Right', 'wlgx' ) => 'bottom right',
		),
		'std' => $config['atts']['wlgx_bg_pos'],
		'dependency' => array( 'element' => 'wlgx_bg_image', 'not_empty' => TRUE ),
		'edit_field_class' => 'vc_col-sm-6',
		'weight' => 85,
	),
	array(
		'param_name' => 'wlgx_bg_parallax',
		'heading' => __( 'Parallax Effect', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			__( 'None', 'wlgx' ) => '',
			__( 'Vertical Parallax', 'wlgx' ) => 'vertical',
			__( 'Horizontal Parallax', 'wlgx' ) => 'horizontal',
			__( 'Still (Image doesn\'t move)', 'wlgx' ) => 'still',
		),
		'std' => $config['atts']['wlgx_bg_parallax'],
		'dependency' => array( 'element' => 'wlgx_bg_image', 'not_empty' => TRUE ),
		'weight' => 80,
	),
	array(
		'param_name' => 'wlgx_bg_parallax_width',
		'heading' => __( 'Parallax Background Width', 'wlgx' ),
		'type' => 'dropdown',
		'value' => array(
			'110%' => '110',
			'120%' => '120',
			'130%' => '130',
			'140%' => '140',
			'150%' => '150',
		),
		'std' => $config['atts']['wlgx_bg_parallax_width'],
		'dependency' => array( 'element' => 'wlgx_bg_parallax', 'value' => 'horizontal' ),
		'weight' => 70,
	),
	array(
		'param_name' => 'wlgx_bg_parallax_reverse',
		'type' => 'checkbox',
		'value' => array( __( 'Reverse Vertical Parallax Effect', 'wlgx' ) => TRUE ),
		( ( $config['atts']['wlgx_bg_parallax_reverse'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['wlgx_bg_parallax_reverse'],
		'dependency' => array( 'element' => 'wlgx_bg_parallax', 'value' => 'vertical' ),
		'weight' => 60,
	),
	array(
		'param_name' => 'wlgx_bg_video',
		'heading' => __( 'Background Video', 'wlgx' ),
		'description' => __( 'Link to video file (mp4, webm, ogg)', 'wlgx' ),
		'type' => 'textfield',
		'std' => $config['atts']['wlgx_bg_video'],
		'weight' => 50,
	),
	array(
		'param_name' => 'wlgx_bg_overlay_color',
		'heading' => __( 'Background Overlay', 'wlgx' ),
		'type' => 'colorpicker',
		'std' => $config['atts']['wlgx_bg_overlay_color'],
		'holder' => 'div',
		'weight' => 10,
	),
)
);
if ( class_exists( 'Ultimate_VC_Addons' ) ) {
	vc_add_param(
		'vc_row', array(
		'param_name' => 'wlgx_notification',
		'type' => 'ult_param_heading',
		'text' => __( 'Background Image, Background Video, Background Overlay settings located below will override the settings located at "Background" and "Effect" tabs.', 'wlgx' ),
		'edit_field_class' => 'ult-param-important-wrapper ult-dashicon vc_column vc_col-sm-12',
		'weight' => 110,
	)
	);
}

// Setting proper shortcode order in VC shortcodes listing
vc_map_update( 'vc_row', array( 'weight' => 390 ) );
