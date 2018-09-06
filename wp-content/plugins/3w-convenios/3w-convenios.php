<?php
/**
* Plugin Name: Convenios Formarte
* Plugin URI: http://tresdobleu.com
* Description: Asistente para la ejecución de pre-matrículas en convenios Formarte
* Version: 1.0
* Author: Tresdobleu Estudio
* Author URI: http://tresdobleu.com
* License:
*/

//LOAD RESOURCES
function tresw_convenios_scripts() {
	wp_enqueue_script('q10Convenios', plugins_url('js/q10Convenios.min.js',__FILE__));
}
add_action('wp_enqueue_scripts', 'tresw_convenios_scripts');

//PRINT STEPS
function convenios_steps($ciudad,$programa) {
	switch ($programa) {
		case 'clases':
			$title 	= "¿YA TIENES TU COTIZACIÓN A LA MEDIDA?";
			$label = "¡Inscríbete Aquí!";
			$placeholder = "ingresa tu código";
			$button = "Deseo Inscribirme";
			break;

		case 'convenios':
			$title 	= "¿TIENES UN CONVENIO CON NOSOTROS?";
			$label = "¡Matricúlate aquí!";
			$placeholder = "ingresa tu código de convenio";
			$button = "Deseo Matricularme";
			break;

		default:
			$title 	= "¿YA TIENES TU ORDEN DE MATRÍCULA?";
			$label = "¡Inscríbete Aquí!";
			$placeholder = "ingresa tu código";
			$button = "Deseo Inscribirme";
			break;
	}
?>
    <script>
        localStorage.setItem('ciudad', '<?php echo $ciudad; ?>');
        <?php if($programa !== "DEFAULT"){ ?>
        localStorage.setItem('programa', '<?php echo $programa; ?>');
        <?php }else{ ?>
        localStorage.removeItem('programa');
        <?php } ?>
    </script>
<div id="prematriculas-container">
    <div id="box-steps" class="default-min">
			<img id="tresw-loader" src="<?php echo plugins_url('3w-prematriculas/images/loader.svg'); ?>" />
	    <h1 style="font-weight: 400;"><?php echo $title; ?></h1>
	    <p><?php echo $label; ?></p>
	    <ul id="list-steps">
					<input id="frmt-convenio-codigo" placeholder="<?php echo $placeholder; ?>" type="text" name="convenio" required>
					<a id="frmt-convenio-buscar"><?php echo $button; ?></a>
	        <div class="clear"></div>
					<p id="frmte-convenios-error"></p>
	    </ul>

	    <!-- Progress Bar -->
	    <div id="steps-bar">
	        <div id="text-progress-bar"></div>
	        <div id="steps-progress-bar">
	            <div id="progress-bar"></div>
	        </div>
	    </div>
		</div>
</div>
<!-- Tabla de Horarios -->
<div id="q10tablaHorarios">
    <p>Haz elegido estudiar: <span class="thTitulo"></span> / <span class="thPeriodo"></span> / <span class="thJornada"></span></p>
    <h2><span class="thTitulo"></span> <span class="thJornada"></span> <span class="thPeriodo"></span></h2>
    <div id="thBarraTitulo">
        <div class="valorContado">
            <h5>Valor de contado</h5>
            <span></span>
        </div>
        <div class="valorFinanciado">
            <h5>Valor financiado</h5>
            <span></span>
        </div>
        <div class="valorCuotas">
            <h5></h5>
            <span></span>
        </div>
    </div>
    <div class="frmt-tooltip"></div>
    <table>
        <thead>
            <tr>
                <th>INICIA</th>
                <th>HORARIO</th>
                <th>DESCUENTO</th>
                <th>VALOR CON DESCUENTO</th>
                <th>FINANCIADO CON DESCUENTO</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <p>Descuento válido hasta el <span class="validoHasta"></span></p>
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="clearfix"></div>
    <a class="comprar">PREINSCRÍBETE AQUÍ</a>
    <div class="clearfix"></div>
    <p>Si deseas financiar el programa haz <a href="#" target="_blank">clic aquí</a></p>
</div>




<?php
}

function frmt_convenios_shortcode($atts) {
    $callmebackAtts = shortcode_atts( array(
        'ciudad' => 'DEFAULT',
        'programa' => 'DEFAULT'
    ), $atts);
    ob_start();
    convenios_steps($callmebackAtts['ciudad'],$callmebackAtts['programa']);
    return ob_get_clean();
}
add_shortcode('formarte_convenios', 'frmt_convenios_shortcode');
