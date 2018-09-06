<?php

if(!function_exists('oxides_edge_title_classes')) {
    /**
     * Function that adds classes to title div.
     * All other functions are tied to it with add_filter function
     * @param array $classes array of classes
     */
    function oxides_edge_title_classes($classes = array()) {
        $classes = array();
        $classes = apply_filters('oxides_edge_title_classes', $classes);

        if(is_array($classes) && count($classes)) {
            echo implode(' ', $classes);
        }
    }
}

if(!function_exists('oxides_edge_title_type_class')) {
    /**
     * Function that adds class on title based on title type option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function oxides_edge_title_type_class($classes) {

        $title_type = 'standard';

        $classes[] = 'edgtf-'.$title_type.'-type';

        return $classes;

    }

    add_filter('oxides_edge_title_classes', 'oxides_edge_title_type_class');
}

if(!function_exists('oxides_edge_title_background_image_classes')) {
    function oxides_edge_title_background_image_classes($classes) {
        //init variables
        $id                         = oxides_edge_get_page_id();
        $is_img_responsive 		    = '';
        $is_image_parallax		    = '';
        $is_image_parallax_array    = array('yes', 'yes_zoom');
        $show_title_img			    = true;
        $title_img				    = '';

        //is responsive image is set for current page?
        if(get_post_meta($id, "edgtf_title_area_background_image_responsive_meta", true) != "") {
            $is_img_responsive = get_post_meta($id, "edgtf_title_area_background_image_responsive_meta", true);
        } else {
            //take value from theme options
            $is_img_responsive = oxides_edge_options()->getOptionValue('title_area_background_image_responsive');
        }

        //is title image chosen for current page?
        if(get_post_meta($id, "edgtf_title_area_background_image_meta", true) != ""){
            $title_img = get_post_meta($id, "edgtf_title_area_background_image_meta", true);
        }else{
            //take image that is set in theme options
            $title_img = oxides_edge_options()->getOptionValue('title_area_background_image');
        }

        //is image set to be fixed for current page?
        if(get_post_meta($id, "edgtf_title_area_background_image_parallax_meta", true) != ""){
            $is_image_parallax = get_post_meta($id, "edgtf_title_area_background_image_parallax_meta", true);
        }else{
            //take setting from theme options
            $is_image_parallax = oxides_edge_options()->getOptionValue('title_area_background_image_parallax');
        }

        //is title image hidden for current page?
        if(get_post_meta($id, "edgtf_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }

        //is title image set and visible?
        if($title_img !== '' && $show_title_img == true) {
            //is image not responsive and parallax title is set?
            $classes[] = 'edgtf-preload-background';
            $classes[] = 'edgtf-has-background';

            if($is_img_responsive == 'no' && in_array($is_image_parallax, $is_image_parallax_array)) {
                $classes[] = 'edgtf-has-parallax-background';

                if($is_image_parallax == 'yes_zoom') {
                    $classes[] = 'edgtf-zoom-out';
                }
            }

            //is image not responsive
            elseif($is_img_responsive == 'yes'){
                $classes[] = 'edgtf-has-responsive-background';
            }
        }

        return $classes;
    }

    add_filter('oxides_edge_title_classes', 'oxides_edge_title_background_image_classes');
}

if(!function_exists('oxides_edge_title_content_alignment_class')) {
    /**
     * Function that adds class on title based on title content alignmnt option
     * Could be left, centered or right
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function oxides_edge_title_content_alignment_class($classes) {

        //init variables
        $id                      = oxides_edge_get_page_id();
        $title_content_alignment = 'center';

        if(get_post_meta($id, "edgtf_title_area_content_alignment_meta", true) != "") {
            $title_content_alignment = get_post_meta($id, "edgtf_title_area_content_alignment_meta", true);

        } else {
            $title_content_alignment = oxides_edge_options()->getOptionValue('title_area_content_alignment');
        }

        $classes[] = 'edgtf-content-'.$title_content_alignment.'-alignment';

        return $classes;

    }

    add_filter('oxides_edge_title_classes', 'oxides_edge_title_content_alignment_class');
}

if(!function_exists('oxides_edge_title_animation_class')) {
    /**
     * Function that adds class on title based on title animation option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function oxides_edge_title_animation_class($classes) {

        //init variables
        $id                      = oxides_edge_get_page_id();
        $title_animation = 'no';

        if(get_post_meta($id, "edgtf_title_area_animation_meta", true) !== "") {
            $title_animation = get_post_meta($id, "edgtf_title_area_animation_meta", true);

        } else {
            $title_animation = oxides_edge_options()->getOptionValue('title_area_animation');
        }

        $classes[] = 'edgtf-animation-'.$title_animation;

        return $classes;

    }

    add_filter('oxides_edge_title_classes', 'oxides_edge_title_animation_class');
}

if(!function_exists('oxides_edge_title_background_image_div_classes')) {
    function oxides_edge_title_background_image_div_classes($classes) {

        //init variables
        $id                         = oxides_edge_get_page_id();
        $is_img_responsive 		    = '';
        $show_title_img			    = true;
        $title_img				    = '';

        //is responsive image is set for current page?
        if(get_post_meta($id, "edgtf_title_area_background_image_responsive_meta", true) != "") {
            $is_img_responsive = get_post_meta($id, "edgtf_title_area_background_image_responsive_meta", true);
        } else {
            //take value from theme options
            $is_img_responsive = oxides_edge_options()->getOptionValue('title_area_background_image_responsive');
        }

        //is title image chosen for current page?
        if(get_post_meta($id, "edgtf_title_area_background_image_meta", true) != ""){
            $title_img = get_post_meta($id, "edgtf_title_area_background_image_meta", true);
        }else{
            //take image that is set in theme options
            $title_img = oxides_edge_options()->getOptionValue('title_area_background_image');
        }

        //is title image hidden for current page?
        if(get_post_meta($id, "edgtf_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }

        //is title image set, visible and responsive?
        if($title_img !== '' && $show_title_img == true) {

            //is image responsive?
            if($is_img_responsive == 'yes') {
                $classes[] = 'edgtf-title-image-responsive';
            }
            //is image not responsive?
            elseif($is_img_responsive == 'no') {
                $classes[] = 'edgtf-title-image-not-responsive';
            }
        }

        return $classes;
    }

    add_filter('oxides_edge_title_classes', 'oxides_edge_title_background_image_div_classes');
}

if(!function_exists('oxides_edge_title_predefined_size_class')) {
    /**
     * Function that adds class on title based on title animation option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function oxides_edge_title_predefined_size_class($classes) {

        //init variables
        $id                      = oxides_edge_get_page_id();
        $title_predefined_class = '';

        if(get_post_meta($id, "edgtf_title_predefined_size", true) !== "") {

            $title_predefined_class = get_post_meta($id, "edgtf_title_predefined_size", true);
            $classes[] = 'edgtf-title-size-'.$title_predefined_class;

        } elseif(oxides_edge_options()->getOptionValue('title_predefined_size') !== ""){

            $title_predefined_class = oxides_edge_options()->getOptionValue('title_predefined_size');
            $classes[] = 'edgtf-title-size-'.$title_predefined_class;
        }


        return $classes;

    }

    add_filter('oxides_edge_title_classes', 'oxides_edge_title_predefined_size_class');
}