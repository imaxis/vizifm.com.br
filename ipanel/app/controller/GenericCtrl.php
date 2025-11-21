<?php

require_once("BaseController.php");
require_once(APP_PATH."/cms/IPanelConfig.php");
require_once(APP_PATH."/util/Util.php");


class GenericCtrl extends BaseController {

    var $model = "";
            

    /**
     * Construtor principal
     * Inicia a classe principal de controle informando o Modelo Atual
     */
    public function __construct($model=null) {
        $this->model = $model;
        parent::setConnection($this->model);
    }
    

    
    /*
     * Salva o usuário na base de dados
     *
     * @param Usuario  object       Usuário a ser salvo
     *
     * @return boolean
     */

     public function save($object){
        $util = new Util();
        //$config = new AreaConfig($this->model);
        if($config->getParameter("image") != null){
            $object->imagem = $util->trataNomeArquivo($object->imagem);
        }
        if($object->id > 0) {  
             $object->replace(); 
             $objectId = $object->id;
        }else{
             $object->save();
             $objectId = $this->getLastId();
        }       
        return true;
    }


    /*
     * Retorna a lista de objetos de acordo com os parâmetros da busca
     *
     * @param String   $field       Nome do campo a ser pesquisado
     * @param Object   $value       Valor a ser comparado
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      In�cio da listagem, funciona com $paged = true
     * @param String   $order       Campo a ser usado na ordena��o
     *
     * @return array
     */
    public function getObjects($field="", $value="", $paged=false, $limit=0, $offset=0, $order="id DESC") {
        $q = Doctrine_Query::create()->from($this->model." x");
        if(!empty($field)){
            $q->where("x.".$field." LIKE ?", '%'.$value.'%');
         }
        if ($paged) {
            if ($limit)
                $q->limit($limit);
            if ($offset)
                $q->offset($offset);
        }
        if($order == "RAND()"){
            $q->orderBy("rand()");
        }else{
            $q->orderBy("x.".$order);
        }

        $count = 0;
        $result = $q->fetchArray();
        $arrayReturn = array();
        foreach($result as $object){
            $arrayReturn[$count] = $this->table->find($object['id']);
            $count++;
        }
        return $arrayReturn;
    }


    /*
     * Retorna a lista de objetos de acordo com os par�metros da busca informados
     * no formul�rio de pesquisa do IPanel
     *
     * @param String   $field       Nome do campo a ser pesquisado
     * @param Object   $valueIni    Valor Inicial a ser comparado
     * @param Object   $valueEnd    Valor Final a ser comparado
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      In�cio da listagem, funciona com $paged = true
     * @param String   $order       Campo a ser usado na ordena��o
     *
     * @return array
     */
    public function getObjectsIPanel($field="", $valueIni="", $valueEnd="", $paged=false, $limit=0, $offset=0, $order="id DESC") {
        $q = Doctrine_Query::create()->from($this->model." x");
        if(!empty($valueEnd)){
            $q->where("x.".$field." >= ?", $valueIni);
            $q->addWhere("x.".$field." <= ?", $valueEnd);
        }else{
            $q->where("x.".$field." LIKE ?", '%'.$valueIni.'%');
         }
        if ($paged) {
            if ($limit)
                $q->limit($limit);
            if ($offset)
                $q->offset($offset);
        }
        if($order == "RAND()"){
            $q->orderBy("rand()");
        }else{
            $q->orderBy("x.".$order);
        }

        $count = 0;
        $result = $q->fetchArray();
        $arrayReturn = array();
        foreach($result as $object){
            $arrayReturn[$count] = $this->table->find($object['id']);
            $count++;
        }
        return $arrayReturn;
    }



    /**
     * Retorna o(s) objeto(s) atrav�s dos campos informados
     * @param Array    $fields      Array com os nomes dos campos a serem pesquisados
     * @param Array    $values      Array com os valores a serem comparados
     * @param Array    $operators   Array com os tipos de opera��o
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      In�cio da listagem, funciona com $paged = true
     * @param String   $order       Ordena��o do resultado
     *
     * @return mixed
     */
    public function getObjectsByAdvancedSearch($fields, $values, $operators, $paged=false, $limit=0, $offset=0, $order=0) {
        $q = Doctrine_Query::create()->select("x.*");
        for ($x = 0; $x < count($fields); $x++){
            $field = $fields[$x]['field'];
            $valueIni = $values[$x]['valueIni'];
            $valueEnd = $values[$x]['valueEnd'];

            if($values[$x]['valueIni']){
                if($operators[$x]['operator'] == "EQUALS"){
                    $q->andWhere("x.".$field." = ?", $values[$x]['valueIni']);
                }
                if($operators[$x]['operator'] == "LIKE"){
                    $q->andWhere("x.".$field." LIKE '%".$values[$x]['valueIni']."%'");
                }
                if($operators[$x]['operator'] == "BETWEEN"){
                    $q->andWhere("x.".$field." >= ?", $values[$x]['valueIni']);
                    $q->andWhere("x.".$field." <= ?", $values[$x]['valueEnd']);
                }
            }
        }
        $q->from($this->modelName . " x");
        if ($paged) {
            if ($limit)
                $q->limit($limit);
            if ($offset)
                $q->offset($offset);
        }
        if($order){
            $q->orderBy($order);
        }

        $count = 0;
        $result = $q->fetchArray();
        $arrayReturn = array();
        foreach($result as $object){
            $arrayReturn[$count] = $this->table->find($object['id']);
            $count++;
        }
        return $arrayReturn;
    }


    /*
     * Retorna a lista de objetos de acordo com a letra inicial do campo
     *
     * @param String   $field       Nome do campo a ser pesquisado
     * @param Object   $letter      Letra a ser comparada
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      In�cio da listagem, funciona com $paged = true
     * @param String   $order       Campo a ser usado na ordena��o
     *
     * @return array
     */
    public function getObjectsByStartLetter($field="", $letter="", $paged=false, $limit=0, $offset=0, $order="id DESC") {
        $q = Doctrine_Query::create()->from($this->model." x");
        if(!empty($field)){
            $q->where("x.".$field." LIKE ?", $letter.'%');
         }
        if ($paged) {
            if ($limit)
                $q->limit($limit);
            if ($offset)
                $q->offset($offset);
        }
        if($order == "RAND()"){
            $q->orderBy("rand()");
        }else{
            $q->orderBy("x.".$order);
        }

        $count = 0;
        $result = $q->fetchArray();
        $arrayReturn = array();
        foreach($result as $object){
            $arrayReturn[$count] = $this->table->find($object['id']);
            $count++;
        }
        return $arrayReturn;
    }


    /*
     * Retorna a lista de objetos de acordo com os par�metros da busca
     *
     * @param String   $field       Nome do campo a ser pesquisado
     * @param Object   $value       Valor a ser comparado
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      In�cio da listagem, funciona com $paged = true
     * @param String   $order       Campo a ser usado na ordena��o
     *
     * @return array
     */
    public function getStatusList() {
        $q = Doctrine_Query::create()->select("count(*) as total, status")
                                     ->from($this->model." x")
                                     ->groupBy("x.status");
        $count = 0;
        $result = $q->fetchArray();
        $arrayReturn = array();
        foreach($result as $object){
            $count++;
            $arrayReturn[$count]["total"] = $object["total"];
            $arrayReturn[$count]["status"] = $object["status"];
        }
        return $arrayReturn;
    }



    /**
     * Fun��o para exibir a imagem do registro indicado de acordo com o prefixo fornecido
     *
     * @param object	 Objeto a ser verificado
     * @param prefix     Prefixo usado na imagem
     * @return String
     */
    public function showImage($object, $prefix, $startUrl="", $startUrlTestImage=""){
        $config = new IPanelConfig($this->modelName);
        $url = "ipanel/uploads/".$config->getParameter("uploads.folder");
        if($prefix != ""){
            if(file_exists($startUrlTestImage.$url."/".$object['id']."/".$prefix.'.jpg')){
                $image = $startUrl.$url."/".$object['id']."/".$prefix.'.jpg';
            }else{
                $image = $startUrl.$url."/".$object['id']."/".$object['imagem'];
            }
        }else{
            $image = $startUrl.$url."/".$object['id']."/".$object['imagem'];
        }
        return $image;
    }




    /**
     * Fun��o para exibir a imagem do registro indicado de acordo com o prefixo fornecido
     *
     * @param object	 Objeto a ser verificado
     * @param prefix     Prefixo usado na imagem
     * @return Boolean
     */
    public function hasImages($object){
        $control = new GenericCtrl("Foto");
        $config = new IPanelConfig($this->modelName);
        $folder = $config->getParameter("uploads.folder");
        $fotos = $control->getObjectByFields(array("local", "regId"), array($folder, $object['id']));
        if(count($fotos) > 0){
            return true;
        }else{
            return false;
        }
    }


    /**
     * Fun��o para retornar a lista de fotos de determinado registro
     *
     * @param id	 C�digo do registro
     * @return Array
     */
    public function getImages($id){
        $control = new GenericCtrl("Foto");
        $config = new IPanelConfig($this->modelName);
        $folder = $config->getParameter("uploads.folder");
        $uploadFolder =  "ipanel/uploads/".$folder."/".$id."/";
        $fotos = $control->getObjectByFields(array("local", "regId"), array($folder, $id));
        $arrayFotos = array();
        $count = 0;
        foreach($fotos as $foto){
            $count++;
            $arrayFotos[$count]['thumb'] = $uploadFolder."thumb_".$foto['nome'];
            $arrayFotos[$count]['big']   = $uploadFolder."big_".$foto['nome'];
            $arrayFotos[$count]['legenda'] = $foto['legenda'];
        }
        return $arrayFotos;
    }
    


    /**
     * Retorna um objeto pelo ID
     * 
     * @param Integer $id ID do objeto a ser buscado
     * @return Object Objeto encontrado ou null se não encontrar
     */
    public function getObject($id) {
        if(!$id) return null;
        
        $q = Doctrine_Query::create()
            ->from($this->model . " x")
            ->where("x.id = ?", $id);
        
        $result = $q->fetchArray();
        
        if(count($result) > 0) {
            return $this->table->find($result[0]['id']);
        }
        
        return null;
    }

}

?>
