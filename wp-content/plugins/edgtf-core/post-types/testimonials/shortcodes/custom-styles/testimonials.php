<?php
/**
 * Custom styles for Testimonials shortcode
 * Hooks to edgtf_style_dynamic hook
 */


if(!function_exists('edgtf_testimonials_title_styles')){
    function edgtf_testimonials_title_styles(){
        $selector = '.edgtf-testimonials .edgtf-testimonial-title';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('testimonials_title_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('testimonials_title_color');
        }

        $font_size = oxides_edge_options()->getOptionValue('testimonials_title_text_size');
        if($font_size !== '') {
            $styles['font-size'] = oxides_edge_filter_px($font_size).'px';
        }

        $font_family = oxides_edge_options()->getOptionValue('testimonials_title_font_family');
        if(oxides_edge_is_font_option_valid($font_family)){
            $styles['font-family'] = oxides_edge_get_font_option_val($font_family);
        }

        $font_style = oxides_edge_options()->getOptionValue('testimonials_title_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = oxides_edge_options()->getOptionValue('testimonials_title_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = oxides_edge_options()->getOptionValue('testimonials_title_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('edgtf_style_dynamic', 'edgtf_testimonials_title_styles');
}


if(!function_exists('edgtf_testimonials_text_styles')){
    function edgtf_testimonials_text_styles(){
        $selector = '.edgtf-testimonials .edgtf-testimonial-text';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('testimonials_text_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('testimonials_text_color');
        }

        $font_size = oxides_edge_options()->getOptionValue('testimonials_text_text_size');
        if($font_size !== '') {
            $styles['font-size'] = oxides_edge_filter_px($font_size).'px';
        }

        $font_family = oxides_edge_options()->getOptionValue('testimonials_text_font_family');
        if(oxides_edge_is_font_option_valid($font_family)){
            $styles['font-family'] = oxides_edge_get_font_option_val($font_family);
        }

        $font_style = oxides_edge_options()->getOptionValue('testimonials_text_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = oxides_edge_options()->getOptionValue('testimonials_text_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = oxides_edge_options()->getOptionValue('testimonials_text_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('edgtf_style_dynamic', 'edgtf_testimonials_text_styles');
}

if(!function_exists('edgtf_testimonials_author_styles')){
    function edgtf_testimonials_author_styles(){
        $selector = '.edgtf-testimonials .edgtf-testimonial-author-text';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('testimonials_author_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('testimonials_author_color');
        }

        $font_size = oxides_edge_options()->getOptionValue('testimonials_author_text_size');
        if($font_size !== '') {
            $styles['font-size'] = oxides_edge_filter_px($font_size).'px';
        }

        $font_family = oxides_edge_options()->getOptionValue('testimonials_author_font_family');
        if(oxides_edge_is_font_option_valid($font_family)){
            $styles['font-family'] = oxides_edge_get_font_option_val($font_family);
        }

        $font_style = oxides_edge_options()->getOptionValue('testimonials_author_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = oxides_edge_options()->getOptionValue('testimonials_author_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = oxides_edge_options()->getOptionValue('testimonials_author_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('edgtf_style_dynamic', 'edgtf_testimonials_author_styles');
}
