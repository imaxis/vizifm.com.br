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
        $this->hasColumn('ins_cpf as cpf', 'string', 14, array(
            'type' => 'string',
            'length' => '14',
        ));
        $this->hasColumn('ins_pix as pix', 'string', 32, array(
            'type' => 'string',
            'length' => '32',
        ));
        $this->hasColumn('ins_endereco as endereco', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));
        $this->hasColumn('ins_numero as numero', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));
        $this->hasColumn('ins_bairro as bairro', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('ins_complemento as complemento', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('ins_cidade as cidade', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('ins_facebook as facebook', 'string', 50, array(
            'type' => 'string',
            'length' => '250',
        ));
        $this->hasColumn('ins_instagram as instagram', 'string', 50, array(
            'type' => 'string',
            'length' => '250',
        ));
        $this->hasColumn('ins_email as email', 'string', 50, array(
            'type' => 'string',
            'length' => '250',
        ));
        $this->hasColumn('ins_resposta_01 as resposta_1', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_02 as resposta_2', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_03 as resposta_3', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_04 as resposta_4', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_05 as resposta_5', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_06 as resposta_6', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_07 as resposta_7', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_08 as resposta_8', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_09 as resposta_9', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_10 as resposta_10', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_11 as resposta_11', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_12 as resposta_12', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_13 as resposta_13', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_14 as resposta_14', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_resposta_15 as resposta_15', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ins_mensagem as mensagem', 'string', 355, array(
            'type' => 'string',
            'length' => '255',
        ));
		 $this->hasColumn('ins_resposta_select as resposta_select', 'string', 355, array(
            'type' => 'string',
            'length' => '255',
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
