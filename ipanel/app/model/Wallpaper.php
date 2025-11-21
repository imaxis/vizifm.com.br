<?php

/**
 * Wallpaper
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $titulo
 * @property date   $waldata
 * @property string $ativo
 * @property string $imagem
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Wallpaper extends Doctrine_Record
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
        $this->setTableName('wallpaper');
        $this->hasColumn('wa_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('wa_titulo as titulo', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('wa_ativo as ativo', 'string', 1, array(
             'type' => 'string',
			 'length' => '3',
             ));
        $this->hasColumn('wa_foto as imagem', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('wa_data as waldata', 'date', null, array(
             'type' => 'date',
             ));
    }
}