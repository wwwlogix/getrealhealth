<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Visual Composer Theme Support
 *
 * @link http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=wwwlogix
 */

if ( ! class_exists( 'Vc_Manager' ) ) {

	/**
	 * @param $width
	 *
	 * @since 4.2
	 * @return bool|string
	 */
	function wlgx_wpb_translateColumnWidthToSpan( $width ) {
		preg_match( '/(\d+)\/(\d+)/', $width, $matches );
		if ( ! empty( $matches ) ) {
			$part_x = (int) $matches[1];
			$part_y = (int) $matches[2];
			if ( $part_x > 0 && $part_y > 0 ) {
				$value = ceil( $part_x / $part_y * 12 );
				if ( $value > 0 && $value <= 12 ) {
					$width = 'vc_col-sm-' . $value;
				}
			}
		}

		return $width;
	}

	/**
	 * @param $column_offset
	 * @param $width
	 *
	 * @return mixed|string
	 */
	function wlgx_vc_column_offset_class_merge( $column_offset, $width ) {
		if ( preg_match( '/vc_col\-sm\-\d+/', $column_offset ) ) {
			return $column_offset;
		}

		return $width . ( empty( $column_offset ) ? '' : ' ' . $column_offset );
	}

	/**
	 * @param            $subject
	 * @param            $property
	 * @param bool|false $strict
	 *
	 * @since 4.9
	 * @return bool
	 */
	function wlgx_vc_shortcode_custom_css_has_property( $subject, $property, $strict = FALSE ) {
		$styles = array();
		$pattern = '/\{([^\}]*?)\}/i';
		preg_match( $pattern, $subject, $styles );
		if ( array_key_exists( 1, $styles ) ) {
			$styles = explode( ';', $styles[1] );
		}
		$new_styles = array();
		foreach ( $styles as $val ) {
			$val = explode( ':', $val );
			if ( is_array( $property ) ) {
				foreach ( $property as $prop ) {
					$pos = strpos( $val[0], $prop );
					$full = ( $strict ) ? ( $pos === 0 && strlen( $val[0] ) === strlen( $prop ) ) : TRUE;
					if ( $pos !== FALSE && $full ) {
						$new_styles[] = $val;
					}
				}
			} else {
				$pos = strpos( $val[0], $property );
				$full = ( $strict ) ? ( $pos === 0 && strlen( $val[0] ) === strlen( $property ) ) : TRUE;
				if ( $pos !== FALSE && $full ) {
					$new_styles[] = $val;
				}
			}
		}

		return ! empty( $new_styles );
	}


	return;
}

add_action( 'vc_before_init', 'wlgx_vc_set_as_theme' );
function wlgx_vc_set_as_theme() {
	vc_set_as_theme( TRUE );
}

add_action( 'vc_after_init', 'wlgx_vc_after_init' );
function wlgx_vc_after_init() {
	$updater = vc_manager()->updater();
	$updateManager = $updater->updateManager();

	remove_filter( 'upgrader_pre_download', array( $updater, 'preUpgradeFilter' ) );
	remove_filter( 'pre_set_site_transient_update_plugins', array( $updateManager, 'check_update' ) );
	remove_filter( 'plugins_api', array( $updateManager, 'check_info' ) );
	remove_action( 'in_plugin_update_message-' . vc_plugin_name(), array( $updateManager, 'addUpgradeMessageLink' ) );

}

add_action( 'vc_after_set_mode', 'wlgx_vc_after_set_mode' );
function wlgx_vc_after_set_mode() {

	do_action( 'wlgx_before_js_composer_mappings' );

	$shortcodes_config = wlgx_config( 'shortcodes', array() );

	// Mapping Visual Composer backend behaviour for used shortcodes
	if ( vc_mode() != 'page' ) {
		foreach ( $shortcodes_config as $shortcode => $config ) {
			if ( isset( $config['custom_vc_map'] ) AND ! empty( $config['custom_vc_map'] ) ) {
				require $config['custom_vc_map'];
			}
		}
	}

	if ( ! wlgx_get_option( 'enable_unsupported_vc_shortcodes', FALSE ) ) {
		// Removing the elements that are not supported at the moment by the theme
		foreach ( $shortcodes_config as $shortcode => $config ) {
			if ( isset( $config['supported'] ) AND ! $config['supported'] ) {
				vc_remove_element( $shortcode );
			}
		}
	}

	if ( ! vc_is_page_editable() ) {
		// Removing original VC styles and scripts
		// TODO move to a separate option
		add_action( 'wp_enqueue_scripts', 'wlgx_remove_vc_base_css_js', 15 );
		function wlgx_remove_vc_base_css_js() {
			global $wlgx_template_directory_uri;
			if ( wp_style_is( 'font-awesome', 'registered' ) ) {
				wp_deregister_style( 'font-awesome' );
			}
			if ( ! wlgx_get_option( 'enable_unsupported_vc_shortcodes', FALSE ) ) {
				if ( wp_style_is( 'js_composer_front', 'registered' ) ) {
					wp_dequeue_style( 'js_composer_front' );
					wp_deregister_style( 'js_composer_front' );
				}
				if ( wp_script_is( 'wpb_composer_front_js', 'registered' ) ) {
					wp_deregister_script( 'wpb_composer_front_js' );
				}
			}
		}
	}

	if ( vc_is_page_editable() ) {
		// Disabling some of the shortcodes for front-end edit mode
		wlgx_Shortcodes::instance()->vc_front_end_compatibility();
	}

	if ( is_admin() AND ! wlgx_get_option( 'enable_unsupported_vc_shortcodes', FALSE ) ) {
		// Removing grid elements
		add_action( 'admin_menu', 'wlgx_remove_vc_grid_elements_submenu' );
		function wlgx_remove_vc_grid_elements_submenu() {
			remove_submenu_page( VC_PAGE_MAIN_SLUG, 'edit.php?post_type=vc_grid_item' );
		}
	}

	do_action( 'wlgx_after_js_composer_mappings' );
}

// Disabling redirect to VC welcome page
remove_action( 'init', 'vc_page_welcome_redirect' );

add_action( 'after_setup_theme', 'wlgx_vc_init_vendor_woocommerce', 99 );
function wlgx_vc_init_vendor_woocommerce() {
	remove_action( 'wp_enqueue_scripts', 'vc_woocommerce_add_to_cart_script' );
}


/**
 * Get image size values for selector
 *
 * @param array [$size_names] List of size names
 *
 * @return array
 */
function wlgx_image_sizes_select_values( $size_names = NULL ) {
	if ( $size_names === NULL ) {
		$size_names = array_merge(
			array( 'large' ), array_keys( wlgx_config( 'image-sizes' ) ), array( 'medium', 'thumbnail', 'full' )
		);
	}
	$image_sizes = array();
	// For translation purposes
	$size_titles = array(
		'full' => __( 'Full Size', 'wlgx' ),
	);
	foreach ( $size_names as $size_name ) {
		$size_title = isset( $size_titles[$size_name] ) ? $size_titles[$size_name] : ucwords( $size_name );
		if ( $size_name != 'full' ) {
			// Detecting size
			$size = wlgx_get_intermediate_image_size( $size_name );
			$size_title = ( ( $size['width'] == 0 ) ? __( 'Any', 'wlgx' ) : $size['width'] );
			$size_title .= 'x';
			$size_title .= ( $size['height'] == 0 ) ? __( 'Any', 'wlgx' ) : $size['height'];
			$size_title .= ' (' . ( $size['crop'] ? __( 'cropped', 'wlgx' ) : __( 'not cropped', 'wlgx' ) ) . ')';
		}
		$image_sizes[$size_title] = $size_name;
	}

	return $image_sizes;
}

// add_action( 'vc_load_default_templates_action', 'wlgx_custom_template_for_vc' ); // Hook in
// function wlgx_custom_template_for_vc() {
	// global $wlgx_template_directory;
	// $templates = require $wlgx_template_directory . '/framework/plugins-support/js_composer/templates.php';
	// foreach ( $templates as $template ) {
		// vc_add_default_templates( $template );
	// }
// }
