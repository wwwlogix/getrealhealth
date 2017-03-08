<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's widgets
 *
 * @filter wlgx_config_widgets
 */

$social_links = wlgx_config( 'social_links' );

$social_links_config = array();

foreach ( $social_links as $name => $title ) {
	$social_links_config[$name] = array(
		'type' => 'textfield',
		'heading' => $title,
		'std' => '',
	);
}

return array(
	'wlgx_contacts' => array(
		'class' => 'wlgx_Widget_Contacts',
		'name' => '(wwwlogix) ' . __( 'Contacts', 'wlgx' ),
		'description' => __( 'Contact Information', 'wlgx' ),
		'params' => array(
			'title' => array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'wlgx' ),
				'std' => __( 'Contacts', 'wlgx' ),
			),
			'address' => array(
				'type' => 'textarea',
				'heading' => __( 'Address', 'wlgx' ),
				'std' => '',
			),
			'phone' => array(
				'type' => 'textarea',
				'heading' => __( 'Phone', 'wlgx' ),
				'std' => '',
			),
			'fax' => array(
				'type' => 'textfield',
				'heading' => __( 'Fax', 'wlgx' ),
				'std' => '',
			),
			'email' => array(
				'type' => 'textfield',
				'heading' => __( 'Email', 'wlgx' ),
				'std' => '',
			),
		),
	),
	'wlgx_login' => array(
		'class' => 'wlgx_Widget_Login',
		'name' => '(wwwlogix) ' . __( 'Login', 'wlgx' ),
		'description' => __( 'Login Form', 'wlgx' ),
		'params' => array(
			'title' => array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'wlgx' ),
				'std' => '',
			),
			'register' => array(
				'type' => 'textfield',
				'heading' => __( 'Register URL', 'wlgx' ),
				'std' => '',
			),
			'lostpass' => array(
				'type' => 'textfield',
				'heading' => __( 'Lost Password URL', 'wlgx' ),
				'std' => '',
			),
			'login_redirect' => array(
				'type' => 'textfield',
				'heading' => __( 'Login Redirect URL', 'wlgx' ),
				'std' => '',
			),
			'logout_redirect' => array(
				'type' => 'textfield',
				'heading' => __( 'Logout Redirect URL', 'wlgx' ),
				'std' => '',
			),
		),
	),
	'wlgx_socials' => array(
		'class' => 'wlgx_Widget_Socials',
		'name' => '(wwwlogix) ' . __( 'Social Links', 'wlgx' ),
		'description' => __( 'Social Links', 'wlgx' ),
		'params' => array_merge(
			array(
				'title' => array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'wlgx' ),
					'std' => '',
				),
				'size' => array(
					'type' => 'textfield',
					'heading' => __( 'Size', 'wlgx' ),
					'std' => '20px',
				),
				'style' => array(
					'type' => 'dropdown',
					'heading' => __( 'Icons Style', 'wlgx' ),
					'value' => array(
						__( 'Simple', 'wlgx' ) => 'default',
						__( 'Inside the Solid square', 'wlgx' ) => 'solid_square',
						__( 'Inside the Outlined square', 'wlgx' ) => 'outlined_square',
						__( 'Inside the Solid circle', 'wlgx' ) => 'solid_circle',
						__( 'Inside the Outlined circle', 'wlgx' ) => 'outlined_circle',
					),
					'std' => 'default',
				),
				'color' => array(
					'type' => 'dropdown',
					'heading' => __( 'Icons Color', 'wlgx' ),
					'value' => array(
						__( 'Default brands colors', 'wlgx' ) => 'brand',
						__( 'Text (theme color)', 'wlgx' ) => 'text',
						__( 'Link (theme color)', 'wlgx' ) => 'link',
					),
					'std' => 'brand',
				),
				'email' => array(
					'type' => 'textfield',
					'heading' => 'Email',
					'std' => '',
				),
			), $social_links_config, array(
				'custom_link' => array(
					'type' => 'textfield',
					'heading' => __( 'Custom Link', 'wlgx' ),
					'std' => '',
				),
				'custom_title' => array(
					'type' => 'textfield',
					'heading' => __( 'Custom Link Title', 'wlgx' ),
					'std' => '',
				),
				'custom_icon' => array(
					'type' => 'textfield',
					'heading' => __( 'Custom Link Icon', 'wlgx' ),
					'std' => '',
				),
				'custom_color' => array(
					'type' => 'textfield',
					'heading' => __( 'Custom Link Color', 'wlgx' ),
					'std' => '#1abc9c',
				),
			)
		),
	),
	'wlgx_casestudy' => array(
		'class' => 'wlgx_Widget_casestudy',
		'name' => '(wwwlogix) ' . __( 'casestudy Grid', 'wlgx' ),
		'description' => __( 'casestudy Grid', 'wlgx' ),
		'params' => array(
			'title' => array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'wlgx' ),
				'std' => '',
			),
			'columns' => array(
				'type' => 'dropdown',
				'heading' => __( 'Columns', 'wlgx' ),
				'value' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'std' => '3',
			),
			'items' => array(
				'type' => 'textfield',
				'heading' => __( 'Items Quantity', 'wlgx' ),
				'std' => '',
			),
			'orderby' => array(
				'type' => 'dropdown',
				'heading' => _x( 'Order', 'sequence of items', 'wlgx' ),
				'value' => array(
					__( 'By date (newer first)', 'wlgx' ) => 'date',
					__( 'By date (older first)', 'wlgx' ) => 'date_asc',
					__( 'Alphabetically', 'wlgx' ) => 'alpha',
					__( 'Random', 'wlgx' ) => 'rand',
				),
				'std' => 'date',
			),
		),
	),
);
