<?php

add_action('after_setup_theme', 'oxides_edge_admin_map_init', 0);

function oxides_edge_admin_map_init() {

    do_action('oxides_edge_before_options_map');

    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/general/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/fonts/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/elements/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/page/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/content/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/sidebar/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/parallax/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/social/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/error404/map.php';
    require_once EDGE_FRAMEWORK_ROOT_DIR.'/admin/options/reset/map.php';


    do_action('oxides_edge_options_map');

    do_action('oxides_edge_after_options_map');

}