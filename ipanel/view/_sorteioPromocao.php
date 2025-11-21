<?php

header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=sorteio.xls");
header("Pragma: no-cache");

session_start();
require_once("../app/core/config.php");
require_once(APP_PATH."/cms/restritoIPanel.php");
include "../app/core/load.php";

$promocaoCtrl = new GenericCtrl("Promocao");
$promocao = $promocaoCtrl->getObject($_GET['id']);


    if (date('N') == '5') {    
        $inscricaoCtrl = new InscricaoCtrl();
        $ins = $inscricaoCtrl->getSorteioSemana($_GET['id'], $promocao->aniverSemana);
        
        if ($ins != null) {
            $ganhadorCtrl = new GenericCtrl("Ganhador");
            $ultimoGanhador = $ganhadorCtrl->getObjectByFields(["dtSorteio", "proId"], [date('Y-m-d'), $_GET['id']], true, 1, 0, "id DESC");
            $ultimoGanhador = $ultimoGanhador[0];

            if($ultimoGanhador == null) {
                $ganhador = new Ganhador();
                $ganhador->dtSorteio = date('Y-m-d');
                $ganhador->login = $_SESSION['userNome'];
                $ganhador->nome = $ins['nome'];
                $ganhador->nascimento = $ins['nascimento'];
                $ganhador->telefone = $ins['telefone'];
                $ganhador->bairro = $ins['bairro'];
                $ganhador->cidade = $ins['cidade'];
                $ganhador->mensagem = $ins['mensagem'];
                $ganhador->proId = $ins['proId'];
                $ganhador->save();

                $inscricaoCtrl->apagarInscricoesSemana($_GET['id']);
            } else {
                $ins = 'realized';
            }
        } else {
            $ins = null;
        }
    } else {
        $ins = 'wrongday';
    }

if ($ins == 'wrongday') {
    echo "<table>";
    echo "<tr height=\"200 px\">";
    echo "  <td colspan=10 rowspan=5> <img src=\"http://vizifmnovo.com.br/assets/img/img_logo_rodape.png\" width=\"200 px\"/></td>";
    echo "</tr>";
    echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
    echo "<tr>";
    echo "  <td colspan=5><strong>Promo��o: " . $promocao->titulo . "</strong></td>";
    echo "</tr>";
    echo "<td colspan=5><strong>Hoje n�o � sexta-feira, sorteio n�o permitido.</strong></td>";
    echo "</table>";
} else if (is_null($ins)) {
    echo "<table>";
    echo "<tr height=\"200 px\">";
    echo "  <td colspan=10 rowspan=5> <img src=\"http://vizifmnovo.com.br/assets/img/img_logo_rodape.png\" width=\"200 px\"/></td>";
    echo "</tr>";
    echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
    echo "<tr>";
    echo "  <td colspan=5><strong>Promo��o: " . $promocao->titulo . "</strong></td>";
    echo "</tr>";
    echo "<td colspan=5><strong>N�o h� nenhuma inscri��o dispon�vel. </strong></td>";
    echo "</table>";
} else if ($ins == 'realized') {
    echo "<table>";
    echo "<tr height=\"200 px\">";
    echo "  <td colspan=10 rowspan=5> <img src=\"http://vizifmnovo.com.br/assets/img/img_logo_rodape.png\" width=\"200 px\"/></td>";
    echo "</tr>";
    echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
    echo "<tr>";
    echo "  <td colspan=5><strong>Promo��o: " . $promocao->titulo . "</strong></td>";
    echo "</tr>";
    echo "<td colspan=5><strong>Sorteio j� realizado na data de hoje. </strong></td>";
    echo "</table>";
} else {
    echo "<table>";
    echo "<tr height=\"200 px\">";
    echo "  <td colspan=10 rowspan=5> <img src=\"http://vizifmnovo.com.br/assets/img/img_logo_rodape.png\" width=\"200 px\"/></td>";
    echo "</tr>";
    echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
    echo "<tr>";
    echo "  <td colspan=5><strong>Promo��o: " . $promocao->titulo . "</strong></td>";
    echo "  <td></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td colspan=5></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td colspan=5><strong>PARTICIPANTE SORTEADO</strong></td>";
    echo "  <td></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td>Data: </td><td><strong>" . date('d/m/Y') . "</strong></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td>Sorteado por: </td><td><strong>" . $_SESSION['userNome'] . "</strong></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td>Nome: </td><td><strong>" . $ins['nome'] . "</strong></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td>Nascimento: </td><td><strong>" . date("d/m/Y", strtotime($ins['nascimento'])) . "</strong></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td>Telefone: </td><td><strong>" . $ins['telefone'] . "</strong></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td>Cidade: </td><td><strong>" . $ins['cidade'] . "</strong></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td>Bairro: </td><td><strong>" . $ins['bairro'] . "</strong></td>";
    echo "</tr>";
    echo "<tr>";
    echo "  <td>Mensagem: </td><td><strong>" . $ins['mensagem'] . "</strong></td>";
    echo "</tr>";
    echo "</table>";
}
?>  