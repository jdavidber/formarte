<?php

if(!function_exists('oxides_edge_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function oxides_edge_header_class($classes) {
        $header_type = 'header-standard';

        $classes[] = 'edgtf-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'oxides_edge_header_class');
}

if(!function_exists('oxides_edge_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function oxides_edge_header_behaviour_class($classes) {

        $classes[] = 'edgtf-'.oxides_edge_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'oxides_edge_header_behaviour_class');
}

if (!function_exists('oxides_edge_header_top_class')) {

    function oxides_edge_header_top_class( $classes ) {

        if (oxides_edge_get_meta_field_intersect('top_bar') == 'yes' ) {
            $classes[] = 'edgtf-header-top-is-enabled';
        }

        return $classes;

    }

    add_filter('body_class', 'oxides_edge_header_top_class');

}

if(!function_exists('oxides_edge_menu_item_icon_position_class')) {
    /**
     * Function that adds menu item icon position class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added menu item icon position class
     */
    function oxides_edge_menu_item_icon_position_class($classes) {

        if(oxides_edge_options()->getOptionValue('menu_item_icon_position') == 'top'){
            $classes[] = 'edgtf-menu-with-large-icons';
        }

        return $classes;
    }

    add_filter('body_class', 'oxides_edge_menu_item_icon_position_class');
}

if(!function_exists('oxides_edge_mobile_header_class')) {
    function oxides_edge_mobile_header_class($classes) {
        $classes[] = 'edgtf-default-mobile-header';

        $classes[] = 'edgtf-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'oxides_edge_mobile_header_class');
}

if(!function_exists('oxides_edge_header_class_first_level_bg_color')) {
    /**
     * Function that adds first level menu background color class to header tag
     * @param array array of classes from main filter
     * @return array array of classes with added first level menu background color class
     */
    function oxides_edge_header_class_first_level_bg_color($classes) {

        //check if first level hover background color is set
        if(oxides_edge_options()->getOptionValue('menu_hover_background_color') !== ''){
            $classes[]= 'edgtf-menu-item-first-level-bg-color';
        }

        return $classes;
    }

    add_filter('body_class', 'oxides_edge_header_class_first_level_bg_color');
}

if (!function_exists('oxides_edge_header_skin_class')) {

    function oxides_edge_header_skin_class( $classes ) {

        $id = oxides_edge_get_page_id();

        if(is_404()){
            if(oxides_edge_options()->getOptionValue('404_skin') != ''){
                $classes[] = 'edgtf-'.oxides_edge_options()->getOptionValue('404_skin').'-header';
            }
        } else if(get_post_meta($id, 'edgtf_header_style_meta', true) !== ''){
            $classes[] = 'edgtf-' . get_post_meta($id, 'edgtf_header_style_meta', true);    
		} else if ( oxides_edge_options()->getOptionValue('header_style') !== '' ) {
            $classes[] = 'edgtf-' . oxides_edge_options()->getOptionValue('header_style');
        }

        return $classes;

    }

    add_filter('body_class', 'oxides_edge_header_skin_class');
}

if (!function_exists('oxides_edge_header_scroll_style_class')) {

	function oxides_edge_header_scroll_style_class( $classes ) {

		if (oxides_edge_get_meta_field_intersect('enable_header_style_on_scroll') == 'yes' ) {
			$classes[] = 'edgtf-header-style-on-scroll';
		}

		return $classes;

	}

	add_filter('body_class', 'oxides_edge_header_scroll_style_class');
}

if(!function_exists('oxides_edge_header_global_js_var')) {
    function oxides_edge_header_global_js_var($global_variables) {

        $global_variables['edgtfTopBarHeight'] = oxides_edge_get_top_bar_height();
        $global_variables['edgtfStickyHeaderHeight'] = oxides_edge_get_sticky_header_height();
        $global_variables['edgtfStickyHeaderTransparencyHeight'] = oxides_edge_get_sticky_header_height_of_complete_transparency();

        return $global_variables;
    }

    add_filter('oxides_edge_js_global_variables', 'oxides_edge_header_global_js_var');
}

if(!function_exists('oxides_edge_header_per_page_js_var')) {
    function oxides_edge_header_per_page_js_var($perPageVars) {

        $perPageVars['edgtfStickyScrollAmount'] = oxides_edge_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('oxides_edge_per_page_js_vars', 'oxides_edge_header_per_page_js_var');
}

if(!function_exists('oxides_edge_header_class_set_slider_meta_position')) {
    function oxides_edge_header_class_set_slider_meta_position($classes) {
        $id = oxides_edge_get_page_id();

        if(get_post_meta($id, 'edgtf_page_slider_meta', true) !== '' && get_post_meta($id, 'edgtf_page_slider_meta_position', true) === 'yes'){
            $classes[]= 'edgtf-slider-position-is-behind-header';
        }

        return $classes;
    }

    add_filter('body_class', 'oxides_edge_header_class_set_slider_meta_position');
}