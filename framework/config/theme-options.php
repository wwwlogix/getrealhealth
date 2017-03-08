<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's options
 *
 * @filter wlgx_config_theme-options
 */

global $wlgx_template_directory_uri, $wp_registered_sidebars;
// Getting Sidebars
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

// Getting Custom Post Types
$post_type_args = array(
	'public' => TRUE,
	'_builtin' => FALSE,
);
$post_types = get_post_types( $post_type_args, 'objects', 'and' );
$supported_post_types = array( 'forum', 'topic', 'reply', 'product', 'wlgx_casestudy', 'tribe_events' );
$custom_post_types_support_values = array();
foreach ( $post_types as $post_type_name => $post_type ) {
	if ( ! in_array( $post_type_name, $supported_post_types ) ) {
		$custom_post_types_support_values[$post_type_name] = $post_type->labels->singular_name;
	}
}

$social_links = wlgx_config( 'social_links' );

$social_links_config = array();

foreach ( $social_links as $name => $title ) {
	$social_links_config['header_socials_' . $name] = array(
		'placeholder' => $title,
		'type' => 'text',
		'std' => '',
		'classes' => 'for_social cols_3',
	);
}

return array(
	'generalsettings' => array(
		'title' => __( 'General Settings', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/mixer.png',
		'fields' => array(
			'preloader' => array(
				'title' => __( 'Preloader Screen', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'disabled' => __( 'Disabled', 'wlgx' ),
					'1' => sprintf( __( 'Shows Preloader %d', 'wlgx' ), 1 ),
					'2' => sprintf( __( 'Shows Preloader %d', 'wlgx' ), 2 ),
					'3' => sprintf( __( 'Shows Preloader %d', 'wlgx' ), 3 ),
					'4' => sprintf( __( 'Shows Preloader %d', 'wlgx' ), 4 ),
					'5' => sprintf( __( 'Shows Preloader %d', 'wlgx' ), 5 ),
					'custom' => __( 'Shows Custom Image', 'wlgx' ),
				),
				'std' => 'disabled',
			),
			'preloader_image' => array(
				'title' => '',
				'type' => 'upload',
				'extension' => 'png,jpg,jpeg,gif,svg',
				'classes' => 'for_above',
				'show_if' => array( 'preloader', '=', 'custom' ),
			),
			'responsive_layout' => array(
				'title' => __( 'Responsive Layout', 'wlgx' ),
				'type' => 'switch',
				'text' => __( 'Enable responsive layout', 'wlgx' ),
				'std' => 1,
			),
			'custom_post_types_support' => array(
				'title' => __( 'Support of Custom Post Types', 'wlgx' ),
				'description' => __( 'Mark the needed custom post type, if you want to enable Header, Sidebar, Title Bar and Footer options for it.', 'wlgx' ),
				'type' => 'checkboxes',
				'options' => $custom_post_types_support_values,
				'classes' => ( count( $custom_post_types_support_values ) == 0 ) ? 'hidden' : '',
				'std' => array(),
			),
		),
	),
	'layoutoptions' => array(
		'title' => __( 'Layout Options', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/layout.png',
		'fields' => array(
			'canvas_layout' => array(
				'title' => __( 'Site Canvas Layout', 'wlgx' ),
				'type' => 'imgradio',
				'options' => array(
					'wide' => 'framework/admin/img/usof/canvas-wide.png',
					'boxed' => 'framework/admin/img/usof/canvas-boxed.png',
				),
				'std' => 'wide',
			),
			'color_body_bg' => array(
				'type' => 'color',
				'title' => __( 'Body Background Color', 'wlgx' ),
				'std' => '#eeeeee',
				'show_if' => array( 'canvas_layout', '=', 'boxed' ),
			),
			'body_bg_image' => array(
				'title' => __( 'Body Background Image', 'wlgx' ),
				'type' => 'upload',
				'show_if' => array( 'canvas_layout', '=', 'boxed' ),
			),
			'wrapper_body_bg_start' => array(
				'type' => 'wrapper_start',
				'show_if' => array(
					array( 'canvas_layout', '=', 'boxed' ),
					'and',
					array( 'body_bg_image', '!=', '' ),
				),
			),
			'body_bg_image_repeat' => array(
				'title' => __( 'Background Image Repeat', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'repeat' => __( 'Repeat', 'wlgx' ),
					'repeat-x' => __( 'Repeat Horizontally', 'wlgx' ),
					'repeat-y' => __( 'Repeat Vertically', 'wlgx' ),
					'no-repeat' => __( 'Do Not Repeat', 'wlgx' ),
				),
				'std' => 'repeat',
				'classes' => 'cols_2 title_top',
			),
			'body_bg_image_position' => array(
				'title' => __( 'Background Image Position', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'top left' => __( 'Top Left', 'wlgx' ),
					'top center' => __( 'Top Center', 'wlgx' ),
					'top right' => __( 'Top Right', 'wlgx' ),
					'center left' => __( 'Center Left', 'wlgx' ),
					'center center' => __( 'Center Center', 'wlgx' ),
					'center right' => __( 'Center Right', 'wlgx' ),
					'bottom left' => __( 'Bottom Left', 'wlgx' ),
					'bottom center' => __( 'Bottom Center', 'wlgx' ),
					'bottom right' => __( 'Bottom Right', 'wlgx' ),
				),
				'std' => 'top_center',
				'classes' => 'cols_2 title_top',
			),
			'body_bg_image_attachment' => array(
				'title' => __( 'Background Image Attachment', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'scroll' => __( 'Scroll', 'wlgx' ),
					'fixed' => __( 'Fixed', 'wlgx' ),
				),
				'std' => 'scroll',
				'classes' => 'cols_2 title_top',
			),
			'body_bg_image_size' => array(
				'title' => __( 'Background Image Size', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'cover' => __( 'Cover - Image will cover the whole area', 'wlgx' ),
					'contain' => __( 'Contain - Image will fit inside the area', 'wlgx' ),
					'initial' => __( 'Initial', 'wlgx' ),
				),
				'std' => 'cover',
				'classes' => 'cols_2 title_top',
			),
			'wrapper_body_bg_end' => array(
				'type' => 'wrapper_end',
			),
			'site_canvas_width' => array(
				'title' => __( 'Site Canvas Width', 'wlgx' ),
				'type' => 'slider',
				'min' => 1000,
				'max' => 1700,
				'step' => 10,
				'std' => 1300,
				'postfix' => 'px',
				'show_if' => array( 'canvas_layout', '=', 'boxed' ),
			),
			'site_content_width' => array(
				'title' => __( 'Site Content Width', 'wlgx' ),
				'type' => 'slider',
				'min' => 900,
				'max' => 1600,
				'step' => 10,
				'std' => 1140,
				'postfix' => 'px',
			),
			'columns_stacking_width' => array(
				'title' => __( 'Columns Stacking Width', 'wlgx' ),
				'description' => __( 'When screen width is less than this value, all columns within a row will become a single column.', 'wlgx' ),
				'type' => 'slider',
				'min' => 767,
				'max' => 1024,
				'std' => 767,
				'postfix' => 'px',
			)
		),
	),
	'styling' => array(
		'title' => __( 'Styling', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/style.png',
		'fields' => array(
			'color_style' => array(
				'title' => __( 'Choose Website Color Scheme', 'wlgx' ),
				'type' => 'style_scheme',
			),
			// Parent wrapper for all color groups
			'change_colors_start' => array(
				'type' => 'wrapper_start',
			),
			'change_header_colors_start' => array(
				'title' => __( 'Header colors', 'wlgx' ),
				'type' => 'wrapper_start',
				'classes' => 'type_toggle',
			),
			'color_header_middle_bg' => array(
				'type' => 'color',
				'text' => __( 'Main Area Background Color', 'wlgx' ),
			),
			'color_header_middle_text' => array(
				'type' => 'color',
				'text' => __( 'Main Area Menu Text Color', 'wlgx' ),
			),
			'color_header_middle_text_hover' => array(
				'type' => 'color',
				'text' => __( 'Main Area Menu Text Hover Color', 'wlgx' ),
			),
			'color_header_search_bg' => array(
				'type' => 'color',
				'text' => __( 'Search Field Background Color', 'wlgx' ),
			),
			'color_header_search_text' => array(
				'type' => 'color',
				'text' => __( 'Search Field Text Color', 'wlgx' ),
			),
			'change_header_colors_end' => array(
				'type' => 'wrapper_end',
			),
			'change_menu_colors_start' => array(
				'title' => __( 'Main Menu colors', 'wlgx' ),
				'type' => 'wrapper_start',
				'classes' => 'type_toggle',
			),
			'color_menu_active_bg' => array(
				'type' => 'color',
				'text' => __( 'Menu Active Background Color', 'wlgx' ),
			),
			'color_menu_active_text' => array(
				'type' => 'color',
				'text' => __( 'Menu Active Text Color', 'wlgx' ),
			),
			'color_menu_hover_bg' => array(
				'type' => 'color',
				'text' => __( 'Menu Hover Background Color', 'wlgx' ),
			),
			'color_menu_hover_text' => array(
				'type' => 'color',
				'text' => __( 'Menu Hover Text Color', 'wlgx' ),
			),
			'color_drop_bg' => array(
				'type' => 'color',
				'text' => __( 'Dropdown Background Color', 'wlgx' ),
			),
			'color_drop_text' => array(
				'type' => 'color',
				'text' => __( 'Dropdown Text Color', 'wlgx' ),
			),
			'color_drop_hover_bg' => array(
				'type' => 'color',
				'text' => __( 'Dropdown Hover Background Color', 'wlgx' ),
			),
			'color_drop_hover_text' => array(
				'type' => 'color',
				'text' => __( 'Dropdown Hover Text Color', 'wlgx' ),
			),
			'color_drop_active_bg' => array(
				'type' => 'color',
				'text' => __( 'Dropdown Active Background Color', 'wlgx' ),
			),
			'color_drop_active_text' => array(
				'type' => 'color',
				'text' => __( 'Dropdown Active Text Color', 'wlgx' ),
			),
			'color_menu_button_bg' => array(
				'type' => 'color',
				'text' => __( 'Menu Button Background Color', 'wlgx' ),
			),
			'color_menu_button_text' => array(
				'type' => 'color',
				'text' => __( 'Menu Button Text Color', 'wlgx' ),
			),
			'color_menu_button_hover_bg' => array(
				'type' => 'color',
				'text' => __( 'Menu Button Hover Background Color', 'wlgx' ),
			),
			'color_menu_button_hover_text' => array(
				'type' => 'color',
				'text' => __( 'Menu Button Hover Text Color', 'wlgx' ),
			),
			'change_menu_colors_end' => array(
				'type' => 'wrapper_end',
			),
			'change_content_colors_start' => array(
				'title' => __( 'Content colors', 'wlgx' ),
				'type' => 'wrapper_start',
				'classes' => 'type_toggle',
			),
			'color_content_bg' => array(
				'type' => 'color',
				'text' => __( 'Background Color', 'wlgx' ),
			),
			'color_content_bg_alt' => array(
				'type' => 'color',
				'text' => __( 'Alternate Background Color', 'wlgx' ),
			),
			'color_content_border' => array(
				'type' => 'color',
				'text' => __( 'Border Color', 'wlgx' ),
			),
			'color_content_heading' => array(
				'type' => 'color',
				'text' => __( 'Heading Color', 'wlgx' ),
			),
			'color_content_text' => array(
				'type' => 'color',
				'text' => __( 'Text Color', 'wlgx' ),
			),
			'color_content_link' => array(
				'type' => 'color',
				'text' => __( 'Link Color', 'wlgx' ),
			),
			'color_content_link_hover' => array(
				'type' => 'color',
				'text' => __( 'Link Hover Color', 'wlgx' ),
			),
			'color_content_primary' => array(
				'type' => 'color',
				'text' => __( 'Primary Color', 'wlgx' ),
			),
			'color_content_secondary' => array(
				'type' => 'color',
				'text' => __( 'Secondary Color', 'wlgx' ),
			),
			'color_content_faded' => array(
				'type' => 'color',
				'text' => __( 'Faded Elements Color', 'wlgx' ),
			),
			'change_content_colors_end' => array(
				'type' => 'wrapper_end',
			),
			'change_alt_content_colors_start' => array(
				'title' => __( 'Alternate Content colors', 'wlgx' ),
				'type' => 'wrapper_start',
				'classes' => 'type_toggle',
			),
			'color_alt_content_bg' => array(
				'type' => 'color',
				'text' => __( 'Background Color', 'wlgx' ),
			),
			'color_alt_content_bg_alt' => array(
				'type' => 'color',
				'text' => __( 'Alternate Background Color', 'wlgx' ),
			),
			'color_alt_content_border' => array(
				'type' => 'color',
				'text' => __( 'Border Color', 'wlgx' ),
			),
			'color_alt_content_heading' => array(
				'type' => 'color',
				'text' => __( 'Heading Color', 'wlgx' ),
			),
			'color_alt_content_text' => array(
				'type' => 'color',
				'text' => __( 'Text Color', 'wlgx' ),
			),
			'color_alt_content_link' => array(
				'type' => 'color',
				'text' => __( 'Link Color', 'wlgx' ),
			),
			'color_alt_content_link_hover' => array(
				'type' => 'color',
				'text' => __( 'Link Hover Color', 'wlgx' ),
			),
			'color_alt_content_primary' => array(
				'type' => 'color',
				'text' => __( 'Primary Color', 'wlgx' ),
			),
			'color_alt_content_secondary' => array(
				'type' => 'color',
				'text' => __( 'Secondary Color', 'wlgx' ),
			),
			'color_alt_content_faded' => array(
				'type' => 'color',
				'text' => __( 'Faded Elements Color', 'wlgx' ),
			),
			'change_alt_content_colors_end' => array(
				'type' => 'wrapper_end',
			),
			'change_subfooter_colors_start' => array(
				'title' => __( 'Top Footer colors', 'wlgx' ),
				'type' => 'wrapper_start',
				'classes' => 'type_toggle',
			),
			'color_subfooter_bg' => array(
				'type' => 'color',
				'text' => __( 'Background Color', 'wlgx' ),
			),
			'color_subfooter_bg_alt' => array(
				'type' => 'color',
				'text' => __( 'Alternate Background Color', 'wlgx' ),
			),
			'color_subfooter_border' => array(
				'type' => 'color',
				'text' => __( 'Border Color', 'wlgx' ),
			),
			'color_subfooter_heading' => array(
				'type' => 'color',
				'text' => __( 'Heading Color', 'wlgx' ),
			),
			'color_subfooter_text' => array(
				'type' => 'color',
				'text' => __( 'Text Color', 'wlgx' ),
			),
			'color_subfooter_link' => array(
				'type' => 'color',
				'text' => __( 'Link Color', 'wlgx' ),
			),
			'color_subfooter_link_hover' => array(
				'type' => 'color',
				'text' => __( 'Link Hover Color', 'wlgx' ),
			),
			'change_subfooter_colors_end' => array(
				'type' => 'wrapper_end',
			),
			'change_footer_colors_start' => array(
				'title' => __( 'Bottom Footer colors', 'wlgx' ),
				'type' => 'wrapper_start',
				'classes' => 'type_toggle',
			),
			'color_footer_bg' => array(
				'type' => 'color',
				'text' => __( 'Background Color', 'wlgx' ),
			),
			'color_footer_text' => array(
				'type' => 'color',
				'text' => __( 'Text Color', 'wlgx' ),
			),
			'color_footer_link' => array(
				'type' => 'color',
				'text' => __( 'Link Color', 'wlgx' ),
			),
			'color_footer_link_hover' => array(
				'type' => 'color',
				'text' => __( 'Link Hover Color', 'wlgx' ),
			),
			'change_footer_colors_end' => array(
				'type' => 'wrapper_end',
			),
			'change_colors_end' => array(
				'type' => 'wrapper_end',
			),
		),
	),
	'headeroptions' => array(
		'title' => __( 'Header Options', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/header.png',
		'fields' => array_merge(
			array(
				'header_options_layout' => array(
					'title' => __( 'Header Layout', 'wlgx' ),
					'type' => 'heading',
					'classes' => 'align_center with_separator',
				),
				'header_sticky' => array(
					'title' => __( 'Sticky Header', 'wlgx' ),
					'type' => 'checkboxes',
					'options' => array(
						'default' => __( 'On Desktops', 'wlgx' ),
						'tablets' => __( 'On Tablets', 'wlgx' ),
						'mobiles' => __( 'On Mobiles', 'wlgx' ),
					),
					'description' => __( 'Fix the header at the top of a page during scroll on all pages', 'wlgx' ),
					'std' => array( 'default', 'tablets', 'mobiles' ),
					'show_if' => array( 'header_layout', '!=', 'vertical_1' ),
				),
				'header_transparent' => array(
					'title' => __( 'Transparent Header', 'wlgx' ),
					'type' => 'switch',
					'text' => __( 'Make the header transparent at its initial position on all pages', 'wlgx' ),
					'std' => 0,
					'show_if' => array( 'header_layout', '!=', 'vertical_1' ),
				),
				'header_fullwidth' => array(
					'title' => __( 'Full Width Content', 'wlgx' ),
					'type' => 'switch',
					'text' => __( 'Stretch header content to the screen width', 'wlgx' ),
					'std' => 0,
					'show_if' => array( 'header_layout', '!=', 'vertical_1' ),
				),
				'header_top_height' => array(
					'title' => __( 'Top Area Height', 'wlgx' ),
					'type' => 'slider',
					'min' => 36,
					'max' => 300,
					'std' => 40,
					'postfix' => 'px',
					'show_if' => array( 'header_layout', '=', 'extended_1' ),
				),
				'header_top_sticky_height' => array(
					'title' => __( 'Top Sticky Area Height', 'wlgx' ),
					'type' => 'slider',
					'min' => 0,
					'max' => 300,
					'std' => 0,
					'postfix' => 'px',
					'show_if' => array(
						array( 'header_sticky', 'has', 'default' ),
						'and',
						array( 'header_layout', '=', 'extended_1' ),
					),
				),
				'header_middle_height' => array(
					'title' => __( 'Main Area Height', 'wlgx' ),
					'type' => 'slider',
					'min' => 50,
					'max' => 300,
					'std' => 100,
					'postfix' => 'px',
					'show_if' => array( 'header_layout', '!=', 'vertical_1' ),
				),
				'header_middle_sticky_height' => array(
					'title' => __( 'Main Sticky Area Height', 'wlgx' ),
					'type' => 'slider',
					'min' => 0,
					'max' => 300,
					'std' => 50,
					'postfix' => 'px',
					'show_if' => array(
						array( 'header_sticky', 'has', 'default' ),
						'and',
						array( 'header_layout', '!=', 'vertical_1' ),
					),
				),
				'header_bottom_height' => array(
					'title' => __( 'Bottom Area Height', 'wlgx' ),
					'type' => 'slider',
					'min' => 36,
					'max' => 300,
					'std' => 50,
					'postfix' => 'px',
					'show_if' => array( 'header_layout', 'in', array( 'extended_2', 'centered_1' ) ),
				),
				'header_bottom_sticky_height' => array(
					'title' => __( 'Bottom Sticky Area Height', 'wlgx' ),
					'type' => 'slider',
					'min' => 0,
					'max' => 300,
					'std' => 50,
					'postfix' => 'px',
					'show_if' => array(
						array( 'header_sticky', 'has', 'default' ),
						'and',
						array( 'header_layout', 'in', array( 'extended_2', 'centered_1' ) ),
					),
				),
				'header_main_width' => array(
					'title' => __( 'Header Width', 'wlgx' ),
					'type' => 'slider',
					'min' => 200,
					'max' => 400,
					'std' => 300,
					'postfix' => 'px',
					'show_if' => array( 'header_layout', '=', 'vertical_1' ),
				),
				'header_invert_logo_pos' => array(
					'title' => __( 'Inverted Logo Position', 'wlgx' ),
					'type' => 'switch',
					'text' => __( 'Place Logo to the right side of the Header', 'wlgx' ),
					'std' => 0,
					'show_if' => array( 'header_layout', 'in', array( 'simple_1', 'extended_1', 'extended_2' ) ),
				),
				'header_scroll_breakpoint' => array(
					'title' => __( 'Header Scroll Breakpoint', 'wlgx' ),
					'description' => __( 'This option sets scroll distance from the top of a page after which the sticky header will be shrunk', 'wlgx' ),
					'type' => 'slider',
					'min' => 1,
					'max' => 200,
					'std' => 100,
					'postfix' => 'px',
					'show_if' => array(
						array( 'header_sticky', 'has', 'default' ),
						'and',
						array( 'header_layout', '!=', 'vertical_1' ),
					),
				),
				'header_options_elements' => array(
					'title' => __( 'Header Elements', 'wlgx' ),
					'type' => 'heading',
					'classes' => 'align_center with_separator',
				),
				'header_search_show' => array(
					'type' => 'switch',
					'text' => __( 'Show Search Field', 'wlgx' ),
					'std' => 1,
					'classes' => 'title_top',
				),
				'wrapper_search_start' => array(
					'type' => 'wrapper_start',
					'show_if' => array( 'header_search_show', '=', TRUE ),
				),
				'header_search_layout' => array(
					'title' => __( 'Layout', 'wlgx' ),
					'type' => 'select',
					'options' => array(
						'simple' => __( 'Simple', 'wlgx' ),
						'modern' => __( 'Modern', 'wlgx' ),
						'fullwidth' => __( 'Full Width', 'wlgx' ),
						'fullscreen' => __( 'Full Screen', 'wlgx' ),
					),
					'std' => 'fullscreen',
				),
				'wrapper_search_end' => array(
					'type' => 'wrapper_end',
				),
				'header_contacts_show' => array(
					'type' => 'switch',
					'text' => __( 'Show Contacts', 'wlgx' ),
					'std' => 0,
					'show_if' => array( 'header_layout', 'not in', array( 'simple_1', 'centered_1' ) ),
					'classes' => 'title_top',
				),
				'wrapper_contacts_start' => array(
					'type' => 'wrapper_start',
					'show_if' => array(
						array( 'header_layout', 'not in', array( 'simple_1', 'centered_1' ) ),
						'and',
						array( 'header_contacts_show', '=', TRUE ),
					),
				),
				'header_contacts_phone' => array(
					'title' => __( 'Phone Number', 'wlgx' ),
					'type' => 'text',
					'classes' => 'cols_2 title_top',
				),
				'header_contacts_email' => array(
					'title' => __( 'Email', 'wlgx' ),
					'type' => 'text',
					'classes' => 'cols_2 title_top',
				),
				'header_contacts_custom_icon' => array(
					'title' => __( 'Custom Icon', 'wlgx' ),
					'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top desc_1',
				),
				'header_contacts_custom_text' => array(
					'title' => __( 'Custom Text', 'wlgx' ),
					'description' => sprintf( __( 'You can use HTML tags in this field (e.g. %s for adding links)', 'wlgx' ), '&lt;a href=""&gt;&lt;/a&gt;' ),
					'type' => 'text',
					'classes' => 'cols_2 title_top desc_1',
				),
				'wrapper_contacts_end' => array(
					'type' => 'wrapper_end',
				),
				'header_socials_show' => array(
					'type' => 'switch',
					'text' => __( 'Show Social Links', 'wlgx' ),
					'std' => 0,
					'show_if' => array( 'header_layout', 'not in', array( 'simple_1', 'centered_1' ) ),
					'classes' => 'title_top',
				),
				'wrapper_socials_start' => array(
					'type' => 'wrapper_start',
					'show_if' => array(
						array( 'header_layout', 'not in', array( 'simple_1', 'centered_1' ) ),
						'and',
						array( 'header_socials_show', '=', TRUE ),
					),
				),
			), $social_links_config, array(
				'header_socials_custom_url' => array(
					'title' => __( 'Custom Link', 'wlgx' ),
					'type' => 'text',
					'classes' => 'cols_3 title_top',
				),
				'header_socials_custom_icon' => array(
					'title' => __( 'Custom Link Icon', 'wlgx' ),
					'description' => sprintf( __( '%s or %s icon name', 'wlgx' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="https://material.io/icons/" target="_blank">Material</a>' ),
					'type' => 'text',
					'classes' => 'cols_3 title_top desc_1',
				),
				'header_socials_custom_color' => array(
					'type' => 'color',
					'title' => __( 'Custom Link Color', 'wlgx' ),
					'std' => '#1abc9c',
					'classes' => 'cols_3 title_top',
				),
				'wrapper_socials_end' => array(
					'type' => 'wrapper_end',
				),
				'header_language_show' => array(
					'type' => 'switch',
					'text' => __( 'Show Dropdown', 'wlgx' ),
					'std' => 0,
					'show_if' => array( 'header_layout', 'not in', array( 'simple_1', 'centered_1' ) ),
					'classes' => 'title_top',
				),
				'wrapper_lang_start' => array(
					'type' => 'wrapper_start',
					'show_if' => array(
						array( 'header_layout', 'not in', array( 'simple_1', 'centered_1' ) ),
						'and',
						array( 'header_language_show', '=', TRUE ),
					),
				),
				'header_language_source' => array(
					'title' => __( 'Source', 'wlgx' ),
					'type' => 'select',
					'options' => array(
						'own' => __( 'My own links', 'wlgx' ),
						'wpml' => 'WPML',
					),
					'std' => 'own',
				),
				'header_link_title' => array(
					'title' => __( 'Links Title', 'wlgx' ),
					'description' => __( 'This text will be shown as the first active item of the dropdown menu.', 'wlgx' ),
					'type' => 'text',
					'show_if' => array( 'header_language_source', '=', 'own' ),
				),
				'header_link_qty' => array(
					'title' => __( 'Links Quantity', 'wlgx' ),
					'type' => 'radio',
					'options' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
					),
					'std' => '2',
					'show_if' => array( 'header_language_source', '=', 'own' ),
				),
				'header_link_1_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array( 'header_language_source', '=', 'own' ),
				),
				'header_link_1_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array( 'header_language_source', '=', 'own' ),
				),
				'header_link_2_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 1 ),
					),
				),
				'header_link_2_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 1 ),
					),
				),
				'header_link_3_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 2 ),
					),
				),
				'header_link_3_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 2 ),
					),
				),
				'header_link_4_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 3 ),
					),
				),
				'header_link_4_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 3 ),
					),
				),
				'header_link_5_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 4 ),
					),
				),
				'header_link_5_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 4 ),
					),
				),
				'header_link_6_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 5 ),
					),
				),
				'header_link_6_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 5 ),
					),
				),
				'header_link_7_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 6 ),
					),
				),
				'header_link_7_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 6 ),
					),
				),
				'header_link_8_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 7 ),
					),
				),
				'header_link_8_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 7 ),
					),
				),
				'header_link_9_label' => array(
					'placeholder' => __( 'Link Label', 'wlgx' ),
					'type' => 'text',
					'std' => '',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 8 ),
					),
				),
				'header_link_9_url' => array(
					'placeholder' => __( 'Link URL', 'wlgx' ),
					'std' => '',
					'type' => 'text',
					'classes' => 'cols_2 title_top',
					'show_if' => array(
						array( 'header_language_source', '=', 'own' ),
						'and',
						array( 'header_link_qty', '>', 8 ),
					),
				),
				'wrapper_lang_end' => array(
					'type' => 'wrapper_end',
				),
			)
		),
	),
	'logooptions' => array(
		'title' => __( 'Logo Options', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/logo.png',
		'fields' => array(
			'logo_type' => array(
				'title' => __( 'Logo Type', 'wlgx' ),
				'type' => 'imgradio',
				'options' => array(
					'text' => 'framework/admin/img/usof/logo-text.png',
					'img' => 'framework/admin/img/usof/logo-img.png',
				),
				'std' => 'text',
			),
			'logo_text' => array(
				'title' => __( 'Logo Text', 'wlgx' ),
				'description' => __( 'Add text which will be shown as logo. Better keep it short.', 'wlgx' ),
				'type' => 'text',
				'std' => 'LOGO',
				'show_if' => array( 'logo_type', '=', 'text' ),
			),
			'logo_font_size' => array(
				'title' => __( 'Font Size', 'wlgx' ),
				'type' => 'slider',
				'min' => 12,
				'max' => 50,
				'std' => 26,
				'postfix' => 'px',
				'show_if' => array( 'logo_type', '=', 'text' ),
			),
			'logo_font_size_tablets' => array(
				'title' => __( 'Font Size on Tablets', 'wlgx' ),
				'description' => __( 'This option is enabled when screen width is less than 900px', 'wlgx' ),
				'type' => 'slider',
				'min' => 12,
				'max' => 50,
				'std' => 24,
				'postfix' => 'px',
				'show_if' => array( 'logo_type', '=', 'text' ),
			),
			'logo_font_size_mobiles' => array(
				'title' => __( 'Font Size on Mobiles', 'wlgx' ),
				'description' => __( 'This option is enabled when screen width is less than 600px', 'wlgx' ),
				'type' => 'slider',
				'min' => 12,
				'max' => 50,
				'std' => 20,
				'postfix' => 'px',
				'show_if' => array( 'logo_type', '=', 'text' ),
			),
			'logo_image' => array(
				'title' => __( 'Logo Image', 'wlgx' ),
				'description' => __( 'Maximum recommended size is 300px of height (also for retina displays)', 'wlgx' ),
				'type' => 'upload',
				'extension' => 'png,jpg,jpeg,gif,svg',
				'show_if' => array( 'logo_type', '=', 'img' ),
			),
			'logo_height' => array(
				'title' => __( 'Height', 'wlgx' ),
				'type' => 'slider',
				'min' => 20,
				'max' => 300,
				'std' => 60,
				'postfix' => 'px',
				'show_if' => array( 'logo_type', '=', 'img' ),
			),
			'logo_height_sticky' => array(
				'title' => __( 'Height in the Sticky Header', 'wlgx' ),
				'type' => 'slider',
				'min' => 20,
				'max' => 300,
				'std' => 60,
				'postfix' => 'px',
				'show_if' => array(
					array( 'logo_type', '=', 'img' ),
					'and',
					array( 'header_layout', '!=', 'vertical_1' ),
				),
			),
			'logo_height_tablets' => array(
				'title' => __( 'Height on Tablets', 'wlgx' ),
				'description' => __( 'This option is enabled when screen width is less than 900px', 'wlgx' ),
				'type' => 'slider',
				'min' => 20,
				'max' => 300,
				'std' => 40,
				'postfix' => 'px',
				'show_if' => array( 'logo_type', '=', 'img' ),
			),
			'logo_height_mobiles' => array(
				'title' => __( 'Height on Mobiles', 'wlgx' ),
				'description' => __( 'This option is enabled when screen width is less than 600px', 'wlgx' ),
				'type' => 'slider',
				'min' => 20,
				'max' => 300,
				'std' => 30,
				'postfix' => 'px',
				'show_if' => array( 'logo_type', '=', 'img' ),
			),
			'logo_additional_images' => array(
				'title' => __( 'Additional Logo Images (optional)', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
				'show_if' => array( 'logo_type', '=', 'img' ),
			),
			'logo_image_tablets' => array(
				'title' => __( 'On Tablets', 'wlgx' ),
				'description' => __( 'This image will be shown instead of default when screen width is less than 900px', 'wlgx' ),
				'type' => 'upload',
				'extension' => 'png,jpg,jpeg,gif,svg',
				'show_if' => array( 'logo_type', '=', 'img' ),
			),
			'logo_image_mobiles' => array(
				'title' => __( 'On Mobiles', 'wlgx' ),
				'description' => __( 'This image will be shown instead of default when screen width is less than 600px', 'wlgx' ),
				'type' => 'upload',
				'extension' => 'png,jpg,jpeg,gif,svg',
				'show_if' => array( 'logo_type', '=', 'img' ),
			),
		),
	),
	'menuoptions' => array(
		'title' => __( 'Menu Options', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/menu.png',
		'fields' => array(
			'menu_fontsize' => array(
				'title' => __( 'Main Items Font Size', 'wlgx' ),
				'type' => 'slider',
				'min' => 12,
				'max' => 50,
				'std' => 16,
				'postfix' => 'px',
			),
			'menu_indents' => array(
				'title' => __( 'Main Items Indents', 'wlgx' ),
				'description' => __( 'This option sets the distance between the neighboring menu items.', 'wlgx' ),
				'type' => 'slider',
				'min' => 10,
				'max' => 100,
				'step' => 2,
				'std' => 40,
				'postfix' => 'px',
			),
			'menu_height' => array(
				'title' => __( 'Main Items Height', 'wlgx' ),
				'type' => 'switch',
				'text' => __( 'Stretch menu items to the full height of the header', 'wlgx' ),
				'std' => 0,
			),
			'menu_hover_effect' => array(
				'title' => __( 'Main Items Hover Effect', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'none' => __( 'Simple', 'wlgx' ),
					'underline' => __( 'Underline', 'wlgx' ),
				),
				'std' => 'underline',
			),
			'menu_dropdown_effect' => array(
				'title' => __( 'Dropdown Effect', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'opacity' => __( 'FadeIn', 'wlgx' ),
					'height' => __( 'FadeIn + SlideDown', 'wlgx' ),
					'mdesign' => __( 'Material Design Effect', 'wlgx' ),
				),
				'std' => 'height',
			),
			'menu_sub_fontsize' => array(
				'title' => __( 'Sub Items Font Size', 'wlgx' ),
				'type' => 'slider',
				'min' => 12,
				'max' => 50,
				'std' => 15,
				'postfix' => 'px',
			),
			'menu_mobile_width' => array(
				'title' => __( 'Mobile Menu at width', 'wlgx' ),
				'description' => __( 'When screen width is less than this value, main menu transforms to mobile-friendly layout.', 'wlgx' ),
				'type' => 'slider',
				'min' => 300,
				'max' => 2000,
				'std' => 900,
				'postfix' => 'px',
			),
			'menu_togglable_type' => array(
				'title' => __( 'Mobile Menu Behaviour', 'wlgx' ),
				'description' => __( 'When this option is disabled, sub items of mobile menu will open by click on arrows only.', 'wlgx' ),
				'type' => 'switch',
				'text' => __( 'Open sub items by click on menu titles', 'wlgx' ),
				'std' => 1,
			),
		),
	),
	'titlebaroptions' => array(
		'title' => __( 'Title Bar Options', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/titlebar.png',
		'fields' => array(
			'titlebar_heading' => array(
				'title' => __( 'Regular Pages', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'titlebar_content' => array(
				'title' => __( 'Title Bar Content', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'all' => __( 'Title, Description, Breadcrumbs', 'wlgx' ),
					'caption' => __( 'Title, Description', 'wlgx' ),
					'hide' => __( 'Hide Title Bar', 'wlgx' ),
				),
				'std' => 'all',
			),
			'titlebar_size' => array(
				'title' => __( 'Title Bar Size', 'wlgx' ),
				'type' => 'radio',
				'options' => array(
					'small' => __( 'Small', 'wlgx' ),
					'medium' => __( 'Medium', 'wlgx' ),
					'large' => __( 'Large', 'wlgx' ),
					'huge' => __( 'Huge', 'wlgx' ),
				),
				'std' => 'large',
			),
			'titlebar_color' => array(
				'title' => __( 'Title Bar Color Style', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'default' => __( 'Content colors', 'wlgx' ),
					'alternate' => __( 'Alternate Content colors', 'wlgx' ),
					'primary' => __( 'Primary bg & White text', 'wlgx' ),
					'secondary' => __( 'Secondary bg & White text', 'wlgx' ),
				),
				'std' => 'alternate',
			),
			'titlebar_casestudy_heading' => array(
				'title' => __( 'casestudy Items', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'titlebar_casestudy_content' => array(
				'title' => __( 'Title Bar Content', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'all' => __( 'Title, Description, Arrows', 'wlgx' ),
					'caption' => __( 'Title, Description', 'wlgx' ),
					'hide' => __( 'Hide Title Bar', 'wlgx' ),
				),
				'std' => 'all',
			),
			'titlebar_casestudy_size' => array(
				'title' => __( 'Title Bar Size', 'wlgx' ),
				'type' => 'radio',
				'options' => array(
					'small' => __( 'Small', 'wlgx' ),
					'medium' => __( 'Medium', 'wlgx' ),
					'large' => __( 'Large', 'wlgx' ),
					'huge' => __( 'Huge', 'wlgx' ),
				),
				'std' => 'large',
			),
			'titlebar_casestudy_color' => array(
				'title' => __( 'Title Bar Color Style', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'default' => __( 'Content colors', 'wlgx' ),
					'alternate' => __( 'Alternate Content colors', 'wlgx' ),
					'primary' => __( 'Primary bg & White text', 'wlgx' ),
					'secondary' => __( 'Secondary bg & White text', 'wlgx' ),
				),
				'std' => 'alternate',
			),
			'titlebar_archive_heading' => array(
				'title' => __( 'Archive, Search Results Pages', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'titlebar_archive_content' => array(
				'title' => __( 'Title Bar Content', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'all' => __( 'Title, Description, Breadcrumbs', 'wlgx' ),
					'caption' => __( 'Title, Description', 'wlgx' ),
					'hide' => __( 'Hide Title Bar', 'wlgx' ),
				),
				'std' => 'all',
			),
			'titlebar_archive_size' => array(
				'title' => __( 'Title Bar Size', 'wlgx' ),
				'type' => 'radio',
				'options' => array(
					'small' => __( 'Small', 'wlgx' ),
					'medium' => __( 'Medium', 'wlgx' ),
					'large' => __( 'Large', 'wlgx' ),
					'huge' => __( 'Huge', 'wlgx' ),
				),
				'std' => 'medium',
			),
			'titlebar_archive_color' => array(
				'title' => __( 'Title Bar Color Style', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'default' => __( 'Content colors', 'wlgx' ),
					'alternate' => __( 'Alternate Content colors', 'wlgx' ),
					'primary' => __( 'Primary bg & White text', 'wlgx' ),
					'secondary' => __( 'Secondary bg & White text', 'wlgx' ),
				),
				'std' => 'alternate',
			),
			'titlebar_post_heading' => array(
				'title' => __( 'Blog Posts', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'titlebar_post_content' => array(
				'title' => __( 'Title Bar Content', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'all' => __( 'Title, Description, Breadcrumbs', 'wlgx' ),
					'caption' => __( 'Title, Description', 'wlgx' ),
					'hide' => __( 'Hide Title Bar', 'wlgx' ),
				),
				'std' => 'hide',
			),
			'titlebar_post_title' => array(
				'title' => __( 'Title Bar Title', 'wlgx' ),
				'type' => 'text',
				'std' => 'Blog',
				'show_if' => array( 'titlebar_post_content', '!=', 'hide' ),
			),
			'titlebar_post_size' => array(
				'title' => __( 'Title Bar Size', 'wlgx' ),
				'type' => 'radio',
				'options' => array(
					'small' => __( 'Small', 'wlgx' ),
					'medium' => __( 'Medium', 'wlgx' ),
					'large' => __( 'Large', 'wlgx' ),
					'huge' => __( 'Huge', 'wlgx' ),
				),
				'std' => 'medium',
			),
			'titlebar_post_color' => array(
				'title' => __( 'Title Bar Color Style', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'default' => __( 'Content colors', 'wlgx' ),
					'alternate' => __( 'Alternate Content colors', 'wlgx' ),
					'primary' => __( 'Primary bg & White text', 'wlgx' ),
					'secondary' => __( 'Secondary bg & White text', 'wlgx' ),
				),
				'std' => 'alternate',
			),
		),
	),
	'footeroptions' => array(
		'title' => __( 'Footer Options', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/footer.png',
		'fields' => array(
			'footer_layout' => array(
				'title' => __( 'Footer Layout', 'wlgx' ),
				'type' => 'radio',
				'options' => array(
					'compact' => __( 'Compact', 'wlgx' ),
					'modern' => __( 'Modern', 'wlgx' ),
				),
				'std' => 'compact',
			),
			'footer_show_top' => array(
				'title' => __( 'Top Footer area', 'wlgx' ),
				'type' => 'switch',
				'text' => __( 'Show widgets area', 'wlgx' ),
				'std' => 0,
			),
			'footer_show_bottom' => array(
				'title' => __( 'Bottom Footer area', 'wlgx' ),
				'type' => 'switch',
				'text' => __( 'Show copyright and menu area', 'wlgx' ),
				'std' => 1,
			),
			'footer_copyright' => array(
				'title' => __( 'Copyright Text', 'wlgx' ),
				'type' => 'text',
				'std' => 'Any text goes here',
				'show_if' => array( 'footer_show_bottom', '=', TRUE ),
			),
		),
	),
	'typography' => array(
		'title' => __( 'Typography', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/font.png',
		'fields' => array(
			'body_font_options' => array(
				'title' => __( 'Regular Text', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'body_font_family' => array(
				'type' => 'font',
				'preview' => array(
					'text' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum tellus purus condimentum pulvinar. Duis cursus bibendum dui, eget iaculis urna pharetra. Aenean semper nec ipsum vitae mollis.', 'wlgx' ),
					'size' => '15px',
				),
				'std' => 'Open Sans|400,700',
			),
			'body_fontsize_start' => array(
				'type' => 'wrapper_start',
			),
			'body_fontsize' => array(
				'description' => __( 'Font Size', 'wlgx' ),
				'type' => 'text',
				'std' => '14',
				'classes' => 'for_font cols_2',
			),
			'body_fontsize_mobile' => array(
				'description' => __( 'Font Size on Mobiles', 'wlgx' ),
				'type' => 'text',
				'std' => '16',
				'classes' => 'for_font cols_2',
			),
			'body_fontsize_end' => array(
				'type' => 'wrapper_end',
			),
			'body_lineheight_start' => array(
				'type' => 'wrapper_start',
			),
			'body_lineheight' => array(
				'description' => __( 'Line height', 'wlgx' ),
				'type' => 'text',
				'std' => '24',
				'classes' => 'for_font cols_2',
			),
			'body_lineheight_mobile' => array(
				'description' => __( 'Line height on Mobiles', 'wlgx' ),
				'type' => 'text',
				'std' => '28',
				'classes' => 'for_font cols_2',
			),
			'body_lineheight_end' => array(
				'type' => 'wrapper_end',
			),
			'headings_options' => array(
				'title' => __( 'Headings', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'heading_font_family' => array(
				'type' => 'font',
				'preview' => array(
					'text' => __( 'Heading Font Preview', 'wlgx' ),
					'size' => '30px',
				),
				'std' => 'Open Sans|400,700',
			),
			'h1_start' => array(
				'title' => sprintf( __( 'Heading %d', 'wlgx' ), 1 ),
				'type' => 'wrapper_start',
			),
			'h1_fontsize' => array(
				'description' => __( 'Font Size', 'wlgx' ),
				'type' => 'text',
				'std' => '40',
				'classes' => 'for_font',
			),
			'h1_fontsize_mobile' => array(
				'description' => __( 'Font Size on Mobiles', 'wlgx' ),
				'type' => 'text',
				'std' => '30',
				'classes' => 'for_font',
			),
			'h1_letterspacing' => array(
				'description' => __( 'Letter Spacing', 'wlgx' ),
				'type' => 'text',
				'std' => '0',
				'classes' => 'for_font',
			),
			'h1_transform' => array(
				'type' => 'checkboxes',
				'options' => array(
					'uppercase' => __( 'Uppercase', 'wlgx' ),
				),
				'std' => '',
				'classes' => 'for_font',
			),
			'h1_end' => array(
				'type' => 'wrapper_end',
			),
			'h2_start' => array(
				'title' => sprintf( __( 'Heading %d', 'wlgx' ), 2 ),
				'type' => 'wrapper_start',
			),
			'h2_fontsize' => array(
				'description' => __( 'Font Size', 'wlgx' ),
				'type' => 'text',
				'std' => '34',
				'classes' => 'for_font',
			),
			'h2_fontsize_mobile' => array(
				'description' => __( 'Font Size on Mobiles', 'wlgx' ),
				'type' => 'text',
				'std' => '26',
				'classes' => 'for_font',
			),
			'h2_letterspacing' => array(
				'description' => __( 'Letter Spacing', 'wlgx' ),
				'type' => 'text',
				'std' => '0',
				'classes' => 'for_font',
			),
			'h2_transform' => array(
				'type' => 'checkboxes',
				'options' => array(
					'uppercase' => __( 'Uppercase', 'wlgx' ),
				),
				'std' => '',
				'classes' => 'for_font',
			),
			'h2_end' => array(
				'type' => 'wrapper_end',
			),
			'h3_start' => array(
				'title' => sprintf( __( 'Heading %d', 'wlgx' ), 3 ),
				'type' => 'wrapper_start',
			),
			'h3_fontsize' => array(
				'description' => __( 'Font Size', 'wlgx' ),
				'type' => 'text',
				'std' => '28',
				'classes' => 'for_font',
			),
			'h3_fontsize_mobile' => array(
				'description' => __( 'Font Size on Mobiles', 'wlgx' ),
				'type' => 'text',
				'std' => '24',
				'classes' => 'for_font',
			),
			'h3_letterspacing' => array(
				'description' => __( 'Letter Spacing', 'wlgx' ),
				'type' => 'text',
				'std' => '0',
				'classes' => 'for_font',
			),
			'h3_transform' => array(
				'type' => 'checkboxes',
				'options' => array(
					'uppercase' => __( 'Uppercase', 'wlgx' ),
				),
				'std' => '',
				'classes' => 'for_font',
			),
			'h3_end' => array(
				'type' => 'wrapper_end',
			),
			'h4_start' => array(
				'title' => sprintf( __( 'Heading %d', 'wlgx' ), 4 ),
				'type' => 'wrapper_start',
			),
			'h4_fontsize' => array(
				'description' => __( 'Font Size', 'wlgx' ),
				'type' => 'text',
				'std' => '24',
				'classes' => 'for_font',
			),
			'h4_fontsize_mobile' => array(
				'description' => __( 'Font Size on Mobiles', 'wlgx' ),
				'type' => 'text',
				'std' => '22',
				'classes' => 'for_font',
			),
			'h4_letterspacing' => array(
				'description' => __( 'Letter Spacing', 'wlgx' ),
				'type' => 'text',
				'std' => '0',
				'classes' => 'for_font',
			),
			'h4_transform' => array(
				'type' => 'checkboxes',
				'options' => array(
					'uppercase' => __( 'Uppercase', 'wlgx' ),
				),
				'std' => '',
				'classes' => 'for_font',
			),
			'h4_end' => array(
				'type' => 'wrapper_end',
			),
			'h5_start' => array(
				'title' => sprintf( __( 'Heading %d', 'wlgx' ), 5 ),
				'type' => 'wrapper_start',
			),
			'h5_fontsize' => array(
				'description' => __( 'Font Size', 'wlgx' ),
				'type' => 'text',
				'std' => '20',
				'classes' => 'for_font',
			),
			'h5_fontsize_mobile' => array(
				'description' => __( 'Font Size on Mobiles', 'wlgx' ),
				'type' => 'text',
				'std' => '20',
				'classes' => 'for_font',
			),
			'h5_letterspacing' => array(
				'description' => __( 'Letter Spacing', 'wlgx' ),
				'type' => 'text',
				'std' => '0',
				'classes' => 'for_font',
			),
			'h5_transform' => array(
				'type' => 'checkboxes',
				'options' => array(
					'uppercase' => __( 'Uppercase', 'wlgx' ),
				),
				'std' => '',
				'classes' => 'for_font',
			),
			'h5_end' => array(
				'type' => 'wrapper_end',
			),
			'h6_start' => array(
				'title' => sprintf( __( 'Heading %d', 'wlgx' ), 6 ),
				'type' => 'wrapper_start',
			),
			'h6_fontsize' => array(
				'description' => __( 'Font Size', 'wlgx' ),
				'type' => 'text',
				'std' => '18',
				'classes' => 'for_font',
			),
			'h6_fontsize_mobile' => array(
				'description' => __( 'Font Size on Mobiles', 'wlgx' ),
				'type' => 'text',
				'std' => '18',
				'classes' => 'for_font',
			),
			'h6_letterspacing' => array(
				'description' => __( 'Letter Spacing', 'wlgx' ),
				'type' => 'text',
				'std' => '0',
				'classes' => 'for_font',
			),
			'h6_transform' => array(
				'type' => 'checkboxes',
				'options' => array(
					'uppercase' => __( 'Uppercase', 'wlgx' ),
				),
				'std' => '',
				'classes' => 'for_font',
			),
			'h6_end' => array(
				'type' => 'wrapper_end',
			),
			'menu_font_options' => array(
				'title' => __( 'Main Menu Text', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'menu_font_family' => array(
				'type' => 'font',
				'preview' => array(
					'text' => __( 'Home About Services casestudy Contacts', 'wlgx' ),
					'size' => '16px',
				),
				'std' => 'Open Sans|400,700',
			),
			'subset_option' => array(
				'title' => __( 'Subset', 'wlgx' ),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'font_subset' => array(
				'description' => __( 'Select characters subset for Google fonts. <strong>Please note: some fonts does not support particular subsets!</strong>', 'wlgx' ),
				'type' => 'select',
				'options' => array(
					'arabic' => 'arabic',
					'cyrillic' => 'cyrillic',
					'cyrillic-ext' => 'cyrillic-ext',
					'greek' => 'greek',
					'greek-ext' => 'greek-ext',
					'hebrew' => 'hebrew',
					'khmer' => 'khmer',
					'latin' => 'latin',
					'latin-ext' => 'latin-ext',
					'vietnamese' => 'vietnamese',
				),
				'std' => 'latin',
				'classes' => 'title_top desc_1',
			),
		),
	),
	'buttonoptions' => array(
		'title' => __( 'Buttons Options', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/buttons.png',
		'fields' => array(
			'button_preview' => array(
				'type' => 'button_preview',
				'classes' => 'title_top',
			),
			'button_text_style' => array(
				'title' => __( 'Text Styles', 'wlgx' ),
				'type' => 'checkboxes',
				'options' => array(
					'bold' => wlgx_translate_with_external_domain( 'Bold' ),
					'uppercase' => __( 'Uppercase', 'wlgx' ),
				),
				'std' => array( 'bold', 'uppercase' ),
			),
			'button_font' => array(
				'title' => __( 'Use Font from', 'wlgx' ),
				'type' => 'radio',
				'options' => array(
					'body' => __( 'Regular Text', 'wlgx' ),
					'heading' => __( 'Headings', 'wlgx' ),
					'menu' => __( 'Main Menu Text', 'wlgx' ),
				),
				'std' => 'body',
			),
			'button_fontsize' => array(
				'title' => __( 'Default Font Size', 'wlgx' ),
				'type' => 'slider',
				'min' => 10,
				'max' => 20,
				'std' => 15,
				'postfix' => 'px',
			),
			'button_letterspacing' => array(
				'title' => __( 'Letter Spacing', 'wlgx' ),
				'type' => 'slider',
				'min' => - 3,
				'max' => 5,
				'std' => 0,
				'postfix' => 'px',
			),
			'button_height' => array(
				'title' => __( 'Relative Height', 'wlgx' ),
				'type' => 'slider',
				'min' => 1.5,
				'max' => 5.0,
				'step' => 0.1,
				'std' => 2.8,
				'postfix' => 'em',
			),
			'button_width' => array(
				'title' => __( 'Relative Width', 'wlgx' ),
				'type' => 'slider',
				'min' => 0.5,
				'max' => 5.0,
				'step' => 0.1,
				'std' => 1.8,
				'postfix' => 'em',
			),
			'button_border_radius' => array(
				'title' => __( 'Corners Radius', 'wlgx' ),
				'type' => 'slider',
				'min' => 0.0,
				'max' => 2.5,
				'step' => 0.1,
				'std' => 0.3,
				'postfix' => 'em',
			),
		),
	),
	'casestudyoptions' => array(
		'title' => __( 'casestudy Options', 'wlgx' ),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/casestudy.png',
		'fields' => array(
			'casestudy_sidebar' => array(
				'title' => __( 'Sidebar Position on casestudy Items', 'wlgx' ),
				'type' => 'radio',
				'options' => array(
					'left' => __( 'Left', 'wlgx' ),
					'none' => __( 'No Sidebar', 'wlgx' ),
					'right' => __( 'Right', 'wlgx' ),
				),
				'std' => 'none',
			),
			'casestudy_sidebar_id' => array(
				'title' => __( 'Sidebar Content on casestudy Items', 'wlgx' ),
				'description' => sprintf( __( 'This dropdown list shows the Widget Areas, which you can populate on the %sWidgets%s page.', 'wlgx' ), '<a target="_blank" href="' . admin_url() . 'widgets.php">', '</a>' ),
				'type' => 'select',
				'options' => $sidebars_options,
				'std' => 'default_sidebar',
				'classes' => 'desc_1',
			),
			'casestudy_comments' => array(
				'title' => __( 'casestudy Comments', 'wlgx' ),
				'type' => 'switch',
				'text' => __( 'Enable comments for casestudy Item pages', 'wlgx' ),
				'std' => 0,
			),
			'casestudy_sided_nav' => array(
				'title' => __( 'Sided Navigation', 'wlgx' ),
				'type' => 'switch',
				'text' => __( 'Show previous/next casestudy items on sides of the screen', 'wlgx' ),
				'std' => 1,
			),
			'casestudy_prevnext_category' => array(
				'title' => __( 'Navigation Within a Category', 'wlgx' ),
				'type' => 'switch',
				'text' => __( 'Enable previous/next casestudy item navigation within a category', 'wlgx' ),
				'std' => 0,
			),
			'casestudy_slug' => array(
				'title' => __( 'casestudy Slug', 'wlgx' ),
				'type' => 'text',
				'std' => 'casestudy',
			),
			'casestudy_category_slug' => array(
				'title' => __( 'casestudy Category Slug', 'wlgx' ),
				'type' => 'text',
				'std' => 'casestudy_category',
			),
		),
	)
	/*,
	'blogoptions' => array(
		'title' => __( 'Blog Options', 'wlgx'),
		'icon' => $wlgx_template_directory_uri . '/framework/admin/img/usof/blog.png',
		'fields' => array(
			'blog_options_post_pages' => array(
				'title' => __( 'Blog Posts', 'wlgx'),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'post_sidebar' => array(
				'title' => __( 'Sidebar Position', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'left' => __( 'Left', 'wlgx'),
					'none' => __( 'No Sidebar', 'wlgx'),
					'right' => __( 'Right', 'wlgx'),
				),
				'std' => 'right',
			),
			'post_preview_layout' => array(
				'title' => __( 'Featured Image Layout', 'wlgx'),
				'description' => __( 'This option sets Featured Image Layout for all post pages. You can set it for a separate certain post when editing it.', 'wlgx'),
				'type' => 'select',
				'options' => array(
					'basic' => __( 'Standard', 'wlgx'),
					'modern' => __( 'Modern', 'wlgx'),
					'trendy' => __( 'Trendy', 'wlgx'),
					'none' => __( 'No Preview', 'wlgx'),
				),
				'std' => 'basic',
			),
			'post_meta' => array(
				'title' => __( 'Post Elements', 'wlgx'),
				'type' => 'checkboxes',
				'options' => array(
					'date' => __( 'Date', 'wlgx'),
					'author' => __( 'Author', 'wlgx'),
					'categories' => __( 'Categories', 'wlgx'),
					'comments' => __( 'Comments number', 'wlgx'),
					'tags' => __( 'Tags', 'wlgx'),
				),
				'std' => array( 'date', 'author', 'categories', 'comments', 'tags' ),
			),
			'post_sharing' => array(
				'title' => __( 'Sharing Buttons', 'wlgx'),
				'type' => 'switch',
				'text' => __( 'Show block with sharing buttons', 'wlgx'),
				'std' => 0,
			),
			'post_sharing_type' => array(
				'title' => __( 'Buttons Type', 'wlgx'),
				'type' => 'select',
				'options' => array(
					'simple' => __( 'Simple', 'wlgx'),
					'solid' => __( 'Solid', 'wlgx'),
					'outlined' => __( 'Outlined', 'wlgx'),
				),
				'std' => 'simple',
				'show_if' => array( 'post_sharing', '=', TRUE ),
			),
			'post_sharing_providers' => array(
				'title' => '',
				'type' => 'checkboxes',
				'options' => array(
					'email' => 'Email',
					'facebook' => 'Facebook',
					'twitter' => 'Twitter',
					'gplus' => 'Google+',
					'linkedin' => 'LinkedIn',
					'pinterest' => 'Pinterest',
					'vk' => 'Vkontakte',
				),
				'std' => array( 'facebook', 'twitter', 'gplus' ),
				'show_if' => array( 'post_sharing', '=', TRUE ),
			),
			'post_author_box' => array(
				'title' => __( 'Author Box', 'wlgx'),
				'type' => 'switch',
				'text' => __( 'Show box with information about post author', 'wlgx'),
				'std' => 0,
			),
			'post_nav' => array(
				'title' => __( 'Prev/Next Navigation', 'wlgx'),
				'type' => 'switch',
				'text' => __( 'Show links to previous/next posts', 'wlgx'),
				'std' => 0,
			),
			'post_nav_category' => array(
				'title' => __( 'Navigation Within a Category', 'wlgx'),
				'type' => 'switch',
				'text' => __( 'Enable previous/next posts navigation within a category', 'wlgx'),
				'std' => 0,
				'show_if' => array( 'post_nav', '=', TRUE ),
			),
			'post_related' => array(
				'title' => __( 'Related Posts', 'wlgx'),
				'type' => 'switch',
				'text' => __( 'Show list of posts with same tags on every blog post', 'wlgx'),
				'std' => 1,
			),
			'post_related_layout' => array(
				'title' => __( 'Related Posts Layout', 'wlgx'),
				'type' => 'select',
				'show_if' => array( 'post_related', '=', TRUE ),
				'options' => array(
					'compact' => __( 'Compact (without preview)', 'wlgx'),
					'related' => __( 'Standard (3 columns with preview)', 'wlgx'),
				),
				'std' => 'compact',
			),
			'blog_options_front_page' => array(
				'title' => __( 'Blog Home Page', 'wlgx'),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'blog_sidebar' => array(
				'title' => __( 'Sidebar Position', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'left' => __( 'Left', 'wlgx'),
					'none' => __( 'No Sidebar', 'wlgx'),
					'right' => __( 'Right', 'wlgx'),
				),
				'std' => 'right',
			),
			'blog_layout' => array(
				'title' => __( 'Layout', 'wlgx'),
				'type' => 'select',
				'options' => array(
					'classic' => __( 'Classic', 'wlgx'),
					'flat' => __( 'Flat', 'wlgx'),
					'tiles' => __( 'Tiles', 'wlgx'),
					'cards' => __( 'Cards', 'wlgx'),
					'smallcircle' => __( 'Small Circle Image', 'wlgx'),
					'smallsquare' => __( 'Small Square Image', 'wlgx'),
					'latest' => __( 'Latest Posts', 'wlgx'),
					'compact' => __( 'Compact', 'wlgx'),
				),
				'std' => 'classic',
			),
			'blog_masonry' => array(
				'type' => 'switch',
				'text' => __( 'Enable Masonry layout mode', 'wlgx'),
				'std' => 0,
				'classes' => 'for_above',
				'show_if' => array( 'blog_layout', 'in', array( 'classic', 'flat', 'tiles', 'cards' ) ),
			),
			'blog_cols' => array(
				'title' => __( 'Posts Columns', 'wlgx'),
				'std' => '1',
				'type' => 'radio',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			),
			'blog_content_type' => array(
				'title' => __( 'Posts Content', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'excerpt' => __( 'Excerpt', 'wlgx'),
					'content' => __( 'Full Content', 'wlgx'),
					'none' => __( 'None', 'wlgx'),
				),
				'std' => 'excerpt',
			),
			'blog_meta' => array(
				'title' => __( 'Posts Elements', 'wlgx'),
				'type' => 'checkboxes',
				'options' => array(
					'date' => __( 'Date', 'wlgx'),
					'author' => __( 'Author', 'wlgx'),
					'categories' => __( 'Categories', 'wlgx'),
					'comments' => __( 'Comments number', 'wlgx'),
					'tags' => __( 'Tags', 'wlgx'),
					'read_more' => __( 'Read More button', 'wlgx'),
				),
				'std' => array( 'date', 'author', 'categories', 'comments', 'tags', 'read_more' ),
			),
			'blog_pagination' => array(
				'title' => __( 'Pagination', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'regular' => __( 'Regular pagination', 'wlgx'),
					'ajax' => __( 'Load More Button', 'wlgx'),
					'infinite' => __( 'Infinite Scroll', 'wlgx'),
				),
				'std' => 'regular',
			),
			'blog_options_archive' => array(
				'title' => __( 'Archive Pages', 'wlgx'),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'archive_sidebar' => array(
				'title' => __( 'Sidebar Position', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'left' => __( 'Left', 'wlgx'),
					'none' => __( 'No Sidebar', 'wlgx'),
					'right' => __( 'Right', 'wlgx'),
				),
				'std' => 'right',
			),
			'archive_layout' => array(
				'title' => __( 'Layout', 'wlgx'),
				'type' => 'select',
				'options' => array(
					'classic' => __( 'Classic', 'wlgx'),
					'flat' => __( 'Flat', 'wlgx'),
					'tiles' => __( 'Tiles', 'wlgx'),
					'cards' => __( 'Cards', 'wlgx'),
					'smallcircle' => __( 'Small Circle Image', 'wlgx'),
					'smallsquare' => __( 'Small Square Image', 'wlgx'),
					'latest' => __( 'Latest Posts', 'wlgx'),
					'compact' => __( 'Compact', 'wlgx'),
				),
				'std' => 'smallcircle',
			),
			'archive_masonry' => array(
				'type' => 'switch',
				'text' => __( 'Enable Masonry layout mode', 'wlgx'),
				'std' => 0,
				'classes' => 'for_above',
				'show_if' => array( 'archive_layout', 'in', array( 'classic', 'flat', 'tiles', 'cards' ) ),
			),
			'archive_cols' => array(
				'title' => __( 'Posts Columns', 'wlgx'),
				'std' => '1',
				'type' => 'radio',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			),
			'archive_content_type' => array(
				'title' => __( 'Posts Content', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'excerpt' => __( 'Excerpt', 'wlgx'),
					'content' => __( 'Full Content', 'wlgx'),
					'none' => __( 'None', 'wlgx'),
				),
				'std' => 'excerpt',
			),
			'archive_meta' => array(
				'title' => __( 'Posts Elements', 'wlgx'),
				'type' => 'checkboxes',
				'options' => array(
					'date' => __( 'Date', 'wlgx'),
					'author' => __( 'Author', 'wlgx'),
					'categories' => __( 'Categories', 'wlgx'),
					'comments' => __( 'Comments number', 'wlgx'),
					'tags' => __( 'Tags', 'wlgx'),
					'read_more' => __( 'Read More button', 'wlgx'),
				),
				'std' => array( 'date', 'author', 'comments', 'tags' ),
			),
			'archive_pagination' => array(
				'title' => __( 'Pagination', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'regular' => __( 'Regular pagination', 'wlgx'),
					'ajax' => __( 'Load More Button', 'wlgx'),
					'infinite' => __( 'Infinite Scroll', 'wlgx'),
				),
				'std' => 'regular',
			),
			'blog_options_search_results' => array(
				'title' => __( 'Search Results Page', 'wlgx'),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'search_sidebar' => array(
				'title' => __( 'Sidebar Position', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'left' => __( 'Left', 'wlgx'),
					'none' => __( 'No Sidebar', 'wlgx'),
					'right' => __( 'Right', 'wlgx'),
				),
				'std' => 'right',
			),
			'search_layout' => array(
				'title' => __( 'Layout', 'wlgx'),
				'type' => 'select',
				'options' => array(
					'classic' => __( 'Classic', 'wlgx'),
					'flat' => __( 'Flat', 'wlgx'),
					'tiles' => __( 'Tiles', 'wlgx'),
					'cards' => __( 'Cards', 'wlgx'),
					'smallcircle' => __( 'Small Circle Image', 'wlgx'),
					'smallsquare' => __( 'Small Square Image', 'wlgx'),
					'latest' => __( 'Latest Posts', 'wlgx'),
					'compact' => __( 'Compact', 'wlgx'),
				),
				'std' => 'compact',
			),
			'search_masonry' => array(
				'type' => 'switch',
				'text' => __( 'Enable Masonry layout mode', 'wlgx'),
				'std' => 0,
				'classes' => 'for_above',
				'show_if' => array( 'search_layout', 'in', array( 'classic', 'flat', 'tiles', 'cards' ) ),
			),
			'search_cols' => array(
				'title' => __( 'Posts Columns', 'wlgx'),
				'std' => '1',
				'type' => 'radio',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			),
			'search_content_type' => array(
				'title' => __( 'Posts Content', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'excerpt' => __( 'Excerpt', 'wlgx'),
					'content' => __( 'Full Content', 'wlgx'),
					'none' => __( 'None', 'wlgx'),
				),
				'std' => 'excerpt',
			),
			'search_meta' => array(
				'title' => __( 'Posts Elements', 'wlgx'),
				'type' => 'checkboxes',
				'options' => array(
					'date' => __( 'Date', 'wlgx'),
					'author' => __( 'Author', 'wlgx'),
					'categories' => __( 'Categories', 'wlgx'),
					'comments' => __( 'Comments number', 'wlgx'),
					'tags' => __( 'Tags', 'wlgx'),
					'read_more' => __( 'Read More button', 'wlgx'),
				),
				'std' => array( 'date' ),
			),
			'search_pagination' => array(
				'title' => __( 'Pagination', 'wlgx'),
				'type' => 'radio',
				'options' => array(
					'regular' => __( 'Regular pagination', 'wlgx'),
					'ajax' => __( 'Load More Button', 'wlgx'),
					'infinite' => __( 'Infinite Scroll', 'wlgx'),
				),
				'std' => 'regular',
			),
			'blog_options_more' => array(
				'title' => __( 'More Options', 'wlgx'),
				'type' => 'heading',
				'classes' => 'align_center with_separator',
			),
			'excerpt_length' => array(
				'title' => __( 'Excerpt Length', 'wlgx'),
				'description' => __( 'This option sets amount of words in the Excerpt. To show all the words, leave this field blank.', 'wlgx'),
				'type' => 'text',
				'std' => '55',
			),
			'blog_img_size_start' => array(
				'title' => __( 'Blog Images Size', 'wlgx'),
				'type' => 'wrapper_start',
			),
			'blog_img_width' => array(
				'description' => 'X',
				'type' => 'text',
				'std' => '600',
				'classes' => 'for_font',
			),
			'blog_img_height' => array(
				'description' => 'px',
				'type' => 'text',
				'std' => '400',
				'classes' => 'for_font',
			),
			'blog_img_size_end' => array(
				'type' => 'wrapper_end',
			),
			'blog_img_size_info' => array(
				'description' => sprintf( __( 'Set custom size for images which are used as posts previews in blog with Classic, Flat, Cards, Tiles layouts and in Related Posts. After changing the values you need to %sregenerate thumbnails%s.', 'wlgx'), '<a target="_blank" href="' . admin_url() . 'plugin-install.php?tab=search&s=Regenerate+Thumbnails">', '</a>' ),
				'type' => 'message',
				'classes' => 'for_img_size',
			),
		),
	) */
);
