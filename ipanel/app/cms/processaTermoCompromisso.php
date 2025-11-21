<?php

require_once("../core/config.php");
require_once(APP_PATH."/cms/restritoIPanel.php");
require_once(APP_PATH."/controller/GenericCtrl.php");
require_once(APP_PATH."/util/Util.php");
require_once(APP_PATH."/util/Data.php");

$util = new Util();
$data = new Data();
$control = new GenericCtrl("TermoCompromissoEstagio");
$vagaCtrl = new GenericCtrl("Vaga");
$vaga = $vagaCtrl->getObject($_POST['vagId']);


//
// Caso o Action seja do tipo Form, vindo de uma inclusão e /ou edição de registro
// Copia os dados enviados pelo formulario para os campos correspondentes no objeto
//
if($_POST['action'] == "Form"){
    if($_POST['id'] != ""){
         $termoCompromisso = $control->getObject($_POST['id']);
         $termoId = $_POST['id'];
    }else{
        $termoCompromisso = $control->getObjectByFields(array("aluId", "vagId"), array($_POST['aluId'], $_POST['vagId']));
        if(!is_object($termoCompromisso)){
            $termoCompromisso = new TermoCompromissoEstagio();
            $getLastId = true;
            $escritorio = $vaga['empresa']['escritorio'];
            $ultimoTermoCompromisso = $control->getObjectByField("vaga.empresa.escId", $escritorio['id'], true, 1, 0, "codigo DESC");
            if(!is_object($ultimoTermoCompromisso)){
                $codigo = $escritorio['codigoDoc'].$util->addZeros(1, 9);
            }else{
                $codigo = $ultimoTermoCompromisso + 1;
            }
            $termoCompromisso->codigo = $codigo;

            
            //
            // Verifica o número de vagas disponíveis.
            // Caso esta seja a última vaga, o registra referente a vaga tem seu status alterado para P (Preenchida)
            //
            $termosCompromissoVaga = $control->getObjectByField("vagId", $_POST['vagId']);
            if((count($termosCompromisso) + 1) == $vaga['qtde']){
                $vaga->status = "P";
                $vaga->save();
            }
        }else{
            $termoId = $termoCompromisso[0]['id'];
            $termoCompromisso = $termoCompromisso[0];
        }
    }


    
    $termoCompromisso->aluId = $_POST['aluId'];
    $termoCompromisso->vagId = $_POST['vagId'];
    $termoCompromisso->atividades = $_POST['atividades'];
    $termoCompromisso->coordenador = $_POST['coordenador'];
    $termoCompromisso->horario = $_POST['horario'];
    $termoCompromisso->setor = $_POST['setor'];
    $termoCompromisso->insId = $_POST['insId'];
    $termoCompromisso->dtGeracao = date("Y-m-d");
    $termoCompromisso->inicioVigencia = $data->convertDateBRtoDateSQL($_POST['inicioVigencia']);
    $termoCompromisso->fimVigencia = $data->convertDateBRtoDateSQL($_POST['fimVigencia']);
    $termoCompromisso->valorBolsa = $util->formatFloat($_POST['valorBolsa']);
    $termoCompromisso->save();
    
    if($getLastId){
        $termoId = $control->getLastId();
    }
    
    header("Location:../../view/confirmacao.php?lc=".$_GET['lc']."&id=".$termoId);
}
?>
