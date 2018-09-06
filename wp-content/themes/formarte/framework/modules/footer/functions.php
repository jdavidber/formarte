<?php

if (!function_exists('oxides_edge_get_footer_classes')) {
	/**
	 * Return all footer classes
	 *
	 * @param $page_id
	 * @return string|void
	 */
	function oxides_edge_get_footer_classes($page_id) {

		$footer_classes                     = '';
		$footer_classes_array               = array();

		//is uncovering footer option set in theme options?
		if(oxides_edge_options()->getOptionValue('uncovering_footer') == 'yes') {
			$footer_classes_array[] = 'edgtf-footer-uncover';
		}

		if(get_post_meta($page_id, 'edgtf_disable_footer_meta', true) == 'yes'){
			$footer_classes_array[] = 'edgtf-disable-footer';
		}

		//is some class added to footer classes array?
		if(is_array($footer_classes_array) && count($footer_classes_array)) {
			//concat all classes and prefix it with class attribute
			$footer_classes = esc_attr(implode(' ', $footer_classes_array));
		}

		return $footer_classes;

	}

}

if(!function_exists('oxides_edge_get_footer_top_border')) {
	/**
	 * Return HTML for footer top border
	 *
	 * @return string
	 */
	function oxides_edge_get_footer_top_border() {

		$footer_top_border = '';

		if (oxides_edge_options()->getOptionValue('footer_top_border_color')) {
			if (oxides_edge_options()->getOptionValue('footer_top_border_width') !== '') {
				$footer_border_height = oxides_edge_options()->getOptionValue('footer_top_border_width');
			} else {
				$footer_border_height = '1';
			}

			$footer_top_border = 'height: '.esc_attr($footer_border_height).'px; background-color: '.esc_attr(oxides_edge_options()->getOptionValue('footer_top_border_color')).';';
		}

		return $footer_top_border;
	}
}

if(!function_exists('oxides_edge_get_footer_bottom_border')) {
	/**
	 * Return HTML for footer bottom border top
	 *
	 * @return string
	 */
	function oxides_edge_get_footer_bottom_border() {

		$footer_bottom_border = '';

		if (oxides_edge_options()->getOptionValue('footer_bottom_border_color')) {
			if (oxides_edge_options()->getOptionValue('footer_bottom_border_width') !== '') {
				$footer_border_height = oxides_edge_options()->getOptionValue('footer_bottom_border_width');
			} else {
				$footer_border_height = '1';
			}

			$footer_bottom_border = 'height: '.esc_attr($footer_border_height).'px; background-color: '.esc_attr(oxides_edge_options()->getOptionValue('footer_bottom_border_color')).';';
		}

		return $footer_bottom_border;
	}
}


if(!function_exists('oxides_edge_get_footer_bottom_bottom_border')) {
	/**
	 * Return HTML for footer bottom border bottom
	 *
	 * @return string
	 */
	function oxides_edge_get_footer_bottom_bottom_border() {

		$footer_bottom_border = '';

		if (oxides_edge_options()->getOptionValue('footer_bottom_border_bottom_color')) {
			if (oxides_edge_options()->getOptionValue('footer_bottom_border_bottom_width') !== '') {
				$footer_border_height = oxides_edge_options()->getOptionValue('footer_bottom_border_bottom_width');
			} else {
				$footer_border_height = '1';
			}

			$footer_bottom_border = 'height: '.esc_attr($footer_border_height).'px; background-color: '.esc_attr(oxides_edge_options()->getOptionValue('footer_bottom_border_bottom_color')).';';
		}

		return $footer_bottom_border;
	}
}

if(!function_exists('oxides_edge_get_footer_side_padding')) {
    /**
     * Return side padding if footer in grid is off
     *
     * @return array
     */
    function oxides_edge_get_footer_side_padding() {

        $footer_side_padding = '';
        $footer_side_padding_array = array();

        if (oxides_edge_options()->getOptionValue('footer_in_grid') == 'no') {
            if (oxides_edge_options()->getOptionValue('footer_side_padding') !== '') {
                $footer_side_padding = oxides_edge_options()->getOptionValue('footer_side_padding');
                $footer_side_padding_array[] = 'padding-left:'.oxides_edge_filter_px($footer_side_padding).'px';
                $footer_side_padding_array[] = 'padding-right:'.oxides_edge_filter_px($footer_side_padding).'px';
            }
        }

        return $footer_side_padding_array;
    }
}
