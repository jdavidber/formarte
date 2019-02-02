<?php

/* 
 * Plugin Name: Formarte CountDown
 * Author: Formarte
 * Author URI: http://formarte.edu.co
 * Description: contador.
 * Version: 1.0.0
 */
function contador_css() {
    wp_enqueue_style( 'contador.css', plugins_url('css/styles.css', __FILE__));
   }
function contador_js() {
    wp_enqueue_script( 'contador.js', plugins_url('js/scripts.js', __FILE__));
   }
   
   add_action('wp_head', 'contador_css');
   add_action('wp_footer', 'contador_js');

//Index filtros cursos
function Contador(){
    ?>
<div class="containerCount">
  <div id="timer"></div>
</div>
<?php
}
add_shortcode('FORMARTE_CONTADOR', 'Contador');