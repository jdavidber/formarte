<?php

if(!function_exists('oxides_edge_button_typography_styles')) {
    /**
     * Typography styles for all button types
     */
    function oxides_edge_button_typography_styles() {
        $selector = '.edgtf-btn';
        $styles = array();

        $font_family = oxides_edge_options()->getOptionValue('button_font_family');
        if(oxides_edge_is_font_option_valid($font_family)) {
            $styles['font-family'] = oxides_edge_get_font_option_val($font_family);
        }

        $text_transform = oxides_edge_options()->getOptionValue('button_text_transform');
        if(!empty($text_transform)) {
            $styles['text-transform'] = $text_transform;
        }

        $font_style = oxides_edge_options()->getOptionValue('button_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = oxides_edge_options()->getOptionValue('button_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = oxides_edge_options()->getOptionValue('button_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_button_typography_styles');
}

if(!function_exists('oxides_edge_button_outline_styles')) {
    /**
     * Generate styles for outline button
     */
    function oxides_edge_button_outline_styles() {
        //outline styles
        $outline_styles   = array();
        $outline_selector = '.edgtf-btn.edgtf-btn-outline';

        if(oxides_edge_options()->getOptionValue('btn_outline_text_color')) {
            $outline_styles['color'] = oxides_edge_options()->getOptionValue('btn_outline_text_color');
        }

        if(oxides_edge_options()->getOptionValue('btn_outline_border_color')) {
            $outline_styles['border-color'] = oxides_edge_options()->getOptionValue('btn_outline_border_color');
        }

        $btn_outline_border_width = oxides_edge_options()->getOptionValue('btn_outline_border_width');
        if(oxides_edge_options()->getOptionValue('btn_outline_border_width')) {
            $outline_styles['border-width'] = oxides_edge_filter_px($btn_outline_border_width).'px';
        }

        echo oxides_edge_dynamic_css($outline_selector, $outline_styles);

        //outline hover styles
        if(oxides_edge_options()->getOptionValue('btn_outline_hover_text_color')) {
            echo oxides_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-hover-color):hover',
                array('color' => oxides_edge_options()->getOptionValue('btn_outline_hover_text_color').'!important')
            );
        }

        if(oxides_edge_options()->getOptionValue('btn_outline_hover_bg_color')) {
            echo oxides_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-hover-bg):hover',
                array('background-color' => oxides_edge_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
            );
        }

        if(oxides_edge_options()->getOptionValue('btn_outline_hover_border_color')) {
            echo oxides_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-border-hover):hover',
                array('border-color' => oxides_edge_options()->getOptionValue('btn_outline_hover_border_color').'!important')
            );
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_button_outline_styles');
}

if(!function_exists('oxides_edge_button_solid_styles')) {
    /**
     * Generate styles for solid type buttons
     */
    function oxides_edge_button_solid_styles() {
        //solid styles
        $solid_selector = '.edgtf-btn.edgtf-btn-solid';
        $solid_styles = array();

        if(oxides_edge_options()->getOptionValue('btn_solid_text_color')) {
            $solid_styles['color'] = oxides_edge_options()->getOptionValue('btn_solid_text_color');
        }

        if(oxides_edge_options()->getOptionValue('btn_solid_border_color')) {
            $solid_styles['border-color'] = oxides_edge_options()->getOptionValue('btn_solid_border_color');
        }

        $btn_solid_border_width = oxides_edge_options()->getOptionValue('btn_solid_border_width');
        if(oxides_edge_options()->getOptionValue('btn_solid_border_width')) {
            $outline_styles['border-width'] = oxides_edge_filter_px($btn_solid_border_width).'px';
        }

        if(oxides_edge_options()->getOptionValue('btn_solid_bg_color')) {
            $solid_styles['background-color'] = oxides_edge_options()->getOptionValue('btn_solid_bg_color');
        }

        echo oxides_edge_dynamic_css($solid_selector, $solid_styles);

        //solid hover styles
        if(oxides_edge_options()->getOptionValue('btn_solid_hover_text_color')) {
            echo oxides_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-color):hover',
                array('color' => oxides_edge_options()->getOptionValue('btn_solid_hover_text_color').'!important')
            );
        }

        if(oxides_edge_options()->getOptionValue('btn_solid_hover_bg_color')) {
            echo oxides_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-bg):hover',
                array('background-color' => oxides_edge_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
            );
        }

        if(oxides_edge_options()->getOptionValue('btn_solid_hover_border_color')) {
            echo oxides_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-bg):hover',
                array('border-color' => oxides_edge_options()->getOptionValue('btn_solid_hover_border_color').'!important')
            );
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_button_solid_styles');
}