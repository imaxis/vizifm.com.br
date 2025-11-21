<?php

/**
 * Banner
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $link
 * @property string $imagem

 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Banner extends Doctrine_Record
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
        $this->setTableName('banner');
        $this->hasColumn('ban_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ban_link as link', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ban_imagem as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ban_target as target', 'integer', 1, array(
             'type' => 'integer',
             'length' => '1',
             ));
    }
}