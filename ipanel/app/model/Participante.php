<?php

/**
 * Participante
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $nome
 * @property string $cpf
 * @property string $idade
 * @property string $telefone
 * @property string $cidade
 * @property integer $proId

 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Participante extends Doctrine_Record {

    /**
     * Define os tipos de campos a serem utilizados para manutenção da tabela no banco de dados
     * Para cada campo é preciso ter uma variável definida com o mesmo nome.<br>
     * Ex: para o campo usr_email as email deve haver uma variável chamada $email adicionada <br>
     * nas linhas iniciais da classe como @property type $email(ex)
     * 
     * @return void  
     */
    public function setTableDefinition() {
        $this->setTableName('participante_promocao');
        $this->hasColumn('par_id as id', 'integer', null, array(
            'type' => 'integer',
            'primary' => true,
        ));
        $this->hasColumn('par_nome as nome', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('par_cpf as cpf', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('par_idade as idade', 'string', 80, array(
            'type' => 'string',
            'length' => '80',
        ));
        $this->hasColumn('par_telefone as telefone', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));
        $this->hasColumn('par_cidade as cidade', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));
        $this->hasColumn('pro_id as proId', 'integer', null, array(
            'type' => 'integer',
        ));
    }

}
