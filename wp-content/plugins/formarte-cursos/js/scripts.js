/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$( document ).ready(function() {
    
    var meto = document.getElementById("metodologia");
    var ciudad = document.getElementById("ciudad");
    $( ".metodologia" ).change(function() {
        if(meto.value === "VIRTUAL"){
        ciudad.style.display = "none";
        ciudad.removeAttribute("required", "");
        ciudad.value = "none";
        }else{
            ciudad.style.display = "block";
            ciudad.setAttribute("required", "");
        }
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
    else {
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
    if(obj["metodologia"] === "VIRTUAL"){
    ciudad.style.display = "none";
    ciudad.value = "none";
    }else{
    ciudad.value = obj["ciudad"];
    }
}
});
