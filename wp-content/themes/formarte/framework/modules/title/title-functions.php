<?php

if(!function_exists('oxides_edge_get_title')) {
    /**
     * Loads title area HTML
     */
    function oxides_edge_get_title() {
        $id = oxides_edge_get_page_id();

        extract(oxides_edge_title_area_height());
        extract(oxides_edge_title_area_background());
        extract(oxides_edge_title_area_border());

        //check if title area is visible on page first, then in the options
        if(get_post_meta($id, "edgtf_show_title_area_meta", true) !== ""){
            $show_title_area = get_post_meta($id, "edgtf_show_title_area_meta", true) == 'yes' ? true : false;
        }else {
            $show_title_area = oxides_edge_options()->getOptionValue('show_title_area') == 'yes' ? true : false;
        }

        //check if title text is hidden
        $title_hidden = false;
        if(get_post_meta($id, "edgtf_title_text_hide", true) !== "") {
            $title_hidden = get_post_meta($id, "edgtf_title_text_hide", true) == 'yes' ? true : false;
        }

        //check if title color is set on page
        $title_color = '';
        if(get_post_meta($id, "edgtf_title_text_color_meta", true) !== ""){
            $title_color = 'color:'.get_post_meta($id, "edgtf_title_text_color_meta", true).';';
        }

        //check if subtitle color is set on page
        $subtitle_color = '';
        if(get_post_meta($id, "edgtf_subtitle_color_meta", true) !== ""){
            $subtitle_color = 'color:'.get_post_meta($id, "edgtf_subtitle_color_meta", true).';';
        }

        $parameters = array(
            'show_title_area' => $show_title_area,
            'title_height' => $title_height,
            'title_holder_height' => $title_holder_height,
            'title_subtitle_holder_padding' => $title_subtitle_holder_padding,
            'title_background_color' => $title_background_color,
            'title_background_image' => $title_background_image,
            'title_background_image_width' => $title_background_image_width,
            'title_background_image_src' => $title_background_image_src,
            'title_border_bottom_color' => $title_border_bottom_color,
            'title_border_bottom_width' => $title_border_bottom_width,
            'has_subtitle' => get_post_meta($id, "edgtf_title_area_subtitle_meta", true) != "" ? true : false,
            'title_color' => $title_color,
            'title_hidden' => $title_hidden,
            'subtitle_color' => $subtitle_color
        );

        $parameters = apply_filters('oxides_edge_title_area_height_params', $parameters);

        oxides_edge_get_module_template_part('templates/title', 'title', '', $parameters);
    }
}

if(!function_exists('oxides_edge_get_title_text')) {
    /**
     * Function that returns current page title text. Defines oxides_edge_title_text filter
     * @return string current page title text
     *
     * @see is_tag()
     * @see is_date()
     * @see is_author()
     * @see is_category()
     * @see is_home()
     * @see is_search()
     * @see is_404()
     * @see get_queried_object_id()
     * @see oxides_edge_is_woocommerce_installed()
     */
    function oxides_edge_get_title_text() {


        $id 	= get_queried_object_id();
        $title 	= '';

        //is current page tag archive?
        if (is_tag()) {
            //get title of current tag
            $title = single_term_title("", false)." ".esc_html__('Tag', 'oxides');
        }

        //is current page date archive?
        elseif (is_date()) {
            //get current date archive format
            $title = get_the_time('F Y');
        }

        //is current page author archive?
        elseif (is_author()) {
            //get current author name
            $title = esc_html__('Author:', 'oxides') . " " . get_the_author();
        }

        //us current page category archive
        elseif (is_category()) {
            //get current page category title
            $title = single_cat_title('', false);
        }

        //is current page blog post page and front page? Latest posts option is set in Settings -> Reading
        elseif (is_home() && is_front_page()) {
            //get site name from options
            $title = get_option('blogname');
        }

        //is current page search page?
        elseif (is_search()) {
            //get title for search page
            $title = esc_html__('Search Results for', 'oxides').': '.get_search_query();
        }

        //is current page 404?
        elseif (is_404()) {
            //is 404 title text set in theme options?
            if(oxides_edge_options()->getOptionValue('404_title') != "") {
                //get it from options
                $title = oxides_edge_options()->getOptionValue('404_title');
            } else {
                //get default 404 page title
                $title = esc_html__('Oops, This Page Could Not Be Found!', 'oxides');
            }
        }

        //is WooCommerce installed and is shop or single product page?
        elseif(oxides_edge_is_woocommerce_installed() && (is_shop() || is_singular('product'))) {
            //get shop page id from options table
            $shop_id = get_option('woocommerce_shop_page_id');

            //get shop page and get it's title if set
            $shop = get_post($shop_id);
            if(isset($shop->post_title) && $shop->post_title !== '') {
                $title = $shop->post_title;
            }

        }

        //is WooCommerce installed and is current page product archive page?
        elseif(oxides_edge_is_woocommerce_installed() && (is_product_category() || is_product_tag())) {
            global $wp_query;

            //get current taxonomy and it's name and assign to title
            $tax 			= $wp_query->get_queried_object();
            $category_title = $tax->name;
            $title 			= $category_title;
        }

        //is current page some archive page?
        elseif (is_archive()) {
            $title = esc_html__('Archive','oxides');
        }

        //current page is regular page
        else {
            $title = get_the_title($id);
        }

        $title = apply_filters('oxides_edge_title_text', $title);

        return $title;
    }
}

if(!function_exists('oxides_edge_title_text')) {
    /**
     * Function that echoes title text.
     *
     * @see oxides_edge_get_title_text()
     */
    function oxides_edge_title_text() {
        echo oxides_edge_get_title_text();
    }
}

if(!function_exists('oxides_edge_subtitle_text')) {
    /**
     * Function that echoes subtitle text.
     *
     */
    function oxides_edge_subtitle_text() {
        $id 	= oxides_edge_get_page_id();
        $subtitle 	= '';

        if(get_post_meta($id, "edgtf_title_area_subtitle_meta", true) != ""){
            $subtitle = wp_kses_post(get_post_meta($id, "edgtf_title_area_subtitle_meta", true));
        }

        print $subtitle;
    }
}

if(!function_exists('oxides_edge_get_title_area_height')) {

    /**
     * Function that returns title height
     **/
    function oxides_edge_get_title_area_height() {

        $id = oxides_edge_get_page_id();

        $title_height = 192; // default title height without header height

        if(get_post_meta($id, "edgtf_title_area_height_meta", true) != '') {
            $title_height = get_post_meta($id, 'edgtf_title_area_height_meta', true);
        } elseif(get_post_meta($id, "edgtf_title_predefined_size", true) !== ""){
            if(get_post_meta($id, "edgtf_title_predefined_size", true) == "small"){
                $title_height = 192;
            }
            elseif(get_post_meta($id, "edgtf_title_predefined_size", true) == "large"){
                $title_height = 336;
            }
        } elseif(oxides_edge_options()->getOptionValue('title_area_height') !== '') {
            $title_height = oxides_edge_options()->getOptionValue('title_area_height');
        } elseif(oxides_edge_options()->getOptionValue('title_predefined_size') !== ""){
            if(oxides_edge_options()->getOptionValue('title_predefined_size') == "small"){
                $title_height = 192;
            }
            elseif(oxides_edge_options()->getOptionValue('title_predefined_size') == "large"){
                $title_height = 336;
            }
        }

        return apply_filters('oxides_edge_title_area_height', $title_height);
    }
}

if(!function_exists('oxides_edge_get_title_content_padding')) {
    /**
     * Function that returns title content pading
     **/

    function oxides_edge_get_title_content_padding() {
        return apply_filters('oxides_edge_title_content_padding', 0);
    }
}


if(!function_exists('oxides_edge_title_area_height')) {
    /**
     * Function that returns title height and padding to be applied in template
     **/

    function oxides_edge_title_area_height() {
        $id = oxides_edge_get_page_id();
        $title_height_and_padding = array();
        $title_height          = oxides_edge_get_title_area_height();
        $header_height_padding = oxides_edge_get_title_content_padding();
        $title_vertical_alignment = 'header_bottom';
        $title_holder_height = '';
        $title_subtitle_holder_padding = '';

        //is responsive image is set for current page?
        if(get_post_meta($id, "edgtf_title_area_background_image_responsive_meta", true) != "") {
            $is_img_responsive = get_post_meta($id, "edgtf_title_area_background_image_responsive_meta", true);
        } else {
            //take value from theme options
            $is_img_responsive = oxides_edge_options()->getOptionValue('title_area_background_image_responsive');
        }

        if(get_post_meta($id, "edgtf_title_area_vertial_alignment_meta", true) !== '') {
            $title_vertical_alignment = get_post_meta($id, "edgtf_title_area_vertial_alignment_meta", true);
        }else{
            $title_vertical_alignment = oxides_edge_options()->getOptionValue('title_area_vertial_alignment');;
        }

        //we need to define title height only when aligning text bellog header and when image isn't responsive
        if($is_img_responsive !== 'yes' && $title_vertical_alignment == 'header_bottom') {
            $title_holder_height = 'height:'.$title_height.'px;';
        }
        //we need to add padding-top property only if we are aligning title text from bellow header
        if($title_vertical_alignment == 'header_bottom' && !empty($header_height_padding)) {
            if($is_img_responsive == 'yes') {
                $title_subtitle_holder_padding = 'padding-top: '.$header_height_padding.'px;';
            } else {
                $title_holder_height .= 'padding-top: '.$header_height_padding.'px;';
            }
        }

        //increase title height for the height of header transparent parts
        $title_height_and_padding['title_height'] = 'height:'.($title_height + $header_height_padding).'px;';
        $title_height_and_padding['title_holder_height'] = $title_holder_height;
        $title_height_and_padding['title_subtitle_holder_padding'] = $title_subtitle_holder_padding;


        return $title_height_and_padding;
    }
}

if(!function_exists('oxides_edge_title_area_background')) {
    /**
     * Function that returns title background style be applied in template
     **/

    function oxides_edge_title_area_background() {
        $id = oxides_edge_get_page_id();
        $show_title_img = true;
        $title_area_background = array();
        $title_background_color = '';
        $title_background_image = '';
        $title_background_image_width = '';
        $title_background_image_src = '';
        $is_img_responsive = '';

        //is title image hidden for current page?
        if(get_post_meta($id, "edgtf_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }

        //is responsive image is set for current page?
        if(get_post_meta($id, "edgtf_title_area_background_image_responsive_meta", true) != "") {
            $is_img_responsive = get_post_meta($id, "edgtf_title_area_background_image_responsive_meta", true);
        } else {
            //take value from theme options
            $is_img_responsive = oxides_edge_options()->getOptionValue('title_area_background_image_responsive');
        }

        //check if background color is set on page or in options
        if(get_post_meta($id, "edgtf_title_area_background_color_meta", true) != ""){
            $background_color = get_post_meta($id, "edgtf_title_area_background_color_meta", true);
        }else{
            $background_color = oxides_edge_options()->getOptionValue('title_area_background_color');
        }

        //check if background image is set on page or in options
        if(get_post_meta($id, "edgtf_title_area_background_image_meta", true) != ""){
            $background_image = get_post_meta($id, "edgtf_title_area_background_image_meta", true);
        }else{
            $background_image = oxides_edge_options()->getOptionValue('title_area_background_image');
        }

        //check for background image width
        $background_image_width = "";
        if($background_image !== ''){
            $background_image_width_dimensions_array = oxides_edge_get_image_dimensions($background_image);
            if (count($background_image_width_dimensions_array)) {
                $background_image_width = $background_image_width_dimensions_array["width"];
            }
        }

        //generate styles
        if(!empty($background_color)){$title_background_color = 'background-color:'.$background_color.';';}
        if($is_img_responsive == 'no' && $show_title_img){ //no need for those styles if image is set to be responsive
            if(!empty($background_image)){$title_background_image = 'background-image:url('.$background_image.');';}
            if(!empty($background_image_width)){$title_background_image_width = 'data-background-width="'.$background_image_width.'"';}

        }
        if($show_title_img) {
            if(!empty($background_image)) { $title_background_image_src = $background_image; }
        }

        $title_area_background['title_background_color'] = $title_background_color;
        $title_area_background['title_background_image'] = $title_background_image;
        $title_area_background['title_background_image_width'] = $title_background_image_width;
        $title_area_background['title_background_image_src'] = $title_background_image_src;


        return $title_area_background;
    }
}

if(!function_exists('oxides_edge_title_area_border')) {
    /**
     * Function that returns title border style be applied in template
     **/

    function oxides_edge_title_area_border() {
        $id = oxides_edge_get_page_id();
        $show_title_border_bottom = true;
        $title_border_bottom_color = '';
        $title_border_bottom_width = '';
        $border_bottom_color = '';
        $border_bottom_width = '';

        //is title border hidden for current page?
        if(get_post_meta($id, "oxides_edge_title_area_border", true) == "no") {
            $show_title_border_bottom = false;
        }
        elseif(oxides_edge_options()->getOptionValue('title_area_border') == "no"){
            $show_title_border_bottom = false;
        }

        if($show_title_border_bottom){
            //is title border color set on page or in options?
            if(get_post_meta($id, "edgtf_title_area_border_color", true) != "") {
                $border_bottom_color = get_post_meta($id, "edgtf_title_area_border_color", true);
            } else {
                $border_bottom_color = oxides_edge_options()->getOptionValue('title_area_border_color');
            }

            //is title border width set on page or in options?
            if(get_post_meta($id, "edgtf_title_area_border_width", true) != ""){
                $border_bottom_width = get_post_meta($id, "edgtf_title_area_border_width", true);
            }else{
                $border_bottom_width = oxides_edge_options()->getOptionValue('title_area_border_width');
            }

            if(!empty($border_bottom_color)) { $title_border_bottom_color = 'border-bottom-color:'.$border_bottom_color.';'; }
            if(!empty($border_bottom_width)) { $title_border_bottom_width = 'border-bottom-width:'.$border_bottom_width.'px;'; }

        }
        else{
            $title_border_bottom_color = 'border-bottom-width:0px;';
        }

        $title_area_border['title_border_bottom_color'] = $title_border_bottom_color;
        $title_area_border['title_border_bottom_width'] = $title_border_bottom_width;


        return $title_area_border;
    }
}

