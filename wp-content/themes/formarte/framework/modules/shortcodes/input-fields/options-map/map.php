<?php

if ( ! function_exists('oxides_edge_input_options_map') ) {
	/**
	 * Add Input Fields options to elements page
	 */
	function oxides_edge_input_options_map() {

		$panel_input_fields = oxides_edge_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_input_fields',
				'title' => 'Input Fields'
			)
		);

        oxides_edge_add_admin_section_title(array(
            'name' => 'input_fields_styles',
            'title' => 'Input Fields Color Style',
            'parent' => $panel_input_fields
        ));

            $input_fields_group = oxides_edge_add_admin_group(array(
                'name' => 'input_fields_group',
                'title' => 'Color Styles for comments form',
                'description' => '',
                'parent' => $panel_input_fields
            ));

                $input_fields_row = oxides_edge_add_admin_row(array(
                    'name' => 'input_fields_row',
                    'next' => true,
                    'parent' => $input_fields_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $input_fields_row,
                        'type'          => 'colorsimple',
                        'name'          => 'input_fields_text_color',
                        'default_value' => '',
                        'label'         => 'Text Color',
                        'description'   => ''
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $input_fields_row,
                        'type'          => 'colorsimple',
                        'name'          => 'input_fields_hover_text_color',
                        'default_value' => '',
                        'label'         => 'Text Hover Color',
                        'description'   => ''
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $input_fields_row,
                        'type'          => 'colorsimple',
                        'name'          => 'input_fields_bg_color',
                        'default_value' => '',
                        'label'         => 'Background Color',
                        'description'   => ''
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $input_fields_row,
                        'type'          => 'colorsimple',
                        'name'          => 'input_fields_hover_bg_color',
                        'default_value' => '',
                        'label'         => 'Hover Background Color',
                        'description'   => ''
                    ));

                $input_fields_row2 = oxides_edge_add_admin_row(array(
                    'name' => 'input_fields_row2',
                    'next' => true,
                    'parent' => $input_fields_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $input_fields_row2,
                        'type'          => 'colorsimple',
                        'name'          => 'input_fields_border_color',
                        'default_value' => '',
                        'label'         => 'Border Color',
                        'description'   => ''
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $input_fields_row2,
                        'type'          => 'colorsimple',
                        'name'          => 'input_fields_hover_border_color',
                        'default_value' => '',
                        'label'         => 'Hover Border Color',
                        'description'   => ''
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $input_fields_row2,
                        'type'          => 'colorsimple',
                        'name'          => 'input_fields_focus_border_color',
                        'default_value' => '',
                        'label'         => 'Focus Border Color',
                        'description'   => ''
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $input_fields_row2,
                        'type'          => 'textsimple',
                        'name'          => 'input_fields_border_width',
                        'default_value' => '',
                        'label'         => 'Border Width',
                        'description'   => '',
                        'args'          => array(
                            'suffix' => 'px'
                        )
                    ));
	}

	add_action( 'oxides_edge_options_elements_map', 'oxides_edge_input_options_map');

}