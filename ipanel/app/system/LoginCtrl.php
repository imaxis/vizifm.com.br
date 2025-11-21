<?php
/**
 *  LoginCtrl.php
 *  Classe de controle de login
 *
 *  Pertencente ao pacote application.system
 *
 *  Copyright (C) 2011  iMAXIS Soluções Digitais Ltda
 *  Autor: Cledson Lodi
 *
 *  Criado em 06/09/2011
 */
require_once(APP_PATH."/controller/BaseController.php");
require_once(APP_PATH."/controller/GenericCtrl.php");
require_once(APP_PATH."/system/Password.php");
require_once(APP_PATH."/controller/AcessoCtrl.php");

class LoginCtrl extends BaseController {

    var $model = "Usuario";


    /**
     * Construtor principal
     * Inicia a classe principal de controle informando o Modelo Atual
     */
    public function __construct() {
    //    Doctrine::createTablesFromModels();
        parent::setConnection($this->model);
    }
    

    /*
     * Valida o login para acesso ao setor administrativo
     *
     * @param String $loginUser       Login do usuário
     * @param String $passwordUser    Senha do Usuário
     *
     * @return Boolean
     */
    public function login($loginUser, $passwordUser) {
        $password = new Password();
        $acessoCtrl = new AcessoCtrl();
        $status = "false";
        $q = Doctrine_Query::create()->from("Usuario u")
                           ->where("u.login = ?", $loginUser)
                           ->orderBy("u.id DESC")
                           ->limit(1);
        $user = $q->fetchOne();
        if(is_object($user)){
            if($passwordUser == $password->deCript($user->senha)){
                if($user['status'] == "A"){
                    //session_start();
                    $status = "true";
                    $acesso = $acessoCtrl->getLastAcessoByUser($user->id);
                    $acessoCtrl->saveAcesso($user->id);
                    $permissaoCtrl = new GenericCtrl("Permissao");
                    $permissoes = $permissaoCtrl->getObjectByField("usrId", $user->id);
                    $config = new IPanelConfig(); 
                    $_SESSION['userId']       = $user->id;
                    $_SESSION['userLogin']    = $user->login;
                    $_SESSION['userNome']     = $user->nome;
                    $_SESSION['permissoes']   = serialize($permissoes);
                    $_SESSION['ultimoAcesso'] = $acesso['ultimoAcesso'];
                    $_SESSION['nroAcessos']   = $acesso['nroAcessos'];
                    $_SESSION['permitido']    = $status;
                    $_SESSION['setores']      = $config->getConfig();
                }else{
                    $status = "inativo";
                }
            }
        }
        return $status;
    }



    /*
     * Valida o login para acesso ao site
     *
     * @param String $loginTipo       Tipo de login
     * @param String $loginUser       Login do usuário
     * @param String $passwordUser    Senha do Usuário
     *
     * @return Boolean
     */
    public function loginSite($loginTipo, $loginUser, $passwordUser) {
        $password = new Password();
        $status = false;

        //
        // Caso seja login de aluno
        //
        if($loginTipo == "Aluno"){
            $q = Doctrine_Query::create()->from("Aluno a")
                               ->where("a.cpf = ?", $loginUser)
                               ->orderBy("a.id DESC")
                               ->limit(1);
            $aluno = $q->fetchOne();
            if(is_object($aluno)){
                if($passwordUser == $password->deCript($aluno->senha)){
                    $status = true;
                    $id   = $aluno->id;
                    $nome = $aluno->nome;
                    $cpf  = $aluno->cpf;
                    $email = $aluno->email;
                }
            }
        }

        //
        // Caso seja login de empresa
        //
        if($loginTipo == "Empresa"){
            $q = Doctrine_Query::create()->from("Empresa e")
                               ->where("e.cnpj = ?", $loginUser)
                               ->orderBy("e.id DESC")
                               ->limit(1);
            $empresa = $q->fetchOne();
            if(is_object($empresa)){
                if($passwordUser == $password->deCript($empresa->senha)){
                    $status = true;
                    $id    = $empresa->id;
                    $nome  = $empresa->razaoSocial;
                    $cnpj  = $empresa->cnpj;
                    $email = $empresa->email;
                }
            }
        }

        //
        // Caso seja login de instituição
        //
        if($loginTipo == "Instituição"){
            $q = Doctrine_Query::create()->from("Instituicao i")
                               ->where("i.cnpj = ?", $loginUser)
                               ->orderBy("i.id DESC")
                               ->limit(1);
            $instituicao = $q->fetchOne();
            if(is_object($instituicao)){
                if($passwordUser == $password->deCript($instituicao->senha)){
                    $status = true;
                    $id    = $instituicao->id;
                    $nome  = $instituicao->nome;
                    $cnpj  = $instituicao->cnpj;
                    $email = $instituicao->email;
                }
            }
        }

        if($status){
            session_start();
            $_SESSION['CadId']    = $id;
            $_SESSION['CadNome']  = $nome;
            $_SESSION['CadCPF']   = $cpf;
            $_SESSION['CadEmail'] = $email;
            $_SESSION['CadCNPJ']  = $cnpj;
            $_SESSION['CadNivel'] = $loginTipo;
        }
        return $status;
    }




}

?>
