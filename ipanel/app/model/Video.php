<?php

/**
 * Promocao
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $titulo
 * @property string $descricao
 * @property string $link
 * @property string $status
 * @property string $imagem
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Video extends Doctrine_Record
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
        $this->setTableName('videos');
        $this->hasColumn('vid_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('vid_titulo as titulo', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('vid_descricao as descricao', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('vid_link as link', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
             ));
    }
}
