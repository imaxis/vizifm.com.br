// JavaScript Document
var inicio = 1;

function conecta() {
    if (typeof XMLHttpRequest != "undefined")
        return new XMLHttpRequest();
    else if (window.ActiveXObject){
        var versoes = ["MSXML2.XMLHttp.5.0",
        "MSXML2.XMLHttp.4.0", "MSXML2.XMLHttp.3.0",
        "MSXML2.XMLHttp", "Microsoft.XMLHttp"];
    }
    for (var i = 0; i < versoes.length; i++){
        try{
            return new ActiveXObject(versoes[i]);
        }catch (e){}
    }
    throw new Error("Seu browser nao suporta AJAX");
}


function showHideDiv(id)
{
    array_ids = document.getElementById("ids").value;
    obj = document.getElementById(id);
    if(obj.style.display == "")
        obj.style.display = "none";
    else
        obj.style.display = "";
	  
    var ids = array_ids.split("-");
    var tamanho = ids.length - 1;
	  
    for(i=0; i < tamanho; i++)
    {
        if(ids[i] != id)
        {
            obj = document.getElementById(ids[i]);
            obj.style.display = "none";
        }
    }
}

var contadorDiv = 0;
function getOpcoesProduto(catId, dimensao, furacao, offset, pcd, valor){
  contadorDiv++;
  url = "../app/cms/getOpcoesProduto.php?catId="+catId+"&divId="+contadorDiv+"&dimensao="+dimensao+"&furacao="+furacao+"&offset="+offset+"&pcd="+pcd+"&valor="+valor;
  div = document.getElementById("opcoes");
  html = document.getElementById("opcoes").innerHTML;
  req = conecta();
  req.open("GET", url, true);
  req.onreadystatechange = function(){
     if(req.readyState == 4){
        if(req.status == 200){
            div2 = document.createElement('div')
            div2.setAttribute('id', contadorDiv);
            div2.innerHTML = req.responseText;
            div.appendChild(div2);
           // div.innerHTML = html+req.responseText;
        }
     }
 }
 req.send(null);
}

var contadorDiv2 = 0;
function getOpcoesProdutoEditar(catId, proId){
  contadorDiv2++;
  url = "../app/cms/getOpcoesProdutoEditar.php?catId="+catId+"&proId="+proId;
  div = document.getElementById("opcoes");
  html = document.getElementById("opcoes").innerHTML;
  req = conecta();
  req.open("GET", url, true);
  req.onreadystatechange = function(){
     if(req.readyState == 4){
        if(req.status == 200){
            arrayHtml = req.responseText.split("***");

            for(var i=0; i < arrayHtml.length; i++){
                div2 = document.createElement('div')
                div2.setAttribute('id', i+1);
                div2.innerHTML = arrayHtml[i];
                div.appendChild(div2);
            }
           // div.innerHTML = html+req.responseText;
        }
     }
 }
 req.send(null);
}


function getMarcas(catId){
  url = "../app/cms/getMarcas.php?catId="+catId;
  obj = document.getElementById("mrcId");
  removeOptions(obj);
  adicionaOption(obj, "", "Carregando ...", true, true);
  req = conecta();
  req.open("GET", url, true);
  req.onreadystatechange = function(){
     if(req.readyState == 4){
        if(req.status == 200){
            removeOptions(obj);
            adicionaOption(obj, "", "Selecione", true, true);
            var jsonData = eval('(' + req.responseText + ')');
            marcas = jsonData.marcas;
            for(var i =0; i < marcas.length; i++){
                if(marcas[i].nome != null)
                    adicionaOption(obj, marcas[i].id, marcas[i].nome, false, false);
            }
        }
     }
 }
 req.send(null);
}


function getAcabamentos(catId, proId){
  url2 = "../app/cms/getAcabamentos.php?catId="+catId+"&proId="+proId;
  div = document.getElementById("divAcabamentos");
  req2 = conecta();
  req2.open("GET", url2, true);
  req2.onreadystatechange = function(){
     if(req2.readyState == 4){
        if(req2.status == 200){
            if(req2.responseText != ""){
               div.style.display = "block";
            }else{
               div.style.display = "none";  
            }
            div.innerHTML = req2.responseText;
        }
     }
 }
 req2.send(null);
}

function removerAcabamento(acbId, foto){
  url = "../app/cms/removerAcabamentoProduto.php?acbId="+acbId;
  req = conecta();
  req.open("GET", url, true);
  req.onreadystatechange = function(){
     if(req.readyState == 4){
        if(req.status == 200){
            document.getElementById("ftAcabamento0"+foto).style.display = "none";
            obj = document.getElementById("acbId0"+foto);
            adicionaOption(obj, "", "Selecione", false, true);
        }
     }
 }
 req.send(null);
}

/*
function getFuracoes(catId){
  url = "../app/cms/getOpcoesProduto.php?catId="+catId+"&lc=furacoes";
  obj1 = document.getElementById("furacoes");
  obj2 = document.getElementById("dimensoes");
  obj3 = document.getElementById("mrcId");
  removeOptions(obj1);
  removeOptions(obj2);
  removeOptions(obj3);
  adicionaOption(obj1, "", "Carregando ...", true, true);
  adicionaOption(obj2, "", "Carregando ...", true, true);
  adicionaOption(obj3, "", "Carregando ...", true, true);
  req = conecta();
  req.open("GET", url, true);
  req.onreadystatechange = function(){
     if(req.readyState == 4){
        if(req.status == 200){
            removeOptions(obj1);
            removeOptions(obj2);
            removeOptions(obj3);
            adicionaOption(obj3, "", "Selecione", true, true);
            var jsonData = eval('(' + req.responseText + ')');
            dimensoes = jsonData.dimensoes;
            furacoes = jsonData.furacoes;
            marcas = jsonData.marcas;
            for(var i =0; i < furacoes.length; i++){
                if(furacoes[i].descricao != null)
                    adicionaOption(obj1, furacoes[i].id, furacoes[i].descricao, false, false);
            }
            for(var i =0; i < dimensoes.length; i++){
                if(dimensoes[i].descricao != null)
                    adicionaOption(obj2, dimensoes[i].id, dimensoes[i].descricao, false, false);
            }
            for(var i =0; i < marcas.length; i++){
                if(marcas[i].nome != null)
                    adicionaOption(obj3, marcas[i].id, marcas[i].nome, false, false);
            }
        }
     }
 }
 req.send(null);
}

*/

function removeOptions(obj){
    for(i = obj.length - 1; i >= 0; i--)
        obj.remove(i);
}

function adicionaOption(obj, valor, label, selectedDefault, selected){
    var novaOpcao = new Option(label, valor, selectedDefault, selected);
    obj.options[obj.length] = novaOpcao;
}