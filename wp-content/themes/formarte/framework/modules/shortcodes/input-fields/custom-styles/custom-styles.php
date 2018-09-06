<?php
/**
 * Custom styles for Input fields shortcode
 * Hooks to oxides_edge_style_dynamic hook
 */

if(!function_exists('oxides_edge_input_fields_styles')) {
    /**
     * Generate styles for input fields
     */
    function oxides_edge_input_fields_styles() {
        $input_selector = array(
            '#respond textarea', 
            '#respond input[type="text"]',
            '.post-password-form input[type="password"]'
        );

        $inline_styles = array();

        if(oxides_edge_options()->getOptionValue('input_fields_text_color')) {
            $inline_styles['color'] = oxides_edge_options()->getOptionValue('input_fields_text_color');
        }

        if(oxides_edge_options()->getOptionValue('input_fields_border_color')) {
            $inline_styles['border-color'] = oxides_edge_options()->getOptionValue('input_fields_border_color');
        }

        $input_fields_border_width = oxides_edge_options()->getOptionValue('input_fields_border_width');
        if(oxides_edge_options()->getOptionValue('input_fields_border_width')) {
            $inline_styles['border-width'] = oxides_edge_filter_px($input_fields_border_width).'px';
        }

        if(oxides_edge_options()->getOptionValue('input_fields_bg_color')) {
            $inline_styles['background-color'] = oxides_edge_options()->getOptionValue('input_fields_bg_color');
        }

        echo oxides_edge_dynamic_css($input_selector, $inline_styles);


        $hover_selector = array(
            '#respond textarea:hover', 
            '#respond input[type="text"]:hover',
            '.post-password-form input[type="password"]:hover'
        );

        $hover_styles = array();

        if(oxides_edge_options()->getOptionValue('input_fields_hover_text_color')) {
            $hover_styles['color'] = oxides_edge_options()->getOptionValue('input_fields_hover_text_color');
        }

        if(oxides_edge_options()->getOptionValue('input_fields_hover_border_color')) {
            $hover_styles['border-color'] = oxides_edge_options()->getOptionValue('input_fields_hover_border_color');
        }

        if(oxides_edge_options()->getOptionValue('input_fields_hover_bg_color')) {
            $hover_styles['background-color'] = oxides_edge_options()->getOptionValue('input_fields_hover_bg_color');
        }

        echo oxides_edge_dynamic_css($hover_selector, $hover_styles);

        if(oxides_edge_options()->getOptionValue('input_fields_focus_border_color')) {
            echo oxides_edge_dynamic_css(
                '#respond textarea:focus',
                array('border-color' => oxides_edge_options()->getOptionValue('input_fields_focus_border_color'))
            );
            echo oxides_edge_dynamic_css(
                '#respond input[type="text"]:focus',
                array('border-color' => oxides_edge_options()->getOptionValue('input_fields_focus_border_color'))
            );
            echo oxides_edge_dynamic_css(
                '.post-password-form input[type="password"]:focus',
                array('border-color' => oxides_edge_options()->getOptionValue('input_fields_focus_border_color'))
            );
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_input_fields_styles');
}