<?php

//classe DB
class DB {

    //**Atributos da classe DB
    var $db_HOST = DB_HOST;
    var $db_USER = DB_USER;
    var $db_PASS = DB_PASSWORD;
    var $banco = DB_NAME;
    var $MSG_ERRO = "Erro ao conectar com Base de Dados";
    var $dbc;

    /*
      //Funзгo de Conexгo com Base de Dados
     */

    function Connect() {
        $this->dbc = mysql_connect($this->db_HOST, $this->db_USER, $this->db_PASS);
        $m = mysql_select_db($this->banco, $this->dbc);
        return($dbc);
    }

    /*
      //Funзгo de Exclusгo de registros da Base de Dados
     */

    function Delete($tabela, $condicao) {
        $tmp = "DELETE FROM $tabela WHERE $condicao";
        $sts = mysql_query($tmp, $this->dbc) or print mysql_error($this->MSG_ERRO);
        return($sts);
    }

    /*
      //Funзгo para Inserir registros na Base de Dados
     */

    function Insert($tabela, $valores) {
        $query = "INSERT INTO $tabela VALUES( $valores )";
        $this->Query($query);
    }

    /*
      //Funзгo para Listar registros da Base de Dados
     */

    function Select($campos, $tabelas, $condicao, $ordem, $limite, $agrupar) {
        $query = "SELECT " . $campos;
        $query.=" FROM " . $tabelas;
        if ($condicao != 0)
            $query.=" WHERE " . $condicao;
        if ($agrupar != 0)
            $query.=" GROUP BY " . $agrupar;
        if ($ordem != 0)
            $query.=" ORDER BY " . $ordem;
        if ($limite != 0)
            $query.="LIMIT " . $limite;
        $sts = mysql_query($query, $this->dbc) or print mysql_error($MSG_ERRO);
        return ($sts);
    }

    /*
      //Funзгo para executar uma Query na Base de Dados
     */

    function Query($sql) {
        return mysql_query($sql, $this->dbc);
    }

    /*
      //Funзгo para Atualizar registros da Base de Dados
     */

    function Update($tabela, $campos, $condicao) {
        $tmp = "UPDATE $tabela SET $campos WHERE $condicao";
        $sts = mysql_query($tmp, $this->dbc);
    }

    /*
      //Funзгo para retornar o ъltimo id de uma Inserзгo
     */

    function LastID() {
        return mysql_insert_id($this->dbc);
    }

    /*
      //Funзгo para retornar o array de consulta de uma Query
     */

    function Fetch($sql) {
        return mysql_fetch_array($sql);
    }

    /*
      //Funзгo para retornar a qtde de linhas afetadas em uma Query
     */

    function Rows($query) {
        $tmp = mysql_num_rows($query);
        return($tmp);
    }

    /*
      //Funзгo para liberar a memуria de uma Query
     */

    function FreeDB($query) {
        $tmp = mysql_free_result($query);
        return($tmp);
    }

    /*
      //Funзгo para liberar a memуria de uma Query
     */

    function ListTables($dbName) {
        $tmp = mysql_list_tables($dbName);
        return($tmp);
    }

    /*
      //Funзгo para liberar a memуria de uma Query
     */

    function Error($dbName) {
        mysql_error();
    }

    /*
      //Funзгo para Fechar conexгo com a Base de Dados
     */

    function Close() {
        mysql_close($this->dbc);
    }

}

?>