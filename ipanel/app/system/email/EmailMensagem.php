<?php
//header("Content-Type: text/html; charset=ISO-8859-1");

//require_once("../ClienteCtrl.php");
/**
 * Description of EmailMensagem
 *
 * @author Cledson
 */

class EmailMensagem {

    //var $url = "http://www.ceinee.org.br/";
    var $url = "http://server-web/ceinee.org.br/";


    /**
     * Gera a mensagem de confirmação dos dados cadastrais
     * @param Empresa $empresa
     * @return string
     */
    public function getMsgCadastroEmpresa(Empresa $empresa, $admin=false)
    {
        $util = new Util();
        $password = new Password();
        $msg = $this->getStyle();
        $msg.= "<body>";
        $msg.= "<div id='conteudo'>";
        $msg.= "    <div class='top'>";
        $msg.= "        <img src='".$this->url."img/img_logo.gif' alt='Logomarca Ceinee' title='Ceinee / E-mail de Confirmação' /><br />";
        if($admin){
            $msg.= "        ".$empresa->razaoSocial;
        }else{
            $msg.= "        Ol&aacute;  ".$empresa->razaoSocial;
        }
        $msg.= "    </div>";
        $msg.= "    <div class='titulo'>";
        $msg.= "        <h1>Dados cadastrais - Ceinee.org.br</h1>";
        $msg.= "    </div>";
        $msg.= "    <div class='informacoes'>";
        if($admin){
            $msg.= "        <span class='fonte-negrito'>Um novo cadastro de empresa foi realizado em Ceinee.org.br.<br/>Abaixo seguem os dados principais da inscrição.</span><br><br>";
        }else{
            $msg.= "        <span class='fonte-negrito'>Seu cadastro no site Ceinee.org.br foi realizado com sucesso.<br/>Abaixo seguem seus dados para acesso á sua área restrita.</span><br><br>";
        }
        $msg.= "        Tipo de Login: Empresa <br>";
        $msg.= "        Razão Social:".$empresa->razaoSocial."<br>";
        $msg.= "        CNPJ:".$util->formatarCpfCnpj($empresa->cnpj)."<br>";
        $msg.= "        Senha: ".$password->deCript($empresa->senha)."<br/><br/>";
        $msg.= "        <a href='".$this->url."inc/gera_doc.php?id=".$empresa->id."&doc=proposta_convenio'>Clique aqui para gerar a proposta de convênio</a><br/><br/>";
        $msg.= "        <br/><br/>";
        $msg.= "    </div>";
        $msg.= "    <div class='rodape'>";
        $msg.= "        Visite o nosso portal: <span class='fonte-negrito fonte-vermelha'><a href='http://www.ceinee.org.br'>www.ceinee.org.br</a></span><br />";
        $msg.= "        <span class='fonte-negrito'>Favor não responder a esta mensagem.</span>";
        $msg.= "    </div>";
        $msg.= "</div>";
        $msg.= "</body>";
        return $msg;
    }




    /**
     * Gera a mensagem de confirmação dos dados cadastrais
     * @param Instituicao $instituicao
     * @return string
     */
    public function getMsgCadastroInstituicao(Instituicao $instituicao, $admin=false)
    {
        $util = new Util();
        $password = new Password();
        $msg = $this->getStyle();
        $msg.= "<body>";
        $msg.= "<div id='conteudo'>";
        $msg.= "    <div class='top'>";
        $msg.= "        <img src='".$this->url."img/img_logo.gif' alt='Logomarca Ceinee' title='Ceinee / E-mail de Confirmação' /><br />";
        if($admin){
            $msg.= "        ".$instituicao->nome;
        }else{
            $msg.= "        Ol&aacute;  ".$instituicao->nome;
        }
        $msg.= "    </div>";
        $msg.= "    <div class='titulo'>";
        $msg.= "        <h1>Dados cadastrais - Ceinee.org.br</h1>";
        $msg.= "    </div>";
        $msg.= "    <div class='informacoes'>";
        if($admin){
            $msg.= "        <span class='fonte-negrito'>Um novo cadastro de empresa foi realizado em Ceinee.org.br.<br/>Abaixo seguem os dados principais da inscrição.</span><br><br>";
        }else{
            $msg.= "        <span class='fonte-negrito'>Seu cadastro no site Ceinee.org.br foi realizado com sucesso.<br/>Abaixo seguem seus dados para acesso á sua área restrita.</span><br><br>";
        }
        $msg.= "        Tipo de Login: Instituição de Ensino <br>";
        $msg.= "        Instituição:".$instituicao->nome."<br>";
        $msg.= "        CNPJ:".$util->formatarCpfCnpj($instituicao->cnpj)."<br>";
        $msg.= "        Senha: ".$password->deCript($instituicao->senha)."<br/><br/>";
        $msg.= "        <a href='".$this->url."inc/gera_doc.php?id=".$instituicao->id."&doc=proposta_convenio_instituicao'>Clique aqui para gerar a proposta de convênio</a><br/><br/>";
        $msg.= "        <br/><br/>";
        $msg.= "    </div>";
        $msg.= "    <div class='rodape'>";
        $msg.= "        Visite o nosso portal: <span class='fonte-negrito fonte-vermelha'><a href='http://www.ceinee.org.br'>www.ceinee.org.br</a></span><br />";
        $msg.= "        <span class='fonte-negrito'>Favor não responder a esta mensagem.</span>";
        $msg.= "    </div>";
        $msg.= "</div>";
        $msg.= "</body>";
        return $msg;
    }




    /**
     * Gera a mensagem de confirmação dos dados cadastrais
     * @param Aluno $aluno
     * @return string
     */
    public function getMsgCadastroAluno(Aluno $aluno)
    {
        $util = new Util();
        $password = new Password();
        $msg = $this->getStyle();
        $msg.= "<body>";
        $msg.= "<div id='conteudo'>";
        $msg.= "    <div class='top'>";
        $msg.= "        <img src='".$this->url."img/img_logo.gif' alt='Logomarca Ceinee' title='Ceinee / E-mail de Confirmação' /><br />";
        $msg.= "        Ol&aacute;  ".$aluno->nome;
        $msg.= "    </div>";
        $msg.= "    <div class='titulo'>";
        $msg.= "        <h1>Dados cadastrais - Ceinee.org.br</h1>";
        $msg.= "    </div>";
        $msg.= "    <div class='informacoes'>";
        $msg.= "        <span class='fonte-negrito'>Seu cadastro no site Ceinee.org.br foi realizado com sucesso.<br/>Abaixo seguem seus dados para acesso á sua área restrita.</span><br><br>";
        $msg.= "        Tipo de Login: Aluno <br>";
        $msg.= "        Nome:".$aluno->nome."<br>";
        $msg.= "        Email:".$aluno->email."<br>";
        $msg.= "        CPF:".$util->formatarCpfCnpj($aluno->cpf)."<br>";
        $msg.= "        Senha: ".$password->deCript($aluno->senha)."<br/><br/><br/><br/>";
        $msg.= "    </div>";
        $msg.= "    <div class='rodape'>";
        $msg.= "        Visite o nosso portal: <span class='fonte-negrito fonte-vermelha'><a href='http://www.ceinee.org.br'>www.ceinee.org.br</a></span><br />";
        $msg.= "        <span class='fonte-negrito'>Favor não responder a esta mensagem.</span>";
        $msg.= "    </div>";
        $msg.= "</div>";
        $msg.= "</body>";
        return $msg;
    }


    /**
     * Gera a mensagem de contato
     * @param $contato Dados do contato
     * @return string
     */
    public function getMsgContato($contato)
    {
        $msg = $this->getStyle();
        $msg.= "<body>";
        $msg.= "<div id='conteudo'>";
        $msg.= "    <div class='top'>";
        $msg.= "        <img src='".$this->url."img/img_logo.gif' alt='Logomarca Amsop' title='Amsop / E-mail de Confirmação' /><br />";
        $msg.= "    </div>";
        $msg.= "    <div class='titulo'>";
        $msg.= "        <h1>Formulário de Contato - Amsop.com.br</h1>";
        $msg.= "    </div>";
        $msg.= "    <div class='informacoes'>";
        $msg.= "        <span class='fonte-negrito'>Abaixo seguem os dados do contato.</span><br><br>";
        $msg.= "        Nome:".$contato['nome']."<br>";
        $msg.= "        Endereço:".$contato['endereco']." nº:".$contato['numero']."<br>";
        $msg.= "        Cidade: ".$contato['cidade']."<br/>";
        $msg.= "        Telefone: ".$contato['telefone']."<br/>";
        $msg.= "        Email: ".$contato['email']."<br/>";
        $msg.= "        Mensagem: ".$contato['mensagem']."<br/><br/><br/><br/>";
        $msg.= "    </div>";
        $msg.= "    <div class='rodape'>";
        $msg.= "        Visite o nosso portal: <span class='fonte-negrito fonte-vermelha'><a href='http://www.amsop.com.br'>www.amsop.com.br</a></span><br />";
        $msg.= "    </div>";
        $msg.= "</div>";
        $msg.= "</body>";
        return $msg;
    }

    /**
     * Gera a folha de estilos padrão par ao envio das mensagens
     * @return string
     */
    public function getStyle(){
        
        $style = "<style type='text/css'>

                    body
                            {margin:10px;
                            font-family:verdana;
                            line-height:19px}

                    #conteudo
                            {width:567px;
                            border:1px solid #cccccc;
                            padding:15px;
                            margin:auto;}

                    #conteudo .fonte-negrito
                            {font-weight:bold;}

                    #conteudo .fonte-vermelha
                            {color:#da251c;}

                    #conteudo .top
                            {width:inherit;
                            min-height:105px;
                            font-size:14px;
                            font-weight:bold;
                            float:left;}

                    #conteudo .top img
                            {margin-bottom:10px;}

                    #conteudo .titulo
                            {width:inherit;
                            height:100px;
                            background:url(".$this->url."img/email_fundo_titulo.gif) repeat-x;
                            margin:0 0 10px 0;
                            float:left;}

                    #conteudo .titulo h1
                            {font-family:calibri;
                            font-size:28px;
                            margin:12px 0 0 0;
                            float:left;}

                    #conteudo .informacoes
                            {width:549px;
                            border:1px solid #cccccc;
                            background:#F5F5F5;
                            padding:8px;
                            font-size:13px;
                            float:left;}

                    #conteudo .informacoes .pula-linha
                            {margin:10px 0 0 0;
                            display:block;}

                    #conteudo .rodape
                            {width:inherit;
                            height:44px;
                            text-align:center;
                            margin:15px 0 0 0;
                            font-size:14px;
                            float:left;}

                    #conteudo .rodape a
                            {color:inherit;
                            color:expression(
                            this.parentNode.currentStyle.color ?
                            this.parentNode.currentStyle.color :'');}

                    </style>";
       return $style;
    }
}
?>
