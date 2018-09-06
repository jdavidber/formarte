<?php

if ( ! function_exists('oxides_edge_social_share_options_map') ) {
	/**
	 * Add Social Share options to elements page
	 */
	function oxides_edge_social_share_options_map() {

		$panel_social_share = oxides_edge_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_social_share',
				'title' => 'Social Share'
			)
		);

		oxides_edge_add_admin_section_title(array(
            'name' => 'pricing_table_color_section_styles',
            'title' => 'Social Share Typography',			
            'parent' => $panel_social_share
        ));

            $social_share_icon_group = oxides_edge_add_admin_group(array(
                'name' => 'social_share_icon_group',
                'title' => 'Icon Styles',
                'description' => 'Set icon styles for social share',
                'parent' => $panel_social_share
            ));

                $social_share_icon_row = oxides_edge_add_admin_row(array(
                    'name' => 'social_share_icon_row',
                    'next' => true,
                    'parent' => $social_share_icon_group
                ));

                	oxides_edge_add_admin_field(array(
                        'parent'        => $social_share_icon_row,
                        'type'          => 'colorsimple',
                        'name'          => 'social_share_icon_color',
                        'default_value' => '',
                        'label'         => 'Icon Color'
                    ));
                	oxides_edge_add_admin_field(array(
                        'parent'        => $social_share_icon_row,
                        'type'          => 'colorsimple',
                        'name'          => 'social_share_icon_hover_color',
                        'default_value' => '',
                        'label'         => 'Icon Hover Color'
                    ));            
                    oxides_edge_add_admin_field(array(
                        'parent'        => $social_share_icon_row,
                        'type'          => 'textsimple',
                        'name'          => 'social_share_icon_font_size',
                        'default_value' => '',
                        'label'         => 'Icon Size',
                        'args'          => array(
                            'suffix' => 'px'
                        )
                    ));

            $social_share_dropdown_title_group = oxides_edge_add_admin_group(array(
                'name' => 'social_share_dropdown_title_group',
                'title' => 'DropDown Styles',
                'description' => 'Set title styles for social share dropdown',
                'parent' => $panel_social_share
            ));

                $social_share_dropdown_title_row = oxides_edge_add_admin_row(array(
                    'name' => 'social_share_dropdown_title_row',
                    'next' => true,
                    'parent' => $social_share_dropdown_title_group
                ));

                    oxides_edge_add_admin_field(array(
                        'parent'        => $social_share_dropdown_title_row,
                        'type'          => 'colorsimple',
                        'name'          => 'social_share_dropdown_title_color',
                        'default_value' => '',
                        'label'         => 'Title Color'
                    ));
                    oxides_edge_add_admin_field(array(
                        'parent'        => $social_share_dropdown_title_row,
                        'type'          => 'colorsimple',
                        'name'          => 'social_share_dropdown_title_hover_color',
                        'default_value' => '',
                        'label'         => 'Title Hover Color'
                    ));            
                    oxides_edge_add_admin_field(array(
                        'parent'        => $social_share_dropdown_title_row,
                        'type'          => 'textsimple',
                        'name'          => 'social_share_dropdown_title_font_size',
                        'default_value' => '',
                        'label'         => 'Title Text Size',
                        'args'          => array(
                            'suffix' => 'px'
                        )
                    ));        

	}

	add_action( 'oxides_edge_options_elements_map', 'oxides_edge_social_share_options_map');
}