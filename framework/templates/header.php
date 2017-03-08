<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Template header
 */
$wlgx_layout = wlgx_Layout::instance();
?>
<!DOCTYPE HTML>
<html class="<?php echo $wlgx_layout->html_classes() ?>" <?php language_attributes( 'html' ) ?>>
<head>
	<meta charset="UTF-8">

	<?php /* Don't remove the semicolon in the title tag below: it's needed for Theme Check */ ?>
	<title><?php wp_title( '' ); ?></title>

	<?php wp_head() ?>
	<script type='application/ld+json'> 
        {
          "@context": "http://www.schema.org",
          "@type": "Organization",
          "name": "Get Real Health",
          "url": "http://www.getrealhealth.com/",
          "description": "Get Real Health is a healthcare IT company and digital innovator that develops software products for health management applications.",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "51 Monroe St., Ste 1501",
            "addressLocality": "Rockville",
            "addressRegion": "Maryland",
            "postalCode": "20850",
            "addressCountry": "USA"
          },
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+1(301)309-0058",
            "contactType": "Sales"
          }
        }
	</script>
	<script src="https://use.typekit.net/dtx3yxe.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
    <script>
  (function(d) {
    var config = {
      kitId: 'dtx3yxe',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-32492304-3', 'auto');
  ga('send', 'pageview');

</script>
	<?php global $wlgx_generate_css_file;
	if ( ! isset( $wlgx_generate_css_file ) OR ! $wlgx_generate_css_file ): ?>
		<style id='wlgx-theme-options-css' type="text/css"><?php wlgx_load_template( 'templates/theme-options.min.css' ) ?></style>
	<?php endif; ?>
</head>
<body <?php body_class( 'l-body ' . $wlgx_layout->body_classes() ) ?><?php echo $wlgx_layout->body_styles() ?> itemscope="itemscope" itemtype="https://schema.org/WebPage">
<?php if ( wlgx_get_option( 'preloader' ) != 'disabled' ) {
	add_action( 'wlgx_before_canvas', 'wlgx_display_preloader', 100 );
	function wlgx_display_preloader() {
		$preloader_type = wlgx_get_option( 'preloader' );
		if ( ! in_array( $preloader_type, array( 1, 2, 3, 4, 5, 6, 7, 'custom' ) ) ) {
			$preloader_type = 1;
		}
		$preloader_type_class = ' type_' . $preloader_type;

		$preloader_image = wlgx_get_option( 'preloader_image' );
		$preloader_image_html = '';
		$img = usof_get_image_src( $preloader_image, 'medium' );
		if ( $img[0] != '' ) {
			$preloader_image_html .= '<img src="' . esc_url( $img[0] ) . '"';
			if ( ! empty( $img[1] ) AND ! empty( $img[2] ) ) {
				// Image sizes may be missing when logo is a direct URL
				$preloader_image_html .= ' width="' . $img[1] . '" height="' . $img[2] . '"';
			}
			$preloader_image_html .= ' alt="" />';
		}

		?>
		<div class='l-preloader'><?php echo "<div class='l-preloader-spinner'><div class='g-preloader " . $preloader_type_class . "'><div class='g-preloader-h'>" . $preloader_image_html . "</div></div></div>"; ?></div>
		<?php
	}
}

do_action( 'wlgx_before_canvas' ) ?>

<div class="l-canvas <?php echo $wlgx_layout->canvas_classes() ?>">

	<?php if ( $wlgx_layout->header_show != 'never' ): ?>

		<?php do_action( 'wlgx_before_header' ) ?>

		<?php wlgx_load_template( 'templates/l-header' ) ?>

		<?php do_action( 'wlgx_after_header' ) ?>

	<?php endif/*( $wlgx_layout->header_show != 'never' )*/
	; ?>
