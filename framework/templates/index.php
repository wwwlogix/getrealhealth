<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Index template (used for front page blog listing)
 */
$wlgx_layout = wlgx_Layout::instance();
get_header();

$template_vars = array(
	'layout_type' => wlgx_get_option( 'blog_layout', 'classic' ),
	'masonry' => wlgx_get_option( 'blog_masonry', 0 ),
	'columns' => wlgx_get_option( 'blog_cols', 1 ),
	'metas' => wlgx_get_option( 'blog_meta', array() ),
	'content_type' => wlgx_get_option( 'blog_content_type', 'excerpt' ),
	'show_read_more' => in_array( 'read_more', wlgx_get_option( 'blog_meta', array() ) ),
	'pagination' => wlgx_get_option( 'blog_pagination', 'regular' ),
);
?>
<section class="l-section wpb_row height_auto color_custom with_img inner-header-image" style=" color: #ffffff;"><div class="l-section-img loaded" style="background-image: url(https://grhnew.wpengine.com/wp-content/uploads/2017/01/Dots-lines-blue_hero.png);" data-img-width="1920" data-img-height="500"></div><div class="l-section-h i-cf"><div class="g-cols type_default valign_middle"><div class="vc_col-sm-12 wpb_column vc_column_container"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="wpb_text_column "><div class="wpb_wrapper"><p></p>
<span style="height:100px; display:block;"></span>
<h1>Blog</h1>
<h1><p></p></h1></div> </div> </div></div></div></div></div></section>
	<div class="l-main">
		<div class="l-main-h i-cf">

			<main class="l-content" itemprop="mainContentOfPage">
				<section class="l-section">
					<div class="l-section-h i-cf">

						<?php do_action( 'wlgx_before_index' ) ?>

						<?php wlgx_load_template( 'templates/blog/listing', $template_vars ) ?>

						<?php do_action( 'wlgx_after_index' ) ?>

					</div>
				</section>
			</main>

			<?php if ( $wlgx_layout->sidebar_pos == 'left' OR $wlgx_layout->sidebar_pos == 'right' ): ?>
				<aside class="l-sidebar at_<?php echo $wlgx_layout->sidebar_pos ?>" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
					<?php dynamic_sidebar( 'default_sidebar' ) ?>
				</aside>
			<?php endif; ?>

		</div>
	</div>
<?php

get_footer();
