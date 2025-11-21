<?php
error_reporting(0);

if ($_POST['action'] == 'promo') {
    include "load_ipanel.php";
    
    $inscricaoCtrl = new GenericCtrl("Inscricao");
    $promocaoCtrl = new GenericCtrl("Promocao");
    $promocao = $promocaoCtrl->getObject($_POST['promocaoId']);
    
    if (!$promocao) {
        echo "ERROR";
        exit;
    }
    
    // Verificar se já está inscrito
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : null;
    
    // Verificar duplicação
    $inscricoesExistentes = $inscricaoCtrl->getObjectByFields(
        array('proId', 'telefone'),
        array($_POST['promocaoId'], $telefone),
        false,
        0,
        0,
        'id DESC'
    );
    
    if (!empty($inscricoesExistentes)) {
        echo "DUPLICATE";
        exit;
    }
    
    // Verificar aniversariante da semana
    if ($promocao->aniverSemana == 'S') {
        $nascimento = isset($_POST['nascimento']) ? $_POST['nascimento'] : '';
        if ($nascimento) {
            $pos = strripos($nascimento, "-");
            if ($pos === false) {
                list($d, $m, $y) = explode("/", $nascimento);
            } else {
                list($y, $m, $d) = explode("-", $nascimento);
            }
            
            $diaInicio = '';
            $diaFinal = '';
            
            if (date('w') == 0) {
                $diaInicio = -1;
                $diaFinal = 5;
            } else if (date('w') == 1) {
                $diaInicio = -2;
                $diaFinal = 4;
            } else if (date('w') == 2) {
                $diaInicio = -3;
                $diaFinal = 3;
            } else if (date('w') == 3) {
                $diaInicio = -4;
                $diaFinal = 2;
            } else if (date('w') == 4) {
                $diaInicio = -5;
                $diaFinal = 1;
            } else if (date('w') == 5) {
                $diaInicio = -6;
                $diaFinal = 0;
            } else if (date('w') == 6) {
                $diaInicio = 0;
                $diaFinal = 6;
            }
            
            $nascimentoSQL = $y . "-" . $m . "-" . $d;
            $aniversarioIni = date("Y") . "-" . $m . "-" . $d . " 00:00:00";
            $aniversarioFim = date("Y") . "-" . $m . "-" . $d . " 23:59:59";
            
            if (!(strtotime($aniversarioFim) >= strtotime($diaInicio . ' days') && strtotime($aniversarioIni) <= strtotime($diaFinal . ' days'))) {
                echo "SEMANA";
                exit;
            }
        } else {
            echo "SEMANA";
            exit;
        }
    }
    
    // Criar objeto Inscricao
    $inscricao = new Inscricao();
    $inscricao->proId = $_POST['promocaoId'];
    $inscricao->nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $inscricao->telefone = $telefone;
    $inscricao->cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : '';
    
    // Campos opcionais
    if (isset($_POST['nascimento']) && !empty($_POST['nascimento'])) {
        $nascimento = $_POST['nascimento'];
        $pos = strripos($nascimento, "-");
        if ($pos === false) {
            list($d, $m, $y) = explode("/", $nascimento);
        } else {
            list($y, $m, $d) = explode("-", $nascimento);
        }
        $inscricao->nascimento = $y . "-" . $m . "-" . $d;
    }
    
    if (isset($_POST['bairro'])) {
        $inscricao->bairro = trim($_POST['bairro']);
    }
    
    if (isset($_POST['endereco'])) {
        $inscricao->endereco = trim($_POST['endereco']);
    }
    
    if (isset($_POST['email'])) {
        $inscricao->email = trim($_POST['email']);
    }
    
    if (isset($_POST['cpf'])) {
        $inscricao->cpf = trim($_POST['cpf']);
    }
    
    if (isset($_POST['facebook'])) {
        $inscricao->facebook = trim($_POST['facebook']);
    }
    
    if (isset($_POST['instagram'])) {
        $inscricao->instagram = trim($_POST['instagram']);
    }
    
    if (isset($_POST['pix'])) {
        $inscricao->pix = trim($_POST['pix']);
    }
    
    if (isset($_POST['mensagem'])) {
        $inscricao->mensagem = trim($_POST['mensagem']);
    }
    
    // Salvar respostas das perguntas
    for ($i = 1; $i <= 15; $i++) {
        if (isset($_POST['pergunta_rd_' . $i]) && isset($_POST['pergunta_' . $i])) {
            $inscricao->{'resposta_' . $i} = "( " . $_POST['pergunta_rd_' . $i] . " ) - " . $_POST['pergunta_' . $i];
        }
    }
    
    if (isset($_POST['resposta_select'])) {
        $inscricao->resposta_select = trim($_POST['resposta_select']);
    }
    
    try {
        $inscricao->save();
        echo "SEND";
    } catch (Exception $ex) {
        echo "DUPLICATE";
    }
} else {
    echo "ERROR";
}
?>

