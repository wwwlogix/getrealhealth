<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output search element
 *
 * @var $text           string Placeholder Text
 * @var $layout         string Layout: 'simple' / 'modern' / 'fulwidth' / 'fullscreen'
 * @var $width          int Field width
 * @var $design_options array
 * @var $product_search bool: whether to search for WooCommerce products only
 * @var $id             string
 */

$classes = ' layout_' . $layout;
if ( isset( $design_options ) AND isset( $design_options['hide_for_sticky'] ) AND $design_options['hide_for_sticky'] ) {
	$classes .= ' hide-for-sticky';
}
if ( isset( $id ) AND ! empty( $id ) ) {
	$classes .= ' ush_' . str_replace( ':', '_', $id );
}


$output = '<div class="w-search' . $classes . '">';
if ( $layout == 'fullscreen' ) {
	$output .= '<div class="w-search-background"></div>';
}
$output .= '<div class="w-search-form">';
$output .= '<form class="w-search-form-h" autocomplete="off" action="' . esc_attr( home_url( '/' ) ) . '" method="get">';
$output .= '<div class="w-search-form-field">';
$output .= '<input type="text" name="s" id="wlgx_form_search_s" placeholder="' . esc_attr( $text ) . '" />';
if ( ! empty( $product_search ) AND $product_search ) {
	$output .= '<input type="hidden" name="post_type" value="product" />';
}
$output .= '<span class="w-form-row-field-bar"></span>';
$output .= '</div>';
if ( $layout == 'simple' ) {
	$output .= '<button class="w-search-form-btn" type="submit"><span>' . __( 'search', 'wlgx' ) . '</span></button>';
}
// Language code
if ( defined( 'ICL_LANGUAGE_CODE' ) AND ICL_LANGUAGE_CODE != '' ) {
	$output .= '<input type="hidden" name="lang" value="' . esc_attr( ICL_LANGUAGE_CODE ) . '" />';
}
$output .= '<div class="w-search-close"></div></form></div>';
$output .= '<a class="w-search-open" href="javascript:void(0);"></a></div>';

$output .= '<div class="ush_cart_1"><a class="w-btn style_solid color_secondary icon_none ush_socials_1" href="http://grhnew.wpengine.com/request-a-demo/" style="font-size: 14px; font-weight:bold; float:left;">
				<span class="w-btn-label">REQUEST A DEMO</span>
			</a>';
			$path = get_bloginfo('template_url');

$output .='</div>';


echo $output;


			