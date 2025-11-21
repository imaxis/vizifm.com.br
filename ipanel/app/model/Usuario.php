<?php

/**
 * Usuario
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $status
 * @property string $nome
 * @property string $email
 * @property string $telefone
 * @property string $login
 * @property string $senha
 * @property string $dataCadastro
 * @property Doctrine_Collection $permissoes
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Usuario extends Doctrine_Record
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
        $this->setTableName('usuarios');
        $this->hasColumn('usr_id as id', 'serial', null, array(
             'type' => 'serial',
             'primary' => true,
             ));
        $this->hasColumn('usr_status as status', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('usr_nome as nome', 'string', 100, array(
             'type' => 'string',
             'length' => '150',
             ));
        $this->hasColumn('usr_email as email', 'string', 100, array(
             'type' => 'string',
             'length' => '150',
             ));
        $this->hasColumn('usr_telefone as telefone', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('usr_login as login', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             ));
        $this->hasColumn('usr_senha as senha', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('usr_data as dataCadastro', 'date', null, array(
             'type' => 'date',
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
        $this->hasMany('Permissao as permissoes', array(
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
        $this->mapValue('_explicitType', 'model.Usuario');
    }
}
