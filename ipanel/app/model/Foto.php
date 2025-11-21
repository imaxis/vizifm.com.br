<?php

/**
 * Foto
 *
 * Classe modelo para utilização do Doctrine
 *
 * @property serial $id
 * @property string $nome
 * @property string $local
 * @property string $legenda
 * @property string $regId
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Foto extends Doctrine_Record
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
        $this->setTableName('fotos');
        $this->hasColumn('ft_id as id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ft_nome as nome', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ft_local as local', 'string', 35, array(
             'type' => 'string',
             'length' => '35',
             ));
        $this->hasColumn('ft_legenda as legenda', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('reg_id as regId', 'integer', null, array(
             'type' => 'integer',
             ));
    }



    /**
     * Construtor principal
     * Explicita o tipo do modelo, para utilização com sistemas de reflexo de objetos.
     * Ex: Flex
     */
    public function construct()
    {
        $this->mapValue('_explicitType', 'model.Foto');
    }
}
