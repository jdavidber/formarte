<?php 

if(!function_exists('oxides_edge_accordions_typography_styles')){
	function oxides_edge_accordions_typography_styles(){
		$selector = '.edgtf-accordion-holder .edgtf-title-holder';		
		$styles = array();
		
		$font_family = oxides_edge_options()->getOptionValue('accordions_font_family');
		if(oxides_edge_is_font_option_valid($font_family)){
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_size = oxides_edge_options()->getOptionValue('accordions_text_size');
		if($font_size !== '') {
			$styles['font-size'] = oxides_edge_filter_px($font_size).'px';
		}
		
		$text_transform = oxides_edge_options()->getOptionValue('accordions_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		$font_style = oxides_edge_options()->getOptionValue('accordions_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('accordions_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
		}

		$font_weight = oxides_edge_options()->getOptionValue('accordions_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_accordions_typography_styles');
}

if(!function_exists('oxides_edge_accordions_inital_title_color_styles')){
	function oxides_edge_accordions_inital_title_color_styles(){
		$selector = '.edgtf-accordion-holder .edgtf-title-holder';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('accordions_title_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('accordions_title_color');
		}
		if(oxides_edge_options()->getOptionValue('accordions_separator_color')) {
			$styles['border-color'] = oxides_edge_options()->getOptionValue('accordions_separator_color');
		}
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_accordions_inital_title_color_styles');
}

if(!function_exists('oxides_edge_accordions_inital_simple_title_color_styles')){
	function oxides_edge_accordions_inital_simple_title_color_styles(){
		$selector = array(
			'.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder',
			'.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-active'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('accordions_simple_title_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('accordions_simple_title_color');
		}
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_accordions_inital_simple_title_color_styles');
}

if(!function_exists('oxides_edge_accordions_active_title_color_styles')){
	function oxides_edge_accordions_active_title_color_styles(){
		$selector = array(
			'.edgtf-accordion-holder .edgtf-title-holder.ui-state-active',
			'.edgtf-accordion-holder .edgtf-title-holder.ui-state-hover',
			'.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-hover',
			'.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-active.ui-state-hover',
			'.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-active.ui-state-hover .edgtf-accordion-mark'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('accordions_title_color_active')) {
           $styles['color'] = oxides_edge_options()->getOptionValue('accordions_title_color_active');
        }
		
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_accordions_active_title_color_styles');
}

if(!function_exists('oxides_edge_accordions_inital_icon_color_styles')){
	function oxides_edge_accordions_inital_icon_color_styles(){
		$selector = '.edgtf-accordion-holder .edgtf-title-holder .edgtf-accordion-mark';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('accordions_icon_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('accordions_icon_color');
        }
		if(oxides_edge_options()->getOptionValue('accordions_icon_back_color')) {
			$styles['background-color'] = oxides_edge_options()->getOptionValue('accordions_icon_back_color');
        }
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_accordions_inital_icon_color_styles');
}

if(!function_exists('oxides_edge_accordions_inital_simple_icon_color_styles')){
	function oxides_edge_accordions_inital_simple_icon_color_styles(){
		$selector = array(
			'.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder .edgtf-accordion-mark',
			'.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-active .edgtf-accordion-mark'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('accordions_simple_icon_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('accordions_simple_icon_color');
        }
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_accordions_inital_simple_icon_color_styles');
}

if(!function_exists('oxides_edge_accordions_active_icon_color_styles')){
	function oxides_edge_accordions_active_icon_color_styles(){
		$selector = array(
			'.edgtf-accordion-holder .edgtf-title-holder.ui-state-active  .edgtf-accordion-mark',
			'.edgtf-accordion-holder .edgtf-title-holder.ui-state-hover  .edgtf-accordion-mark'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('accordions_icon_color_active')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('accordions_icon_color_active');
        }
		if(oxides_edge_options()->getOptionValue('accordions_icon_back_color_active')) {
			$styles['background-color'] = oxides_edge_options()->getOptionValue('accordions_icon_back_color_active');
        }
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_accordions_active_icon_color_styles');
}

if(!function_exists('oxides_edge_accordions_active_simple_icon_color_styles')){
	function oxides_edge_accordions_active_simple_icon_color_styles(){
		$selector = '.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-hover .edgtf-accordion-mark';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('accordions_icon_color_active')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('accordions_icon_color_active');
        }
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_accordions_active_simple_icon_color_styles');
}