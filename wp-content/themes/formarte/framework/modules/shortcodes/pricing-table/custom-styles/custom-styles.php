<?php 

if(!function_exists('oxides_edge_pricing_tables_holder_styles')){
	function oxides_edge_pricing_tables_holder_styles(){
		$selector = '.edgtf-price-table .edgtf-price-table-inner';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('pricing_holder_background_color')) {
			$styles['background-color'] = oxides_edge_options()->getOptionValue('pricing_holder_background_color');
		}
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_holder_styles');
}

if(!function_exists('oxides_edge_pricing_tables_price_holder_styles')){
	function oxides_edge_pricing_tables_price_holder_styles(){
		$selector = array(
			'.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-title',
			'.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-prices'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('pricing_holder_price_background_color')) {
			$styles['background-color'] = oxides_edge_options()->getOptionValue('pricing_holder_price_background_color');
		}
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_price_holder_styles');
}

if(!function_exists('oxides_edge_pricing_tables_active_price_holder_styles')){
	function oxides_edge_pricing_tables_active_price_holder_styles(){
		$selector = array(
			'.edgtf-price-table:hover .edgtf-price-table-inner ul li.edgtf-table-title',
			'.edgtf-price-table:hover .edgtf-price-table-inner ul li.edgtf-table-prices',
			'.edgtf-price-table.edgtf-active .edgtf-price-table-inner ul li.edgtf-table-title',
			'.edgtf-price-table.edgtf-active .edgtf-price-table-inner ul li.edgtf-table-prices'
		);
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('pricing_holder_active_background_color')) {
			$styles['background-color'] = oxides_edge_options()->getOptionValue('pricing_holder_active_background_color');
		}
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_active_price_holder_styles');
}

if(!function_exists('oxides_edge_pricing_tables_content_styles')){
	function oxides_edge_pricing_tables_content_styles(){
		$selector = '.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-content ul li';
		$styles = array();
		
		if(oxides_edge_options()->getOptionValue('pricing_holder_separator_color')) {
			$styles['border-bottom-color'] = oxides_edge_options()->getOptionValue('pricing_holder_separator_color');
		}
		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_content_styles');
}

if(!function_exists('oxides_edge_pricing_tables_typography_price_styles')){
	function oxides_edge_pricing_tables_typography_price_styles(){
		$selector = '.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-prices .edgtf-price';		
		$styles = array();

		if(oxides_edge_options()->getOptionValue('pricing_price_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('pricing_price_color');
		}

		$font_size = oxides_edge_options()->getOptionValue('pricing_price_text_size');
		if($font_size !== '') {
			$styles['font-size'] = oxides_edge_filter_px($font_size).'px';
		}
		
		$font_family = oxides_edge_options()->getOptionValue('pricing_price_font_family');
		if(oxides_edge_is_font_option_valid($font_family)){
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('pricing_price_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('pricing_price_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
		}

		$font_weight = oxides_edge_options()->getOptionValue('pricing_price_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_typography_price_styles');
}


if(!function_exists('oxides_edge_pricing_tables_typography_price_mark_styles')){
	function oxides_edge_pricing_tables_typography_price_mark_styles(){
		$selector = '.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-prices .edgtf-mark';		
		$styles = array();

		if(oxides_edge_options()->getOptionValue('pricing_price_mark_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('pricing_price_mark_color');
		}

		$font_size = oxides_edge_options()->getOptionValue('pricing_price_mark_text_size');
		if($font_size !== '') {
			$styles['font-size'] = oxides_edge_filter_px($font_size).'px';
		}
		
		$font_family = oxides_edge_options()->getOptionValue('pricing_price_mark_font_family');
		if(oxides_edge_is_font_option_valid($font_family)){
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('pricing_price_mark_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('pricing_price_mark_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
		}

		$font_weight = oxides_edge_options()->getOptionValue('pricing_price_mark_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_typography_price_mark_styles');
}

if(!function_exists('oxides_edge_pricing_tables_typography_price_value_styles')){
	function oxides_edge_pricing_tables_typography_price_value_styles(){
		$selector = '.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-prices .edgtf-value';		
		$styles = array();

		if(oxides_edge_options()->getOptionValue('pricing_price_value_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('pricing_price_value_color');
		}

		$font_size = oxides_edge_options()->getOptionValue('pricing_price_value_text_size');
		if($font_size !== '') {
			$styles['font-size'] = oxides_edge_filter_px($font_size).'px';
		}
		
		$font_family = oxides_edge_options()->getOptionValue('pricing_price_value_font_family');
		if(oxides_edge_is_font_option_valid($font_family)){
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('pricing_price_value_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('pricing_price_value_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
		}

		$font_weight = oxides_edge_options()->getOptionValue('pricing_price_value_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_typography_price_value_styles');
}

if(!function_exists('oxides_edge_pricing_tables_typography_price_title_styles')){
	function oxides_edge_pricing_tables_typography_price_title_styles(){
		$selector = '.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-title .edgtf-title-content';		
		$styles = array();

		if(oxides_edge_options()->getOptionValue('pricing_price_title_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('pricing_price_title_color');
		}

		$font_size = oxides_edge_options()->getOptionValue('pricing_price_title_text_size');
		if($font_size !== '') {
			$styles['font-size'] = oxides_edge_filter_px($font_size).'px';
		}
		
		$font_family = oxides_edge_options()->getOptionValue('pricing_price_title_font_family');
		if(oxides_edge_is_font_option_valid($font_family)){
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('pricing_price_title_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('pricing_price_title_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing).'px';
		}

		$font_weight = oxides_edge_options()->getOptionValue('pricing_price_title_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		$text_transform = oxides_edge_options()->getOptionValue('pricing_price_title_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_typography_price_title_styles');
}

if(!function_exists('oxides_edge_pricing_tables_typography_price_title_separator_styles')){
	function oxides_edge_pricing_tables_typography_price_title_separator_styles(){
		$selector = '.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-title .edgtf-price-title-separator';		
		$styles = array();

		if(oxides_edge_options()->getOptionValue('pricing_price_title_color')) {
			$styles['background-color'] = oxides_edge_options()->getOptionValue('pricing_price_title_color');
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_pricing_tables_typography_price_title_separator_styles');
}	