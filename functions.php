<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Include all the needed files
 *
 * (!) Note for Clients: please, do not modify this or other theme's files. Use child theme instead!
 */

if ( ! defined( 'wlgx_ACTIVATION_THEMENAME' ) ) {
	define( 'wlgx_ACTIVATION_THEMENAME', 'getrealhealth' );
}

$wlgx_theme_supports = array(
	'plugins' => array(
		'js_composer' => '/framework/plugins-support/js_composer/js_composer.php',
		'Ultimate_VC_Addons' => '/framework/plugins-support/Ultimate_VC_Addons.php',
		'revslider' => '/framework/plugins-support/revslider.php',
		'contact-form-7' => NULL,
		'codelights' => '/framework/plugins-support/codelights.php',
		'wpml' => '/framework/plugins-support/wpml.php'
	),
);

require dirname( __FILE__ ) . '/framework/framework.php';

unset( $wlgx_theme_supports );

