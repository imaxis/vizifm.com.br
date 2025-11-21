function conecta() {
    if (typeof XMLHttpRequest != "undefined")
        return new XMLHttpRequest();
    else if (window.ActiveXObject)
    {
        var versoes = ["MSXML2.XMLHttp.5.0",
                       "MSXML2.XMLHttp.4.0", "MSXML2.XMLHttp.3.0",
                       "MSXML2.XMLHttp", "Microsoft.XMLHttp"];
    }
    for (var i = 0; i < versoes.length; i++)
    {
        try{
             return new ActiveXObject(versoes[i]);
        }catch(e){}
    }
    throw new Error("Seu browser nao suporta AJAX");
}

function getCidades(uf, campo){
  url = "inc/getCidades.php?uf="+uf;
  obj = document.getElementById(campo);
  removeOptions(obj);
  adicionaOption(obj, "", "Carregando ...", true, true);
  req = conecta();
  req.open("GET", url, true);
  req.onreadystatechange = function()
  {
     if(req.readyState == 4)
     {
        if(req.status == 200){
            removeOptions(obj);
            adicionaOption(obj, "", "Selecione", true, true);
            var jsonData = eval('(' + req.responseText + ')');
            cidades = jsonData.cidades;
            for(var i =0; i < cidades.length; i++){
                cidadeNome = cidades[i].cidade;
                if(cidadeNome != null)
                    adicionaOption(obj, cidadeNome, cidadeNome, false, false);
            } 
        }
     }
 }
 req.send(null);
}

function removeOptions(obj){
    for(i = obj.length - 1; i >= 0; i--)
        obj.remove(i);
}

function adicionaOption(obj, valor, label, selectedDefault, selected){
    var novaOpcao = new Option(label, valor, selectedDefault, selected);
    obj.options[obj.length] = novaOpcao;
}