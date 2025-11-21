<?php
    $backupFile = "backup"."_".date("Ymd")."_".date("Hi").".txt";
    
    //
    //Abre o arquivo SQL
    //
    mkdir("../../uploads/backups/".$objectId."/", 0777);
    $fopen = fopen("../../uploads/backups/".$objectId."/".$backupFile, "w+");
    
    //
    // Percorre a lista de tabelas da base de dados
    // Conexão realizada com informações do arquvivo config.php Doctrine
    //
    $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    $sel = mysql_select_db(DB_NAME, $dbc);
    $res = mysql_list_tables(DB_NAME) or die(mysql_error()); 
    while($row = mysql_fetch_row($res)){ 
        $table = $row[0]; // cada uma das tabelas 
        $res2 = mysql_query("SHOW CREATE TABLE $table"); 
        while($lin =  mysql_fetch_row($res2)){ // Para cada tabela 
	    $linhaAdd.= "-- Criando tabela : $table\n";
	    $linhaAdd.= "$lin[1]\n--Dump de Dados\n";
            $res3 = mysql_query("SELECT * FROM $table"); 
            while($r =  mysql_fetch_row($res3)){ // Dump de todos os dados das tabelas 
                $linhaAdd.="INSERT INTO $table VALUES ('"; 
                $linhaAdd.= implode("','",$r); 
                $linhaAdd.= "')\n"; 
            } 
        } 
     } 
     fwrite($fopen, $linhaAdd); 
     fclose($fopen);
     $backupFileSize = $util->getFileSize($backupFile);
     mysql_close($dbc);
/*
	
	if($_POST['md'] == "Zip"){
	$zip= new zipfile;
	$zip -> addFile($linhaAdd,$ArquivoNovo); //adiciona um arquivo ao zip
	$strzip = $zip->file(); //string contendo o arquivo zip
	$ArquivoZip = "../model/backup/Backup_Muralha"."_".date("dmY").".zip";
	$abre = fopen($ArquivoZip, "w");
	$salva = fwrite($abre, $strzip);
	unlink("../model/backup/".$ArquivoNovo);
         */
?>
