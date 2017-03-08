<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_cform
 *
 * Dev note: if you want to change some of the default values or acceptable attributes, overload the shortcodes config.
 *
 * @var   $shortcode      string Current shortcode name
 * @var   $shortcode_base string The original called shortcode name (differs if called an alias)
 * @var   $content        string Shortcode's inner content
 * @var   $atts           array Shortcode attributes
 *
 * @param $atts           ['receiver_email'] string Receiver Email
 * @param $atts           ['name_field'] string Name field state: 'required' / 'shown' / 'hidden'
 * @param $atts           ['email_field'] string Email field state: 'required' / 'shown' / 'hidden'
 * @param $atts           ['phone_field'] string Phone field state: 'required' / 'shown' / 'hidden'
 * @param $atts           ['message_field'] string Message field state: 'required' / 'shown' / 'hidden'
 * @param $atts           ['captcha_field'] string Message field state: 'hidden' / 'required'
 * @param $atts           ['button_color'] string Button color: 'primary' / 'secondary' / 'light' / 'contrast' / 'black' / 'white'
 * @param $atts           ['button_bg_color'] string Button background color
 * @param $atts           ['button_text_color'] string Button text color
 * @param $atts           ['button_style'] string Button style: 'raised' / 'flat'
 * @param $atts           ['button_size'] string Button size
 * @param $atts           ['button_align'] string Button alignment: 'left' / 'center' / 'right'
 * @param $atts           ['button_text'] string Button alignment: 'left' / 'center' / 'right'
 * @param $atts           ['el_class'] string Extra class name
 */

$atts = wlgx_shortcode_atts( $atts, 'wlgx_cform' );

global $wlgx_cform_index;
// Form indexes start from 1
$wlgx_cform_index = isset( $wlgx_cform_index ) ? ( $wlgx_cform_index + 1 ) : 1;

$post_id = get_the_ID();

$classes = 'align_' . $atts['button_align'];

if ( ! empty( $atts['el_class'] ) ) {
	$classes .= ' ' . $atts['el_class'];
}

$json_data = array(
	'ajaxurl' => admin_url( 'admin-ajax.php' ),
	'success' => wlgx_config( 'cform.success' ),
	'errors' => array(),
);

$fields = wlgx_config( 'cform.fields' );
foreach ( $fields as $field_name => $field ) {
	if ( ! isset( $atts[$field_name . '_field'] ) OR $atts[$field_name . '_field'] == 'hidden' ) {
		unset( $fields[$field_name] );
		continue;
	}
	$fields[$field_name]['required'] = ( $atts[$field_name . '_field'] == 'required' );
	$json_data['errors'][$field_name] = $field['error'];
}
$fields['action'] = array(
	'type' => 'hidden',
	'value' => 'wlgx_ajax_cform',
);
$fields['post_id'] = array(
	'type' => 'hidden',
	'value' => $post_id,
);
$fields['form_index'] = array(
	'type' => 'hidden',
	'value' => $wlgx_cform_index,
);
$fields['submit'] = array(
	'type' => 'submit',
	'title' => ( ! empty( $atts['button_text'] ) ) ? $atts['button_text'] : wlgx_get_option( 'cform_button_text', wlgx_config( 'cform.submit' ) ),
	'btn_classes' => 'size_' . $atts['button_size'],
	'btn_inner_css' => '',
);
if ( ! empty( $atts['button_color'] ) ) {
	$fields['submit']['btn_classes'] .= ' color_' . $atts['button_color'];
	if ( $atts['button_color'] == 'custom' ) {
		if ( $atts['button_bg_color'] != '' ) {
			$fields['submit']['btn_inner_css'] .= 'background-color: ' . $atts['button_bg_color'] . ';';
		}
		if ( $atts['button_text_color'] != '' ) {
			$fields['submit']['btn_inner_css'] .= 'color: ' . $atts['button_text_color'] . ';';
		}
	}
}
if ( ! empty( $atts['button_style'] ) ) {
	$fields['submit']['btn_classes'] .= ' style_' . $atts['button_style'];
}

wlgx_load_template(
	'templates/form/form', array(
	'type' => 'cform',
	'fields' => $fields,
	'json_data' => $json_data,
	'classes' => $classes,
)
);
