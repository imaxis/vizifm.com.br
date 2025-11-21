<?php
    @session_start();
   
    $clienteId      = $_SESSION['clienteId'];
    $clienteRazao   = $_SESSION['clienteNome'];
    $clienteCpfCnpj = $_SESSION['clienteCpfCnpj'];
    $clienteTipo    = $_SESSION['clienteTipo'];

    if($_SESSION['statusAcesso'] != "Permitido"){
        header("Location:index.php");
        exit;
    }
?>
