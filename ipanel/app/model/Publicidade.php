<?php

/**
 * Noticia
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $titulo
 * @property string $link
 * @property string $status
 * @property string $imagem
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Publicidade extends Doctrine_Record
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
        $this->setTableName('publicidade');
        $this->hasColumn('pub_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('pub_titulo as titulo', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
             ));
       $this->hasColumn('pub_status as status', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('pub_link as link', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('pub_imagem as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }
}
