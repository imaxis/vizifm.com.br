<?php

require_once("GenericCtrl.php");
if(!class_exists('Data'))
   require_once(APP_PATH."/util/Data.php");

class AcessoCtrl extends BaseController {

    var $model = "Acesso";

    /**
     * Construtor principal
     * Inicia a classe principal de controle informando o Modelo Atual
     */
    public function __construct() {
        parent::setConnection($this->model);
    }


    /*
     * Grava o acesso dos visitantes/usuarios ao site na base de dados
     * @param Integer $usrId     Identificador do usuário (caso esteja efetuando login do admin)
     *
     * @return void
     */
    public function saveAcesso($usrId = null){
        $acesso = new Acesso();
        $acesso->data = date('Y-m-d');
        $acesso->hora = date('H:i:s');
        $acesso->host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $acesso->referencia = $HTTP_REFERER;
        $acesso->ip = getenv("REMOTE_ADDR");
        if ($usrId != null) {
            $acesso->local = "Admin";
            $acesso->usrId = $usrId;
        } else {
            $acesso->local = "Site";
        }
        $acesso->save();
    }


    /*
     * Retorna a data do ultimo acesso e o total de acessos de um usuário
     * @param integer $usrId        Identificador do usuário
     *
     * @return array
     */
    public function getLastAcessoByUser($usrId)
    {
        $q = Doctrine_Query::create()
             ->from('Acesso a')
             ->where('a.usrId = ?', $usrId)
             ->orderBy('a.data DESC');
        $acessos = $q->fetchArray();
        return array("ultimoAcesso" => $acessos[0]['data'], "nroAcessos" => count($acessos));
    }


    /*
     * Retorna a data do ultimo acesso e o total de acessos de um usuário
     * @param integer $usrId        Identificador do usuário
     *
     * @return array
     */
    public function getLastAcessosAdmin($limit=false)
    {
        $q = Doctrine_Query::create()
             ->from('Acesso a')
             ->where("a.local = ?", "Admin")
             ->orderBy('a.id DESC');
        if($limit){
            $q->limit($limit);
        }
        $acessos = $q->fetchArray();
        $array = array();
        $count = 0;
        $control = new GenericCtrl("Usuario");
        foreach($acessos as $acesso){
            $usuario = $control->getObject($acesso['usrId']);
            $array[$count]['nome'] =  $usuario['nome'];
            $array[$count]['ip'] =   $acesso['ip'];
            $array[$count]['data'] = $acesso['data'];
            $array[$count]['hora'] = $acesso['hora'];
            $array[$count]['host'] = $acesso['host'];
            $count++;
        }
        return $array;
    }


    /*
     * Retorna a data do ultimo acesso e o total de acessos de um usuário
     * @param integer $usrId        Identificador do usuário
     *
     * @return array
     */
    public function getArrayAcessos($local, $limit=false)
    {
        $data = new Data();
        $q = Doctrine_Query::create()
             ->select("COUNT(a.id) AS total, a.data")
             ->from('Acesso a')
             ->where("a.local = ?", $local)
             ->groupBy("a.data")
             ->orderBy('a.data DESC');
        if($limit){
            $q->limit($limit);
        }
        $acessos = $q->fetchArray();
        //$count = 0;
        /*$array = array();
        $count = 0;
        $control = new GenericCtrl("Usuario");*/
        echo "[";
        $acessos = array_reverse($acessos);
        foreach($acessos as $acesso){

            echo "['".substr($data->convertDateSQLtoDateBR($acesso['data']), 0,5)."',".$acesso['total']."]";
            $count++;
            if($count < count($acessos)){
                echo ",";
            }
        }
        echo "]";
        //var_dump($acessos);
      //  return $acessos;
    }

}

?>
