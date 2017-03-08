<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if ( ! current_user_can( 'install_plugins' ) ) {
	return;
}

$js_composer_path = 'js_composer';
$installed_plugins = get_plugins();
$keys = array_keys( $installed_plugins );

foreach ( $keys as $key ) {
	if ( preg_match( '|^' . $js_composer_path . '/|', $key ) ) {
		$js_composer_path = $key;
		break;
	}
}

if ( ( ! get_option( 'wlgx_dismiss_addons_install_notice' ) ) AND ( ! isset( $installed_plugins[$js_composer_path] ) ) ) {
	add_action( 'admin_notices', 'wlgx_js_composer_install_admin_notice' );
}
if ( ( ! get_option( 'wlgx_dismiss_addons_activate_notice' ) ) AND ( isset( $installed_plugins[$js_composer_path] ) ) AND is_plugin_inactive( $js_composer_path ) ) {
	add_action( 'admin_notices', 'wlgx_js_composer_activate_admin_notice' );
}


function wlgx_js_composer_install_admin_notice() {
	?>
	<div class="notice notice-warning wlgx-addons-notice for-installing is-dismissible">
		<p><?php echo sprintf( __( 'This theme requires %s plugin to be installed.', 'wlgx' ), '<strong>Visual Composer</strong>' ); ?>
			<a href="<?php echo admin_url( 'admin.php?page=wlgx-addons' ) ?>"><?php _e( 'Go to Install', 'wlgx' ); ?></a>
		</p>
	</div>
	<?php
}

function wlgx_js_composer_activate_admin_notice() {
	?>
	<div class="notice notice-warning wlgx-addons-notice for-activating is-dismissible">
		<p><?php echo sprintf( __( 'This theme requires %s plugin to be activated.', 'wlgx' ), '<strong>Visual Composer</strong>' ); ?>
			<a href="<?php echo admin_url( 'admin.php?page=wlgx-addons' ) ?>"><strong><?php _e( 'Go to Activate', 'wlgx' ); ?></strong></a>
		</p>
	</div>
	<?php
}

add_action( 'admin_print_scripts', 'wlgx_admin_addons_assets', 99 );

function wlgx_admin_addons_assets() {
	?>
	<script>
		jQuery(document).on('click', '.wlgx-addons-notice .notice-dismiss', function(){
			var $notice = jQuery(this).closest('.wlgx-addons-notice'),
				pluginAction = ($notice.hasClass('for-activating')) ? 'activate' : 'install';
			jQuery.ajax({
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				data: {
					action: 'wlgx_dismiss_addons_notice',
					pluginAction: pluginAction
				}
			});

		});
	</script>
	<?php
}

add_action( 'wp_ajax_wlgx_dismiss_addons_notice', 'wlgx_dismiss_addons_notice' );

function wlgx_dismiss_addons_notice() {
	if ( $_GET['pluginAction'] == 'activate' ) {
		update_option( 'wlgx_dismiss_addons_activate_notice', 1 );
	} elseif ( $_GET['pluginAction'] == 'install' ) {
		update_option( 'wlgx_dismiss_addons_install_notice', 1 );
	}


}


add_action( 'admin_menu', 'wlgx_add_addons_page', 20 );
function wlgx_add_addons_page() {
	add_submenu_page( 'wlgx-theme-options', wlgx_THEMENAME . ': ' . __( 'Addons', 'wlgx' ), __( 'Addons', 'wlgx' ), 'manage_options', 'wlgx-addons', 'wlgx_addons_page', 11 );
}

function wlgx_addons_page() {
	$plugins = wlgx_config( 'addons' );

	
	$installed_plugins = get_plugins();
	$wlgx_template_directory_uri = get_template_directory_uri();
	?>
	<div class="wrap about-wrap wlgx-addons">

		<h1><?php echo wlgx_THEMENAME . '<strong> ' . __( 'Addons', 'wlgx' ); ?></strong></h1>

		

		<div class="wlgx-addons-list">
			<?php foreach ( $plugins as $plugin ) {

				$keys = array_keys( get_plugins() );

				$plugin['file_path'] = $plugin['slug'];
				foreach ( $keys as $key ) {
					if ( preg_match( '|^' . $plugin['slug'] . '/|', $key ) ) {
						$plugin['file_path'] = $key;
						break;
					}
				}

				$classes = ' ' . $plugin['slug'];
				$link_classes = '';
				$link_atts = '';
				$action = '';
				$link = '';
				if ( is_plugin_active( $plugin['file_path'] ) ) {
					$classes .= ' status_active';
					$status = __( 'Installed & Activated', 'wlgx' );

				}  elseif ( is_plugin_inactive( $plugin['file_path'] ) ) {
					$classes .= ' status_notactive';
					$status = __( 'Installed But Not Activated', 'wlgx' );
					$action = __( 'Activate Plugin', 'wlgx' );
					$link = 'javascript:void(0);';
					$link_classes .= ' button-primary action-button';
					$link_atts = ' data-plugin="' . $plugin['slug'] . '" data-action="activate"';

				}
				?>
				<div class="wlgx-addon<?php echo $classes; ?>">
					<div class="wlgx-addon-content">
						<span class="wlgx-addon-icon"><img src="<?php echo $wlgx_template_directory_uri . '/framework/admin/img/' . $plugin['slug']; ?>.png" alt=""></span>

						<h3 class="wlgx-addon-title"><?php echo $plugin['name'] ?></h3>

						<p class="wlgx-addon-desc"><?php echo $plugin['description']; ?></p>
					</div>
					<div class="wlgx-addon-control">
						<div class="wlgx-addon-status">
							<i class="g-preloader type_1"></i><span><?php echo $status; ?></span></div>
						<?php if ( $action != '' AND $link != '' ) { ?>
							<a class="button<?php echo $link_classes; ?>" href="<?php echo $link; ?>" <?php echo $link_atts; ?>><?php echo $action; ?></a>
						<?php } ?>
					</div>
				</div>

			<?php } ?>
		</div>

	</div>
	<script>
		jQuery(function($){
			var isRunning = false;
			$('.action-button').click(function(){
				if (isRunning) return;
				isRunning = true;
				$('.wlgx-addons-list').addClass('disable-buttons');
				var plugin = $(this).attr('data-plugin'),
					action = $(this).attr('data-action'),
					$tile = $(this).closest('.wlgx-addon'),
					$status = $tile.find('.wlgx-addon-status > span'),
					$button = $(this);

				$button.hide();
				$tile.removeClass(function(index, css){
					return (css.match(/(^|\s)status_\S+/g) || []).join(' ');
				});
				if (action == 'install') {
					$tile.addClass('status_installing');
					$status.html('<?php esc_js(  _e( 'Installing...', 'wlgx' ) ); ?>');
				} else {
					$tile.addClass('status_activating');
					$status.html('<?php esc_js( _e( 'Activating...', 'wlgx' ) ); ?>');
				}
				$.ajax({
					type: 'POST',
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					data: {
						action: 'wlgx_ajax_addons_' + action,
						plugin: plugin
					},
					success: function(data){
						isRunning = false;
						$('.wlgx-addons-list').removeClass('disable-buttons');
						$tile.removeClass(function(index, css){
							return (css.match(/(^|\s)status_\S+/g) || []).join(' ');
						});
						if (data != undefined && data.success) {
							$tile.addClass('status_active');
							$status.html('<?php esc_js( _e( 'Installed & Activated', 'wlgx' ) ); ?>');
						} else {
							$tile.addClass('status_error');
							if (data != undefined && data.data != undefined && data.data.message != undefined) {
								$status.html(data.data.message);
							} else {
								$status.html('<?php echo  esc_js( wlgx_translate_with_external_domain( 'An error has occurred. Please reload the page and try again.' ) ); ?>');
							}
						}
					}
				});
				return false;
			});
		});
	</script>

	<?php
}


add_action( 'wp_ajax_wlgx_ajax_addons_install', 'wlgx_ajax_addons_install' );
add_action( 'wp_ajax_wlgx_ajax_addons_activate', 'wlgx_ajax_addons_activate' );

function wlgx_ajax_addons_activate() {

	if ( ! isset( $_POST['plugin'] ) || ! $_POST['plugin'] ) {
		wp_send_json_error( array( 'message' => wlgx_translate_with_external_domain( 'An error has occurred. Please reload the page and try again.' ) ) );
	}

	$result = wlgx_activate_plugin();

	if ( is_wp_error( $result ) ) {
		wp_send_json_error( array( 'message' => $result->get_error_message() ) );
	}

	wp_send_json_success( array( 'plugin' => $_POST['plugin'] ) );

}

function wlgx_activate_plugin() {
	if ( empty( $_POST['plugin'] ) ) {
		return FALSE;
	}

	$plugins = wlgx_config( 'addons', array() );

	if ( empty( $plugins ) ) {
		return FALSE;
	}

	$_plugins = array();
	foreach ( $plugins as $i => $plugin ) {
		$_plugins[$plugin['slug']] = $plugin;
	}

	$plugins = $_plugins;

	$slug = urldecode( $_POST['plugin'] );

	if ( ! isset( $plugins[$slug] ) ) {
		return FALSE;
	}

	$plugin = $plugins[$slug];

	$plugin_data = get_plugins( '/' . $plugin['slug'] ); // Retrieve all plugins.
	$plugin_file = array_keys( $plugin_data ); // Retrieve all plugin files from installed plugins.

	$plugin_to_activate = $plugin['slug'] . '/' . $plugin_file[0]; // Match plugin slug with appropriate plugin file.
	ob_start();
	$activate = activate_plugin( $plugin_to_activate ); // Activate the plugin.
	ob_get_clean();

	if ( is_wp_error( $activate ) ) {
		return $activate;
	} else {
		return TRUE;
	}
}

function wlgx_ajax_addons_install() {

	if ( ! isset( $_POST['plugin'] ) || ! $_POST['plugin'] ) {
		wp_send_json_error( array( 'message' => wlgx_translate_with_external_domain( 'An error has occurred. Please reload the page and try again.' ) ) );
	}

	$result = wlgx_install_plugin();

	if ( is_wp_error( $result ) ) {
		wp_send_json_error( array( 'message' => $result->get_error_message() ) );
	}

	wp_send_json_success( array( 'plugin' => $_POST['plugin'] ) );

}

function wlgx_install_plugin() {
	if ( empty( $_POST['plugin'] ) ) {
		return FALSE;
	}

	$plugins = wlgx_config( 'addons', array() );

	foreach ( $plugins as $i => $plugin ) {
		if ( empty( $plugins[$i]['version'] ) OR empty( $plugins[$i]['source'] ) ) {
			unset( $plugins[$i] );
		}
	}

	if ( empty( $plugins ) ) {
		return FALSE;
	}

	$_plugins = array();
	foreach ( $plugins as $i => $plugin ) {
		$_plugins[$plugin['slug']] = $plugin;
	}

	$plugins = $_plugins;

	$slug = urldecode( $_POST['plugin'] );

	if ( ! isset( $plugins[$slug] ) ) {
		return FALSE;
	}

	$plugin = $plugins[$slug];

	if ( file_exists( WP_PLUGIN_DIR . '/' . $slug ) ) {
		return wlgx_activate_plugin();
	}

	if ( ! filesystem_permission_check() ) {
		return new WP_Error( 'wlgx-addons', __( 'Please adjust file permissions to allow plugins installation', 'wlgx' ) );
	}

	$wlgx_template_directory = get_template_directory();

	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once $wlgx_template_directory . '/framework/admin/functions/addons-update-skin.php';

	$skin = new wlgx_Plugin_Upgrader_Skin( array( 'plugin' => $slug ) );
	$upgrader = new Plugin_Upgrader( $skin );
	$install_result = $upgrader->install( $plugin['source'] );

	if ( is_wp_error( $install_result ) ) {
		return $install_result;
	}

	if ( ! $install_result ) {
		return new WP_Error( 'plugin_error', wlgx_translate_with_external_domain( 'An error has occurred. Please reload the page and try again.' ) );
	}

	ob_start();
	$activate = activate_plugin( $upgrader->plugin_info() );
	ob_get_clean();
	if ( is_wp_error( $activate ) ) {
		return $activate;
	}

	return $skin->result;

}

function filesystem_permission_check() {
	ob_start();
	$creds = request_filesystem_credentials( '', '', FALSE, FALSE, NULL );
	ob_get_clean();

	// Abort if permissions were not available.
	if ( ! WP_Filesystem( $creds ) ) {
		return FALSE;
	}

	return TRUE;
}
