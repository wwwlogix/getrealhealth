<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's options
 *
 * @filter wlgx_config_meta-boxes
 */
$custom_post_types = wlgx_get_option( 'custom_post_types_support' );

$titlebar_common_fields = array(
	'wlgx_titlebar_subtitle' => array(
		'title' => __( 'Description (shown next to Page Title)', 'wlgx' ),
		'type' => 'text',
		'std' => '',
		'show_if' => array( 'wlgx_titlebar_content', '!=', 'hide' ),
	),
	'wlgx_titlebar_size' => array(
		'title' => __( 'Title Bar Size', 'wlgx' ),
		'type' => 'select',
		'options' => array(
			'' => __( 'Default (from Theme Options)', 'wlgx' ),
			'small' => __( 'Small', 'wlgx' ),
			'medium' => __( 'Medium', 'wlgx' ),
			'large' => __( 'Large', 'wlgx' ),
			'huge' => __( 'Huge', 'wlgx' ),
		),
		'std' => '',
		'show_if' => array( 'wlgx_titlebar_content', '!=', 'hide' ),
	),
	'wlgx_titlebar_color' => array(
		'title' => __( 'Title Bar Color Style', 'wlgx' ),
		'type' => 'select',
		'options' => array(
			'' => __( 'Default (from Theme Options)', 'wlgx' ),
			'default' => __( 'Content colors', 'wlgx' ),
			'alternate' => __( 'Alternate Content colors', 'wlgx' ),
			'primary' => __( 'Primary bg & White text', 'wlgx' ),
			'secondary' => __( 'Secondary bg & White text', 'wlgx' ),
		),
		'std' => '',
		'show_if' => array( 'wlgx_titlebar_content', '!=', 'hide' ),
	),
	'wlgx_titlebar_image' => array(
		'title' => __( 'Background Image', 'wlgx' ),
		'type' => 'upload',
		'extension' => 'png,jpg,jpeg,gif,svg',
		'show_if' => array( 'wlgx_titlebar_content', '!=', 'hide' ),
	),
	'wlgx_titlebar_image_size' => array(
		'title' => __( 'Background Image Size', 'wlgx' ),
		'type' => 'select',
		'options' => array(
			'cover' => __( 'Cover - Image will cover the whole area', 'wlgx' ),
			'contain' => __( 'Contain - Image will fit inside the area', 'wlgx' ),
			'initial' => __( 'Initial', 'wlgx' ),
		),
		'std' => 'cover',
		'show_if' => array(
			array( 'wlgx_titlebar_content', '!=', 'hide' ),
			'and',
			array( 'wlgx_titlebar_image', '!=', '' ),
		),
	),
	'wlgx_titlebar_image_parallax' => array(
		'title' => __( 'Parallax Effect', 'wlgx' ),
		'type' => 'select',
		'options' => array(
			'' => __( 'None', 'wlgx' ),
			'vertical' => __( 'Vertical Parallax', 'wlgx' ),
			'vertical_reversed' => __( 'Vertical Reversed Parallax', 'wlgx' ),
			'horizontal' => __( 'Horizontal Parallax', 'wlgx' ),
			'still' => __( 'Still (Image doesn\'t move)', 'wlgx' ),
		),
		'std' => '',
		'show_if' => array(
			array( 'wlgx_titlebar_content', '!=', 'hide' ),
			'and',
			array( 'wlgx_titlebar_image', '!=', '' ),
		),
	),
	'wlgx_titlebar_overlay_color' => array(
		'title' => __( 'Overlay Color', 'wlgx' ),
		'type' => 'color',
		'show_if' => array(
			array( 'wlgx_titlebar_content', '!=', 'hide' ),
			'and',
			array( 'wlgx_titlebar_image', '!=', '' ),
		),
	),
);

global $wp_registered_sidebars;
$sidebars_options = array();

if ( is_array( $wp_registered_sidebars ) && ! empty( $wp_registered_sidebars ) ) {
	foreach ( $wp_registered_sidebars as $sidebar ) {
		if ( $sidebar['id'] == 'default_sidebar' ) { // If it is default sidebar ...
			$sidebars_options = array_merge( array( $sidebar['id'] => $sidebar['name'] ), $sidebars_options ); // adding it to beginning of default array

		} else {
			$sidebars_options[$sidebar['id']] = $sidebar['name'];
		}
	}
}

$sidebars_options = array_merge( array( '' => __( 'Default (from Theme Options)', 'wlgx' ) ), $sidebars_options );

return array(
	// Blog Post settings
	array(
		'id' => 'wlgx_post_settings',
		'title' => __( 'Featured Image Layout', 'wlgx' ),
		'post_types' => array( 'post' ),
		'context' => 'side',
		'priority' => 'low',
		'fields' => array(
			'wlgx_post_preview_layout' => array(
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (from Theme Options)', 'wlgx' ),
					'basic' => __( 'Standard', 'wlgx' ),
					'modern' => __( 'Modern', 'wlgx' ),
					'trendy' => __( 'Trendy', 'wlgx' ),
					'none' => __( 'No Preview', 'wlgx' ),
				),
				'std' => '',
			),
		),
	),
	// Sidebar settings
	array(
		'id' => 'wlgx_sidebar_settings',
		'title' => __( 'Sidebar', 'wlgx' ),
		'post_types' => array_merge( array( 'post', 'page', 'wlgx_casestudy', 'product' ), $custom_post_types ),
		'context' => 'side',
		'priority' => 'low',
		'fields' => array(
			'wlgx_sidebar' => array(
				'title' => __( 'Sidebar Position', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (from Theme Options)', 'wlgx' ),
					'none' => __( 'No Sidebar', 'wlgx' ),
					'right' => __( 'Right', 'wlgx' ),
					'left' => __( 'Left', 'wlgx' ),
				),
				'std' => '',
			),
			'wlgx_sidebar_id' => array(
				'title' => __( 'Sidebar Content', 'wlgx' ),
				'description' => sprintf( __( 'This dropdown list shows the Widget Areas, which you can populate on the %sWidgets%s page.', 'wlgx' ), '<a target="_blank" href="' . admin_url() . 'widgets.php">', '</a>' ),
				'type' => 'select',
				'options' => $sidebars_options,
				'std' => '',
				'show_if' => array( 'wlgx_sidebar', '!=', 'none' ),
			),
		),
	),
	// Header settings
	array(
		'id' => 'wlgx_header_settings',
		'title' => __( 'Header Options', 'wlgx' ),
		'post_types' => array_merge( array( 'post', 'page', 'wlgx_casestudy', 'product' ), $custom_post_types ),
		'context' => 'side',
		'priority' => 'low',
		'fields' => array(
			'wlgx_header_remove' => array(
				'type' => 'switch',
				'text' => __( 'Remove header on this page', 'wlgx' ),
				'std' => 0,
			),
			'wlgx_header_pos' => array(
				'title' => __( 'Sticky Header', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (from Theme Options)', 'wlgx' ),
					'fixed' => __( 'Sticky on this page', 'wlgx' ),
					'static' => __( 'Not sticky on this page', 'wlgx' ),
				),
				'std' => '',
				'show_if' => array( 'wlgx_header_remove', '=', FALSE ),
			),
			'wlgx_header_bg' => array(
				'title' => __( 'Transparent Header', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (from Theme Options)', 'wlgx' ),
					'transparent' => __( 'Transparent on this page', 'wlgx' ),
					'solid' => __( 'Not transparent on this page', 'wlgx' ),
				),
				'std' => '',
				'show_if' => array( 'wlgx_header_remove', '=', FALSE ),
			),
			'wlgx_header_sticky_pos' => array(
				'title' => __( 'Sticky Header Initial Position', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'At the Top of this page', 'wlgx' ),
					'bottom' => __( 'At the Bottom of the first content row', 'wlgx' ),
					'above' => __( 'Above the first content row', 'wlgx' ),
					'below' => __( 'Below the first content row', 'wlgx' ),
				),
				'std' => '',
				'show_if' => array(
					array( 'wlgx_header_remove', '=', FALSE ),
					'and',
					array( 'wlgx_header_pos', '!=', 'static' ),
				),
			),
		),
	),
	// Titlebar settings
	array(
		'id' => 'wlgx_titlebar_settings',
		'title' => __( 'Title Bar Options', 'wlgx' ),
		'post_types' => array_merge( array( 'page', 'product', 'post' ), $custom_post_types ),
		'context' => 'side',
		'priority' => 'low',
		'fields' => array_merge(
			array(
				'wlgx_titlebar_content' => array(
					'type' => 'select',
					'options' => array(
						'' => __( 'Default (from Theme Options)', 'wlgx' ),
						'all' => __( 'Title, Description, Breadcrumbs', 'wlgx' ),
						'caption' => __( 'Title, Description', 'wlgx' ),
						'hide' => __( 'Hide Title Bar', 'wlgx' ),
					),
					'std' => '',
				),
			), $titlebar_common_fields
		),
	),
	// Titlebar settings for casestudy Items
	array(
		'id' => 'wlgx_titlebar_settings_casestudy',
		'title' => __( 'Title Bar Options', 'wlgx' ),
		'post_types' => array( 'wlgx_casestudy' ),
		'context' => 'side',
		'priority' => 'low',
		'fields' => array_merge(
			array(
				'wlgx_titlebar_content' => array(
					'type' => 'select',
					'options' => array(
						'' => __( 'Default (from Theme Options)', 'wlgx' ),
						'all' => __( 'Title, Description, Arrows', 'wlgx' ),
						'caption' => __( 'Title, Description', 'wlgx' ),
						'hide' => __( 'Hide Title Bar', 'wlgx' ),
					),
					'std' => '',
				),
			), $titlebar_common_fields
		),
	),
	// Footer settings
	array(
		'id' => 'wlgx_footer_settings',
		'title' => __( 'Footer Options', 'wlgx' ),
		'post_types' => array_merge( array( 'post', 'page', 'wlgx_casestudy', 'product' ), $custom_post_types ),
		'context' => 'side',
		'priority' => 'low',
		'fields' => array(
			'wlgx_footer_show_top' => array(
				'title' => __( 'Show widgets area', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (from Theme Options)', 'wlgx' ),
					'show' => __( 'Show', 'wlgx' ),
					'hide' => __( 'Hide', 'wlgx' ),
				),
				'std' => '',
			),
			'wlgx_footer_show_bottom' => array(
				'title' => __( 'Show copyright and menu area', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (from Theme Options)', 'wlgx' ),
					'show' => __( 'Show', 'wlgx' ),
					'hide' => __( 'Hide', 'wlgx' ),
				),
				'std' => '',
			),
		),
	),
	// casestudy Item settings
	array(
		'id' => 'wlgx_casestudy_settings',
		'title' => __( 'casestudy Grid Options', 'wlgx' ),
		'post_types' => array( 'wlgx_casestudy' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			'wlgx_featured_action' => array(
				'title' => __( 'Check if Case study is featured to display it full width image on case study page', 'wlgx' ),
				'type' => 'radio',
				'options' => array(
					'Ordinary' => __( 'Normal', 'wlgx' ),
					'featured' => __( 'featured', 'wlgx' )
				)
			),
			'wlgx_tile_featured_image' => array(
				'title' => __( 'Featured Image (Optional) for featured case study only ', 'wlgx' ),
				'type' => 'upload',
				'extension' => 'png,jpg,jpeg,gif,svg',
			),
			'wlgx_tile_featured_category' => array(
				'title' => __( 'Featured Category Slug (Optional)  ', 'wlgx' ),
				'type' => 'text'
			),
			'wlgx_tile_bg_color' => array(
				'title' => __( 'Overlay Background Color', 'wlgx' ),
				'type' => 'color',
			),
			'wlgx_tile_text_color' => array(
				'title' => __( 'Text and button color', 'wlgx' ),
				'type' => 'color',
			), 
			'wlgx_tile_additional_image' => array(
				'title' => __( 'Overlay Image', 'wlgx' ),
				'type' => 'upload',
				'extension' => 'png,jpg,jpeg,gif,svg',
			),
			'wlgx_tile_logo_image' => array(
				'title' => __( 'Logo Image ', 'wlgx' ),
				'type' => 'upload',
				'extension' => 'png,jpg,jpeg,gif,svg',
			),
		),
	),
	// Testimonials settings
	array(
		'id' => 'wlgx_testimonials_settings',
		'title' => __( 'More Options', 'wlgx' ),
		'post_types' => array( 'wlgx_testimonial' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			'wlgx_testimonial_author' => array(
				'title' => __( 'Author Name', 'wlgx' ),
				'type' => 'text',
				'std' => 'John Doe',
			),
			'wlgx_testimonial_role' => array(
				'title' => __( 'Author Role', 'wlgx' ),
				'type' => 'text',
				'std' => '',
			),
			'wlgx_testimonial_link' => array(
				'title' => __( 'Author Link', 'wlgx' ),
				'type' => 'link',
				'placeholder' => __( 'Paste URL', 'wlgx' ),
				'std' => '',
			),
		),
	),
);
