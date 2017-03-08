<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_contacts
 *
 * Dev note: if you want to change some of the default values or acceptable attributes, overload the shortcodes config.
 *
 * @var   $shortcode      string Current shortcode name
 * @var   $shortcode_base string The original called shortcode name (differs if called an alias)
 * @var   $content        string Shortcode's inner content
 * @var   $atts           array Shortcode attributes
 *
 * @param $atts           ['address'] string Addresss
 * @param $atts           ['phone'] string Phone
 * @param $atts           ['fax'] string Fax
 * @param $atts           ['email'] string Email
 * @param $atts           ['el_class'] string Extra class name
 */

$atts = wlgx_shortcode_atts( $atts, 'wlgx_contacts' );

// .w-contacts container additional classes and inner CSS-styles
$classes = '';

if ( ! empty( $atts['el_class'] ) ) {
	$classes .= ' ' . $atts['el_class'];
}
$output = '<div class="w-contacts' . $classes . '"><div class="w-contacts-list">';
if ( ! empty( $atts['address'] ) ) {
	$output .= '<div class="w-contacts-item"><span>' . $atts['address'] . '</span></div>';
}
if ( ! empty( $atts['phone'] ) ) {
	$output .= '<div class="w-contacts-item"><span>' . $atts['phone'] . '</span></div>';
}
if ( ! empty( $atts['fax'] ) ) {
	$output .= '<div class="w-contacts-item"><span>' . $atts['fax'] . '</span></div>';
}
if ( ! empty( $atts['email'] ) ) {
	$output .= '<div class="w-contacts-item"><span>';
	$output .= '<a href="mailto:' . $atts['email'] . '">' . $atts['email'] . '</a></span></div>';
}

$output .= '</div></div>';

echo $output;
