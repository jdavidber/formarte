/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$( document ).ready(function()
{
    
    $("#programa").change(function (){
        if($("#programa").val() === "CPF")
        {
            $("#semestre").css("display", "none");
            $("#jornada").css("display", "none");
        }else{
            $("#semestre").css("display", "block");
            if($("#metodologia").val() === "VIRTUAL")
            {
                $("#jornada").css("display", "none");
            }
            else
            {
                $("#jornada").css("display", "block");
            }
        }
    });
    
    window.setInterval(function(){
        if($(".noResults").is(":visible"))
    {
        $("#listaCursos").hide();
        $("#masMenos").hide();
    }
    },500);
    //Virtual Premium
    if($(".premium")){
        $(".destacado").animate({opacity: '1'}, 500);
        $("#circle1").animate({width: '120px',
        height: '120px',
        opacity: '0',
        margin: '-10'
        }, 800);
        //star1
        $("#star1").animate({
            width: '25px',
            height: '25px'
        },400);
        $("#star1").animate({
            width: '22px',
            height: '22px'
        },200);
        $("#star1").animate({
            width: '25px',
            height: '25px'
        },200);
        
        //star2
        $("#star2").animate({
            width: '18px',
            height: '18px'
        },400);
        $("#star2").animate({
            width: '15px',
            height: '15px'
        },200);
        $("#star2").animate({
            width: '18px',
            height: '18px'
        },200);
        
        //star3
        $("#star3").animate({
            width: '20px',
            height: '20px',
            margin: '70px 25px'
        },400);
        $("#star3").animate({
            width: '18px',
            height: '18px'
        },200);
        $("#star3").animate({
            width: '20px',
            height: '20px'
        },200);
    }
    $(".premium").mouseenter(function(){
        $("#star1").animate({
            width: '22px',
            height: '22px'
        },200);
        $("#star1").animate({
            width: '25px',
            height: '25px'
        },200);
        $("#star1").animate({
            width: '22px',
            height: '22px'
        },200);
        $("#star1").animate({
            width: '25px',
            height: '25px'
        },200);
        
        //star2
        $("#star2").animate({
            width: '20px',
            height: '20px'
        },200);
        $("#star2").animate({
            width: '18px',
            height: '18px'
        },200);
        $("#star2").animate({
            width: '20px',
            height: '20px'
        },200);
        $("#star2").animate({
            width: '18px',
            height: '18px'
        },200);
        
        //star3
        $("#star3").animate({
            width: '15px',
            height: '15px'
        },200);
        $("#star3").animate({
            width: '18px',
            height: '18px'
        },200);
        $("#star3").animate({
            width: '15px',
            height: '15px'
        },200);
        $("#star3").animate({
            width: '18px',
            height: '18px'
        },200);
    });
    
     //Acciones de los botones "Deseo tomar el curso" en la info de programa
   if(!$("#listaCursos").length)
    {
        $(".preinscribir2").click(function(e)
        {
            e.preventDefault();
            $("#tomarCurso").click();
        });
    }else{
        $(".preinscribir").click(function(e)
        {
            e.preventDefault();
            window.location = "#masMenos";
            if($("#listaCursos").is(":hidden"))
            {
                $("#masMenos").click();
            }
        }); 
    }
//Animacion extraterrestre

    
    window.setInterval(function()
    {
        $(".extraterrestre2").animate({left: '105%'}, 15000, "linear");
    }, 5000);
    
    function salto()
    {
        $(".extraterrestre").animate({top: '80px'}, 150);
        $(".extraterrestre").animate({top: '118px'}, 100);
        $(".extraterrestre").animate({top: '80px'}, 150);
        $(".extraterrestre").animate({top: '118px'}, 100);
    }
    function movimiento(e)
    {
        //$(".extraterrestre").animate({top: '130px'}, 600);
        $(".extraterrestre").animate({left: e.position().left + e.width()/2}, 1500);
        //$(".extraterrestre").animate({top: '165px'}, 600);
    }
    //Entrada extraterrestre
    $(".extraterrestre").animate({left: $("#metodologia").position().left + $("#metodologia").width()-$("#metodologia").width()/2}, 2400, "swing");
    $(".extraterrestre").animate({top: '118px'}, 600, "swing");
    salto();
    
    $("#metodologia").change(function(){
        if($("#metodologia").val() === "PRESENCIAL")
        {
         movimiento($("#ciudad"));
         salto();
             $("#ciudad").change(function(){
                 movimiento($("#programa"));
                 salto();
             });
             $("#programa").change(function(){
                 if($("#programa").val() === "CPF")
                 {
                     movimiento($("#filtrosEnviar"));
                     salto();
                 }
                 else
                 {
                 movimiento($("#semestre"));
                 salto();
                 }
             });
             $("#semestre").change(function(){
                 movimiento($("#jornada"));
                 salto();
             });
             $("#jornada").change(function(){
                 movimiento($("#filtrosEnviar"));
                 salto();
             });
        }
        else if($("#metodologia").val() === "VIRTUAL"){
         movimiento($("#programa"));
         salto();
             $("#programa").change(function(){
                 movimiento($("#semestre"));
                 salto();
             });
             $("#semestre").change(function(){
                 movimiento($("#filtrosEnviar"));
                 salto();
             });
             $("#metodologia").change(function(){
                 movimiento($("#ciudad"));
                 salto();
             });
        }
       });
       
       $(".extraterrestre").mouseover(function(){
            salto();
       });

    var meto = document.getElementById("metodologia");
    var ciudad = document.getElementById("ciudad");
    var semestre = document.getElementById("semestre");
    var programa = document.getElementById("programa");
    var jornada = document.getElementById("jornada");
    
    //Validaciones formulario
    $("#filtrosEnviar").click(function(e)
    {
        if($("#jornada").val() === "" && $("#jornada").is(":visible"))
        {
           e.preventDefault();
           toolbox($("#jornada"));
        }
        if($("#semestre").val() === ""  && $("#semestre").is(":visible"))
        {
           e.preventDefault();
           toolbox($("#semestre"));
        }
        if($("#programa").val() === "")
        {
           e.preventDefault();
           toolbox($("#programa"));
        }
        if($("#ciudad").val() === "" && $("#ciudad").is(":visible"))
        {
           e.preventDefault();
           toolbox($("#ciudad"));
        }
        if($("#metodologia").val() === "")
        {
           e.preventDefault();
           toolbox($("#metodologia"));
        }
        function toolbox(e){
            $(".tooltiptext").css({
               "visibility": "visible",
               "opacity": "1",
               "left": e.position().left + e.width()/2,
               "top": "55px"
           });
           $(".tooltiptext").text("Por favor seleccione una opción.");
           window.setInterval(function(){
               $(".tooltiptext").css("opacity", "0");
           }, 5000);
           clearInterval();
        }
        
    });
    //Cargar select con cursos de virtual
    $( ".metodologia" ).change(function() {
        if(meto.value === "VIRTUAL"){
        ciudad.style.display = "none";
        jornada.style.display = "none";
        ciudad.value = "";
                $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Programa</option>')
            .val('')
            .append('<option value="PSB">PreICFES Saber 11º</option>')
            .val('PSB')
            .append('<option value="PUA">Preuniversitario UdeA</option>')
            .val('PUA')
            .append('<option value="PUN">Preuniversitario UNAL</option>')
            .val('PUN')
            .append('<option value="PCA">Preuniversitario Cauca</option>')
            .val('PCA')
            .append('<option value="PUC">Preuniversitario Cartagena</option>')
            .val('PUC')
            .append('<option value="PUT">Preuniversitario Atlántico</option>')
            .val('PUT')
            .append('<option value="PMG">Preuniversitario Magdalena</option>')
            .val('PMG');
            $('#programa').val('');
        }else{
            ciudad.style.display = "block";
            jornada.style.display = "block";
        }
    });
//Cargar select de cursos al cambiar la ciudad
    $( ".ciudad" ).change(function() {
        
        cargarCursos();

    });
    // JSON desde la URL
    function getJsonFromUrl(hashBased) {
  var query;
  if(hashBased) {
    var pos = location.href.indexOf("?");
    if(pos==-1) return [];
    query = location.href.substr(pos+1);
  } else {
    query = location.search.substr(1);
  }
  var result = {};
  query.split("&").forEach(function(part) {
    if(!part) return;
    part = part.split("+").join(" ");
    var eq = part.indexOf("=");
    var key = eq>-1 ? part.substr(0,eq) : part;
    var val = eq>-1 ? decodeURIComponent(part.substr(eq+1)) : "";
    var from = key.indexOf("[");
    if(from==-1) result[decodeURIComponent(key)] = val;
    else
    {
      var to = key.indexOf("]",from);
      var index = decodeURIComponent(key.substring(from+1,to));
      key = decodeURIComponent(key.substring(0,from));
      if(!result[key]) result[key] = [];
      if(!index) result[key].push(val);
      else result[key][index] = val;
    }
  });
  return result;
}
// mostrar / ocultar selects según metodología
var url = window.location.href;
var obj = getJsonFromUrl(url);
    if(obj.length !== 0){
    meto.value = obj["metodologia"];
        if(obj["metodologia"] === "VIRTUAL")
        {
            ciudad.style.display = "none";
            jornada.style.display = "none";
            ciudad.value = "";
            jornada.value = "";
            semestre.value = obj["semestre"];
        }
        else
        {
            ciudad.value = obj["ciudad"];
            programa.value = obj["programa"];
            semestre.value = obj["semestre"];
            jornada.value = obj["jornada"];
        }
        if(obj["programa"] === "CPF")
        {
            semestre.style.display = "none";
            jornada.style.display = "none";
            semestre.value = "";
            jornada.value = "";
        }
    }
    else
    {
        ciudad.value = "";
        programa.value = "";
        semestre.value = "";
        jornada.value = "";
    }

    
    cargarCursos();
    
    
// Breadcrumbs
        if(obj.length !== 0)
        {
            programa.value = obj["programa"]; 
        }
        var prog = document.getElementById("programa");
        progSpan = document.getElementById("bread2");
        

        var bread0 = document.getElementById("bread0");
        var bread1 = document.getElementById("bread1");
        var bread2 = document.getElementById("bread2");
        var bread3 = document.getElementById("bread3");
        var bread4 = document.getElementById("bread4");
        
        if(bread0 != null && bread0.innerHTML === "")
        {
            bread0.style.display = 'none';
        }
        if(bread1 != null && bread1.innerHTML === "")
        {
            bread1.style.display = 'none';
        }
        if(bread2 != null && bread2.innerHTML === "")
        {
            bread2.style.display = 'inline';
            progSpan.innerHTML = prog.options[prog.selectedIndex].text;
        }
        else
        {
            bread2.style.display = 'inline';
                progSpan.innerHTML = prog.options[prog.selectedIndex].text + " >";
        }
        if(bread3 != null && bread3.innerHTML === "")
        {
            bread3.style.display = 'none';
        }
        if(bread4 != null)
        {
            if(bread4.innerHTML === "")
            {
                bread4.style.display = 'none';
                progSpan.innerHTML = prog.options[prog.selectedIndex].text + " >";
            }
            else
            {
                progSpan.innerHTML = prog.options[prog.selectedIndex].text + " >";
            }
            
        }
        
});
//Mostrar / ocultar lista de cursos en programa
$( "#masMenos" ).click(function () {
  if ( $( "#listaCursos" ).is( ":hidden" ) ) {
    $( "#listaCursos" ).slideDown( "slow" );
    $("#masMenos").text("Ocultar cursos");
    $("#masMenos").append("<span class='dashicons dashicons-hidden'></span>");
  } else {
    $( "#listaCursos" ).slideUp("slow");
    $("#masMenos").text("Mostrar cursos");
    $("#masMenos").append("<span class='dashicons dashicons-visibility'></span>");
  }
});
//Alimentar select con cursos por ciudad
function cargarCursos(){
    if(ciudad.value == 'MEDELLIN')
    {
        $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="" selected="true">Programa</option>')
            .val('')
            .append('<option value="PUA">Preuniversitario UdeA</option>')
            .val('PUA')
            .append('<option value="PUN">Preuniversitario UNAL</option>')
            .val('PUN')
            .append('<option value="PSB">PreICFES Saber 11°</option>')
            .val('PSB')
            .append('<option value="PMR">Premédico</option>')
            .val('PMN')
            .append('<option value="PIR">Preingeniero</option>')
            .val('PIR')
            .append('<option value="INA">Preuniversitario integrado UNAL UdeA</option>')
            .val('INA')
            .append('<option value="ITP">Preuniversitario integrado UdeA UNAL ICFES Saber 11°</option>')
            .val('ITP')
            .append('<option value="UAI">Preuniversitario integrado inglés UdeA</option>')
            .val('UAI')
            .append('<option value="UNI">Preuniversitario integrado inglés UNAL</option>')
            .val('UNI')
            .append('<option value="ISB">Preuniversitario integrado inglés ICFES</option>')
            .val('ISB')
            .append('<option value="CPF">Clases particulares</option>')
            .val('CPF');
            $('#programa').val('');
        }
        if(ciudad.value == 'BOGOTA')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Programa</option>')
            .val('')
            .append('<option value="PUN">Preuniversitario UNAL</option>')
            .val('PUN')
            .append('<option value="PSB">PreICFES Saber 11°</option>')
            .val('PSB')
            .append('<option value="PIR">Preingeniero</option>')
            .val('PIR')
            .append('<option value="PMR">Premédico</option>')
            .val('PMR')
            .append('<option value="INS">Preuniversitario integrado UNAL Saber 11°</option>')
            .val('INS')
            .append('<option value="IUN">Preuniversitario integrado inglés UNAL</option>')
            .val('IUN')
            .append('<option value="ISB">Preuniversitario integrado inglés ICFES</option>')
            .val('ISB')
            .append('<option value="CPF">Clases particulares</option>')
            .val('CPF');
            $('#programa').val('');
        }
        if(ciudad.value == 'BARRANQUILLA')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Programa</option>')
            .val('')
            .append('<option value="PSB">PreICFES Saber 11°</option>')
            .val('PSB')
            .append('<option value="PUC">Preuniversitario Cartagena</option>')
            .val('PUC')
            .append('<option value="PMR">Premédico</option>')
            .val('PMR')
            .append('<option value="ISB">Preuniversitario integrado inglés ICFES</option>')
            .val('ISB')
            .append('<option value="CPF">Clases particulares</option>')
            .val('CPF');
            $('#programa').val('');
        }
        if(ciudad.value == 'BUCARAMANGA')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Programa</option>')
            .val('')
            .append('<option value="PSB">PreICFES Saber 11°</option>')
            .val('PSB')
            .append('<option value="PMN">Premédico PreICFES Saber 11°</option>')
            .val('PMN')
            .append('<option value="ISB">Preuniversitario integrado inglés ICFES</option>')
            .val('ISB')
            .append('<option value="CPF">Clases particulares</option>')
            .val('CPF');
            $('#programa').val('');
        }
        if(ciudad.value == 'MANIZALES')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Programa</option>')
            .val('')
            .append('<option value="PUN">Preuniversitario UNAL</option>')
            .val('PUN')
            .append('<option value="PSB">PreICFES Saber 11°</option>')
            .val('PSB')
            .append('<option value="ITP">Preuniversitario integrado UdeA UNAL Saber 11°</option>')
            .val('INSF')
            .append('<option value="INS">Preuniversitario integrado UNAL Saber 11°</option>')
            .val('INS')
            .append('<option value="ISB">Preuniversitario integrado inglés ICFES</option>')
            .val('ISB')
            .append('<option value="IUN">Preuniversitario integrado inglés UNAL</option>')
            .val('IUN')
            .append('<option value="CPF">Clases particulares</option>')
            .val('CPF');
            $('#programa').val('');
        }
        if(ciudad.value == 'CALI')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Programa</option>')
            .val('')
            .append('<option value="PSB">PreICFES Saber 11°</option>')
            .val('PSB')
            .append('<option value="PMR">Premédico PreICFES Saber 11°</option>')
            .val('PMR')
            .append('<option value="INS">Preuniversitario integrado UNAL Saber 11°</option>')
            .val('INS')
            .append('<option value="ISB">Preuniversitario integrado inglés ICFES</option>')
            .val('ISB')
            .append('<option value="CPF">Clases particulares</option>')
            .val('CPF');
            $('#programa').val('');
        }
        if(ciudad.value == '')
        {
            if(metodologia.value == 'VIRTUAL')
            {
                ciudad.value = '';
                $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Programa</option>')
            .val('')
            .append('<option value="PSB">PreICFES Saber 11º</option>')
            .val('PSB')
            .append('<option value="PUA">Preuniversitario UdeA</option>')
            .val('PUA')
            .append('<option value="PUN">Preuniversitario UNAL</option>')
            .val('PUN')
            .append('<option value="PCA">Preuniversitario Cauca</option>')
            .val('PCA')
            .append('<option value="PUC">Preuniversitario Cartagena</option>')
            .val('PUC')
            .append('<option value="PUT">Preuniversitario Atlántico</option>')
            .val('PUT')
            .append('<option value="PMG">Preuniversitario Magdalena</option>')
            .val('PMG');
            $('#programa').val('');
            }
            else
            {
                $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Programa</option>')
            .val('');
            $('#programa').val('');
            }
        }
}