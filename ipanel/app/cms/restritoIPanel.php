<?php
    session_start();
    $userId       = $_SESSION['userId'];
    $userLogin    = $_SESSION['userLogin'];
    $userNome     = $_SESSION['userNome'];
    $ultimoAcesso = $_SESSION['ultimoAcesso'];
    $nroAcessos   = $_SESSION['nroAcessos'];
    $permitido    = $_SESSION['permitido'];    
    $setores      = $_SESSION['setores'];
    $permissoes   = $_SESSION['permissoes'];


    if($permitido != "true"){
        header("Location:../index.php");
        exit;
    }
?>