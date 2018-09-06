<?php

if(!function_exists('oxides_edge_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function oxides_edge_header_top_bar_styles() {
        global $oxides_edge_options;

        if($oxides_edge_options['top_bar_height'] !== '') {
            echo oxides_edge_dynamic_css('.edgtf-top-bar', array('height' => $oxides_edge_options['top_bar_height'].'px'));
            echo oxides_edge_dynamic_css('.edgtf-top-bar .edgtf-logo-wrapper a', array('max-height' => $oxides_edge_options['top_bar_height'].'px'));
        }

        if($oxides_edge_options['top_bar_in_grid'] == 'yes') {
            $top_bar_grid_selector = '.edgtf-top-bar .edgtf-grid .edgtf-vertical-align-containers';
            $top_bar_grid_styles = array();
            if($oxides_edge_options['top_bar_grid_background_color'] !== '') {
                $grid_background_color    = $oxides_edge_options['top_bar_grid_background_color'];
                $grid_background_transparency = 1;

                if(oxides_edge_options()->getOptionValue('top_bar_grid_background_transparency')) {
                    $grid_background_transparency = oxides_edge_options()->getOptionValue('top_bar_grid_background_transparency');
                }

                $grid_background_color = oxides_edge_rgba_color($grid_background_color, $grid_background_transparency);
                $top_bar_grid_styles['background-color'] = $grid_background_color;
            }

            echo oxides_edge_dynamic_css($top_bar_grid_selector, $top_bar_grid_styles);
        }

        $background_color = oxides_edge_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();
        if($background_color !== '') {
            $background_transparency = 1;
            if(oxides_edge_options()->getOptionValue('top_bar_background_transparency') !== '') {
               $background_transparency = oxides_edge_options()->getOptionValue('top_bar_background_transparency');
            }

            $background_color = oxides_edge_rgba_color($background_color, $background_transparency);
            $top_bar_styles['background-color'] = $background_color;
        }

        echo oxides_edge_dynamic_css('.edgtf-top-bar', $top_bar_styles);
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_header_top_bar_styles');
}

if(!function_exists('oxides_edge_header_standard_menu_area_styles')) {
    /**
     * Generates styles for header standard menu
     */
    function oxides_edge_header_standard_menu_area_styles() {
        global $oxides_edge_options;

        $menu_area_header_standard_styles = array();

        if($oxides_edge_options['menu_area_background_color_header_standard'] !== '') {
            $menu_area_background_color        = $oxides_edge_options['menu_area_background_color_header_standard'];
            $menu_area_background_transparency = 1;

            if($oxides_edge_options['menu_area_background_transparency_header_standard'] !== '') {
                $menu_area_background_transparency = $oxides_edge_options['menu_area_background_transparency_header_standard'];
            }

            $menu_area_header_standard_styles['background-color'] = oxides_edge_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($oxides_edge_options['menu_area_border_color_header_standard'] !== '' && $oxides_edge_options['menu_area_enable_border_bottom_header_standard'] !== 'no') {
            $menu_area_header_standard_styles['border-bottom-color'] = $oxides_edge_options['menu_area_border_color_header_standard'];
        }

        if($oxides_edge_options['menu_area_enable_border_bottom_header_standard'] === 'no') {
            $menu_area_header_standard_styles['border-bottom'] = '0';
        }

        if($oxides_edge_options['menu_area_height_header_standard'] !== '') {
            $menu_area_header_standard_styles['height'] = oxides_edge_filter_px($oxides_edge_options['menu_area_height_header_standard']).'px';
        }

        echo oxides_edge_dynamic_css('.edgtf-header-standard .edgtf-page-header .edgtf-fixed-wrapper.edgtf-fixed:not(.edgtf-fixed-show) .edgtf-menu-area', $menu_area_header_standard_styles);

        $menu_area_grid_header_standard_styles = array();

        if($oxides_edge_options['menu_area_in_grid_header_standard'] == 'yes' && $oxides_edge_options['menu_area_grid_background_color_header_standard'] !== '') {
            $menu_area_grid_background_color        = $oxides_edge_options['menu_area_grid_background_color_header_standard'];
            $menu_area_grid_background_transparency = 1;

            if($oxides_edge_options['menu_area_grid_background_transparency_header_standard'] !== '') {
                $menu_area_grid_background_transparency = $oxides_edge_options['menu_area_grid_background_transparency_header_standard'];
            }

            $menu_area_grid_header_standard_styles['background-color'] = oxides_edge_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);
        }

        echo oxides_edge_dynamic_css('.edgtf-header-standard .edgtf-page-header .edgtf-menu-area .edgtf-grid .edgtf-vertical-align-containers', $menu_area_grid_header_standard_styles);
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_header_standard_menu_area_styles');
}

if(!function_exists('oxides_edge_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function oxides_edge_sticky_header_styles() {
        global $oxides_edge_options;

        if($oxides_edge_options['sticky_header_in_grid'] == 'yes' && $oxides_edge_options['sticky_header_grid_background_color'] !== '') {
            $sticky_header_grid_background_color        = $oxides_edge_options['sticky_header_grid_background_color'];
            $sticky_header_grid_background_transparency = 1;

            if($oxides_edge_options['sticky_header_grid_transparency'] !== '') {
                $sticky_header_grid_background_transparency = $oxides_edge_options['sticky_header_grid_transparency'];
            }

            echo oxides_edge_dynamic_css('.edgtf-page-header .edgtf-sticky-header .edgtf-grid .edgtf-vertical-align-containers', array('background-color' => oxides_edge_rgba_color($sticky_header_grid_background_color, $sticky_header_grid_background_transparency)));
        }

        if($oxides_edge_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $oxides_edge_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($oxides_edge_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $oxides_edge_options['sticky_header_transparency'];
            }

            echo oxides_edge_dynamic_css('.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array('background-color' => oxides_edge_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($oxides_edge_options['sticky_header_height'] !== '') {
            echo oxides_edge_dynamic_css('.edgtf-page-header .edgtf-sticky-header', array('height' => $oxides_edge_options['sticky_header_height'].'px'));
        }

        $sticky_menu_item_styles = array();
        if($oxides_edge_options['sticky_color'] !== '') {
            $sticky_menu_item_styles['color'] = $oxides_edge_options['sticky_color'];
        }
        if($oxides_edge_options['sticky_google_fonts'] !== '-1') {
            $sticky_menu_item_styles['font-family'] = oxides_edge_get_formatted_font_family($oxides_edge_options['sticky_google_fonts']);
        }
        if($oxides_edge_options['sticky_fontsize'] !== '') {
            $sticky_menu_item_styles['font-size'] = $oxides_edge_options['sticky_fontsize'].'px';
        }
        if($oxides_edge_options['sticky_lineheight'] !== '') {
            $sticky_menu_item_styles['line-height'] = $oxides_edge_options['sticky_lineheight'].'px';
        }
        if($oxides_edge_options['sticky_texttransform'] !== '') {
            $sticky_menu_item_styles['text-transform'] = $oxides_edge_options['sticky_texttransform'];
        }
        if($oxides_edge_options['sticky_fontstyle'] !== '') {
            $sticky_menu_item_styles['font-style'] = $oxides_edge_options['sticky_fontstyle'];
        }
        if($oxides_edge_options['sticky_fontweight'] !== '') {
            $sticky_menu_item_styles['font-weight'] = $oxides_edge_options['sticky_fontweight'];
        }
        if($oxides_edge_options['sticky_letterspacing'] !== '') {
            $sticky_menu_item_styles['letter-spacing'] = $oxides_edge_options['sticky_letterspacing'].'px';
        }

        $sticky_menu_item_selector = array(
            '.edgtf-main-menu.edgtf-sticky-nav > ul > li > a'
        );

        echo oxides_edge_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if($oxides_edge_options['sticky_hovercolor'] !== '') {
            $sticky_menu_item_hover_styles['color'] = $oxides_edge_options['sticky_hovercolor'];
        }

        $sticky_menu_item_hover_selector = array(
            '.edgtf-main-menu.edgtf-sticky-nav > ul > li:hover > a',
            '.edgtf-main-menu.edgtf-sticky-nav > ul > li.edgtf-active-item:hover > a',
            'body:not(.edgtf-menu-item-first-level-bg-color) .edgtf-main-menu.edgtf-sticky-nav > ul > li:hover > a',
            'body:not(.edgtf-menu-item-first-level-bg-color) .edgtf-main-menu.edgtf-sticky-nav > ul > li.edgtf-active-item:hover > a'
        );

        echo oxides_edge_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_sticky_header_styles');
}

if(!function_exists('oxides_edge_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function oxides_edge_fixed_header_styles() {
        global $oxides_edge_options;

        if($oxides_edge_options['fixed_header_grid_background_color'] !== '') {

            $fixed_header_grid_background_color              = $oxides_edge_options['fixed_header_grid_background_color'];
            $fixed_header_grid_background_color_transparency = 1;

            if($oxides_edge_options['fixed_header_grid_transparency'] !== '') {
                $fixed_header_grid_background_color_transparency = $oxides_edge_options['fixed_header_grid_transparency'];
            }

            echo oxides_edge_dynamic_css('.edgtf-header-standard .edgtf-fixed-wrapper.fixed .edgtf-grid .edgtf-vertical-align-containers',
                array('background-color' => oxides_edge_rgba_color($fixed_header_grid_background_color, $fixed_header_grid_background_color_transparency)));
        }

        if($oxides_edge_options['fixed_header_background_color'] !== '') {

            $fixed_header_background_color              = $oxides_edge_options['fixed_header_background_color'];
            $fixed_header_background_color_transparency = 1;

            if($oxides_edge_options['fixed_header_transparency'] !== '') {
                $fixed_header_background_color_transparency = $oxides_edge_options['fixed_header_transparency'];
            }

            echo oxides_edge_dynamic_css('.edgtf-header-standard .edgtf-fixed-wrapper.fixed .edgtf-menu-area',
                array('background-color' => oxides_edge_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
        }

        $fixed_header_styles = array();

        if($oxides_edge_options['fixed_header_bottom_border_color'] !== '' && $oxides_edge_options['fixed_header_enable_border_bottom'] !== 'no') {
            $fixed_header_styles['border-bottom-color'] = $oxides_edge_options['fixed_header_bottom_border_color'].' !important';
        }

        if($oxides_edge_options['fixed_header_enable_border_bottom'] === 'no') {
            $fixed_header_styles['border-bottom'] = '0 !important';
        }

        echo oxides_edge_dynamic_css('.edgtf-page-header .edgtf-fixed-wrapper.edgtf-fixed.edgtf-fixed-show .edgtf-menu-area', $fixed_header_styles);
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_fixed_header_styles');
}

if(!function_exists('oxides_edge_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function oxides_edge_main_menu_styles() {
        global $oxides_edge_options;

        if($oxides_edge_options['menu_color'] !== '' || $oxides_edge_options['menu_fontsize'] != '' || $oxides_edge_options['menu_fontstyle'] !== '' || $oxides_edge_options['menu_fontweight'] !== '' || $oxides_edge_options['menu_texttransform'] !== '' || $oxides_edge_options['menu_letterspacing'] !== '' || $oxides_edge_options['menu_google_fonts'] != "-1") { ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li > a,
            .edgtf-page-header #lang_sel > ul > li > a,
            .edgtf-page-header #lang_sel_click > ul > li > a,
            .edgtf-page-header #lang_sel ul > li:hover > a{
            <?php if($oxides_edge_options['menu_color']) { ?> color: <?php echo esc_attr($oxides_edge_options['menu_color']); ?>; <?php } ?>
            <?php if($oxides_edge_options['menu_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $oxides_edge_options['menu_google_fonts'])); ?>', sans-serif;
            <?php } ?>
            <?php if($oxides_edge_options['menu_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($oxides_edge_options['menu_fontsize']); ?>px; <?php } ?>
            <?php if($oxides_edge_options['menu_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($oxides_edge_options['menu_fontstyle']); ?>; <?php } ?>
            <?php if($oxides_edge_options['menu_fontweight'] !== '') { ?> font-weight: <?php echo esc_attr($oxides_edge_options['menu_fontweight']); ?>; <?php } ?>
            <?php if($oxides_edge_options['menu_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($oxides_edge_options['menu_texttransform']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['menu_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($oxides_edge_options['menu_letterspacing']); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_google_fonts'] != "-1") { ?>
            .edgtf-page-header #lang_sel_list{
            font-family: '<?php echo esc_attr(str_replace('+', ' ', $oxides_edge_options['menu_google_fonts'])); ?>', sans-serif !important;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_hovercolor'] !== '') { ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a,
            .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a,
            body:not(.edgtf-menu-item-first-level-bg-color) .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a,
            body:not(.edgtf-menu-item-first-level-bg-color) .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a,
            .edgtf-page-header #lang_sel ul li a:hover,
            .edgtf-page-header #lang_sel_click > ul > li a:hover{
            color: <?php echo esc_attr($oxides_edge_options['menu_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_activecolor'] !== '') { ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a,
            body:not(.edgtf-menu-item-first-level-bg-color) .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a{
            color: <?php echo esc_attr($oxides_edge_options['menu_activecolor']); ?>;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_item_icon_position'] == "top" && $oxides_edge_options['menu_item_icon_size'] !== "") { ?>
            body.edgtf-menu-with-large-icons .edgtf-main-menu.edgtf-default-nav > ul > li > a span.item_inner i{
            font-size: <?php echo esc_attr($oxides_edge_options['menu_item_icon_size']); ?>px !important;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_text_background_color'] !== '') { ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li > a span.item_inner{
                background-color: <?php echo esc_attr($oxides_edge_options['menu_text_background_color']); ?>;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_hover_background_color'] !== '') {
            $menu_hover_background_color = $oxides_edge_options['menu_hover_background_color'];

            if($oxides_edge_options['menu_hover_background_color_transparency'] !== '') {
                $menu_hover_background_color_rgb = oxides_edge_hex2rgb($menu_hover_background_color);
                $menu_hover_background_color     = 'rgba('.$menu_hover_background_color_rgb[0].', '.$menu_hover_background_color_rgb[1].', '.$menu_hover_background_color_rgb[2].', '.$oxides_edge_options['menu_hover_background_color_transparency'].')';
            } ?>

            .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a span.item_inner,
            .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a span.item_inner {
                background-color: <?php echo esc_attr($menu_hover_background_color); ?>;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_active_background_color'] !== '') {
            $menu_active_background_color = $oxides_edge_options['menu_active_background_color'];

            if($oxides_edge_options['menu_active_background_color_transparency'] !== '') {
                $menu_active_background_color_rgb = oxides_edge_hex2rgb($menu_active_background_color);
                $menu_active_background_color     = 'rgba('.$menu_active_background_color_rgb[0].', '.$menu_active_background_color_rgb[1].', '.$menu_active_background_color_rgb[2].', '.$oxides_edge_options['menu_active_background_color_transparency'].')';
            }
            ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a span.item_inner {
                background-color: <?php echo esc_attr($menu_active_background_color); ?>;
            }
        <?php } ?>


        <?php if($oxides_edge_options['menu_light_hovercolor'] !== '') { ?>
            .light .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a,
            .light .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a{
            color: <?php echo esc_attr($oxides_edge_options['menu_light_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_light_activecolor'] !== '') { ?>
            .light .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a{
            color: <?php echo esc_attr($oxides_edge_options['menu_light_activecolor']); ?> !important;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_dark_hovercolor'] !== '') { ?>
            .dark .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a,
            .dark .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a{
            color: <?php echo esc_attr($oxides_edge_options['menu_dark_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_dark_activecolor'] !== '') { ?>
            .dark .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a{
            color: <?php echo esc_attr($oxides_edge_options['menu_dark_activecolor']); ?>;
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_lineheight'] != "" || $oxides_edge_options['menu_padding_left_right'] !== '') { ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li > a span.item_inner{
            <?php if($oxides_edge_options['menu_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($oxides_edge_options['menu_lineheight']); ?>px; <?php } ?>
            <?php if($oxides_edge_options['menu_padding_left_right']) { ?> padding: 0  <?php echo esc_attr($oxides_edge_options['menu_padding_left_right']); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if($oxides_edge_options['menu_margin_left_right'] !== '') { ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li{
            margin: 0  <?php echo esc_attr($oxides_edge_options['menu_margin_left_right']); ?>px;
            }
        <?php } ?>

        <?php if($oxides_edge_options['enable_menu_item_separators'] == "no") { ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li > a span.plus{
                display: none;
            }
        <?php } ?>

        <?php if($oxides_edge_options['enable_menu_item_separators'] == "yes" && $oxides_edge_options['menu_item_separators_color'] !== '') { ?>
            .edgtf-main-menu.edgtf-default-nav > ul > li > a span.plus{
                background-color: <?php echo esc_attr($oxides_edge_options['menu_item_separators_color']); ?>;
            }
        <?php } ?>


        <?php if($oxides_edge_options['enable_menu_item_text_decoration'] == 'yes') { ?>

            <?php if($oxides_edge_options['menu_item_text_decoration_style'] == 'none') { ?>
                .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a span.item_inner,
                .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a span.item_inner{
                text-decoration: none;
                }
            <?php } ?>
            <?php if($oxides_edge_options['menu_item_text_decoration_style'] == 'underline') { ?>
                .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a span.item_inner,
                .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a span.item_inner{
                text-decoration: underline;
                }
            <?php } ?>
            <?php if($oxides_edge_options['menu_item_text_decoration_style'] == 'line-through') { ?>
                .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a span.item_inner,
                .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a span.item_inner{
                text-decoration: line-through;
                }
            <?php } ?>
            <?php if($oxides_edge_options['menu_item_text_decoration_style'] == 'overline') { ?>
                .edgtf-main-menu.edgtf-default-nav > ul > li:hover > a span.item_inner,
                .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item:hover > a span.item_inner{
                text-decoration: overline;
                }
            <?php } ?>


            <?php if($oxides_edge_options['menu_item_active_text_decoration_style'] == 'none') { ?>
                .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a span.item_inner{
                text-decoration: none;
                }
            <?php } ?>
            <?php if($oxides_edge_options['menu_item_active_text_decoration_style'] == 'underline') { ?>
                .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a span.item_inner{
                text-decoration: underline;
                }
            <?php } ?>
            <?php if($oxides_edge_options['menu_item_active_text_decoration_style'] == 'line-through') { ?>
                .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a span.item_inner{
                text-decoration: line-through;
                }
            <?php } ?>
            <?php if($oxides_edge_options['menu_item_active_text_decoration_style'] == 'overline') { ?>
                .edgtf-main-menu.edgtf-default-nav > ul > li.edgtf-active-item > a span.item_inner{
                text-decoration: overline;
                }
            <?php } ?>

        <?php } ?>

        <?php if($oxides_edge_options['disable_dropdown_menu_item_icon'] == 'yes') { ?>
            .edgtf-main-menu > ul > li > a span.item_inner > .edgtf_menu_arrow {
                display: none;
            }
        <?php } ?>

        <?php
        if($oxides_edge_options['dropdown_background_color'] != "" || $oxides_edge_options['dropdown_background_transparency'] != "") {

            //dropdown background and transparency styles
            $dropdown_bg_color_initial        = '#ffffff';
            $dropdown_bg_transparency_initial = 1;

            $dropdown_bg_color        = $oxides_edge_options['dropdown_background_color'] !== "" ? $oxides_edge_options['dropdown_background_color'] : $dropdown_bg_color_initial;
            $dropdown_bg_transparency = $oxides_edge_options['dropdown_background_transparency'] !== "" ? $oxides_edge_options['dropdown_background_transparency'] : $dropdown_bg_transparency_initial;

            $dropdown_bg_color_rgb = oxides_edge_hex2rgb($dropdown_bg_color);
            ?>

            .edgtf-drop-down .second .inner ul,
            .edgtf-drop-down .second .inner ul li ul,
            .shopping_cart_dropdown,
            li.narrow .second .inner ul,
            .edgtf-main-menu.edgtf-default-nav #lang_sel ul ul,
            .edgtf-main-menu.edgtf-default-nav #lang_sel_click  ul ul,
            .header-widget.widget_nav_menu ul ul,
            .edgtf-drop-down .wide.wide_background .second{
                background-color: <?php echo esc_attr($dropdown_bg_color); ?>;
                background-color: rgba(<?php echo esc_attr($dropdown_bg_color_rgb[0]); ?>,<?php echo esc_attr($dropdown_bg_color_rgb[1]); ?>,<?php echo esc_attr($dropdown_bg_color_rgb[2]); ?>,<?php echo esc_attr($dropdown_bg_transparency); ?>);
            }

        <?php } //end dropdown background and transparency styles ?>

        <?php
        if($oxides_edge_options['dropdown_top_padding'] !== '') {

            $menu_inner_ul_top = 6;
            if($oxides_edge_options['dropdown_top_padding'] !== '') {
                ?>
                li.narrow .second .inner ul,
                .edgtf-drop-down .wide .second .inner > ul{
                    padding-top: <?php echo esc_attr($oxides_edge_options['dropdown_top_padding']); ?>px;
                }
                <?php
                $menu_inner_ul_top = $oxides_edge_options['dropdown_top_padding']; //overwrite default value
            } ?>

            .edgtf-drop-down .narrow .second .inner ul li ul,
            body.edgtf-slide-from-bottom .edgtf-drop-down .narrow .second .inner ul li:hover ul,
            body.edgtf-slide-from-top .narrow .second .inner ul li:hover ul{
                top:-<?php echo esc_attr($menu_inner_ul_top); ?>px;
            }

        <?php } ?>

        <?php if($oxides_edge_options['dropdown_bottom_padding'] !== '') { ?>
            li.narrow .second .inner ul,
            .edgtf-drop-down .wide .second .inner > ul{
                padding-bottom: <?php echo esc_attr($oxides_edge_options['dropdown_bottom_padding']); ?>px;
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_separator_color'] != '') { ?>
            .edgtf-drop-down .narrow .second .inner ul li a, 
            .edgtf-drop-down .narrow .second .inner ul li h6 {
                border-bottom: 1px solid <?php echo esc_attr($oxides_edge_options['dropdown_separator_color']); ?>;
            }
        <?php } ?>

        <?php if(!empty($oxides_edge_options['dropdown_vertical_separator_color'])) { ?>
            .edgtf-drop-down .wide .second ul li{
                border-left-color: <?php echo esc_attr($oxides_edge_options['dropdown_vertical_separator_color']); ?>;
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_top_position'] !== '') { ?>
            header .edgtf-drop-down .second {
                top: <?php echo esc_attr($oxides_edge_options['dropdown_top_position']).'%;'; ?>
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_color'] !== '' || $oxides_edge_options['dropdown_fontsize'] !== '' || $oxides_edge_options['dropdown_lineheight'] !== '' || $oxides_edge_options['dropdown_fontstyle'] !== '' || $oxides_edge_options['dropdown_fontweight'] !== '' || $oxides_edge_options['dropdown_google_fonts'] != "-1" || $oxides_edge_options['dropdown_texttransform'] !== '' || $oxides_edge_options['dropdown_letterspacing'] !== '') { ?>
            .edgtf-drop-down .second .inner > ul > li > a,
            .edgtf-drop-down .second .inner > ul > li > h4,
            .edgtf-drop-down .wide .second .inner > ul > li > h4,
            .edgtf-drop-down .wide .second .inner > ul > li > a,
            .edgtf-drop-down .wide .second ul li ul li.menu-item-has-children > a,
            .edgtf-drop-down .wide .second .inner ul li.sub ul li.menu-item-has-children > a,
            .edgtf-drop-down .wide .second .inner > ul li.sub .flexslider ul li  h4 a,
            .edgtf-drop-down .wide .second .inner > ul li .flexslider ul li  h4 a,
            .edgtf-drop-down .wide .second .inner > ul li.sub .flexslider ul li  h4,
            .edgtf-drop-down .wide .second .inner > ul li .flexslider ul li  h4,
            .edgtf-main-menu.edgtf-default-nav #lang_sel ul li li a,
            .edgtf-main-menu.edgtf-default-nav #lang_sel_click ul li ul li a,
            .edgtf-main-menu.edgtf-default-nav #lang_sel ul ul a,
            .edgtf-main-menu.edgtf-default-nav #lang_sel_click ul ul a{
            <?php if(!empty($oxides_edge_options['dropdown_color'])) { ?> color: <?php echo esc_attr($oxides_edge_options['dropdown_color']); ?>; <?php } ?>
            <?php if($oxides_edge_options['dropdown_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $oxides_edge_options['dropdown_google_fonts'])); ?>', sans-serif !important;
            <?php } ?>
            <?php if($oxides_edge_options['dropdown_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($oxides_edge_options['dropdown_fontsize']); ?>px; <?php } ?>
            <?php if($oxides_edge_options['dropdown_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($oxides_edge_options['dropdown_lineheight']); ?>px; <?php } ?>
            <?php if($oxides_edge_options['dropdown_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($oxides_edge_options['dropdown_fontstyle']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($oxides_edge_options['dropdown_fontweight']); ?>; <?php } ?>
            <?php if($oxides_edge_options['dropdown_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($oxides_edge_options['dropdown_texttransform']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($oxides_edge_options['dropdown_letterspacing']); ?>px;  <?php } ?>
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_color'] !== '') { ?>
            .shopping_cart_dropdown ul li
            .item_info_holder .item_left a,
            .shopping_cart_dropdown ul li .item_info_holder .item_right .amount,
            .shopping_cart_dropdown .cart_bottom .subtotal_holder .total,
            .shopping_cart_dropdown .cart_bottom .subtotal_holder .total_amount{
                color: <?php echo esc_attr($oxides_edge_options['dropdown_color']); ?>;
            }
        <?php } ?>

        <?php if(!empty($oxides_edge_options['dropdown_hovercolor'])) { ?>
            .edgtf-drop-down .second .inner > ul > li:hover > a,
            .edgtf-drop-down .wide .second ul li ul li.menu-item-has-children:hover > a,
            .edgtf-drop-down .wide .second .inner ul li.sub ul li.menu-item-has-children:hover > a,
            .edgtf-main-menu.edgtf-default-nav #lang_sel ul li li:hover a,
            .edgtf-main-menu.edgtf-default-nav #lang_sel_click ul li ul li:hover a,
            .edgtf-main-menu.edgtf-default-nav #lang_sel ul li:hover > a,
            .edgtf-main-menu.edgtf-default-nav #lang_sel_click ul li:hover > a{
                color: <?php echo esc_attr($oxides_edge_options['dropdown_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if(!empty($oxides_edge_options['dropdown_background_hovercolor'])) { ?>
            .edgtf-drop-down li:not(.wide) .second .inner > ul > li:hover{
                background-color: <?php echo esc_attr($oxides_edge_options['dropdown_background_hovercolor']); ?>;
            }
        <?php } ?>

        <?php if(!empty($oxides_edge_options['dropdown_padding_top_bottom'])) { ?>
            .edgtf-drop-down .wide .second>.inner>ul>li.sub>ul>li>a,
            .edgtf-drop-down .second .inner ul li a,
            .edgtf-drop-down .wide .second ul li a,
            .edgtf-drop-down .second .inner ul.right li a{
                padding-top: <?php echo esc_attr($oxides_edge_options['dropdown_padding_top_bottom']); ?>px;
                padding-bottom: <?php echo esc_attr($oxides_edge_options['dropdown_padding_top_bottom']); ?>px;
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_wide_color'] !== '' || $oxides_edge_options['dropdown_wide_fontsize'] !== '' || $oxides_edge_options['dropdown_wide_lineheight'] !== '' || $oxides_edge_options['dropdown_wide_fontstyle'] !== '' || $oxides_edge_options['dropdown_wide_fontweight'] !== '' || $oxides_edge_options['dropdown_wide_google_fonts'] !== "-1" || $oxides_edge_options['dropdown_wide_texttransform'] !== '' || $oxides_edge_options['dropdown_wide_letterspacing'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner > ul > li > a{
            <?php if($oxides_edge_options['dropdown_wide_color'] !== '') { ?> color: <?php echo esc_attr($oxides_edge_options['dropdown_wide_color']); ?>; <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $oxides_edge_options['dropdown_wide_google_fonts'])); ?>', sans-serif !important;
            <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($oxides_edge_options['dropdown_wide_fontsize']); ?>px; <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($oxides_edge_options['dropdown_wide_lineheight']); ?>px; <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($oxides_edge_options['dropdown_wide_fontstyle']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($oxides_edge_options['dropdown_wide_fontweight']); ?>; <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($oxides_edge_options['dropdown_wide_texttransform']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($oxides_edge_options['dropdown_wide_letterspacing']); ?>px;  <?php } ?>
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_wide_hovercolor'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner > ul > li:hover > a {
            color: <?php echo esc_attr($oxides_edge_options['dropdown_wide_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if(!empty($oxides_edge_options['dropdown_wide_background_hovercolor'])) { ?>
            .edgtf-drop-down .wide .second .inner > ul > li:hover > a{
                background-color: <?php echo esc_attr($oxides_edge_options['dropdown_wide_background_hovercolor']); ?>
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_wide_padding_top_bottom'] !== '') { ?>
            .edgtf-drop-down .wide .second>.inner > ul > li.sub > ul > li > a,
            .edgtf-drop-down .wide .second .inner ul li a,
            .edgtf-drop-down .wide .second ul li a,
            .edgtf-drop-down .wide .second .inner ul.right li a{
                padding-top: <?php echo esc_attr($oxides_edge_options['dropdown_wide_padding_top_bottom']); ?>px;
                padding-bottom: <?php echo esc_attr($oxides_edge_options['dropdown_wide_padding_top_bottom']); ?>px;
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_color_thirdlvl'] !== '' || $oxides_edge_options['dropdown_fontsize_thirdlvl'] !== '' || $oxides_edge_options['dropdown_lineheight_thirdlvl'] !== '' || $oxides_edge_options['dropdown_fontstyle_thirdlvl'] !== '' || $oxides_edge_options['dropdown_fontweight_thirdlvl'] !== '' || $oxides_edge_options['dropdown_google_fonts_thirdlvl'] != "-1" || $oxides_edge_options['dropdown_texttransform_thirdlvl'] !== '' || $oxides_edge_options['dropdown_letterspacing_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .second .inner ul li.sub ul li a{
            <?php if($oxides_edge_options['dropdown_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($oxides_edge_options['dropdown_color_thirdlvl']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_google_fonts_thirdlvl'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $oxides_edge_options['dropdown_google_fonts_thirdlvl'])); ?>', sans-serif;
            <?php } ?>
            <?php if($oxides_edge_options['dropdown_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($oxides_edge_options['dropdown_fontsize_thirdlvl']); ?>px;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($oxides_edge_options['dropdown_lineheight_thirdlvl']); ?>px;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($oxides_edge_options['dropdown_fontstyle_thirdlvl']); ?>;   <?php } ?>
            <?php if($oxides_edge_options['dropdown_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($oxides_edge_options['dropdown_fontweight_thirdlvl']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($oxides_edge_options['dropdown_texttransform_thirdlvl']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($oxides_edge_options['dropdown_letterspacing_thirdlvl']); ?>px;  <?php } ?>
            }
        <?php } ?>
        <?php if($oxides_edge_options['dropdown_hovercolor_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .second .inner ul li.sub ul li:not(.flex-active-slide):hover > a:not(.flex-prev):not(.flex-next),
            .edgtf-drop-down .second .inner ul li ul li:not(.flex-active-slide):hover > a:not(.flex-prev):not(.flex-next){
                color: <?php echo esc_attr($oxides_edge_options['dropdown_hovercolor_thirdlvl']); ?> !important;
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_background_hovercolor_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .second .inner ul li.sub ul li:hover,
            .edgtf-drop-down .second .inner ul li ul li:hover{
                background-color: <?php echo esc_attr($oxides_edge_options['dropdown_background_hovercolor_thirdlvl']); ?>;
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_wide_color_thirdlvl'] !== '' || $oxides_edge_options['dropdown_wide_fontsize_thirdlvl'] !== '' || $oxides_edge_options['dropdown_wide_lineheight_thirdlvl'] !== '' || $oxides_edge_options['dropdown_wide_fontstyle_thirdlvl'] !== '' || $oxides_edge_options['dropdown_wide_fontweight_thirdlvl'] !== '' || $oxides_edge_options['dropdown_wide_google_fonts_thirdlvl'] != "-1" || $oxides_edge_options['dropdown_wide_texttransform_thirdlvl'] !== '' || $oxides_edge_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner ul li.sub ul li a,
            .edgtf-drop-down .wide .second ul li ul li a{
            <?php if($oxides_edge_options['dropdown_wide_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($oxides_edge_options['dropdown_wide_color_thirdlvl']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_google_fonts_thirdlvl'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $oxides_edge_options['dropdown_wide_google_fonts_thirdlvl'])); ?>', sans-serif;
            <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($oxides_edge_options['dropdown_wide_fontsize_thirdlvl']); ?>px;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($oxides_edge_options['dropdown_wide_lineheight_thirdlvl']); ?>px;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($oxides_edge_options['dropdown_wide_fontstyle_thirdlvl']); ?>;   <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($oxides_edge_options['dropdown_wide_fontweight_thirdlvl']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($oxides_edge_options['dropdown_wide_texttransform_thirdlvl']); ?>;  <?php } ?>
            <?php if($oxides_edge_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($oxides_edge_options['dropdown_wide_letterspacing_thirdlvl']); ?>px;  <?php } ?>
            }
        <?php } ?>
        <?php if($oxides_edge_options['dropdown_wide_hovercolor_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner ul li.sub ul li:not(.flex-active-slide) > a:not(.flex-prev):not(.flex-next):hover,
            .edgtf-drop-down .wide .second .inner ul li ul li:not(.flex-active-slide) > a:not(.flex-prev):not(.flex-next):hover{
                color: <?php echo esc_attr($oxides_edge_options['dropdown_wide_hovercolor_thirdlvl']); ?> !important;
            }
        <?php } ?>

        <?php if($oxides_edge_options['dropdown_wide_background_hovercolor_thirdlvl'] !== '') { ?>
            .edgtf-drop-down .wide .second .inner ul li.sub ul li:hover,
            .edgtf-drop-down .wide .second .inner ul li ul li:hover{
                background-color: <?php echo esc_attr($oxides_edge_options['dropdown_wide_background_hovercolor_thirdlvl']); ?>;
            }
        <?php }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_main_menu_styles');
}

if(!function_exists('oxides_edge_header_logo_styles')) {
    /**
     * Generates styles for header logo
     */
    function oxides_edge_header_logo_styles() {
        global $oxides_edge_options;

        if($oxides_edge_options['logo_image_left_margin'] !== '') { ?>
            .edgtf-vertical-align-containers .edgtf-position-left {
                left: <?php echo esc_attr($oxides_edge_options['logo_image_left_margin']); ?>px;
            }
        <?php }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_header_logo_styles');
}