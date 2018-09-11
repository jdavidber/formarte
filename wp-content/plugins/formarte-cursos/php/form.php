<?php

/* 
 * Formulario de filtros
 */
$ciudad = "";
$meto = "";
if(isset($_GET['metodologia'])){
    $ciudad=$_GET['metodologia'];
}
if(isset($_GET['ciudad'])){
    $ciudad=$_GET['ciudad'];
}
?>
<form class="filtro-cursos" method="get">
<div class="vc_row wpb_row vc_row-fluid edgtf-section edgtf-content-aligment-left" style=""><div class="clearfix edgtf-full-section-inner"><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
                    <select name="metodologia" id="metodologia" class="metodologia">
                        <option selected>--Seleccione--</option>
                        <option value="PRESENCIAL" required>Presencial</option>
                        <option value="VIRTUAL">Virtual</option>
                    </select>
                    <select name="ciudad" id="ciudad">
                        <option value="none" selected>--Seleccione--</option>
                        <option value="MEDELLIN" required>Medellín</option>
                        <option value="BOGOTA">Bogotá</option>
                        <option value="BARRANQUILLA">Barranquilla</option>
                        <option value="BUCARAMANGA">Bucaramanga</option>
                        <option value="MANIZALES">Manizales</option>
                        <option value="CALI">Cali</option>
                    </select>
                <input type="text" placeholder="">
		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
                <input type="text" placeholder="">
                <input type="text" placeholder="">
                <button type="submit" value="Filtrar">Filtrar</button>
		</div>
	</div>
</div></div></div></div></div>
</form>