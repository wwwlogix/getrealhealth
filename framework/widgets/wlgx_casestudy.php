<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * wwwlogix Widget: casestudy
 *
 * Class wlgx_Widget_Login
 */
class wlgx_Widget_casestudy extends wlgx_Widget {

	/**
	 * Output the widget
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {

		parent::before_widget( $args, $instance );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		$output = $args['before_widget'];

		if ( $title ) {
			$output .= '<h4>' . $title . '</h4>';
		}


		$template_vars = array(
			'categories' => ( isset( $instance['categories'] ) AND is_array( $instance['categories'] ) ) ? implode( ', ', $instance['categories'] ) : NULL,
			'style_name' => 'style_1',
			'columns' => ( isset( $instance['columns'] ) AND in_array(
					$instance['columns'], array(
					2,
					3,
					4,
					5,
				)
				) ) ? $instance['columns'] : 3,
			'ratio' => '1x1',
			'metas' => array( 'title', ),
			'align' => 'center',
			'filter' => FALSE,
			'with_indents' => FALSE,
			'pagination' => 'none',
			'orderby' => ( in_array(
				$instance['orderby'], array(
				'date',
				'date_asc',
				'alpha',
				'rand',
			)
			) ) ? $instance['orderby'] : 'date',
			'is_widget' => 'true',
		);

		$template_vars['perpage'] = ( isset( $instance['items'] ) ) ? $instance['items'] : $template_vars['columns'];

		ob_start();
		wlgx_load_template( 'templates/casestudy/listing', $template_vars );
		$output .= ob_get_clean();

		$output .= $args['after_widget'];

		echo $output;
	}

	/**
	 * Output the settings update form.
	 *
	 * @param array $instance Current settings.
	 *
	 * @return string Form's output marker that could be used for further hooks
	 */
	public function form( $instance ) {
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

		if ( ! empty( $wlgx_casestudy_categories ) ) {
			$this->config['params']['categories'] = array(
				'type' => 'checkbox',
				'heading' => __( 'Display Items of selected categories', 'wlgx' ),
				'value' => $wlgx_casestudy_categories,
			);
		}

		return parent::form( $instance );
	}


}
