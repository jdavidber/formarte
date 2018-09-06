<?php

if ( ! function_exists('oxides_edge_team_options_map') ) {
	/**
	 * Add Team options to elements page
	 */
	function edgtf_testimonials_options_map() {

		$panel_testimonials = oxides_edge_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_testimonials',
				'title' => 'Testimonials'
			)
		);

         //Typography options
        oxides_edge_add_admin_section_title(array(
            'name' => 'typography_section_title',
            'title' => 'Typography',			
            'parent' => $panel_testimonials
        ));

        $typography_testimonials_title_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_title_group',
            'title' => 'Title Style',
            'description' => 'Setup typography for title',
            'parent' => $panel_testimonials
        ));

        $typography_testimonials_title_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_title_row',
            'next' => true,
            'parent' => $typography_testimonials_title_group
        ));

        	oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_title_row,
                'type'          => 'colorsimple',
                'name'          => 'testimonials_title_color',
                'default_value' => '',
                'label'         => 'Text Color'
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_title_row,
                'type'          => 'textsimple',
                'name'          => 'testimonials_title_text_size',
                'default_value' => '',
                'label'         => 'Text Size',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_title_row,
                'type'          => 'fontsimple',
                'name'          => 'testimonials_title_font_family',
                'default_value' => '',
                'label'         => 'Font Family',
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_title_row,
                'type'          => 'selectsimple',
                'name'          => 'testimonials_title_font_style',
                'default_value' => '',
                'label'         => 'Font Style',
                'options'       => oxides_edge_get_font_style_array()
            ));

        $typography_testimonials_title_row2 = oxides_edge_add_admin_row(array(
            'name' => 'typography_testimonials_title_row2',
            'next' => true,
            'parent' => $typography_testimonials_title_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_title_row2,
                'type'          => 'selectsimple',
                'name'          => 'testimonials_title_font_weight',
                'default_value' => '',
                'label'         => 'Font Weight',
                'options'       => oxides_edge_get_font_weight_array()
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_title_row2,
                'type'          => 'textsimple',
                'name'          => 'testimonials_title_letter_spacing',
                'default_value' => '',
                'label'         => 'Letter Spacing',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

        $typography_testimonials_text_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_testimonials_text_group',
            'title' => 'Text Style',
            'description' => 'Setup typography for text',
            'parent' => $panel_testimonials
        ));

        $typography_testimonials_text_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_testimonials_text_row',
            'next' => true,
            'parent' => $typography_testimonials_text_group
        ));

        	oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_text_row,
                'type'          => 'colorsimple',
                'name'          => 'testimonials_text_color',
                'default_value' => '',
                'label'         => 'Text Color'
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_text_row,
                'type'          => 'textsimple',
                'name'          => 'testimonials_text_text_size',
                'default_value' => '',
                'label'         => 'Text Size',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_text_row,
                'type'          => 'fontsimple',
                'name'          => 'testimonials_text_font_family',
                'default_value' => '',
                'label'         => 'Font Family',
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_text_row,
                'type'          => 'selectsimple',
                'name'          => 'testimonials_text_font_style',
                'default_value' => '',
                'label'         => 'Font Style',
                'options'       => oxides_edge_get_font_style_array()
            ));	

        $typography_testimonials_text_row2 = oxides_edge_add_admin_row(array(
            'name' => 'typography_testimonials_text_row2',
            'next' => true,
            'parent' => $typography_testimonials_text_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_text_row2,
                'type'          => 'selectsimple',
                'name'          => 'testimonials_text_font_weight',
                'default_value' => '',
                'label'         => 'Font Weight',
                'options'       => oxides_edge_get_font_weight_array()
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_text_row2,
                'type'          => 'textsimple',
                'name'          => 'testimonials_text_letter_spacing',
                'default_value' => '',
                'label'         => 'Letter Spacing',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));    

        $typography_testimonials_author_group = oxides_edge_add_admin_group(array(
            'name' => 'typography_testimonials_author_group',
            'title' => 'Author Style',
            'description' => 'Setup typography for author',
            'parent' => $panel_testimonials
        ));

        $typography_testimonials_author_row = oxides_edge_add_admin_row(array(
            'name' => 'typography_testimonials_author_row',
            'next' => true,
            'parent' => $typography_testimonials_author_group
        ));

        	oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_author_row,
                'type'          => 'colorsimple',
                'name'          => 'testimonials_author_color',
                'default_value' => '',
                'label'         => 'Text Color'
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_author_row,
                'type'          => 'textsimple',
                'name'          => 'testimonials_author_text_size',
                'default_value' => '',
                'label'         => 'Text Size',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_author_row,
                'type'          => 'fontsimple',
                'name'          => 'testimonials_author_font_family',
                'default_value' => '',
                'label'         => 'Font Family',
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_author_row,
                'type'          => 'selectsimple',
                'name'          => 'testimonials_author_font_style',
                'default_value' => '',
                'label'         => 'Font Style',
                'options'       => oxides_edge_get_font_style_array()
            ));	

        $typography_testimonials_author_row2 = oxides_edge_add_admin_row(array(
            'name' => 'typography_testimonials_author_row2',
            'next' => true,
            'parent' => $typography_testimonials_author_group
        ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_author_row2,
                'type'          => 'selectsimple',
                'name'          => 'testimonials_author_font_weight',
                'default_value' => '',
                'label'         => 'Font Weight',
                'options'       => oxides_edge_get_font_weight_array()
            ));

            oxides_edge_add_admin_field(array(
                'parent'        => $typography_testimonials_author_row2,
                'type'          => 'textsimple',
                'name'          => 'testimonials_author_letter_spacing',
                'default_value' => '',
                'label'         => 'Letter Spacing',
                'args'          => array(
                    'suffix' => 'px'
                )
            ));
        
        
	}

	add_action( 'edgtf_options_elements_map', 'edgtf_testimonials_options_map', '2' );

}