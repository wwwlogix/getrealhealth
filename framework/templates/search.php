<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * The template for displaying search results pages
 */

$wlgx_layout = wlgx_Layout::instance();
// Needed for canvas class
$wlgx_layout->titlebar = ( wlgx_get_option( 'titlebar_archive_content', 'all' ) == 'hide' ) ? 'none' : 'default';
$wlgx_layout->sidebar_pos = wlgx_get_option( 'search_sidebar', 'right' );
get_header();

// Creating .l-titlebar
wlgx_load_template(
	'templates/titlebar', array(
	'title' => __( 'Search Results for', 'wlgx' ) . ' &quot;' . esc_attr( get_search_query() ) . '&quot;',
)
);

$template_vars = array(
	'layout_type' => wlgx_get_option( 'search_layout', 'compact' ),
	'masonry' => wlgx_get_option( 'search_masonry', 0 ),
	'columns' => wlgx_get_option( 'search_cols', 1 ),
	'metas' => (array) wlgx_get_option( 'search_meta', array() ),
	'content_type' => wlgx_get_option( 'search_content_type', 'excerpt' ),
	'show_read_more' => in_array( 'read_more', (array) wlgx_get_option( 'search_meta', array() ) ),
	'pagination' => wlgx_get_option( 'search_pagination', 'regular' ),
);
?>
	<div class="l-main">
		<div class="l-main-h i-cf">

			<main class="l-content" itemprop="mainContentOfPage">
				<section class="l-section">
					<div class="l-section-h i-cf">

						<?php do_action( 'wlgx_before_search' ) ?>

						<?php wlgx_load_template( 'templates/blog/listing', $template_vars ) ?>

						<?php do_action( 'wlgx_after_search' ) ?>

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
