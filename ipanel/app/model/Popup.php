<?php

/**
 * Banner
 *
 * Classe modelo para utiliza��o do Doctrine
 *
 * @property serial $id
 * @property string $link
 * @property string $imagem

 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Popup extends Doctrine_Record
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
        $this->setTableName('popup');
        $this->hasColumn('pop_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('pop_titulo as titulo', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
             ));
        $this->hasColumn('pop_status as status', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pop_link as link', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('pop_imagem as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }
}