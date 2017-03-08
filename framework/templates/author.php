<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * The template for displaying archive pages
 */
$wlgx_layout = wlgx_Layout::instance();
// Needed for canvas class
$wlgx_layout->titlebar = ( wlgx_get_option( 'titlebar_archive_content', 'all' ) == 'hide' ) ? 'none' : 'default';
get_header();

$curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );

// Creating .l-titlebar
$titlebar_vars = array(
	'title' => get_the_archive_title(),
);

wlgx_load_template( 'templates/titlebar', $titlebar_vars );

$template_vars = array(
	'layout_type' => wlgx_get_option( 'archive_layout', 'smallcircle' ),
	'columns' => wlgx_get_option( 'archive_cols', 1 ),
	'metas' => (array) wlgx_get_option( 'archive_meta', array() ),
	'content_type' => wlgx_get_option( 'archive_content_type', 'excerpt' ),
	'show_read_more' => in_array( 'read_more', wlgx_get_option( 'archive_meta', array() ) ),
	'pagination' => wlgx_get_option( 'archive_pagination', 'regular' ),
);

$author_avatar = get_avatar( $curauth->ID );
global $wpdb;
$author_comments_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) AS total FROM " . $wpdb->comments . " WHERE comment_approved = 1 AND user_id = %s", $curauth->ID ) );

?>
	<div class="l-main">
		<div class="l-main-h i-cf">

			<main class="l-content" itemprop="mainContentOfPage">
				<section class="l-section">
					<div class="l-section-h i-cf">

						<div class="w-author" itemscope="itemscope" itemtype="https://schema.org/Person" itemprop="author">
							<div class="w-author-img">
								<?php echo $author_avatar ?>
							</div>
							<div class="w-author-meta">
								<?php echo sprintf( _n( '%s post', '%s posts', count_user_posts( $curauth->ID ), 'wlgx' ), count_user_posts( $curauth->ID ) ) . ', ' . sprintf( _n( '%s comment', '%s comments', $author_comments_count, 'wlgx' ), $author_comments_count ) ?>
							</div>
							<div class="w-author-url" itemprop="url">
								<?php if ( get_the_author_meta( 'url' ) ) { ?>
									<a href="<?php echo esc_url( get_the_author_meta( 'url' ) ); ?>"><?php echo esc_url( get_the_author_meta( 'url' ) ); ?></a>
								<?php } ?>
							</div>
							<div class="w-author-desc" itemprop="description"><?php the_author_meta( 'description' ) ?></div>
						</div>

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
