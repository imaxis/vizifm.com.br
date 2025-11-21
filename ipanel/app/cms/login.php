<?php
    session_start();
    require_once("../core/config.php");
    require_once(APP_PATH."/system/LoginCtrl.php");

    if ($_GET['action'] == "Login") {
        $loginCtrl = new LoginCtrl();
        $resultLogin = $loginCtrl->login($_POST['usuario'], $_POST['senha']);
        if ($resultLogin){
             print "true";
        } else {
             print "false";
        }
    }
?>