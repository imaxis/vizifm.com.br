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

   $ipanel = new IPanelApp();
   $ipanel -> setArea($_GET['lc']);           // seta o local atual a ser mostrado
   $ipanel->setConfig();
   $ipanel->setMenu();

  /* foreach($_SESSION['permissoes'] as $permissao){
       echo $permissao['local']." : ".$permissao['acao']."<br>";
   }*/

  // $VerifAcesso = (($_GET['Lc'] == "Usuarios") ||($_GET['Lc'] == "Backup")||($_GET['Lc'] == "Revendas"))?"Sistema":$_GET['Lc'];
 //  Permissao($VerifAcesso,$User_Permissao);   // Verifica se o usuário tem permissão de acesso a esta área

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CMS - Setor Administrativo iPanel 3.0</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script src="../js/ipanel.js"    type="text/javascript" language="javascript"></script>
<script src="../js/validator.js" type="text/javascript" language="javascript"></script>
<script src="../js/mask.js"      type="text/javascript" language="javascript"></script>
<script src="../js/validatorFunctions.js"   type="text/javascript" language="javascript"></script>
<script src="../js/funcoes.js"   type="text/javascript" language="javascript"></script>
<script src="../js/tiny_mce/tiny_mce.js" type="text/javascript" ></script>
<script type="text/javascript" src="../js/tiny_mce/tiny_mce_init.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
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


                    <div class="lt" style="padding-bottom:0px!important;">
                      <div class="lt_topo">
                        <div class="lt_menu_topo form_top">
                          <h1><?= $ipanel->getCurrentTitle() ?></h1>
                          <ul>
                            <?= $ipanel->getMenu()->getCurrentConfirmationDescription() ?>
                            <div class="clear"></div>
                          </ul>
                          <div class="clear"></div>
                        </div>
                      </div>
                      <div class="stage_formulario">


                      <? if($_GET['lc'] == "Encaminhamento"){ ?>
                          <div class="box_forms">
                            <div class="title_forms">
                              <span class="sptl">Atenção! Clique em <strong>visualizar encaminhamento</strong> para gerar o arquivo de encaminhamento de estágio.
                              <br/>Clique em <strong>novo encaminhamento</strong> para gerar um novo registro ou visualize todos os registros clicando em <strong>retornar a lista.</strong></span>
                              <br/><br/>
                              <a title="Retornar a Lista" href="../view/?lc=<?= $_GET['lc'] ?>&md=Lista<?= $ipanel->getParameters($_GET) ?>" class="bt_azul">Retornar a Lista</a>
                              <a title="Novo encaminhamento" href="../view/?lc=<?= $_GET['lc'] ?>&md=Form<?= $ipanel->getParameters($_GET) ?>" class="bt_azul">Novo Encaminhamento</a>
                              <a title="Visualizar Encaminhamento" href="../../inc/gera_doc.php?id=<?= $_GET['id'] ?>&doc=encaminhamento_aluno" target="blank" class="bt_azul">Visualizar Encaminhamento</a>
                            </div>
                          </div>
                       <? } ?>



                      <? if($_GET['lc'] == "TermoCompromissoEstagio"){ ?>
                          <div class="box_forms">
                            <div class="title_forms">
                              <span class="sptl">Atenção! Clique em <strong>visualizar termo de compromisso</strong> para gerar o arquivo em PDF.
                              <br/>Clique em <strong>novo termo de compromisso</strong> para gerar um novo registro ou visualize todos os registros clicando em <strong>retornar a lista.</strong></span>
                              <br/><br/>
                              <a title="Retornar a Lista" href="../view/?lc=<?= $_GET['lc'] ?>&md=Lista<?= $ipanel->getParameters($_GET) ?>" class="bt_azul">Retornar a Lista</a>
                              <a title="Novo termo de compromisso" href="../view/?lc=<?= $_GET['lc'] ?>&md=Form<?= $ipanel->getParameters($_GET) ?>" class="bt_azul">Novo Termo de Compromisso</a>
                              <a title="Visualizar Documento" href="../../inc/gera_doc.php?id=<?= $_GET['id'] ?>&doc=termo_compromisso_estagio" target="blank" class="bt_azul">Visualizar Termo de Compromisso</a>
                            </div>
                          </div>
                       <? } ?>

                      </div>
                      <div class="clear"></div>
                    </div>
                    <span class="stcl"></span> <span class="stcr"></span>
                    <div class="clear"></div>


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