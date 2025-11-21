<?php

require_once("BaseController.php");



class AgendaCtrl extends BaseController {

    var $model = "Agenda";

    /**
     * Construtor principal
     * Inicia a classe principal de controle informando o Modelo Atual
     */
    public function __construct() {
        parent::setConnection($this->model);
    }



    /*
     * Retorna os eventos futuros gravados na agenda de eventos
     *
     * @return Array
     */
    public function getEventosFuturos($limit=null) {
        $q = Doctrine_Query::create()->from("Agenda a")
                                     ->where("a.agData >= ?", date("Y-m-d"))
                                     ->orderBy("a.agData ASC")
									 ->limit(($limit != null ? $limit : ""));
        return $q->fetchArray();
    }
}

?>
