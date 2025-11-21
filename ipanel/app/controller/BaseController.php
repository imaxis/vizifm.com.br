<?php

class BaseController{

    protected $connection;
    protected $table;
    protected $modelName = "";

    /**
     * Construtor principal da camada de controle
     * Inicia a conexao com a base dados, retornando a tabela (modelo) atual
     * @param String $modelName    Nome do modelo a ser setado
     */
    public function __construct($modelName=null) {
        $this->connection = Doctrine_Manager::connection();
        $this->modelName = $modelName;
        if($modelName != null){
            $this->table = $this->connection->getTable($this->modelName);
        }
    }


    /**
     * Seta a conexão para o modelo especificado
     * @param String $modelName    Nome do modelo a ser setado
     *
     * @return void
     */
    public function setConnection($modelName) {
        $this->modelName = $modelName;
        $this->connection = Doctrine_Manager::connection();
        $this->table = $this->connection->getTable($this->modelName);
    }

    
    /**
     * Salva o modelo (Objeto Atual)
     * @param Object  $object    Cópia do modelo a ser salvo
     * @param boolean $related   Informa se o modelo possui relacionamentos a serem salvos 
     * 
     * @return boolean
     */
    public function saveObject($object, $related=null) {
        if ($related)
            foreach ($related as $relation => $descriptor) {
                if ($descriptor["type"] == "many") {
                    for ($x = 0; $x < count($descriptor["value"]); $x++) {
                        $arr = & $object->$relation;
                        $arr[$x] = $descriptor["value"][$x];
                    }
                }else{
                    // verifica a existência da tabela
                    $testTable = $this->connection->getTable($descriptor["table"]);
                    $foreign_key = $descriptor["foreign_key"];
                    $test = $testTable->find($descriptor["value"]["$foreign_key"]);
                    (is_object($test)) ? $object->$descriptor["local_key"] = $descriptor["value"]["$foreign_key"] : $object->$relation = $descriptor["value"];
                }
            }
        return $object->save();
    }


    /**
     * Atualiza o modelo (Objeto Atual)
     * @param Object $objectId  Identificador do objeto atual
     * @param array  $fields     Array de campos a serem atualizados
     *
     * @return boolean
     */
    public function update($objectId, $fields) {
        $existing = $this->getObject($objectId);
        if (!$existing)
            return;
        foreach ($fields as $key => $val) {
            if ($existing->$key != $val) {
                if ($val === null && $existing->$key !== null)
                    continue;
                $existing->$key = $val;
            }
        }
        return $existing->save();
    }


    /**
     * Exclui um objeto
     * @param Object  $object    Referencia do modelo a ser excluido
     *
     * @return boolean
     */
    public function delete($object) {
        $existing = $this->getObject($object->id);
        if (!$existing)
            return;
        return $existing->delete();
    }


    /**
     * Retorna o objeto através do identificador
     * @param Integer  $objectId    Identificador do objeto
     *
     * @return Object
     */
    public function getObject($objectId) {
        return $this->table->find($objectId);
    }


    /**
     * Retorna o(s) objeto(s) através do campo informado
     * @param String   $field       Nome do campo a ser pesquisado
     * @param Object   $value       Valor a ser comparado
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      Início da listagem, funciona com $paged = true
     * @param String   $order       Ordenação do resultado
     *
     * @return mixed
     */
    public function getObjectByField($field, $value, $paged=false, $limit=0, $offset=0, $order=0) {
        $q = Doctrine_Query::create()
                        ->select("x.*")
                        ->where("x.$field = '$value'")
                        ->from($this->modelName . " x");
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


    /**
     * Retorna o(s) objeto(s) através dos campos informados
     * @param Array    $fields      Array com os nomes dos campos a serem pesquisados
     * @param Array    $values      Array com os valores a serem comparados
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      Início da listagem, funciona com $paged = true
     * @param String   $order       Ordenação do resultado
     *
     * @return mixed
     */
    public function getObjectByFields($fields, $values, $paged=false, $limit=0, $offset=0, $order=0) {
        $q = Doctrine_Query::create()->select("x.*");

        if ($fields[0] && $values[0])
            $q->where("x." . $fields[0] . " = '" . $values[0] . "'");

        for ($x = 1; $x < count($fields); $x++)
            if ($values[$x] !== null)
                $q->andWhere("x." . $fields[$x] . " = '" . $values[$x] . "'");

        $q->from($this->modelName . " x");

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
     * Retorna o(s) objeto(s) através dos campos informados pela area de busca
     * @param Array    $fields      Array com os nomes dos campos a serem pesquisados
     * @param Array    $values      Array com os valores a serem comparados
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      Início da listagem, funciona com $paged = true
     * @param String   $order       Ordenação do resultado
     *
     * @return Array
     */
    public function getObjectsForSearch($fields, $value, $paged=false, $limit=0, $offset=0, $order=0) {
        $q = Doctrine_Query::create()->select("x.*");
        $q->from($this->modelName . " x");
        if ($fields[0])
            $q->where("x." . $fields[0] . " LIKE '%" . $value . "%'");
        for ($x = 1; $x < count($fields); $x++)
           $q->orWhere("x." . $fields[$x] . " LIKE '%" . $value . "%'");
        
        if ($paged){
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



    /**
     * Retorna o objeto e seus relacionamentos através do campo informado
     * @param String   $field       Nome do campo a ser pesquisado
     * @param Integer  $objectId    Identificador do registro a ser pesquisado
     * @param Object   $value       Valor a ser comparado
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      Início da listagem, funciona com $paged = true
     *
     * @return mixed
     */
    public function getRelated($field, $objectId, $paged=false, $limit=0, $offset=0) {
        //	available relations:
        //		Alias: cliente, Type: one

        $rel = $this->table->getRelation($field);
        $q = Doctrine_Query::create()
                        ->select("x.*")
                        ->from($rel->getClass() . " x");

        if ($rel->getType() == Doctrine_Relation::MANY) {
            $q->where($rel->getForeignFieldName() . " = $clientecontador_id");
        } else {
            $foreignRelations = $this->connection->getTable($rel->getClass())->getRelations();
            $foreignRelation = null;

            foreach ($foreignRelations as $key => $value) {
                if ($value->getClass() == $this->modelName) {
                    $foreignRelation = $value->getAlias();
                    break;
                }
            }
            $q->leftJoin("x.$foreignRelation y")
                    ->where("y." . $rel->getForeign() . " = $clientecontador_id");
        }

        if ($paged) {
            if ($limit)
                $q->limit($limit);
            if ($offset)
                $q->offset($offset);
        }
        $result = $q->execute();
        return ($rel->getType() == Doctrine_Relation::ONE) ? $result[0] : $result;
    }


    /**
     * Retorna todos os objetos
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      Início da listagem, funciona com $paged = true
     *
     * @return mixed
     */
    public function getAllObjects($paged=false, $limit=0, $offset=0, $order="id DESC") {
        $q = Doctrine_Query::create()->select("*")->from($this->modelName);
        if ($paged) {
            if ($limit)
                $q->limit($limit);
            if ($offset)
                $q->offset($offset);
        }
        if ($order) {
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


     /**
     * Retorna um array com todos os objetos
     * @param Boolean  $paged       Se o resultado deve ser paginado
     * @param Integer  $limit       Limite de registros a ser retornado, funciona com $paged = true
     * @param Integer  $offset      Início da listagem, funciona com $paged = true
     *
     * @return Array
     */
    public function getArrayObjects($paged=false, $limit=0, $offset=0, $order="id DESC") {
        $q = Doctrine_Query::create()->select("*")->from($this->modelName);
        if ($paged) {
            if ($limit)
                $q->limit($limit);
            if ($offset)
                $q->offset($offset);
        }
        if ($order) {
            $q->orderBy($order);
        }
        return $q->fetchArray();
    }


    /**
     * Retorna o número total de registros gravados
     *
     * @return Integer
     */
    public function countObjects() {
        return $this->table->count();
    }


    /**
     * Retorna o número de relações existentes par ao objeto
     * @param String   $field       Nome do campo a ser pesquisado
     * @param Integer  $objectId    Identificador do registro a ser pesquisado
     *
     * @return Integer
     */
    public function countRelated($field, $objectId) {
        $related = $this->getRelated($field, $objectId);
        return get_class($related) != "Doctrine_Collection" ? 1 : $related->count();
    }


    /**
     * Retorna o valor do último identificador do objeto gravado
     *
     * @return Integer
     */
    public function getLastId() {
        $q = Doctrine_Query::create()->select("id")->from($this->modelName)->orderBy("id DESC")->limit(1);
        $obj = $q->fetchArray();
        return $obj[0]['id'];
    }
}

?>