<?php 
if(!function_exists('oxides_edge_accordions_map')) {
    /**
     * Add Accordion options to elements panel
     */
    function oxides_edge_accordions_map() {
    	
        $panel = oxides_edge_add_admin_panel(array(
            'title' => 'Accordions',
            'name'  => 'panel_accordions',
            'page'  => '_elements_page'
        ));

        //Typography options
        oxides_edge_add_admin_section_title(array(
            'name' => 'typography_section_title',
            'title' => 'Typography',			
            'parent' => $panel
        ));

        $typography_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_group',
            'title' => 'Typography',
            'description' => 'Setup typography for accordions navigation',
            'parent' => $panel
        ));

        $typography_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_row',
            'next' => true,
            'parent' => $typography_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_row,
                'type'          => 'fontsimple',
                'name'          => 'accordions_font_family',
                'default_value' => '',
                'label'         => 'Font Family',
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_row,
                'type'          => 'textsimple',
                'name'          => 'accordions_text_size',
                'default_value' => '',
                'label'         => 'Text Size',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_row,
                'type'          => 'selectsimple',
                'name'          => 'accordions_text_transform',
                'default_value' => '',
                'label'         => 'Text Transform',
                'options'       => oxides_edge_get_text_transform_array()
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_row,
                'type'          => 'textsimple',
                'name'          => 'accordions_letter_spacing',
                'default_value' => '',
                'label'         => 'Letter Spacing',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

        $typography_row2 = oxides_edge_add_admin_row(array(
            'name' => 'typography_row2',
            'next' => true,
            'parent' => $typography_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_row2,
                'type'          => 'selectsimple',
                'name'          => 'accordions_font_style',
                'default_value' => '',
                'label'         => 'Font Style',
                'options'       => oxides_edge_get_font_style_array()
            ));	

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_row2,
                'type'          => 'selectsimple',
                'name'          => 'accordions_font_weight',
                'default_value' => '',
                'label'         => 'Font Weight',
                'options'       => oxides_edge_get_font_weight_array()
            ));

        //Initial Accordion Color Styles

        oxides_edge_add_admin_section_title(array(
            'name' => 'accordion_color_section_title',
            'title' => 'Basic Accordions Color Styles',			
            'parent' => $panel
        ));

        $accordions_color_group = oxides_edge_add_admin_group(array(
            'name' => 'accordions_color_group',
            'title' => 'Accordion Color Styles',
            'description' => 'Set color styles for accordion title',
            'parent' => $panel
        ));
        $accordions_color_row = oxides_edge_add_admin_row(array(
            'name' => 'accordions_color_row',
            'next' => true,
            'parent' => $accordions_color_group
        ));
            oxides_edge_add_admin_field(array(
                'parent'        => $accordions_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_title_color',
                'default_value' => '',
                'label'         => 'Title Color'
            ));
            oxides_edge_add_admin_field(array(
                'parent'        => $accordions_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_icon_color',
                'default_value' => '',
                'label'         => 'Icon Color'
            ));
            oxides_edge_add_admin_field(array(
                'parent'        => $accordions_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_icon_back_color',
                'default_value' => '',
                'label'         => 'Icon Background Color'
            ));
            oxides_edge_add_admin_field(array(
                'parent'        => $accordions_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_separator_color',
                'default_value' => '',
                'label'         => 'Separator Color'
            ));

        $accordions_simple_color_group = oxides_edge_add_admin_group(array(
            'name' => 'accordions_simple_color_group',
            'title' => 'Accordion Simple Color Styles',
            'description' => 'Set color styles for simple accordions',
            'parent' => $panel
        ));
        $accordions_simple_color_row = oxides_edge_add_admin_row(array(
            'name' => 'accordions_simple_color_row',
            'next' => true,
            'parent' => $accordions_simple_color_group
        ));
            oxides_edge_add_admin_field(array(
                'parent'        => $accordions_simple_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_simple_title_color',
                'default_value' => '',
                'label'         => 'Title Color'
            ));
            oxides_edge_add_admin_field(array(
                'parent'        => $accordions_simple_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_simple_icon_color',
                'default_value' => '',
                'label'         => 'Icon Color'
            ));   

        $active_accordions_color_group = oxides_edge_add_admin_group(array(
            'name' => 'active_accordions_color_group',
            'title' => 'Active and Hover Accordion Color Styles',
            'description' => 'Set color styles for active and hover accordions',
            'parent' => $panel
        ));
        $active_accordions_color_row = oxides_edge_add_admin_row(array(
            'name' => 'active_accordions_color_row',
            'next' => true,
            'parent' => $active_accordions_color_group
        ));
            oxides_edge_add_admin_field(array(
                'parent'        => $active_accordions_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_title_color_active',
                'default_value' => '',
                'label'         => 'Title Color'
            ));
            oxides_edge_add_admin_field(array(
                'parent'        => $active_accordions_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_icon_color_active',
                'default_value' => '',
                'label'         => 'Icon Color'
            ));
            oxides_edge_add_admin_field(array(
                'parent'        => $active_accordions_color_row,
                'type'          => 'colorsimple',
                'name'          => 'accordions_icon_back_color_active',
                'default_value' => '',
                'label'         => 'Icon Background Color'
            ));
   }
   add_action('oxides_edge_options_elements_map', 'oxides_edge_accordions_map');
}