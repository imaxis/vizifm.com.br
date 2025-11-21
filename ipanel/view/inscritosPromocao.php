<?php

header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=inscritos.xls");
header("Pragma: no-cache");

session_start();
require_once("../app/core/config.php");
require_once(APP_PATH . "/cms/restritoIPanel.php");
include "../app/core/load.php";

if ($_GET['id'] == 1) {
    //if (date('N') == '5') {
    if (date('N') == '1') {
        $promocaoCtrl = new GenericCtrl("Promocao");
        $promocao = $promocaoCtrl->getObject($_GET['id']);
        $inscricaoCtrl = new InscricaoCtrl();
        $inscricao = $inscricaoCtrl->getInscricoesSemana($_GET['id'], $promocao->aniverSemana);
    } else {
        $inscricao = 'wrongday';
    }

    if (is_null($inscricao[0])) {
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
    } else if ($inscricao == 'wrongday') {
        echo "<table>";
        echo "<tr height=\"200 px\">";
        echo "  <td colspan=10 rowspan=5> <img src=\"http://vizifmnovo.com.br/assets/img/img_logo_rodape.png\" width=\"200 px\"/></td>";
        echo "</tr>";
        echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
        echo "<tr>";
        echo "  <td colspan=5><strong>Promo��o: " . $promocao->titulo . "</strong></td>";
        echo "</tr>";
        echo "<td colspan=5><strong>As inscri��es dispon�veis s� ser�o listadas na sexta-feira. </strong></td>";
        echo "</table>";
    } else {
        echo "<table>";
        echo "<tr height=\"200 px\">";
        echo "  <td colspan=10 rowspan=5> <img src=\"http://vizifmnovo.com.br/assets/img/img_logo_rodape.png\" width=\"200 px\"/></td>";
        echo "</tr>";
        echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
        echo "<tr>";
        echo "  <td colspan=5><strong>Promo��o: " . $promocao->titulo . "</strong></td>";
        echo "</tr>";
        echo "<tr>";
        echo "  <td><strong>Nome</strong></td>";
        echo "  <td><strong>Nacimento</strong></td>";
        echo "  <td><strong>Telefone</strong></td>";
        echo "  <td><strong>Cidade</strong></td>";
        echo "  <td><strong>Bairro</strong></td>";
        echo "</tr>";


        foreach ($inscricaoCtrl->getInscricoesSemana($_GET['id'], $promocao->aniverSemana) as $ins) {

            echo "<tr>";
            echo "  <td>" . $ins['nome'] . "</td>";
            echo "  <td>" . date("d/m/Y", strtotime($ins['nascimento'])) . "</td>";
            echo "  <td>" . $ins['telefone'] . "</td>";
            echo "  <td>" . $ins['cidade'] . "</td>";
            echo "  <td>" . $ins['bairro'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} else if ($_GET['id'] == 2) {

    $promocaoCtrl = new GenericCtrl("Promocao");
    $promocao = $promocaoCtrl->getObject($_GET['id']);
    $inscricaoCtrl = new InscricaoCtrl();
    $inscricao = $inscricaoCtrl->getInscricoesSemana($_GET['id'], $promocao->aniverSemana);


    if (is_null($inscricao[0])) {
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
    } else {
        echo "<table>";
        echo "<tr height=\"200 px\">";
        echo "  <td colspan=10 rowspan=5> <img src=\"http://vizifmnovo.com.br/assets/img/img_logo_rodape.png\" width=\"200 px\"/></td>";
        echo "</tr>";
        echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
        echo "<tr>";
        echo "  <td colspan=5><strong>Promo��o: " . $promocao->titulo . "</strong></td>";
        echo "</tr>";
        echo "<tr>";
        echo "  <td><strong>Nome</strong></td>";
        echo "  <td><strong>Telefone</strong></td>";
        echo "  <td><strong>Cidade</strong></td>";
        echo "  <td><strong>Chave Pix</strong></td>";
        echo "  <td><strong>CPF</strong></td>";
        echo "</tr>";


        foreach ($inscricaoCtrl->getInscricoesSemana($_GET['id'], $promocao->aniverSemana) as $ins) {

            echo "<tr>";
            echo "  <td>" . $ins['nome'] . "</td>";
            echo "  <td>" . $ins['telefone'] . "</td>";
            echo "  <td>" . $ins['cidade'] . "</td>";
            echo "  <td>" . $ins['pix'] . "</td>";
            echo "  <td>" . $ins['cpf'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} else {
    $promocaoCtrl = new GenericCtrl("Promocao");
    $promocao = $promocaoCtrl->getObject($_GET['id']);
    $inscricaoCtrl = new InscricaoCtrl();
    $inscricoes = $inscricaoCtrl->getInscricoes($_GET['id']);
    
    if (is_null($inscricoes[0])) {
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
    } else {
        echo "<table>";
            echo "<tr height=\"200 px\">";
                echo "<td colspan=10 rowspan=5> <img src=\"http://vizifmnovo.com.br/assets/img/img_logo_rodape.png\" width=\"200 px\"/></td>";
            echo "</tr>";
            echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
            echo "<tr>";
                echo "<td colspan=5><strong>Promo��o: " . $promocao->titulo . "</strong></td>";
            echo "</tr>";
			echo "<tr>";
				echo "<td><strong>Nome</strong></td>";
				echo "<td><strong>Telefone</strong></td>";
				echo "<td><strong>CPF</strong></td>";
				echo "<td><strong>Chave Pix</strong></td>";                    
				//echo "<td><strong>Nascimento</strong></td>";
				echo "<td><strong>Endere�o</strong></td>";
				echo "<td><strong>N�mero</strong></td>";
				echo "<td><strong>Complemento</strong></td>";
				echo "<td><strong>Bairro</strong></td>";
				echo "<td><strong>Cidade</strong></td>";
				echo "<td><strong>Facebook</strong></td>";
				echo "<td><strong>Instagram</strong></td>";
                                echo "<td><strong>Email</strong></td>";
				
				for ($i = 1; $i <= 15; $i++) {
					echo "  <td><strong>Pergunta ".$i."</strong></td>";
				}
				echo "  <td><strong>Pergunta Sele��o</strong></td>";
            echo "</tr>";
            foreach ($inscricoes as $inscricao) {
				echo "<tr>";
					echo "<td>".$inscricao['nome']."</td>";
					echo "<td>".$inscricao['telefone']."</td>";
					echo "<td>".$inscricao['cpf']."</td>";
					echo "<td>".$inscricao['pix']."</td>";
					//echo "<td>".date("d/m/Y", strtotime($inscricao['nascimento']))."</td>";
					echo "<td>".$inscricao['endereco']."</td>";
					echo "<td>".$inscricao['numero']."</td>";
					echo "<td>".$inscricao['complemento']."</td>";
					echo "<td>".$inscricao['bairro']."</td>";
					echo "<td>".$inscricao['cidade']."</td>";
					echo "<td>".$inscricao['facebook']."</td>";
					echo "<td>".$inscricao['instagram']."</td>";
                                        echo "<td>".$inscricao['email']."</td>";

					for ($i = 1; $i <= 15; $i++) {
						echo "<td>".$inscricao['resposta_'.$i]."</td>";
					}
					
					echo "<td>".$inscricao['resposta_select']."</td>";
				echo "</tr>";
            }
            
        echo "</table>";
    }
}
?>