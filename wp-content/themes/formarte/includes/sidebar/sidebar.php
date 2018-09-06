<?php

if(!function_exists('oxides_edge_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function oxides_edge_register_sidebars() {

        register_sidebar(array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'description' => 'Default Sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>'
        ));

    }

    add_action('widgets_init', 'oxides_edge_register_sidebars');
}

if(!function_exists('oxides_edge_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates oxides_edge_sidebar object
     */
    function oxides_edge_add_support_custom_sidebar() {
        add_theme_support('oxides_edge_sidebar');
        if (get_theme_support('oxides_edge_sidebar')) new oxides_edge_sidebar();
    }

    add_action('after_setup_theme', 'oxides_edge_add_support_custom_sidebar');
}
