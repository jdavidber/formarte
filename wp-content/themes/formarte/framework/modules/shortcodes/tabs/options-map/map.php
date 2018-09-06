<?php

if(!function_exists('oxides_edge_tabs_map')) {
    function oxides_edge_tabs_map() {
		
        $panel = oxides_edge_add_admin_panel(array(
            'title' => 'Tabs',
            'name'  => 'panel_tabs',
            'page'  => '_elements_page'
        ));

        //Typography options
        oxides_edge_add_admin_section_title(array(
            'name' => 'typography_section_title',
            'title' => 'Tabs Navigation Typography',			
            'parent' => $panel
        ));

        $typography_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_group',
            'title' => 'Tabs Navigation Typography',
			'description' => 'Setup typography for tabs navigation',
            'parent' => $panel
        ));

        $typography_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_row',
            'next' => true,
            'parent' => $typography_group
        ));

        oxides_edge_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'textsimple',
            'name'          => 'tabs_font_size',
            'default_value' => '',
            'label'         => 'Text Size',
            'args'          => array(
                'suffix' => 'px'
            )
        ));

        oxides_edge_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'fontsimple',
            'name'          => 'tabs_font_family',
            'default_value' => '',
            'label'         => 'Font Family',
        ));

        oxides_edge_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'tabs_text_transform',
            'default_value' => '',
            'label'         => 'Text Transform',
            'options'       => oxides_edge_get_text_transform_array()
        ));

        oxides_edge_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'textsimple',
            'name'          => 'tabs_letter_spacing',
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
            'name'          => 'tabs_font_style',
            'default_value' => '',
            'label'         => 'Font Style',
            'options'       => oxides_edge_get_font_style_array()
        ));

        oxides_edge_add_admin_field(array(
            'parent'        => $typography_row2,
            'type'          => 'selectsimple',
            'name'          => 'tabs_font_weight',
            'default_value' => '',
            'label'         => 'Font Weight',
            'options'       => oxides_edge_get_font_weight_array()
        ));
		
		//Initial Tab Color Styles
		
		oxides_edge_add_admin_section_title(array(
            'name' => 'tab_color_section_title',
            'title' => 'Tab Navigation Color Styles',			
            'parent' => $panel
        ));

    		$tabs_color_group = oxides_edge_add_admin_group(array(
                'name' => 'tabs_color_group',
                'title' => 'Horizontal Tab Title Styles',
    			'description' => 'Set color styles for horizontal tab title navigation',
                'parent' => $panel
            ));

        		$tabs_color_row = oxides_edge_add_admin_row(array(
                    'name' => 'tabs_color_row',
                    'next' => true,
                    'parent' => $tabs_color_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

            		oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_border_color',
                        'default_value' => '',
                        'label'         => 'Border Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_hover_color',
                        'default_value' => '',
                        'label'         => 'Hover/Active Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_hover_background_color',
                        'default_value' => '',
                        'label'         => 'Hover/Active Background Color'
                    ));

            //Horizontal Tab Style White Layout Color Styles
            
            $tabs_white_color_group = oxides_edge_add_admin_group(array(
                'name' => 'tabs_white_color_group',
                'title' => 'Horizontal Tab White Title Styles',
                'description' => 'Set color styles for horizontal tab white title style navigation',
                'parent' => $panel
            ));

                $tabs_white_color_row = oxides_edge_add_admin_row(array(
                    'name' => 'tabs_white_color_row',
                    'next' => true,
                    'parent' => $tabs_white_color_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_white_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_white_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_white_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_white_border_color',
                        'default_value' => '',
                        'label'         => 'Border Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_white_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_hover_white_color',
                        'default_value' => '',
                        'label'         => 'Hover/Active Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_white_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_hover_white_background_color',
                        'default_value' => '',
                        'label'         => 'Hover/Active Background Color'
                    ));

            //Horizontal Tab Style Boxed Layout Color Styles        

            $tabs_boxed_color_group = oxides_edge_add_admin_group(array(
                'name' => 'tabs_boxed_color_group',
                'title' => 'Horizontal Tab Boxed Title Styles',
                'description' => 'Set color styles for horizontal tab boxed title navigation',
                'parent' => $panel
            ));

                $tabs_boxed_color_row = oxides_edge_add_admin_row(array(
                    'name' => 'tabs_boxed_color_row',
                    'next' => true,
                    'parent' => $tabs_boxed_color_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_boxed_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_boxed_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_boxed_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_boxed_back_color',
                        'default_value' => '',
                        'label'         => 'Boxed Background Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_boxed_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_boxed_border_color',
                        'default_value' => '',
                        'label'         => 'Border Color'
                    ));

            //Horizontal Tab Style Full Width Layout Color Styles        

            $tabs_full_width_color_group = oxides_edge_add_admin_group(array(
                'name' => 'tabs_full_width_color_group',
                'title' => 'Horizontal Tab Full Width Title Styles',
                'description' => 'Set color styles for horizontal tab full width title navigation',
                'parent' => $panel
            ));

                $tabs_full_width_color_row = oxides_edge_add_admin_row(array(
                    'name' => 'tabs_full_width_color_row',
                    'next' => true,
                    'parent' => $tabs_full_width_color_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_full_width_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_full_width_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_full_width_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_full_width_background_color',
                        'default_value' => '',
                        'label'         => 'Tabs Area Background Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_full_width_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_full_width_hover_color',
                        'default_value' => '',
                        'label'         => 'Hover/Active Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $tabs_full_width_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'tabs_full_width_hover_background_color',
                        'default_value' => '',
                        'label'         => 'Hover/Active Background Color'
                    ));                
		
    		//Vertical Tab Color Styles
    		
    		$vertical_tabs_color_group = oxides_edge_add_admin_group(array(
                'name' => 'vertical_tabs_color_group',
                'title' => 'Vertical Tab Title Styles',
                'description' => 'Set color styles for vertical tab title navigation',
                'parent' => $panel
            ));

        		$vertical_tabs_color_row = oxides_edge_add_admin_row(array(
                    'name' => 'vertical_tabs_color_row',
                    'next' => true,
                    'parent' => $vertical_tabs_color_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $vertical_tabs_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'vertical_tabs_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

            		oxides_edge_add_admin_field(array(
                        'parent'        => $vertical_tabs_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'vertical_tabs_border_color',
                        'default_value' => '',
                        'label'         => 'Border Color'
                    )); 

                    oxides_edge_add_admin_field(array(
                        'parent'        => $vertical_tabs_color_row,
                        'type'          => 'colorsimple',
                        'name'          => 'vertical_tabs_hover_color',
                        'default_value' => '',
                        'label'         => 'Hover/Active Color'
                    ));
        
    }

    add_action('oxides_edge_options_elements_map', 'oxides_edge_tabs_map');
}