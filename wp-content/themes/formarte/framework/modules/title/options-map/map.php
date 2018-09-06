<?php

if ( ! function_exists('oxides_edge_title_options_map') ) {

	function oxides_edge_title_options_map() {

		oxides_edge_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => 'Title',
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = oxides_edge_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => 'Title Settings'
			)
		);

		oxides_edge_add_admin_field(
			array(
				'name' => 'show_title_area',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => 'Show Title Area',
				'description' => 'This option will enable/disable Title Area',
				'parent' => $panel_title,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgtf_show_title_area_container"
				)
			)
		);

		$show_title_area_container = oxides_edge_add_admin_container(
			array(
				'parent' => $panel_title,
				'name' => 'show_title_area_container',
				'hidden_property' => 'show_title_area',
				'hidden_value' => 'no'
			)
		);

        oxides_edge_add_admin_field(
            array(
                'name' => 'title_predefined_size',
                'type' => 'select',
                'default_value' => 'small',
                'label' => 'Predefined Size',
                'description' => 'Choose title predefined size for Title Area (Font and Height)',
                'parent' => $show_title_area_container,
                'options' => array(
                    'small' => 'Small',
                    'large' => 'Large'
                )
            )
        );

		oxides_edge_add_admin_field(
			array(
				'name' => 'title_area_animation',
				'type' => 'select',
				'default_value' => 'no',
				'label' => 'Animations',
				'description' => 'Choose an animation for Title Area',
				'parent' => $show_title_area_container,
				'options' => array(
					'no' => 'No Animation',
					'right-left' => 'Text right to left',
					'left-right' => 'Text left to right'
				)
			)
		);

		oxides_edge_add_admin_field(
			array(
				'name' => 'title_area_vertial_alignment',
				'type' => 'select',
				'default_value' => 'header_bottom',
				'label' => 'Vertical Alignment',
				'description' => 'Specify title vertical alignment',
				'parent' => $show_title_area_container,
				'options' => array(
					'header_bottom' => 'From Bottom of Header',
					'window_top' => 'From Window Top'
				)
			)
		);

		oxides_edge_add_admin_field(
			array(
				'name' => 'title_area_content_alignment',
				'type' => 'select',
				'default_value' => 'center',
				'label' => 'Horizontal Alignment',
				'description' => 'Specify title horizontal alignment',
				'parent' => $show_title_area_container,
				'options' => array(
                    'center' => 'Center',
                    'left' => 'Left',
					'right' => 'Right'
				)
			)
		);

		oxides_edge_add_admin_field(
			array(
				'name' => 'title_area_background_color',
				'type' => 'color',
				'label' => 'Background Color',
				'description' => 'Choose a background color for Title Area',
				'parent' => $show_title_area_container
			)
		);

		oxides_edge_add_admin_field(
			array(
				'name' => 'title_area_background_image',
				'type' => 'image',
				'label' => 'Background Image',
				'description' => 'Choose an Image for Title Area',
				'parent' => $show_title_area_container
			)
		);

		oxides_edge_add_admin_field(
			array(
				'name' => 'title_area_background_image_responsive',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Background Responsive Image',
				'description' => 'Enabling this option will make Title background image responsive',
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#edgtf_title_area_background_image_responsive_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$title_area_background_image_responsive_container = oxides_edge_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_background_image_responsive_container',
				'hidden_property' => 'title_area_background_image_responsive',
				'hidden_value' => 'yes'
			)
		);

		oxides_edge_add_admin_field(
			array(
				'name' => 'title_area_background_image_parallax',
				'type' => 'select',
				'default_value' => 'no',
				'label' => 'Background Image in Parallax',
				'description' => 'Enabling this option will make Title background image parallax',
				'parent' => $title_area_background_image_responsive_container,
				'options' => array(
					'no' => 'No',
					'yes' => 'Yes',
					'yes_zoom' => 'Yes, with zoom out'
				)
			)
		);

		oxides_edge_add_admin_field(array(
			'name' => 'title_area_height',
			'type' => 'text',
			'label' => 'Height',
			'description' => 'Set a height for Title Area',
			'parent' => $title_area_background_image_responsive_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

        oxides_edge_add_admin_field(
            array(
                'name' => 'title_area_border',
                'type' => 'yesno',
                'default_value' => 'yes',
                'label' => 'Enable Bottom Border on Title',
                'description' => 'Enabling this option will place border on the bottom of Title',
                'parent' => $show_title_area_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#edgtf_title_area_border_container"
                )
            )
        );

        $title_area_border_container = oxides_edge_add_admin_container(
            array(
                'parent' => $show_title_area_container,
                'name' => 'title_area_border_container',
                'hidden_property' => 'title_area_border',
                'hidden_value' => 'no'
            )
        );

        oxides_edge_add_admin_field(
            array(
                'name' => 'title_area_border_color',
                'type' => 'color',
                'label' => 'Border Color',
                'description' => 'Choose a color for Bottom Border on Title Area',
                'parent' => $title_area_border_container
            )
        );

        oxides_edge_add_admin_field(
            array(
                'name' => 'title_area_border_width',
                'type' => 'text',
                'label' => 'Border Width',
                'description' => 'Set a width for Bottom Border on Title Area',
                'parent' => $title_area_border_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => 'px'
                )
            )
        );

		$panel_typography = oxides_edge_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title_typography',
				'title' => 'Typography'
			)
		);

		$group_page_title_styles = oxides_edge_add_admin_group(array(
			'name'			=> 'group_page_title_styles',
			'title'			=> 'Title',
			'description'	=> 'Define styles for page title',
			'parent'		=> $panel_typography
		));

		$row_page_title_styles_1 = oxides_edge_add_admin_row(array(
			'name'		=> 'row_page_title_styles_1',
			'parent'	=> $group_page_title_styles
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_color',
			'default_value'	=> '',
			'label'			=> 'Text Color',
			'parent'		=> $row_page_title_styles_1
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_fontsize',
			'default_value'	=> '',
			'label'			=> 'Font Size',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_lineheight',
			'default_value'	=> '',
			'label'			=> 'Line Height',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_texttransform',
			'default_value'	=> '',
			'label'			=> 'Text Transform',
			'options'		=> oxides_edge_get_text_transform_array(),
			'parent'		=> $row_page_title_styles_1
		));

		$row_page_title_styles_2 = oxides_edge_add_admin_row(array(
			'name'		=> 'row_page_title_styles_2',
			'parent'	=> $group_page_title_styles,
			'next'		=> true
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_title_google_fonts',
			'default_value'	=> '-1',
			'label'			=> 'Font Family',
			'parent'		=> $row_page_title_styles_2
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontstyle',
			'default_value'	=> '',
			'label'			=> 'Font Style',
			'options'		=> oxides_edge_get_font_style_array(),
			'parent'		=> $row_page_title_styles_2
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontweight',
			'default_value'	=> '',
			'label'			=> 'Font Weight',
			'options'		=> oxides_edge_get_font_weight_array(),
			'parent'		=> $row_page_title_styles_2
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_letter_spacing',
			'default_value'	=> '',
			'label'			=> 'Letter Spacing',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_2
		));

		$group_page_subtitle_styles = oxides_edge_add_admin_group(array(
			'name'			=> 'group_page_subtitle_styles',
			'title'			=> 'Subtitle',
			'description'	=> 'Define styles for page subtitle',
			'parent'		=> $panel_typography
		));

		$row_page_subtitle_styles_1 = oxides_edge_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_1',
			'parent'	=> $group_page_subtitle_styles
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_subtitle_color',
			'default_value'	=> '',
			'label'			=> 'Text Color',
			'parent'		=> $row_page_subtitle_styles_1
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_fontsize',
			'default_value'	=> '',
			'label'			=> 'Font Size',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_lineheight',
			'default_value'	=> '',
			'label'			=> 'Line Height',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_texttransform',
			'default_value'	=> '',
			'label'			=> 'Text Transform',
			'options'		=> oxides_edge_get_text_transform_array(),
			'parent'		=> $row_page_subtitle_styles_1
		));

		$row_page_subtitle_styles_2 = oxides_edge_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_2',
			'parent'	=> $group_page_subtitle_styles,
			'next'		=> true
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_subtitle_google_fonts',
			'default_value'	=> '-1',
			'label'			=> 'Font Family',
			'parent'		=> $row_page_subtitle_styles_2
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_fontstyle',
			'default_value'	=> '',
			'label'			=> 'Font Style',
			'options'		=> oxides_edge_get_font_style_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_fontweight',
			'default_value'	=> '',
			'label'			=> 'Font Weight',
			'options'		=> oxides_edge_get_font_weight_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		oxides_edge_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_letter_spacing',
			'default_value'	=> '',
			'label'			=> 'Letter Spacing',
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_2
		));
	}

	add_action( 'oxides_edge_options_map', 'oxides_edge_title_options_map', 9 );

}