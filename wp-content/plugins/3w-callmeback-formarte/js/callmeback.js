var jQuery = jQuery.noConflict();
var $ = jQuery;

function defineIndicativo(elemento) {
  var indicativo = jQuery(elemento).val();
  jQuery("#frmt-indicativo").val(indicativo);
};

setTimeout(function(){
  defineIndicativo('#frmt-ciudad');
}, 500);

function enviarForm() {
  var frmtnombre = jQuery("#frmt-nombre").val();
  var frmtciudad = jQuery("#frmt-ciudad").val();
  var frmtcelular = jQuery("#frmt-celular").val();
  var frmtindicativo = jQuery("#frmt-indicativo").val();
  var frmtemail = jQuery("#frmt-email").val();
  var frmttelefono = jQuery("#frmt-telefono").val();

  if(frmtnombre != "" && frmtciudad != "" && frmtcelular != "" && frmtindicativo != "" && frmtemail != ""){
    var datos = "{Nombres:'" + encodeURIComponent(frmtnombre) +
      "',Ciudad:'" + encodeURIComponent(frmtciudad) +
      "',Celular:'" + encodeURIComponent(frmtcelular) +
      "',Indicativo:'" + encodeURIComponent(frmtindicativo) +
      "',Email:'" + encodeURIComponent(frmtemail) +
      "'}";
    var number = encodeURIComponent(frmtindicativo + frmttelefono);
    var desc = "Web";
    var url = jQuery.jmsajax({
      url: 'http://200.122.205.38/FidelityCallsYouBackWS/JSONP/CallBack.asmx',
      method: 'CallBackToNumberData',
      dataType: 'jsonp',
      data: {phone: number, camp: desc, data: datos}
    });

    jQuery('.nombreVisitante').text(frmtnombre);

    jQuery.ajax({
      type: "GET",
      url: url + "&format=json",
      data: "",
      cache: false,
      contentType: "application/json; charset=utf-8",
      dataType: "jsonp",
      success: function (response) {
        jQuery('input.reseteable').val("");
        showModal('formarteOverlay');
        parent.jQuery("#callmeOk-interna").fadeIn();
        setTimeout(function () {
          hideModal('formarteOverlay');
          window.location.href = "http://formarte.edu.co/"+ localStorage.getItem('ciudad').toLowerCase() +"/gracias-por-venir/";
        }, 5000);
      },
      error: function (response) {
        alert("Ups! Ha ocurrido un error. Intenta m&aacute;s tarde.");
      }
    });
  }else{

    if(frmtnombre == ""){
      jQuery("#frmt-nombre").addClass('frmerror');
    }else {
      jQuery("#frmt-nombre").removeClass('frmerror');
    }

    if(frmtciudad == ""){
      jQuery("#frmt-ciudad").addClass('frmerror');
    }else {
      jQuery("#frmt-ciudad").removeClass('frmerror');
    }

    if(jQuery("#frmt-celular").val().length < 10){
      jQuery("#frmt-celular").addClass('frmerror');
    }else {
      jQuery("#frmt-celular").removeClass('frmerror');
    }

    if(frmtemail == ""){
      jQuery("#frmt-email").addClass('frmerror');
    }else {
      jQuery("#frmt-email").removeClass('frmerror');
    }
  }

};

function showModal(modal) {
  jQuery("#" + modal).removeClass("hideModal").addClass("showModal");
  jQuery('.edgtf-wrapper').addClass('blurred');
};

function hideModal(modal) {
  jQuery('.edgtf-wrapper').removeClass('blurred');
  jQuery("#" + modal).removeClass("showModal").addClass("hideModal");
};

function showForm(){
  jQuery('#frmt-form').removeClass("hideForm").addClass("showForm");
};

function hideForm(){
  jQuery('#frmt-form').removeClass("showForm").addClass("hideForm");
};
