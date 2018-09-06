<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php

global $woocommerce;

$id = get_option('woocommerce_shop_page_id');
$shop = get_post($id);
$sidebar = oxides_edge_sidebar_layout();

if(get_post_meta($id, 'edgt_page_background_color', true) != ''){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, 'edgt_page_background_color', true));
}else{
	$background_color = '';
}

$content_style = '';
if(get_post_meta($id, 'edgt_content-top-padding', true) != '') {
	if(get_post_meta($id, 'edgt_content-top-padding-mobile', true) == 'yes') {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'edgt_content-top-padding', true)).'px !important';
	} else {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'edgt_content-top-padding', true)).'px';
	}
}

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

get_header();

get_template_part( 'title' );
get_template_part('slider');

$full_width = false;

if ( oxides_edge_options()->getOptionValue('edgtf_woo_products_list_full_width') == 'yes' && !is_singular('product') ) {
	$full_width = true;
}

if ( $full_width ) { ?>
	<div class="edgtf-full-width" <?php oxides_edge_inline_style($background_color); ?>>
<?php } else { ?>
	<div class="edgtf-container" <?php oxides_edge_inline_style($background_color); ?>>
<?php }
		if ( $full_width ) { ?>
			<div class="edgtf-full-width-inner" <?php oxides_edge_inline_style($content_style); ?>>
		<?php } else { ?>
			<div class="edgtf-container-inner clearfix" <?php oxides_edge_inline_style($content_style); ?>>
		<?php }

			//Woocommerce content
			if ( ! is_singular('product') ) {

				switch( $sidebar ) {
					case 'sidebar-33-right': ?>
						<div class="edgtf-two-columns-66-33 grid2 edgtf-woocommerce-with-sidebar clearfix">
							<div class="edgtf-column1">
								<div class="edgtf-column-inner">
									<?php oxides_edge_woocommerce_content(); ?>
								</div>
							</div>
							<div class="edgtf-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-right': ?>
						<div class="edgtf-two-columns-75-25 grid2 edgtf-woocommerce-with-sidebar clearfix">
							<div class="edgtf-column1 edgtf-content-left-from-sidebar">
								<div class="edgtf-column-inner">
									<?php oxides_edge_woocommerce_content(); ?>
								</div>
							</div>
							<div class="edgtf-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-33-left': ?>
						<div class="edgtf-two-columns-33-66 grid2 edgtf-woocommerce-with-sidebar clearfix">
							<div class="edgtf-column1">
								<?php get_sidebar();?>
							</div>
							<div class="edgtf-column2">
								<div class="edgtf-column-inner">
									<?php oxides_edge_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-left': ?>
						<div class="edgtf-two-columns-25-75 grid2 edgtf-woocommerce-with-sidebar clearfix">
							<div class="edgtf-column1">
								<?php get_sidebar();?>
							</div>
							<div class="edgtf-column2 edgtf-content-right-from-sidebar">
								<div class="edgtf-column-inner">
									<?php oxides_edge_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					default:
						oxides_edge_woocommerce_content();
				}

			} else {
				oxides_edge_woocommerce_content();
			} ?>

			</div>
	</div>
<?php get_footer(); ?>
