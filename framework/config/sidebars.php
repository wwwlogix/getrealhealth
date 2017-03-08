<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's sidebars
 *
 * @filter wlgx_config_sidebars
 */

return array(
	'default_sidebar' => array(
		'name' => __( 'Basic Sidebar', 'wlgx' ),
		'id' => 'default_sidebar',
		'description' => __( 'Predefined Widget Area', 'wlgx' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	),
	'footer_first' => array(
		'name' => sprintf( __( 'Footer Column %d', 'wlgx' ), 1 ),
		'id' => 'footer_first',
		'description' => __( 'Predefined Widget Area', 'wlgx' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
	'footer_second' => array(
		'name' => sprintf( __( 'Footer Column %d', 'wlgx' ), 2 ),
		'id' => 'footer_second',
		'description' => __( 'Predefined Widget Area', 'wlgx' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
	'footer_third' => array(
		'name' => sprintf( __( 'Footer Column %d', 'wlgx' ), 3 ),
		'id' => 'footer_third',
		'description' => __( 'Predefined Widget Area', 'wlgx' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
	'footer_fourth' => array(
		'name' => sprintf( __( 'Footer Column %d', 'wlgx' ), 4 ),
		'id' => 'footer_fourth',
		'description' => __( 'Predefined Widget Area', 'wlgx' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
	'footer_fifth' => array(
		'name' => sprintf( __( 'Footer Column %d', 'wlgx' ), 5 ),
		'id' => 'footer_fifth',
		'description' => __( 'Predefined Widget Area', 'wlgx' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
	'footer_sixth' => array(
		'name' => sprintf( __( 'Footer Column %d', 'wlgx' ), 6 ),
		'id' => 'footer_sixth',
		'description' => __( 'Predefined Widget Area', 'wlgx' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
	'bottom_footer_social_sidebar' => array(
		'name' => __( 'Bottom Footer Social Media', 'wlgx' ),
		'id' => 'bottom_footer_social_sidebar',
		'description' => __( 'Predefined Widget Area', 'wlgx' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	),
);
