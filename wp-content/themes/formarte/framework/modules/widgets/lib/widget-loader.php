<?php

if (!function_exists('oxides_edge_register_widgets')) {

	function oxides_edge_register_widgets() {

		$widgets = array(
			'EdgeOxidesOxidesFullScreenMenuOpener',
			'EdgeOxidesOxidesLatestPosts',
			'EdgeOxidesSearchOpener',
			'EdgeOxidesSideAreaOpener',
			'EdgeOxidesStickySidebar',
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}

	}

}

add_action('widgets_init', 'oxides_edge_register_widgets');