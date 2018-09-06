<?php

if ( ! function_exists('oxides_edge_pricing_table_options_map') ) {
	/**
	 * Add Pricing Table options to elements page
	 */
	function oxides_edge_pricing_table_options_map() {

		$panel_pricing_table = oxides_edge_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_pricing_table',
				'title' => 'Pricing Table'
			)
		);

		oxides_edge_add_admin_section_title(array(
            'name' => 'pricing_table_color_section_styles',
            'title' => 'Basic Pricing Tables Color Styles',			
            'parent' => $panel_pricing_table
        ));

		//Color options
        $pricing_tables_holder_group = oxides_edge_add_admin_group(array(
            'name' => 'pricing_tables_holder_group',
            'title' => 'Holder Styles',
            'description' => 'Set color styles for pricing tables holder',
            'parent' => $panel_pricing_table
        ));
        $pricing_tables_holder_row = oxides_edge_add_admin_row(array(
            'name' => 'pricing_tables_holder_row',
            'next' => true,
            'parent' => $pricing_tables_holder_group
        ));
        	oxides_edge_add_admin_field(array(
                'parent'        => $pricing_tables_holder_row,
                'type'          => 'colorsimple',
                'name'          => 'pricing_holder_background_color',
                'default_value' => '',
                'label'         => 'Background Color'
            ));
        	oxides_edge_add_admin_field(array(
                'parent'        => $pricing_tables_holder_row,
                'type'          => 'colorsimple',
                'name'          => 'pricing_holder_price_background_color',
                'default_value' => '',
                'label'         => 'Title/Price Background Color'
            ));            
            oxides_edge_add_admin_field(array(
                'parent'        => $pricing_tables_holder_row,
                'type'          => 'colorsimple',
                'name'          => 'pricing_holder_active_background_color',
                'default_value' => '',
                'label'         => 'Hover/Active Background Color'
            ));
            oxides_edge_add_admin_field(array(
                'parent'        => $pricing_tables_holder_row,
                'type'          => 'colorsimple',
                'name'          => 'pricing_holder_separator_color',
                'default_value' => '',
                'label'         => 'Content Separator Color'
            ));

        //Typography options
        oxides_edge_add_admin_section_title(array(
            'name' => 'typography_section_title',
            'title' => 'Typography',			
            'parent' => $panel_pricing_table
        ));

        $typography_price_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_price_group',
            'title' => 'Price',
            'description' => 'Setup typography for price',
            'parent' => $panel_pricing_table
        ));

        $typography_price_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_price_row',
            'next' => true,
            'parent' => $typography_price_group
        ));

        	oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_row,
                'type'          => 'colorsimple',
                'name'          => 'pricing_price_color',
                'default_value' => '',
                'label'         => 'Text Color'
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_row,
                'type'          => 'textsimple',
                'name'          => 'pricing_price_text_size',
                'default_value' => '',
                'label'         => 'Text Size',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_row,
                'type'          => 'fontsimple',
                'name'          => 'pricing_price_font_family',
                'default_value' => '',
                'label'         => 'Font Family',
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_row,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_font_style',
                'default_value' => '',
                'label'         => 'Font Style',
                'options'       => oxides_edge_get_font_style_array()
            ));	

        $typography_price_row2 = oxides_edge_add_admin_row(array(
            'name' => 'typography_price_row2',
            'next' => true,
            'parent' => $typography_price_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_row2,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_font_weight',
                'default_value' => '',
                'label'         => 'Font Weight',
                'options'       => oxides_edge_get_font_weight_array()
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_row2,
                'type'          => 'textsimple',
                'name'          => 'pricing_price_letter_spacing',
                'default_value' => '',
                'label'         => 'Letter Spacing',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

        $typography_price_mark_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_price_mark_group',
            'title' => 'Price Mark',
            'description' => 'Setup typography for price mark',
            'parent' => $panel_pricing_table
        ));

        $typography_price_mark_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_price_mark_row',
            'next' => true,
            'parent' => $typography_price_mark_group
        ));

        	oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_mark_row,
                'type'          => 'colorsimple',
                'name'          => 'pricing_price_mark_color',
                'default_value' => '',
                'label'         => 'Text Color'
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_mark_row,
                'type'          => 'textsimple',
                'name'          => 'pricing_price_mark_text_size',
                'default_value' => '',
                'label'         => 'Text Size',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_mark_row,
                'type'          => 'fontsimple',
                'name'          => 'pricing_price_mark_font_family',
                'default_value' => '',
                'label'         => 'Font Family',
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_mark_row,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_mark_font_style',
                'default_value' => '',
                'label'         => 'Font Style',
                'options'       => oxides_edge_get_font_style_array()
            ));	

        $typography_price_mark_row2 = oxides_edge_add_admin_row(array(
            'name' => 'typography_price_mark_row2',
            'next' => true,
            'parent' => $typography_price_mark_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_mark_row2,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_mark_font_weight',
                'default_value' => '',
                'label'         => 'Font Weight',
                'options'       => oxides_edge_get_font_weight_array()
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_mark_row2,
                'type'          => 'textsimple',
                'name'          => 'pricing_price_mark_letter_spacing',
                'default_value' => '',
                'label'         => 'Letter Spacing',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));    

        $typography_price_value_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_price_value_group',
            'title' => 'Price Value',
            'description' => 'Setup typography for price value',
            'parent' => $panel_pricing_table
        ));

        $typography_price_value_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_price_value_row',
            'next' => true,
            'parent' => $typography_price_value_group
        ));

        	oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_value_row,
                'type'          => 'colorsimple',
                'name'          => 'pricing_price_value_color',
                'default_value' => '',
                'label'         => 'Text Color'
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_value_row,
                'type'          => 'textsimple',
                'name'          => 'pricing_price_value_text_size',
                'default_value' => '',
                'label'         => 'Text Size',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_value_row,
                'type'          => 'fontsimple',
                'name'          => 'pricing_price_value_font_family',
                'default_value' => '',
                'label'         => 'Font Family',
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_value_row,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_value_font_style',
                'default_value' => '',
                'label'         => 'Font Style',
                'options'       => oxides_edge_get_font_style_array()
            ));	

        $typography_price_value_row2 = oxides_edge_add_admin_row(array(
            'name' => 'typography_price_value_row2',
            'next' => true,
            'parent' => $typography_price_value_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_value_row2,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_value_font_weight',
                'default_value' => '',
                'label'         => 'Font Weight',
                'options'       => oxides_edge_get_font_weight_array()
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_value_row2,
                'type'          => 'textsimple',
                'name'          => 'pricing_price_value_letter_spacing',
                'default_value' => '',
                'label'         => 'Letter Spacing',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

        $typography_price_title_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_price_title_group',
            'title' => 'Price Title',
            'description' => 'Setup typography for price title',
            'parent' => $panel_pricing_table
        ));

        $typography_price_title_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_price_title_row',
            'next' => true,
            'parent' => $typography_price_title_group
        ));

        	oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_title_row,
                'type'          => 'colorsimple',
                'name'          => 'pricing_price_title_color',
                'default_value' => '',
                'label'         => 'Text Color'
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_title_row,
                'type'          => 'textsimple',
                'name'          => 'pricing_price_title_text_size',
                'default_value' => '',
                'label'         => 'Text Size',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_title_row,
                'type'          => 'fontsimple',
                'name'          => 'pricing_price_title_font_family',
                'default_value' => '',
                'label'         => 'Font Family',
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_title_row,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_title_font_style',
                'default_value' => '',
                'label'         => 'Font Style',
                'options'       => oxides_edge_get_font_style_array()
            ));	

        $typography_price_title_row2 = oxides_edge_add_admin_row(array(
            'name' => 'typography_price_title_row2',
            'next' => true,
            'parent' => $typography_price_title_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_title_row2,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_title_font_weight',
                'default_value' => '',
                'label'         => 'Font Weight',
                'options'       => oxides_edge_get_font_weight_array()
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_title_row2,
                'type'          => 'textsimple',
                'name'          => 'pricing_price_title_letter_spacing',
                'default_value' => '',
                'label'         => 'Letter Spacing',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));  

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_price_title_row2,
                'type'          => 'selectsimple',
                'name'          => 'pricing_price_title_text_transform',
                'default_value' => '',
                'label'         => 'Text Transform',
                'options'       => oxides_edge_get_text_transform_array()
            ));

	}

	add_action( 'oxides_edge_options_elements_map', 'oxides_edge_pricing_table_options_map');
}