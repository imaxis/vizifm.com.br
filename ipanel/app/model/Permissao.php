<?php

/**
 * Permissao
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $local
 * @property string $acao
 * @property integer $usrId
 * @property Usuario $usuario
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Permissao extends Doctrine_Record
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
        $this->setTableName('permissoes');
        $this->hasColumn('prm_id as id', 'serial', null, array(
             'type' => 'serial',
             'primary' => true,
             ));
        $this->hasColumn('prm_local as local', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('prm_acao as acao', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
            ));
        $this->hasColumn('usr_id as usrId', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasOne('Usuario as usuario', array(
             'local' => 'usr_id',
             'foreign' => 'usr_id'));
    }


    /**
     * Construtor principal
     * Explicita o tipo do modelo, para utilização com sistemas de reflexo de objetos.
     * Ex: Flex
     */
    public function construct()
    {
        $this->mapValue('_explicitType', 'model.Permissao');
    }
}