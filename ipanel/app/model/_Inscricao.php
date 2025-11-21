<?php

/**
 * Inscricao
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $nome
 * @property int    $nascimento
 * @property string $telefone
 * @property string $bairro
 * @property string $cidade
 * @property string $mensagem

 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Inscricao extends Doctrine_Record {

    /**
     * Define os tipos de campos a serem utilizados para manutenção da tabela no banco de dados
     * Para cada campo é preciso ter uma variável definida com o mesmo nome.<br>
     * Ex: para o campo usr_email as email deve haver uma variável chamada $email adicionada <br>
     * nas linhas iniciais da classe como @property type $email(ex)
     * 
     * @return void  
     */
    public function setTableDefinition() {
        $this->setTableName('inscricoes');
        $this->hasColumn('ins_id as id', 'integer', null, array(
            'type' => 'integer',
            'primary' => true,
        ));
        $this->hasColumn('pro_id as proId', 'integer', null, array(
            'type' => 'integer',
        ));
        $this->hasColumn('ins_nome as nome', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('ins_nascimento as nascimento', 'date', null, array(
            'type' => 'date',
        ));
        $this->hasColumn('ins_telefone as telefone', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('ins_bairro as bairro', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('ins_cidade as cidade', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('ins_mensagem as mensagem', 'string', 355, array(
            'type' => 'string',
            'length' => '355',
        ));
    }

    /**
     * Seta os relacionamentos da classe atual
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->hasOne('Promocao as promocao', array(
            'local' => 'pro_id',
            'foreign' => 'pro_id'));
    }

}
