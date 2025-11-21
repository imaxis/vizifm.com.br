<?php

require_once("../../application/core/config.php");
require_once(ADMIN_PATH."/app/restritoAdmin.php");
require_once(APP_PATH."/system/admin/AreaConfig.php");

$config = new AreaConfig($_GET['Lc']);
$arrayCampos = array();
foreach ($config->getFields() as $campos){
    foreach($campos as $campo => $valor){
        if($valor['search']){
            array_push($arrayCampos, array("campo" => $campo, "nome" => utf8_encode($valor['name'])));
        }
    }
}
$arrayReturn = array("campos" => $arrayCampos);
$json = json_encode($arrayReturn);
echo $json;
?>
