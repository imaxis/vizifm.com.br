<?php

require_once("../core/config.php");
require_once(APP_PATH."/cms/restritoIPanel.php");
require_once(APP_PATH."/controller/GenericCtrl.php");
require_once(APP_PATH."/util/Util.php");
require_once(APP_PATH."/util/Data.php");

$util = new Util();
$data = new Data();
$control = new GenericCtrl("Encaminhamento");


//
// Caso o Action seja do tipo Form, vindo de uma inclusão e /ou edição de registro
// Copia os dados enviados pelo formulario para os campos correspondentes no objeto
//
if($_POST['action'] == "Form"){  
    if($_POST['id'] != ""){
         $encaminhamento = $control->getObject($_POST['id']);
         $encId = $_POST['id'];
    }else{
        $encaminhamento = $control->getObjectByFields(array("aluId", "vagId"), array($_POST['aluId'], $_POST['vagId']));
        if(!is_object($encaminhamento)){
            $encaminhamento = new Encaminhamento();
            $getLastId = true;  
        }else{
            $encId = $encaminhamento[0]['id'];
        }
    }
    $encaminhamento->aluId = $_POST['aluId'];
    $encaminhamento->vagId = $_POST['vagId'];
    $encaminhamento->dtCadastro = date("Y-m-d");
    $encaminhamento->save();
    if($getLastId){
        $encId = $control->getLastId();
    }
    
    header("Location:../../view/confirmacao.php?lc=".$_GET['lc']."&id=".$encId);
}
?>
