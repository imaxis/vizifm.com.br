<?php

/**
 * Ganhador
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property date $data
 * @property string $login
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
class Ganhador extends Doctrine_Record {

    /**
     * Define os tipos de campos a serem utilizados para manutenção da tabela no banco de dados
     * Para cada campo é preciso ter uma variável definida com o mesmo nome.<br>
     * Ex: para o campo usr_email as email deve haver uma variável chamada $email adicionada <br>
     * nas linhas iniciais da classe como @property type $email(ex)
     * 
     * @return void  
     */
    public function setTableDefinition() {
        $this->setTableName('ganhadores');
        $this->hasColumn('gan_id as id', 'integer', null, array(
            'type' => 'integer',
            'primary' => true,
        ));
        $this->hasColumn('gan_data as dtSorteio', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('gan_login as login', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('gan_nome as nome', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('gan_nascimento as nascimento', 'date', null, array(
            'type' => 'date',
        ));
        $this->hasColumn('gan_cpf as cpf', 'string', 14, array(
            'type' => 'string',
            'length' => '14',
        ));
        $this->hasColumn('gan_pix as pix', 'string', 32, array(
            'type' => 'string',
            'length' => '32',
        ));
        $this->hasColumn('gan_telefone as telefone', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('gan_bairro as bairro', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('gan_endereco as endereco', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));
        $this->hasColumn('gan_cidade as cidade', 'string', 50, array(
            'type' => 'string',
            'length' => '50',
        ));
        $this->hasColumn('pro_id as proId', 'integer', null, array(
            'type' => 'integer',
        ));
        $this->hasColumn('gan_mensagem as mensagem', 'string', 355, array(
            'type' => 'string',
            'length' => '255',
        ));
        $this->hasColumn('gan_instagram as instagram', 'string', 355, array(
            'type' => 'string',
            'length' => '255',
        ));
        $this->hasColumn('gan_email as email', 'string', 355, array(
            'type' => 'string',
            'length' => '255',
        ));
    }

}
