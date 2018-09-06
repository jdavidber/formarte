<?php
/**
* Plugin Name: Pre-Matrículas Formarte
* Plugin URI: http://tresdobleu.com
* Description: Asistente para la ejecución de pre-matrículas Formarte
* Version: 1.0
* Author: Tresdobleu Estudio
* Author URI: http://tresdobleu.com
* License:
*/

//LOAD RESOURCES
function tresw_prematriculas_scripts() {
	wp_enqueue_style('styles', plugins_url('css/style.css',__FILE__));
	wp_enqueue_script('q10Programas', plugins_url('js/q10Programas.min.js',__FILE__));
}
add_action('wp_enqueue_scripts', 'tresw_prematriculas_scripts');

//PRINT STEPS
function prematricula_steps($ciudad,$programa) {
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
	    <h1 style="font-weight: 400;">¿QUIERES FORMARTE CON NOSOTROS?</h1>
	    <p>Matricúlate en solo 4 pasos:</p>
	    <ul id="list-steps">
	        <li class="step  step-1  step-active">
	            <a href="javascript:showModal('q10Programas');" id="step-1">
	                <div id="figure1"></div>
	                <figure class="step-img-line"><img src="<?php echo plugins_url('3w-prematriculas/images/divisor.png'); ?>"></figure>

	                <span class="step-description">
	                    Elige el programa que deseas<br />estudiar en <?php echo $ciudad; ?>
	                </span>
	            </a>
	        </li>

	        <li class="step  step-2">
	            <a href="javascript:showModal('q10Periodos');" id="step-2">
	                <div id="figure2"></div>
	                <figure class="step-img-line"><img src="<?php echo plugins_url('3w-prematriculas/images/divisor.png'); ?>"></figure>

	                <span class="step-description">
	                    Elige un semestre<br />para tu formación
	                </span>
	            </a>
	        </li>

	        <li class="step  step-3">
	            <a href="javascript:showModal('q10Jornadas');" id="step-3">
	                <div id="figure3"></div>
	                <figure class="step-img-line"><img src="<?php echo plugins_url('3w-prematriculas/images/divisor.png'); ?>"></figure>

	                <span class="step-description">
	                    Ahora elige una jornada para estudiar
	                </span>
	            </a>
	        </li>

	        <li class="step  step-4">
	            <a href="#" id="step-4">
	                <div id="figure4"></div>
	                <span class="step-description">
	                    Para terminar,<br />elige el horario que gustes
	                </span>
	            </a>
	        </li>

	        <div class="clear"></div>
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
		<p id="tablaMobile" style="display:none">Gira tu teléfono (horizontalmente) para ver mejor la tabla.</p>
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
		<!-- <p>Si deseas financiar el programa haz <a href="#" target="_blank">clic aquí</a></p> -->
</div>


<?php
}

function frmt_prematricula_shortcode($atts) {
    $callmebackAtts = shortcode_atts( array(
        'ciudad' => 'DEFAULT',
        'programa' => 'DEFAULT'
    ), $atts);
    ob_start();
    prematricula_steps($callmebackAtts['ciudad'],$callmebackAtts['programa']);
    return ob_get_clean();
}
add_shortcode('formarte_prematricula', 'frmt_prematricula_shortcode');
