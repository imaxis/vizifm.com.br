<?php
session_start();
if($_POST['Action'] == "Contato"){

    require_once("../../core/config.php");
    include "../../system/email/Email.php";
    include "../../system/email/EmailMensagem.php";

    $contato = array("nome"     => $_POST['nome'],
                     "endereco" => $_POST['endereco'],
                     "numero"   => $_POST['numero'],
                     "cep"      => $_POST['cep'],
                     "cidade"   => $_POST['cidade'],
                     "telefone" => $_POST['telefone'],
                     "email"    => $_POST['email'],
                     "mensagem" => $_POST['mensagem']);

    // Envia email de confirmação
    $email = new Email();
    $email->addEmail($_POST['emails']);
    $email->setAssunto("Contato: Amsop.com.br");
    $email->setNomeRemetente("Amsop.com.br");
    $msg = new EmailMensagem();
    $email->setMensagem($msg->getMsgContato($contato));
    $email->envia();

       
    // Direciona para o arquivo de confirmação de envio de email
    header("Location:../../../contato_confirma.php");
}
?>