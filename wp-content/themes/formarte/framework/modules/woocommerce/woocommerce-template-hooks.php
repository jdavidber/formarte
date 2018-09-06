<?php

if (!function_exists('oxides_edge_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function oxides_edge_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (oxides_edge_options()->getOptionValue('edgtf_woo_products_per_page')) {
			$products_per_page = oxides_edge_options()->getOptionValue('edgtf_woo_products_per_page');
		}

		return $products_per_page;
	}
}

if (!function_exists('oxides_edge_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function oxides_edge_woocommerce_related_products_args($args) {

		if (oxides_edge_options()->getOptionValue('edgtf_woo_product_list_columns')) {

			$related = oxides_edge_options()->getOptionValue('edgtf_woo_product_list_columns');
			switch ($related) {
				case 'edgtf-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'edgtf-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}

		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;
	}
}

if (!function_exists('oxides_edge_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function oxides_edge_woocommerce_template_loop_product_title() {

		$tag = oxides_edge_options()->getOptionValue('edgtf_products_list_title_tag');
		the_title('<' . $tag . ' class="edgtf-product-list-product-title"><a href="'.get_the_permalink().'">', '</a></' . $tag . '>');
	}
}

if (!function_exists('oxides_edge_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function oxides_edge_woocommerce_template_single_title() {

		$tag = oxides_edge_options()->getOptionValue('edgtf_single_product_title_tag');
		the_title('<' . $tag . '  itemprop="name" class="edgtf-single-product-title">', '</' . $tag . '>');
	}
}

if (!function_exists('oxides_edge_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function oxides_edge_woocommerce_sale_flash() {

		return '<span class="edgtf-onsale"><span class="edgtf-onsale-inner">' . esc_html__('%', 'oxides') . '</span></span>';
	}
}

if (!function_exists('oxides_edge_woocommerce_loop_add_to_cart_link')) {
	/**
	 * Function that overrides default woocommerce add to cart button on product list
	 * Uses HTML from edgtf_button
	 *
	 * @return mixed|string
	 */
	function oxides_edge_woocommerce_loop_add_to_cart_link() {

		global $product;

		$button_url = $product->add_to_cart_url();
		$button_classes = sprintf('%s product_type_%s',
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			esc_attr( $product->product_type )
		);
		$button_text = $product->add_to_cart_text();
		$button_attrs = array(
			'rel' => 'nofollow',
			'data-product_id' => esc_attr( $product->id ),
			'data-product_sku' => esc_attr( $product->get_sku() ),
			'data-quantity' => esc_attr( isset( $quantity ) ? $quantity : 1 )
		);


		$add_to_cart_button = oxides_edge_get_button_html(
			array(
				'link'			=> $button_url,
				'custom_class'	=> $button_classes,
				'text'			=> $button_text,
				'custom_attrs'	=> $button_attrs
			)
		);

		return $add_to_cart_button;
	}
}