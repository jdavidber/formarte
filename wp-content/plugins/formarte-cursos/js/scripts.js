/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$( document ).ready(function() {
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
            .append('<option value="VPSB">PREICFES SABER 11º</option>')
            .val('none')
            .append('<option value="VPUA">PREUNIVERSITARIO UDEA</option>')
            .val('none')
            .append('<option value="VPUN">PREUNIVERSITARIO UNAL</option>')
            .val('none')
            .append('<option value="VPCA">PREUNIVERSITARIO CAUCA</option>')
            .val('none')
            .append('<option value="VPUC">PREUNIVERSITARIO CARTAGENA</option>')
            .val('none')
            .append('<option value="VPUT">PREUNIVERSITARIO ATLÁNTICO</option>')
            .val('none')
            .append('<option value="VPMG">PREUNIVERSITARIO MAGDALENA</option>')
            .val('none')
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
        }else
        {
            ciudad.value = obj["ciudad"];
            programa.value = obj["programa"];
            semestre.value = obj["semestre"];
            jornada.value = obj["jornada"];
        }
    }else
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
        
        if(bread0 != null && bread0.innerHTML === "none&nbsp;/&nbsp;")
        {
            bread0.style.display = 'none';
        }
        if(bread1 != null && bread1.innerHTML === "none&nbsp;/&nbsp;")
        {
            bread1.style.display = 'none';
        }
        if(bread2 != null && bread2.innerHTML === "none&nbsp;/&nbsp;")
        {
            bread2.style.display = 'none';
        }
        if(bread3 != null && bread3.innerHTML === "none&nbsp;/&nbsp;")
        {
            bread3.style.display = 'none';
        }
        if(bread4 != null)
        {
            if(bread4.innerHTML === "none"){
                bread4.style.display = 'none';
                progSpan.innerHTML = prog.options[prog.selectedIndex].text;
            }else{
                progSpan.innerHTML = prog.options[prog.selectedIndex].text+"&nbsp;/&nbsp;";
            }
            
        }

});

function cargarCursos(){
    if(ciudad.value == 'MEDELLIN'){

        $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="MPUA">PREUNIVERSITARIO UDEA</option>')
            .val('MPUA')
            .append('<option value="MPUN">PREUNIVERSITARIO UNAL</option>')
            .val('MPUN')
            .append('<option value="MPSB">PREICFES SABER 11°</option>')
            .val('MPSB')
            .append('<option value="IUAI">PREUNIVERSITARIO INTEGRADO INGLÉS UDEA</option>')
            .val('IUAI')
            .append('<option value="IUNI">PREUNIVERSITARIO INTEGRADO INGLÉS UNAL</option>')
            .val('IUNI')
            .append('<option value="MPMR">PREMÉDICO</option>')
            .val('MPMN')
            .append('<option value="MPIR">PREINGENIERO</option>')
            .val('MPIR')
            .append('<option value="MINA">PREUNIVERSITARIO INTEGRADO UNAL UDEA</option>')
            .val('MINA')
            .append('<option value="MITP">PREUNIVERSITARIO INTEGRADO UDEA UNAL ICFES SABER 11°</option>')
            .val('MITP')
            .append('<option value="MCPF">CLASES PARTICULARES</option>')
            .val('MCPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'BOGOTA'){

            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="BPUN">PREUNIVERSITARIO UNAL</option>')
            .val('BPUN')
            .append('<option value="BPSB">PREICFES SABER 11°</option>')
            .val('BPSB')
            .append('<option value="BIUN">PREUNIVERSITARIO INTEGRADO INGLÉS UNAL</option>')
            .val('BIUN')
            .append('<option value="BINS">PREUNIVERSITARIO INTEGRADO UNAL SABER 11°</option>')
            .val('BINS')
            .append('<option value="BPIR">PREINGENIERO</option>')
            .val('BPIR')
            .append('<option value="BPMR">PREMÉDICO</option>')
            .val('BPMR')
            .append('<option value="MCPF">CLASES PARTICULARES</option>')
            .val('MCPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'BARRANQUILLA'){

            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="QPSB">PREICFES SABER 11°</option>')
            .val('QPSB')
            .append('<option value="QPUC">PREUNIVERSITARIO CARTAGENA</option>')
            .val('QPUC')
            .append('<option value="QPMR">PREMÉDICO</option>')
            .val('QPMR')
            .append('<option value="QCPF">CLASES PARTICULARES</option>')
            .val('QCPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'BUCARAMANGA'){

            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="GPSB">PREICFES SABER 11°</option>')
            .val('GPSB')
            .append('<option value="GPMN">PREMÉDICO PREICFES SABER 11°</option>')
            .val('GPMN')
            .append('<option value="GCPF">CLASES PARTICULARES</option>')
            .val('GCPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'MANIZALES'){

            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="ZPUN">PREUNIVERSITARIO UNAL</option>')
            .val('ZPUN')
            .append('<option value="ZPSB">PREICFES SABER 11°</option>')
            .val('ZPSB')
            .append('<option value="ZINSF">PREUNIVERSITARIO INTEGRADO UDEA UNAL SABER 11°</option>')
            .val('ZINSF')
            .append('<option value="ZINS">PREUNIVERSITARIO INTEGRADO UNAL SABER 11°</option>')
            .val('ZINS')
            .append('<option value="ZCPF">CLASES PARTICULARES</option>')
            .val('ZCPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'CALI'){

            $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="CPSB">PREICFES SABER 11°</option>')
            .val('CPSB')
            .append('<option value="CPMR">PREMÉDICO PREICFES SABER 11°</option>')
            .val('CPMR')
            .append('<option value="CINS">PREUNIVERSITARIO INTEGRADO UNAL SABER 11°</option>')
            .val('CINS')
            .append('<option value="CCPF">CLASES PARTICULARES</option>')
            .val('CCPF')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
        }
        if(ciudad.value == 'none'){
            if(metodologia.value == 'VIRTUAL'){
                ciudad.value = 'none';
                $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="VPSB">PREICFES SABER 11º</option>')
            .val('none')
            .append('<option value="VPUA">PREUNIVERSITARIO UDEA</option>')
            .val('none')
            .append('<option value="VPUN">PREUNIVERSITARIO UNAL</option>')
            .val('none')
            .append('<option value="VPCA">PREUNIVERSITARIO CAUCA</option>')
            .val('none')
            .append('<option value="VPUC">PREUNIVERSITARIO CARTAGENA</option>')
            .val('none')
            .append('<option value="VPUT">PREUNIVERSITARIO ATLÁNTICO</option>')
            .val('none')
            .append('<option value="VPMG">PREUNIVERSITARIO MAGDALENA</option>')
            .val('none')
            .append('<option value="none">--Seleccione--</option>')
            .val('none');
            }else{
                $('#programa')
            .find('option')
            .remove()
            .end()
            .append('<option value="none">--Seleccione una ciudad--</option>')
            .val('none');
            }
        }
}