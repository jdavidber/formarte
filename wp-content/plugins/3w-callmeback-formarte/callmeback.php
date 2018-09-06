<?php
/*
Plugin Name: Formarte Callmeback
Plugin URI: http://tresdobleu.com
Description: Custom Contact Form for Callmeback functionallity
Version: 1.0
Author: creado por Tresdobleu - www.tresdobleu.com - para Formarte
Author URI: http://tresdobleu.com
*/
function load_js_file(){
	wp_enqueue_script('callmeback.js', plugins_url('js/callmeback.js',__FILE__) );
	// wp_register_script('jmsajax', 'http://190.248.145.70/FidelityCallsYouBackWS/jMsAjax.js', false, '1');
	wp_register_script('jmsajax', 'http://www.jusan.com.es/Callmeback/jMsAjax.js', false, '1');
    wp_enqueue_script('jmsajax');
}
add_action('wp_head', 'load_js_file');

function load_css_file() {
    wp_enqueue_style( 'style.css', plugins_url('3w-callmeback-formarte/styles/style.css'));
}
add_action('wp_head', 'load_css_file');

function html_form_code($theme, $ciudad) {
?>
    <div class="callmebackTrigger" onclick="javascript:showForm();">
        <div class="frmt-titulo">
            <h3>¿TE LLAMAMOS?</h3>
        </div>
    </div>
	<div id="frmt-form" class="hideForm <?php echo $theme; ?>">
   	<div class="frmt-titulo">
   		<h3>¿TE LLAMAMOS?</h3>
   	</div>
    	<ul>
	    	<li><label for="nombre">Nombres y apellidos</label><input type="text" class="reseteable" id="frmt-nombre" name="frmt-nombre" required /> </li>
	    	<li>
                <label for="ciudad">Ciudad <?php echo $ciudad; ?></label>
                <select id="frmt-ciudad" onchange="defineIndicativo(this);">
                    <option value="4"<?php if($ciudad == "Medellin"){ ?> selected="selected"<?php } ?>>Medellín</option>
                    <option value="1"<?php if($ciudad == "Bogota"){ ?> selected="selected"<?php } ?>>Bogotá</option>
                    <option value="6"<?php if($ciudad == "Manizales"){ ?> selected="selected"<?php } ?>>Manizales</option>
                    <option value="7"<?php if($ciudad == "Bucaramanga"){ ?> selected="selected"<?php } ?>>Bucaramanga</option>
                    <option value="2"<?php if($ciudad == "Cali"){ ?> selected="selected"<?php } ?>>Cali</option>
                    <option value="5"<?php if($ciudad == "Barranquilla"){ ?> selected="selected"<?php } ?>>Barranquilla</option>
                </select>
			</li>
	    	<li><label for="celular">Celular</label><input id="frmt-celular" class="reseteable" name="frmt-celular" type="text" required /> </li>
	   		<li><label for="telefono">Teléfono</label><input id="frmt-indicativo" name="frmt-indicativo" type="number" disabled placeholder="4" value="4"> <input type="text" id="frmt-telefono" class="reseteable" name="frmt-telefono" required /> </li>
	   		<li><label for="email">E-mail</label><input type="email" id="frmt-email" class="reseteable" name="frmt-email" required> </li>
	   		<button onclick="enviarForm()"  id="frmt-btn-enviar">Enviar</button>
	   	</ul>
   </div>
<?php
}
function cf_shortcode($atts) {
    $callmebackAtts = shortcode_atts( array(
        'theme' => 'default',
        'ciudad' => 'medellin'
    ), $atts);
    ob_start();
    html_form_code($callmebackAtts['theme'],$callmebackAtts['ciudad']);
    return ob_get_clean();
}
add_shortcode( 'formarte_callmeback', 'cf_shortcode' );

?>
