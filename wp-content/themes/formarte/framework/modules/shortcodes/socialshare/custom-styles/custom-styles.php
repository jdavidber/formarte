<?php

if(!function_exists('oxides_edge_social_share_icon_styles')){
	function oxides_edge_social_share_icon_styles(){
		$selector = '.edgtf-social-share-holder ul li a';		
		$styles = array();

		if(oxides_edge_options()->getOptionValue('social_share_icon_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('social_share_icon_color');
		}

		$font_size = oxides_edge_options()->getOptionValue('social_share_icon_font_size');
		if($font_size !== '') {
			$styles['font-size'] = oxides_edge_filter_px($font_size).'px';
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_social_share_icon_styles');
}

if(!function_exists('oxides_edge_social_share_icon_hover_styles')){
	function oxides_edge_social_share_icon_hover_styles(){
		$selector = '.edgtf-social-share-holder ul li a:hover';		
		$styles = array();

		if(oxides_edge_options()->getOptionValue('social_share_icon_hover_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('social_share_icon_hover_color');
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_social_share_icon_hover_styles');
}

if(!function_exists('oxides_edge_social_share_dropdown_title_styles')){
	function oxides_edge_social_share_dropdown_title_styles(){
		$selector = array(
			'.edgtf-social-share-holder.edgtf-dropdown i.social_share',
			'.edgtf-social-share-holder.edgtf-dropdown .edgtf-social-share-title'
		);		
		$styles = array();

		if(oxides_edge_options()->getOptionValue('social_share_dropdown_title_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('social_share_dropdown_title_color');
		}

		$font_size = oxides_edge_options()->getOptionValue('social_share_dropdown_title_font_size');
		if($font_size !== '') {
			$styles['font-size'] = oxides_edge_filter_px($font_size).'px';
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_social_share_dropdown_title_styles');
}

if(!function_exists('oxides_edge_social_share_dropdown_title_hover_styles')){
	function oxides_edge_social_share_dropdown_title_hover_styles(){
		$selector = array(
			'.edgtf-social-share-holder.edgtf-dropdown:hover i.social_share',
			'.edgtf-social-share-holder.edgtf-dropdown:hover .edgtf-social-share-title'
		);
		$styles = array();

		if(oxides_edge_options()->getOptionValue('social_share_dropdown_title_hover_color')) {
			$styles['color'] = oxides_edge_options()->getOptionValue('social_share_dropdown_title_hover_color');
		}

		echo oxides_edge_dynamic_css($selector, $styles);
	}
	add_action('oxides_edge_style_dynamic', 'oxides_edge_social_share_dropdown_title_hover_styles');
}