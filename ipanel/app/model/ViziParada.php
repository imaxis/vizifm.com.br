<?php

/**
 * Promocao
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $artista
 * @property string $musica
 * @property string $tipo
 * @property string $imagem
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class ViziParada extends Doctrine_Record
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
        $this->setTableName('viziparada');
        $this->hasColumn('viP_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('viP_artista as artista', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('viP_musica as musica', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('viP_tipo as tipo', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('viP_imagem as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }
 
}
