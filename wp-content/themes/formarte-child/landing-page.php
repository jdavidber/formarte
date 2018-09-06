<?php
/*
Template Name: Maintenance Page
*/
$sidebar = oxides_edge_sidebar_layout();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php oxides_edge_wp_title(); ?>

        <?php
        /**
         * oxides_edge_header_meta hook
         *
         * @see oxides_edge_header_meta() - hooked with 10
         * @see edgt_user_scalable_meta() - hooked with 10
         */
        do_action('oxides_edge_header_meta');
        ?>

        <?php wp_head(); ?>
    </head>

<body id="frmt-landing" <?php body_class(); ?>>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-K244CN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K244CN');</script>
<!-- End Google Tag Manager -->
<div class="edgtf-wrapper">
	<div class="edgtf-wrapper-inner">
		<div class="edgtf-content">
			<div class="edgtf-content-inner">
				<div class="edgtf-full-width">
					<div class="edgtf-full-width-inner">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
<script type="text/javascript">
	function gotoCity(ciudad, url){
	    var ciudad = ciudad.toUpperCase();
		localStorage.setItem('ciudad', ciudad);
		location.href = url;
	};
</script>
</body>
</html>
