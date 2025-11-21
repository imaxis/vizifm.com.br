<?php

session_start();
require_once("../../core/config.php");
include "../GenericCtrl.php";
include "../../system/LoginCtrl.php";

if($_POST['Action'] == "Login"){

    $loginCtrl = new LoginCtrl();
    $status = $loginCtrl->loginPremioAmsop($_POST['email'], $_POST['senha']);
    if($status){
        print "<meta http-equiv='refresh' content='0;URL=../../../premio_painel.php'>";
    }else{
        header("Location:../../../premio_login.php?login=false");
    }
}
?>