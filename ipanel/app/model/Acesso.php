<?php

/**
 * Acesso
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial  $id
 * @property string  $ip
 * @property date    $data
 * @property time    $hora
 * @property string  $host
 * @property string  $referencia
 * @property string  $local
 * @property integer $usrId
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Acesso extends Doctrine_Record
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
        $this->setTableName('acessos');
        $this->hasColumn('ac_id as id', 'serial', null, array(
             'type' => 'serial',
             'primary' => true,
             ));
        $this->hasColumn('ac_ip as ip', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ac_data as data', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ac_hora as hora', 'time', null, array(
             'type' => 'time',
             ));
        $this->hasColumn('ac_host as host', 'string', 180, array(
             'type' => 'string',
             'length' => '180',
             ));
        $this->hasColumn('ac_referencia as referencia', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('ac_local as local', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
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
    }


    /**
     * Construtor principal
     * Explicita o tipo do modelo, para utilização com sistemas de reflexo de objetos.
     * Ex: Flex
     */
    public function construct()
    {
        $this->mapValue('_explicitType', 'model.Acesso');
    }
}