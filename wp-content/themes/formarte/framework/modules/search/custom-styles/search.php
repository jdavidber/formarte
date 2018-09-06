<?php

if (!function_exists('oxides_edge_search_covers_header_style')) {

	function oxides_edge_search_covers_header_style()
	{

		if (oxides_edge_options()->getOptionValue('search_height') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-header-bottom.edgtf-animated .edgtf-form-holder-outer, .edgtf-search-slide-header-bottom .edgtf-form-holder-outer, .edgtf-search-slide-header-bottom', array(
				'height' => oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_height')) . 'px'
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_covers_header_style');

}

if (!function_exists('oxides_edge_search_opener_icon_size')) {

	function oxides_edge_search_opener_icon_size()
	{

		if (oxides_edge_options()->getOptionValue('header_search_icon_size')) {
			echo oxides_edge_dynamic_css('.edgtf-search-opener', array(
				'font-size' => oxides_edge_filter_px(oxides_edge_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}
		if (oxides_edge_options()->getOptionValue('header_search_icon_line_height')) {
			echo oxides_edge_dynamic_css('.edgtf-search-opener', array(
				'line-height' => oxides_edge_filter_px(oxides_edge_options()->getOptionValue('header_search_icon_line_height')) . 'px'
			));
		}
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_opener_icon_size');

}

if (!function_exists('oxides_edge_search_opener_icon_colors')) {

	function oxides_edge_search_opener_icon_colors() {

		if (oxides_edge_options()->getOptionValue('header_search_icon_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-opener', array(
				'color' => oxides_edge_options()->getOptionValue('header_search_icon_color')
			));
		}

		if (oxides_edge_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-opener:hover', array(
				'color' => oxides_edge_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if (oxides_edge_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header) .edgtf-search-opener,
			.edgtf-light-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-search-opener,
			.edgtf-light-header .edgtf-top-bar .edgtf-search-opener', array(
				'color' => oxides_edge_options()->getOptionValue('header_light_search_icon_color') . ' !important'
			));
		}

		if (oxides_edge_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header) .edgtf-search-opener:hover,
			.edgtf-light-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-search-opener:hover,
			.edgtf-light-header .edgtf-top-bar .edgtf-search-opener:hover', array(
				'color' => oxides_edge_options()->getOptionValue('header_light_search_icon_hover_color') . ' !important'
			));
		}

		if (oxides_edge_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header) .edgtf-search-opener,
			.edgtf-dark-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-search-opener,
			.edgtf-dark-header .edgtf-top-bar .edgtf-search-opener', array(
				'color' => oxides_edge_options()->getOptionValue('header_dark_search_icon_color') . ' !important'
			));
		}
		if (oxides_edge_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header) .edgtf-search-opener:hover,
			.edgtf-dark-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-search-opener:hover,
			.edgtf-dark-header .edgtf-top-bar .edgtf-search-opener:hover', array(
				'color' => oxides_edge_options()->getOptionValue('header_dark_search_icon_hover_color') . ' !important'
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_opener_icon_colors');

}

if (!function_exists('oxides_edge_search_opener_icon_background_colors')) {

	function oxides_edge_search_opener_icon_background_colors(){

		if (oxides_edge_options()->getOptionValue('search_icon_background_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-opener', array(
				'background-color' => oxides_edge_options()->getOptionValue('search_icon_background_color')
			));
		}

		if (oxides_edge_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-opener:hover', array(
				'background-color' => oxides_edge_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

		if (oxides_edge_options()->getOptionValue('search_icon_border_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-opener', array(
				'border-left-color' => oxides_edge_options()->getOptionValue('search_icon_border_color')
			));
		}

		if (oxides_edge_options()->getOptionValue('search_icon_border_width')) {
			echo oxides_edge_dynamic_css('.edgtf-search-opener', array(
				'border-left-width' => oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_icon_border_width')) . 'px'
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_opener_icon_background_colors');
}

if (!function_exists('oxides_edge_search_opener_text_styles')) {

	function oxides_edge_search_opener_text_styles()
	{
		$text_styles = array();

		if (oxides_edge_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = oxides_edge_options()->getOptionValue('search_icon_text_color');
		}
		if (oxides_edge_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_icon_text_fontsize')) . 'px';
		}
		if (oxides_edge_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_icon_text_lineheight')) . 'px';
		}
		if (oxides_edge_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = oxides_edge_options()->getOptionValue('search_icon_text_texttransform');
		}
		if (oxides_edge_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('search_icon_text_google_fonts')) . ', sans-serif';
		}
		if (oxides_edge_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = oxides_edge_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if (oxides_edge_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = oxides_edge_options()->getOptionValue('search_icon_text_fontweight');
		}

		if (!empty($text_styles)) {
			echo oxides_edge_dynamic_css('.edgtf-search-icon-text', $text_styles);
		}
		if (oxides_edge_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-opener:hover .edgtf-search-icon-text', array(
				'color' => oxides_edge_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_opener_text_styles');
}

if (!function_exists('oxides_edge_search_opener_spacing')) {

	function oxides_edge_search_opener_spacing()
	{
		$spacing_styles = array();

		if (oxides_edge_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if (oxides_edge_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if (oxides_edge_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if (oxides_edge_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo oxides_edge_dynamic_css('.edgtf-search-opener', $spacing_styles);
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_opener_spacing');
}

if (!function_exists('oxides_edge_search_bar_background')) {

	function oxides_edge_search_bar_background()
	{

		if (oxides_edge_options()->getOptionValue('search_background_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-header-bottom, .edgtf-search-cover, .edgtf-search-fade .edgtf-fullscreen-search-holder .edgtf-fullscreen-search-table, .edgtf-fullscreen-search-overlay, .edgtf-search-slide-window-top, .edgtf-search-slide-window-top input[type="text"]', array(
				'background-color' => oxides_edge_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_bar_background');
}

if (!function_exists('oxides_edge_search_text_styles')) {

	function oxides_edge_search_text_styles()
	{
		$text_styles = array();

		if (oxides_edge_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = oxides_edge_options()->getOptionValue('search_text_color');
		}
		if (oxides_edge_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_text_fontsize')) . 'px';
		}
		if (oxides_edge_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = oxides_edge_options()->getOptionValue('search_text_texttransform');
		}
		if (oxides_edge_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('search_text_google_fonts')) . ', sans-serif';
		}
		if (oxides_edge_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = oxides_edge_options()->getOptionValue('search_text_fontstyle');
		}
		if (oxides_edge_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = oxides_edge_options()->getOptionValue('search_text_fontweight');
		}
		if (oxides_edge_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-header-bottom input[type="text"], .edgtf-search-cover input[type="text"], .edgtf-fullscreen-search-holder .edgtf-search-field, .edgtf-search-slide-window-top input[type="text"]', $text_styles);
		}
		if (oxides_edge_options()->getOptionValue('search_text_disabled_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-header-bottom.edgtf-disabled input[type="text"]::-webkit-input-placeholder, .edgtf-search-slide-header-bottom.edgtf-disabled input[type="text"]::-moz-input-placeholder', array(
				'color' => oxides_edge_options()->getOptionValue('search_text_disabled_color')
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_text_styles');
}

if (!function_exists('oxides_edge_search_label_styles')) {

	function oxides_edge_search_label_styles()
	{
		$text_styles = array();

		if (oxides_edge_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = oxides_edge_options()->getOptionValue('search_label_text_color');
		}
		if (oxides_edge_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_label_text_fontsize')) . 'px';
		}
		if (oxides_edge_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = oxides_edge_options()->getOptionValue('search_label_text_texttransform');
		}
		if (oxides_edge_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('search_label_text_google_fonts')) . ', sans-serif';
		}
		if (oxides_edge_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = oxides_edge_options()->getOptionValue('search_label_text_fontstyle');
		}
		if (oxides_edge_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = oxides_edge_options()->getOptionValue('search_label_text_fontweight');
		}
		if (oxides_edge_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_label_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo oxides_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-label', $text_styles);
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_label_styles');
}

if (!function_exists('oxides_edge_search_icon_styles')) {

	function oxides_edge_search_icon_styles()
	{

		if (oxides_edge_options()->getOptionValue('search_icon_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-window-top > i, .edgtf-search-slide-header-bottom .edgtf-search-submit i, .edgtf-fullscreen-search-holder .edgtf-search-submit', array(
				'color' => oxides_edge_options()->getOptionValue('search_icon_color')
			));
		}
		if (oxides_edge_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-window-top > i:hover, .edgtf-search-slide-header-bottom .edgtf-search-submit i:hover, .edgtf-fullscreen-search-holder .edgtf-search-submit:hover', array(
				'color' => oxides_edge_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if (oxides_edge_options()->getOptionValue('search_icon_disabled_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-header-bottom.edgtf-disabled .edgtf-search-submit i, .edgtf-search-slide-header-bottom.edgtf-disabled .edgtf-search-submit i:hover', array(
				'color' => oxides_edge_options()->getOptionValue('search_icon_disabled_color')
			));
		}
		if (oxides_edge_options()->getOptionValue('search_icon_size') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-window-top > i, .edgtf-search-slide-header-bottom .edgtf-search-submit i, .edgtf-fullscreen-search-holder .edgtf-search-submit', array(
				'font-size' => oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_icon_styles');
}

if (!function_exists('oxides_edge_search_close_icon_styles')) {

	function oxides_edge_search_close_icon_styles()
	{

		if (oxides_edge_options()->getOptionValue('search_close_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-window-top .edgtf-search-close i, .edgtf-search-cover .edgtf-search-close i, .edgtf-fullscreen-search-close i', array(
				'color' => oxides_edge_options()->getOptionValue('search_close_color')
			));
		}
		if (oxides_edge_options()->getOptionValue('search_close_hover_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-window-top .edgtf-search-close i:hover, .edgtf-search-cover .edgtf-search-close i:hover, .edgtf-fullscreen-search-close i:hover', array(
				'color' => oxides_edge_options()->getOptionValue('search_close_hover_color')
			));
		}
		if (oxides_edge_options()->getOptionValue('search_close_size') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-search-slide-window-top .edgtf-search-close i, .edgtf-search-cover .edgtf-search-close i, .edgtf-fullscreen-search-close i', array(
				'font-size' => oxides_edge_filter_px(oxides_edge_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_search_close_icon_styles');
}

?>
