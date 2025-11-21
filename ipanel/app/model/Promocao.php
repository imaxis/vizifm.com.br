<?php

/**
 * Promocao
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $titulo
 * @property string $regulamento
 * @property string $premio
 * @property string $status
 * @property string $cadastro
 * @property string $imagem
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Promocao extends Doctrine_Record
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
        $this->setTableName('promocoes');
        $this->hasColumn('pro_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('pro_nome as titulo', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_regulamento as regulamento', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('pro_premios as premio', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_status as status', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_cadastro as cadastro', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_imagem as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('pro_endereco as endereco', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_facebook as facebook', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_email as email', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_aniver_semana as aniverSemana', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_instagram as instagram', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_cpf as cpf', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_pix as pix', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_dt_nascimento as dtNascimento', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pro_link as link', 'string', 100, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('pro_pergunta_01 as pergunta_1', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_02 as pergunta_2', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_03 as pergunta_3', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_04 as pergunta_4', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_05 as pergunta_5', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_06 as pergunta_6', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_07 as pergunta_7', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_08 as pergunta_8', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_09 as pergunta_9', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_10 as pergunta_10', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_11 as pergunta_11', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_12 as pergunta_12', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_13 as pergunta_13', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_14 as pergunta_14', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_pergunta_15 as pergunta_15', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pro_termos as termos', 'text', null, array(
             'type' => 'text',
             ));
		$this->hasColumn('pro_pergunta_select as pergunta_select', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
		$this->hasColumn('pro_resposta_select as resposta_select', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));	 			 	
    }
 
}
