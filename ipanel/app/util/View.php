<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author Cledson
 */
class View {

    
    /**
     * Cria os links para geração da paginação
     * @param Integer $totalRegistros      Quantidade de registros do setor atual
     * @param Integer $paginaAtual         Número da página atual
     * @param Integer $registrosPorPagina  Número de registros por página
     *
     * @return void
     */
    function gerarPaginacao($totalRegistros, $paginaAtual, $registrosPorPagina) {
        $pagina = empty($paginaAtual) ? 1 : $paginaAtual;
        $anterior = $pagina - 1;
        $proxima  = $pagina + 1;
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        $html= "<ul class='contagem clear'>";
        for ($p = 1; $p <= $totalPaginas; $p++) {
            if ($p == $pagina) {
                $html.= "<a href='?pag=".$p."'>".$p."</a>";
            } else {
                $html.= "<a href='?pag=".$p."' class='pageSelect'>".$p."</a>";
            }
        }
        $html.="</ul>";
        if($totalPaginas > 1){
            print $html;
        }
    }
    

    /**
     * Verifica se uma imagem/ arquivo existe no servidor
     * @param String  $folder         Nome da pasta do setor
     * @param Integer $id             Identificador do registro atual
     * @param String  $imagem         Nome da imagem
     * @param String  $prefixo        Prefixo da imagem
     *
     * @return Boolean
     */
    function hasImagem($folder, $id, $imagem, $prefixo){
        if(!empty($prefixo)){
            $prefixo = $prefixo."_";
        }
        if(file_exists ("uploads/".$folder."/".$id."/".$prefixo.$imagem)){
            return true;
        }else{
            return false;
        }
    }
}
?>
