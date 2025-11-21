<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>CMS - Setor Administrativo iPanel 3.0 - Acesso Restrito</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="js/ipanel.js"></script>
        <script src="js/login.js"></script>
        <script src="js/validator.js"></script>
        <link href="view/css/style.css" rel="stylesheet" type="text/css" />
        <link href="view/css/login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="login">
            <div class="login_info left">
                <div class="img_logo"><a href="index.php"><img src="view/img/logo_cms.png" title="Ipanel 3.0" /></a></div>
                <h1>Gerencie os conteúdos do seu site de forma fácil e ágil!</h1>
                <h3 style="padding-left: 25px;">O iPanel é um gerenciador de conteúdo intuitivo, eficiente, útil e com a finalidade 
                    de manter seu site atualizado e atrativo.</h3>
                <ul>
                    <li>
                        <img src="view/img/ico_time.png" />
                        <h2>Poupe Tempo</h2>
                        <h3>Processo de cadastro eficiente que permite a rápida inclusão da informação.</h3>
                    </li>
                    <li>
                        <img src="view/img/ico_search.png" />
                        <h2>Rápida Localização</h2>
                        <h3>Encontre facilmente registros antigos com a utilização de filtros específicos.</h3>
                    </li>
                    <li>
                        <img src="view/img/ico_infor.png" />
                        <h2>Informação Completa</h2>
                        <h3>Maior inclusão de dados sobre os arquivos e artigos.</h3>
                    </li>
                </ul>
            </div>
            <div class="box_login right">
                <div class="box_form">
                    <h1>Acesse sua conta</h1>
                    <h2 id="msgAlerta">Digite o login e senha fornecidos pelo Administrador</h2>
                    <div class="alerting" id="loading" style="display:none">
                        <img src="view/img/loading.gif" />
                    </div>
                    <form id="formlogin" name="formlogin">
                        <fieldset id="dadosLogin">
                            <label for="usuario" type="text">Usuário:</label>
                            <input name="usuario" id="usuario" class="userlogon" value="" />
                            <label for="senha">Senha:</label>
                            <input name="senha" id="senha" type="password" value="" />
                        </fieldset>
                        <fieldset id="dadosLembrarSenha" style="display:none">
                            <label for="email" type="text">Email</label>
                            <input name="email" id="email" class="userlogon" />
                        </fieldset>
                        <span id="btLogar"><a id="logar" class="bt_azul">Entrar</a></span>
                        <span id="btLembrar" style="display:none"><a id="lembrar" class="bt_azul">Enviar</a></span>
                        <h3><a href="senha.php">Não consegue acessar sua conta?</a></h3>
                        <p style="display:none" id="retornaLogin">
                        	<h3 style="display:none">
                            	<a style="display:none" id="lnkRetornaLogin" href="javascript:;">
                                	Retornar ao login
                                </a>
                            </h3>
                        </p>
                        <p id="lembrarSenha"><h3><a id="lnkLembrarSenha" href="javascript:;">Esqueceu sua senha?</a></h3></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>