<?php

require_once("../app/core/config.php");
require_once(APP_PATH."/cms/IPanelApp.php");
require_once(APP_PATH . "/controller/GenericCtrl.php");
require_once(APP_PATH."/util/Util.php");

$util = new Util();
$ipanel = new IPanelApp();
$ipanel -> setMode($_GET['md']);           // seta o modo da classe (Lista - Form)
$ipanel -> setArea($_GET['lc']);           // seta o local atual a ser mostrado
$ipanel->setConfig();
$ipanel->setMenu();

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<!-- <script src="../js/jquery.min.js"   type="text/javascript"></script> -->
<script src="../js/jquery.Jcrop.js" type="text/javascript"></script>
<!-- <script src="../js/imageZoom_v5.js" type="text/javascript" ></script> -->

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

                function gravaPosicao(c){
                    // campos hidden que armazenam os valores
                    $('#x').val(c.x);
                    $('#y').val(c.y);
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
                        success: function(img){
                            $("#divImageAfterCrop").show(500);
                            $("#divCrop").hide(500);
                            $("#btRecortar").hide();
                            $("#imgCropped").html("<img src='"+img+"'/>");
                        }
                    });
                });

                $('#imgCropped').click(function(){
                    $("#divImageAfterCrop").hide(500);
                    $("#divCrop").show(500);
                    $("#btRecortar").show(500);
                    $("#imgCropped").html("");
                });


                $('#btCloseAfterCrop').click(function(){
                    $("#divImageAfterCrop").hide(500);
                    $("#divCrop").show(500);
                    $("#btRecortar").show(500);
                });

                <?= $ipanel->writeFunctionMaskButton(); ?>

            });

</script>

<div class="lt" style="padding-bottom:0px!important;">
        <div class="lt_topo">
            
            <div class="lt_menu_topo" style="padding-bottom:10px!important;">
                <?= $this->getImage() ?>
                <h1><?= $this->getCurrentTitle() ?> (Recorte de Imagens)</h1>
                <span class="sptl">Posicione a máscara no local desejado e clique em recortar imagem.<br/>
                Alterne entre as abas para mudar o tipo do recorte de acordo com o local da foto.<br/>
                Selecione uma nova imagem caso necessite realizar um recorte para outra área deste registro.</span>
                   
                 <form style="height: 30px; padding-top: 5px" name="alteraimagem" id="alteraimagem" action="../app/cms/processa.php?lc=<?= $_GET['lc'] ?><?= $this->getParameters($_GET) ?>" enctype="multipart/form-data" method="post">
                     <span class="sptl" style="color:#006ac2">Alterar Imagem:</span>
                     <input name="novaImagem" type="file" style="height: 22px; color: #006ac2; padding-top: 5px;"
                    id="imagem"  size="25" onchange="document.alteraimagem.submit()"/>
                    <input type="hidden" name="x"     id="x">
                    <input type="hidden" name="y"     id="y">
                    <input type="hidden" name="w"     id="w">
                    <input type="hidden" name="h"     id="h">
                    <input type="hidden" name="action" id="action" value="AlterarImagemRecorte">
                    <input type="hidden" name="id"    id="id"    value="<?= $_GET['id'] ?>">
                    <input type="hidden" name="foto"  id="foto"  value="<?= $_GET['imagem'] ?>">
                    <input type="hidden" name="tipo"  id="tipo"  value="<?= $_GET['tipo'] ?>">
                    <input type="hidden" name="local" id="local" value="<?= $_GET['lc'] ?>">
                    <a title="Listar Registros" href="?lc=<?= $this->getArea() ?>&md=Lista<?= $this->getParameters($_GET) ?>" class="bt_azul">Listar Registros</a>
                    <a title="Adicionar Novo" href="?lc=<?= $this->getArea() ?>&md=Form" class="bt_azul">Novo Registro</a>
                    <a title="Adicionar Fotos" href="?lc=<?= $this->getArea() ?>&md=Foto<?= $this->getParameters($_GET) ?>" class="bt_azul">Adicionar Fotos</a>
		 </form>
            </div>
             <ul>
                <?= $ipanel->writeMaskButton(); ?>
                 
                <div class="clear"></div>
            </ul>
         <div class="tool_list_top" id="divCrop" style="padding-top: 10px">
             <img src="../uploads/<?= $_GET['folder'] ?>/<?= $_GET['id'] ?>/<?= $_GET['imagem'] ?>" name="imageZoom" id="imageCrop"/>
         </div>
         <div class="tool_list_top" id="divImageAfterCrop" style="padding-top: 10px; width:95%; height:650px; display:none; position:absolute;" align="center">
                <div id="imgCropped"></div>
		<img id="btCloseAfterCrop" src="img/close.png" border="0">
         </div>
    </div>
</div>
<div class="lt" style="padding-top: 30px">
      <div class="tool_list_top">
      <p class="left" style="text-align:left;">
          <a href="javascript:;"><img src="img/btCrop.gif" id="btRecortar" alt="Recortar Imagem" title="Recortar Imagem"/></a>
      </p>
      </div>
    </div>

