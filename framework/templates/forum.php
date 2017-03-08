<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * The template for displaying all single posts and attachments
 */
$wlgx_layout = wlgx_Layout::instance();

$wlgx_layout->sidebar_pos = wlgx_get_option( 'forum_sidebar', 'none' );
$wlgx_layout->titlebar = ( wlgx_get_option( 'titlebar_content', 'all' ) == 'hide' ) ? 'none' : 'default';

get_header();
wlgx_load_template( 'templates/titlebar' );
$default_forum_sidebar_id = wlgx_get_option( 'forum_sidebar_id', 'default_sidebar' );
?>
<div class="l-main">
	<div class="l-main-h i-cf">

		<main class="l-content" itemprop="mainContentOfPage">
			<section class="l-section for_forum">
				<div class="l-section-h i-cf">
					<?php do_action( 'wlgx_before_single' ) ?>

					<?php
					while ( have_posts() ) {
						the_post();

						the_content();
					}
					?>

					<?php do_action( 'wlgx_after_single' ) ?>
				</div>
			</section>
		</main>

		<?php if ( $wlgx_layout->sidebar_pos == 'left' OR $wlgx_layout->sidebar_pos == 'right' ): ?>
			<aside class="l-sidebar at_<?php echo $wlgx_layout->sidebar_pos . ' ' . wlgx_dynamic_sidebar_id( $default_forum_sidebar_id ); ?>" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
				<?php wlgx_dynamic_sidebar( $default_forum_sidebar_id ); ?>
			</aside>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
