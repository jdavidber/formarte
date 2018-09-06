<?php

if (!function_exists('oxides_edge_title_area_typography_style')) {

    function oxides_edge_title_area_typography_style(){

        $title_styles = array();

        if(oxides_edge_options()->getOptionValue('page_title_color') !== '') {
            $title_styles['color'] = oxides_edge_options()->getOptionValue('page_title_color');
        }
        if(oxides_edge_options()->getOptionValue('page_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('page_title_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('page_title_fontsize') !== '') {
            $title_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('page_title_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('page_title_lineheight') !== '') {
            $title_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('page_title_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('page_title_texttransform') !== '') {
            $title_styles['text-transform'] = oxides_edge_options()->getOptionValue('page_title_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('page_title_fontstyle') !== '') {
            $title_styles['font-style'] = oxides_edge_options()->getOptionValue('page_title_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('page_title_fontweight') !== '') {
            $title_styles['font-weight'] = oxides_edge_options()->getOptionValue('page_title_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('page_title_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('page_title_letter_spacing')).'px';
        }

        $title_selector = array(
            '.edgtf-title .edgtf-title-holder h1'
        );

        echo oxides_edge_dynamic_css($title_selector, $title_styles);


        $subtitle_styles = array();

        if(oxides_edge_options()->getOptionValue('page_subtitle_color') !== '') {
            $subtitle_styles['color'] = oxides_edge_options()->getOptionValue('page_subtitle_color');
        }
        if(oxides_edge_options()->getOptionValue('page_subtitle_google_fonts') !== '-1') {
            $subtitle_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('page_subtitle_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('page_subtitle_fontsize') !== '') {
            $subtitle_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('page_subtitle_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('page_subtitle_lineheight') !== '') {
            $subtitle_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('page_subtitle_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('page_subtitle_texttransform') !== '') {
            $subtitle_styles['text-transform'] = oxides_edge_options()->getOptionValue('page_subtitle_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('page_subtitle_fontstyle') !== '') {
            $subtitle_styles['font-style'] = oxides_edge_options()->getOptionValue('page_subtitle_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('page_subtitle_fontweight') !== '') {
            $subtitle_styles['font-weight'] = oxides_edge_options()->getOptionValue('page_subtitle_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('page_subtitle_letter_spacing') !== '') {
            $subtitle_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('page_subtitle_letter_spacing')).'px';
        }

        $subtitle_selector = array(
            '.edgtf-title .edgtf-title-holder .edgtf-subtitle'
        );

        echo oxides_edge_dynamic_css($subtitle_selector, $subtitle_styles);

    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_title_area_typography_style');

}


