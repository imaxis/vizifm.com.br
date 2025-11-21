<?php

require_once("BaseController.php");



class ProgramaCtrl extends GenericCtrl {

    var $model = "Programa";


    /**
     * Construtor principal
     * Inicia a classe principal de controle informando o Modelo Atual
     */
    public function __construct() {
        parent::setConnection($this->model);
    }

   
    public function getProgramaAtual() {
        $d = date("D");
                
        switch ($d)  {
            case "Mon":
                $dia = "Segunda - Sexta";
                break;
            case "Tue":
                $dia = "Segunda - Sexta";
                break;
            case "Wed":
                $dia = "Segunda - Sexta";
                break;
            case "Thu":
                $dia = "Segunda - Sexta";
                break;
            case "Fri":
                $dia = "Segunda - Sexta";
                break;
            case "Sat":
                $dia = "Sábado";
                break;
            case "Sun":
                $dia = "Domingo";
                break;
            default:
                $dia = "";
        }
        date_default_timezone_set('America/Sao_Paulo');
        $q = Doctrine_Query::create()->from("Programa p")
                                     ->where("p.inicio <= ?", date("H:i"))
                                     ->addWhere("p.fim > ?", date("H:i"))
                                     ->addWhere("p.dia = ?", $dia)
                                     ->orderBy("p.id DESC")
                                     ->limit(1);
        $count = 0;
        $result = $q->fetchArray();
        $arrayReturn = array();
        foreach($result as $object){
            $arrayReturn[$count] = $this->table->find($object['id']);
            $count++;
        }
        return $arrayReturn;
    }
    
    
   public function getProgramas($limit) {
        $q = Doctrine_Query::create()->select('DISTINCT (nome) as nome')
                                     ->from("Programa p")
                                     ->orderBy("RAND()")
                                     ->limit($limit);
        $count = 0;
        $result = $q->fetchArray();
        $arrayReturn = array();
        foreach($result as $object){
            $programa = $this->getObjectByField("nome", $object['nome'], 0, 1);
            $programa = $programa[0];
            $arrayReturn[$count] = $this->table->find($programa['id']);
            $count++;
        }
        return $arrayReturn;
    }




}
?>
