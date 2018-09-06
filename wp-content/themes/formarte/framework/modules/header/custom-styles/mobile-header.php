<?php

if(!function_exists('oxides_edge_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function oxides_edge_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(oxides_edge_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(oxides_edge_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = oxides_edge_options()->getOptionValue('mobile_header_background_color');
        }

        if(oxides_edge_options()->getOptionValue('mobile_header_separator_color')) {
            $mobile_header_styles['border-color'] = oxides_edge_options()->getOptionValue('mobile_header_separator_color');
        }

        echo oxides_edge_dynamic_css('.edgtf-mobile-header .edgtf-mobile-header-inner', $mobile_header_styles);
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_mobile_header_general_styles');
}

if(!function_exists('oxides_edge_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function oxides_edge_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(oxides_edge_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = oxides_edge_options()->getOptionValue('mobile_menu_background_color');
        }

        if(oxides_edge_options()->getOptionValue('mobile_header_separator_color')) {
            $mobile_nav_styles['border-color'] = oxides_edge_options()->getOptionValue('mobile_header_separator_color');
        }

        echo oxides_edge_dynamic_css('.edgtf-mobile-header .edgtf-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if(oxides_edge_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = oxides_edge_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(oxides_edge_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = oxides_edge_options()->getOptionValue('mobile_text_color');
        }

        if(oxides_edge_is_font_option_valid(oxides_edge_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('mobile_font_family'));
        }

        if(oxides_edge_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('mobile_font_size')).'px';
        }

        if(oxides_edge_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('mobile_line_height')).'px';
        }

        if(oxides_edge_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = oxides_edge_options()->getOptionValue('mobile_text_transform');
        }

        if(oxides_edge_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = oxides_edge_options()->getOptionValue('mobile_font_style');
        }

        if(oxides_edge_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = oxides_edge_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.edgtf-mobile-header .edgtf-mobile-nav a',
            '.edgtf-mobile-header .edgtf-mobile-nav h4'
        );

        echo oxides_edge_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if(oxides_edge_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = oxides_edge_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.edgtf-mobile-header .edgtf-mobile-nav a:hover',
            '.edgtf-mobile-header .edgtf-mobile-nav h4:hover'
        );

        echo oxides_edge_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_mobile_navigation_styles');
}

if(!function_exists('oxides_edge_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function oxides_edge_mobile_logo_styles() {
        if(oxides_edge_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo oxides_edge_dynamic_css(
                '.edgtf-mobile-header .edgtf-mobile-logo-wrapper a',
                array('height' => oxides_edge_filter_px(oxides_edge_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(oxides_edge_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo oxides_edge_dynamic_css(
                '.edgtf-mobile-header .edgtf-mobile-logo-wrapper a',
                array('height' => oxides_edge_filter_px(oxides_edge_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_mobile_logo_styles');
}

if(!function_exists('oxides_edge_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function oxides_edge_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(oxides_edge_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = oxides_edge_options()->getOptionValue('mobile_icon_color');
        }

        if(oxides_edge_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('mobile_icon_size')).'px';
        }

        echo oxides_edge_dynamic_css('.edgtf-mobile-header .edgtf-mobile-menu-opener a', $mobile_icon_styles);

        if(oxides_edge_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo oxides_edge_dynamic_css(
                '.edgtf-mobile-header .edgtf-mobile-menu-opener a:hover',
                array('color' => oxides_edge_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_mobile_icon_styles');
}