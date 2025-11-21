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

if($this->controlClass == "GenericCtrl"){
    $control = new GenericCtrl($this->getArea());
}else{
    $control = new $this->controlClass;
}
$object = $control->getObject($_GET['id']);
?>
<div class="lt" style="padding-bottom:0px!important;">
  <div class="lt_topo">
    <div class="lt_menu_topo form_top">
      <h1><?= $this->getCurrentTitle() ?></h1>
      <ul>
        Formulário de inclusão / edição de registro.
        <div class="clear"></div>
      </ul>
      <div class="clear"></div>
    </div>
  </div>
  <div class="stage_formulario">

    <form action="<?= $this->getActionFormUrl($_GET) ?>" enctype="multipart/form-data" method="post" name="formreg" id="formreg">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
    <input type="hidden" name="action" value="Form" />
    <input type="hidden" name="tipoSubmit" value="" />

      <div class="box_forms">
        <div class="title_forms">
          
          <span class="sptl"><?= $this->menu->getCurrentFormDescription() ?></span>
          <br/><br/>
          <a title="Listar Registros" href="?lc=<?= $this->getArea() ?>&md=Lista<?= $this->getParameters($_GET) ?>" class="bt_azul">Retornar a Lista</a>
        </div>
 
       <!-- INICIO FORM -->
       <?= $this->writeForm($object); ?>
       <!-- FIM FORM -->

       <!--
        <div class="inputs_form">

          <div class="sptl_fieldname">
                Data:
          </div>
          <div class="input_titulo">
              <input id="data" name="data" class="fields_form_date" value="< ?= $data->convertDateSQLtoDateBR($object['notData']) ?>" size="11" />
              <span class="cont_text1"> Formato dd/mm/aaaa </span>
          </div>

          <div class="sptl_fieldname">
                Tipo:
          </div>
          <div class="input_titulo">
              <select id="tipo" name="tipo" class="fields_form_select">
                  <option value="1">Opção 01</option>
                  <option value="2">Opção 03</option>
              </select>
          </div>

          <div class="sptl_fieldname">
                Título:
          </div>
          <div class="input_titulo">
            <input id="titulo" name="titulo" class="fields_form_large" onKeyUp="javascript:countChars('caracter_titulo')" value="< ?= $object['titulo'] ?>" />
            <div class="cont_right"> <span id="caracter_titulo" class="cont_text1"> ** </span> <span class="cont_text2"> caracteres </span> </div>
          </div>


          <div class="sptl_fieldname">
                Resumo:
          </div>
          <div class="input_titulo">
            <input id="resumo" name="resumo" class="fields_form_large" onKeyUp="javascript:countChars('caracter_resumo')" />
            <div class="cont_right"> <span id="caracter_resumo" class="cont_text1"> ** </span> <span class="cont_text2"> caracteres </span> </div>
          </div>

          <div class="sptl_fieldname">
               Foto (Capa):
          </div>
          <div class="input_titulo">
               <input id="foto" name="foto" type="file" class="fields_form_large" />
          </div>

          <div class="sptl left">
                Conteúdo:
          </div> 
           <div class="editor_form">
                <textarea name="content" style="width:100%"></textarea>
           </div>
            
        <div class="sptl_fieldname">
                Fonte:
        </div>
        <div class="input_titulo">
           <input id="fonte" name="fonte" class="fields_form_large"/>
        </div>
            

        </div>
       -->


          


        <div class="clear">
            <!--<p class="left"><input name="Submit" type="Submit" class="bt_input" value="Salvar Rascunho" onclick="document.formreg.tipoSubmit.value= 'R'" /></p> -->
          <p class="right"><input name="Submit" type="Submit" class="bt_input" value="Confirmar" onclick="document.formreg.tipoSubmit.value= 'P'"/></p>
        </div>
      </div>
    </form>
  </div>
  <div class="clear"></div>
</div>
<span class="stcl"></span> <span class="stcr"></span>
<div class="clear"></div>
