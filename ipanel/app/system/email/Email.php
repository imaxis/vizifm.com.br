<?php

//include "SMTP.php";
include "PHPGMailer.php";


class Email {

    private $smtp         = "mail.studioimaxis.com";
    private $emailDestino = "cledson@imaxis.com.br";
    private $emailOrigem  = "imaxis@studioimaxis.com";
    private $loginSmtp    = "imaxis@studioimaxis.com";
    private $senhaSmtp    = "imxmail";
    private $mail;
    private $subject      = "";


    /**
     * Construtor padrão
     * Inicializa a conexao á base de dados
     * Efetua a leitura de acordo com a inicialização desejada
     */
    public function __construct()
    {
        $this->mailer = new PHPGMailer();
        $this->mailer->SetLanguage("br", "language/");
        $this->mailer->Username = 'envio@imaxis.com.br';
        $this->mailer->Password = 'rvnaxqrnqvvwlkcj';
        $this->mailer->From = $fromAddress;
        $this->mailer->FromName = 'Site vizifmnovo.com.br';
        $this->mailer->IsHTML(true);
    }


    public function addEmail($email)
    {
        $this->mailer->AddAddress($email);
    }

    public function setAssunto($assunto)
    {
        $this->mailer->Subject = $assunto;
    }

    public function setNomeRemetente($remetente)
    {
        $this->mailer->FromName = $remetente;
    }
    
    public function setMensagem($mensagem)
    {
        $this->mailer->Body = $mensagem;
    }


    public function envia()
    {
        if(!$this->mailer->Send())
            return false;
        else
            return true;
    }

}
?>
