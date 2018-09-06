<?php

if(!function_exists('oxides_edge_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function oxides_edge_is_responsive_on() {
        return oxides_edge_options()->getOptionValue('responsiveness') !== 'no';
    }
}

if(!function_exists('oxides_edge_is_seo_enabled')) {
    /**
     * Checks if SEO is enabled in theme options
     * @return bool
     */
    function oxides_edge_is_seo_enabled() {
        return oxides_edge_options()->getOptionValue('disable_seo') == 'no';
    }
}