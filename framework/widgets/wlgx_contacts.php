<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * wwwlogix Widget: Contacts
 *
 * Class wlgx_Widget_Login
 */
class wlgx_Widget_Contacts extends wlgx_Widget {

	/**
	 * Output the widget
	 *
	 * @param array $args     Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {

		parent::before_widget( $args, $instance );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		$output = $args['before_widget'];

		if ( $title ) {
			$output .= '<h4>' . $title . '</h4>';
		}

		$output .= '<div class="w-contacts"><div class="w-contacts-list">';

		foreach ( array( 'address', 'phone', 'fax' ) as $key ) {
			if ( empty( $instance[$key] ) ) {
				continue;
			}
			$output .= '<div class="w-contacts-item"><span><strong style="text-transform:capitalize;">' .$key. ': </strong>' . $instance[$key] . '</span></div>';
		}

		if ( ! empty( $instance['email'] ) ) {
			$output .= '<div class="w-contacts-item"><span><strong style="text-transform:capitalize;">' .$key. ': </strong><a href="mailto:' . $instance['email'] . '">' . $instance['email'] . '</a></span></div>';
		}

		$output .= '</div></div>';

		$output .= $args['after_widget'];

		echo $output;
	}
}
