<?php
/**
* Plugin Name: Cursos Q10 Formarte
* Plugin URI: http://tresdobleu.com
* Description: Presentación de Cursos de Q10 para Formarte
* Version: 1.0
* Author: Tresdobleu Estudio
* Author URI: http://tresdobleu.com
* License:
*/

//LOAD RESOURCES
function cursos_css_file() {
    wp_enqueue_style( 'styleCursos.css', plugins_url('3w-cursos-q10/css/style.css'));
}
add_action('wp_head', 'cursos_css_file');
function cursos_js_file() {
	wp_enqueue_script('cursosq10', plugins_url('js/cursosq10.min.js',__FILE__));
}
add_action('wp_enqueue_scripts', 'cursos_js_file');
//PRINT STEPS
function filtrarCurso($ciudad,$filtro) {
  ?>
  <script>
      localStorage.setItem('ciudad', '<?php echo $ciudad; ?>');
  </script>
  <div class="vc_row wpb_row vc_row-fluid edgtf-section edgtf-content-aligment-left edgtf-grid-section">
    <div class="vc_col-sm-3">
      <div class="filtrosCursos">
        <!-- filtrar por metodologia -->
        <h1>METODOLOGÍA</h1>
        <ul class="filtrosMetodologia">
          <li><a data-filter="VIRTUAL"  data-cat="metodologia">Virtual</a></li>
          <li><a data-filter="PRESENCIAL"  data-cat="metodologia">Presencial</a></li>
        </ul>
        <!-- filtrar por programa -->
        <h1>PROGRAMA</h1>
        <ul class="filtrosPrograma">
          <?php 
          if($ciudad == "MEDELLIN"){ ?>
          <li><a data-filter="UDEA" data-cat="programa">Pre UDEA</a></li>
          <li><a data-filter="UNAL" data-cat="programa">Pre UNAL</a></li>
          <li><a data-filter="SABER" data-cat="programa">PreICFES Saber 11º</a></li>
          <li><a data-filter="MÉDICO" data-cat="programa">PreMédico</a></li>
          <li><a data-filter="INGENIERO" data-cat="programa">PreIngeniero</a></li>
          <li><a data-filter="PSICOLOGÍA" data-cat="programa">PreSicología </a></li>
          <li><a data-filter="INTEGRADO UNAL UDEA" data-cat="programa">Integrado UNAL UDEA</a></li>
          <li><a data-filter="INTEGRADO UDEA UNAL PRE SABER" data-cat="programa">Integ UNAL UDEA ICFES Saber 11º</a></li>

          <?php } if($ciudad == "EDUCACIÓN VIRTUAL"){ ?>
          <li><a data-filter="SABER" data-cat="programa">PreICFES  11º</a></li>
          <li><a data-filter="UDEA" data-cat="programa">Pre UDEA</a></li>
          <li><a data-filter="UNAL" data-cat="programa">Pre UNAL</a></li>
          <li><a data-filter="ATLÁNTICO" data-cat="programa">Atlántico</a></li>
          <li><a data-filter="CARTAGENA" data-cat="programa">Cartagena</a></li>
          <li><a data-filter="MAGDALENA" data-cat="programa">Magdalena</a></li>
          <li><a data-filter="CAUCA" data-cat="programa">Cauca</a></li>

          <?php } if($ciudad == "BOGOTA"){ ?>
          <li><a data-filter="UNAL" data-cat="programa">Pre UNAL</a></li>
          <li><a data-filter="SABER" data-cat="programa">PreICFES Saber 11º</a></li>
          <li><a data-filter="MÉDICO" data-cat="programa">PreMédico</a></li>
          <li><a data-filter="INGENIERO" data-cat="programa">PreIngeniero</a></li>
          <li><a data-filter="INTEGRADO UNAL SABER" data-cat="programa">Integrado Unal ICFES Saber 11º</a></li>

          <?php } if($ciudad == "BARRANQUILLA"){ ?>
          <li><a data-filter="ATLÁNTICO" data-cat="programa">U del Atlántico</a></li>
          <li><a data-filter="CARTAGENA" data-cat="programa">U de Cartagena</a></li>
          <li><a data-filter="SABER" data-cat="programa">PreICFES Saber 11º</a></li>
          <li><a data-filter="INTEGRADO CARTAGENA ATLÁNTICO" data-cat="programa">Integ Cartagena, Atlántico</a></li>

          <?php } if($ciudad == "BUCARAMANGA"){ ?>
          <li><a data-filter="SABER" data-cat="programa">PreICFES Saber 11º</a></li>
          <li><a data-filter="MÉDICO" data-cat="programa">PreMédico</a></li>
          <li><a data-filter="INGENIERO" data-cat="programa">PreIngeniero</a></li>

          <?php } if($ciudad == "MANIZALES"){ ?>
          <li><a data-filter="UNAL" data-cat="programa">Pre UNAL</a></li>
          <li><a data-filter="SABER" data-cat="programa">PreICFES Saber 11º</a></li>
          <li><a data-filter="MÉDICO" data-cat="programa">PreMédico</a></li>
          <li><a data-filter="INGENIERO" data-cat="programa">PreIngeniero</a></li>
          <li><a data-filter="INTEGRADO  UDEA UNAL PRE SABER" data-cat="programa">Integ UDEA UNAL ICFES Saber 11º</a></li>
          <li><a data-filter="INTEGRADO UNAL SABER" data-cat="programa">Integrado UNAL ICFES Saber 11º</a></li>

          <?php } if($ciudad == "CALI"){ ?>
          <li><a data-filter="SABER" data-cat="programa">PreICFES Saber 11º</a></li>
          <li><a data-filter="MÉDICO" data-cat="programa">PreMédico</a></li>
          <li><a data-filter="INTEGRADO UNAL SABER" data-cat="programa">Integrado UNAL ICFES Saber 11º</a></li>

          <?php } if($ciudad == "POPAYÁN"){ ?>
          <li><a data-filter="UCAUCA" data-cat="programa">Pre UCAUCA</a></li>
          <li><a data-filter="SABER" data-cat="programa">PreICFES Saber 11º</a></li>
          <li><a data-filter="INTEGRADO UCAUCA, UNAL PRE SABER" data-cat="programa">Int. UCAUCA, UNAL ICFES Saber 11º</a></li>
          <?php } ?>
        </ul>
        <?php if($ciudad !== "EDUCACIÓN VIRTUAL"){ ?>
        <!-- filtrar por semestre -->
        <h1>¿CUANDO PRESENTARÁS EL EXAMEN?</h1>
        <ul class="filtrosSemestre">
          <li><a data-filter="2018-2"  data-cat="semestre">Segundo Semestre 2018</a></li>
          <li><a data-filter="2019-1"  data-cat="semestre">Primer Semestre 2019</a></li>
          <li><a data-filter="2019-2"  data-cat="semestre">Segundo Semestre 2019</a></li>
        </ul>
        <!-- filtrar por Jornada -->
        <h1>JORNADA</h1>
        <ul class="filtrosJornada">
          <li><a data-filter="SEMANA"  data-cat="jornada">Semana</a></li>
          <li><a data-filter="FIN DE SEMANA"  data-cat="jornada">Fin de Semana</a></li>
        </ul>
        <?php } ?>
        <a data-filter="TODOS" class="ver-todos">Ver todos</a>
      </div>
    </div>
    <div class="vc_col-sm-9">
      <div id="listaCursos" class="vc_row wpb_row vc_row-fluid">
          <p class="notification"></p>
          <!-- curso -->
          <div class="frm-curso vc_col-sm-4 original" style="display: none;">
            <h1>DEMO</h1>
            <div class="frm-curso-img">
              <div class="descuento">12% <span>hasta dic 31</span></div>
              <img src="http://formarte.edu.co/medellin/wp-content/uploads/cursos/default.jpg" onerror="this.src='http://formarte.edu.co/medellin/wp-content/uploads/cursos/default.jpg';" alt="">
            </div>
            <div class="frm-curso-info">
                <p><strong>Metodología: </strong> <span class="metodologia">pendiente</span> - <span class="jornada"></span></p>
                <p><strong>Inicia:</strong> <span class="finicio">sujeto a programación</span></p>
                <p><strong>Finaliza:</strong> <span class="ffinal">sujeto a programación</span></p>
                <p><strong>Horario: </strong> <span class="horario">sujeto a programación</span></p>
                <hr>
                <p>Valor contado: <span class="valor">por confirmar</span></p>
                <h4>Con descuento: <span class="valordescuento">por confirmar</span></h4>
                <p>Valor crédito: <span class="valorfinanciado">por confirmar</span></p>
                <h4>Con descuento: <span class="creditodescuento">por confirmar</span></h4>
                <p class="valorcuotas">por confirmar</p>
            </div>
            <a class="ver-curso">VER CURSO</a>
            <a class="pre-inscribirse">PRE-INSCRIBIRSE</a>
          </div>
          <!-- termina curso -->
  </div>
  <?php
}

function cursosq10_shortcode($atts) {
    $cursosq10Atts = shortcode_atts( array(
        'ciudad' => 'DEFAULT',
        'filtro' => 'DEFAULT'
    ), $atts);
    ob_start();
    filtrarCurso($cursosq10Atts['ciudad'], $cursosq10Atts['filtro']);
    return ob_get_clean();
}
add_shortcode('formarte_cursos', 'cursosq10_shortcode');
