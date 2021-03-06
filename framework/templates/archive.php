<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * The template for displaying archive pages
 */
$wlgx_layout = wlgx_Layout::instance();
// Needed for canvas class
$wlgx_layout->titlebar = ( wlgx_get_option( 'titlebar_archive_content', 'all' ) == 'hide' ) ? 'none' : 'default';
get_header();

// Creating .l-titlebar
$titlebar_vars = array(
	'title' => get_the_archive_title(),
);
if ( is_category() OR is_tax() ) {
	$term = get_queried_object();
	if ( $term ) {
		$taxonomy = $term->taxonomy;
		$term = $term->term_id;
	}
	$titlebar_vars['subtitle'] = nl2br( get_term_field( 'description', $term, $taxonomy, 'edit' ) );
}
wlgx_load_template( 'templates/archive-titlebar', $titlebar_vars );

$template_vars = array(
	'layout_type' => wlgx_get_option( 'archive_layout', 'smallcircle' ),
	'masonry' => wlgx_get_option( 'archive_masonry', 0 ),
	'columns' => wlgx_get_option( 'archive_cols', 1 ),
	'metas' => (array) wlgx_get_option( 'archive_meta', array() ),
	'content_type' => wlgx_get_option( 'archive_content_type', 'excerpt' ),
	'show_read_more' => in_array( 'read_more', wlgx_get_option( 'archive_meta', array() ) ),
	'pagination' => wlgx_get_option( 'archive_pagination', 'regular' ),
);

?>
	<div class="l-main">
		<div class="l-main-h i-cf">

			<main class="l-content" itemprop="mainContentOfPage">
				<section class="l-section">
					<div class="l-section-h i-cf">

						<?php do_action( 'wlgx_before_archive' ) ?>

						<?php wlgx_load_template( 'templates/blog/listing', $template_vars ) ?>

						<?php do_action( 'wlgx_after_archive' ) ?>

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
