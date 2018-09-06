<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php oxides_edge_wp_title(); ?>
    <?php
    /**
     * @see oxides_edge_header_meta() - hooked with 10
     * @see edgt_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('oxides_edge_header_meta'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<script>
    dataLayer = [];
</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-K244CN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K244CN');</script>
<!-- End Google Tag Manager -->
<script>
function pushTag(vpv){
    dataLayer.push({
        'event':'enviarPaginaVirtual',
        'vpv': vpv
    });
};
</script>
<div id="tresw-prematriculas-formarte">
    <!-- Tabla de Programas -->
    <div id="q10Programas" class="q10Modal hideModal">
        <div class="hazloqueamas"></div>
        <div class="btnHidePrograms">
            <a href="javascript:void(0)" onclick="hideModal('q10Programas');" style="top: 0px; left: 1202px;">
                <span aria-hidden="true" class="edgtf-icon-font-elegant icon_close "></span>
            </a>
        </div>
        <h2>¿EN QUE PROGRAMA DESEAS FORMARTE?</h2>
        <!-- <p style="color: #CCC; text-align: center;">
          Nos encontramos realizando mantenimiento a esta herramienta, por favor intenta de nuevo más tarde. Gracias.
        </p> -->
        <?php //if ( is_user_logged_in() ) { ?>
        <ul class="categorias" style="display:">
            <li><a data-categoria="PRE">PREUNIVERSITARIO - PRE SABER 11</a></li>
            <li><a data-categoria="VIRTUAL">EDUCACIÓN VIRTUAL</a></li>
            <li><a data-categoria="INGLÉS">INGLÉS CERTIFICADO</a></li>
            <li><a data-categoria="CERTIFICACIÓN">CERTIFICACIONES</a></li>
            <li><a data-categoria="PERSONALIZADO">SERVICIOS PERSONALIZADOS</a></li>
            <li><a data-categoria="INSTITUCIONAL">SERVICIOS INSTITUCIONALES</a></li>
        </ul>
        <ul class="programas" style="display: none"></ul>
        <a class="step1Regresar" href="javascript:q10Regresar()">Regresar</a>
        <?php //} ?>
    </div>
    <!-- Tabla de Periodos -->
    <div id="q10Periodos" class="q10Modal hideModal">
        <div class="hazloqueamas"></div>
        <div class="btnHidePrograms">
            <a href="javascript:void(0)" onclick="hideModal('q10Periodos');" style="top: 0px; left: 1202px;">
                <span aria-hidden="true" class="edgtf-icon-font-elegant icon_close "></span>
            </a>
        </div>
        <h2>¿Cuándo quieres presentar tu examen?</h2>
        <ul class="twoCols"></ul>
        <div class="clearfix"></div>
    </div>
    <!-- Tabla de Jornadas -->
    <div id="q10Jornadas" class="q10Modal hideModal">
        <div class="hazloqueamas"></div>
        <div class="btnHidePrograms">
            <a href="javascript:void(0)" onclick="hideModal('q10Jornadas');" style="top: 0px; left: 1202px;">
                <span aria-hidden="true" class="edgtf-icon-font-elegant icon_close "></span>
            </a>
        </div>
        <h2>Seleccione la jornada:</h2>
        <ul class="oneCol"></ul>
    </div>
</div>
<div id="formarteOverlay" class="hideModal">
    <div class="btnHidePrograms">
        <a href="javascript:void(0)" onclick="hideModal('formarteOverlay');" style="top: 0px; left: 1202px;">
            <span aria-hidden="true" class="edgtf-icon-font-elegant icon_close "></span>
        </a>
    </div>
    <h2>¡GRACIAS POR CONTACTARNOS <span class="nombreVisitante"></span>!</h2>
    <p>Un asesor pronto se comunciará contigo para brindarte toda la información que necesites.</p>
    <?php $currentSite = get_blog_details($site['blog_id']); ?>
    <a class="aceptar" href="javascript:void(0)" onclick="hideModal('formarteOverlay'); window.location.href='http://formarte.edu.co<?php echo $currentSite->path; ?>gracias-por-venir/'">CERRAR</a>
</div>
<?php oxides_edge_get_side_area(); ?>

<div class="edgtf-wrapper">
    <div class="edgtf-wrapper-inner">
        <?php oxides_edge_get_header(); ?>

        <?php if(oxides_edge_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='edgtf-back-to-top'  href='#'>
                <span class="edgtf-icon-stack">
                    <span class="line-1"></span>
                    <span class="line-2"></span>
                    <span class="line-3"></span>
                </span>
            </a>
        <?php } ?>
        <?php oxides_edge_get_full_screen_menu(); ?>

        <div class="edgtf-content" <?php oxides_edge_content_elem_style_attr(); ?>>
            <div class="edgtf-content-inner">
