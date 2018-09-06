<?php
if(!function_exists('oxides_edge_tabs_typography_styles')){
	function oxides_edge_tabs_typography_styles(){
		$selector = '.edgtf-tabs .edgtf-tabs-nav li a';
		$styles = array();
		$font_family = oxides_edge_options()->getOptionValue('tabs_font_family');
		
		$font_size = oxides_edge_options()->getOptionValue('tabs_font_size');
		if($font_size !== '') {
			$styles['font-size'] = oxides_edge_filter_px($font_size).'px';
		}

		if(oxides_edge_is_font_option_valid($font_family)){
			$styles['font-family'] = oxides_edge_is_font_option_valid($font_family);
		}
		
		$text_transform = oxides_edge_options()->getOptionValue('tabs_text_transform');
        if(!empty($text_transform)) {
            $styles['text-transform'] = $text_transform;
        }

        $font_style = oxides_edge_options()->getOptionValue('tabs_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = oxides_edge_options()->getOptionValue('tabs_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = oxides_edge_options()->getOptionValue('tabs_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_typography_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_color_styles')){
	function oxides_edge_tabs_horizontal_color_styles(){
		$selector = '.edgtf-tabs.edgtf-horizontal-tab:not(.edgtf-boxed-tab):not(.edgtf-full-width-tab) .edgtf-tabs-nav li a:not(.edgtf-title-tab-white)';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('tabs_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_color_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_title_separator_styles')){
	function oxides_edge_tabs_horizontal_title_separator_styles(){
		$selector = '.edgtf-tabs.edgtf-horizontal-tab:not(.edgtf-boxed-tab):not(.edgtf-full-width-tab) .edgtf-tabs-nav li a:not(.edgtf-title-tab-white) .edgtf-tab-title-separator';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_border_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_border_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_title_separator_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_active_color_styles')){
	function oxides_edge_tabs_horizontal_active_color_styles(){
		$selector = array(
			'.edgtf-tabs.edgtf-horizontal-tab:not(.edgtf-boxed-tab):not(.edgtf-full-width-tab) .edgtf-tabs-nav li.ui-state-active a:not(.edgtf-title-tab-white)', 
			'.edgtf-tabs.edgtf-horizontal-tab:not(.edgtf-boxed-tab):not(.edgtf-full-width-tab) .edgtf-tabs-nav li.ui-state-hover a:not(.edgtf-title-tab-white)'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_hover_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('tabs_hover_color');
        }
		if(oxides_edge_options()->getOptionValue('tabs_hover_background_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_hover_background_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_active_color_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_white_color_styles')){
	function oxides_edge_tabs_horizontal_white_color_styles(){
		$selector = '.edgtf-tabs.edgtf-horizontal-tab .edgtf-tabs-nav li a.edgtf-title-tab-white';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_white_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('tabs_white_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_white_color_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_white_separator_styles')){
	function oxides_edge_tabs_horizontal_white_separator_styles(){
		$selector = '.edgtf-tabs.edgtf-horizontal-tab .edgtf-tabs-nav li a.edgtf-title-tab-white .edgtf-tab-title-separator';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_white_border_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_white_border_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_white_separator_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_white_active_color_styles')){
	function oxides_edge_tabs_horizontal_white_active_color_styles(){
		$selector = array(
			'.edgtf-tabs.edgtf-horizontal-tab:not(.edgtf-boxed-tab):not(.edgtf-full-width-tab) .edgtf-tabs-nav li.ui-state-active a.edgtf-title-tab-white', 
			'.edgtf-tabs.edgtf-horizontal-tab:not(.edgtf-boxed-tab):not(.edgtf-full-width-tab) .edgtf-tabs-nav li.ui-state-hover a.edgtf-title-tab-white'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_hover_white_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('tabs_hover_white_color');
        }
		if(oxides_edge_options()->getOptionValue('tabs_hover_white_background_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_hover_white_background_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_white_active_color_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_title_boxed_styles')){
	function oxides_edge_tabs_horizontal_title_boxed_styles(){
		$selector = '.edgtf-tabs.edgtf-horizontal-tab.edgtf-boxed-tab .edgtf-tabs-nav li a';
		$styles = array();

		if(oxides_edge_options()->getOptionValue('tabs_boxed_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('tabs_boxed_color');
        }
		if(oxides_edge_options()->getOptionValue('tabs_boxed_back_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_boxed_back_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_title_boxed_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_title_boxed_separator_styles')){
	function oxides_edge_tabs_horizontal_title_boxed_separator_styles(){
		$selector = '.edgtf-tabs.edgtf-horizontal-tab.edgtf-boxed-tab .edgtf-tabs-nav li a:not(.edgtf-title-tab-white) .edgtf-tab-title-separator';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_boxed_border_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_boxed_border_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_title_boxed_separator_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_title_full_width_area_styles')){
	function oxides_edge_tabs_horizontal_title_full_width_area_styles(){
		$selector = array(
			'.edgtf-tabs.edgtf-horizontal-tab.edgtf-full-width-tab .edgtf-tabs-title',
			'.edgtf-tabs.edgtf-horizontal-tab.edgtf-full-width-tab .edgtf-tabs-nav'
		);
		$styles = array();

		if(oxides_edge_options()->getOptionValue('tabs_full_width_background_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_full_width_background_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_title_full_width_area_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_title_full_width_styles')){
	function oxides_edge_tabs_horizontal_title_full_width_styles(){
		$selector = '.edgtf-tabs.edgtf-horizontal-tab.edgtf-full-width-tab .edgtf-tabs-nav li a';
		$styles = array();

		if(oxides_edge_options()->getOptionValue('tabs_full_width_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('tabs_full_width_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_title_full_width_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_title_full_width_separator_styles')){
	function oxides_edge_tabs_horizontal_title_full_width_separator_styles(){
		$selector = '.edgtf-tabs.edgtf-horizontal-tab.edgtf-full-width-tab .edgtf-tabs-nav li a:not(.edgtf-title-tab-white) .edgtf-tab-title-separator';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_full_width_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_full_width_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_title_full_width_separator_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_title_full_width_active_styles')){
	function oxides_edge_tabs_horizontal_title_full_width_active_styles(){
		$selector = array(
			'.edgtf-tabs.edgtf-horizontal-tab.edgtf-full-width-tab .edgtf-tabs-nav li.ui-state-active a', 
			'.edgtf-tabs.edgtf-horizontal-tab.edgtf-full-width-tab .edgtf-tabs-nav li.ui-state-hover a'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_full_width_hover_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('tabs_full_width_hover_color');
        }
		if(oxides_edge_options()->getOptionValue('tabs_full_width_hover_background_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_full_width_hover_background_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_title_full_width_active_styles');
}

if(!function_exists('oxides_edge_tabs_horizontal_title_full_width_separator_active_styles')){
	function oxides_edge_tabs_horizontal_title_full_width_separator_active_styles(){
		$selector = array(
			'.edgtf-tabs.edgtf-horizontal-tab.edgtf-full-width-tab .edgtf-tabs-nav li.ui-state-active a .edgtf-tab-title-separator', 
			'.edgtf-tabs.edgtf-horizontal-tab.edgtf-full-width-tab .edgtf-tabs-nav li.ui-state-hover a .edgtf-tab-title-separator'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('tabs_full_width_hover_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('tabs_full_width_hover_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_horizontal_title_full_width_separator_active_styles');
}







if(!function_exists('oxides_edge_tabs_vertical_color_styles')){
	function oxides_edge_tabs_vertical_color_styles(){
		$selector = '.edgtf-tabs.edgtf-vertical-tab .edgtf-tabs-nav li a';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('vertical_tabs_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('vertical_tabs_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_vertical_color_styles');
}

if(!function_exists('oxides_edge_tabs_vertical_separator_styles')){
	function oxides_edge_tabs_vertical_separator_styles(){
		$selector = '.edgtf-tabs.edgtf-vertical-tab .edgtf-tab-container';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('vertical_tabs_border_color')) {
            $styles['border-color'] = oxides_edge_options()->getOptionValue('vertical_tabs_border_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_vertical_separator_styles');
}

if(!function_exists('oxides_edge_tabs_vertical_active_color_styles')){
	function oxides_edge_tabs_vertical_active_color_styles(){
		$selector = array(
			'.edgtf-tabs.edgtf-vertical-tab .edgtf-tabs-nav li.ui-state-active a', 
			'.edgtf-tabs.edgtf-vertical-tab .edgtf-tabs-nav li.ui-state-hover a'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('vertical_tabs_hover_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('vertical_tabs_hover_color');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_tabs_vertical_active_color_styles');
}