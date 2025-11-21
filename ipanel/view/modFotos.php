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
$id = $_GET['id'];
$uploadFolder = $ipanel->getConfig()->getParameter("uploads.folder");

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="../js/jquery.fileupload.js"></script>
<script src="../js/jquery.fileupload-ui.js"></script>
<script>
/*global $ */
$(function () {
    $('.upload').fileUploadUI({
        uploadTable: $('.upload_files'),
        downloadTable: $('.download_files'),
        buildUploadRow: function (files, index) {
            var file = files[index];
            return $(
                '<tr>' +
                '<td class="sptl">' + file.name + '<\/td>' +
                '<td class="file_upload_progress"><div><\/div><\/td>' +
                '<td class="file_upload_cancel">' +
                '<div class="ui-state-default ui-corner-all ui-state-hover" title="Cancel">' +
                '<span class="ui-icon ui-icon-cancel">Cancel<\/span>' +
                '<\/div>' +
                '<\/td>' +
                '<\/tr>'
            );
        },
        buildDownloadRow: function (file) {
		    fotos.location.href = "frameFotos.php?id=<?= $id ?>&folder=<?= $uploadFolder ?>";
            return $(
                '<tr><td bgcolor="#f4f8fc"><img src="../uploads/<?= $uploadFolder ?>/<?= $id ?>/' + file.name +'" width="55" align="left"/>&nbsp;'+
		 '<span class="sptl">' + file.name + '</span><br><span class="sptl">&nbsp;<strong>'+ readablizeBytes(file.size) +'</strong></span></td></tr>'
            );
        }
    });
});
</script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" id="theme">
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
<link rel="stylesheet" href="css/lytebox.css" type="text/css" media="screen"/>


<div class="lt" style="padding-bottom:0px!important;">
        <div class="lt_topo">
            
            <div class="lt_menu_topo" style="padding-bottom:10px!important;">
                <?= $this->getImage() ?>
                <h1><?= $this->getCurrentTitle() ?>  (Galeria de Fotos)</h1>
                <span class="sptl">Formul&aacute;rio de Inclus&atilde;o / Altera&ccedil;&atilde;o de Fotos<br/>
                Selecione as imagens do tipo JPG, GIF ou PNG<br>
                Clique para selecionar ou arraste as imagens para cima do campo &quot;Selecionar Arquivos&quot;.</span>
                <div style="height: 25px; padding-top: 10px">
                    <a title="Listar Registros" href="?lc=<?= $this->getArea() ?>&md=Lista<?= $this->getParameters($_GET) ?>" class="bt_azul" style="margin-left: 0px; margin-top: 10px">Retornar a Lista</a>
                     <a title="Adicionar Novo" href="?lc=<?= $this->getArea() ?>&md=Form" class="bt_azul" style="margin-left: 0px; margin-top: 10px">Novo Registro</a>
                </div>
            </div>
            <div class="images_upload">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        <form class="upload" action="../app/cms/processa.php?id=<?= $_GET['id'] ?>&lc=<?= $_GET['lc'] ?>&md=Fotos&action=Upload" 
                              method="POST" enctype="multipart/form-data" style="margin-bottom: 15px">
                          <input type="file" name="file" multiple>
                          <button>Upload</button>
                          <div><span class="uploadText">Selecionar Arquivos</span></div>
                        </form>
                          <table class="upload_files" width="300" cellspacing="5" ></table>
                          <table class="download_files" cellspacing="5"></table></td>
                    </tr>
                  </table>
	   </div>
            
           <div class="images_list">
               <iframe src="frameFotos.php?id=<?= $id ?>&folder=<?= $uploadFolder ?>"
                       name="fotos" width="100%" height="100%" scrolling="auto" frameborder="0" id="fotos">
               </iframe>
           </div>							        

    </div>
</div>


