<?php

$header_meta_box = oxides_edge_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Header',
        'name' => 'header-meta'
    )
);
    oxides_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_header_style_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Header Skin',
            'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
            'parent' => $header_meta_box,
            'options' => array(
                '' => '',
                'light-header' => 'Light',
                'dark-header' => 'Dark'
            )
        )
    );

    oxides_edge_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'edgtf_enable_header_style_on_scroll_meta',
            'default_value' => '',
            'label' => 'Enable Header Style on Scroll',
            'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );

    oxides_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_menu_area_background_color_header_standard_meta',
            'type' => 'color',
            'label' => 'Background Color',
            'description' => 'Choose a background color for header area',
            'parent' => $header_meta_box
        )
    );

    oxides_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_menu_area_background_transparency_header_standard_meta',
            'type' => 'text',
            'label' => 'Transparency',
            'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
            'parent' => $header_meta_box,
            'args' => array(
                'col_width' => 2
            )
        )
    );

    oxides_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_show_border_header_area_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Enable Bottom Header Border',
            'description' => 'Disabling this option will turn off bottom border for header area',
            'parent' => $header_meta_box,
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => "",
                    "no" => "#edgtf_show_border_header_area_meta_container",
                    "yes" => ""
                ),
                "show" => array(
                    "" => "#edgtf_show_border_header_area_meta_container",
                    "no" => "",
                    "yes" => "#edgtf_show_border_header_area_meta_container"
                )
            )
        )
    );

    $show_border_header_area_meta_container = oxides_edge_add_admin_container(
        array(
            'parent' => $header_meta_box,
            'name' => 'show_border_header_area_meta_container',
            'hidden_property' => 'edgtf_show_border_header_area_meta',
            'hidden_value' => "no"
        )
    );

        oxides_edge_add_meta_box_field(
            array(
                'name' => 'edgtf_menu_area_border_color_header_standard_meta',
                'type' => 'color',
                'label' => 'Border Color',
                'description' => 'Choose a border color for header area',
                'parent' => $show_border_header_area_meta_container
            )
        );


    oxides_edge_add_meta_box_field(
        array(
            'name'            => 'edgtf_scroll_amount_for_sticky_meta',
            'type'            => 'text',
            'label'           => 'Scroll amount for sticky header appearance',
            'description'     => 'Define scroll amount for sticky header appearance',
            'parent'          => $header_meta_box,
            'args'            => array(
                'col_width' => 2,
                'suffix'    => 'px'
            ),
            'hidden_property' => 'header_behaviour',
            'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
        )
    );