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

//Index filtros cursos
function Index(){
    
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.q10academico.com/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "UserName=apihorarios&Password=0c904eca8fb3&grant_type=password&aplentId=F2BD7F9A-10E2-4E1D-8F84-B8A30201F967",
  CURLOPT_HTTPHEADER => array(
    "Postman-Token: 83a87ae6-2008-420c-be51-a2fd626d283c",
    "cache-control: no-cache"
  ),
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0
));

$response = curl_exec($curl);
curl_close($curl);

$token = json_decode($response);
$accessToken = $token->access_token;
$apiUrl = 'https://www.q10academico.com/api/informacionHorarios';

$ciudad = "";
$metodologia = "";
$semestre = "";
$jornada = "";
$programa = "";
$result = true;
$busqueda = false;
if(isset($_GET['ciudad'])){
    $ciudad = $_GET['ciudad'];
    $result = false;
    $busqueda = true;
}
if(isset($_GET['metodologia'])){
    $metodologia = $_GET['metodologia'];
}
if(isset($_GET['semestre'])){
    $semestre = $_GET['semestre'];
}
if(isset($_GET['jornada'])){
    $jornada = $_GET['jornada'];
}
if(isset($_GET['programa'])){
    $programa = $_GET['programa'];

    $curl = curl_init($apiUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$accessToken]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
$json = curl_exec($curl);
$cursos = json_decode($json);

$link = array (
    'PUN' => '/preuniversitario-unal/',
    'PUN' => '/preuniversitario-unal/',
    'PUA' => '/preuniversitario-udea/',
    'PUA' => '/preuniversitario-udea/',
    'PMR' => '/pre-medico/',
    'PIR' => '/pre-ingeniero/',
    'PSB' => '/pre-saber-11/',
    'PSB' => '/pre-saber-11/',
    'INA' => '/integrado-unal-u-de-a/',
    'ITP' => '/integrado-unal-u-de-a-saber-11/',
    'CPD' => '/clases-particulares/',
    'CPF' => '/clases-particulares/',
    'INS' => '/integrado-unal-saber-11/',
    'PUC' => '/preuniversitario-u-cartagena/',
    'INS' => '/integrado-unal-u-de-a-saber-11/',
    'BSB' => '/preicfes-basic/',
    'BUA' => '/preuniversitario-udea-basic/',
    'BUN' => '/unal-basic/',
    'BCA' => '/preuniversitario-del-cauca-basic/',
    'BUC' => '/preuniversitario-cartagena-basic/',
    'BUT' => '/preuniversitario-atlantico-basic/',
    'BMG' => '/preuniversitario-magdalena-basic/',
    'PCA' => '/preuniversitario-u-del-cauca/',
    'PUT' => '/preuniversitario-u-del-atlantico/',
    'PMG' => '/preuniversitario-u-de-magdalena/',
    'SBI' => '/integrado-icfes-ingles/',
    'UAI' => '/integrado-udea-ingles/',
    'UNI' => '/integrado-unal-ingles/',
    'SUI' => '/integrado-ingles-icfes-unal/'
);
$titulo = array (
    'PUN' => 'Preuniversitario UNAL.',
    'PUA' => 'Preuniversitario U. de A.',
    'PMR' => 'Premédico.',
    'PIR' => 'Preingeniero.',
    'PSB' => 'PreICFES 11°.',
    'INA' => 'Preuniversitario integrado UNAL - U. de A.',
    'ITP' => 'Preuniversitario integrado UNAL - U. de A. - ICFES 11°.',
    'CPD' => 'Clases particulares',
    'CPF' => 'Clases particulares',
    'INS' => 'Preuniversitario integrado UNAL - ICFES 11°.',
    'PUC' => 'Preuniversitario U. de Cartagena',
    'INS' => 'Preuniversitario integrado UNAL - ICFES 11°.',
    'BSB' => 'PreICFES 11° virtual 24/7 Basic',
    'BUA' => 'Preuniversitario U. de A. virtual 24/7 Basic',
    'BUN' => 'Preuniversitario UNAL virtual 24/7 Basic',
    'BCA' => 'Preuniversitario U. del Cauca virtual 24/7 Basic',
    'BUC' => 'Preuniversitario U. de Cartagena virtual 24/7 Basic',
    'BUT' => 'Preuniversitario U. del Atlantico virtual 24/7 Basic',
    'BMG' => 'Preuniversitario U. del Magdalena virtual 24/7 Basic',
    'PCA' => 'Preuniversitario U. del Cauca virtual 24/7 Premium',
    'PUT' => 'Preuniversitario U. del Atlantico virtual 24/7 Premium',
    'PMG' => 'Preuniversitario U. del Magdalena virtual 24/7 Premium',
    'SBI' => 'Preuniversitario integrado ICFES 11° - inglés.',
    'UAI' => 'Preuniversitario integrado U. de A. - inglés.',
    'UNI' => 'Preuniversitario integrado UNAL - inglés.',
    'SUI' => 'Preuniversitario integrado ICFES 11° - UNAL - inglés.'
);
$extracto = array (
    'PUN' => 'Este programa PREUNAL te capacita para resolver el examen de admisión de la Universidad Nacional. Son 120 preguntas que se podrán resolver en 3 horas y media.',
    'PUA' => 'Este programa PreUdeA te capacita para resolver el examen de admisión de la UdeA. Son 80 preguntas que se podrán resolver en 3 horas.',
    'PMR' => 'Los aspirantes que han soñado con estudiar Medicina tendrán en este curso un acercamiento a los conceptos básicos y asignaturas relacionadas con esta profesión.',
    'PIR' => 'Los aspirantes que han soñado con estudiar una ingeniería o carreras afines, tendrán en este curso un acercamiento a los conceptos básicos y asignaturas relacionadas con esta profesión. Adicionalmente en este curso saldrás con las competencias necesarias para presentar el  proceso de admisión de las diferentes universidades que ofertan  carreras de ingeniería.',
    'PSB' => 'Este programa PREICFES te capacita para presentar las pruebas de Estado ICFES Saber 11°, la cual consta de 254 preguntas y dura 9 horas.',
    'INA' => 'Este programa te capacita para resolver tanto el examen de admisión de la Universidad Nacional como el de la Universidad de Antioquia.',
    'ITP' => 'Este programa te capacita para resolver tanto el examen de admisión de la Universidad Nacional el examen de la Universidad de Antioquia y las pruebas saber 11°.',
    'CPD' => 'Dirigida a quienes estén cursando secundaria, pregrado o necesiten prepararse para presentar exámenes de admisión para pregrado o posgrado.',
    'CPF' => 'Dirigida a quienes estén cursando secundaria, pregrado o necesiten prepararse para presentar exámenes de admisión para pregrado o posgrado.',
    'INS' => 'Este programa te capacita para resolver tanto el examen de admisión de la Universidad Nacional y las pruebas saber 11°.',
    'PUC' => 'Este Programa te capacita para resolver el examen de admisión de la Universidad de Cartagena. Son 80 preguntas que se podrán resolver en 3 horas.',
    'INS' => 'Este programa te capacita para resolver tanto el examen de admisión de la Universidad Nacional y las pruebas saber 11°.',
    'BSB' => 'Este programa PREICFES te capacita para presentar las pruebas de Estado ICFES Saber 11°, la cual consta de 254 preguntas y dura 9 horas.',
    'BUA' => 'Este programa PreUdeA te capacita para resolver el examen de admisión de la UdeA. Son 80 preguntas que se podrán resolver en 3 horas.',
    'BUN' => 'Este programa PREUNAL te capacita para resolver el examen de admisión de la Universidad Nacional. Son 120 preguntas que se podrán resolver en 3 horas y media.',
    'BCA' => 'Este Programa te capacita para resolver el examen de admisión de la Universidad del Cauca. Son 80 preguntas que se podrán resolver en 3 horas.',
    'BUC' => 'Este Programa te capacita para resolver el examen de admisión de la Universidad de Cartagena. Son 80 preguntas que se podrán resolver en 3 horas.',
    'BUT' => 'Este programa está diseñado para presentar el examen de admisión de la Universidad del Atlántico. Son 100 preguntas y tiene una duración de 3 horas.',
    'BMG' => 'Este programa está diseñado para presentar el examen de admisión de la Universidad de Magdalena. Son 100 preguntas y tiene una duración de 3 horas.',
    'PCA' => 'Este Programa te capacita para resolver el examen de admisión de la Universidad del Cauca. Son 80 preguntas que se podrán resolver en 3 horas.',
    'PUT' => 'Este programa está diseñado para presentar el examen de admisión de la Universidad del Atlántico. Son 100 preguntas y tiene una duración de 3 horas.',
    'PMG' => 'En este Virtual 24/7 Premium U. DE MAGDALENA recibe clases en vivo mañana o tarde con nuestros docentes especializados. Prepárate y conéctate con el mundo.',
    'SBI' => 'Este programa PREICFES te capacita para presentar las pruebas de Estado ICFES Saber 11°, la cual consta de 254 preguntas y dura 9 horas.',
    'UAI' => 'Este programa PreUdeA te capacita para resolver el examen de admisión de la UdeA. Son 80 preguntas que se podrán resolver en 3 horas.',
    'UNI' => 'Este programa PREUNAL te capacita para resolver el examen de admisión de la Universidad Nacional. Son 120 preguntas que se podrán resolver en 3 horas y media.',
    'SUI' => 'Este programa te capacita para resolver tanto el examen de admisión de la Universidad Nacional el examen de la Universidad de Antioquia y las pruebas saber 11°.'
);
}
    ?>
<div class='progress' id="progress_div">
    <div class='bar' id='bar1'></div>
    <div class='percent' id='percent1'></div>
  </div>
 <input type="hidden" id="progress_width" value="0">
 <div class="filtrosContainer" id="filtrosContainer" style="opacity: 0;">
        <h1>FILTRA EL PROGRAMA QUE DESEAS ESTUDIAR</h1>
        <div class="extraterrestreContainer">
            <?php
            if(!$busqueda){ 
                echo '<div class="extraterrestre"></div>'; 
            }else{
                echo '<div class="extraterrestre2"></div>';
            } ?>
            
            
        </div>
        <div class="tooltip">
            <div class="tooltiptext"></div>
        </div>
        <form class="flex-form" method="get" id="filtrosForm" name="filtros">

            <select name="metodologia" id="metodologia" class="metodologia">
                <option value="" selected>Modalidad</option>
                <option value="PRESENCIAL" required>Presencial</option>
                <option value="VIRTUAL">Virtual</option>
            </select>

            <select name="ciudad" id="ciudad" class="ciudad">
                <option value="" selected><strong>Ciudad</strong></option>
                <option value="MEDELLIN">Medellín</option>
                <option value="BOGOTA">Bogotá</option>
                <option value="BARRANQUILLA">Barranquilla</option>
                <option value="BUCARAMANGA">Bucaramanga</option>
                <option value="MANIZALES">Manizales</option>
                <option value="CALI">Cali</option>
            </select>

            <select name="programa" id="programa">
                <option value=""><strong>Programa</strong></option>                      
            </select>

            <select name="semestre" id="semestre">
                <option value="" selected><strong>¿Cuando presentarás el examen?</strong></option>
                <option value="2019-1" selected>2019- Semestre 1</option>
                <option value="2019-2" selected>2019- Semestre 2</option>
            </select>
            
            <select name="jornada" id="jornada">
                    <option value="" selected><strong>Jornada</strong></option>
                    <option value="SEMANA">Semana</option>
                    <option value="FIN DE SEMANA">Fin de semana</option>
            </select>
            <input type="submit" id="filtrosEnviar" value="BUSCAR">
        </form>
</div>

<?php
if(isset($_GET['programa'])){ 
    if($metodologia == "PRESENCIAL"){
        $ciudadLink = strtolower($ciudad);
    }else{
        $ciudadLink = strtolower($metodologia);
    }
    $url = "http://formarte.edu.co/".$ciudadLink.$link[$programa];
    $mediosDepago = "http://formarte.edu.co/".$ciudadLink."/formas-de-pago/";
    $clases = array("CPD", "CPF");
    
    $titulo = $titulo[$programa];
    if($ciudad === "MEDELLIN" && $programa === "PMR"){
        $titulo = "Premédico Pre U.de A.";
    }
    if($ciudad === "BOGOTA" && $programa === "PMR"){
        $titulo = "Premédico Pre UNAL.";
    }

    //Programas presenciales
        if($metodologia == "PRESENCIAL" && !in_array($programa, $clases))
            {
            ?>
<div class="breadcrumbs" style="opacity: 0;">
	<span id="bread0" class="breadInner"><?php echo $metodologia ?> ></span>
	<span id="bread1" class="breadInner"><?php echo $ciudad ?> ></span>
	<span id="bread2" class="breadInner"></span>
	<span id="bread3" class="breadInner"><?php echo $semestre ?> ></span>
	<span id="bread4" class="breadInner"><?php echo $jornada ?></span>
        <button id="masMenos">Ocultar Cursos <span class="dashicons dashicons-hidden"></span></button>	
</div>
<div id="listaCursos" style="opacity: 0;">
            
                <div class="preHeader wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-sm-8">
                        <h2 id="titulo"><?php echo $titulo ?></h2>
                        <p><?php echo $extracto[$programa] ?></p>
                    </div>
                    <div class="vc_col-sm-2">
                        <div class="linkVermas"><a href="<?php echo $url ?>" target="blank">VER CURSO</a></div>
                    </div>
                    <div class="vc_col-sm-2">
                        <div class="linkVermas"><a href="<?php echo $mediosDepago ?>" target="blank">FORMAS DE PAGO</a></div>
                    </div>
                </div>
    <div class="cuerpo-cursos">
            <div class="header-cursos wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-sm-3 verde">
                    <p>Horario</p>
                    </div>
                    <div class="vc_col-sm-1 verde">
                    <p>Inicia</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Descuento</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Pago de contado</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Pago crédito con descuento</p>
                    </div>
                    <div class="vc_col-sm-2 naranja">
                    <p>¿Deseas tomar el curso?</p>
                    </div>
            </div>
            <?php
            foreach($cursos as $cur)
        {
            $sede = $cur->Sede;
            $codigo = substr($cur->Programa, 1, 3);
                if($sede == $ciudad && $codigo == $programa && $cur->Periodo == $semestre && $cur->Jornada == $jornada)
                { 
                $nombre = explode(" ", $cur->Programa, 2);
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $fecha = strtotime($cur->Fecha_Inicio_Clases);
                $fechaDescuento = strtotime($cur->Fecha_Final_Pagos);
                $mesDescuento = $meses[date('m', $fechaDescuento)-1];
                $mes = $meses[date('m', $fecha)-1];
                $inicio = $mes.date(" d", $fecha);
                $horario = explode(",", $cur->Descripcion);
                $descuento = $cur->Porcentaje_Descuento;
                $finDescuento = $mesDescuento." ".date("d ", $fechaDescuento);
                $contado = number_format($cur->Valor_Contado, 0, '', '.');
                $contadoDesc = number_format($cur->Valor_Contado_Con_Descuento, 0, '', '.');
                $financiado = number_format($cur->Valor_Financiado, 0, '', '.');
                $cuotas = $cur->Numero_Cuotas;
                $valorCuota = number_format($cur->Valor_Financiado_Con_Descuento / $cuotas, 0, '', '.');
                ?>
                <div class="curso wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-md-3 vc_col-sm-12 ingroup">
                        <span class="title">Horario: </span><?php echo "<span class='info'>".$horario[0]."</span>"; ?>
                    </div>
                    <div class="vc_col-md-1 vc_col-sm-12 ingroup">
                        <span class="title">Inicia: </span><?php echo "<span class='info'>".$inicio."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup descDiv">
                        <span class="title">Descuento: </span><?php echo "<span class='info descuento'>".$descuento."%</span><br><span class='hasta'>Hasta ".strtolower($finDescuento)."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Pago de contado: </span><?php
                        if($descuento > 0)
                        {
                           echo "<span class='info contado'>$".$contado."</span>";
                           echo "<span class='info contadoDesc'>$".$contadoDesc."</span>"; 
                        }
                        else
                        {
                            echo "<span class='info contadoDesc'>$".$contado."</span>";
                        }
                        
                        ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Pago crédito con descuento: </span><?php echo "<span class='info contado'>$".$financiado."</span><span class='info'>".$cuotas." cuotas de $".$valorCuota."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <?php echo "<a href='http://formartecentral.q10academico.com/formarte/preinscripcion/".$cur->Consecutivo."' target='blank'>TOMAR CURSO</a>"; ?>
                    </div>
                </div>

                    <?php
                    $result = true;
                }
        }
        ?></div>
    <br><br><p class="finCurso">Todos los programas terminan una semana antes del examen.</p><br><br>
            </div>
            <?php
        }
        //Cusrsos virtuales
        if($metodologia == "VIRTUAL")
            {
        ?>
        <div class="breadcrumbs" style="opacity: 0;">
                <span class="pre"></span><div id="bread0" class="breadInner"><?php echo $metodologia ?> > </div><span class="pos"></span>
                <span class="pre"></span><div id="bread2" class="breadInner"></div><span class="pos"></span>
                <span class="pre"></span><div id="bread3" class="breadInner"> > <?php echo $semestre ?></div><span class="pos"></span>
                <button id="masMenos">Ocultar Cursos <span class="dashicons dashicons-hidden"></span></button>	
        </div>
        <div class="container" id="listaCursos" style="opacity: 0;">
            
            <div class="preHeader wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-sm-8">
                        <h2 id="titulo"><?php echo $titulo ?></h2>
                        <p><?php echo $extracto[$programa] ?></p>
                    </div>
                    <div class="vc_col-sm-1">
                    </div>
                    <div class="vc_col-sm-3">
                        <div class="linkVermas"><a href="<?php echo $mediosDepago ?>" target="blank">FORMAS DE PAGO</a></div>
                    </div>
                </div>
            
        <div class="cursosVirtual wpb_column vc_column_container vc_col-sm-12">
        <?php
        foreach($cursos as $cur)
        {
            $nombre = explode(" ", $cur->Programa, 2);
                $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
                $fecha = strtotime($cur->Fecha_Inicio_Clases);
                $fechaDescuento = strtotime($cur->Fecha_Final_Pagos);
                $mesDescuento = $meses[date('m', $fechaDescuento)-1];
                $mes = $meses[date('m', $fecha)-1];
                $inicio = $mes.date(" d", $fecha);
                $horario = explode(",", $cur->Descripcion);
                $descuento = $cur->Porcentaje_Descuento;
                $finDescuento = $mesDescuento." ".date("d ", $fechaDescuento);
                $contado = number_format($cur->Valor_Contado, 0, '', '.');
                $contadoDesc = number_format($cur->Valor_Contado_Con_Descuento, 0, '', '.');
                $financiado = number_format($cur->Valor_Financiado, 0, '', '.');
                $cuotas = $cur->Numero_Cuotas;
                $valorCuota = number_format($cur->Valor_Financiado_Con_Descuento / $cuotas, 0, '', '.');
                
            if($programa == 'PSB'){
                $basic = 'BSB';
                $cuarenta = '4SB';
            }
            if($programa == 'PUA'){
                $basic = 'BUA';
                $cuarenta = '4UA';
            }
            if($programa == 'PUN'){
                $basic = 'BUN';
                $cuarenta = '4UN';
            }
            if($programa == 'PCA'){
                $basic = 'BCA';
                $cuarenta = '4CA';
            }
            if($programa == 'PUC'){
                $basic = 'BUC';
                $cuarenta = '4UC';
            }
            if($programa == 'PUT'){
                $basic = 'BUT';
                $cuarenta = '4UT';
            }
            if($programa == 'PMG'){
                $basic = 'BMG';
                $cuarenta = '4MG';
            }
            $codigo = substr($cur->Programa, 1, 3);
            $urlVirtual = "http://formarte.edu.co/".$ciudadLink.$link[$codigo];
            if($cur->Sede == 'EDUCACIÓN VIRTUAL'  && ($codigo == $programa || $codigo == $basic || $codigo == $cuarenta) && $semestre == $cur->Periodo)
            {
                $nombre = explode(" ", $cur->Programa, 2);
                $desc = explode("+",$cur->Descripcion);
                $finalizaVirtual = explode(",", $desc[count($desc)-1]);
                
                if($codigo == $basic)
                { ?>
                    <div class="pricing-plan basic">
                        <div class="nodestacado" style="opacity: 0;"></div>
                        <div class="containerContenido">
                        <div class="contenidoVirtual">
                            <h3>Basic</h3>
                            <p>Podrás estudiar a tu ritmo y desde cualquier lugar con clases grabadas.</p>
                            <span><strong>Fecha de inicio:</strong> <?php echo $inicio; ?></span>
                        </div>
                        <div class="contenidoVirtual">
                            <ul class="pricing-features">
                                <li>Plataforma virtual.</li>
                                <li>3 simulacros durante el curso.</li>
                                <li>Acompañamiento por un agente.</li>
                                <li>Plan de estudio.</li>
                            </ul>
                        </div>
                            </div>
                        <div class="contenidoVirtual descuentoVirtual">
                            Descuento<span> <?php echo $cur->Porcentaje_Descuento. "%"; ?></span> hasta <?php echo $finDescuento; ?>
                        </div>
                        <div class="precios">
                        <div class="contenidoVirtual contadoVirtual">
                            Pago de contado<br>
                            <span class="antes"><?php echo "$".number_format($cur->Valor_Contado, 0, '', '.'); ?></span><br>
                            <span class="ahora"><?php echo "$".number_format($cur->Valor_Contado_Con_Descuento, 0, '', '.'); ?></span>
                        </div>
                        </div>
                        <div class="contenidoVirtual botones">
                            <div class="verCurso"><a href="<?php echo $urlVirtual ?>" target="blank">VER CURSO</a></div>
                            <div class="tomarCurso"><a href="http://formartecentral.q10academico.com/formarte/preinscripcion/<?php echo $cur->Consecutivo; ?>" target="blank">TOMAR CURSO</a></div>
                        </div>
                    </div>
                <?php }
                if($codigo == '4SB')
                { ?>
                    <div class="pricing-plan cuarenta">
                    <div class="nodestacado" style="opacity: 0;"></div>
                        <div class="containerContenido">
                        <div class="contenidoVirtual">
                            <h3>40 Horas</h3>
                            <p>Podrás estudiar a tu ritmo y desde cualquier lugar con clases grabadas.</p>
                            <span><strong>Fecha de inicio:</strong> <?php echo $inicio; ?></span>
                        </div>
                        <div class="contenidoVirtual">
                            <ul class="pricing-features">
                                <li style="font-size: 1.2em;">CLASES EN VIVO</li>
                                <li>3 simulacros durante el curso.</li>
                                <li>Acompañamiento por un agente.</li>
                                <li>Foros interactivos con docentes.</li>
                            </ul>
                        </div>
                            </div>
                        <div class="contenidoVirtual descuentoVirtual">
                            Descuento<span> <?php echo $cur->Porcentaje_Descuento. "%"; ?></span> hasta <?php echo $finDescuento; ?>
                        </div>
                        <div class="precios">
                        <div class="contenidoVirtual contadoVirtual">
                            Pago de contado<br>
                            <span class="antes"><?php echo "$".number_format($cur->Valor_Contado, 0, '', '.'); ?></span><br>
                            <span class="ahora"><?php echo "$".number_format($cur->Valor_Contado_Con_Descuento, 0, '', '.'); ?></span>
                        </div>
                        </div>
                        <div class="contenidoVirtual botones">
                            <div class="verCurso"><a href="<?php echo $urlVirtual ?>" target="blank">VER CURSO</a></div>
                            <div class="tomarCurso"><a href="http://formartecentral.q10academico.com/formarte/preinscripcion/<?php echo $cur->Consecutivo; ?>" target="blank">TOMAR CURSO</a></div>
                        </div>
                    </div>
               <?php }
                if($codigo == $programa)
                { ?>
                    <div class="pricing-plan premium">
                        <div class="destacado">
                            <div id="circle1"></div>
                            <div id="star1"></div>
                            <div id="star2"></div>
                            <div id="star3"></div>
                            <div id="star4"></div>
                            <div id="star5"></div>
                            <div id="star6"></div>
                        </div>
                        <div class="containerContenido">
                        <div class="contenidoVirtual">
                            <h3>Premium</h3>
                            <p>Estudiaras a tu ritmo y contaras con acompañamiento de un súper agente Formarte.</p>
                            <span><strong>Fecha de inicio:</strong> <?php echo $inicio; ?></span>
                        </div>
                        <div class="contenidoVirtual">
                            <ul class="pricing-features">
                                <li style="font-size: 1.2em;">CLASES EN VIVO</li>
                                <li>Plataforma virtual.</li>
                                <li>1 simulacro semanal.</li>
                                <li>Acompañamiento por un agente.</li>
                                <li>Plan de estudio.</li>
                                <li>Orientación profesional.</li>
                                <li>Taller manejo ansiedad y estrés.</li>
                                <li>Foros interactivos con docentes.</li>
                            </ul>
                        </div>
                            </div>
                        <div class="contenidoVirtual descuentoVirtual">
                            Descuento<span> <?php echo $cur->Porcentaje_Descuento. "%"; ?></span> hasta <?php echo $finDescuento; ?>
                        </div>
                        <div class="precios">
                        <div class="contenidoVirtual contadoVirtual">
                            Pago de contado<br>
                            <span class="antes"><?php echo "$".$contado; ?></span><br>
                            <span class="ahora"><?php echo "$".$contadoDesc; ?></span>
                        </div>
                        <hr>
                        <div class="contenidoVirtual contadoVirtual">
                            Pago Crédito con descuento<br>
                            <span class="ahora"><span class='info contado'><?php echo "$".$financiado."<br>"; ?></span><?php echo $cuotas." cuotas de $".$valorCuota; ?></span>
                        </div>
                        </div>
                        <div class="contenidoVirtual botones">
                            <div class="verCurso"><a href="<?php echo $urlVirtual ?>" target="blank">VER CURSO</a></div>
                            <div class="tomarCurso"><a href="http://formartecentral.q10academico.com/formarte/preinscripcion/<?php echo $cur->Consecutivo; ?>" target="blank">TOMAR CURSO</a></div>
                        </div>
                    </div>
               <?php }
                $result = true;
            }
        } ?>
            
        </div>
            <br><br><p class="finCurso">Todos los programas terminan una semana antes del examen.</p><br><br>
        </div>
            <?php
    }
    //Clases particulares
        if(in_array($programa, $clases))
        {
               ?>
<div class="breadcrumbs" style="opacity: 0;">
	<span id="bread0" class="breadInner"><?php echo $metodologia ?> ></span>
	<span id="bread1" class="breadInner"><?php echo $ciudad ?> ></span>
	<span id="bread2" class="breadInner"></span>
        <button id="masMenos">Ocultar Cursos <span class="dashicons dashicons-hidden"></span></button>	
</div>
<div id="listaCursos" style="opacity: 0;">
            
                <div class="preHeader wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-sm-8">
                        <h2 id="titulo"><?php echo $titulo ?></h2>
                        <p><?php echo $extracto[$programa] ?></p>
                    </div>
                    <div class="vc_col-sm-2">
                        <div class="linkVermas"><a href="<?php echo $url ?>" target="blank">VER CURSO</a></div>
                    </div>
                    <div class="vc_col-sm-2">
                        <div class="linkVermas"><a href="<?php echo $mediosDepago ?>" target="blank">FORMAS DE PAGO</a></div>
                    </div>
                </div>
    <div class="cuerpo-cursos">
            <div class="header-cursos wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-sm-2 verde">
                    <p>Horario</p>
                    </div>
                    <div class="vc_col-sm-2 verde">
                    <p>Inicia</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Descuento</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Pago de contado</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Pago crédito con descuento</p>
                    </div>
                    <div class="vc_col-sm-2 naranja">
                    <p>¿Deseas tomar el curso?</p>
                    </div>
            </div>
            <?php
            foreach($cursos as $cur)
        {
            $sede = $cur->Sede;
            $codigo = substr($cur->Programa, 1, 3);
                if(($codigo == $programa || $codigo === "CPD") && $sede == $ciudad)
                { 
                $nombre = explode(" ", $cur->Programa, 2);
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $fecha = strtotime($cur->Fecha_Inicio_Clases);
                $fechaDescuento = strtotime($cur->Fecha_Final_Pagos);
                $mesDescuento = $meses[date('m', $fechaDescuento)-1];
                $mes = $meses[date('m', $fecha)-1];
                $inicio = $mes.date(" d", $fecha);
                $horario = explode(",", $cur->Descripcion);
                $descuento = $cur->Porcentaje_Descuento;
                $finDescuento = $mesDescuento." ".date("d ", $fechaDescuento);
                $contado = number_format($cur->Valor_Contado, 0, '', '.');
                $contadoDesc = number_format($cur->Valor_Contado_Con_Descuento, 0, '', '.');
                $financiado = number_format($cur->Valor_Financiado, 0, '', '.');
                $cuotas = $cur->Numero_Cuotas;
                $valorCuota = number_format($cur->Valor_Financiado_Con_Descuento / $cuotas, 0, '', '.');
                ?>
                <div class="curso wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Descripción: </span><?php echo "<span class='info'>".$nombre[1]."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Horario: </span><?php echo "<span class='info'>".$cur->Descripcion."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup descDiv">
                        <span class="title">Descuento: </span><?php echo "<span class='info descuento'>".$descuento."%</span><br><span class='hasta'>Hasta ".strtolower($finDescuento)."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Pago de contado: </span><?php
                        if($descuento > 0)
                        {
                           echo "<span class='info contado'>$".$contado."</span>";
                           echo "<span class='info contadoDesc'>$".$contadoDesc."</span>"; 
                        }
                        else
                        {
                            echo "<span class='info contadoDesc'>$".$contado."</span>";
                        }
                        
                        ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Pago crédito con descuento: </span>
                            <?php
                        if($descuento > 0)
                        {
                           echo "<span class='info'>".$cuotas." cuotas de $".$contadoDesc."</span>";
                        }
                        else
                        {
                            echo "<span class='info'>".$cuotas." cuotas de $".$contado."</span>";
                        }
                        
                        ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <?php echo "<a href='http://formartecentral.q10academico.com/formarte/preinscripcion/".$cur->Consecutivo."' target='blank'>TOMAR CURSO</a>"; ?>
                    </div>
                </div>

                    <?php
                    $result = true;
                }
        }
        ?>
            
        </div>
            <br><br><p class="finCurso">Todos los programas terminan una semana antes del examen.</p><br><br>
        </div>
            <?php
        }
        if(!$result)
        {
            echo "<div class='noResults'>";
            echo "<h2>no hay resultados</h2>";
            echo "</div>";
        }
}
}

//Shortcode filtros
add_shortcode('FORMARTE_CURSOS_ACTUAL', 'Index');

//Cursos dentro de la info del programa
function innerCourses($ciudad, $programa){
    ?><form method="post" action="#listaCursos">
    <input type="submit" id="tomarCurso"  value="DESEO TOMAR EL CURSO" class="edgtf-btn edgtf-btn-large edgtf-btn-outline edgtf-btn-custom-hover-bg frmt-boton" style="cursor: pointer; display: none;">
	</form>

<?php
    $curlToken = curl_init();

    curl_setopt_array($curlToken, array(
      CURLOPT_URL => "https://www.q10academico.com/token",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "UserName=apihorarios&Password=0c904eca8fb3&grant_type=password&aplentId=F2BD7F9A-10E2-4E1D-8F84-B8A30201F967",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded",
        "Postman-Token: d696d6e3-961f-4c20-af69-3a6486b3db91",
        "cache-control: no-cache"
      ),
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0
    ));

    $response = curl_exec($curlToken);

    $token = json_decode($response);
    $accessToken = $token->access_token;
    $apiUrl = 'https://www.q10academico.com/api/informacionHorarios';

    $result = true;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
?>
<div class="botonMasMenos"><button id="masMenos">Ocultar Cursos <span class="dashicons dashicons-hidden"></span></button></div>
<div class='progress' id="progress_div">
    <div class='bar' id='bar1'></div>
    <div class='percent' id='percent1'></div>
  </div>
 <input type="hidden" id="progress_width" value="0">
    <div id="listaCursos" style="opacity: 0;">
    <?php
        $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$accessToken]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $json = curl_exec($curl);
    $cursos = json_decode($json);
    $link = array (
        'PUN' => '/preuniversitario-unal/',
        'PUN' => '/preuniversitario-unal/',
        'PUA' => '/preuniversitario-udea/',
        'PUA' => '/preuniversitario-udea/',
        'PMR' => '/pre-medico/',
        'PIR' => '/pre-ingeniero/',
        'PSB' => '/pre-saber-11/',
        'PSB' => '/pre-saber-11/',
        'INA' => '/integrado-unal-u-de-a/',
        'ITP' => '/integrado-unal-u-de-a-saber-11/',
        'CPD' => '/clases-particulares/',
        'CPF' => '/clases-particulares/',
        'INS' => '/integrado-unal-saber-11/',
        'PUC' => '/preuniversitario-u-cartagena/',
        'INS' => '/integrado-unal-u-de-a-saber-11/',
        'BSB' => '/preicfes-basic/',
        'BUA' => '/preuniversitario-udea-basic/',
        'BUN' => '/unal-basic/',
        'BCA' => '/preuniversitario-del-cauca-basic/',
        'BUC' => '/preuniversitario-cartagena-basic/',
        'BUT' => '/preuniversitario-atlantico-basic/',
        'BMG' => '/preuniversitario-magdalena-basic/',
        'PCA' => '/preuniversitario-u-del-cauca/',
        'PUT' => '/preuniversitario-u-del-atlantico/',
        'PMG' => '/preuniversitario-u-de-magdalena/',
        'SBI' => '/integrado-icfes-ingles/',
        'UAI' => '/integrado-udea-ingles/',
        'UNI' => '/integrado-unal-ingles/'
    );
    
    if($ciudad != "VIRTUAL")
    {
        ?>
        <div class="cuerpo-cursos">
            <div class="header-cursos wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-sm-3 verde">
                    <p>Horario</p>
                    </div>
                    <div class="vc_col-sm-1 verde">
                    <p>Inicia</p>
                    </div>
                
                
                    <div class="vc_col-sm-2 purpura">
                    <p>Descuento</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Pago de contado</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Pago crédito con descuento</p>
                    </div>
                
                    <div class="vc_col-sm-2 naranja">
                    <p>¿Deseas tomar el curso?</p>
                    </div>
                
            </div>
            <?php
        foreach ($cursos as $cur) {
            $codigo = substr($cur->Programa, 1, 3);
            if ($codigo === $programa && $ciudad === $cur->Sede)
            {
                $nombre = explode(" ", $cur->Programa, 2);
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $fecha = strtotime($cur->Fecha_Inicio_Clases);
                $fechaDescuento = strtotime($cur->Fecha_Final_Pagos);
                $mesDescuento = $meses[date('m', $fechaDescuento)-1];
                $mes = $meses[date('m', $fecha)-1];
                $inicio = $mes.date(" d", $fecha);
                $horario = explode(",", $cur->Descripcion);
                $descuento = $cur->Porcentaje_Descuento;
                $finDescuento = $mesDescuento." ".date("d ", $fechaDescuento);
                $contado = number_format($cur->Valor_Contado, 0, '', '.');
                $contadoDesc = number_format($cur->Valor_Contado_Con_Descuento, 0, '', '.');
                $financiado = number_format($cur->Valor_Financiado, 0, '', '.');
                $cuotas = $cur->Numero_Cuotas;
                $valorCuota = number_format($cur->Valor_Financiado_Con_Descuento / $cuotas, 0, '', '.');
                ?>
                <div class="curso wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-md-3 vc_col-sm-12 ingroup">
                        <span class="title">Horario: </span><?php echo "<span class='info'>".$horario[0]."</span>"; ?>
                    </div>
                    <div class="vc_col-md-1 vc_col-sm-12 ingroup">
                        <span class="title">Inicia: </span><?php echo "<span class='info'>".$inicio."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup descDiv">
                        <span class="title">Descuento: </span><?php echo "<span class='info descuento'>".$descuento."%</span><br><span class='hasta'>Hasta ".strtolower($finDescuento)."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Pago de contado: </span><?php
                        if($descuento > 0)
                        {
                           echo "<span class='info contado'>$".$contado."</span>";
                           echo "<span class='info contadoDesc'>$".$contadoDesc."</span>"; 
                        }
                        else
                        {
                            echo "<span class='info contado'>$".$financiado."</span><span class='info contadoDesc'>$".$contado."</span>";
                        }
                        
                        ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Pago crédito con descuento: </span><?php echo "<span class='info'>".$cuotas." cuotas de $".$valorCuota."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <?php echo "<a href='http://formartecentral.q10academico.com/formarte/preinscripcion/".$cur->Consecutivo."' target='blank'>TOMAR CURSO</a>"; ?>
                    </div>
                </div>

                    <?php
                $result = true;
            }
        }
        ?>
            </div>
                <br><br><p class="finCurso">Todos los programas terminan una semana antes del examen.</p><br><br>
        <?php
    }else{
        ?>
        <div class="cuerpo-cursos">
            <div class="header-cursos wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-sm-3 verde">
                    <p>Curso</p>
                    </div>
                    <div class="vc_col-sm-1 verde">
                    <p>Inicia</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Descuento</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Pago de contado</p>
                    </div>
                    <div class="vc_col-sm-2 purpura">
                    <p>Pago crédito con descuento</p>
                    </div>
                    <div class="vc_col-sm-2 naranja">
                    <p>¿Deseas tomar el curso?</p>
                    </div>
            </div>
            <?php
        foreach ($cursos as $cur) {
            $codigo = substr($cur->Programa, 1, 3);
            if ($codigo === $programa && $ciudad === $cur->Jornada)
            {
                $nombre = explode(" ", $cur->Programa, 2);
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $fecha = strtotime($cur->Fecha_Inicio_Clases);
                $fechaDescuento = strtotime($cur->Fecha_Final_Pagos);
                $mesDescuento = $meses[date('m', $fechaDescuento)-1];
                $mes = $meses[date('m', $fecha)-1];
                $inicio = $mes.date(" d", $fecha);
                $horario = explode(",", $cur->Descripcion);
                $descuento = $cur->Porcentaje_Descuento;
                $finDescuento = $mesDescuento." ".date("d ", $fechaDescuento);
                $contado = number_format($cur->Valor_Contado, 0, '', '.');
                $contadoDesc = number_format($cur->Valor_Contado_Con_Descuento, 0, '', '.');
                $financiado = number_format($cur->Valor_Financiado, 0, '', '.');
                $cuotas = $cur->Numero_Cuotas;
                $valorCuota = number_format($cur->Valor_Financiado_Con_Descuento / $cuotas, 0, '', '.');
                ?>
                <div class="curso wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_col-md-3 vc_col-sm-12 ingroup">
                        <span class="title">Horario: </span><?php echo "<span class='info'>".$nombre[1]."</span>"; ?>
                    </div>
                    <div class="vc_col-md-1 vc_col-sm-12 ingroup">
                        <span class="title">Inicia: </span><?php echo "<span class='info'>".$inicio."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup descDiv">
                        <span class="title">Descuento: </span><?php echo "<span class='info descuento'>".$descuento."%</span><br><span class='hasta'>Hasta ".strtolower($finDescuento)."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Pago de contado: </span><?php
                        if($descuento > 0)
                        {
                           echo "<span class='info contado'>$".$contado."</span>";
                           echo "<span class='info contadoDesc'>$".$contadoDesc."</span>"; 
                        }
                        else
                        {
                            echo "<span class='info contadoDesc'>$".$contado."</span>";
                        }
                        
                        ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <span class="title">Pago crédito con descuento: </span><?php echo "<span class='info contado'>$".$financiado."</span><span class='info'>".$cuotas." cuotas de $".$valorCuota."</span>"; ?>
                    </div>
                    <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                        <?php echo "<a href='http://formartecentral.q10academico.com/formarte/preinscripcion/".$cur->Consecutivo."' target='blank'>TOMAR CURSO</a>"; ?>
                    </div>
                </div>

                    <?php
                $result = true;
            }
    }
    ?>
            </div>
                <br><br><p class="finCurso">Todos los programas terminan una semana antes del examen.</p><br><br>
        <?php
    }
    if(!$result)
        {
            echo "<div class='cuerpo-cursos'>";
            echo "<p>no hay resultados</p>";
            echo "</div>";
        }
    }
   ?>
    </div>
    <?php
}

//shotcode cursos dentro de info
function inCourseShortcode($atts) {
    $atts = shortcode_atts( array(
        'ciudad' => 'DEFAULT',
        'programa' => 'DEFAULT'
    ), $atts);
    ob_start();
    innerCourses($atts['ciudad'], $atts['programa']);
    return ob_get_clean();
}
add_shortcode('FORMARTE_INCOURSE', 'inCourseShortcode');