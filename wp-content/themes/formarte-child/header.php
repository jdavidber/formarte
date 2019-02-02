<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php oxides_edge_wp_title(); ?>
    <?php
    /**
     * @see oxides_edge_header_meta() - hooked with 10
     * @see edgt_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('oxides_edge_header_meta'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<script>
    dataLayer = [];
</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-K244CN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K244CN');</script>
<!-- End Google Tag Manager -->
<script>
function pushTag(vpv){
    dataLayer.push({
        'event':'enviarPaginaVirtual',
        'vpv': vpv
    });
};
</script>

<?php oxides_edge_get_side_area(); ?>

<div class="edgtf-wrapper">
    <div class="edgtf-wrapper-inner">
        <?php oxides_edge_get_header(); ?>

        <?php if(oxides_edge_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='edgtf-back-to-top'  href='#'>
                <span class="edgtf-icon-stack">
                    <span class="line-1"></span>
                    <span class="line-2"></span>
                    <span class="line-3"></span>
                </span>
            </a>
        <?php } ?>
        <?php oxides_edge_get_full_screen_menu(); ?>

        <div class="edgtf-content" <?php oxides_edge_content_elem_style_attr(); ?>>
            <div class="edgtf-content-inner">
