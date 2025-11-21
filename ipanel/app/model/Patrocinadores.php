<?php

/**
 * Patrocinadores
 *
 *
 * @property serial $id
 * @property string $nome
 * @property string $setor
 * @property string $sobre
 * @property string $localizacao
 * @property string $link
 * @property string $imagem
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Patrocinadores extends Doctrine_Record
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
        $this->setTableName('patrocinadores');

        $this->hasColumn('ptr_id as id', 'integer', null, array(
            'type' => 'integer',
            'primary' => true,
        ));

        $this->hasColumn('ptr_nome as nome', 'string', 150, array(
            'type' => 'string',
            'length' => '150',
        ));

        $this->hasColumn('ptr_setor as setor', 'string', 100, array(
            'type' => 'string',
            'length' => '100',
        ));

        $this->hasColumn('ptr_sobre as sobre', 'text', null, array(
            'type' => 'text',
        ));

        $this->hasColumn('ptr_localizacao as localizacao', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));

        $this->hasColumn('ptr_link as link', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));

        $this->hasColumn('ptr_imagem as imagem', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));
    }
}
