<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

$wlgx_layout = wlgx_Layout::instance();
?>
</div>

<?php if ( $wlgx_layout->footer_show_top OR $wlgx_layout->footer_show_bottom ) { ?>

	<?php do_action( 'wlgx_before_footer' ) ?>

	<?php
	$footer_classes = '';
	$footer_layout = wlgx_get_option( 'footer_layout' );
	if ( $footer_layout != NULL ) {
		$footer_classes .= ' layout_' . $footer_layout;
	}
	?>
	<footer class="l-footer<?php echo $footer_classes; ?>" itemscope="itemscope" itemtype="https://schema.org/WPFooter">

		<?php if ( $wlgx_layout->footer_show_top ): ?>
			<div class="l-subfooter at_top">
				<div class="l-subfooter-h i-cf">

					<?php do_action( 'wlgx_top_subfooter_start' ) ?>

					<div class="g-cols type_default vc_column-gap-20">
                    	<div class="vc_col-sm-3 wpb_column vc_column_container footer-1">
								<div class="vc_column-inner">
									<div class="wpb_wrapper">
										<?php dynamic_sidebar( 'footer_first' ) ?>
									</div>
								</div>
							</div>
                        <div class="vc_col-sm-1 wpb_column vc_column_container footer-2">
								<div class="vc_column-inner">
									<div class="wpb_wrapper">
										<?php dynamic_sidebar( 'footer_second' ) ?>
									</div>
								</div>
							</div>
                        <div class="vc_col-sm-1 wpb_column vc_column_container footer-3">
								<div class="vc_column-inner">
									<div class="wpb_wrapper">
										<?php dynamic_sidebar( 'footer_third' ) ?>
									</div>
								</div>
							</div>
                        <div class="vc_col-sm-1 wpb_column vc_column_container footer-4">
								<div class="vc_column-inner">
									<div class="wpb_wrapper">
										<?php dynamic_sidebar( 'footer_fourth' ) ?>
									</div>
								</div>
							</div>
                        <div class="vc_col-sm-2 wpb_column vc_column_container footer-5">
								<div class="vc_column-inner">
									<div class="wpb_wrapper">
										<?php dynamic_sidebar( 'footer_fifth' ) ?>
									</div>
								</div>
							</div>
                        <div class="vc_col-sm-3 wpb_column vc_column_container footer-6">
								<div class="vc_column-inner">
									<div class="wpb_wrapper">
										<?php dynamic_sidebar( 'footer_sixth' ) ?>
									</div>
								</div>
							</div>
                            
						
					</div>

					<?php do_action( 'wlgx_top_subfooter_end' ) ?>

				</div>
			</div>
		<?php endif/*( $wlgx_layout->footer_show_top )*/
		; ?>

		<?php if ( $wlgx_layout->footer_show_bottom ): ?>
			<div class="l-subfooter at_bottom">
				<div class="l-subfooter-h i-cf">

					<?php do_action( 'wlgx_bottom_subfooter_start' ) ?>
                    

					<?php dynamic_sidebar( 'bottom_footer_social_sidebar' ) ?>

					<div class="w-copyright">
                    	<div class="w-copyright-text">
							<?php echo wlgx_get_option( 'footer_copyright', '' ) ?>
                            	
                        </div>
                        <div class="w-menu">
                        <span>All Rights Reserved</span>
                        <?php 
					if ( ( $locations = get_nav_menu_locations() ) && isset( $locations['wlgx_footer_menu'] ) ) {
						wlgx_load_template(
							'templates/elements/additional_menu', array(
							'source' => $locations['wlgx_footer_menu'],
							'text_size' => '',
							'indents' => '',
						)
						);
					}
					?>
                    </div>
				</div> 
                 
                    
					<?php do_action( 'wlgx_bottom_subfooter_end' ) ?>

				</div>
			</div>
		<?php endif/*( $wlgx_layout->footer_show_bottom )*/
		; ?>

	</footer>

	<?php do_action( 'wlgx_after_footer' ) ?>

<?php }/*( $wlgx_layout->footer_show_top OR $wlgx_layout->footer_show_bottom )*/; ?>

<a class="w-header-show" href="javascript:void(0);"></a>
<a class="w-toplink" href="#" title="<?php _e( 'Back to top', 'wlgx' ); ?>"></a>
<script type="text/javascript">
	if (window.$us === undefined) window.$us = {};
	$us.canvasOptions = ($us.canvasOptions || {});
	$us.canvasOptions.disableEffectsWidth = <?php echo intval( wlgx_get_option( 'disable_effects_width', 900 ) ) ?>;
	$us.canvasOptions.responsive = <?php echo wlgx_get_option( 'responsive_layout', TRUE ) ? 'true' : 'false' ?>;

	$us.langOptions = ($us.langOptions || {});
	$us.langOptions.magnificPopup = ($us.langOptions.magnificPopup || {});
	$us.langOptions.magnificPopup.tPrev = '<?php _e( 'Previous (Left arrow key)', 'wlgx' ); ?>'; // Alt text on left arrow
	$us.langOptions.magnificPopup.tNext = '<?php _e( 'Next (Right arrow key)', 'wlgx' ); ?>'; // Alt text on right arrow
	$us.langOptions.magnificPopup.tCounter = '<?php _ex( '%curr% of %total%', 'Example: 3 of 12' , 'wlgx' ); ?>'; // Markup for "1 of 7" counter

	$us.navOptions = ($us.navOptions || {});
	$us.navOptions.mobileWidth = <?php echo intval( wlgx_get_option( 'menu_mobile_width', 900 ) ) ?>;
	$us.navOptions.togglable = <?php echo wlgx_get_option( 'menu_togglable_type', TRUE ) ? 'true' : 'false' ?>;
	$us.ajaxLoadJs = <?php echo wlgx_get_option( 'ajax_load_js', 0 ) ? 'true' : 'false' ?>;
	$us.templateDirectoryUri = '<?php global $wlgx_template_directory_uri; echo $wlgx_template_directory_uri; ?>';
</script>
<?php wp_footer(); ?>
</body>
</html>
