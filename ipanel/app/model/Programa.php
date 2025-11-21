<?php

/**
 * Programa
 *
 * Classe modelo para utiliza��o do Doctrine
 *
 * @property serial     $id
 * @property string     $nome
 * @property time       $inicio
 * @property time       $fim
 * @property string     $dia
 * @property string     $descricao
 * @property string     $imagem
 * @property Locutor    $locutor
 * @property integer    $lcId
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Programa extends Doctrine_Record
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
        $this->setTableName('programas');
        $this->hasColumn('pr_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('pr_titulo as nome', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
	$this->hasColumn('pr_inicio as inicio', 'string', 10, array(
             'type' => 'time',
             'length' => '10',
             ));
	$this->hasColumn('pr_fim as fim', 'string', 10, array(
             'type' => 'time',
             'length' => '10',
             ));
        $this->hasColumn('lc_id as lcId', 'integer', null, array(
             'type' => 'integer',
             ));
	$this->hasColumn('pr_dia as dia', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
	$this->hasColumn('pr_descricao as descricao', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('pr_foto as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }
    
    /**
     * Seta os relacionamentos da classe atual
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Locutor as locutor', array(
                      'local' => 'lc_id',
                      'foreign' => 'lc_id'));
    }
}