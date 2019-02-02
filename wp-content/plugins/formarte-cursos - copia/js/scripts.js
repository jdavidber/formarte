/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$( document ).ready(function() {
    if(!$("#listaCursos").length){
    $(".preinscribir").click(function(e){
        e.preventDefault();
        $("#tomarCurso").click();
    });
    }
  
    var meto = document.getElementById("metodologia");
    var ciudad = document.getElementById("ciudad");
    var semestre = document.getElementById("semestre");
    var programa = document.getElementById("programa");
    var jornada = document.getElementById("jornada");
    $( ".metodologia" ).change(function() {
        if(meto.value === "VIRTUAL"){
        ciudad.style.display = "none";
        jornada.style.display = "none";
        ciudad.removeAttribute("required", "");
        ciudad.value = "none";
                $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="PSB">PREICFES SABER 11º</option>')
            .val('PSB')
            .append('<option value="PUA">PREUNIVERSITARIO UDEA</option>')
            .val('PUA')
            .append('<option value="PUN">PREUNIVERSITARIO UNAL</option>')
            .val('PUN')
            .append('<option value="PCA">PREUNIVERSITARIO CAUCA</option>')
            .val('PCA')
            .append('<option value="PUC">PREUNIVERSITARIO CARTAGENA</option>')
            .val('PUC')
            .append('<option value="PUT">PREUNIVERSITARIO ATLÁNTICO</option>')
            .val('PUT')
            .append('<option value="PMG">PREUNIVERSITARIO MAGDALENA</option>')
            .val('PMG')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        
        }else{
            ciudad.style.display = "block";
            jornada.style.display = "block";
            ciudad.setAttribute("required", "");
        }
    });

    $( ".ciudad" ).change(function() {
        
        cargarCursos();

    });
    
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
var url = window.location.href;
var obj = getJsonFromUrl(url);
    if(obj.length !== 0){
    meto.value = obj["metodologia"];
        if(obj["metodologia"] === "VIRTUAL")
        {
            ciudad.style.display = "none";
            jornada.style.display = "none";
            ciudad.value = "none";
            jornada.value = "none";
            semestre.value = obj["semestre"];
        }
        else
        {
            ciudad.value = obj["ciudad"];
            programa.value = obj["programa"];
            semestre.value = obj["semestre"];
            jornada.value = obj["jornada"];
        }
    }
    else
    {
        ciudad.value = "none";
        programa.value = "none";
        semestre.value = "none";
        jornada.value = "none";
    }

    
    cargarCursos();

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
        
        if(bread0 != null && bread0.innerHTML === "none")
        {
            bread0.style.display = 'none';
        }
        if(bread1 != null && bread1.innerHTML === "none")
        {
            bread1.style.display = 'none';
        }
        if(bread2 != null && bread2.innerHTML === "none")
        {
            bread2.style.display = 'none';
        }
        else
        {
                progSpan.innerHTML = prog.options[prog.selectedIndex].text;
        }
        if(bread3 != null && bread3.innerHTML === "none")
        {
            bread3.style.display = 'none';
        }
        if(bread4 != null)
        {
            if(bread4.innerHTML === "none")
            {
                bread4.style.display = 'none';
                progSpan.innerHTML = prog.options[prog.selectedIndex].text;
            }
            else
            {
                progSpan.innerHTML = prog.options[prog.selectedIndex].text;
            }
            
        }
});

$( "#masMenos" ).click(function () {
  if ( $( "#listaCursos" ).is( ":hidden" ) ) {
    $( "#listaCursos" ).slideDown( "slow" );
    $("#masMenos").text("Ocultar cursos");
  } else {
    $( "#listaCursos" ).slideUp("slow");
    $("#masMenos").text("Mostrar cursos");
  }
});

function cargarCursos(){
    if(ciudad.value == 'MEDELLIN')
    {
        $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="PUA">PREUNIVERSITARIO UDEA</option>')
            .val('PUA')
            .append('<option value="PUN">PREUNIVERSITARIO UNAL</option>')
            .val('PUN')
            .append('<option value="PSB">PREICFES SABER 11°</option>')
            .val('PSB')
            .append('<option value="UAI">PREUNIVERSITARIO INTEGRADO INGLÉS UDEA</option>')
            .val('UAI')
            .append('<option value="UNI">PREUNIVERSITARIO INTEGRADO INGLÉS UNAL</option>')
            .val('UNI')
            .append('<option value="PMR">PREMÉDICO</option>')
            .val('PMN')
            .append('<option value="PIR">PREINGENIERO</option>')
            .val('PIR')
            .append('<option value="INA">PREUNIVERSITARIO INTEGRADO UNAL UDEA</option>')
            .val('INA')
            .append('<option value="ITP">PREUNIVERSITARIO INTEGRADO UDEA UNAL ICFES SABER 11°</option>')
            .val('ITP')
            .append('<option value="CPF">CLASES PARTICULARES</option>')
            .val('CPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'BOGOTA')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="PUN">PREUNIVERSITARIO UNAL</option>')
            .val('PUN')
            .append('<option value="PSB">PREICFES SABER 11°</option>')
            .val('PSB')
            .append('<option value="IUN">PREUNIVERSITARIO INTEGRADO INGLÉS UNAL</option>')
            .val('IUN')
            .append('<option value="INS">PREUNIVERSITARIO INTEGRADO UNAL SABER 11°</option>')
            .val('INS')
            .append('<option value="PIR">PREINGENIERO</option>')
            .val('PIR')
            .append('<option value="PMR">PREMÉDICO</option>')
            .val('PMR')
            .append('<option value="CPF">CLASES PARTICULARES</option>')
            .val('CPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'BARRANQUILLA')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="PSB">PREICFES SABER 11°</option>')
            .val('PSB')
            .append('<option value="PUC">PREUNIVERSITARIO CARTAGENA</option>')
            .val('PUC')
            .append('<option value="PMR">PREMÉDICO</option>')
            .val('PMR')
            .append('<option value="CPF">CLASES PARTICULARES</option>')
            .val('CPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'BUCARAMANGA')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="PSB">PREICFES SABER 11°</option>')
            .val('PSB')
            .append('<option value="PMN">PREMÉDICO PREICFES SABER 11°</option>')
            .val('PMN')
            .append('<option value="CPF">CLASES PARTICULARES</option>')
            .val('CPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'MANIZALES')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="PUN">PREUNIVERSITARIO UNAL</option>')
            .val('PUN')
            .append('<option value="PSB">PREICFES SABER 11°</option>')
            .val('PSB')
            .append('<option value="ITP">PREUNIVERSITARIO INTEGRADO UDEA UNAL SABER 11°</option>')
            .val('INSF')
            .append('<option value="INS">PREUNIVERSITARIO INTEGRADO UNAL SABER 11°</option>')
            .val('INS')
            .append('<option value="CPF">CLASES PARTICULARES</option>')
            .val('CPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'CALI')
        {
            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="PSB">PREICFES SABER 11°</option>')
            .val('PSB')
            .append('<option value="PMR">PREMÉDICO PREICFES SABER 11°</option>')
            .val('PMR')
            .append('<option value="INS">PREUNIVERSITARIO INTEGRADO UNAL SABER 11°</option>')
            .val('INS')
            .append('<option value="CPF">CLASES PARTICULARES</option>')
            .val('CPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'none')
        {
            if(metodologia.value == 'VIRTUAL')
            {
                ciudad.value = 'none';
                $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="PSB">PREICFES SABER 11º</option>')
            .val('PSB')
            .append('<option value="PUA">PREUNIVERSITARIO UDEA</option>')
            .val('PUA')
            .append('<option value="PUN">PREUNIVERSITARIO UNAL</option>')
            .val('PUN')
            .append('<option value="PCA">PREUNIVERSITARIO CAUCA</option>')
            .val('PCA')
            .append('<option value="PUC">PREUNIVERSITARIO CARTAGENA</option>')
            .val('PUC')
            .append('<option value="PUT">PREUNIVERSITARIO ATLÁNTICO</option>')
            .val('PUT')
            .append('<option value="PMG">PREUNIVERSITARIO MAGDALENA</option>')
            .val('PMG')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
            }
            else
            {
                $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="none">--Seleccione una ciudad--</option>')
            .val('none');
            }
        }
}