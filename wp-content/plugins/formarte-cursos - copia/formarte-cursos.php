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
));

$response = curl_exec($curlToken);

$token = json_decode($response);
$accessToken = $token->access_token;
$apiUrl = 'https://www.q10academico.com/api/informacionHorarios';

$ciudad = "";
$metodologia = "";
$semestre = "";
$jornada = "";
$programa = "";
$result = true;
if(isset($_GET['ciudad'])){
    $ciudad = $_GET['ciudad'];
    $result = false;
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
}
    ?>
    <div class="filtrosContainer">
    <form class="flex-form" method="get">

                    <select name="metodologia" id="metodologia" class="metodologia">
                        <option value="none" selected>Metodología</option>
                        <option value="PRESENCIAL" required>Presencial</option>
                        <option value="VIRTUAL">Virtual</option>
                    </select>
                    

                    <select name="ciudad" id="ciudad" class="ciudad">
                        <option value="none" selected>Ciudad</option>
                        <option value="MEDELLIN" required>Medellín</option>
                        <option value="BOGOTA">Bogotá</option>
                        <option value="BARRANQUILLA">Barranquilla</option>
                        <option value="BUCARAMANGA">Bucaramanga</option>
                        <option value="MANIZALES">Manizales</option>
                        <option value="CALI">Cali</option>
                    </select>

                    <select name="programa" id="programa">
                    <option value="none">Programa</option>                      
                    </select>

                <select name="semestre" id="semestre">
                    <option value="none" selected>¿Cuando presentarás el examen?</option>
                    <option value="2019-1" selected>2019-1</option>
                    <option value="2019-2" selected>2019-2</option>
                    </select>

                <select name="jornada" id="jornada">
                        <option value="none" selected>Jornada</option>
                        <option value="SEMANA">Semana</option>
                        <option value="FIN DE SEMANA">Fin de semana</option>
                    </select>
                <input type="submit" value="Filtra tu programa">
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
    $clases = array("CPD", "CPF");
        if($metodologia == "PRESENCIAL")
        {
            ?>
<div class="breadcrumbs">
	<span class="pre"></span><div id="bread0" class="breadInner"><?php echo $metodologia ?></div><span class="pos"></span>
	<span class="pre"></span><div id="bread1" class="breadInner"><?php echo $ciudad ?></div><span class="pos"></span>
	<span class="pre"></span><div id="bread2" class="breadInner"></div><span class="pos"></span>
	<span class="pre"></span><div id="bread3" class="breadInner"><?php echo $semestre ?></div><span class="pos"></span>
	<span class="pre"></span><div id="bread4" class="breadInner"><?php echo $jornada ?></div><span class="pos"></span>
	<div class="linkVermas"><a href="<?php echo $url ?>" target="blank">Información</a></div>
</div>

            <div class="cuerpo-cursos">
            <div class="header-cursos wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_col-sm-2">
                <p>Programa</p>
                </div>
                <div class="vc_col-sm-2">
                <p>Fecha de inicio</p>
                </div>
                <div class="vc_col-sm-2">
                <p>Horario</p>
                </div>
                <div class="vc_col-sm-2">
                <p>Precio contado</p>
                </div>
                <div class="vc_col-sm-2">
                <p>Precio financiado</p>
                </div>
                
            </div>
            <?php
            foreach($cursos as $cur)
        {
            $sede = $cur->Sede;
            $codigo = substr($cur->Programa, 1, 3);
            //Clases particulares
            if(in_array($codigo, $clases))
            {
                if($sede == $ciudad)
                {
                    if($codigo == $programa)
                    {
                        $nombre = explode(" ", $cur->Programa, 2);
                        echo $nombre[1]." $".number_format($cur->Valor_Contado, 0, '', '.')."<br>";
                        $result = true;
                    }
                }
            }
            else
            {
                //Programas presenciales
                if($sede == $ciudad)
                {
                    if($codigo == $programa && $cur->Periodo == $semestre && $cur->Jornada == $jornada)
                    { 
                    $nombre = explode(" ", $cur->Programa, 2);
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $fecha = strtotime($cur->Fecha_Inicio_Clases);
                    $mes = $meses[date('m', $fecha)-1];
                    $inicio = date("d ", $fecha)."de ".$mes." del ".date("Y", $fecha);
                    $horario = explode(",", $cur->Descripcion);
                    ?>
                    <div class="curso wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                            <span class="title">Programa: </span><?php echo "<span class='info'>".$nombre[1]."</span>"; ?>
                        </div>
                        <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                            <span class="title">Fecha de inicio: </span><?php echo "<span class='info'>".$inicio."</span>"; ?>
                        </div>
                        <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                            <span class="title">Horario: </span><?php echo "<span class='info'>".$horario[0]."</span>"; ?>
                        </div>
                        <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                            <span class="title">Valor de contado: </span><?php echo "<span class='info'>$".number_format($cur->Valor_Contado, 0, '', '.')."</span>"; ?>
                        </div>
                        <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                            <span class="title">Valor a credito: </span><?php echo "<span class='info'>$".number_format($cur->Valor_Financiado, 0, '', '.')."</span>"; ?>
                        </div>
                        <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                            <?php echo "<a href='http://formartecentral.q10academico.com/formarte/preinscripcion/".$cur->Consecutivo."' target='blank'>Preinscribirme</a>"; ?>
                        </div>
                    </div>
                    
                        <?php
                        $result = true;
                    }
                }
            }
        }
        ?>
            </div>
            <?php
        }elseif($metodologia == "VIRTUAL"){
        //Cusrsos virtuales
        ?>
        <div class="breadcrumbs">
                <span class="pre"></span><div id="bread0" class="breadInner"><?php echo $metodologia ?></div><span class="pos"></span>
                <span class="pre"></span><div id="bread2" class="breadInner"></div><span class="pos"></span>
                <span class="pre"></span><div id="bread3" class="breadInner"><?php echo $semestre ?></div><span class="pos"></span>
        </div>
        <div class="container">
        <div class="panel pricing-table">
        <?php
        foreach($cursos as $cur)
        {
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
                    <table class="pricing-plan basic">
                        <tr>
                            <th>
                                BASIC
                            </th>
                        </tr>
                        <tr>
                            <td><ul class="pricing-features"><?php for($i = 0; $i<count($desc)-1; $i++){ echo "<li class='pricing-features-item'>".$desc[$i]."</li>"; } echo "<li class='pricing-features-item'>".$finalizaVirtual[0]."</li>"; ?></ul></td>
                        </tr>
                        <tr>
                            <td>Valor de contado:<br><?php echo "$".number_format($cur->Valor_Contado, 0, '', '.'); ?></td>
                        </tr>
                        <tr>
                            <td><a href="http://formartecentral.q10academico.com/formarte/preinscripcion/<?php echo $cur->Consecutivo; ?>" target="blank" class="pricing-button">Preinscripción</a>
                                <div class="linkVermas"><a href="<?php echo $urlVirtual ?>" target="blank" class="ver-mas">Información</a></div></td>
                        </tr>
                    </table>
                <?php }
                if($codigo == $cuarenta)
                { ?>
                    <table class="pricing-plan cuarenta">
                        <tr>
                            <th>
                                40 HORAS
                            </th>
                        </tr>
                        <tr>
                            <td><ul class="pricing-features"><?php for($i = 0; $i<count($desc)-1; $i++){ echo "<li class='pricing-features-item'>".$desc[$i]."</li>"; } echo "<li class='pricing-features-item'>".$finalizaVirtual[0]."</li>"; ?></ul></td>
                        </tr>
                        <tr>
                            <td>Valor de contado:<br><?php echo "$".number_format($cur->Valor_Contado, 0, '', '.'); ?></td>
                        </tr>
                        <tr>
                            <td><a href="http://formartecentral.q10academico.com/formarte/preinscripcion/<?php echo $cur->Consecutivo; ?>" target="blank" class="pricing-button">Preinscripción</a>
                                <div class="linkVermas"><a href="<?php echo $urlVirtual ?>" target="blank" class="ver-mas">Información</a></div></td>
                        </tr>
                    </table>
               <?php }
                if($codigo == $programa)
                { ?>
                    <table class="pricing-plan premium">
                        <tr>
                            <th>
                                PREMIUM
                            </th>
                        </tr>
                        <tr>
                            <td><ul class="pricing-features"><?php for($i = 0; $i<count($desc)-1; $i++){ echo "<li class='pricing-features-item'>".$desc[$i]."</li>"; } echo "<li class='pricing-features-item'>".$finalizaVirtual[0]."</li>"; ?></ul></td>
                        </tr>
                        <tr>
                            <td>Valor de contado:<br><?php echo "$".number_format($cur->Valor_Contado, 0, '', '.'); ?></td>
                        </tr>
                        <tr>
                            <td><a href="http://formartecentral.q10academico.com/formarte/preinscripcion/<?php echo $cur->Consecutivo; ?>" target="blank" class="pricing-button">Preinscripción</a>
                                <div class="linkVermas"><a href="<?php echo $urlVirtual ?>" target="blank" class="ver-mas">Información</a></div></td>
                        </tr>
                    </table>
               <?php }
                $result = true;
            }
        }
    }
        ?>
        </div>
        
        </div>
        <?php
        if(!$result)
        {
            echo "<div class='cuerpo-cursos'>";
            echo "<p>no hay resultados</p>";
            echo "</div>";
        }else
        {
            echo "<div class='cuerpo-cursos'>";
            echo "<p>Todos los programas terminan una semana antes del examen.</p>";
            echo "</div>";
        }
  }
}

//Shortcode filtros
add_shortcode('FORMARTE_CURSOS_ACTUAL', 'Index');

//Cursos dentro de la info del programa
function innerCourses($ciudad, $programa){
    ?><form method="post" action="#tomarCurso">
<div class="vc_row wpb_row vc_row-fluid edgtf-section edgtf-content-aligment-left edgtf-grid-section" style=""><div class="clearfix edgtf-section-inner"><div class="edgtf-section-inner-margin clearfix"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner ">
  <div class="wpb_wrapper">
    <div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>
    <input type="submit" id="tomarCurso"  value="DESEO TOMAR EL CURSO" class="edgtf-btn edgtf-btn-large edgtf-btn-outline edgtf-btn-custom-hover-bg frmt-boton" style="cursor: pointer">
<a href="http://<?php echo "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>formas-de-pago/" target="_blank" style="color: #1b3643;border-color: #1b3643;font-weight: 100" class="edgtf-btn edgtf-btn-large edgtf-btn-outline edgtf-btn-custom-hover-bg edgtf-btn-custom-hover-color frmt-boton2" data-hover-bg-color="#1b3643" data-hover-color="#ffffff">
    <span class="edgtf-btn-text">FORMAS DE PAGO</span>
    </a><div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>
</div></div></div></div></div></div>
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
    ));

    $response = curl_exec($curlToken);

    $token = json_decode($response);
    $accessToken = $token->access_token;
    $apiUrl = 'https://www.q10academico.com/api/informacionHorarios';

    $result = true;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
?>
<div><button id="masMenos">Ocultar Cursos</button></div>
    <div id="listaCursos">
    <?php
        $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$accessToken]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
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
        foreach ($cursos as $cur) {
            $codigo = substr($cur->Programa, 1, 3);
            if ($codigo === $programa && $ciudad === $cur->Sede)
            {
                $nombre = explode(" ", $cur->Programa, 2);
                $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                $fecha = strtotime($cur->Fecha_Inicio_Clases);
                $mes = $meses[date('m', $fecha) - 1];
                $inicio = date("d ", $fecha) . "de " . $mes . " del " . date("Y", $fecha);
                $horario = explode(",", $cur->Descripcion);
                ?>
                            <div class="curso wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Programa: </span><?php echo "<span class='info'>" . $nombre[1] . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Fecha de inicio: </span><?php echo "<span class='info'>" . $inicio . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Horario: </span><?php echo "<span class='info'>" . $horario[0] . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Valor de contado: </span><?php echo "<span class='info'>$" . number_format($cur->Valor_Contado, 0, '', '.') . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Valor a credito: </span><?php echo "<span class='info'>$" . number_format($cur->Valor_Financiado, 0, '', '.') . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                    <?php echo "<a href='http://formartecentral.q10academico.com/formarte/preinscripcion/" . $cur->Consecutivo . "' target='blank'>Preinscribirme</a>"; ?>
                                </div>
                            </div>

                    <?php
                $result = true;
            }
        }
    }else{
        foreach ($cursos as $cur) {
            $codigo = substr($cur->Programa, 1, 3);
            if ($codigo === $programa && $ciudad === $cur->Jornada)
            {
                $nombre = explode(" ", $cur->Programa, 2);
                $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                $fecha = strtotime($cur->Fecha_Inicio_Clases);
                $mes = $meses[date('m', $fecha) - 1];
                $inicio = date("d ", $fecha) . "de " . $mes . " del " . date("Y", $fecha);
                $horario = explode(",", $cur->Descripcion);
                ?>
                            <div class="curso wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Programa: </span><?php echo "<span class='info'>" . $nombre[1] . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Fecha de inicio: </span><?php echo "<span class='info'>" . $inicio . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Horario: </span><?php echo "<span class='info'>" . $horario[0] . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Valor de contado: </span><?php echo "<span class='info'>$" . number_format($cur->Valor_Contado, 0, '', '.') . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                                    <span class="title">Valor a credito: </span><?php echo "<span class='info'>$" . number_format($cur->Valor_Financiado, 0, '', '.') . "</span>"; ?>
                                </div>
                                <div class="vc_col-md-2 vc_col-sm-12 ingroup">
                    <?php echo "<a href='http://formartecentral.q10academico.com/formarte/preinscripcion/" . $cur->Consecutivo . "' target='blank'>Preinscribirme</a>"; ?>
                                </div>
                            </div>

                    <?php
                $result = true;
            }
    }
    }
    if(!$result)
        {
            echo "<div class='cuerpo-cursos'>";
            echo "<p>no hay resultados</p>";
            echo "</div>";
        }else
        {
            echo "<div class='cuerpo-cursos'>";
            echo "<p>Todos los programas terminan una semana antes del examen.</p>";
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