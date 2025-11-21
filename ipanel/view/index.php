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
   //session_start();
   require_once("../app/core/config.php");
   require_once(APP_PATH."/cms/restritoIPanel.php");
   require_once(APP_PATH."/cms/functions.php");
   require_once(APP_PATH."/cms/IPanelApp.php");
   require_once(APP_PATH."/util/Util.php");
   require_once(APP_PATH."/util/Data.php");

   $util = new Util();
   $data = new Data();

   header('Content-Type: text/html; charset=utf-8');

   $ipanel = new IPanelApp();
   $ipanel -> setMode($_GET['md']);           // seta o modo da classe (Lista - Form)
   $ipanel -> setArea($_GET['lc']);           // seta o local atual a ser mostrado
   $ipanel->setConfig($config);
   $ipanel->setMenu($menu);

  /* foreach($_SESSION['permissoes'] as $permissao){
       echo $permissao['local']." : ".$permissao['acao']."<br>";
   }*/

  // $VerifAcesso = (($_GET['Lc'] == "Usuarios") ||($_GET['Lc'] == "Backup")||($_GET['Lc'] == "Revendas"))?"Sistema":$_GET['Lc'];
 //  Permissao($VerifAcesso,$User_Permissao);   // Verifica se o usuário tem permissão de acesso a esta área

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<title>CMS - Setor Administrativo iPanel 3.0</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script src="../js/ipanel.js"    type="text/javascript" language="javascript"></script>
<script src="../js/validator.js" type="text/javascript" language="javascript"></script>
<script src="../js/mask.js"      type="text/javascript" language="javascript"></script>
<script src="../js/validatorFunctions.js"   type="text/javascript" language="javascript"></script>
<script src="../js/funcoes.js"   type="text/javascript" language="javascript"></script>
<script src="../js/tiny_mce/tiny_mce.js" type="text/javascript" ></script>
<script src="../js/tiny_mce/tiny_mce_init.js" type="text/javascript"></script>
<script src="../js/color.select.js" type="text/javascript" ></script>

<?
    if($_GET['md'] == "Form"){
        print $ipanel->writeValidationScript();
    }
?>

<style type="text/css">

label.error {
	width:300px !important;
	color:red;
	margin-left:5px !important;
	text-align:left !important;
}

</style>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/color.select.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="imxDoc">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td>
	<div id="imxBody">
    	<? include "modTopo.php" ?>
        <div id="imxAlert"></div>        
        <div id="imxStage">        
        	<? 
                   $ipanel->getMenu()->writeMenuTabs();
            ?>
        	<div class="stage">
                    <div class="stage_conteudo">
                     <?= $ipanel->output() ?>
                    <span class="stcl"></span>
                    <span class="stcr"></span>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div> 
            </div> 
            <div class="clear"></div>           
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <? include "modRodape.php" ?>
    <div class="clear"></div>
    </td>
    <div class="clear"></div>
    </tr>
    <div class="clear"></div>
</table>
<div class="clear"></div>
</div>
<div class="clear"></div>
</body>
</html>
<script type="text/javascript">
    showTab('<?= $util->nameForWeb($ipanel->getMenu()->getCurrentTab()) ?>');
</script>