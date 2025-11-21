<?php

    if(preg_match( "/MSIE/", $_SERVER['HTTP_USER_AGENT'])){
            header('Cache-Control: maxage=3600');
            header('Pragma: public');
    }
    session_cache_limiter("private");
    include "../../load_ipanel.php";

    define('FPDF_FONTPATH','font/');


    $promocaoCtrl = new GenericCtrl("Promocao");
    $promocao = $promocaoCtrl->getObject($_GET['id']);

    $pdf = new PDF();
    $pdf->FPDF();
    $pdf->Open();
    $pdf->AddPage();
    $pdf->SetAuthor("Continental FM");
    $pdf->SetXY(10, 10);
    $pdf->SetFillColor(255);
    $pdf->SetFont('Arial', 'B', 10); 

    $pdf->Image("../../img/img_relatorios.jpg", 10, 8, 50);
    $pdf->ln();
    $pdf->Cell(80, 4, "", 0, 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(80, 4, "INSCRIÇÕES: PROMOÇÕES DA CONTI FM" , 0, 0, 'C', 0);
    $pdf->ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(80, 6, "", 0, 0, 'C', 0);
    $pdf->Cell(80, 6, $promocao['titulo'], 0, 0, 'C', 0);
    $pdf->ln(7);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(80, 6, "", 0, 0, 'C', 0);
    $pdf->Cell(111, 6,"Gerado em ".date("d/m/Y")." às ".date("H:i:s") , 0, 0, 'R', 0);
    $pdf->Line(10, 28, 200, 28);
    $pdf->ln(9);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 6, "Nº", 1, 0, 'C', 0);
    $pdf->Cell(105, 6, "Nome", 1, 0, 'L', 0);
    $pdf->Cell(35, 6, "CPF", 1, 0, 'C', 0);
    $pdf->Cell(35, 6, "Telefone", 1, 0, 'C', 0);
    $pdf->ln();
    
    $inscricaoPromocaoCtrl = new GenericCtrl("InscricaoPromocao");
    $inscricaoPromocao = $inscricaoPromocaoCtrl->getObjectByField("proId",$_GET['id'], true, 0, 0, "id ASC");
    
    $cont = 0;
    
    $util = new Util();
    
    foreach ($inscricaoPromocao as $inscricao) {
        
        $cont ++;
    
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(15, 6, $util->addZeros($cont, 3), 1, 0, 'C', 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(105, 6, $inscricao['inscricao']['nome'], 1, 0, 'L', 0);
        $pdf->Cell(35, 6, $util->formatarCpfCnpj($inscricao['inscricao']['cpf']), 1, 0, 'C', 0);
        $pdf->Cell(35, 6, $util->formatarTelefone($inscricao['inscricao']['telefone']), 1, 0, 'C', 0);
        $pdf->ln();
        
        
    }
    
    $pdf->ln(8);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(165, 6, "Total de Inscrições para esta Promoção", 1, 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(25, 6, $cont, 1, 0, 'C', 0);

    $pdf->Output();
?>

