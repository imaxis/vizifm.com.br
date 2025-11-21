<?php

 if(!class_exists('Util'))
    require_once(APP_PATH."/util/Util.php");
  if(!class_exists('Data'))
    require_once(APP_PATH."/util/Data.php");
  if(!class_exists('Password'))
    require_once(APP_PATH."/system/Password.php");

/**
 * Description of AdminFunctions
 *
 * @author Cledson
 */
class IPanelFunctions {
   

    public function convertDateSQLtoDateBR($date) {
        $data = new Data();
        return $data->convertDateSQLtoDateBR($date);
    }

    public function convertDateBRtoDateSQL($date) {
        $data = new Data();
        return $data->convertDateBRtoDateSQL($date);
    }
    
    public function convertDateSQLToDateBRExtense($date) {
        $data = new Data();
        return $data->convertDateSQLToDateBRExtense($date);
    }

    public function nameOriginalFile($fileName){
        $util = new Util();
        return $util->nameOriginalFile($fileName);
    }

    public function nameForWeb($fileName){
        $util = new Util();
        return $util->nameForWeb($fileName);
    }

    public function getActualDate($param=null){
        return date("Y-m-d");
    }

    public function getActualTime($param=null){
        return date("H:i:s");
    }

    public function removeSeparators($var){
        $var = str_replace("-","", $var);
        $var = str_replace("/","", $var);
        $var = str_replace(".","", $var);
        $var = str_replace(",","", $var);
        $var = str_replace("_","", $var);
        $var = str_replace(" ","", $var);
        $var = str_replace("(","", $var);
        $var = str_replace(")","", $var);
        return $var;
    }

    public function validUrl($url){
        $url = str_replace("http://", "", $url);
        return "http://".$url;
    }

    public function cript($senha){
        $password = new Password();
        return $password->cript($senha);
    }

    public function deCript($senha){
        $password = new Password();
        return $password->deCript($senha);
    }
	
    public function convertMoneyToDouble($value){
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
        return $value;
    }

    public function convertDoubleToMoney($value){
        $value = number_format($value, 2, ",", ".");
        return $value;
    }

    public function convertStringToDouble($value){
        $value = str_replace(",", ".", $value);
        return $value;
    }

    public function tipoPessoa($value){
        if($value == "F"){
            return "Física";
        }else{
            return "Jurídica";
        }
    }

    public function formatarCpfCnpj($var){
        $util = new Util();
        return $util->formatarCpfCnpj($var);
    }

    public function formatarTelefone($var){
        $util = new Util();
        return $util->formatarTelefone($var);
    }

    public function formatarCep($var){
        $util = new Util();
        return $util->formatarCep($var);
    }

    public function getSimNao($var){
        if($var == "S") return "Sim";
        else return "Não";
    }

    public function getStatusPedido($var){
        $util = new Util();
        return $util->getStatusPedido($var);
    }

    public function getStatusPagamento($var){
        $util = new Util();
        return $util->getStatusPagamento($var);
    }

    public function getTipoPagamento($var){
        $util = new Util();
        return $util->getTipoPagamento($var);
    }

    public function getStatusGeral($var){
        $util = new Util();
        return $util->getStatusGeral($var);
    }

    public function getNivelEnsino($var){
        $util = new Util();
        return $util->getNivelEnsino($var);
    }

    public function getEnsino($var){
        $util = new Util();
        return $util->getEnsino($var);
    }

    public function getNivel($var){
        $util = new Util();
        return $util->getNivel($var);
    }

    public function getTurno($var){
        $util = new Util();
        return $util->getTurno($var);
    }

    public function getStatusVaga($var){
        $util = new Util();
        return $util->getStatusVaga($var);
    }
}
?>
