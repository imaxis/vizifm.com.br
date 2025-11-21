<?php

/**
 * Musicas mais tocadas da semana
 *
 *
 * @property serial $id
 * @property string $nomeMusica
 * @property string $artista
 * @property string $genero
 * @property string $canal
 * @property string $url
 * @property string $arquivo
 * @property string $rankinkSemanal
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class Musicas extends Doctrine_Record
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
        $this->setTableName('musicas');

        $this->hasColumn('mus_id as id', 'integer', null, [
            'primary' => true,
        ]);

        $this->hasColumn('mus_nomeMusica as nomeMusica', 'string', 100, [
            'length' => 100,
        ]);

        $this->hasColumn('mus_artista as artista', 'string', 100, [
            'length' => 100,
        ]);

        $this->hasColumn('mus_genero as genero', 'string', 100, [
            'length' => 100,
        ]);

        $this->hasColumn('mus_canal as canal', 'string', 25, [
            'length' => 25,
        ]);

        $this->hasColumn('mus_url as url', 'string', 255, [
            'length' => 255,
        ]);

        $this->hasColumn('mus_arquivo as arquivo', 'string', 255, [
            'length' => 255,
        ]);

        $this->hasColumn('mus_rankingSemanal as rankingSemanal', 'string', 1, [
            'length' => 1,
        ]);
    }
}
