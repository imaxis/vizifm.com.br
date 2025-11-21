<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Data
 *
 * @author Cledson
 */
class Data {

    public function convertDateSQLtoDateBR($date) {
        $normalized = $this->normalizeSqlDate($date);
        if (empty($normalized)) {
            return null;
        }
        list($y, $m, $d) = explode("-", $normalized);
        return $d . "/" . $m . "/" . $y;
    }

    public function convertDateBRtoDateSQL($date) {
        if (!is_string($date) || strpos($date, "/") === false) {
            return null;
        }
        list($d, $m, $y) = explode("/", $date);
        return $y . "-" . $m . "-" . $d;
    }

    private function normalizeSqlDate($date) {
        if ($date instanceof DateTimeInterface) {
            return $date->format('Y-m-d');
        }
        if (is_array($date)) {
            if (isset($date['date']) && is_string($date['date'])) {
                return substr($date['date'], 0, 10);
            }
            if (isset($date[0]) && is_string($date[0])) {
                return substr($date[0], 0, 10);
            }
        }
        if (is_string($date)) {
            $date = trim($date);
            if ($date === '') {
                return null;
            }
            return substr($date, 0, 10);
        }
        return null;
    }


    /**
     * Compara a data fornecida com a data atual
     * Caso a data atual seja maior que a data fornecida retorna -1
     * Caso a data atual seja menor que a data fornecida retorna 1
     * Caso a data atual seja igual a data fornecida retorna 0
     *
     * @param <String> $data
     * @return <Integer>
     */
    public function comparaDataComDataAtual($data) {
        $stampData = strtotime($data);
        $stampAtual = strtotime(date("Y-m-d"));
        if ($stampAtual > $stampData)
            return -1;
        if ($stampAtual < $stampData)
            return 1;
        if ($stampAtual == $stampData)
            return 0;
    }

    public function convertDateSqlToDateBRExtense($dt) {
        $normalized = $this->normalizeSqlDate($dt);
        if (empty($normalized)) {
            return null;
        }
        list($y, $m, $d) = explode("-", $normalized);
        $m = $this->getMonth($m);
        return $d . " de " . $m . " de " . $y;
    }
    
   	public function getDateBRExtense($date=null) {
		if (empty($date)) {
       		return date("d")." de ".$this->getMonth(date("m"))." de ".date("Y");
	   	} else {
			list($d, $m, $y) = explode("/", $date);
			return $d." de ".$this->getMonth($m)." de ".$y;
		}
    }

    public function getMonth($month) {
        switch ($month) {
            case 01: $m = "Janeiro";
                break;
            case 02: $m = "Fevereiro";
                break;
            case 03: $m = "Mar&ccedil;o";
                break;
            case 04: $m = "Abril";
                break;
            case 05: $m = "Maio";
                break;
            case 06: $m = "Junho";
                break;
            case 07: $m = "Julho";
                break;
            case 8: $m = "Agosto";
                break;
            case 9: $m = "Setembro";
                break;
            case 10: $m = "Outubro";
                break;
            case 11: $m = "Novembro";
                break;
            case 12: $m = "Dezembro";
                break;
        }
        return $m;
    }

    public function getPeriodOfDay(){
        $hr = date("H");
        if($hr > 4){
            $msg = "Bom Dia";
        }
        if($hr > 12){
            $msg = "Boa Tarde";
        }
        if($hr > 19){
            $msg = "Boa Noite";
        }
        return $msg;
    }
    
    public function  getDiaMonth($date) {
        $normalized = $this->normalizeSqlDate($date);
        if (empty($normalized)) {
            return null;
        }
        list($y, $m, $d) = explode("-", $normalized);
        return $d . "/" . $m;
    }
	
	public function  getDiaMonthBRExtense($date) {
        $normalized = $this->normalizeSqlDate($date);
        if (empty($normalized)) {
            return null;
        }
        list($y, $m, $d) = explode("-", $normalized);
        return $d . " de ".$this->getMonth($m);
	}
}
?>
