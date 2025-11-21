<?php

/**
 * Noticia
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $notData
 * @property string $titulo
 * @property string $legenda
 * @property string $descricao
 * @property string $imagem
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Noticia extends Doctrine_Record
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
        $this->setTableName('noticias');
        $this->hasColumn('not_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('not_titulo as titulo', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
             ));
        $this->hasColumn('not_descricao as descricao', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('not_legenda as legenda', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('not_data as notData', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('not_imagem as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }
}
