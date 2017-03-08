<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * The template for displaying the 404 page
 */
wlgx_Layout::instance()->sidebar_pos = 'none';
?>
<?php get_header() ?>
<div class="l-main">
	<div class="l-main-h i-cf">

		<div class="l-content">

			<section class="l-section">
				<div class="l-section-h i-cf">

					<?php do_action( 'wlgx_before_404' ) ?>

					<div class="page-404">

						<?php

						$the_content = '<h1>' . wlgx_translate_with_external_domain( 'Page not found' ) . '</h1><p>' . __( 'The link you followed may be broken, or the page may have been removed.', 'wlgx' ) . '</p>';
						echo apply_filters( 'wlgx_404_content', $the_content );

						?>

					</div>

					<?php do_action( 'wlgx_after_404' ) ?>

				</div>
			</section>

		</div>

	</div>
</div>
<?php get_footer() ?>
