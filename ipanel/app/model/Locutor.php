<?php

/**
 * Locutor
 *
 * Classe modelo para utiliza��o do Doctrine
 *
 * @property serial $id
 * @property string $nome
 * @property date   $nascimento
 * @property string $cidade
 * @property string $profissao
 * @property string $imagem

 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Locutor extends Doctrine_Record
{
    
    /**
     * Define os tipos de campos a serem utilizados para manuten��o da tabela no banco de dados
     * Para cada campo � preciso ter uma vari�vel definida com o mesmo nome.<br>
     * Ex: para o campo usr_email as email deve haver uma vari�vel chamada $email adicionada <br>
     * nas linhas iniciais da classe como @property type $email(ex)
     * 
     * @return void  
     */
    public function setTableDefinition()
    {
        $this->setTableName('locutores');
        $this->hasColumn('lc_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('lc_nome as nome', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
		$this->hasColumn('lc_nascimento as nascimento', 'date', null, array(
             'type' => 'date',
             ));
		$this->hasColumn('lc_cidade as cidade', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
		$this->hasColumn('lc_profissao as profissao', 'string', 80, array(
             'type' => 'string',
             'length' => '80',
             ));
        $this->hasColumn('lc_foto as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }
}