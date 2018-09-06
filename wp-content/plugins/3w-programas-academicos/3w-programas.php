<?php
/**
* Plugin Name: Programas Académicos Tresdobleu
* Plugin URI: http://tresdobleu.com
* Description: This plugin allows the user to create custom Academic Programs
* Version: 1.0
* Author: Tresdobleu Estudio
* Author URI: http://tresdobleu.com
* License:
*/


// Register the Custom Music Review Post Type

function register_3w_programas_academicos() {

    $labels = array(
        'name' => _x( 'Programa Académico', 'music_review' ),
        'singular_name' => _x( 'Programa', 'music_review' ),
        'add_new' => _x( 'Agregar Nuevo', 'music_review' ),
        'add_new_item' => _x( 'Agregar Nuevo Programa Académico', 'music_review' ),
        'edit_item' => _x( 'Editar Programa', 'music_review' ),
        'new_item' => _x( 'Nuevo Programa', 'music_review' ),
        'view_item' => _x( 'Ver Programa', 'music_review' ),
        'search_items' => _x( 'Buscar Programa', 'music_review' ),
        'not_found' => _x( 'No se encontraron programas', 'music_review' ),
        'not_found_in_trash' => _x( 'No se encontraron programas en la papelera', 'music_review' ),
        'parent_item_colon' => _x( 'Programa Superior:', 'music_review' ),
        'menu_name' => _x( 'Programas', 'music_review' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Programas',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' ),
        'taxonomies' => array( 'departamento' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'rewrite' => array(
            'slug'       => 'programas'
        ),
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'page'
    );

    register_post_type('programa', $args);
}

add_action('init', 'register_3w_programas_academicos');

function departamento_taxonomy() {
    register_taxonomy(
        'departamento',
        'programas',
        array(
            'hierarchical' => true,
            'label' => 'Departamento',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'departamento',
                'with_front' => false
            )
        )
    );
}
add_action( 'init', 'departamento_taxonomy');

// Function used to automatically create Music Reviews page.
function create_programas_academicos_pages()
  {
   //post status and options
    $post = array(
          'ping_status' =>  'closed' ,
          'post_date' => date('Y-m-d H:i:s'),
          'post_name' => 'programa_academico',
          'post_status' => 'publish' ,
          'post_title' => 'Programas Académicos',
          'post_type' => 'page',
    );
    //insert page and save the id
    $newvalue = wp_insert_post($post, false);
    //save the id in the database
    update_option('papage', $newvalue);
  }

// Activates function if plugin is activated
register_activation_hook( __FILE__, 'create_programas_academicos_pages');
