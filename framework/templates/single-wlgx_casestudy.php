<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * The template for displaying all single posts and attachments
 */
$wlgx_layout = wlgx_Layout::instance();
get_header();

$post_type = get_post_type();
if ( $post_type == 'wlgx_casestudy' ) {
	$template_vars = array(
		'title' => wlgx_get_option( 'titlebar_post_title', 'CaseStudy' ),
	);
	wlgx_load_template( 'templates/titlebar', $template_vars );
} elseif ( in_array( $post_type, wlgx_get_option( 'custom_post_types_support', array() ) ) ) {
	wlgx_load_template( 'templates/titlebar' );
}

$template_vars = array(
	'metas' => (array) wlgx_get_option( 'post_meta', array() ),
	'show_tags' => in_array( 'tags', wlgx_get_option( 'post_meta', array() ) ),
);

?>
<div class="l-main">
	<div class="l-main-h i-cf">

		<main class="l-content" itemprop="mainContentOfPage">

			<?php do_action( 'wlgx_before_single' ) ?>

			<?php
			while ( have_posts() ) {
				the_post();

				wlgx_load_template( 'templates/blog/single-post-casestudy', $template_vars );
			}
			?>

			<?php do_action( 'wlgx_after_single' ) ?>

		</main>

		<?php if ( $wlgx_layout->sidebar_pos == 'left' OR $wlgx_layout->sidebar_pos == 'right' ): ?>
			<aside class="l-sidebar at_<?php echo $wlgx_layout->sidebar_pos . ' ' . wlgx_dynamic_sidebar_id(); ?>" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
				<?php wlgx_dynamic_sidebar(); ?>
			</aside>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
