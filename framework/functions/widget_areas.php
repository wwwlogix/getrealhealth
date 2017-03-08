<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

class wlgx_Widget_Areas {

	public $widget_areas = array();
	public $option_name = 'wlgx_widget_areas';

	public function __construct() {

		add_action( 'load-widgets.php', array( &$this, 'load_widgets' ), 5 );
		add_action( 'widgets_init', array( &$this, 'register_widget_areas' ), 100 );
		add_action( 'wp_ajax_wlgx_delete_custom_widget_area', array( &$this, 'delete_widget_area' ), 100 );
	}

	public function load_widgets() {

		add_action( 'admin_print_scripts', array( &$this, 'template_add_widget_area' ) );
		add_action( 'load-widgets.php', array( &$this, 'add_widget_area' ), 100 );

		global $wlgx_template_directory_uri;
		wp_enqueue_script( 'wlgx_widget_areas', $wlgx_template_directory_uri . '/framework/admin/js/widget_areas.js' );
	}

	public function template_add_widget_area() {
		$nonce = wp_create_nonce( 'wlgx_delete_widget_area_nonce' );
		$nonce = '<input type="hidden" name="wlgx_delete_widget_area_nonce" value="' . $nonce . '" />';

		?>
		<script type="text/html" id="wlgx_add_widget_area">
			<form method="POST" class="wlgx-custom-area-form widgets-holder-wrap">
				<h3><?php echo wlgx_THEMENAME . ' ';
					_e( 'Custom Widget Area', 'wlgx' ) ?></h3>
				<input type="text" value="" placeholder="<?php _e( 'Name of the new Widget Area', 'wlgx' ) ?>" name="wlgx_widget_area" />
				<input class="button button-primary" type="submit" value="<?php _e( 'Add Widget Area', 'wlgx' ) ?>" />
				<?php echo $nonce; ?>
			</form>
			<span id="wlgx_confirm_widget_area_deletion" style="display: none;"><?php _e( 'Do you really want to delete this widget area?', 'wlgx' ); ?></span>
		</script>
		<?php
	}

	public function add_widget_area() {
		if ( ! empty( $_POST['wlgx_widget_area'] ) ) {

			$this->widget_areas = get_option( $this->option_name );
			$name = $this->get_name( trim( $_POST['wlgx_widget_area'] ) );
			$id = $this->name_to_id( $name );

			if ( empty( $this->widget_areas ) ) {
				$this->widget_areas = array( $id => $name );
			} else {
				$this->widget_areas = array_merge( $this->widget_areas, array( $id => $name ) );
			}

			update_option( $this->option_name, $this->widget_areas );
			wp_redirect( admin_url( 'widgets.php' ) );
			die();
		}
	}

	public function delete_widget_area() {
		check_ajax_referer( 'wlgx_delete_widget_area_nonce' );

		if ( ! empty( $_POST['name'] ) ) {
			$name = stripslashes( $_POST['name'] );
			$this->widget_areas = get_option( $this->option_name );

			if ( ( $id = array_search( $name, $this->widget_areas ) ) !== FALSE ) {
				unset( $this->widget_areas[$id] );
				update_option( $this->option_name, $this->widget_areas );
				echo "success";
			}
		}

		die();
	}

	public function get_name( $name ) {
		if ( empty( $GLOBALS['wp_registered_sidebars'] ) ) {
			return $name;
		}

		$taken = array();
		foreach ( $GLOBALS['wp_registered_sidebars'] as $widget_area ) {
			$taken[] = $widget_area['name'];
		}

		if ( empty( $this->widget_areas ) ) {
			$this->widget_areas = array();
		}
		$taken = array_merge( array( $taken ), $this->widget_areas );

		if ( in_array( $name, $taken ) ) {
			$counter = substr( $name, - 1 );

			if ( ! is_numeric( $counter ) ) {
				$new_name = $name . " 1";
			} else {
				$new_name = substr( $name, 0, - 1 ) . ( (int) $counter + 1 );
			}

			$name = $this->get_name( $new_name );
		}

		return $name;
	}

	public function register_widget_areas() {
		if ( empty( $this->widget_areas ) ) {
			$this->widget_areas = get_option( $this->option_name );
		}

		$args = array(
			'description' => __( 'Custom Widget Area', 'wlgx' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
			'class' => 'wlgx-custom-area',
		);

		if ( is_array( $this->widget_areas ) ) {
			foreach ( $this->widget_areas as $id => $name ) {
				$args['name'] = $name;
				$args['id'] = $id;
				register_sidebar( $args );
			}
		}
	}

	private function name_to_id( $name ) {
		$name = strtolower( $name );

		$trans = array(
			'&\S+?;' => '',
			'\s+' => '_',
			'ä' => 'ae',
			'ö' => 'oe',
			'ü' => 'ue',
			'Ä' => 'Ae',
			'Ö' => 'Oe',
			'Ü' => 'Ue',
			'ß' => 'ss',
			'[^a-z0-9\-\._]' => '',
			'-+' => '-',
			'-$' => '-',
			'^-' => '-',
			'\.+$' => '',
			'_+' => '_',
			'^_$' => '',
		);

		$name = strip_tags( $name );

		foreach ( $trans as $key => $val ) {
			$name = preg_replace( "#" . $key . "#i", $val, $name );
		}

		if ( $name == '' ) {
			$name = 'wlgx_widget_area_' . rand( 99999, 999999 );
		} else {
			$name = 'wlgx_widget_area_' . $name;
		}

		return stripslashes( $name );
	}
}

new wlgx_Widget_Areas();

function wlgx_dynamic_sidebar( $default = NULL ) {

	if ( is_singular() ) {
		$sidebar_id = usof_meta( 'wlgx_sidebar_id' );
		if ( ! empty( $sidebar_id ) ) {
			dynamic_sidebar( $sidebar_id );

			return TRUE;
		}
	}
	if ( ! empty( $default ) ) {
		dynamic_sidebar( $default );
	} else {
		$sidebar_id = wlgx_get_option( 'page_sidebar_id', 'default_sidebar' );
		dynamic_sidebar( $sidebar_id );
	}
}

function wlgx_dynamic_sidebar_id( $default = NULL ) {

	if ( is_singular() ) {
		$sidebar_id = usof_meta( 'wlgx_sidebar_id' );
		if ( ! empty( $sidebar_id ) ) {
			return $sidebar_id;
		}
	}
	if ( ! empty( $default ) ) {
		return $default;
	} else {
		$sidebar_id = wlgx_get_option( 'page_sidebar_id', 'default_sidebar' );

		return $sidebar_id;
	}
}

add_action( 'widgets_init', 'wlgx_register_sidebars' );
function wlgx_register_sidebars() {
	$config = wlgx_config( 'sidebars' );
	foreach ( $config as $sidebar ) {
		register_sidebar( $sidebar );
	}
}
