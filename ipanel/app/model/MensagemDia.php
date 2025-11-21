<?php

/**
 * Mensagem do dia
 *
 *
 * @property serial $id
 * @property string $titulo
 * @property string $mensagem
 * @property string $autor
 * @property string $dtExibicao
 * @property string $arquivo
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class MensagemDia extends Doctrine_Record
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
        $this->setTableName('mensagem_dia');

        $this->hasColumn('msg_id as id', 'integer', null, [
            'primary' => true,
        ]);

        $this->hasColumn('msg_titulo as titulo', 'string', 50, [
            'length' => 50,
        ]);

        $this->hasColumn('msg_mensagem as mensagem', 'string', 355, [
            'length' => 355,
        ]);

        $this->hasColumn('msg_autor as autor', 'string', 40, [
            'length' => 40,
        ]);

        $this->hasColumn('msg_dtExibicao as dtExibicao', 'date', null, array(
            'type' => 'date',
        ));

        $this->hasColumn('msg_arquivo as arquivo', 'string', 255, [
            'length' => 255,
        ]);
    }
}
