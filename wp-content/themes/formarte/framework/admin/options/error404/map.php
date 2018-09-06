<?php

if ( ! function_exists('oxides_edge_error_404_options_map') ) {

	function oxides_edge_error_404_options_map() {

		oxides_edge_add_admin_page(array(
			'slug' => '__404_error_page',
			'title' => '404 Error Page',
			'icon' => 'fa fa-exclamation-triangle'
		));

		$panel_404_options = oxides_edge_add_admin_panel(array(
			'page' => '__404_error_page',
			'name'	=> 'panel_404_options',
			'title'	=> '404 Page Option'
		));

		oxides_edge_add_admin_field(array(
			'parent' => $panel_404_options,
			'type' => 'text',
			'name' => '404_title',
			'default_value' => '',
			'label' => 'Title',
			'description' => 'Enter title for 404 page'
		));

		oxides_edge_add_admin_field(array(
			'parent' => $panel_404_options,
			'type' => 'text',
			'name' => '404_text',
			'default_value' => '',
			'label' => 'Text',
			'description' => 'Enter text for 404 page'
		));

        oxides_edge_add_admin_field(array(
            'parent' => $panel_404_options,
            'type' => 'select',
            'name' => '404_skin',
            'options' => array(
                'dark' => 'Dark',
                'light' => 'Light'
            ),
            'default_value' => 'dark',
            'label' => 'Skin',
            'description' => 'Choose light/dark skin for 404 page'
        ));

        oxides_edge_add_admin_field(array(
            'parent'        => $panel_404_options,
            'name'          => '404_background_image',
            'type'          => 'image',
            'label'         => 'Background Image',
            'description'   => 'Choose an image to be displayed in background for 404 page',
        ));

		oxides_edge_add_admin_field(array(
			'parent' => $panel_404_options,
			'type' => 'text',
			'name' => '404_back_to_home',
			'default_value' => '',
			'label' => 'Back to Home Button Label',
			'description' => 'Enter label for "Back to Home" button'
		));

	}

	add_action( 'oxides_edge_options_map', 'oxides_edge_error_404_options_map', 21 );

}