<?php

/**
 * Banner
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $titulo
 * @property date   $bkpdata
 * @property time   $hora
 * @property string $arquivo
 * @property string $tamanho
 *
 *
 * @package    ipanel/app
 * @subpackage model
 * @author     iMAXIS
 */
class Backup extends Doctrine_Record
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
        $this->setTableName('backups');
        $this->hasColumn('bkp_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('bkp_titulo as titulo', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
             ));
        $this->hasColumn('bkp_arquivo as arquivo', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('bkp_tamanho as tamanho', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('bkp_data as bkpdata', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('bkp_hora as hora', 'time', null, array(
             'type' => 'time',
             ));
    }
}
