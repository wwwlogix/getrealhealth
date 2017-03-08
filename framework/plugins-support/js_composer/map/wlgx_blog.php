<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_blog
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
$wlgx_post_categories = array();
$wlgx_post_categories_raw = get_categories( "hierarchical=0" );
foreach ( $wlgx_post_categories_raw as $post_category_raw ) {
	$wlgx_post_categories[$post_category_raw->name] = $post_category_raw->slug;
}
vc_map(
	array(
		'base' => 'wlgx_blog',
		'name' => __( 'Blog', 'wlgx' ),
		'description' => __( 'Blog posts listing', 'wlgx' ),
		'icon' => 'icon-wpb-ui-separator-label',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 240,
		'params' => array(
			array(
				'param_name' => 'layout',
				'heading' => __( 'Layout', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Classic', 'wlgx' ) => 'classic',
					__( 'Flat', 'wlgx' ) => 'flat',
					__( 'Tiles', 'wlgx' ) => 'tiles',
					__( 'Cards', 'wlgx' ) => 'cards',
					__( 'Small Circle Image', 'wlgx' ) => 'smallcircle',
					__( 'Small Square Image', 'wlgx' ) => 'smallsquare',
					__( 'Latest Posts', 'wlgx' ) => 'latest',
					__( 'Compact', 'wlgx' ) => 'compact',
				),
				'std' => $config['atts']['layout'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 130,
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
				),
				'std' => $config['atts']['columns'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 120,
			),
			array(
				'param_name' => 'masonry',
				'type' => 'checkbox',
				'value' => array( __( 'Enable Masonry layout mode', 'wlgx' ) => TRUE ),
				( ( $config['atts']['masonry'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['masonry'],
				'dependency' => array(
					'element' => 'layout',
					'value' => array( 'classic', 'flat', 'tiles', 'cards' ),
				),
				'weight' => 115,
			),
			array(
				'param_name' => 'pagination',
				'heading' => __( 'Pagination', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'No pagination', 'wlgx' ) => 'none',
					__( 'Regular pagination', 'wlgx' ) => 'regular',
					__( 'Load More Button', 'wlgx' ) => 'ajax',
					__( 'Infinite Scroll', 'wlgx' ) => 'infinite',
				),
				'std' => $config['atts']['pagination'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 110,
			),
			array(
				'param_name' => 'orderby',
				'heading' => _x( 'Order', 'sequence of items', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'By date (newer first)', 'wlgx' ) => 'date',
					__( 'By date (older first)', 'wlgx' ) => 'date_asc',
					__( 'Alphabetically', 'wlgx' ) => 'alpha',
					__( 'Random', 'wlgx' ) => 'rand',
				),
				'std' => $config['atts']['orderby'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 100,
			),
			array(
				'param_name' => 'items',
				'heading' => __( 'Posts Quantity', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['items'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 90,
			),
			array(
				'param_name' => 'content_type',
				'heading' => __( 'Posts Content', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Excerpt', 'wlgx' ) => 'excerpt',
					__( 'Full Content', 'wlgx' ) => 'content',
					__( 'None', 'wlgx' ) => 'none',
				),
				'std' => $config['atts']['content_type'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 80,
			),
			array(
				'param_name' => 'show_date',
				'type' => 'checkbox',
				'value' => array( __( 'Show Post Date', 'wlgx' ) => TRUE ),
				( ( $config['atts']['show_date'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_date'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 70,
			),
			array(
				'param_name' => 'show_author',
				'type' => 'checkbox',
				'value' => array( __( 'Show Post Author', 'wlgx' ) => TRUE ),
				( ( $config['atts']['show_author'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_author'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 60,
			),
			array(
				'param_name' => 'show_categories',
				'type' => 'checkbox',
				'value' => array( __( 'Show Post Categories', 'wlgx' ) => TRUE ),
				( ( $config['atts']['show_categories'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_categories'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
			),
			array(
				'param_name' => 'show_tags',
				'type' => 'checkbox',
				'value' => array( __( 'Show Post Tags', 'wlgx' ) => TRUE ),
				( ( $config['atts']['show_tags'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_tags'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 40,
			),
			array(
				'param_name' => 'show_comments',
				'type' => 'checkbox',
				'value' => array( __( 'Show Post Comments', 'wlgx' ) => TRUE ),
				( ( $config['atts']['show_comments'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_comments'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 30,
			),
			array(
				'param_name' => 'show_read_more',
				'type' => 'checkbox',
				'value' => array( __( 'Show Read More button', 'wlgx' ) => TRUE ),
				( ( $config['atts']['show_read_more'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['show_read_more'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 20,
			),
			array(
				'param_name' => 'categories',
				'heading' => __( 'Display Posts of selected categories', 'wlgx' ),
				'type' => 'checkbox',
				'value' => $wlgx_post_categories,
				'std' => $config['atts']['categories'],
				'group' => __( 'More Options', 'wlgx' ),
				'weight' => 19,
			),
			array(
				'param_name' => 'filter',
				'heading' => __( 'Filtering', 'wlgx' ),
				'type' => 'checkbox',
				'value' => array( __( 'Enable filtering by category', 'wlgx' ) => 'category' ),
				( ( $config['atts']['filter'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['filter'],
				'group' => __( 'More Options', 'wlgx' ),
				'weight' => 18,
			),
			array(
				'param_name' => 'filter_style',
				'heading' => __( 'Filter Bar Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					sprintf( __( 'Style %d', 'wlgx' ), 1 ) => 'style_1',
					sprintf( __( 'Style %d', 'wlgx' ), 2 ) => 'style_2',
					sprintf( __( 'Style %d', 'wlgx' ), 3 ) => 'style_3',
				),
				'std' => $config['atts']['filter_style'],
				'group' => __( 'More Options', 'wlgx' ),
				'dependency' => array( 'element' => 'filter', 'not_empty' => TRUE ),
				'weight' => 17,
			),
			array(
				'param_name' => 'title_size',
				'heading' => __( 'Posts Titles Size', 'wlgx' ),
				'description' => sprintf( __( 'Add custom value to change default font-size of posts titles. Examples: %s', 'wlgx' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['title_size'],
				'group' => __( 'More Options', 'wlgx' ),
				'weight' => 16,
			),
			array(
				'param_name' => 'el_class',
				'heading' => wlgx_translate_with_external_domain( 'Extra class name', 'js_composer' ),
				'description' => wlgx_translate_with_external_domain( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
				'type' => 'textfield',
				'std' => $config['atts']['el_class'],
				'group' => __( 'More Options', 'wlgx' ),
				'weight' => 15,
			),
		),
	)
);
