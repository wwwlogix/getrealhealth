<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output one post from casestudy listing.
 *
 * (!) Should be called in WP_Query fetching loop only.
 * @link   https://codex.wordpress.org/Class_Reference/WP_Query#Standard_Loop
 *
 * @var $metas      array Meta data that should be shown: array('title', 'date', 'categories', 'desc')
 * @var $ratio      string Items ratio: '3x2' / '4x3' / '1x1' / '2x3' / '3x4' / 'initial'
 * @var $columns    int Columns number: 2 / 3 / 4 / 5
 * @var $is_widget  bool if used in widget
 * @var $title_size string Title Font Size
 * @var $meta_size  string Meta Font Size
 * @var $text_color string
 * @var $bg_color   string
 *
 * @action Before the template: 'wlgx_before_template:templates/blog/listing-post'
 * @action After the template: 'wlgx_after_template:templates/blog/listing-post'
 * @filter Template variables: 'wlgx_template_vars:templates/blog/listing-post'
 */

// .w-casestudy item additional classes
$classes = '';
$anchor_atts = '';
$title_inner_css = $meta_inner_css = $anchor_inner_css = '';

$tile_size = '1x1';


// In case of any image issue using placeholder so admin could understand it quickly
// TODO Move placeholder URL to some config
global $wlgx_template_directory_uri;
$placeholder_url = $wlgx_template_directory_uri . '/framework/img/wlgx-placeholder-square.png';

$tnail_id = get_post_thumbnail_id();
if ( $tnail_id ) {
	$image = wp_get_attachment_image_src( $tnail_id, 'large' );
	if ( $tile_size == '1x1' ) {
		$image = wp_get_attachment_image_src( $tnail_id, 'tnail-masonry' );
	}
	if ( $is_widget ) {
		if ( $columns > 2 ) {
			$image = wp_get_attachment_image_src( $tnail_id, 'thumbnail' );
		} else {
			$image = wp_get_attachment_image_src( $tnail_id, 'tnail-1x1-small' );
		}

	}
}

if ( ! $tnail_id OR ( ! $image ) ) {
	$image = array( $placeholder_url, 500, 500 );
}
$item_title = get_the_title();
$image_html = '<img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . esc_attr( $item_title ) . '" />';

$categories = get_the_terms( get_the_ID(), 'wlgx_casestudy_category' );
$categories_slugs = array();
if ( ! is_array( $categories ) ) {
	$categories = array();
}
foreach ( $categories as $category ) {
	$classes .= ' ' . $category->slug;
	$categories_slugs[] = $category->slug;
}

$link = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
if ( $title_size != '' ) {
	$title_inner_css = ' style="font-size: ' . $title_size . '"';
}

if ( $meta_size != '' ) {
	$meta_inner_css = ' style="font-size: ' . $meta_size . '"';
}

$available_metas = array( 'title', 'date', 'categories', 'desc' );
$metas = ( isset( $metas ) AND is_array( $metas ) ) ? array_intersect( $metas, $available_metas ) : array( 'title' );
$meta_html = array_fill_keys( $metas, '' );
if ( in_array( 'title', $metas ) ) {
	$meta_html['title'] = '<h2 class="w-casestudy-item-title"' . $title_inner_css . '>' . get_the_title() . '</h2>';
}
if ( in_array( 'date', $metas ) ) {
	$meta_html['date'] = '<span class="w-casestudy-item-text"' . $meta_inner_css . '>' . get_the_date() . '</span>';
}
if ( in_array( 'categories', $metas ) AND count( $categories ) > 0 ) {
	$meta_html['categories'] = '<span class="w-casestudy-item-text"' . $meta_inner_css . '>';
	foreach ( $categories as $index => $category ) {
		$meta_html['categories'] .= ( ( $index > 0 ) ? ' / ' : '' ) . $category->name;
	}
	$meta_html['categories'] .= '</span>';
}
if ( in_array( 'desc', $metas ) ) {
	$meta_html['desc'] = '<span class="w-casestudy-item-text"' . $meta_inner_css . '>' . usof_meta( 'wlgx_tile_description' ) . '</span>';
}

if ( ! $is_widget ) {
	$classes .= ' size_' . $tile_size;
}


if ( $bg_color != '' ) {
	$anchor_inner_css .= 'background-color: ' . $bg_color . ';';
}
if ( usof_meta( 'wlgx_tile_bg_color' ) != '' ) {
	$anchor_inner_css .= 'background-color: ' . usof_meta( 'wlgx_tile_bg_color' ) . ';';
}


if ( $text_color != '' ) {
	$anchor_inner_css .= 'color: ' . $text_color . ';';
}


if ( usof_meta( 'wlgx_tile_text_color' ) != '' ) {
	$anchor_inner_css .= 'color: ' . usof_meta( 'wlgx_tile_text_color' ) . ';';
}

if ( $anchor_inner_css != '' ) {
	$anchor_inner_css = ' style="' . $anchor_inner_css . '"';
}

if ( usof_meta( 'wlgx_tile_text_color' ) != '' ) {
	$button_inner_css .= 'color: ' . usof_meta( 'wlgx_tile_text_color' ) . ';';
	$button_inner_css .= 'box-shadow: 0 0 0 2px ' . usof_meta( 'wlgx_tile_text_color' ) . ' inset !important;';
	
}
if ( $button_inner_css != '' ) {
	$button_inner_css = ' style="' . $button_inner_css . '"';
}
$classes = apply_filters( 'wlgx_casestudy_listing_item_classes', $classes );

$image2_id = usof_meta( 'wlgx_tile_additional_image' );

if ( $image2_id ) {
			$image2 = wp_get_attachment_url( $image2_id );
		}
		

$image_logo_id = usof_meta( 'wlgx_tile_logo_image' );	

if ( $image_logo_id ) {
			$image_logo = wp_get_attachment_url( $image_logo_id );
		}	

$featured_image_id = usof_meta( 'wlgx_tile_featured_image' );	

if ( $featured_image_id ) {
			$featured_image = wp_get_attachment_url( $featured_image_id );
}		
		
if ( usof_meta( 'wlgx_featured_action' ) == 'featured' ) {
	?>
    
	<div class="g-cols wpb_row type_boxes vc_inner feat-image-casestudy" style="background-image:url('<?php echo $featured_image; ?>') !important;"><div class="vc_col-sm-12 wpb_column vc_column_container"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="w-image"><div class="wlgx-frame"><img src="<?php echo $image_logo; ?>" class="attachment-full size-full" alt="" /></div></div><h2 id="<?php $titleStr= get_the_title(); $titleStr1 = str_replace(".","",$titleStr);$titleStr2 = str_replace(" ","_",$titleStr1); echo $titleStr2; ?>" class="vc_custom_heading case-study-title-h2"><?php echo get_the_title() ?></h2><div class="wpb_text_column "><div class="wpb_wrapper"><?php echo the_excerpt(50); ?></div> </div> <div class="wpb_text_column "><div class="wpb_wrapper"><p></p></div> </div> <div class="w-btn-wrapper align_left"><a class="w-btn style_outlined icon_none" <?php echo $button_inner_css ?> title="Read More" href="<?php echo $link ?>">
							<span class="w-btn-label" >Read More</span>
						</a></div></div></div></div></div>

    <?php
} 
?>






<!--
<div class="w-casestudy-item<?php echo $classes ?>" data-id="<?php the_ID() ?>" data-categories="<?php echo implode( ',', $categories_slugs ) ?>">
	<div class="w-casestudy-item-anchor" <?php echo $anchor_atts . $anchor_inner_css ?>>
		<div class="w-casestudy-item-image" style="background-image: url(<?php echo $image2 ?>)">
			<div class="w-casestudy-item-title-overlay" <?php echo $anchor_inner_css ?>>
            	<span class="w-casestudy-item-title-overlay-text">
                <?php echo get_the_title() ?>
                </span>
           	</div>
		</div>
		
		<div class="w-casestudy-item-image second">
        	<img src="<?php echo $image_logo ?>" />
           	 	<div class="text">
            		<?php echo the_excerpt(50); ?>
            	</div>
			</div>
		<?php if ( ! empty( $meta_html ) ): ?>
			<div class="w-casestudy-item-meta">
				<div class="w-casestudy-item-meta-h">
						<a class="w-btn style_outlined icon_none" <?php echo $button_inner_css ?> title="Read More" href="<?php echo $link ?>">
							<span class="w-btn-label" >Read More</span>
						</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
-->
