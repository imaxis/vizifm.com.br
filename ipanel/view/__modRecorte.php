<?php

require_once("../app/core/config.php");
require_once(APP_PATH."/cms/restritoIPanel.php");
require_once(APP_PATH."/cms/functions.php");
require_once(APP_PATH."/cms/IPanelApp.php");
require_once(APP_PATH . "/controller/GenericCtrl.php");
require_once(APP_PATH."/util/Util.php");


$util = new Util();
$ipanel = new IPanelApp();
$ipanel -> setMode($_GET['md']);           // seta o modo da classe (Lista - Form)
$ipanel -> setArea($_GET['lc']);           // seta o local atual a ser mostrado
$ipanel -> setParameters($_GET['prm']);    // informa os parametros adicionais
$ipanel->setConfig();
$ipanel->setMenu();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="../js/jquery.Jcrop.js" type="text/javascript"></script>
<script src="../js/imageZoom_v5.js" type="text/javascript" ></script>

<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

<style type="text/css">
    fieldset.optdual { width: 500px; }
    .optdual { position: relative; }
    .optdual .offset { position: absolute; left: 18em; }
    .optlist label { width: 16em; display: block; }
    #dl_links { margin-top: .5em; }

    div#container_image { float: left; margin-right: 5px; width:448px; height:310px; position: relative; overflow:hidden;  }
    div#container_image img#image { position: absolute; left:0; top:0; visibility: hidden; }
    ul.options{ float: left; width: 10px; visibility: hidden;  }
    ul.options li { width: 15px; margin-bottom: 5px; height: 15px; }
    ul.options li a { font-size: 10px; line-height: 10px; vertical-align: middle; padding: 1px 0 4px 0; width: 15px; display: block; text-decoration: none; height: 10px;background:#000; color:#fff; text-align: center; }

</style>

<script language="Javascript">

    $(window).load(function(){
        var api = $.Jcrop('#imageCrop',{onChange: gravaPosicao, onSelect: gravaPosicao} );

		
        api.setOptions({ allowResize: true });
        api.setOptions({ allowSelect: false });

        var i, ac;

        // A handler to kill the action
        function nothing(e)
        {
            e.stopPropagation();
            e.preventDefault();
            return false;
        };

        // Returns event handler for animation callback
        function anim_handler(ac, id)
        {
            return function(e){
                api.animateTo(ac);
                return nothing(e);
            };
        };

        // Setup some coordinates for animation
        var ac = { <?= $ipanel->writeMaskPosition() ?> };

                    // Attach respective event handlers
                    for(i in ac) jQuery('#'+i).click(anim_handler(ac[i], i));

                <?= $ipanel->writeMaskButtonClick(); ?>

                // Attach another one manually, to demonstrate "set" w/o animation
                jQuery('#setsel').click(function(e) {
                    api.setSelect( [ 200, 200, 300, 300 ] );
                    return nothing(e);
                });
		
                function gravaPosicao(c)
                {
                    // campos hidden que armazenam os valores
                    $('#x').val(c.x);
                    $('#y').val(c.y);
                    // $('#x2').val(c.x2);
                    // $('#y2').val(c.y2);
                    $('#w').val(c.w);
                    $('#h').val(c.h);
                }
		
	
		
                $('#btRecortar').click(function(){
                    var x = $('#x').val();
                    var y = $('#y').val();
                    var w = $('#w').val();
                    var h = $('#h').val();
                    var tipo = $('#tipo').val();
                    var foto = $('#foto').val();
                    var local = $('#local').val();
                    var id = $('#id').val();
                    var widthZoom  = $('#imageCrop').width();
                    var heightZoom = $('#imageCrop').height();

                    $.ajax({
                        url: "../app/cms/processa.php?action=RecorteFoto&lc="+local
                             +"&x="+x+"&y="+y+"&w="+w+"&h="+h+"&tipo="+tipo
                             +"&id="+id+"&foto="+foto+"&width="+widthZoom+"&height="+heightZoom,
                        cache: false,
                        success: function(html){
                            $("#results").append(html);
                            $("#divImageAfterCrop").show(1000);
                            $("#imageAfterCrop").attr("src",html);
				//			$("#tableRecorte").hide(1000);

                           // alert("salvo");
                        }
                    });
                });
				
				$('#imageAfterCrop').click(function(){
							$("#divImageAfterCrop").hide(1000);
							$("#tableRecorte").show(1000);
							$("#imageAfterCrop").attr("src","");
                });
				
	
				$('#btCloseAfterCrop').click(function(){
							$("#divImageAfterCrop").hide(1000);
							$("#tableRecorte").show(1000);
                });
					
                <?= $ipanel->writeFunctionMaskButton(); ?>
			   		
            });
			
	/*
            function alterarZoom(zoom){
                var zoomAtual = $('#zoom').val();
				
                var width  = $('#imageCrop').width();
                var height = $('#imageCrop').height();
				
				
                var newWidth  = "";
                var newHeight = "";
                if(zoom == "+"){
                    newWidth  = width + (width * 0.03);
                    newHeight = height + (height * 0.03);
                    zoomAtual = zoomAtual + 3;
                }
                if(zoom == "-"){
                    newWidth  = width - (width * 0.03);
                    newHeight = height - (height * 0.03);
                    zoomAtual = zoomAtual - 3;
                }
                //alert($('#imageCrop').width());
               // $('#imageCrop').width(newWidth).height(newHeight);
			//	$("#imageCrop").attr("width",newWidth);
			//	$("#imageCrop").attr("height",newHeight);
				$("imageZoom").attr("width",newWidth);
				$("imageZoom").attr("height",newHeight);
                $('#zoom').val(zoomAtual);
                //alert($('#imageCrop').src());
            }
*/

</script>

<link href="css/style.css" rel="stylesheet" type="text/css">

<div id="outer">
    <div class="jcExample">
        <div class="article" align="center" style="padding: 20px; z-index:1;">
            <div id="divImageAfterCrop" style="width:95%; height:95%; display:none; position:absolute; background-image:url(../img/overlay.png);" align="center">
                <br><br>
				<img id="imageAfterCrop" src=""
                 alt="Clique para fechar"
                 title="Clique para fechar"/><br /><br />
				 <img id="btCloseAfterCrop" src="img/closelabel.gif" width="69" height="17" border="0"> 
            </div>
            <table width="850" height="650" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td width="5" align="left" valign="top"><img src="img/lat1.gif" width="5" height="5" /></td>
                    <td></td>
                    <td width="169"></td>
                    <td width="5" height="5" align="right" valign="top"><img src="img/lat2.gif" width="5" height="5" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" valign="top">
                            
              <table border="0" align="center" cellpadding="1" cellspacing="1" id="tableRecorte">
                <tr> 
                  <td width="141" rowspan="3" align="center" valign="top"> <img src="img/imageCut.png"></td>
                  <td width="505" height="44" class="numbers-data" style="text-transform:capitalize;"> 
                    <?= $ipanel->getMenu()->getCurrentDescriptionMenu() ?>
                    (Recorte de Fotos)<br> <span class="text-undertitle">&Aacute;rea 
                    de recorte de imagens</span></td>
                  <td width="189" align="right"> <a href="javascript:;" onClick="parent.document.getElementById('layerRecorte').style.display='none'"> 
                    <img src="img/closelabel.gif" width="69" height="17" border="0"> 
                    </a> </td>
                </tr>
                <tr> 
                  <td height="45" valign="top" class="text-default1">Selecione o local da imagem que deseja recortar clicando nos botões ao lado.<br>
                  Posicione a m&aacute;scara no local desejado e clique em recortar.</td>
                  <td><input type="hidden" name="zoom" id="zoom2" value="100"></td>
                </tr>
				<form name="alteraimagem" id="alteraimagem" action="../app/processa.php?Lc=<?= $_GET['Lc'] ?>" enctype="multipart/form-data" method="post">
                <tr> 
                  <td height="44" colspan="2" class="text-default1">Alterar Imagem<br>
                    <input name="novaImagem" type="file" class="form_default3" id="imagem"  size="30"/>
                    <input type="submit" name="Submit" value="Alterar" class="botao-menu"> 
                    <input type="hidden" name="x"     id="x">
					<input type="hidden" name="y"     id="y">
					<input type="hidden" name="w"     id="w">
					<input type="hidden" name="h"     id="h">
					<input type="hidden" name="Action" id="Action" value="AlterarImagemRecorte">
					<input type="hidden" name="id"    id="id"    value="<?= $_GET['id'] ?>">
					<input type="hidden" name="foto"  id="foto"  value="<?= $_GET['imagem'] ?>">
					<input type="hidden" name="tipo"  id="tipo"  value="<?= $_GET['tipo'] ?>">
					<input type="hidden" name="local" id="local" value="<?= $_GET['Lc'] ?>"> 
					</td>
                </tr>
				</form>
                <!--
                <tr>
                  <td colspan="3" valign="top"></td>
                </tr>
				  -->
                <tr> 
                  <td colspan="2" valign="top">
				  
				  <table width="528" border="0" cellpadding="0" cellspacing="0">
                      <tr>
					  <!--  
                        <td width="25" height="294" valign="top"> <a href="javascript:alterarZoom('-')"><img src="img/zoomMenos.png" alt="Reduzir" width="25" height="25" border="0" id="zoomMenos"></a><br> 
                          <a href="javascript:alterarZoom('+')"><img src="img/zoomMais.png" alt="Ampliar" width="25" height="25" border="0" id="zoomMais"></a> 
                        </td>
						-->
                        <td width="503" valign="top">
									   
						   <img src="../../uploads/<?= $_GET['folder'] ?>/<?= $_GET['id'] ?>/<?= $_GET['imagem'] ?>" name="imageZoom" id="imageCrop"/>						   
						   
						 </td>
                      </tr>
                    </table>
					
					</td>
                  <td height="55" valign="top" align="right" class="botao-menu-on"> 
                    <?= $ipanel->writeMaskButton(); ?>
                  </td>
                </tr>
                <tr> 
                  <td colspan="3" valign="top" style="padding-left:25px">
				  <input name="btRecortar" type="Button"  id="btRecortar" style="background-color:#f09819; width:135px; height:35px" value="Recortar" align="left"></td>
                </tr>
              </table>

                      

                    </td>
                    <td></td>
                </tr>
                <tr>
                    
          <td height="4" align="left" valign="bottom"><img src="img/lat3.gif" width="4" height="4" /></td>
                    <td></td>
                    <td></td>
                    <td align="right" valign="bottom"><img src="img/lat4.gif" width="4" height="4" /></td>
                </tr>
            </table>
        </div>
    </div>
</div>
