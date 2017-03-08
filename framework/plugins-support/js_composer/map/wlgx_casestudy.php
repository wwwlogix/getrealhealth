<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_casestudy
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
$wlgx_casestudy_categories = array();
$wlgx_casestudy_categories_raw = get_categories(
	array(
		'taxonomy' => 'wlgx_casestudy_category',
		'hierarchical' => 0,
	)
);
if ( $wlgx_casestudy_categories_raw ) {
	foreach ( $wlgx_casestudy_categories_raw as $casestudy_category_raw ) {
		if ( is_object( $casestudy_category_raw ) ) {
			$wlgx_casestudy_categories[$casestudy_category_raw->name] = $casestudy_category_raw->slug;
		}
	}
}
vc_map(
	array(
		'base' => 'wlgx_casestudy',
		'name' => __( 'casestudy Grid', 'wlgx' ),
		'icon' => 'icon-wpb-ui-separator-label',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'weight' => 250,
		'params' => array(
			array(
				'param_name' => 'columns',
				'heading' => __( 'Columns', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'std' => $config['atts']['columns'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 120,
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
				'weight' => 110,
			),
			array(
				'param_name' => 'items',
				'heading' => __( 'Items Quantity', 'wlgx' ),
				'description' => __( 'If left blank, will output all the items', 'wlgx' ),
				'type' => 'textfield',
				'std' => $config['atts']['items'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 100,
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
				'weight' => 90,
			),
			array(
				'param_name' => 'ratio',
				'heading' => __( 'Items Ratio', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( '4:3 (landscape)', 'wlgx' ) => '4x3',
					__( '3:2 (landscape)', 'wlgx' ) => '3x2',
					__( '1:1 (square)', 'wlgx' ) => '1x1',
					__( '2:3 (portrait)', 'wlgx' ) => '2x3',
					__( '3:4 (portrait)', 'wlgx' ) => '3x4',
					__( 'Initial', 'wlgx' ) => 'initial',
				),
				'std' => $config['atts']['ratio'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 80,
			),
			array(
				'param_name' => 'meta',
				'heading' => __( 'Items Meta', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Do not show', 'wlgx' ) => '',
					__( 'Show Item date', 'wlgx' ) => 'date',
					__( 'Show Item categories', 'wlgx' ) => 'categories',
					__( 'Show Item description', 'wlgx' ) => 'desc',
				),
				'std' => $config['atts']['meta'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 70,
			),
			array(
				'param_name' => 'with_indents',
				'type' => 'checkbox',
				'value' => array( __( 'Add indents between items', 'wlgx' ) => TRUE ),
				( ( $config['atts']['with_indents'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['with_indents'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 50,
			),
			array(
				'param_name' => 'style',
				'heading' => __( 'Items Style', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					sprintf( __( 'Style %d', 'wlgx' ), 1 ) => 'style_1',
					sprintf( __( 'Style %d', 'wlgx' ), 2 ) => 'style_2',
					sprintf( __( 'Style %d', 'wlgx' ), 3 ) => 'style_3',
					sprintf( __( 'Style %d', 'wlgx' ), 4 ) => 'style_4',
					sprintf( __( 'Style %d', 'wlgx' ), 5 ) => 'style_5',
					sprintf( __( 'Style %d', 'wlgx' ), 6 ) => 'style_6',
					sprintf( __( 'Style %d', 'wlgx' ), 7 ) => 'style_7',
					sprintf( __( 'Style %d', 'wlgx' ), 8 ) => 'style_8',
					sprintf( __( 'Style %d', 'wlgx' ), 9 ) => 'style_9',
					sprintf( __( 'Style %d', 'wlgx' ), 10 ) => 'style_10',
					sprintf( __( 'Style %d', 'wlgx' ), 11 ) => 'style_11',
					sprintf( __( 'Style %d', 'wlgx' ), 12 ) => 'style_12',
					sprintf( __( 'Style %d', 'wlgx' ), 13 ) => 'style_13',
					sprintf( __( 'Style %d', 'wlgx' ), 14 ) => 'style_14',
					sprintf( __( 'Style %d', 'wlgx' ), 15 ) => 'style_15',
					sprintf( __( 'Style %d', 'wlgx' ), 16 ) => 'style_16',
					sprintf( __( 'Style %d', 'wlgx' ), 17 ) => 'style_17',
					sprintf( __( 'Style %d', 'wlgx' ), 18 ) => 'style_18',
				),
				'std' => $config['atts']['style'],
				'admin_label' => TRUE,
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Styling', 'wlgx' ),
				'weight' => 16,
			),
			array(
				'param_name' => 'align',
				'heading' => __( 'Items Text Alignment', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Left', 'wlgx' ) => 'left',
					__( 'Center', 'wlgx' ) => 'center',
					__( 'Right', 'wlgx' ) => 'right',
				),
				'std' => $config['atts']['align'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Styling', 'wlgx' ),
				'weight' => 15,
			),
			array(
				'param_name' => 'title_size',
				'heading' => __( 'Items Title Size', 'wlgx' ),
				'description' => sprintf( __( 'Examples: %s', 'wlgx' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['title_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Styling', 'wlgx' ),
				'weight' => 14,
			),
			array(
				'param_name' => 'meta_size',
				'heading' => __( 'Items Meta Size', 'wlgx' ),
				'description' => sprintf( __( 'Examples: %s', 'wlgx' ), '26px, 1.3em, 200%' ),
				'type' => 'textfield',
				'std' => $config['atts']['meta_size'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Styling', 'wlgx' ),
				'weight' => 13,
			),
			array(
				'param_name' => 'bg_color',
				'heading' => __( 'Items Background Color', 'wlgx' ),
				'type' => 'colorpicker',
				'std' => $config['atts']['bg_color'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Styling', 'wlgx' ),
				'weight' => 12,
			),
			array(
				'param_name' => 'text_color',
				'heading' => __( 'Items Text Color', 'wlgx' ),
				'type' => 'colorpicker',
				'std' => $config['atts']['text_color'],
				'edit_field_class' => 'vc_col-sm-6',
				'group' => __( 'Styling', 'wlgx' ),
				'weight' => 11,
			),
			array(
				'param_name' => 'filter',
				'type' => 'checkbox',
				'value' => array( __( 'Enable filtering by category', 'wlgx' ) => 'category' ),
				( ( $config['atts']['filter'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['filter'],
				'group' => __( 'Filtering', 'wlgx' ),
				'weight' => 9,
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
				'group' => __( 'Filtering', 'wlgx' ),
				'dependency' => array( 'element' => 'filter', 'not_empty' => TRUE ),
				'weight' => 8,
			),
		),

	)
);
if ( ! empty( $wlgx_casestudy_categories ) ) {
	vc_add_param(
		'wlgx_casestudy', array(
		'param_name' => 'categories',
		'heading' => __( 'Display Items of selected categories', 'wlgx' ),
		'type' => 'checkbox',
		'value' => $wlgx_casestudy_categories,
		'std' => $config['atts']['categories'],
		'weight' => 30,
	)
	);
}
vc_add_param(
	'wlgx_casestudy', array(
	'param_name' => 'el_class',
	'heading' => wlgx_translate_with_external_domain( 'Extra class name', 'js_composer' ),
	'description' => wlgx_translate_with_external_domain( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
	'type' => 'textfield',
	'std' => $config['atts']['el_class'],
	'group' => __( 'Styling', 'wlgx' ),
	'weight' => 10,
)
);
