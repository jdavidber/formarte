<?php
/**
 * Custom styles for Team shortcode
 * Hooks to oxides_edge_style_dynamic hook
 */

if(!function_exists('oxides_edge_team_shortcode_on_hover_overlay_styles')){
    function oxides_edge_team_shortcode_on_hover_overlay_styles(){
        $selector = '.edgtf-team.main-info-on-hover .edgtf-team-social-holder';
        $styles = array();

        if (oxides_edge_options()->getOptionValue('team_shortcode_on_hover_overlay_color')) {
            $team_shortcode_on_hover_overlay_color = oxides_edge_hex2rgb(oxides_edge_options()->getOptionValue('team_shortcode_on_hover_overlay_color'));
            if (oxides_edge_options()->getOptionValue('team_shortcode_on_hover_overlay_opacity') !== '') {
                $team_shortcode_on_hover_overlay_opacity = oxides_edge_options()->getOptionValue('team_shortcode_on_hover_overlay_opacity');
            } else {
                $team_shortcode_on_hover_overlay_opacity = 0.8;
            }

            $styles['background-color'] = 'rgba(' . $team_shortcode_on_hover_overlay_color[0] . ',' . $team_shortcode_on_hover_overlay_color[1] . ',' . $team_shortcode_on_hover_overlay_color[2] . ',' . $team_shortcode_on_hover_overlay_opacity . ')';

        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_on_hover_overlay_styles');
}

if(!function_exists('oxides_edge_team_shortcode_on_hover_title_styles')){
    function oxides_edge_team_shortcode_on_hover_title_styles(){
        $selector = '.edgtf-team.main-info-on-hover .edgtf-team-title-holder .edgtf-team-name';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_on_hover_title_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('team_shortcode_on_hover_title_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_on_hover_title_styles');
}

if(!function_exists('oxides_edge_team_shortcode_on_hover_position_styles')){
    function oxides_edge_team_shortcode_on_hover_position_styles(){
        $selector = '.edgtf-team.main-info-on-hover .edgtf-team-title-holder .edgtf-team-position';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_on_hover_position_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('team_shortcode_on_hover_position_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_on_hover_position_styles');
}

if(!function_exists('oxides_edge_team_shortcode_on_hover_icon_styles')){
    function oxides_edge_team_shortcode_on_hover_icon_styles(){
        $selector = '.edgtf-team.main-info-on-hover .edgtf-team-social .edgtf-icon-element';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_on_hover_icon_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('team_shortcode_on_hover_icon_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_on_hover_icon_styles');
}

if(!function_exists('oxides_edge_team_shortcode_on_hover_icon_shader_styles')){
    function oxides_edge_team_shortcode_on_hover_icon_shader_styles(){
        $selector = '.edgtf-team.main-info-on-hover .edgtf-icon-shortcode.circle,
                        .edgtf-team.main-info-on-hover .edgtf-icon-shortcode.square';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_on_hover_icon_background_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('team_shortcode_on_hover_icon_background_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_on_hover_icon_shader_styles');
}


if(!function_exists('oxides_edge_team_shortcode_on_hover_icon_hover_styles')){
    function oxides_edge_team_shortcode_on_hover_icon_hover_styles(){
        $selector = '.edgtf-team.main-info-on-hover .edgtf-icon-shortcode:hover .edgtf-icon-element';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_on_hover_icon_hover_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('team_shortcode_on_hover_icon_hover_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_on_hover_icon_hover_styles');
}

if(!function_exists('oxides_edge_team_shortcode_on_hover_icon_hover_shader_styles')){
    function oxides_edge_team_shortcode_on_hover_icon_hover_shader_styles(){
        $selector = '.edgtf-team.main-info-on-hover .edgtf-icon-shortcode.circle:hover,
                        .edgtf-team.main-info-on-hover .edgtf-icon-shortcode.square:hover';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_on_hover_icon_hover_background_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('team_shortcode_on_hover_icon_hover_background_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_on_hover_icon_hover_shader_styles');
}


if(!function_exists('oxides_edge_team_shortcode_below_image_title_styles')){
    function oxides_edge_team_shortcode_below_image_title_styles(){
        $selector = '.edgtf-team.main-info-below-image .edgtf-team-info .edgtf-team-name';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_below_image_title_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('team_shortcode_below_image_title_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_below_image_title_styles');
}

if(!function_exists('oxides_edge_team_shortcode_below_image_position_styles')){
    function oxides_edge_team_shortcode_below_image_position_styles(){
        $selector = '.edgtf-team.main-info-below-image .edgtf-team-info .edgtf-team-position';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_below_image_position_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('team_shortcode_below_image_position_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_below_image_position_styles');
}

if(!function_exists('oxides_edge_team_shortcode_below_image_icon_styles')){
    function oxides_edge_team_shortcode_below_image_icon_styles(){
        $selector = '.edgtf-team.main-info-below-image .edgtf-icon-shortcode .edgtf-icon-element';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_below_image_icon_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('team_shortcode_below_image_icon_color');
        }

        if(oxides_edge_options()->getOptionValue('team_shortcode_below_image_icon_background_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('team_shortcode_below_image_icon_background_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_below_image_icon_styles');
}

if(!function_exists('oxides_edge_team_shortcode_below_image_icon_hover_styles')){
    function oxides_edge_team_shortcode_below_image_icon_hover_styles(){
        $selector = '.edgtf-team.main-info-below-image .edgtf-icon-shortcode:hover .edgtf-icon-element';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_below_image_icon_hover_color')) {
            $styles['color'] = oxides_edge_options()->getOptionValue('team_shortcode_below_image_icon_hover_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_below_image_icon_hover_styles');
}

if(!function_exists('oxides_edge_team_shortcode_below_image_icon_hover_shader_styles')){
    function oxides_edge_team_shortcode_below_image_icon_hover_shader_styles(){
        $selector = '.edgtf-team.main-info-below-image .edgtf-icon-shortcode.circle:hover,
                        .edgtf-team.main-info-below-image .edgtf-icon-shortcode.square:hover';
        $styles = array();

        if(oxides_edge_options()->getOptionValue('team_shortcode_below_image_icon_hover_background_color')) {
            $styles['background-color'] = oxides_edge_options()->getOptionValue('team_shortcode_below_image_icon_hover_background_color');
        }

        echo oxides_edge_dynamic_css($selector, $styles);
    }
    add_action('oxides_edge_style_dynamic', 'oxides_edge_team_shortcode_below_image_icon_hover_shader_styles');
}

