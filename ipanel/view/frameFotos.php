<?php

/**
 *  iPanel Control Admin 3.0
 *  index.php
 *  Arquivo de Mostra de dados do Sistema
 *
 *  Pertencente ao pacote admin.view
 *
 *  Copyright (C) 2011  iMAXIS Soluções Digitais Ltda
 *  Autor: Cledson Lodi
 *
 *  Criado em 06/09/2011
 */

   require_once("../app/core/config.php");
   require_once(APP_PATH."/cms/restritoIPanel.php");
   require_once(APP_PATH."/cms/functions.php");
   require_once(APP_PATH."/controller/GenericCtrl.php");
   require_once(APP_PATH."/util/Util.php");
   require_once(APP_PATH."/util/Data.php");

   $util = new Util();
   $data = new Data();
   $control = new GenericCtrl("Foto");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fotos</title>
<script type="text/javascript" language="javascript" src="../js/lytebox.js"></script>

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/funcoes.js"></script>

<style type="text/css">
<!--
body {
    margin-left: 2px;
    margin-top: 2px;
    margin-right: 2px;
    margin-bottom: 2px;
    background-color: #f4f8fc;
}

.text-default-blue {
	font-family:Arial, Tahoma, Verdana, Helvetica, sans-serif;
	font-size:12px;
	text-decoration: none;
	color:#02679c;
	}
	
#layerLegenda {
	position:absolute;
	left:293px;
	top:142px;
	width:355px;
	height:105px;
	z-index:1;
	background-color: #FFFFFF;
}

-->
</style>
</head>

<body>
<div id="layerLegenda" style="display:none"> 
  <table width="354" border="5" bordercolor="#90bde2" id="dados">
    <tr> 
      <td width="336" bgcolor="#FFFFFF"> 
	  <table width="325" border="0" align="center">
          <input type="hidden" name="id" id="id" value="" />
          <tr valign="top"> 
            <td height="25" colspan="2" align="right"><a href="javascript:;" Onclick="document.getElementById('layerLegenda').style.display='none'"> 
              <img src="img/closelabel.gif" width="69" height="17" border="0"/></a>
            </td>
          </tr>
          <tr> 
            <td width="80" height="25" align="right" class="text-default-blue">  Legenda :</td>
            <td width="235"> <input name="legenda" type="text" id="legenda" size="38" /></td>
          </tr>
          <tr> 
            <td height="25" align="right">&nbsp;</td>
            <td align="right"> <table border="0" cellpadding="2" cellspacing="0" id="btSalvar">
                <tr> 
                    <td width="97" align="right"><a href="javascript:salvarLegenda()"><img src="img/btSalvar.png" border="0"/></a></td>
                </tr>
              </table>
              <table border="0" cellpadding="2" cellspacing="0" id="loadingTable" style="display:none;">
                <tr> 
                  <td width="97" align="right"><img src="img/loading.gif"/></td>
                </tr>
              </table></td>
          </tr>
          </table></td>
    </tr>
  </table>
</div>



<? 
   $fotos = $control->getObjectByFields(array("local", "regId"), array($_GET['folder'], $_GET['id']));
   foreach($fotos as $foto){
?>
<div style="width:105px; height:105px; float:left;">
<table width="100" height="100" align="left" cellpadding=3 cellspacing=3 border="1" style="border:1px; border-color:#E4E4E4;">
  <tr>
    <td height="16" valign="top" bgcolor="f7f7f7"> 
<table width="84" border=0 align="left" cellpadding=2 cellspacing=2
 background="../app/cms/thumb.php?y=100&x=100&img=../../uploads/<?= $_GET['folder'] ?>/<?= $_GET['id'] ?>/<?= 'thumb_'.$foto['nome'] ?>"
 style="background-repeat:no-repeat">
      <tr>
            <td height="97" align="left" valign="top"> 
<div style="margin-top:0px">
			   <a href="javascript:if(confirm('Deseja realmente excluir esta foto ?')){window.parent.fotos.location ='../app/cms/processa.php?action=DeleteFoto&lc=Foto&idFoto=<?= $foto['id'] ?>&regId=<?= $foto['regId'] ?>&folder=<?= $_GET['folder'] ?>&foto=<?= $foto['nome'] ?>'}" >
			   <img src="img/delFoto.png" title="Apagar  foto" border="0" align="left" />
			   </a> <a href="../uploads/<?= $_GET['folder'] ?>/<?= $_GET['id'] ?>/big_<?= $foto['nome'] ?>" rel='lytebox' title="<?= $foto['legenda'] ?>">
			   <img src="img/lupaFoto.png" title="Ampliar foto" border="0" align="left" />
			   </a>
			   <a href="javascript:;" onclick="mostraLayerLegenda('<?= $foto['id'] ?>', '<?= $foto['legenda'] ?>',event)">
			   <img src="img/button-edit.gif" width="18" height="18" border="0" title="Alterar Legenda"/>
			   </a>

			</div>
		    <!-- <img src="../app/cms/thumb.php?y=100&x=100&img=../../uploads/<?= $_GET['folder'] ?>/<?= $_GET['id'] ?>/<?= 'big_'.$foto['nome'] ?>"> -->
		</td>
     </tr>
    </table>
    </td>
</tr>
</table>
</div>
<? } ?>
</body>
</html>