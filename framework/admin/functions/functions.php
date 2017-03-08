<?php

// Redirect to Demo Import page after Theme activation

add_action( 'admin_init', 'wlgx_theme_activation' );
function wlgx_theme_activation() {
	global $pagenow;
	if ( is_admin() AND $pagenow == 'themes.php' AND isset( $_GET['activated'] ) ) {
		//Set menu
		$user = wp_get_current_user();
		update_user_option( $user->ID, wlgx_THEMENAME . '_cpt_in_menu_set', FALSE, TRUE );

		//Redirect to demo import
		header( 'Location: ' . admin_url( 'admin.php?page=wlgx-home' ) );
	}
}

add_action( 'admin_head', 'wlgx_include_cpt_to_menu', 99 );
function wlgx_include_cpt_to_menu() {
	global $pagenow;
	if ( is_admin() AND $pagenow == 'nav-menus.php' ) {
		$already_set = get_user_option( wlgx_THEMENAME . '_cpt_in_menu_set' );

		if ( ! $already_set ) {
			$hidden_meta_boxes = get_user_option( 'metaboxhidden_nav-menus' );

			if ( ! is_array( $hidden_meta_boxes ) ) {
				$hidden_meta_boxes = array();
			}

			if ( $hidden_meta_boxes !== FALSE ) {
				if ( ( $key = array_search( 'add-wlgx_casestudy', $hidden_meta_boxes ) ) !== FALSE AND isset( $hidden_meta_boxes[$key] ) ) {
					unset( $hidden_meta_boxes[$key] );
				}
				if ( ( $key = array_search( 'add-wlgx_casestudy_category', $hidden_meta_boxes ) ) === FALSE ) {
					$hidden_meta_boxes[] = 'add-wlgx_casestudy_category';
				}
				if ( ( $key = array_search( 'add-wlgx_client', $hidden_meta_boxes ) ) === FALSE ) {
					$hidden_meta_boxes[] = 'add-wlgx_client';
				}

				$user = wp_get_current_user();
				update_user_option( $user->ID, 'metaboxhidden_nav-menus', $hidden_meta_boxes, TRUE );
				update_user_option( $user->ID, wlgx_THEMENAME . '_cpt_in_menu_set', TRUE, TRUE );
			}
		}
	}
}

// Custom CSS for admin pages
add_action( 'admin_print_scripts', 'wlgx_enqueue_admin_css', 12 );
function wlgx_enqueue_admin_css() {
	global $wlgx_template_directory_uri;
	wp_enqueue_style( 'wlgx-theme-admin', $wlgx_template_directory_uri . '/framework/admin/css/theme-admin.css' );
}

/**
 * Registers an editor stylesheet for the theme.
 */
function wlgx_theme_add_editor_styles() {
	add_editor_style( 'framework/admin/css/editor-style.css' );
}

add_action( 'admin_init', 'wlgx_theme_add_editor_styles' );
