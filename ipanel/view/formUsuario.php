<?
/*****************************************************************************************************
*                                                                                                    *
*                              Arquivo de Controle Geral                                             *
*                            Desenvolvido por Agência Studio iMAXIS                                  *
*                                                                                                    *
*****************************************************************************************************/

if(!class_exists('Data'))
    require_once(APP_PATH."/util/Data.php");
$data = new Data();

if(!class_exists('Util'))
    require_once(APP_PATH."/util/Util.php");
$util = new Util();

if($this->controlClass == "GenericCtrl"){
    $control = new GenericCtrl($this->getArea());
}else{
    $control = new $this->controlClass;
}
if(!empty($_GET['id'])){
    $object = $control->getObject($_GET['id']);
}else{
    $object = new Usuario();
    $collection = new Doctrine_Collection("Permissao");
    $object->permissoes = $collection;
}


?>
<script src="../js/ajax.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="../js/lytebox.js"></script>
<link rel="stylesheet" href="css/lytebox.css" type="text/css" media="screen"/>
<div class="lt" style="padding-bottom:0px!important;">
  <div class="lt_topo">
    <div class="lt_menu_topo form_top">
      <h1><?= $this->getCurrentTitle() ?></h1>
      <ul>
        Formulário de inclusão / edição de usuário.
        <div class="clear"></div>
      </ul>
      <div class="clear"></div>
    </div>
  </div>
  <div class="stage_formulario">

    <form action="../app/cms/processa.php?lc=<?= $this->getArea() ?><?= $this->getParameters($_GET) ?>" enctype="multipart/form-data" method="post" name="formreg" id="formreg">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
    <input type="hidden" name="action" value="User" />
    <input type="hidden" name="tipoSubmit" value="" />

      <div class="box_forms">
        <div class="title_forms">
          
          <span class="sptl">Atenção! Os campos em <strong>negrito</strong> são obrigatórios.<br/>
          Clique em <strong>Confirmar</strong> após preencher corretamente o formulário abaixo para salvar o registro atual.</span>
          <br/><br/>
          <a title="Listar Registros" href="?lc=<?= $this->getArea() ?>&md=Lista<?= $this->getParameters($_GET) ?>" class="bt_azul">Retornar a Lista</a>
        </div>

       <!-- INICIO FORM -->
       <?= $this->writeForm($object); ?>
       <!-- FIM FORM -->

    
        <ul> <span class="sptl" align="left"><strong>Permissões de Acesso</strong></span><div class="clear"></div></ul>
        <div class="inputs_form">

        <!-- INICIO FORM PERMISSÕES -->
        <? $this->writeActionsForm($object['permissoes']) ?>
        <!-- FIM FORM PERMISSÕES -->

        </div>    

        <div class="clear">
          <p class="right"><input name="Submit" type="Submit" class="bt_input" value="Confirmar" onclick="document.formreg.tipoSubmit.value= 'P'"/></p>
          <div class="clear"></div>
        </div>
      </div>
    </form>
  </div>
  <div class="clear"></div>
</div>
<span class="stcl"></span> <span class="stcr"></span>
<div class="clear"></div>