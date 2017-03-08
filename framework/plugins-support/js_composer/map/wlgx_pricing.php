<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_pricing
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 * @param $congig    ['items_atts'] array Items' attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_pricing',
		'name' => __( 'Pricing Table', 'wlgx' ),
		'icon' => 'icon-wpb-pricing-table',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 150,
		'params' => array(
			array(
				'param_name' => 'items',
				'type' => 'param_group',
				'heading' => __( 'Pricing Items', 'wlgx' ),
				// Storing encoded value to reduce memory and CPU usage
				'value' => '%5B%7B%22title%22%3A%22Free%22%2C%22price%22%3A%22%240%22%2C%22substring%22%3A%22per%20month%22%2C%22features%22%3A%221%20project%5Cn1%20user%5Cn200%20tasks%5CnNo%20support%22%2C%22btn_text%22%3A%22Sign%20up%22%2C%22btn_color%22%3A%22light%22%2C%22btn_style%22%3A%22solid%22%2C%22btn_size%22%3A%2215px%22%2C%22btn_iconpos%22%3A%22left%22%7D%2C%7B%22title%22%3A%22Standard%22%2C%22type%22%3A%22featured%22%2C%22price%22%3A%22%2424%22%2C%22substring%22%3A%22per%20month%22%2C%22features%22%3A%2210%20projects%5Cn10%20users%5CnUnlimited%20tasks%5CnPremium%20support%22%2C%22btn_text%22%3A%22Sign%20up%22%2C%22btn_color%22%3A%22primary%22%2C%22btn_style%22%3A%22solid%22%2C%22btn_size%22%3A%2215px%22%2C%22btn_iconpos%22%3A%22left%22%7D%2C%7B%22title%22%3A%22Premium%22%2C%22price%22%3A%22%2450%22%2C%22substring%22%3A%22per%20month%22%2C%22features%22%3A%22Unlimited%20projects%5CnUnlimited%20users%5CnUnlimited%20tasks%5CnPremium%20support%22%2C%22btn_text%22%3A%22Sign%20up%22%2C%22btn_color%22%3A%22light%22%2C%22btn_style%22%3A%22solid%22%2C%22btn_size%22%3A%2215px%22%2C%22btn_iconpos%22%3A%22left%22%7D%5D',
				/*'value' => urlencode( json_encode( array(
					array(
						'title' => 'Free',
						'price' => '$0',
						'substring' => 'per month',
						'features' => "1 project\n1 user\n200 tasks\nNo support",
						'btn_text' => 'Sign up',
						'btn_color' => 'light',
						'btn_size' => '15px',
					),
					array(
						'title' => 'Standard',
						'type' => 'featured',
						'price' => '$24',
						'substring' => 'per month',
						'features' => "10 projects\n10 users\nUnlimited tasks\nPremium support",
						'btn_text' => 'Sign up',
						'btn_color' => 'primary',
						'btn_size' => '15px',
					),
					array(
						'title' => 'Premium',
						'price' => '$50',
						'substring' => 'per month',
						'features' => "Unlimited projects\nUnlimited users\nUnlimited tasks\nPremium support",
						'btn_text' => 'Sign up',
						'btn_color' => 'light',
						'btn_size' => '15px',
					),
				) ) ),*/
				'params' => array(
					array(
						'param_name' => 'title',
						'heading' => __( 'Title', 'wlgx' ),
						'type' => 'textfield',
						'std' => $config['items_atts']['title'],
						'admin_label' => TRUE,
					),
					array(
						'param_name' => 'type',
						'type' => 'checkbox',
						'value' => array( __( 'Mark this item as featured', 'wlgx' ) => 'featured' ),
						( ( $config['items_atts']['type'] !== FALSE ) ? 'std' : '_std' ) => $config['items_atts']['type'],
					),
					array(
						'param_name' => 'price',
						'heading' => __( 'Price', 'wlgx' ),
						'type' => 'textfield',
						'std' => $config['items_atts']['type'],
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'param_name' => 'substring',
						'heading' => __( 'Price Substring', 'wlgx' ),
						'type' => 'textfield',
						'std' => $config['items_atts']['substring'],
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'param_name' => 'features',
						'heading' => __( 'Features List', 'wlgx' ),
						'type' => 'textarea',
						'std' => $config['items_atts']['features'],
					),
					array(
						'param_name' => 'btn_text',
						'heading' => __( 'Button Label', 'wlgx' ),
						'type' => 'textfield',
						'std' => $config['items_atts']['btn_text'],
						'class' => 'wpb_button',
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'param_name' => 'btn_color',
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
						'std' => $config['items_atts']['btn_color'],
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'param_name' => 'btn_style',
						'heading' => __( 'Button Style', 'wlgx' ),
						'type' => 'dropdown',
						'value' => array(
							__( 'Solid', 'wlgx' ) => 'solid',
							__( 'Outlined', 'wlgx' ) => 'outlined',
						),
						'std' => $config['items_atts']['btn_style'],
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'param_name' => 'btn_size',
						'heading' => __( 'Button Size', 'wlgx' ),
						'type' => 'textfield',
						'std' => $config['items_atts']['btn_size'],
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'param_name' => 'btn_icon',
						'heading' => __( 'Button Icon (optional)', 'wlgx' ),
						'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
						'type' => 'textfield',
						'std' => $config['items_atts']['btn_icon'],
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'param_name' => 'btn_iconpos',
						'heading' => __( 'Button Icon Position', 'wlgx' ),
						'type' => 'dropdown',
						'value' => array(
							__( 'Left', 'wlgx' ) => 'left',
							__( 'Right', 'wlgx' ) => 'right',
						),
						'std' => $config['items_atts']['btn_iconpos'],
						'edit_field_class' => 'vc_col-sm-6',
					),
					array(
						'param_name' => 'btn_link',
						'heading' => __( 'Button Link', 'wlgx' ),
						'type' => 'vc_link',
						'std' => $config['items_atts']['btn_link'],
					),
				),
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

