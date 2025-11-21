<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!class_exists('IPanel'))
    require_once(APP_PATH."/cms/IPanel.php");
if(!class_exists('IPanelMenu'))
    require_once(APP_PATH."/cms/IPanelMenu.php");
if(!class_exists('IPanelConfig'))
    require_once(APP_PATH."/cms/IPanelConfig.php");
if(!class_exists('IPanelForm'))
    require_once(APP_PATH."/cms/IPanelForm.php");

class IPanelApp extends IPanel {


    public function setMenu($menu = null){
        $this->menu = new IPanelMenu($this->getArea());
    } 

    public function setConfig($config = null){
        $this->config = new IPanelConfig($this->getArea());
    }

    public function getCurrentTitle(){
        return $this->getMenu()->getCurrentTitle();
    }

    public function getCurrentDescription(){
        return $this->getMenu()->getCurrentDescription();
    }

    public function getCurrentAlias(){
        return $this->getMenu()->getCurrentAlias();
    }

    public function writeStatusOptions(){
        if($this->getConfig()->getParameter("status") != null){
          /*  $control = new GenericCtrl($this->getArea());
            $arrayStatus = $control->getStatusList();
            $html = "<h4>";
            $html.= "   <a title='Listar todos os registros' class='stselect' href='#todos'>Tudo</a> (".count($arrayStatus).") |";
            foreach($arrayStatus as $status){
                $html.= "<a title='Listar ".$status[status]."' href='#publicados'>Publicado</a> (".$status['total'].") |";
            }
            $html.= "</h4>";*/
        }
    }

    
    /**
     * Gera o código html para o campo de seleção de tipo de pesquisa
     *
     * @return html
     */
    public function writeSearchForm($field, $valueIni, $valueEnd, $get){
        $form = new IPanelForm($this->getArea());
        $form->setConfig($this->getConfig());
        $form->setArea($this->getArea());
        if($this->getConfig()->getParameter("searchType") == "advanced"){
            echo $form->writeAdvancedSearchForm($get);
        }else{
            echo $form->writeSearchForm($field, $valueIni, $valueEnd);
        }
    }



    /**
     * Retorna o código html para lista de detalhes do registro
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    public function writeDetails($object){
        $functions = new IPanelFunctions();
        foreach($this->getConfig()->getFields() as $fields){
            foreach($fields as $field => $value){
                if($value['detail'] == true && $value['grid'] != true){

                     //
                     // Verifica se foi especificado uma função para tratamento do campo
                     //
                     $subfield = explode(".", $field);
                     switch(count($subfield)){
                         case "1": $valueField = $object[$subfield[0]]; break;
                         case "2": $valueField = $object[$subfield[0]][$subfield[1]]; break;
                         case "3": $valueField = $object[$subfield[0]][$subfield[1]][$subfield[2]]; break;
                         case "4": $valueField = $object[$subfield[0]][$subfield[1]][$subfield[2]][$subfield[3]]; break;
                     }
                     if($value['listFunction'] != ""){
                         $function = $value['listFunction'];
                         $valueField = $functions->$function($valueField);
                     }
                     if($value['type'] == "image"){
                        $uploads = $this->getConfig()->getParameter("uploads.folder");
                        $html.= '   <li style="min-height:25px; border-bottom:0px; width:1315px; clear:both;"><div align="right" width="110" style="float:left; padding-right:5px; width:110px;"><strong>&nbsp;'.$value['name'].':</strong></div>';
                        $html.= '   <div style="width:1180px; float:left; margin-left:15px;"><img src="../uploads/'.$uploads.'/'.$object['id'].'/'.$valueField.'" width="120"/></div></li>';
                     }
                     else if($value['type'] == "file"){
                        $uploads = $this->getConfig()->getParameter("uploads.folder");
                        $html.= '   <br/><li style="min-height:25px;border-bottom:0px; width:1315px; clear:both;"><div align="right" width="110" style="float:left;border-bottom:0px; width:110px; padding-right:5px"><strong>'.$value['name'].':</strong></div>';
                        $html.= '   <div style="width:1180px; float:left; margin-left:15px;"><a href="../uploads/'.$uploads.'/'.$object['id'].'/'.$valueField.'" target="_blank">&nbsp;'.$valueField.'</a></div><div style="clear:both !important"></div></li>';
                     }
                     else{
                        $html.= '   <br/><li style="min-height:25px;border-bottom:0px; width:1315px; clear:both;"><div align="right" width="110" style="float:left; width:110px"><strong>&nbsp;'.$value['name'].':</strong></div>';
                        $html.= '   <div style="width:1180px; float:left; margin-left:15px;">&nbsp;'.$valueField.'</div></li>';
                       // $html.= '   <div align="right" width="110" style="float:left; width:110px; height:35px"><strong>&nbsp;'.$value['name'].':</strong></div>';
                      //  $html.= '   <div style="width:300px; float:left; margin-left:15px; height:35px">&nbsp;'.$valueField.'</div>';
                     }
                }
            }
        }
        return $html;
    }


    /**
     * Gera o código html do formulário do setor atual
     * Os campos são criados de acordo com a marcação form: true no arquivo de configuração
     * @param Object $object     Objeto a ser usado para popular o formulário
     *
     * @return html
     */
    public function writeForm($object){
        $form = new IPanelForm();
        $form->setConfig($this->getConfig());
        $form->setArea($this->getArea());
        return $form->writeForm($object);
    }


    /**
     * Gera o script Jquery para validação e mascaramento dos campos
     * Os campos de data possuem mascara predefinida não sendo necessário especifica-la
     * no arquivo de configuraçao.
     *
     * @return html
     */
    public function writeValidationScript(){
        $form = new IPanelForm();
        $form->setConfig($this->getConfig());
        $form->setArea($this->getArea());
        return $form->writeValidationScript();
    }

    /**
     * Gera o html para criação das áreas do setor administrativo
     * é efetuado um laço no array referente aos setores do admin que está registrado na sessão
     *
     * @return html
     */
    public function writeActionsForm($permissoes){
        session_start();
        $linksMenu = $_SESSION['setores'];
        $html = "";
        foreach($linksMenu as $keySetores){
           foreach($keySetores as $aba => $links){

               if($aba != "Iniciar"){

                   //
                   // Gera o link para a página inicial do sistema administrativo
                   //
                   foreach($links as $link => $value){
                       $html.= '<div class="div_permissao">';
                       $html.= '  <input type="checkbox" name="'.$link.'" id="'.$link.'" value="S"
                                   onclick="selectAllActionsBySetor('.chr(39).$link.chr(39).', '.chr(39).$value['actions'].chr(39).')"/>';
                       $html.= '     <span class="titulo_permissao">'.$value['name'].'</span><br/>';

                       $arrayAcoes = explode(",", $value['actions']);
                       for($i=0; $i < count($arrayAcoes); $i++){
                            $acao = str_replace(" ","",$arrayAcoes[$i]);
                            if($this->verificaPermissao($link, $acao, $permissoes)){
                                $checked = "checked";
                            }else{
                                $checked = "";
                            }
                            
                            $html.= '&nbsp;&nbsp;<input type="checkbox" name="'.$link.'_'.$acao.'" id="'.$link.'_'.$acao.'" value="S" '.$checked.'>';
                            $html.= '<span class="topico_permissao">'.$acao.'</span><br/>';
                       }
                       $html.= "    </div>";
                   }
               }
            }
        }
        print $html;
    }


    
    /**
     * Gera o html para criação das abas de navegação do setor administrativo
     * é efetuado um laço no array referente aos setores do admin que está registrado na sessão
     *
     * @return html
     */
    public function createArrayPermissions($post, $usrId){
        session_start();
        $linksMenu = $_SESSION['setores'];
        foreach($linksMenu as $keySetores){
           foreach($keySetores as $aba => $links){
               foreach($links as $link => $value){
                   $arrayAcoes = explode(",", $value['actions']);
                   for($i=0; $i < count($arrayAcoes); $i++){
                        $acao = str_replace(" ","",$arrayAcoes[$i]);
                        if($post[$link."_".$acao] == "S"){
                            $permissao = new Permissao();
                            $permissao->local = $link;
                            $permissao->acao  = $acao;
                            $permissao->usrId = $usrId;
                            $permissao->save();
                        }
                    }
                }
            }
        }
    }


    /**
     * Verifica se existe permissão de acesso para o setor
     * é efetuado um laço no array referente aos setores do admin que está registrado na sessão
     * @param String $local     Setor atual
     * @param String $acao      Acao a ser executada
     *
     * @return Boolean
     */
    public function verificaPermissao($local, $acao, $permissoes=null){
        session_start();
        if($permissoes == null){
            $permissoes = unserialize($_SESSION['permissoes']);
        }
        $status = false;
        if($permissoes != null){
            foreach($permissoes as $permissao){
                if($permissao['local'] == $local && $permissao['acao'] == $acao){
                    $status = true;
                }
            }
        }
        return $status;
    }


    /**
     * Verifica se existe permissão de acesso para o setor
     * é efetuado um laço no array referente aos setores do admin que está registrado na sessão
     * @param String $local     Setor atual
     * @param String $acao      Acao a ser executada
     *
     * @return Boolean
     */
    public function verificaPermissaoSetor($local){
        session_start();
        $permissoes = unserialize($_SESSION['permissoes']);
        $status = false;
        if($permissoes != null){
            foreach($permissoes as $permissao){
                if($permissao['local'] == $local){
                    $status = true;
                }
            }
        }
        return $status;
    }


   /**
     * Gera a url com os parâmetros informados na pesquisa
     *
     * @return String
     */
    public function writeUrlParametersSearch($get){
        if($this->getConfig()->getParameter("searchType") == "advanced"){
            $form = new IPanelForm();
            $form->setConfig($this->getConfig());
            $form->setArea($this->getArea());
            return $form->writeUrlParametersSearch($get);
        }else{
            return "";
        }
    }


   /**
     * Retorna o número de campos para a área de pesquisa
     *
     * @return Integer
     */
    public function getNumFieldsSearch(){
        $count = 0;
        foreach($this->getConfig()->getFields() as $fields){
            foreach($fields as $field => $value){
                if($value['search'] == true){
                    $count++;
                }
            }
        }
        return $count;
    }



    /**
     * Retorna a url a ser utilizada no action do formulário
     *
     * @return String
     */
    public function getActionFormUrl($get){
        $url = $this->getConfig()->getParameter("actionFormUrl");
        if($url == "" || $url == null){
            return "../app/cms/processa.php?lc=".$this->getArea().$this->getParameters($get);
        }else{
            return "../app/cms/".$url."?lc=".$this->getArea().$this->getParameters($get);
        }
    }

}
?>
