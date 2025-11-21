<?php

/**
 * Assuntos Diversos da Vizi na Mídia
 *
 *
 * @property serial $id
 * @property string $titulo
 * @property string $data
 * @property string $imagemMiniatura
 * @property string $descricao
 * @property string $conteudo
 * @property string $autor
 * @property string $imagemBanner
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class ViziMidia extends Doctrine_Record
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
        $this->setTableName('vizi_midia');

        $this->hasColumn('vim_id as id', 'integer', null, [
            'primary' => true,
        ]);

        $this->hasColumn('vim_titulo as titulo', 'string', 45, [
            'length' => 45,
        ]);

        $this->hasColumn('vim_data as data', 'date', null, array(
            'type' => 'date',
        ));

        $this->hasColumn('vim_imgMin as imgMin', 'string', 100, [
            'length' => 100,
        ]);

        $this->hasColumn('vim_descricao as descricao', 'string', 60, [
            'length' => 60,
        ]);

        $this->hasColumn('vim_conteudo as conteudo', 'string', 2000, [
            'length' => 2000,
        ]);

        $this->hasColumn('vim_autor as autor', 'string', 45, [
            'length' => 45,
        ]);

        $this->hasColumn('vim_imgBanner as imgBanner', 'string', 100, [
            'length' => 100,
        ]);
    }
}
