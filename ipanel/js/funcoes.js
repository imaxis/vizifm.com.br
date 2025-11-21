/* ****************************************************************************/
/*                                                                            */
/*              Arquivo de funções javascript - Sistema Meimberg              */
/*                  Desenvolvimento  -  Agência Studio iMAXIS                 */
/*                                                                            */
/* ************************************************************************** */

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}


function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}


function showHideDiv(idObj, idReg)
	{
	  array_ids = document.getElementById("ids").value;
	  obj = document.getElementById(idObj);
          objReg = document.getElementById(idReg);
	  if(obj.style.display == ""){
              obj.style.display = "none";
              objReg.className = "iten_list bg_listing";
          }
	  else{
            obj.style.display = "";
            objReg.className = "iten_list_off";
          }
	  var ids = array_ids.split("-");
	  var tamanho = ids.length - 1;
	  
	  for(i=0; i < tamanho; i++){
	      if(ids[i] != idObj){
                 if(ids[i].indexOf("reg") == -1){
                    obj = document.getElementById(ids[i]);
		    obj.style.display = "none";
                 }else{
                    if(ids[i] != idReg){
                       objReg = document.getElementById(ids[i]);
                       objReg.className = "iten_list";
                    }
                 }
	      }
	  }
 }


function showHideAluno(id)
{
    array_ids = document.getElementById("idsAlunos").value;
    obj = document.getElementById("aluno_"+id);
    if(obj.style.display == ""){
      obj.style.display = "none";
    }else{
      obj.style.display = "";
    }
    var ids = array_ids.split("-");
    var tamanho = ids.length - 1;

    for(i=0; i < tamanho; i++){
      if(ids[i] != id){
         obj = document.getElementById("aluno_"+ids[i]);
         obj.style.display = "none";
      }
    }
}
 
// Função para mostrar as abas no menu Principal
function showTab(tab)
{
    var tabs = document.getElementById('tabs').value.split(";");
    var i;
    for(i=0; i < (tabs.length - 1); i++){
      if(tabs[i] == tab){
         document.getElementById('tab'+tabs[i]).style.display='block';
      }else{
         document.getElementById('tab'+tabs[i]).style.display='none';
      }
   }
}

// Função para mostrar as abas nos formulários internos
function mostraAba(local, abas)
{
   var arrayAbas = abas.split(",");
   var i;
   for(i=0; i < arrayAbas.length; i++)
   {
	 if(arrayAbas[i] == local){
	   document.getElementById(arrayAbas[i]).style.display='';
	   //document.getElementById("aba"+arrayAbas[i]).className='aba-on';
	 }
	 else{
	   document.getElementById(arrayAbas[i]).style.display='none';
	   //document.getElementById("aba"+arrayAbas[i]).className='aba-off';
	}
  }
}


function Confirma(){ 
 if (confirm('Deseja realmente excluir estes registros ?')){
	 return true; 
	 document.Form_Lst.submit();	 
	 }
 else 
     return false;
}


function selectAllToDelete()
{
    with(document.FormLista)
    {
        for(i=0;i<elements.length;i++)
        {
            thiselm = elements[i];
            if(thiselm.name.substring(0,12) == 'check[]'){ 
                thiselm.checked = true;
            }
        }
    }
}


function inverteSelectionToDelete()
{
    with(document.FormLista)
    {
        for(i=0;i<elements.length;i++)
        {
            thiselm = elements[i];
            if(thiselm.name.substring(0,12) == 'check[]'){
                thiselm.checked = !thiselm.checked;
            }
        }
    }
}


function executeAction(){
    var action = document.getElementById("action").value;
    if(action == "Selecionar"){
        selectAllToDelete();
    }
    if(action == "Inverter"){
        inverteSelectionToDelete();
    }
    if(action == "Excluir"){
        if(confirm('Deseja realmente excluir este(s) registro(s) ?')){
            document.FormLista.submit();
        }
    }

}

function SelAllUsr()
{
	with(document.Form_Reg)
	{
		for(i=0;i<elements.length;i++)
		{
			thiselm = elements[i];
			if(thiselm.name.substring(0,12) == 'Permissao[]'){ 
			  thiselm.checked = !thiselm.checked;
			}
		}
	}
}

function verificaBusca()
{	
    if(document.formBusca.buscarPor.value == ""){
        alert("Favor! Selecione o Tipo de Busca.");
        document.formBusca.buscarPor.focus();
        return false;
    }
}



function GerarSWF($arquivo,$altura,$largura,$id){
    document.writeln('    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="' + $largura + '" height="' + $altura + '" id="' + $id + '" name="' + $id + '">');
    document.writeln('        <param name="movie" value="' + $arquivo + '" />');
    document.writeln('        <param name="FlashVars" value="loc=en_US&htmlApp=false&gatewayURL=gwurl" />');
    document.writeln('        <param name="bgcolor" value="#ffffff" />');
    document.writeln('        <param name="menu" value="false" />');
    document.writeln('        <param name="quality" value="high" />');
    document.writeln('        <param name="salign" value="tl" />');
    document.writeln('        <param name="scale" value="noscale" />');
    document.writeln('        <param name="wmode" value="transparent" />');
    document.writeln('        <embed id="globalnav-embed" src="' + $arquivo + '" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" flashvars="loc=en_US&htmlApp=false&gatewayURL=gwurl" bgcolor="#ffffff" menu="false" quality="high" salign="tl" scale="noscale" id="' + $id + '" width="' + $largura + '" height="' + $altura + '"></embed>');
    document.writeln('    </object>');
}


function readablizeBytes(bytes) {
    var s = ['bytes', 'kb', 'MB', 'GB', 'TB', 'PB'];
    var e = Math.floor(Math.log(bytes)/Math.log(1024));
    return (bytes/Math.pow(1024, Math.floor(e))).toFixed(2)+"&nbsp;"+s[e];
}

function salvarLegenda() {
	
	var id = document.getElementById('id').value;
	var legenda = document.getElementById('legenda').value;
	url = "../app/cms/processa.php?action=LegendaFoto&lc=Foto&id="+id+"&legenda="+legenda;
	
	document.getElementById('btSalvar').style.display = 'none';
	document.getElementById('loadingTable').style.display = 'block';

    req = conecta();
    req.open("GET", url, true);
    req.onreadystatechange = function(){
        if(req.readyState == 4){
            if(req.status == 200){
                var conteudo = req.responseText
                var conteudo = unescape(conteudo).replace(/\+/g,' ')
				document.getElementById('layerLegenda').style.display = 'none';
            }
        }
    }
    req.send(null);
}

function mostraLayerLegenda(id, legenda, event)
{
	var posX;
	var posY;
	if (event.pageX) {
	  posX = event.pageX;
	  posY = event.pageY;
	}else{
	  posX = event.clientX;
	  posY = event.clientY;
	}

	  
	//var posicaoY = 230 + cnt * 35;  
	//alert (posX+"-"+posicaoY);
	document.getElementById("layerLegenda").style.left = posX+'px';
	document.getElementById("layerLegenda").style.top  = posY+'px';
	document.getElementById("layerLegenda").style.display = "block";
	document.getElementById("btSalvar").style.display = "block";
	document.getElementById("loadingTable").style.display = "none";
	document.getElementById("id").value = id;
	document.getElementById("legenda").value = legenda;		
}

function showCropLayer(local, folder, id, image)
{
    var layer = document.getElementById("layerRecorte");
    var nroRegistros = document.getElementById("nroRegistros").value;
    layer.style.display = "block";

    var w = "100%";
    var h = (nroRegistros * 25) + 500;
    if(h < screen.height)
        h = screen.height - 100;
    var url = "modRecorte.php?folder="+folder+"&id="+id+"&imagem="+image+"&lc="+local;
    layer.innerHTML = "<iframe frameborder='0' src='"+url+"' width='"+w+"' height='"+h+"'></iframe>";
}


function selectAllActionsBySetor(setor, acoes)
{
    var arrayAcoes = acoes.split(",");
    var status = document.getElementById(setor).checked;
    for(i=0; i < arrayAcoes.length; i++){
        var acao = arrayAcoes[i].replace(" ", "");
        document.getElementById(setor+"_"+acao).checked = status;
    }
}

function atualizaCamposBusca(){
  var local = document.getElementById('Lc').value;
  url = "../app/geraBuscaRapida.php?Lc="+local;
  obj = document.getElementById("buscarPor");
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
            opcoes = jsonData.campos;
            for(var i =0; i < opcoes.length; i++){
                opcaoCampo = opcoes[i].campo;
                opcaoNome  = opcoes[i].nome;
                if(opcaoCampo != null)
                    adicionaOption(obj, opcaoCampo, opcaoNome, false, false);
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

function formataValor(objeto,teclapres,tammax,decimais){
	var tecla			= teclapres.keyCode;
	var tamanhoObjeto	= objeto.value.length;
	if ((tecla == 8) && (tamanhoObjeto == tammax)){
		tamanhoObjeto = tamanhoObjeto - 1 ;
	}
	if (( tecla == 8 || tecla == 88 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ) && ((tamanhoObjeto+1) <= tammax)){
		vr	= objeto.value;
		vr	= vr.replace( "/", "" );
		vr	= vr.replace( "/", "" );
		vr	= vr.replace( ",", "" );
		vr	= vr.replace( ".", "" );
		vr	= vr.replace( ".", "" );
		tam	= vr.length;
		if (tam < tammax && tecla != 8){
			tam = vr.length + 1 ;
		}
		if ((tecla == 8) && (tam > 1)){
			tam = tam - 1 ;
			vr = objeto.value;
			vr = vr.replace( "/", "" );
			vr = vr.replace( "/", "" );
			vr = vr.replace( ",", "" );
			vr = vr.replace( ".", "" );
			vr = vr.replace( ".", "" );
			vr = vr.replace( ".", "" );
		}
		//Cálculo para casas decimais setadas por parametro
		if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ){
			if (decimais > 0){
				if ( (tam <= decimais) ){ 
					objeto.value = ("0," + vr) ;
				}
				if( (tam == (decimais + 1)) && (tecla == 8)){
					objeto.value = vr.substr( 0, (tam - decimais)) + ',' + vr.substr( tam - (decimais), tam ) ;	
				}
				if ( (tam > (decimais + 1)) && (tam <= (decimais + 3)) &&  ((vr.substr(0,1)) == "0")){
					objeto.value = vr.substr( 1, (tam - (decimais+1))) + ',' + vr.substr( tam - (decimais), tam ) ;
				}
				if ( (tam > (decimais + 1)) && (tam <= (decimais + 3)) &&  ((vr.substr(0,1)) != "0")){
				    objeto.value = vr.substr( 0, tam - decimais ) + ',' + vr.substr( tam - decimais, tam ) ; 
				}
				if ( (tam >= (decimais + 4)) && (tam <= (decimais + 6))){
			 		objeto.value = vr.substr( 0, tam - (decimais + 3) ) + '.' + vr.substr( tam - (decimais + 3), 3 ) + ',' + vr.substr( tam - decimais, tam ) ;
				}
			 	if ( (tam >= (decimais + 7)) && (tam <= (decimais + 9))){
			 		objeto.value = vr.substr( 0, tam - (decimais + 6) ) + '.' + vr.substr( tam - (decimais + 6), 3 ) + '.' + vr.substr( tam - (decimais + 3), 3 ) + ',' + vr.substr( tam - decimais, tam ) ;
				}
				if ( (tam >= (decimais + 10)) && (tam <= (decimais + 12))){
			 		objeto.value = vr.substr( 0, tam - (decimais + 9) ) + '.' + vr.substr( tam - (decimais + 9), 3 ) + '.' + vr.substr( tam - (decimais + 6), 3 ) + '.' + vr.substr( tam - (decimais + 3), 3 ) + ',' + vr.substr( tam - decimais, tam ) ;
				}
				if ( (tam >= (decimais + 13)) && (tam <= (decimais + 15)) ){
			 		objeto.value = vr.substr( 0, tam - (decimais + 12) ) + '.' + vr.substr( tam - (decimais + 12), 3 ) + '.' + vr.substr( tam - (decimais + 9), 3 ) + '.' + vr.substr( tam - (decimais + 6), 3 ) + '.' + vr.substr( tam - (decimais + 3), 3 ) + ',' + vr.substr( tam - decimais, tam ) ;
				}
			}
			else if(decimais == 0){
				if ( tam <= 3 ){ 
			 		objeto.value = vr ;
				}
				if ( (tam >= 4) && (tam <= 6)){
					if(tecla == 8){
						objeto.value = vr.substr(0, tam);
						window.event.cancelBubble = true;
						window.event.returnValue = false;
					}
					objeto.value = vr.substr(0, tam - 3) + '.' + vr.substr( tam - 3, 3 ); 
				}

				if ( (tam >= 7) && (tam <= 9)){
					if(tecla == 8){
						objeto.value = vr.substr(0, tam);
						window.event.cancelBubble = true;
						window.event.returnValue = false;
					}
					objeto.value = vr.substr( 0, tam - 6 ) + '.' + vr.substr( tam - 6, 3 ) + '.' + vr.substr( tam - 3, 3 ); 
				}
				if ( (tam >= 10) && (tam <= 12)){
			 		if(tecla == 8){
						objeto.value = vr.substr(0, tam);
						window.event.cancelBubble = true;
						window.event.returnValue = false;
					}
					objeto.value = vr.substr( 0, tam - 9 ) + '.' + vr.substr( tam - 9, 3 ) + '.' + vr.substr( tam - 6, 3 ) + '.' + vr.substr( tam - 3, 3 ); 
				}
				if ( (tam >= 13) && (tam <= 15) ){
					if(tecla == 8){
						objeto.value = vr.substr(0, tam);
						window.event.cancelBubble = true;
						window.event.returnValue = false;
					}
					objeto.value = vr.substr( 0, tam - 12 ) + '.' + vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '.' + vr.substr( tam - 6, 3 ) + '.' + vr.substr( tam - 3, 3 ) ;
				}			
			}
		}
	}
	else if((window.event.keyCode != 8) && (window.event.keyCode != 9) && (window.event.keyCode != 13) && (window.event.keyCode != 35) && (window.event.keyCode != 36) && (window.event.keyCode != 46)){
			window.event.cancelBubble = true;
			window.event.returnValue = false;
		}
}

function irPara(url, event){
    var tecla = event.keyCode;
    var page = document.getElementById("irPara").value;
    if(parseInt(tecla) == 13){
        alert("enter");
        parent.location.href=url+"&page="+page;
    }
}


function countChars(idElement, max_chars){
    counter = document.getElementById('caracter_'+idElement);
    field = document.getElementById(idElement).value;
    field_length = field.length
    remaining_chars = max_chars-field_length;

    if(remaining_chars<=20){
        document.getElementById(idElement).style.backgroundColor="#fff8b0";
    }
    if(remaining_chars<=10){
        counter.style.color="#CC0000";
    }else{
        counter.style.color="#4e6381";
        document.getElementById(idElement).style.backgroundColor="#fff";
    }
    counter.innerHTML = remaining_chars;
}

function number(dom){
    dom.value=dom.value.replace(/\D/g,'');
}

function enableDisableOpcoes(catId){
    if(catId != ""){
        document.getElementById("opcoes").style.display = "block";
    }else{
        document.getElementById("opcoes").style.display = "none";
    }
}

function removerDivOpcoes(div){
    opcoes = document.getElementById("opcoes");
    div = document.getElementById(div);
    opcoes.removeChild(div);
}

function removerDivOpcoesEditar(div){
    divEditar = document.getElementById("divEditar");
    div = document.getElementById(div);
    divEditar.removeChild(div);
}

function mostraCampoPesquisa(campo){
   if(campo != "" && campo != "todos"){
       dadosCampo = campo.split("|");
       campo = dadosCampo[0].replace(".", "_");
       campo = campo.replace(".", "_");
       campo = campo.replace(".", "_");
       arrayDivs = document.getElementById("arrayDivs").value;
       div = document.getElementById('div_'+campo);
       var ids = arrayDivs.split("-");
       var tamanho = ids.length - 1;
       for(i=0; i < tamanho; i++){
          document.getElementById(ids[i]).style.display = "none";
       }
       if(div.style.display == "block"){
          div.style.display = "none";
       }else{
          div.style.display = "block";
       }
    }
 }