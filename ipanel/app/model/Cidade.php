<?php

/**
 * Cidade
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial     $id
 * @property string     $nome
 * @property integer    $populacao
 * @property date       $cidata
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Cidade extends Doctrine_Record
{
    
    /**
     * Define os tipos de campos a serem utilizados para manutenção da tabela no banco de dados
     * Para cada campo é preciso ter uma variável definida com o mesmo nome.<br>
     * Ex: para o campo usr_email as email deve haver uma variável chamada $email adicionada <br>
     * nas linhas iniciais da classe como @property type $email(ex)
     * 
     * @return void  
     */
    public function setTableDefinition()
    {
        $this->setTableName('cidades');
        $this->hasColumn('cid_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('cid_nome as nome', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
	$this->hasColumn('cid_populacao as populacao', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('cid_data as cidata', 'date', null, array(
             'type' => 'date',
             ));
    }
}