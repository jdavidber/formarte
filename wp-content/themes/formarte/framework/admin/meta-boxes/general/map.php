<?php

$general_meta_box = oxides_edge_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'General',
        'name' => 'general-meta'
    )
);


    oxides_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_page_background_color_meta',
            'type' => 'color',
            'default_value' => '',
            'label' => 'Page Background Color',
            'description' => 'Choose background color for page content',
            'parent' => $general_meta_box
        )
    );

    oxides_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_page_slider_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => 'Slider Shortcode',
            'description' => 'Paste your slider shortcode here',
            'parent' => $general_meta_box
        )
    );

    oxides_edge_add_meta_box_field(
        array(
            'name'        => 'edgtf_page_slider_meta_position',
            'type'        => 'select',
            'label'       => 'Set Slider Shortcode to Start Behind Header',
            'parent'      => $general_meta_box,
            'options'     => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        )
    );

    $edgtf_content_padding_group = oxides_edge_add_admin_group(array(
        'name' => 'content_padding_group',
        'title' => 'Content Style',
        'description' => 'Define styles for Content area',
        'parent' => $general_meta_box
    ));

    $edgtf_content_padding_row = oxides_edge_add_admin_row(array(
        'name' => 'edgtf_content_padding_row',
        'next' => true,
        'parent' => $edgtf_content_padding_group
    ));

    oxides_edge_add_meta_box_field(
        array(
            'name'          => 'edgtf_page_content_top_padding',
            'type'          => 'textsimple',
            'default_value' => '',
            'label'         => 'Content Top Padding',
            'parent'        => $edgtf_content_padding_row,
            'args'          => array(
                'suffix' => 'px'
            )
        )
    );

    oxides_edge_add_meta_box_field(
        array(
            'name'        => 'edgtf_page_content_top_padding_mobile',
            'type'        => 'selectblanksimple',
            'label'       => 'Set this top padding for mobile header',
            'parent'      => $edgtf_content_padding_row,
            'options'     => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        )
    );

    oxides_edge_add_meta_box_field(
        array(
            'name'        => 'edgtf_page_comments_meta',
            'type'        => 'selectblank',
            'label'       => 'Show Comments',
            'description' => 'Enabling this option will show comments on your page',
            'parent'      => $general_meta_box,
            'options'     => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        )
    );