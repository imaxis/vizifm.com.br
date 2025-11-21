<?php

/**
 * Enquete
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $pergunta
 * @property string $resp1
 * @property string $resp2
 * @property string $resp3
 * @property string $resp4
 * @property integer $voto1
 * @property integer $voto2
 * @property integer $voto3
 * @property integer $voto4
 * @property string  $ativa  
 * @property date   $endata
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Enquete extends Doctrine_Record
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
        $this->setTableName('enquete');
        $this->hasColumn('en_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('en_pergunta as pergunta', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('en_resp01 as resp1', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             ));
        $this->hasColumn('en_resp02 as resp2', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             ));        
        $this->hasColumn('en_resp03 as resp3', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             ));        
        $this->hasColumn('en_resp04 as resp4', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             )); 
        $this->hasColumn('en_voto01 as voto1', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('en_voto02 as voto2', 'integer', null, array(
             'type' => 'integer',
             ));            
        $this->hasColumn('en_voto03 as voto3', 'integer', null, array(
             'type' => 'integer',
             ));    
        $this->hasColumn('en_voto04 as voto4', 'integer', null, array(
             'type' => 'integer',
             ));    
        $this->hasColumn('en_ativo as ativa', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             )); 
        $this->hasColumn('en_data as endata', 'date', null, array(
             'type' => 'date',
             ));
    }
 
}
