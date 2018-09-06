<?php

if ( ! function_exists('oxides_edge_team_options_map') ) {
	/**
	 * Add Team options to elements page
	 */
	function oxides_edge_team_options_map() {

		$panel_team = oxides_edge_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_team',
				'title' => 'Team'
			)
		);

        oxides_edge_add_admin_section_title(array(
            'name' => 'team_shortcode_on_hover_styles',
            'title' => 'Team - Main info on Hover',
            'parent' => $panel_team
        ));

            $team_shortcode_on_hover_overlay_group = oxides_edge_add_admin_group(array(
                'name' => 'team_shortcode_on_hover_group',
                'title' => 'Shader Styles',
                'description' => 'Set shader styles for team shortcode',
                'parent' => $panel_team
            ));

                $team_shortcode_on_hover_row = oxides_edge_add_admin_row(array(
                    'name' => 'team_shortcode_on_hover_row',
                    'next' => true,
                    'parent' => $team_shortcode_on_hover_overlay_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_on_hover_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_on_hover_overlay_color',
                        'default_value' => '',
                        'label'         => 'Background Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent' => $team_shortcode_on_hover_row,
                        'type' => 'textsimple',
                        'name' => 'team_shortcode_on_hover_overlay_opacity',
                        'label' => 'Transparency (0 - 1)'
                    ));

            $team_shortcode_on_hover_title_group = oxides_edge_add_admin_group(array(
                'name' => 'team_shortcode_on_hover_title_group',
                'title' => 'Title Styles',
                'description' => 'Set styles for shader on team shortcode',
                'parent' => $panel_team
            ));

                $team_shortcode_on_hover_title_row = oxides_edge_add_admin_row(array(
                    'name' => 'team_shortcode_on_hover_title_row',
                    'next' => true,
                    'parent' => $team_shortcode_on_hover_title_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_on_hover_title_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_on_hover_title_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

            $team_shortcode_on_hover_position_group = oxides_edge_add_admin_group(array(
                'name' => 'team_shortcode_on_hover_position_group',
                'title' => 'Position Styles',
                'description' => 'Set styles for position on team shortcode',
                'parent' => $panel_team
            ));

                $team_shortcode_on_hover_position_row = oxides_edge_add_admin_row(array(
                    'name' => 'team_shortcode_on_hover_position_row',
                    'next' => true,
                    'parent' => $team_shortcode_on_hover_position_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_on_hover_position_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_on_hover_position_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

            $team_shortcode_on_hover_icons_group = oxides_edge_add_admin_group(array(
                'name' => 'team_shortcode_on_hover_icons_group',
                'title' => 'Icons Styles',
                'description' => 'Set styles for icons on team shortcode',
                'parent' => $panel_team
            ));

                $team_shortcode_on_hover_icons_row = oxides_edge_add_admin_row(array(
                    'name' => 'team_shortcode_on_hover_icons_row',
                    'next' => true,
                    'parent' => $team_shortcode_on_hover_icons_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_on_hover_icons_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_on_hover_icon_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_on_hover_icons_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_on_hover_icon_background_color',
                        'default_value' => '',
                        'label'         => 'Background Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_on_hover_icons_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_on_hover_icon_hover_color',
                        'default_value' => '',
                        'label'         => 'Hover Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_on_hover_icons_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_on_hover_icon_hover_background_color',
                        'default_value' => '',
                        'label'         => 'Background Hover Color'
                    ));


        oxides_edge_add_admin_section_title(array(
            'name' => 'team_shortcode_below_image_styles',
            'title' => 'Team - Main info below image',
            'parent' => $panel_team
        ));

            $team_shortcode_below_image_title_group = oxides_edge_add_admin_group(array(
                'name' => 'team_shortcode_below_image_title_group',
                'title' => 'Title Styles',
                'description' => 'Set styles for title on team shortcode',
                'parent' => $panel_team
            ));

                $team_shortcode_below_image_title_row = oxides_edge_add_admin_row(array(
                    'name' => 'team_shortcode_below_image_title_row',
                    'next' => true,
                    'parent' => $team_shortcode_below_image_title_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_below_image_title_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_below_image_title_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

            $team_shortcode_below_image_position_group = oxides_edge_add_admin_group(array(
                'name' => 'team_shortcode_below_image_position_group',
                'title' => 'Position Styles',
                'description' => 'Set styles for position on team shortcode',
                'parent' => $panel_team
            ));

                $team_shortcode_below_image_position_row = oxides_edge_add_admin_row(array(
                    'name' => 'team_shortcode_below_image_position_row',
                    'next' => true,
                    'parent' => $team_shortcode_below_image_position_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_below_image_position_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_below_image_position_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

            $team_shortcode_below_image_icons_group = oxides_edge_add_admin_group(array(
                'name' => 'team_shortcode_below_image_icons_group',
                'title' => 'Icons Styles',
                'description' => 'Set styles for icons on team shortcode',
                'parent' => $panel_team
            ));

                $team_shortcode_below_image_icons_row = oxides_edge_add_admin_row(array(
                    'name' => 'team_shortcode_below_image_icons_row',
                    'next' => true,
                    'parent' => $team_shortcode_below_image_icons_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_below_image_icons_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_below_image_icon_color',
                        'default_value' => '',
                        'label'         => 'Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_below_image_icons_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_below_image_icon_background_color',
                        'default_value' => '',
                        'label'         => 'Background Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_below_image_icons_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_below_image_icon_hover_color',
                        'default_value' => '',
                        'label'         => 'Hover Color'
                    ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $team_shortcode_below_image_icons_row,
                        'type'          => 'colorsimple',
                        'name'          => 'team_shortcode_below_image_icon_hover_background_color',
                        'default_value' => '',
                        'label'         => 'Background Hover Color'
                    ));

	}

	add_action( 'oxides_edge_options_elements_map', 'oxides_edge_team_options_map');

}