<?php

/**
 * Artista do Momento
 *
 *
 * @property serial $id
 * @property string $nomeArtista
 * @property string $musicaPrincipal
 * @property string $musica2
 * @property string $musica3
 * @property string $musica4
 * @property string $musica5
 * @property string $musica6
 * @property string $musica7
 * @property string $musica8
 * @property string $musica9
 * @property string $imagem
 *
 * @package    application
 * @subpackage model
 * @author     iMAXIS
 */
class artistaMomento extends Doctrine_Record
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
        $this->setTableName('artista_momento');

        $this->hasColumn('art_id as id', 'integer', null, array(
            'type' => 'integer',
            'primary' => true,
        ));

        $this->hasColumn('art_nomeArtista as nomeArtista', 'string', 100, array(
            'type' => 'string',
            'length' => '100',
        ));

        $this->hasColumn('art_musicaPrincipal as musicaPrincipal', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_musica2 as musica2', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_musica3 as musica3', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_musica4 as musica4', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_musica5 as musica5', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_musica6 as musica6', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_musica7 as musica7', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_musica8 as musica8', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_musica9 as musica9', 'string', 75, array(
            'type' => 'string',
            'length' => '75',
        ));

        $this->hasColumn('art_imagem as imagem', 'string', 255, array(
            'type' => 'string',
            'length' => '255',
        ));
    }
}
