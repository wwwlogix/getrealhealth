<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Contact form configuration
 *
 * @filter wlgx_config_cform
 */

return array(
	'fields' => array(
		'name' => array(
			'type' => 'textfield',
			'title' => '',
			'placeholder' => __( 'Name', 'wlgx' ),
			'error' => __( 'Please enter your Name', 'wlgx' ),
		),
		'email' => array(
			'type' => 'email',
			'title' => '',
			'placeholder' => __( 'Email', 'wlgx' ),
			'error' => __( 'Please enter your Email', 'wlgx' ),
		),
		'phone' => array(
			'type' => 'textfield',
			'title' => '',
			'placeholder' => __( 'Phone Number', 'wlgx' ),
			'error' => __( 'Please enter your Phone Number', 'wlgx' ),
		),
		'message' => array(
			'type' => 'textarea',
			'title' => '',
			'placeholder' => __( 'Message', 'wlgx' ),
			'error' => __( 'Please enter a Message', 'wlgx' ),
		),
		'captcha' => array(
			'type' => 'captcha',
			'title' => __( 'Just to prove you are a human, please solve the equation: ', 'wlgx' ),
			'placeholder' => '',
			'error' => __( 'Please enter the equation result', 'wlgx' ),
		),
	),
	'submit' => __( 'Send Message', 'wlgx' ),
	'success' => __( 'Thank you! Your message was sent.', 'wlgx' ),
	'error' => array(
		'empty_message' => __( 'Cannot send empty message. Please fill any of the fields.', 'wlgx' ),
		'other' => __( 'Cannot send the message. Please contact the website administrator directly.', 'wlgx' ),
	),
	'subject' => __( 'New message from %s', 'wlgx' ),
);
