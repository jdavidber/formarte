<?php
if(!function_exists('oxides_edge_design_styles')) {
    /**
     * Generates general custom styles
     */
    function oxides_edge_design_styles() {

        $preload_background_styles = array();

        if(oxides_edge_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.oxides_edge_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(EDGE_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo oxides_edge_dynamic_css('.edgtf-preload-background', $preload_background_styles);

		if (oxides_edge_options()->getOptionValue('google_fonts')){
			$font_family = oxides_edge_options()->getOptionValue('google_fonts');
			if(oxides_edge_is_font_option_valid($font_family)) {
				echo oxides_edge_dynamic_css('body', array('font-family' => oxides_edge_get_font_option_val($font_family)));
			}
		}

        if(oxides_edge_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                '.edgtf-blog-holder article.sticky .edgtf-post-title a',
                '.edgtf-blog-holder.edgtf-blog-type-standard article .edgtf-post-info a:not(.edgtf-share-link):hover',
                '.edgtf-blog-holder.edgtf-blog-single article .edgtf-post-info a:not(.edgtf-share-link):hover',
                '.edgtf-blog-holder.edgtf-blog-type-standard article .edgtf-post-info a:not(.edgtf-share-link):hover i',
                '.edgtf-blog-holder.edgtf-blog-single article .edgtf-post-info a:not(.edgtf-share-link):hover i',
                '.edgtf-blog-holder.edgtf-blog-type-standard article .edgtf-post-info a:not(.edgtf-share-link):hover.edgtf-post-info-comments:before',
                '.edgtf-blog-holder.edgtf-blog-single article .edgtf-post-info a:not(.edgtf-share-link):hover.edgtf-post-info-comments:before',
                '.edgtf-blog-holder.edgtf-blog-type-standard article .edgtf-post-info .edgtf-post-info-category:hover:before',
                '.edgtf-blog-holder.edgtf-blog-single article .edgtf-post-info .edgtf-post-info-category:hover:before',
                '.edgtf-blog-holder.edgtf-blog-type-checkered article .edgtf-post-info a:hover',
                '.edgtf-blog-holder.edgtf-blog-type-checkered article .edgtf-post-read-more-holder .edgtf-read-more-button:hover',
                '.edgtf-single-tags-holder .edgtf-tags a:hover',
                '.edgtf-blog-single-navigation .edgtf-blog-single-prev a:hover',
                '.edgtf-blog-single-navigation .edgtf-blog-single-next a:hover',
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'a',
                'p a',
                '.edgtf-comment-holder .edgtf-comment-text .edgtf-comment-text-links a:hover',
                '.edgtf-pagination ul li a:hover',
                '.edgtf-pagination ul li.edgtf-pagination-next',
                'aside.edgtf-sidebar .widget.widget_archive ul li',
                'aside.edgtf-sidebar .widget.widget_categories ul li',
                'aside.edgtf-sidebar .widget.widget_archive ul li a',
                'aside.edgtf-sidebar .widget.widget_categories ul li a',
                '.edgtf-main-menu ul li:hover a', 
                '.edgtf-main-menu ul li.edgtf-active-item a',
                'body:not(.edgtf-menu-item-first-level-bg-color) .edgtf-main-menu > ul > li:hover > a',
                '.edgtf-main-menu > ul > li.edgtf-active-item > a',
                '.edgtf-mobile-header .edgtf-mobile-nav a:hover', 
                '.edgtf-mobile-header .edgtf-mobile-nav h6:hover',
                '.edgtf-mobile-header .edgtf-mobile-menu-opener a:hover',
                'footer a:hover',
                'footer .widget.widget_rss a:hover',
                'footer .widget.widget_recent_entries a:hover',
                '.edgtf-side-menu .widget a:hover',
                'nav.edgtf-fullscreen-menu ul li a:hover',
                '.edgtf-search-opener:hover',
                '.edgtf-search-slide-header-bottom .edgtf-search-submit:hover',
                '.edgtf-search-cover .edgtf-search-close a:hover',
                '.edgtf-fullscreen-search-holder .edgtf-search-submit:hover',
                '.edgtf-portfolio-single-holder .edgtf-portfolio-info-item > .edgtf-portfolio-info-item-info-subtitle',
                '.edgtf-team .edgtf-team-social .edgtf-icon-shortcode.normal .edgtf-icon-element:hover',
                '.edgtf-unordered-list ul > li:hover',
                '.edgtf-pie-chart-holder .edgtf-to-counter',
                '.edgtf-accordion-holder .edgtf-title-holder.ui-state-active',
                '.edgtf-accordion-holder .edgtf-title-holder.ui-state-hover',
                '.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-hover',
                '.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-hover .edgtf-accordion-mark',
                '.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-active.ui-state-hover',
                '.edgtf-accordion-holder.edgtf-simple-style .edgtf-title-holder.ui-state-active.ui-state-hover .edgtf-accordion-mark',
                '.edgtf-blog-list-holder .edgtf-read-more-holder .edgtf-read-more-button:hover',
                '.edgtf-blog-list-holder .edgtf-item-info-section a:hover',
                '.edgtf-dropcaps',
                '.edgtf-portfolio-list-holder article .edgtf-item-icons-holder a:hover',
                '.edgtf-portfolio-list-holder-outer.edgtf-ptf-gallery article .edgtf-item-title > a:hover',
                '.edgtf-portfolio-list-holder-outer.edgtf-ptf-pinterest article .edgtf-item-title > a:hover',
                '.edgtf-portfolio-list-holder-outer.edgtf-ptf-masonry article .edgtf-item-title > a:hover',
                '.edgtf-social-share-holder ul li a:hover',
                '.edgtf-social-share-holder.edgtf-dropdown:hover i.social_share',
                '.edgtf-social-share-holder.edgtf-dropdown:hover .edgtf-social-share-title',
                '.edgtf-carousel-with-image-and-text .edgtf-cwiat-content-holder .edgtf-cwiat-link:hover',
                '.edgtf-ptf-filter-skin-first-color .edgtf-portfolio-filter-holder .edgtf-portfolio-filter-holder-inner ul li:hover span',
                '.edgtf-ptf-filter-skin-first-color .edgtf-portfolio-filter-holder .edgtf-portfolio-filter-holder-inner ul li.active span'
            );

            $woo_color_selector = array();
            if(oxides_edge_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.edgtf-woocommerce-page .edgtf-content .edgtf-quantity-buttons .edgtf-quantity-minus:hover',
                    '.edgtf-woocommerce-page .edgtf-content .edgtf-quantity-buttons .edgtf-quantity-plus:hover',
                    '.edgtf-woocommerce-page table.cart tr.cart_item td.product-name a:hover',
                    '.edgtf-shopping-cart-outer .edgtf-shopping-cart-header .edgtf-header-cart:hover',
                    '.edgtf-shopping-cart-dropdown ul li a:hover',
                    '.edgtf-shopping-cart-dropdown ul .edgtf-item-info-holder .edgtf-item-left a:hover',
                    '.edgtf-shopping-cart-dropdown ul .edgtf-item-info-holder .edgtf-item-right .remove:hover',
                    '.woocommerce-page .widget.widget_product_categories a + .count',
                    '.woocommerce-page .widget.widget_products ul li a:hover span',
                    '.woocommerce-page .widget.widget_recent_reviews ul li a:hover span', 
                    '.woocommerce-page .widget.widget_top_rated_products ul li a:hover span'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector); 

            $color_important_selector = array(
                '.edgtf-unordered-list ul > li:hover span',
                '.edgtf-icon-list-item:hover .edgtf-icon-list-element',
                '.edgtf-icon-list-item:hover .edgtf-icon-list-text'
            );

            $background_color_selector = array(
                '.edgtf-blog-holder.edgtf-blog-type-standard article .edgtf-blog-audio-holder .mejs-container .mejs-controls > a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.edgtf-blog-holder.edgtf-blog-single article .edgtf-blog-audio-holder .mejs-container .mejs-controls > a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.edgtf-blog-holder.edgtf-blog-type-standard article:hover .edgtf-post-mark',
                '.edgtf-blog-holder.edgtf-blog-single article:hover .edgtf-post-mark',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '#edgtf-back-to-top:hover > span',
                'aside.edgtf-sidebar .widget.widget_search input[type="submit"]',
                'aside.edgtf-sidebar .widget.widget_tag_cloud a:hover',
                'footer .widget.widget_search input[type="submit"]:hover',
                'footer .widget.widget_tag_cloud a:hover',
                '.edgtf-side-menu-button-opener:hover',
                '.edgtf-side-menu .widget.widget_search input[type="submit"]:hover',
                '.edgtf-side-menu .widget.widget_tag_cloud a:hover',
                '.edgtf-fullscreen-menu-opener:hover',
                '.edgtf-fullscreen-menu-opener.opened',
                '.edgtf-icon-shortcode.circle',
                '.edgtf-icon-shortcode.square',
                '.edgtf-message',
                '.edgtf-unordered-list.edgtf-ok-square ul > li:hover:before',
                '.edgtf-progress-bar .edgtf-progress-number-wrapper.edgtf-floating .edgtf-progress-number',
                '.edgtf-progress-bar .edgtf-progress-content-outer .edgtf-progress-content',
                '.edgtf-price-table:hover .edgtf-price-table-inner ul li.edgtf-table-title',
                '.edgtf-price-table:hover .edgtf-price-table-inner ul li.edgtf-table-prices',
                '.edgtf-price-table.edgtf-active .edgtf-price-table-inner ul li.edgtf-table-title',
                '.edgtf-price-table.edgtf-active .edgtf-price-table-inner ul li.edgtf-table-prices',
                '.edgtf-btn.edgtf-btn-solid',
                '.edgtf-accordion-holder .edgtf-title-holder.ui-state-active .edgtf-accordion-mark',
                '.edgtf-accordion-holder .edgtf-title-holder.ui-state-hover .edgtf-accordion-mark',
                '.edgtf-btn.edgtf-btn-solid',
                '.edgtf-video-button-play .edgtf-video-button-wrapper:hover',
                '.edgtf-dropcaps.edgtf-square', 
                '.edgtf-dropcaps.edgtf-circle',
                '.edgtf-single-product .edgtf-onsale',
                '.edgtf-single-product .edgtf-sp-button-holder a.button:hover',
                '.edgtf-single-product .edgtf-sp-button-holder .added_to_cart:hover',
                '.edgtf-er-holder .edgtf-er-button:hover',
                '.edgtf-ptf-filter-skin-first-color .edgtf-portfolio-filter-holder .edgtf-portfolio-filter-holder-inner'
            );

            $woo_background_color_selector = array();
            if(oxides_edge_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce .edgtf-product-featured-image-holder a.button:hover',
                    '.woocommerce .edgtf-product-featured-image-holder a.added_to_cart:hover',
                    '.woocommerce .edgtf-onsale',
                    '.woocommerce-pagination .page-numbers li span.current',
                    '.woocommerce-pagination .page-numbers li a:hover',
                    '.woocommerce-pagination .page-numbers li span:hover',
                    '.woocommerce-pagination .page-numbers li span.current:hover',
                    '.edgtf-woocommerce-page .edgtf-content input[type="submit"]:hover',
                    '.edgtf-woocommerce-page .edgtf-content button[type="submit"]:hover',
                    '.edgtf-woocommerce-page .edgtf-content a.button:hover',
                    '.edgtf-woocommerce-page .edgtf-content a.added_to_cart:hover',
                    '.edgtf-woocommerce-page .edgtf-content a.add_to_cart_button:hover',
                    '.edgtf-woocommerce-page table.cart tr.cart_item td.product-remove a:hover',
                    '.edgtf-shopping-cart-dropdown ul .edgtf-cart-bottom .view-cart:hover',
                    '.edgtf-shopping-cart-dropdown ul .edgtf-cart-bottom .checkout',
                    '.edgtf-woocommerce-page .select2-results .select2-highlighted'
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector); 

            $background_color_important_selector = array(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-hover-bg):hover',
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-hover-bg):hover',
                '.edgtf-portfolio-list-holder-outer .edgtf-ptf-list-paging .edgtf-btn:hover'
            );

            $border_color_selector = array(
                '.wpcf7-form-control.wpcf7-text:focus',
                '.wpcf7-form-control.wpcf7-number:focus',
                '.wpcf7-form-control.wpcf7-date:focus',
                '.wpcf7-form-control.wpcf7-textarea:focus',
                '.wpcf7-form-control.wpcf7-select:focus',
                '.wpcf7-form-control.wpcf7-quiz:focus', 
                '#respond textarea:focus',
                '#respond input[type="text"]:focus',
                '.post-password-form input[type="password"]:focus',
                'aside.edgtf-sidebar .widget.widget_search input:not([type="submit"]):focus',
                'footer .widget.widget_search input:not([type="submit"]):focus',
                '.edgtf-side-menu .widget.widget_search input:not([type="submit"]):focus',
                '.edgtf-message',
                '.edgtf-progress-bar .edgtf-progress-number-wrapper.edgtf-floating .edgtf-down-arrow',
                '.edgtf-btn.edgtf-btn-solid',
                '.edgtf-accordion-holder .edgtf-title-holder.ui-state-active .edgtf-accordion-mark',
                '.edgtf-accordion-holder .edgtf-title-holder.ui-state-hover .edgtf-accordion-mark',
                '.edgtf-btn.edgtf-btn-solid',
                'blockquote.with-border',
                '.edgtf-ptf-filter-skin-first-color .edgtf-portfolio-filter-holder .edgtf-portfolio-filter-holder-inner ul li:hover .edgtf-portfolio-filter-name',
                '.edgtf-ptf-filter-skin-first-color .edgtf-portfolio-filter-holder .edgtf-portfolio-filter-holder-inner ul li.active .edgtf-portfolio-filter-name'
            );

            $woo_border_color_selector = array();
            if(oxides_edge_is_woocommerce_installed()) {
                $woo_border_color_selector = array(
                    '.edgtf-woocommerce-page .edgtf-content input[type="text"]:focus',
                    '.edgtf-woocommerce-page .edgtf-content input[type="email"]:focus',
                    '.edgtf-woocommerce-page .edgtf-content input[type="tel"]:focus',
                    '.edgtf-woocommerce-page .edgtf-content input[type="password"]:focus',
                    '.edgtf-woocommerce-page .edgtf-content textarea:focus' 
                );
            }

            $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector); 

            $border_color_important_selector = array(
                '.edgtf-icon-list-item:hover .edgtf-icon-list-element',
                '.edgtf-icon-list-item:hover .edgtf-icon-list-text',
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-border-hover):hover',
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-border-hover):hover',
                '.edgtf-portfolio-list-holder-outer .edgtf-ptf-list-paging .edgtf-btn:hover',
            );

            echo oxides_edge_dynamic_css($color_selector, array('color' => oxides_edge_options()->getOptionValue('first_color')));
            echo oxides_edge_dynamic_css($color_important_selector, array('color' => oxides_edge_options()->getOptionValue('first_color').'!important'));
            echo oxides_edge_dynamic_css('::selection', array('background' => oxides_edge_options()->getOptionValue('first_color')));
            echo oxides_edge_dynamic_css('::-moz-selection', array('background' => oxides_edge_options()->getOptionValue('first_color')));
            echo oxides_edge_dynamic_css($background_color_selector, array('background-color' => oxides_edge_options()->getOptionValue('first_color')));
            echo oxides_edge_dynamic_css($background_color_important_selector, array('background-color' => oxides_edge_options()->getOptionValue('first_color').'!important'));
            echo oxides_edge_dynamic_css($border_color_selector, array('border-color' => oxides_edge_options()->getOptionValue('first_color')));
            echo oxides_edge_dynamic_css($border_color_important_selector, array('border-color' => oxides_edge_options()->getOptionValue('first_color').'!important'));
        }

		if (oxides_edge_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.edgtf-wrapper-inner',
				'.edgtf-content'
			);
			echo oxides_edge_dynamic_css($background_color_selector, array('background-color' => oxides_edge_options()->getOptionValue('page_background_color')));
		}

		if (oxides_edge_options()->getOptionValue('selection_color')) {
			echo oxides_edge_dynamic_css('::selection', array('background' => oxides_edge_options()->getOptionValue('selection_color')));
			echo oxides_edge_dynamic_css('::-moz-selection', array('background' => oxides_edge_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (oxides_edge_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = oxides_edge_options()->getOptionValue('page_background_color_in_box');
		}

		if (oxides_edge_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(oxides_edge_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (oxides_edge_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(oxides_edge_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (oxides_edge_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (oxides_edge_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo oxides_edge_dynamic_css('.edgtf-boxed .edgtf-wrapper', $boxed_background_style);
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_design_styles');
}

if(!function_exists('oxides_edge_content_styles')) {
    /**
     * Generates content custom styles
     */
    function oxides_edge_content_styles() {

        $content_style = array();
        if (oxides_edge_options()->getOptionValue('content_top_padding') !== '') {
            $padding_top = (oxides_edge_options()->getOptionValue('content_top_padding'));
            $content_style['padding-top'] = oxides_edge_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.edgtf-content .edgtf-content-inner > .edgtf-full-width > .edgtf-full-width-inner',
        );

        echo oxides_edge_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
        if (oxides_edge_options()->getOptionValue('content_top_padding_in_grid') !== '') {
            $padding_top_in_grid = (oxides_edge_options()->getOptionValue('content_top_padding_in_grid'));
            $content_style_in_grid['padding-top'] = oxides_edge_filter_px($padding_top_in_grid).'px';

        }

        $content_selector_in_grid = array(
            '.edgtf-content .edgtf-content-inner > .edgtf-container > .edgtf-container-inner',
        );

        echo oxides_edge_dynamic_css($content_selector_in_grid, $content_style_in_grid);

    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_content_styles');
}

if(!function_exists('oxides_edge_not_found_page_styles')) {
    /**
     * Generates 404 page custom styles
     */
    function oxides_edge_not_found_page_styles() {

        $not_found_style = array();
        if (oxides_edge_options()->getOptionValue('404_background_image')) {
            $not_found_style['background-image'] = 'url('.esc_url(oxides_edge_options()->getOptionValue('404_background_image')).')';
            $not_found_style['background-position'] = 'center 0px';
            $not_found_style['background-repeat'] = 'no-repeat';
            $not_found_style['background-size'] = 'cover';

        }

        $not_found_selector = array(
            '.error404 .edgtf-wrapper'
        );

        echo oxides_edge_dynamic_css($not_found_selector, $not_found_style);

    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_not_found_page_styles');

}

if (!function_exists('oxides_edge_h1_styles')) {

    function oxides_edge_h1_styles() {

        $h1_styles = array();

        if(oxides_edge_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = oxides_edge_options()->getOptionValue('h1_color');
        }
        if(oxides_edge_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('h1_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = oxides_edge_options()->getOptionValue('h1_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = oxides_edge_options()->getOptionValue('h1_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = oxides_edge_options()->getOptionValue('h1_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo oxides_edge_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_h1_styles');
}

if (!function_exists('oxides_edge_h2_styles')) {

    function oxides_edge_h2_styles() {

        $h2_styles = array();

        if(oxides_edge_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = oxides_edge_options()->getOptionValue('h2_color');
        }
        if(oxides_edge_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('h2_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = oxides_edge_options()->getOptionValue('h2_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = oxides_edge_options()->getOptionValue('h2_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = oxides_edge_options()->getOptionValue('h2_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo oxides_edge_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_h2_styles');
}

if (!function_exists('oxides_edge_h3_styles')) {

    function oxides_edge_h3_styles() {

        $h3_styles = array();

        if(oxides_edge_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = oxides_edge_options()->getOptionValue('h3_color');
        }
        if(oxides_edge_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('h3_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = oxides_edge_options()->getOptionValue('h3_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = oxides_edge_options()->getOptionValue('h3_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = oxides_edge_options()->getOptionValue('h3_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo oxides_edge_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_h3_styles');
}

if (!function_exists('oxides_edge_h4_styles')) {

    function oxides_edge_h4_styles() {

        $h4_styles = array();

        if(oxides_edge_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = oxides_edge_options()->getOptionValue('h4_color');
        }
        if(oxides_edge_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('h4_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = oxides_edge_options()->getOptionValue('h4_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = oxides_edge_options()->getOptionValue('h4_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = oxides_edge_options()->getOptionValue('h4_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo oxides_edge_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_h4_styles');
}

if (!function_exists('oxides_edge_h5_styles')) {

    function oxides_edge_h5_styles() {

        $h5_styles = array();

        if(oxides_edge_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = oxides_edge_options()->getOptionValue('h5_color');
        }
        if(oxides_edge_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('h5_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = oxides_edge_options()->getOptionValue('h5_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = oxides_edge_options()->getOptionValue('h5_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = oxides_edge_options()->getOptionValue('h5_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo oxides_edge_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_h5_styles');
}

if (!function_exists('oxides_edge_h6_styles')) {

    function oxides_edge_h6_styles() {

        $h6_styles = array();

        if(oxides_edge_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = oxides_edge_options()->getOptionValue('h6_color');
        }
        if(oxides_edge_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('h6_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = oxides_edge_options()->getOptionValue('h6_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = oxides_edge_options()->getOptionValue('h6_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = oxides_edge_options()->getOptionValue('h6_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo oxides_edge_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_h6_styles');
}

if (!function_exists('oxides_edge_text_styles')) {

    function oxides_edge_text_styles() {

        $text_styles = array();

        if(oxides_edge_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = oxides_edge_options()->getOptionValue('text_color');
        }
        if(oxides_edge_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = oxides_edge_get_formatted_font_family(oxides_edge_options()->getOptionValue('text_google_fonts'));
        }
        if(oxides_edge_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('text_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('text_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = oxides_edge_options()->getOptionValue('text_texttransform');
        }
        if(oxides_edge_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = oxides_edge_options()->getOptionValue('text_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = oxides_edge_options()->getOptionValue('text_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo oxides_edge_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_text_styles');
}

if (!function_exists('oxides_edge_boxy_text_styles')) {

    function oxides_edge_boxy_text_styles() {

        $text_styles = array();

        if(oxides_edge_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = oxides_edge_options()->getOptionValue('text_color');
        }
        if(oxides_edge_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('text_fontsize')).'px';
        }
        if(oxides_edge_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = oxides_edge_filter_px(oxides_edge_options()->getOptionValue('text_lineheight')).'px';
        }
        if(oxides_edge_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = oxides_edge_options()->getOptionValue('text_fontweight');
        }

        $text_selector = array(
            'body'
        );

        if (!empty($text_styles)) {
            echo oxides_edge_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_boxy_text_styles');
}

if (!function_exists('oxides_edge_elements_text_styles')) {

    function oxides_edge_elements_text_styles() {

        $text_styles = array();

        if(oxides_edge_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = oxides_edge_options()->getOptionValue('text_color');
        }

        $text_selector = array(
            '.edgtf-comment-holder .edgtf-comment-text .edgtf-comment-date',
            '.edgtf-comment-holder .edgtf-comment-text .edgtf-comment-text-links a',
            '.edgtf-testimonials .edgtf-testimonial-text',
            '.edgtf-blog-list-holder .edgtf-item-info-section',
            '.edgtf-single-product .edgtf-sp-info-holder .star-rating',
            '.edgtf-single-product .edgtf-sp-info-holder .star-rating span',
            '.edgtf-blog-holder.edgtf-blog-type-standard article .edgtf-post-info > div.edgtf-blog-share .edgtf-blog-share-text',
            '.edgtf-blog-holder.edgtf-blog-single article .edgtf-post-info > div.edgtf-blog-share .edgtf-blog-share-text',
            '.edgtf-blog-holder.edgtf-blog-type-standard article .edgtf-post-info > div a:not(.edgtf-share-link)',
            '.edgtf-blog-holder.edgtf-blog-type-standard article .edgtf-post-info > div.edgtf-post-info-date',
            '.edgtf-blog-holder.edgtf-blog-single article .edgtf-post-info > div a:not(.edgtf-share-link)',
            '.edgtf-blog-holder.edgtf-blog-single article .edgtf-post-info > div.edgtf-post-info-date',
            '.edgtf-blog-holder.edgtf-blog-type-checkered article .edgtf-post-info',
            '.edgtf-single-tags-holder .edgtf-tags a'
        );

        if (!empty($text_styles)) {
            echo oxides_edge_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_elements_text_styles');
}

if (!function_exists('oxides_edge_link_styles')) {

    function oxides_edge_link_styles() {

        $link_styles = array();

        if(oxides_edge_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = oxides_edge_options()->getOptionValue('link_color');
        }
        if(oxides_edge_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = oxides_edge_options()->getOptionValue('link_fontstyle');
        }
        if(oxides_edge_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = oxides_edge_options()->getOptionValue('link_fontweight');
        }
        if(oxides_edge_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = oxides_edge_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo oxides_edge_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_link_styles');
}

if (!function_exists('oxides_edge_link_hover_styles')) {

    function oxides_edge_link_hover_styles() {

        $link_hover_styles = array();

        if(oxides_edge_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = oxides_edge_options()->getOptionValue('link_hovercolor');
        }
        if(oxides_edge_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = oxides_edge_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo oxides_edge_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(oxides_edge_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = oxides_edge_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo oxides_edge_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('oxides_edge_style_dynamic', 'oxides_edge_link_hover_styles');
}