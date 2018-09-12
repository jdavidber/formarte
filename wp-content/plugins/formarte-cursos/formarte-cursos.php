<?php

/* 
 * Plugin Name: Cursos Formarte
 * Author: Formarte
 * Author URI: http://formarte.edu.co
 * Description: Carga de la oferta desde Q10 con filtros "aerolinea".
 * Version: 1.0.0
 */
function cursos_nuevo_css() {
    wp_enqueue_style( 'filtrosNuevoStyles.css', plugins_url('css/styles.css', __FILE__));
   }
function cursos_nuevo_js() {
    wp_enqueue_script( 'filtrosNuevoScripts.js', plugins_url('js/scripts.js', __FILE__));
   }
   
   add_action('wp_head', 'cursos_nuevo_css');
   add_action('wp_footer', 'cursos_nuevo_js');

//Index
function Index(){
    require_once plugins_url('php/form.php', __FILE__);
}

add_shortcode('FORMARTE_CURSOS_ACTUAL', 'Index');