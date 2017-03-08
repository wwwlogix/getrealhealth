<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: wlgx_single_image
 *
 * @var   $shortcode string Current shortcode name
 * @var   $config    array Shortcode's config
 *
 * @param $config    ['atts'] array Shortcode's attributes and default values
 */
vc_map(
	array(
		'base' => 'wlgx_single_image',
		'name' => __( 'Single Image', 'wlgx' ),
		'icon' => 'icon-wpb-single-image',
		'category' => wlgx_translate_with_external_domain( 'Content', 'js_composer' ),
		'description' => __( 'Simple image with CSS animation', 'wlgx' ),
		'weight' => 370,
		'params' => array(
			array(
				'param_name' => 'image',
				'heading' => __( 'Image', 'wlgx' ),
				'description' => __( 'Select image from media library.', 'wlgx' ),
				'type' => 'attach_image',
				'std' => $config['atts']['image'],
				'weight' => 90,
			),
			array(
				'param_name' => 'size',
				'heading' => __( 'Image Size', 'wlgx' ),
				'type' => 'dropdown',
				'value' => wlgx_image_sizes_select_values(),
				'std' => $config['atts']['size'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 80,
			),
			array(
				'param_name' => 'align',
				'heading' => __( 'Image Alignment', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'Default', 'wlgx' ) => '',
					__( 'Left', 'wlgx' ) => 'left',
					__( 'Center', 'wlgx' ) => 'center',
					__( 'Right', 'wlgx' ) => 'right',
				),
				'std' => $config['atts']['align'],
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 70,
			),
			array(
				'param_name' => 'lightbox',
				'type' => 'checkbox',
				'value' => array( __( 'Enable lightbox with the original image on click', 'wlgx' ) => TRUE ),
				( ( $config['atts']['lightbox'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['lightbox'],
				'weight' => 60,
			),
			array(
				'param_name' => 'link',
				'heading' => __( 'Image link', 'wlgx' ),
				'description' => __( 'Set URL if you want this image to have a link.', 'wlgx' ),
				'type' => 'vc_link',
				'std' => $config['atts']['link'],
				'dependency' => array( 'element' => 'lightbox', 'is_empty' => TRUE ),
				'weight' => 50,
			),
			array(
				'param_name' => 'frame',
				'heading' => __( 'Image Frame Mockup', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'None', 'wlgx' ) => 'none',
					__( 'Phone 6 Black Realistic', 'wlgx' ) => 'phone6-1',
					__( 'Phone 6 White Realistic', 'wlgx' ) => 'phone6-2',
					__( 'Phone 6 Black Flat', 'wlgx' ) => 'phone6-3',
					__( 'Phone 6 White Flat', 'wlgx' ) => 'phone6-4',
				),
				'std' => $config['atts']['frame'],
				'weight' => 45,
			),
			array(
				'param_name' => 'animate',
				'heading' => __( 'Animation', 'wlgx' ),
				'description' => __( 'Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'No Animation', 'wlgx' ) => '',
					__( 'Fade', 'wlgx' ) => 'fade',
					__( 'Appear From Center', 'wlgx' ) => 'afc',
					__( 'Appear From Left', 'wlgx' ) => 'afl',
					__( 'Appear From Right', 'wlgx' ) => 'afr',
					__( 'Appear From Bottom', 'wlgx' ) => 'afb',
					__( 'Appear From Top', 'wlgx' ) => 'aft',
					__( 'Height From Center', 'wlgx' ) => 'hfc',
					__( 'Width From Center', 'wlgx' ) => 'wfc',
				),
				'std' => $config['atts']['animate'],
				'admin_label' => TRUE,
				'weight' => 40,
			),
			array(
				'param_name' => 'animate_delay',
				'heading' => __( 'Animation Delay', 'wlgx' ),
				'type' => 'dropdown',
				'value' => array(
					__( 'None', 'wlgx' ) => '',
					__( '0.2 second', 'wlgx' ) => '0.2',
					__( '0.4 second', 'wlgx' ) => '0.4',
					__( '0.6 second', 'wlgx' ) => '0.6',
					__( '0.8 second', 'wlgx' ) => '0.8',
					__( '1 second', 'wlgx' ) => '1',
				),
				'std' => $config['atts']['animate_delay'],
				'dependency' => array( 'element' => 'animate', 'not_empty' => TRUE ),
				'admin_label' => TRUE,
				'weight' => 30,
			),
			array(
				'param_name' => 'el_class',
				'heading' => wlgx_translate_with_external_domain( 'Extra class name', 'js_composer' ),
				'description' => wlgx_translate_with_external_domain( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
				'type' => 'textfield',
				'std' => $config['atts']['el_class'],
				'weight' => 20,
			),
			array(
				'param_name' => 'css',
				'heading' => 'CSS',
				'type' => 'css_editor',
				'std' => $config['atts']['css'],
				'group' => wlgx_translate_with_external_domain( 'Design Options', 'js_composer' ),
				'weight' => 10,
			),
		),
	)
);
vc_remove_element( 'vc_single_image' );

class WPBakeryShortCode_wlgx_single_image extends WPBakeryShortCode {

	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		// Compatibility fixes
		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type = isset( $param['type'] ) ? $param['type'] : '';
		$class = isset( $param['class'] ) ? $param['class'] : '';

		if ( $type == 'attach_image' AND $param_name == 'image' ) {
			$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
			$element_icon = $this->settings( 'icon' );
			$img = wpb_getImageBySize(
				array(
					'attach_id' => (int) preg_replace( '/[^\d]/', '', $value ),
					'thumb_size' => 'thumbnail',
				)
			);
			$logo_html = '';

			if ( $img ) {
				$logo_html .= $img['thumbnail'];
			} else {
				$logo_html .= '<img width="150" height="150" class="attachment-thumbnail icon-wpb-single-image vc_element-icon"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />';
			}
			$logo_html .= '<span class="no_image_image vc_element-icon' . ( ! empty( $element_icon ) ? ' ' . $element_icon : '' ) . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '" />';
			$this->setSettings( 'logo', $logo_html );
			$output .= $this->outputTitleTrue( $this->settings['name'] );
		} elseif ( ! empty( $param['holder'] ) ) {
			if ( $param['holder'] == 'input' ) {
				$output .= '<' . $param['holder'] . ' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '">';
			} elseif ( in_array( $param['holder'], array( 'img', 'iframe' ) ) ) {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="' . $value . '">';
			} elseif ( $param['holder'] !== 'hidden' ) {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
			}
		}

		if ( ! empty( $param['admin_label'] ) && $param['admin_label'] === TRUE ) {
			$output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . __( $param['heading'], 'js_composer' ) . '</label>: ' . $value . '</span>';
		}

		return $output;
	}

	public function getImageSquereSize( $img_id, $img_size ) {
		if ( preg_match_all( '/(\d+)x(\d+)/', $img_size, $sizes ) ) {
			$exact_size = array(
				'width' => isset( $sizes[1][0] ) ? $sizes[1][0] : '0',
				'height' => isset( $sizes[2][0] ) ? $sizes[2][0] : '0',
			);
		} else {
			$image_downsize = image_downsize( $img_id, $img_size );
			$exact_size = array(
				'width' => $image_downsize[1],
				'height' => $image_downsize[2],
			);
		}
		if ( isset( $exact_size['width'] ) && (int) $exact_size['width'] !== (int) $exact_size['height'] ) {
			$img_size = (int) $exact_size['width'] > (int) $exact_size['height'] ? $exact_size['height'] . 'x' . $exact_size['height'] : $exact_size['width'] . 'x' . $exact_size['width'];
		}

		return $img_size;
	}

	protected function outputTitle( $title ) {
		return '';
	}

	protected function outputTitleTrue( $title ) {
		return '<h4 class="wpb_element_title">' . __( $title, 'wlgx' ) . ' ' . $this->settings( 'logo' ) . '</h4>';
	}
}
