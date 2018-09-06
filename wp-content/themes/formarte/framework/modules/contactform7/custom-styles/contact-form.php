<?php
if(!function_exists('oxides_edge_contact_form7_text_styles_1')) {
	/**
	 * Generates custom styles for Contact Form 7 elements
	 */
	function oxides_edge_contact_form7_text_styles_1() {
		$selector = array(
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-text',
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-number',
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-date',
			'.cf7_custom_style_1 textarea.wpcf7-form-control.wpcf7-textarea',
			'.cf7_custom_style_1 select.wpcf7-form-control.wpcf7-select',
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-quiz'
		);
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_1_text_color');
		if($color !== ''){
			$styles['color'] = $color;
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_1 ::-webkit-input-placeholder',
			array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_1 :-moz-placeholder',
			array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_1 ::-moz-placeholder',
			array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_1 :-ms-input-placeholder',
			array('color' => $color)
			);
		}

		$font_size = oxides_edge_options()->getOptionValue('cf7_style_1_text_font_size');
		if($font_size !== ''){
			$styles['font-size'] = oxides_edge_filter_px($font_size) . 'px';
		}

		$line_height = oxides_edge_options()->getOptionValue('cf7_style_1_text_line_height');
		if($line_height !== ''){
			$styles['line-height'] = oxides_edge_filter_px($line_height) . 'px';
		}

		$font_family = oxides_edge_options()->getOptionValue('cf7_style_1_text_font_family');
		if(oxides_edge_is_font_option_valid($font_family)) {
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('cf7_style_1_text_font_style');
		if(!empty($font_style)){
			$styles['font-style'] = $font_style;
		}

		$font_weight = oxides_edge_options()->getOptionValue('cf7_style_1_text_font_weight');
		if(!empty($font_weight)){
			$styles['font-weight'] = $font_weight;
		}

		$text_transform = oxides_edge_options()->getOptionValue('cf7_style_1_text_text_transform');
		if(!empty($text_transform)){
			$styles['text-transform'] = $text_transform;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('cf7_style_1_text_letter_spacing');
		if($letter_spacing !== ''){
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing) . 'px';
		}

		$background_color = oxides_edge_options()->getOptionValue('cf7_style_1_background_color');
		$background_opacity = 1;
		if($background_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_1_background_transparency')){
				$background_opacity = oxides_edge_options()->getOptionValue('cf7_style_1_background_transparency');
			}
			$styles['background-color'] = oxides_edge_rgba_color($background_color,$background_opacity);
		}

		$border_color = oxides_edge_options()->getOptionValue('cf7_style_1_border_color');
		$border_opacity = 1;
		if($border_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_1_border_transparency')){
				$border_opacity = oxides_edge_options()->getOptionValue('cf7_style_1_border_transparency');
			}
			$styles['border-color'] = oxides_edge_rgba_color($border_color,$border_opacity);
		}

		$border_width = oxides_edge_options()->getOptionValue('cf7_style_1_border_width');
		if($border_width !== ''){
			$styles['border-width'] = oxides_edge_filter_px($border_width) . 'px';
		}

		$border_radius = oxides_edge_options()->getOptionValue('cf7_style_1_border_radius');
		if($border_radius !== ''){
			$styles['border-radius'] = oxides_edge_filter_px($border_radius) . 'px';
		}

		$padding_top = oxides_edge_options()->getOptionValue('cf7_style_1_padding_top');
		if($padding_top !== ''){
			$styles['padding-top'] = oxides_edge_filter_px($padding_top) . 'px';
		}

		$padding_right = oxides_edge_options()->getOptionValue('cf7_style_1_padding_right');
		if($padding_right !== ''){
			$styles['padding-right'] = oxides_edge_filter_px($padding_right) . 'px';
		}

		$padding_bottom = oxides_edge_options()->getOptionValue('cf7_style_1_padding_bottom');
		if($padding_bottom !== ''){
			$styles['padding-bottom'] = oxides_edge_filter_px($padding_bottom) . 'px';
		}

		$padding_left = oxides_edge_options()->getOptionValue('cf7_style_1_padding_left');
		if($padding_left !== ''){
			$styles['padding-left'] = oxides_edge_filter_px($padding_left) . 'px';
		}

		$margin_top = oxides_edge_options()->getOptionValue('cf7_style_1_margin_top');
		if($margin_top !== ''){
			$styles['margin-top'] = oxides_edge_filter_px($margin_top) . 'px';
		}

		$margin_bottom = oxides_edge_options()->getOptionValue('cf7_style_1_margin_bottom');
		if($margin_bottom !== ''){
			$styles['margin-bottom'] = oxides_edge_filter_px($margin_bottom) . 'px';
		}

		if(oxides_edge_options()->getOptionValue('cf7_style_1_textarea_height')) {
			$textarea_height = oxides_edge_options()->getOptionValue('cf7_style_1_textarea_height');
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_1 textarea.wpcf7-form-control.wpcf7-textarea',
			array('height' => oxides_edge_filter_px($textarea_height).'px')
			);
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_text_styles_1');
}

if(!function_exists('oxides_edge_contact_form7_focus_styles_1')) {
	/**
	 * Generates custom styles for Contact Form 7 elements focus
	 */
	function oxides_edge_contact_form7_focus_styles_1() {
		$selector = array(
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-text:focus',
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-number:focus',
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-date:focus',
			'.cf7_custom_style_1 textarea.wpcf7-form-control.wpcf7-textarea:focus',
			'.cf7_custom_style_1 select.wpcf7-form-control.wpcf7-select:focus',
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-quiz:focus'
		);
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_1_focus_text_color');
		if($color !== ''){
			$styles['color'] = $color;
			echo oxides_edge_dynamic_css(
				array(
					'.cf7_custom_style_1 input:focus::-webkit-input-placeholder',
					'.cf7_custom_style_1 textarea:focus::-webkit-input-placeholder'
				),
				array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
				array(
					'.cf7_custom_style_1 input:focus:-moz-placeholder',
					'.cf7_custom_style_1 textarea:focus:-moz-placeholder'
				),
				array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
				array(
					'.cf7_custom_style_1 input:focus::-moz-placeholder',
					'.cf7_custom_style_1 textarea:focus::-moz-placeholder'
				),
				array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
				array(
					'.cf7_custom_style_1 input:focus:-ms-input-placeholder',
					'.cf7_custom_style_1 textarea:focus:-ms-input-placeholder'
				),
				array('color' => $color)
			);
		}

		$background_color = oxides_edge_options()->getOptionValue('cf7_style_1_focus_background_color');
		$background_opacity = 1;
		if($background_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_1_focus_background_transparency')){
				$background_opacity = oxides_edge_options()->getOptionValue('cf7_style_1_focus_background_transparency');
			}
			$styles['background-color'] = oxides_edge_rgba_color($background_color,$background_opacity);
		}

		$border_color = oxides_edge_options()->getOptionValue('cf7_style_1_focus_border_color');
		$border_opacity = 1;
		if($border_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_1_focus_border_transparency')){
				$border_opacity = oxides_edge_options()->getOptionValue('cf7_style_1_focus_border_transparency');
			}
			$styles['border-color'] = oxides_edge_rgba_color($border_color,$border_opacity);
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_focus_styles_1');
}

if(!function_exists('oxides_edge_contact_form7_label_styles_1')) {
	/**
	 * Generates custom styles for Contact Form 7 label
	 */
	function oxides_edge_contact_form7_label_styles_1() {
		$selector = array('.cf7_custom_style_1 p');
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_1_label_color');
		if($color !== ''){
			$styles['color'] = $color;
		}

		$font_size = oxides_edge_options()->getOptionValue('cf7_style_1_label_font_size');
		if($font_size !== ''){
			$styles['font-size'] = oxides_edge_filter_px($font_size) . 'px';
		}

		$line_height = oxides_edge_options()->getOptionValue('cf7_style_1_label_line_height');
		if($line_height !== ''){
			$styles['line-height'] = oxides_edge_filter_px($line_height) . 'px';
		}

		$font_family = oxides_edge_options()->getOptionValue('cf7_style_1_label_font_family');
		if(oxides_edge_is_font_option_valid($font_family)) {
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('cf7_style_1_label_font_style');
		if(!empty($font_style)){
			$styles['font-style'] = $font_style;
		}

		$font_weight = oxides_edge_options()->getOptionValue('cf7_style_1_label_font_weight');
		if(!empty($font_weight)){
			$styles['font-weight'] = $font_weight;
		}

		$text_transform = oxides_edge_options()->getOptionValue('cf7_style_1_label_text_transform');
		if(!empty($text_transform)){
			$styles['text-transform'] = $text_transform;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('cf7_style_1_label_letter_spacing');
		if($letter_spacing !== ''){
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing) . 'px';
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_label_styles_1');
}

if(!function_exists('oxides_edge_contact_form7_button_styles_1')) {
	/**
	 * Generates custom styles for Contact Form 7 button
	 */
	function oxides_edge_contact_form7_button_styles_1() {
		$selector = array(
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-submit'
		);
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_1_button_color');
		if($color !== ''){
			$styles['color'] = $color;
		}

		$font_size = oxides_edge_options()->getOptionValue('cf7_style_1_button_font_size');
		if($font_size !== ''){
			$styles['font-size'] = oxides_edge_filter_px($font_size) . 'px';
		}

		$height = oxides_edge_options()->getOptionValue('cf7_style_1_button_height');
		if($height !== ''){
			$styles['height'] = oxides_edge_filter_px($height) . 'px';
		}

		$font_family = oxides_edge_options()->getOptionValue('cf7_style_1_button_font_family');
		if(oxides_edge_is_font_option_valid($font_family)) {
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('cf7_style_1_button_font_style');
		if(!empty($font_style)){
			$styles['font-style'] = $font_style;
		}

		$font_weight = oxides_edge_options()->getOptionValue('cf7_style_1_button_font_weight');
		if(!empty($font_weight)){
			$styles['font-weight'] = $font_weight;
		}

		$text_transform = oxides_edge_options()->getOptionValue('cf7_style_1_button_text_transform');
		if(!empty($text_transform)){
			$styles['text-transform'] = $text_transform;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('cf7_style_1_button_letter_spacing');
		if($letter_spacing !== ''){
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing) . 'px';
		}

		$background_color = oxides_edge_options()->getOptionValue('cf7_style_1_button_background_color');
		$background_opacity = 1;
		if($background_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_1_button_background_transparency')){
				$background_opacity = oxides_edge_options()->getOptionValue('cf7_style_1_button_background_transparency');
			}
			$styles['background-color'] = oxides_edge_rgba_color($background_color,$background_opacity);
		}

		$border_color = oxides_edge_options()->getOptionValue('cf7_style_1_button_border_color');
		$border_opacity = 1;
		if($border_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_1_button_border_transparency')){
				$border_opacity = oxides_edge_options()->getOptionValue('cf7_style_1_button_border_transparency');
			}
			$styles['border-color'] = oxides_edge_rgba_color($border_color,$border_opacity);
		}

		$border_width = oxides_edge_options()->getOptionValue('cf7_style_1_button_border_width');
		if($border_width !== ''){
			$styles['border-width'] = oxides_edge_filter_px($border_width) . 'px';
		}

		$border_radius = oxides_edge_options()->getOptionValue('cf7_style_1_button_border_radius');
		if($border_radius !== ''){
			$styles['border-radius'] = oxides_edge_filter_px($border_radius) . 'px';
		}

		$padding_left_right = oxides_edge_options()->getOptionValue('cf7_style_1_button_padding');
		if($padding_left_right !== ''){
			$styles['padding-left'] = oxides_edge_filter_px($padding_left_right) . 'px';
			$styles['padding-right'] = oxides_edge_filter_px($padding_left_right) . 'px';
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_button_styles_1');
}

if(!function_exists('oxides_edge_contact_form7_button_hover_styles_1')) {
	/**
	 * Generates custom styles for Contact Form 7 button
	 */
	function oxides_edge_contact_form7_button_hover_styles_1() {
		$selector = array(
			'.cf7_custom_style_1 input.wpcf7-form-control.wpcf7-submit:not([disabled]):hover'
		);
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_1_button_hover_color');
		if($color !== ''){
			$styles['color'] = $color;
		}

		$background_color = oxides_edge_options()->getOptionValue('cf7_style_1_button_hover_bckg_color');
		$background_opacity = 1;
		if($background_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_1_button_hover_bckg_transparency')){
				$background_opacity = oxides_edge_options()->getOptionValue('cf7_style_1_button_hover_bckg_transparency');
			}
			$styles['background-color'] = oxides_edge_rgba_color($background_color,$background_opacity);
		}

		$border_color = oxides_edge_options()->getOptionValue('cf7_style_1_button_hover_border_color');
		$border_opacity = 1;
		if($border_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_1_button_hover_border_transparency')){
				$border_opacity = oxides_edge_options()->getOptionValue('cf7_style_1_button_hover_border_transparency');
			}
			$styles['border-color'] = oxides_edge_rgba_color($border_color,$border_opacity);
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_button_hover_styles_1');
}

if(!function_exists('oxides_edge_contact_form7_text_styles_2')) {
	/**
	 * Generates custom styles for Contact Form 7 elements
	 */
	function oxides_edge_contact_form7_text_styles_2() {
		$selector = array(
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-text',
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-number',
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-date',
			'.cf7_custom_style_2 textarea.wpcf7-form-control.wpcf7-textarea',
			'.cf7_custom_style_2 select.wpcf7-form-control.wpcf7-select',
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-quiz'
		);
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_2_text_color');
		if($color !== ''){
			$styles['color'] = $color;
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_2 ::-webkit-input-placeholder',
			array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_2 :-moz-placeholder',
			array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_2 ::-moz-placeholder',
			array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_2 :-ms-input-placeholder',
			array('color' => $color)
			);
		}

		$font_size = oxides_edge_options()->getOptionValue('cf7_style_2_text_font_size');
		if($font_size !== ''){
			$styles['font-size'] = oxides_edge_filter_px($font_size) . 'px';
		}

		$line_height = oxides_edge_options()->getOptionValue('cf7_style_2_text_line_height');
		if($line_height !== ''){
			$styles['line-height'] = oxides_edge_filter_px($line_height) . 'px';
		}

		$font_family = oxides_edge_options()->getOptionValue('cf7_style_2_text_font_family');
		if(oxides_edge_is_font_option_valid($font_family)) {
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('cf7_style_2_text_font_style');
		if(!empty($font_style)){
			$styles['font-style'] = $font_style;
		}

		$font_weight = oxides_edge_options()->getOptionValue('cf7_style_2_text_font_weight');
		if(!empty($font_weight)){
			$styles['font-weight'] = $font_weight;
		}

		$text_transform = oxides_edge_options()->getOptionValue('cf7_style_2_text_text_transform');
		if(!empty($text_transform)){
			$styles['text-transform'] = $text_transform;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('cf7_style_2_text_letter_spacing');
		if($letter_spacing !== ''){
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing) . 'px';
		}

		$background_color = oxides_edge_options()->getOptionValue('cf7_style_2_background_color');
		$background_opacity = 1;
		if($background_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_2_background_transparency')){
				$background_opacity = oxides_edge_options()->getOptionValue('cf7_style_2_background_transparency');
			}
			$styles['background-color'] = oxides_edge_rgba_color($background_color,$background_opacity);
		}

		$border_color = oxides_edge_options()->getOptionValue('cf7_style_2_border_color');
		$border_opacity = 1;
		if($border_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_2_border_transparency')){
				$border_opacity = oxides_edge_options()->getOptionValue('cf7_style_2_border_transparency');
			}
			$styles['border-color'] = oxides_edge_rgba_color($border_color,$border_opacity);
		}

		$border_width = oxides_edge_options()->getOptionValue('cf7_style_2_border_width');
		if($border_width !== ''){
			$styles['border-width'] = oxides_edge_filter_px($border_width) . 'px';
		}

		$border_radius = oxides_edge_options()->getOptionValue('cf7_style_2_border_radius');
		if($border_radius !== ''){
			$styles['border-radius'] = oxides_edge_filter_px($border_radius) . 'px';
		}

		$padding_top = oxides_edge_options()->getOptionValue('cf7_style_2_padding_top');
		if($padding_top !== ''){
			$styles['padding-top'] = oxides_edge_filter_px($padding_top) . 'px';
		}

		$padding_right = oxides_edge_options()->getOptionValue('cf7_style_2_padding_right');
		if($padding_right !== ''){
			$styles['padding-right'] = oxides_edge_filter_px($padding_right) . 'px';
		}

		$padding_bottom = oxides_edge_options()->getOptionValue('cf7_style_2_padding_bottom');
		if($padding_bottom !== ''){
			$styles['padding-bottom'] = oxides_edge_filter_px($padding_bottom) . 'px';
		}

		$padding_left = oxides_edge_options()->getOptionValue('cf7_style_2_padding_left');
		if($padding_left !== ''){
			$styles['padding-left'] = oxides_edge_filter_px($padding_left) . 'px';
		}

		$margin_top = oxides_edge_options()->getOptionValue('cf7_style_2_margin_top');
		if($margin_top !== ''){
			$styles['margin-top'] = oxides_edge_filter_px($margin_top) . 'px';
		}

		$margin_bottom = oxides_edge_options()->getOptionValue('cf7_style_2_margin_bottom');
		if($margin_bottom !== ''){
			$styles['margin-bottom'] = oxides_edge_filter_px($margin_bottom) . 'px';
		}

		if(oxides_edge_options()->getOptionValue('cf7_style_2_textarea_height')) {
			$textarea_height = oxides_edge_options()->getOptionValue('cf7_style_2_textarea_height');
			echo oxides_edge_dynamic_css(
			'.cf7_custom_style_2 textarea.wpcf7-form-control.wpcf7-textarea',
			array('height' => oxides_edge_filter_px($textarea_height).'px')
			);
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_text_styles_2');
}

if(!function_exists('oxides_edge_contact_form7_focus_styles_2')) {
	/**
	 * Generates custom styles for Contact Form 7 elements focus
	 */
	function oxides_edge_contact_form7_focus_styles_2() {
		$selector = array(
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-text:focus',
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-number:focus',
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-date:focus',
			'.cf7_custom_style_2 textarea.wpcf7-form-control.wpcf7-textarea:focus',
			'.cf7_custom_style_2 select.wpcf7-form-control.wpcf7-select:focus',
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-quiz:focus'
		);
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_2_focus_text_color');
		if($color !== ''){
			$styles['color'] = $color;
			echo oxides_edge_dynamic_css(
				array(
					'.cf7_custom_style_2 input:focus::-webkit-input-placeholder',
					'.cf7_custom_style_2 textarea:focus::-webkit-input-placeholder'
				),
				array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
				array(
					'.cf7_custom_style_2 input:focus:-moz-placeholder',
					'.cf7_custom_style_2 textarea:focus:-moz-placeholder'
				),
				array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
				array(
					'.cf7_custom_style_2 input:focus::-moz-placeholder',
					'.cf7_custom_style_2 textarea:focus::-moz-placeholder'
				),
				array('color' => $color)
			);
			echo oxides_edge_dynamic_css(
				array(
					'.cf7_custom_style_2 input:focus:-ms-input-placeholder',
					'.cf7_custom_style_2 textarea:focus:-ms-input-placeholder'
				),
				array('color' => $color)
			);
		}

		$background_color = oxides_edge_options()->getOptionValue('cf7_style_2_focus_background_color');
		$background_opacity = 1;
		if($background_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_2_focus_background_transparency')){
				$background_opacity = oxides_edge_options()->getOptionValue('cf7_style_2_focus_background_transparency');
			}
			$styles['background-color'] = oxides_edge_rgba_color($background_color,$background_opacity);
		}

		$border_color = oxides_edge_options()->getOptionValue('cf7_style_2_focus_border_color');
		$border_opacity = 1;
		if($border_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_2_focus_border_transparency')){
				$border_opacity = oxides_edge_options()->getOptionValue('cf7_style_2_focus_border_transparency');
			}
			$styles['border-color'] = oxides_edge_rgba_color($border_color,$border_opacity);
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_focus_styles_2');
}

if(!function_exists('oxides_edge_contact_form7_label_styles_2')) {
	/**
	 * Generates custom styles for Contact Form 7 label
	 */
	function oxides_edge_contact_form7_label_styles_2() {
		$selector = array('.cf7_custom_style_2 p');
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_2_label_color');
		if($color !== ''){
			$styles['color'] = $color;
		}

		$font_size = oxides_edge_options()->getOptionValue('cf7_style_2_label_font_size');
		if($font_size !== ''){
			$styles['font-size'] = oxides_edge_filter_px($font_size) . 'px';
		}

		$line_height = oxides_edge_options()->getOptionValue('cf7_style_2_label_line_height');
		if($line_height !== ''){
			$styles['line-height'] = oxides_edge_filter_px($line_height) . 'px';
		}

		$font_family = oxides_edge_options()->getOptionValue('cf7_style_2_label_font_family');
		if(oxides_edge_is_font_option_valid($font_family)) {
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('cf7_style_2_label_font_style');
		if(!empty($font_style)){
			$styles['font-style'] = $font_style;
		}

		$font_weight = oxides_edge_options()->getOptionValue('cf7_style_2_label_font_weight');
		if(!empty($font_weight)){
			$styles['font-weight'] = $font_weight;
		}

		$text_transform = oxides_edge_options()->getOptionValue('cf7_style_2_label_text_transform');
		if(!empty($text_transform)){
			$styles['text-transform'] = $text_transform;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('cf7_style_2_label_letter_spacing');
		if($letter_spacing !== ''){
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing) . 'px';
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_label_styles_2');
}

if(!function_exists('oxides_edge_contact_form7_button_styles_2')) {
	/**
	 * Generates custom styles for Contact Form 7 button
	 */
	function oxides_edge_contact_form7_button_styles_2() {
		$selector = array(
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-submit'
		);
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_2_button_color');
		if($color !== ''){
			$styles['color'] = $color;
		}

		$font_size = oxides_edge_options()->getOptionValue('cf7_style_2_button_font_size');
		if($font_size !== ''){
			$styles['font-size'] = oxides_edge_filter_px($font_size) . 'px';
		}

		$height = oxides_edge_options()->getOptionValue('cf7_style_2_button_height');
		if($height !== ''){
			$styles['height'] = oxides_edge_filter_px($height) . 'px';
		}

		$font_family = oxides_edge_options()->getOptionValue('cf7_style_2_button_font_family');
		if(oxides_edge_is_font_option_valid($font_family)) {
			$styles['font-family'] = oxides_edge_get_font_option_val($font_family);
		}

		$font_style = oxides_edge_options()->getOptionValue('cf7_style_2_button_font_style');
		if(!empty($font_style)){
			$styles['font-style'] = $font_style;
		}

		$font_weight = oxides_edge_options()->getOptionValue('cf7_style_2_button_font_weight');
		if(!empty($font_weight)){
			$styles['font-weight'] = $font_weight;
		}

		$text_transform = oxides_edge_options()->getOptionValue('cf7_style_2_button_text_transform');
		if(!empty($text_transform)){
			$styles['text-transform'] = $text_transform;
		}

		$letter_spacing = oxides_edge_options()->getOptionValue('cf7_style_2_button_letter_spacing');
		if($letter_spacing !== ''){
			$styles['letter-spacing'] = oxides_edge_filter_px($letter_spacing) . 'px';
		}

		$background_color = oxides_edge_options()->getOptionValue('cf7_style_2_button_background_color');
		$background_opacity = 1;
		if($background_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_2_button_background_transparency')){
				$background_opacity = oxides_edge_options()->getOptionValue('cf7_style_2_button_background_transparency');
			}
			$styles['background-color'] = oxides_edge_rgba_color($background_color,$background_opacity);
		}

		$border_color = oxides_edge_options()->getOptionValue('cf7_style_2_button_border_color');
		$border_opacity = 1;
		if($border_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_2_button_border_transparency')){
				$border_opacity = oxides_edge_options()->getOptionValue('cf7_style_2_button_border_transparency');
			}
			$styles['border-color'] = oxides_edge_rgba_color($border_color,$border_opacity);
		}

		$border_width = oxides_edge_options()->getOptionValue('cf7_style_2_button_border_width');
		if($border_width !== ''){
			$styles['border-width'] = oxides_edge_filter_px($border_width) . 'px';
		}

		$border_radius = oxides_edge_options()->getOptionValue('cf7_style_2_button_border_radius');
		if($border_radius !== ''){
			$styles['border-radius'] = oxides_edge_filter_px($border_radius) . 'px';
		}

		$padding_left_right = oxides_edge_options()->getOptionValue('cf7_style_2_button_padding');
		if($padding_left_right !== ''){
			$styles['padding-left'] = oxides_edge_filter_px($padding_left_right) . 'px';
			$styles['padding-right'] = oxides_edge_filter_px($padding_left_right) . 'px';
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_button_styles_2');
}

if(!function_exists('oxides_edge_contact_form7_button_hover_styles_2')) {
	/**
	 * Generates custom styles for Contact Form 7 button
	 */
	function oxides_edge_contact_form7_button_hover_styles_2() {
		$selector = array(
			'.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-submit:not([disabled]):hover'
		);
		$styles = array();

		$color = oxides_edge_options()->getOptionValue('cf7_style_2_button_hover_color');
		if($color !== ''){
			$styles['color'] = $color;
		}

		$background_color = oxides_edge_options()->getOptionValue('cf7_style_2_button_hover_bckg_color');
		$background_opacity = 1;
		if($background_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_2_button_hover_bckg_transparency')){
				$background_opacity = oxides_edge_options()->getOptionValue('cf7_style_2_button_hover_bckg_transparency');
			}
			$styles['background-color'] = oxides_edge_rgba_color($background_color,$background_opacity);
		}

		$border_color = oxides_edge_options()->getOptionValue('cf7_style_2_button_hover_border_color');
		$border_opacity = 1;
		if($border_color !== ''){
			if(oxides_edge_options()->getOptionValue('cf7_style_2_button_hover_border_transparency')){
				$border_opacity = oxides_edge_options()->getOptionValue('cf7_style_2_button_hover_border_transparency');
			}
			$styles['border-color'] = oxides_edge_rgba_color($border_color,$border_opacity);
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_contact_form7_button_hover_styles_2');
}