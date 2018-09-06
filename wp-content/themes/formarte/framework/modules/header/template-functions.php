<?php

use EdgeOxidesfModules\Header\Lib\HeaderFactory;

if(!function_exists('oxides_edge_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines oxides_edge_header_type_parameters filter
     */
    function oxides_edge_get_header() {

        //will be read from options
        $header_type     = 'header-standard';
        $header_behavior = oxides_edge_options()->getOptionValue('header_behaviour');

        extract(oxides_edge_get_page_options());

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => oxides_edge_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'show_sticky'        => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
                'menu_area_background_color' => $menu_area_background_color
            );

            $parameters = apply_filters('oxides_edge_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('oxides_edge_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function oxides_edge_get_header_top() {

        //generate column width class
        switch(oxides_edge_options()->getOptionValue('top_bar_layout')) {
            case ('two-columns'):
                $column_widht_class = '50-50';
                break;
            case ('three-columns'):
                $column_widht_class = oxides_edge_options()->getOptionValue('top_bar_column_widths');
                break;
        }

        $params = array(
            'column_widths'      => $column_widht_class,
            'show_widget_center' => oxides_edge_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
            'show_header_top'    => oxides_edge_options()->getOptionValue('top_bar') == 'yes' ? true : false,
            'top_bar_in_grid'    => oxides_edge_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
        );

        $params = apply_filters('oxides_edge_header_top_params', $params);

        oxides_edge_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('oxides_edge_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function oxides_edge_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-standard';

        if($slug == 'sticky'){
            $logo_image = oxides_edge_options()->getOptionValue('logo_image_sticky');
        }else{
            $logo_image = oxides_edge_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = oxides_edge_options()->getOptionValue('logo_image_dark');
        $logo_image_light = oxides_edge_options()->getOptionValue('logo_image_light');


        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = oxides_edge_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image'  => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
            'logo_styles' => $logo_styles
        );

        oxides_edge_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('oxides_edge_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function oxides_edge_get_main_menu($additional_class = 'edgtf-default-nav') {
        oxides_edge_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('oxides_edge_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     */
    function oxides_edge_get_sticky_header() {

        $parameters = array(
            'hide_logo'             => oxides_edge_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'sticky_header_in_grid' => oxides_edge_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
        );

        oxides_edge_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
    }
}

if(!function_exists('oxides_edge_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function oxides_edge_get_mobile_header() {
        if(oxides_edge_is_responsive_on()) {
            $header_type = 'header-standard';

            $mobile_menu_title = oxides_edge_options()->getOptionValue('mobile_menu_title');

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => oxides_edge_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'menu_opener_icon'       => oxides_edge_icon_collections()->getMobileMenuIcon(oxides_edge_options()->getOptionValue('mobile_icon_pack'), true),
                'show_navigation_opener' => has_nav_menu('main-navigation'),
                'mobile_menu_title' => $mobile_menu_title
            );

            oxides_edge_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('oxides_edge_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function oxides_edge_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-standard';

        //check if mobile logo has been set and use that, else use normal logo
        if(oxides_edge_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = oxides_edge_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = oxides_edge_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = oxides_edge_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        oxides_edge_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('oxides_edge_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function oxides_edge_get_mobile_nav() {

        $slug = 'header-standard';

        oxides_edge_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}

if(!function_exists('oxides_edge_get_page_options')) {
    /**
     * Gets options from page
     */
    function oxides_edge_get_page_options() {
        $id = oxides_edge_get_page_id();
        $page_options = array();
        $menu_area_background_color_rgba = '';
        $menu_area_background_color = '';
        $menu_area_background_transparency = '';
        $menu_area_border_color = '';
        $menuAreaStyle = array();

        $header_type = 'header-standard';
        switch ($header_type) {
            case 'header-standard':

                if(get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true) != '') {
                    $menu_area_background_color = get_post_meta($id, 'edgtf_menu_area_background_color_header_standard_meta', true);
                    $menu_area_background_transparency = 1;
                }

                if(get_post_meta($id, 'edgtf_menu_area_background_transparency_header_standard_meta', true) != '') {
                    $menu_area_background_transparency = get_post_meta($id, 'edgtf_menu_area_background_transparency_header_standard_meta', true);
                }

                if(oxides_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
                    $menuAreaStyle[] = 'background-color:'.oxides_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
                }

                if(get_post_meta($id, 'edgtf_show_border_header_area_meta', true) !== 'no' && get_post_meta($id, 'edgtf_menu_area_border_color_header_standard_meta', true) !== '') {
                    $menuAreaStyle[] = 'border-bottom: 1px solid '.get_post_meta($id, 'edgtf_menu_area_border_color_header_standard_meta', true);
                }

                if(get_post_meta($id, 'edgtf_show_border_header_area_meta', true) === 'no') {
                    $menuAreaStyle[] = 'border-bottom: 0';
                }

                $menuAreaStyle = implode(';', $menuAreaStyle);

                break;
        }

        $page_options['menu_area_background_color'] = $menuAreaStyle;

        return $page_options;
    }
}