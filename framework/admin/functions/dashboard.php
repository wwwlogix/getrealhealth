<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

add_action( 'admin_menu', 'wlgx_add_info_home_page', 50 );
function wlgx_add_info_home_page() {
	add_submenu_page( 'wlgx-theme-options', wlgx_THEMENAME . ': Home', __( 'About the Theme', 'wlgx' ), 'manage_options', 'wlgx-home', 'wlgx_welcome_page', 11 );
}

function wlgx_welcome_page() {

	$help_portal = 'https://help.wlgx-themes.com';

	$help_portal_api_url = 'https://help.wlgx-themes.com/envato_auth';

	$urlparts = parse_url( site_url() );
	$domain = $urlparts['host'];

	$return_url = admin_url( 'admin.php?page=wlgx-home' );

	if ( ! empty( $_GET['activation_action'] ) ) {
		if ( $_GET['activation_action'] == 'activate' AND ! empty( $_GET['secret'] ) ) {
			$url = $help_portal_api_url . '?secret=' . $_GET['secret'] . '&domain=' . $domain;

			$response = wlgx_api_remote_request( $url );

			if ( $response == '1' ) {
				update_option( 'wlgx_license_activated', 1 );
				update_option( 'wlgx_license_secret', $_GET['secret'] );
				delete_transient( 'wlgx_update_addons_data' );
			}

		}
	} elseif ( get_option( 'wlgx_license_activated', 0 ) == 1 ) {
		$url = $help_portal_api_url . '?secret=' . get_option( 'wlgx_license_secret' ) . '&domain=' . $domain;

		$response = wp_remote_get( $url );

		if ( ! is_wp_error( $response ) ) {
			if ( $response['body'] == '0' ) {
				update_option( 'wlgx_license_activated', 0 );
				update_option( 'wlgx_license_secret', '' );
				delete_transient( 'wlgx_update_addons_data' );
			}
		}

	}

	?>
	<div class="wrap about-wrap wlgx-home">

		<div class="wlgx-header">
			<h1><?php echo sprintf( __( 'Welcome to <strong>%s</strong>', 'wlgx' ), wlgx_THEMENAME . ' ' . wlgx_THEMEVERSION ) ?></h1>

			<div class="about-text">
				<?php _e( 'HTML5 Responsive Theme', 'wlgx' ) ?>
			</div>
		</div>

		<div class="wlgx-features">
			<div class="one-third">
				<h4><i class="dashicons dashicons-screenoptions"></i><?php _e( 'Install Addons', 'wlgx' ) ?></h4>

				<p><?php echo sprintf( __( '', 'wlgx' ), wlgx_THEMENAME ); ?></p>
				<a class="button wlgx-button" href="<?php echo admin_url( 'admin.php?page=wlgx-addons' ); ?>"><?php _e( 'Go to Addons page', 'wlgx' ) ?></a>
			</div>
			<div class="one-third">
				<h4><i class="dashicons dashicons-admin-appearance"></i><?php _e( 'Customize Appearance', 'wlgx' ) ?></h4>

				<p><?php _e( '', 'wlgx' ) ?></p>
				<a class="button wlgx-button" href="<?php echo admin_url( 'admin.php?page=wlgx-theme-options' ); ?>"><?php _e( 'Go to Theme Options', 'wlgx' ) ?></a>
			</div>
		</div>

		

	</div>
	<?php
}
