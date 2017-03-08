<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_social_links
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */

$social_links = wlgx_config( 'social_links' );

$social_links_config = array();

$weight = 300;
foreach ( $social_links as $name => $title ) {
	$social_links_config[] = array(
		'param_name' => $name,
		'heading' => $title,
		'type' => 'textfield',
		'std' => $config['atts'][$name],
		'edit_field_class' => 'vc_col-sm-4',
		'weight' => $weight,
	);
	$weight -= 1;
}

vc_map(
	array(
		'base' => 'wlgx_social_links',
		'name' => __( 'Social Links', 'wlgx' ),
		'icon' => 'icon-wpb-ui-separator',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 170,
		'params' => array_merge(
			array(
				array(
					'param_name' => 'email',
					'heading' => __( 'Email', 'wlgx' ),
					'type' => 'textfield',
					'std' => $config['atts']['email'],
					'edit_field_class' => 'vc_col-sm-4',
					'weight' => 301,
				),
			), $social_links_config, array(
				array(
					'param_name' => 'custom_link',
					'heading' => __( 'Custom Link', 'wlgx' ),
					'type' => 'textfield',
					'std' => $config['atts']['custom_link'],
					'weight' => 50,
				),
				array(
					'param_name' => 'custom_title',
					'heading' => __( 'Custom Link Title', 'wlgx' ),
					'type' => 'textfield',
					'std' => $config['atts']['custom_title'],
					'dependency' => array( 'element' => 'custom_link', 'not_empty' => TRUE ),
					'weight' => 40,
				),
				array(
					'param_name' => 'custom_icon',
					'heading' => __( 'Custom Link Icon', 'wlgx' ),
					'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
					'type' => 'textfield',
					'std' => $config['atts']['custom_icon'],
					'dependency' => array( 'element' => 'custom_link', 'not_empty' => TRUE ),
					'edit_field_class' => 'vc_col-sm-6',
					'weight' => 30,
				),
				array(
					'param_name' => 'custom_color',
					'heading' => __( 'Custom Link Color', 'wlgx' ),
					'type' => 'colorpicker',
					'std' => $config['atts']['custom_color'],
					'dependency' => array( 'element' => 'custom_link', 'not_empty' => TRUE ),
					'weight' => 20,
				),
				array(
					'param_name' => 'style',
					'heading' => __( 'Icons Style', 'wlgx' ),
					'type' => 'dropdown',
					'value' => array(
						__( 'Simple', 'wlgx' ) => 'default',
						__( 'Inside the Solid square', 'wlgx' ) => 'solid_square',
						__( 'Inside the Outlined square', 'wlgx' ) => 'outlined_square',
						__( 'Inside the Solid circle', 'wlgx' ) => 'solid_circle',
						__( 'Inside the Outlined circle', 'wlgx' ) => 'outlined_circle',
					),
					'std' => $config['atts']['style'],
					'edit_field_class' => 'vc_col-sm-6',
					'group' => __( 'Styling', 'wlgx' ),
					'weight' => 19,
				),
				array(
					'param_name' => 'color',
					'heading' => __( 'Icons Color', 'wlgx' ),
					'type' => 'dropdown',
					'value' => array(
						__( 'Default brands colors', 'wlgx' ) => 'brand',
						__( 'Text (theme color)', 'wlgx' ) => 'text',
						__( 'Link (theme color)', 'wlgx' ) => 'link',
					),
					'std' => $config['atts']['color'],
					'edit_field_class' => 'vc_col-sm-6',
					'group' => __( 'Styling', 'wlgx' ),
					'weight' => 18,
				),
				array(
					'param_name' => 'size',
					'heading' => __( 'Icons Size', 'wlgx' ),
					'description' => sprintf( __( 'Examples: %s', 'wlgx' ), '26px, 1.3em, 200%' ),
					'type' => 'textfield',
					'std' => $config['atts']['size'],
					'edit_field_class' => 'vc_col-sm-6',
					'group' => __( 'Styling', 'wlgx' ),
					'weight' => 12,
				),
				array(
					'param_name' => 'align',
					'heading' => __( 'Icons Alignment', 'wlgx' ),
					'type' => 'dropdown',
					'value' => array(
						__( 'Left', 'wlgx' ) => 'left',
						__( 'Center', 'wlgx' ) => 'center',
						__( 'Right', 'wlgx' ) => 'right',
					),
					'std' => $config['atts']['align'],
					'edit_field_class' => 'vc_col-sm-6',
					'group' => __( 'Styling', 'wlgx' ),
					'weight' => 11,
				),
				array(
					'param_name' => 'el_class',
					'heading' => wlgx_translate_with_external_domain( 'Extra class name', 'js_composer' ),
					'description' => wlgx_translate_with_external_domain( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
					'type' => 'textfield',
					'std' => $config['atts']['el_class'],
					'group' => __( 'Styling', 'wlgx' ),
					'weight' => 10,
				),
			)
		),
	)
);
