<?php

if (!function_exists('oxides_edge_side_area_slide_from_right_type_style')) {

	function oxides_edge_side_area_slide_from_right_type_style()
	{

		if (oxides_edge_options()->getOptionValue('side_area_type') == 'side-menu-slide-from-right') {

			if (oxides_edge_options()->getOptionValue('side_area_width') !== '' && oxides_edge_options()->getOptionValue('side_area_width') >= 30) {
				echo oxides_edge_dynamic_css('.edgtf-side-menu-slide-from-right .edgtf-side-menu', array(
					'right' => '-'.oxides_edge_options()->getOptionValue('side_area_width') . '%',
					'width' => oxides_edge_options()->getOptionValue('side_area_width') . '%'
				));
			}

			if (oxides_edge_options()->getOptionValue('side_area_content_overlay_color') !== '') {

				echo oxides_edge_dynamic_css('.edgtf-side-menu-slide-from-right .edgtf-wrapper .edgtf-cover', array(
					'background-color' => oxides_edge_options()->getOptionValue('side_area_content_overlay_color')
				));

			}
			if (oxides_edge_options()->getOptionValue('side_area_content_overlay_opacity') !== '') {

				echo oxides_edge_dynamic_css('.edgtf-side-menu-slide-from-right.edgtf-right-side-menu-opened .edgtf-wrapper .edgtf-cover', array(
					'opacity' => oxides_edge_options()->getOptionValue('side_area_content_overlay_opacity')
				));
			}
		}
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_side_area_slide_from_right_type_style');

}

if (!function_exists('oxides_edge_side_area_icon_color_styles')) {

	function oxides_edge_side_area_icon_color_styles(){


		if (oxides_edge_options()->getOptionValue('side_area_icon_color') !== '') {
			echo oxides_edge_dynamic_css('a.edgtf-side-menu-button-opener span.line', array(
				'border-color' => oxides_edge_options()->getOptionValue('side_area_icon_color')
			));
		}

		if (oxides_edge_options()->getOptionValue('side_area_icon_background_color') !== '') {
			echo oxides_edge_dynamic_css('a.edgtf-side-menu-button-opener', array(
				'background-color' => oxides_edge_options()->getOptionValue('side_area_icon_background_color')
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_side_area_icon_color_styles');
}

if (!function_exists('oxides_edge_side_area_icon_spacing_styles')) {

	function oxides_edge_side_area_icon_spacing_styles(){
		$icon_spacing = array();

		if (oxides_edge_options()->getOptionValue('side_area_icon_padding_left') !== '') {
			$icon_spacing['padding-left'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_icon_padding_left')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_icon_padding_right') !== '') {
			$icon_spacing['padding-right'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_icon_padding_right')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_icon_margin_left') !== '') {
			$icon_spacing['margin-left'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_icon_margin_left')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_icon_margin_right') !== '') {
			$icon_spacing['margin-right'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_icon_margin_right')) . 'px';
		}

		if (!empty($icon_spacing)) {
			echo oxides_edge_dynamic_css('a.edgtf-side-menu-button-opener', $icon_spacing);
		}
	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_side_area_icon_spacing_styles');
}

if (!function_exists('oxides_edge_side_area_alignment')) {

	function oxides_edge_side_area_alignment()
	{

		if (oxides_edge_options()->getOptionValue('side_area_aligment')) {

			echo oxides_edge_dynamic_css('.edgtf-side-menu-slide-from-right .edgtf-side-menu, .edgtf-side-menu-slide-with-content .edgtf-side-menu, .edgtf-side-area-uncovered-from-content .edgtf-side-menu', array(
				'text-align' => oxides_edge_options()->getOptionValue('side_area_aligment')
			));

		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_side_area_alignment');

}

if (!function_exists('oxides_edge_side_area_styles')) {

	function oxides_edge_side_area_styles()
	{

		$side_area_styles = array();

		if (oxides_edge_options()->getOptionValue('side_area_background_color') !== '') {
			$side_area_styles['background-color'] = oxides_edge_options()->getOptionValue('side_area_background_color');
		}

		if (oxides_edge_options()->getOptionValue('side_area_padding_top') !== '') {
			$side_area_styles['padding-top'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_padding_top')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_padding_right') !== '') {
			$side_area_styles['padding-right'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_padding_right')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_padding_bottom') !== '') {
			$side_area_styles['padding-bottom'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_padding_bottom')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_padding_left') !== '') {
			$side_area_styles['padding-left'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_padding_left')) . 'px';
		}

		if (!empty($side_area_styles)) {
			echo oxides_edge_dynamic_css('.edgtf-side-menu', $side_area_styles);
		}

		if (oxides_edge_options()->getOptionValue('side_area_close_icon') == 'dark') {
			echo oxides_edge_dynamic_css('.edgtf-side-menu a.edgtf-close-side-menu span, .edgtf-side-menu a.edgtf-close-side-menu i', array(
				'color' => '#000000'
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_side_area_styles');

}

if (!function_exists('oxides_edge_side_area_title_styles')) {

	function oxides_edge_side_area_title_styles()
	{

		$title_styles = array();

		if (oxides_edge_options()->getOptionValue('side_area_title_color') !== '') {
			$title_styles['color'] = oxides_edge_options()->getOptionValue('side_area_title_color');
		}

		if (oxides_edge_options()->getOptionValue('side_area_title_fontsize') !== '') {
			$title_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_title_fontsize')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_title_lineheight') !== '') {
			$title_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_title_lineheight')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_title_texttransform') !== '') {
			$title_styles['text-transform'] = oxides_edge_options()->getOptionValue('side_area_title_texttransform');
		}

		if (oxides_edge_options()->getOptionValue('side_area_title_google_fonts') !== '-1') {
			$title_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('side_area_title_google_fonts')) . ', sans-serif';
		}

		if (oxides_edge_options()->getOptionValue('side_area_title_fontstyle') !== '') {
			$title_styles['font-style'] = oxides_edge_options()->getOptionValue('side_area_title_fontstyle');
		}

		if (oxides_edge_options()->getOptionValue('side_area_title_fontweight') !== '') {
			$title_styles['font-weight'] = oxides_edge_options()->getOptionValue('side_area_title_fontweight');
		}

		if (oxides_edge_options()->getOptionValue('side_area_title_letterspacing') !== '') {
			$title_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_title_letterspacing')) . 'px';
		}

		if (!empty($title_styles)) {

			echo oxides_edge_dynamic_css('.edgtf-side-menu .edgtf-side-menu-title *', $title_styles);

		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_side_area_title_styles');

}

if (!function_exists('oxides_edge_side_area_text_styles')) {

	function oxides_edge_side_area_text_styles()
	{
		$text_styles = array();

		if (oxides_edge_options()->getOptionValue('side_area_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('side_area_text_google_fonts')) . ', sans-serif';
		}

		if (oxides_edge_options()->getOptionValue('side_area_text_fontsize') !== '') {
			$text_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_text_fontsize')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_text_lineheight') !== '') {
			$text_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_text_lineheight')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('side_area_text_letterspacing')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('side_area_text_fontweight') !== '') {
			$text_styles['font-weight'] = oxides_edge_options()->getOptionValue('side_area_text_fontweight');
		}

		if (oxides_edge_options()->getOptionValue('side_area_text_fontstyle') !== '') {
			$text_styles['font-style'] = oxides_edge_options()->getOptionValue('side_area_text_fontstyle');
		}

		if (oxides_edge_options()->getOptionValue('side_area_text_texttransform') !== '') {
			$text_styles['text-transform'] = oxides_edge_options()->getOptionValue('side_area_text_texttransform');
		}

		if (oxides_edge_options()->getOptionValue('side_area_text_color') !== '') {
			$text_styles['color'] = oxides_edge_options()->getOptionValue('side_area_text_color');
		}

		if (!empty($text_styles)) {

			echo oxides_edge_dynamic_css('.edgtf-side-menu .widget, .edgtf-side-menu .widget.widget_search form, .edgtf-side-menu .widget.widget_search form input[type="text"], .edgtf-side-menu .widget.widget_search form input[type="submit"], .edgtf-side-menu .widget h6, .edgtf-side-menu .widget h6 a, .edgtf-side-menu .widget p, .edgtf-side-menu .widget li a, .edgtf-side-menu .widget.widget_rss li a.rsswidget, .edgtf-side-menu #wp-calendar caption,.edgtf-side-menu .widget li, .edgtf-side-menu h3, .edgtf-side-menu .widget.widget_archive select, .edgtf-side-menu .widget.widget_categories select, .edgtf-side-menu .widget.widget_text select, .edgtf-side-menu .widget.widget_search form input[type="submit"], .edgtf-side-menu #wp-calendar th, .edgtf-side-menu #wp-calendar td, .edgtf-side-menu .q_social_icon_holder i.simple_social', $text_styles);

		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_side_area_text_styles');

}

if (!function_exists('oxides_edge_side_area_link_styles')) {

	function oxides_edge_side_area_link_styles()
	{
		$link_styles = array();

		if (oxides_edge_options()->getOptionValue('sidearea_link_font_family') !== '-1') {
			$link_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('sidearea_link_font_family')) . ',sans-serif';
		}

		if (oxides_edge_options()->getOptionValue('sidearea_link_font_size') !== '') {
			$link_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('sidearea_link_font_size')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('sidearea_link_line_height') !== '') {
			$link_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('sidearea_link_line_height')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('sidearea_link_letter_spacing') !== '') {
			$link_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('sidearea_link_letter_spacing')) . 'px';
		}

		if (oxides_edge_options()->getOptionValue('sidearea_link_font_weight') !== '') {
			$link_styles['font-weight'] = oxides_edge_options()->getOptionValue('sidearea_link_font_weight');
		}

		if (oxides_edge_options()->getOptionValue('sidearea_link_font_style') !== '') {
			$link_styles['font-style'] = oxides_edge_options()->getOptionValue('sidearea_link_font_style');
		}

		if (oxides_edge_options()->getOptionValue('sidearea_link_text_transform') !== '') {
			$link_styles['text-transform'] = oxides_edge_options()->getOptionValue('sidearea_link_text_transform');
		}

		if (oxides_edge_options()->getOptionValue('sidearea_link_color') !== '') {
			$link_styles['color'] = oxides_edge_options()->getOptionValue('sidearea_link_color');
		}

		if (!empty($link_styles)) {

			echo oxides_edge_dynamic_css('.edgtf-side-menu .widget li a, .edgtf-side-menu .widget a:not(.qbutton)', $link_styles);

		}

		if (oxides_edge_options()->getOptionValue('sidearea_link_hover_color') !== '') {
			echo oxides_edge_dynamic_css('.edgtf-side-menu .widget a:hover, .edgtf-side-menu .widget li:hover, .edgtf-side-menu .widget li:hover>a', array(
				'color' => oxides_edge_options()->getOptionValue('sidearea_link_hover_color')
			));
		}

	}

	add_action('oxides_edge_style_dynamic', 'oxides_edge_side_area_link_styles');
}