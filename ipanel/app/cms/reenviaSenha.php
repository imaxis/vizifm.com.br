<?php
    header('Content-type: text/html; charset="iso-8859-1"',true);
    require_once("../core/config.php");
    require_once(APP_PATH."/controller/GenericCtrl.php");
    require_once(APP_PATH."/system/email/Email.php");
    require_once(APP_PATH."/system/email/EmailMensagem.php");

    if(!empty($_GET['email'])){
        $status = false;
        $usuarioCtrl = new GenericCtrl("Usuario");
        if(!empty($_GET['email'])){
            $usuario = $usuarioCtrl->getObjectByField("email", $_GET['email'], true, 1);
            if($usuario[0]['email'] == $_GET['email']){
                $status = true;
                $usuario = $usuarioCtrl->getObject($usuario[0]['id']);
            }
        }

        if($status){
            // Envio do email para confirmação do cliente
            $email = new Email();
            $email->addEmail($usuario['email']);
            $email->setAssunto("Recuperação de Senha - Sistema IPanel");
            $email->setNomeRemetente("Kacopneus.com.br");
            $msg  =  new EmailMensagem();
            $email->setMensagem($msg->getMsgSenhaUsuario($usuario));
            $email->envia();
        }
        $array = array("status" => $status, "email" => $usuario['email']);
        $json = json_encode($array);
        echo $json;
    }



?>
