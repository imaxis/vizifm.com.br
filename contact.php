<?php

include "load_ipanel.php";

header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "ERROR";
    exit;
}

function sanitize_field($key, $placeholder = '')
{
    if (!isset($_POST[$key])) {
        return '';
    }

    $value = trim($_POST[$key]);

    if ($placeholder !== '' && strcasecmp($value, $placeholder) === 0) {
        return '';
    }

    return $value;
}

$nome = sanitize_field('name', 'Nome Completo');
$cidade = sanitize_field('cidade', 'Cidade');
$musica = sanitize_field('musica', 'Musica');
$mensagem = sanitize_field('content', 'Mensagem');

if ($nome === '' || $cidade === '' || $musica === '' || $mensagem === '') {
    echo '<div class="notification_error">Por favor, preencha todos os campos obrigatórios.</div>';
    exit;
}

$body = "
        <html>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <title>Pedidos e Recados Vizi FM</title>
                <style type='text/css'>
                    * {
                        font-family: Verdana, Arial, Helvetica, sans-serif;
                        font-size: 12px;
                        text-decoration: none;
                    }
                    #area-contato-email {
                        min-width: 280px;
                        min-height: 20px;
                        padding: 10px;
                        border: 1px #CCCCCC solid;
                        background: #fff;
                    }
                    p {
                        line-height: 18px;
                        color: #444;
                        margin: 0;
                    }
                    span.label {
                        font-weight: bold;
                    }
                </style>
            </head>
            <body>
                <div id='area-contato-email'>
                    <p>Mensagem recebida pelo formulário de contato do site vizifmnovo.com.br</p>
                    <br/>
                    <p><span class='label'>Nome:</span> {$nome}</p>
                    <p><span class='label'>Cidade:</span> {$cidade}</p>
                    <p><span class='label'>Música:</span> {$musica}</p>
                    <p><span class='label'>Mensagem:</span> {$mensagem}</p>
                    <br/>
                    <p><span class='label'>IP de origem:</span> " . getenv("REMOTE_ADDR") . "</p>
                </div>
            </body>
        </html>";

try {
    $email = new Email();
    $email->addEmail("maikonicaro04@gmail.com");
    $email->setAssunto("Pedidos e Recados: Vizi FM");
    $email->setNomeRemetente("Site Vizi FM");
    $email->setMensagem($body);

    if ($email->envia()) {
        echo "OK";
    } else {
        echo '<div class="notification_error">Não foi possível enviar sua mensagem. Tente novamente em instantes.</div>';
    }
} catch (Exception $e) {
    error_log("Erro ao enviar contato: " . $e->getMessage());
    echo '<div class="notification_error">Não foi possível enviar sua mensagem. Tente novamente em instantes.</div>';
}
?>

