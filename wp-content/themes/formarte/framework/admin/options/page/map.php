<?php

if ( ! function_exists('oxides_edge_page_options_map') ) {

    function oxides_edge_page_options_map() {

        oxides_edge_add_admin_page(
            array(
                'slug'  => '_page_page',
                'title' => 'Page',
                'icon'  => 'fa fa-file-o'
            )
        );

        $custom_sidebars = oxides_edge_get_custom_sidebars();

        $panel_sidebar = oxides_edge_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_sidebar',
                'title' => 'Design Style'
            )
        );

        oxides_edge_add_admin_field(array(
            'name'        => 'page_sidebar_layout',
            'type'        => 'select',
            'label'       => 'Sidebar Layout',
            'description' => 'Choose a sidebar layout for pages',
            'default_value' => 'default',
            'parent'      => $panel_sidebar,
            'options'     => array(
                'default'			=> 'No Sidebar',
                'sidebar-33-right'	=> 'Sidebar 1/3 Right',
                'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
                'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
                'sidebar-25-left' 	=> 'Sidebar 1/4 Left'
            )
        ));


        if(count($custom_sidebars) > 0) {
            oxides_edge_add_admin_field(array(
                'name' => 'page_custom_sidebar',
                'type' => 'selectblank',
                'label' => 'Sidebar to Display',
                'description' => 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"',
                'parent' => $panel_sidebar,
                'options' => $custom_sidebars
            ));
        }

        oxides_edge_add_admin_field(array(
            'name'        => 'page_show_comments',
            'type'        => 'yesno',
            'label'       => 'Show Comments',
            'description' => 'Enabling this option will show comments on your page',
            'default_value' => 'yes',
            'parent'      => $panel_sidebar
        ));

    }

    add_action( 'oxides_edge_options_map', 'oxides_edge_page_options_map', 11 );

}