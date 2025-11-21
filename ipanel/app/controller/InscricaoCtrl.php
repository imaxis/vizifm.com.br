<?php
require_once("BaseController.php");

class InscricaoCtrl extends GenericCtrl {

    var $model = "Inscricao";

    /**
     * Construtor principal
     * Inicia a classe principal de controle informando o Modelo Atual
     */
    public function __construct() {
        parent::setConnection($this->model);
    }

    public function getInscricoes($promocaoId = null) {
        $q = Doctrine_Query::create()
                ->from("Inscricao i")
                ->orderBy('id');
        if ($promocaoId != null) {
            $q->where('i.proId = ?', $promocaoId);
        }
        $result = $q->fetchArray();
        return $result;
    }

    public function getInscricoesSemana($promocaoId, $pas = 'N') {
        $dateCond = '(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d') . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d') . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-1 day')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-1 day')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-2 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-2 days')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-3 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-3 days')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-4 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-4 days')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-5 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-5 days')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-6 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-6 days')) . '"))';
        $q = Doctrine_Query::create()
                ->from("Inscricao i")
                ->where('i.proId = ?', $promocaoId);
        if ($pas == 'S') {
            $q->andWhere($dateCond);
        }
        $q->orderBy('id');
        $result = $q->fetchArray();
        return $result;
    }

    public function getSorteioSemana($promocaoId, $pas = 'N') {
        $dateCond = '(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d') . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d') . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-1 day')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-1 day')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-2 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-2 days')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-3 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-3 days')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-4 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-4 days')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-5 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-5 days')) . '")) OR (MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-6 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-6 days')) . '"))';
        $q = Doctrine_Query::create()
                ->from("Inscricao i")
                ->where('pro_id = ?', $promocaoId);
        if ($pas == 'S') {
            $q->andWhere($dateCond);
        }
        $q->orderBy('RAND()')
                ->limit(1);
        $result = $q->fetchArray();
        $result = $result[0];
        return $result;
    }

    public function apagarInscricoesSemana($promocaoId) {
        $q = Doctrine_Query::create()
                ->delete("Inscricao i")
                ->where('i.proId = ?', $promocaoId);
        //->where('(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d') . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d') . '"))')
        //->orWhere('(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-1 day')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-1 day')) . '"))')
        //->orWhere('(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-2 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-2 days')) . '"))')
        //->orWhere('(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-3 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-3 days')) . '"))')
        //->orWhere('(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-4 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-4 days')) . '"))')
        //->orWhere('(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-5 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-5 days')) . '"))')
        //->orWhere('(MONTH(ins_nascimento) = MONTH("' . date('Y-m-d', strtotime('-6 days')) . '") AND DAY(ins_nascimento) = DAY("' . date('Y-m-d', strtotime('-6 days')) . '"))');
        $q->fetchArray();
        return $result;
    }
    
    
    public function hasInscricao($promocaoId, $cpf=null, $telefone=null) {
        $q = Doctrine_Query::create()->from("Inscricao i")->where('pro_id = ?', $promocaoId);
        if(!empty($cpf) && empty($telefone)){
            $q->addWhere("ins_cpf = ?", $cpf);
        }
        if(empty($cpf) && !empty($telefone)){
            $q->addWhere("ins_telefone = ?", $telefone);
        }
        if(!empty($cpf) && !empty($telefone)){
            $q->addWhere("ins_cpf = '".$cpf."' OR ins_telefone='".$telefone."'");
        }
        return count($q->fetchArray()) > 0;
    }

}

?>
