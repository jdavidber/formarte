<?php

if ( ! function_exists('oxides_edge_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function oxides_edge_load_elements_map() {

		oxides_edge_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-star'
			)
		);

		do_action( 'oxides_edge_options_elements_map' );

	}

	add_action('oxides_edge_options_map', 'oxides_edge_load_elements_map', 16);

}