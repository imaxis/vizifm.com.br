<?php
/**
 *  Menu.php
 *  Classe de controle e geração dos menus de acesso
 *
 *  Pertencente ao pacote application.system.admin
 *
 *  Copyright (C) 2011  iMAXIS Soluções Digitais Ltda
 *  Autor: Cledson Lodi
 *
 *  Criado em 06/09/2011
 */


require_once(APP_PATH . "/system/yaml/Spyc.php");
if(!class_exists('Permissao'))
    require_once(APP_PATH."/model/Permissao.php");
if(!class_exists('Util'))
    require_once(APP_PATH."/util/Util.php");

class IPanelMenu {
    

    protected $arrayMenu = array();
    protected $itensMenu = "";
    protected $currentTab;
    protected $currentTitle;
    protected $currentDescription;
    protected $confirmationDescription;
    protected $formDescription01;
    protected $formDescription02;
    protected $currentArea;
    protected $currentDescriptionMenu;
    protected $actions;

    
    public function getItensMenu() {
        return $this->itensMenu;
    }

    public function getCurrentTab() {
        return $this->currentTab;
    }

    public function getCurrentTitle() {
        return $this->currentTitle;
    }

    public function getCurrentDescription() {
        return $this->currentDescription;
    }

    public function getCurrentDescriptionMenu() {
        return $this->currentDescriptionMenu;
    }

    public function getCurrentAlias() {
        if($this->currentAlias == null || $this->currentAlias == ""){
            return $this->currentTitle;
        }else{
            return '"'.$this->currentAlias.'"';
        }
    }

    public function getCurrentConfirmationDescription() {
        if(!empty($this->confirmationDescription)){
            $description.= $this->confirmationDescription;
        }else{
            $description.= "Registro salvo com sucesso.";
        }
        return $description;
    }
    
    public function getCurrentFormDescription(){
        $description = "";
        if(!empty($this->formDescription01)){
            $description.= $this->formDescription01;
        }else{
            $description.= "Atenção! Os campos em <strong>negrito</strong> são obrigatórios.";
        }
        if(!empty($this->formDescription02)){
            $description.= "<br/>".$this->confirmationDescription02;
        }else{
            $description.= "<br/>Clique em <strong>Confirmar</strong> após preencher corretamente o formulário abaixo para salvar o registro atual";
        }
        return $description;
    }

    public function getActions() {
        return $this->actions;
    }

    public function getCurrentArea() {
        return $this->currentArea;
    }

    public function setCurrentArea($area) {
        $this->currentArea = $area;
    }


    public function __construct($area=""){
        session_start();
        $this->setCurrentArea($area);
        if(!empty($_SESSION['setores'])){
            $linksMenu = $_SESSION['setores'];
            $contador = 0;
            if($linksMenu != null){
                foreach($linksMenu as $keySetores){
                   foreach($keySetores as $tab => $links){
                      $this->arrayMenu[$contador] = $tab;
                      $this->itensMenu.= "|".$tab;
                      $contador++;
                      foreach($links as $link => $value){
                         if($link == $this->getCurrentArea()){
                             $this->currentTab = $tab;
                             $this->currentTitle = $value['name'];
                             $this->currentAlias = $value['alias'];
                             $this->currentDescriptionMenu = $value['descriptionMenu'];
                             $this->currentDescription = $value['description'];
                             $this->actions = $value['actions'];
                             if(!empty($value['confirmation'])){
                                 $this->confirmationDescription = $value['confirmation'];
                             }
                             if(!empty($value['formMessage01'])){
                                 $this->formDescription01 = $value['formMessage01'];
                             }
                             if(!empty($value['formMessage02'])){
                                 $this->formDescription02 = $value['formMessage02'];
                             }
                          }
                      }
                  }
              }
           }
        }
    }


    /**
     * Gera o html para criação das abas de navegação do setor administrativo
     * é efetuado um laço no array referente aos setores do admin que está registrado na sessão
     *
     * @return html
     */
    public function writeMenuTabs(){
        $ipanelApp = new IpanelApp();
        $ipanelApp->setArea($this->getCurrentArea());
        session_start();
        $linksMenu = $_SESSION['setores'];
        $util = new Util();
        $html = "<div class='menu_left'>\n";
        $tabs = "";
        foreach($linksMenu as $keySetores){
           foreach($keySetores as $tab => $links){
               $writeTab = false;
               $newTab = "<div class='box_menu'>\n";
               $newTab.= "<a href='javascript:;' onClick=".chr(34)."showTab('".$util->nameForWeb($tab)."')".chr(34).">";
               $newTab.= "<div class='box_menu_tp'><span class='mctl'></span><span class='mctr'> </span>\n";
               $newTab.= "<h1>".$tab."</h1>\n";
               $newTab.= "</div>\n";
               $newTab.= "</a>";
               $newTab.= "<ul style='display:none' id='tab".$util->nameForWeb($tab)."'>\n";
               foreach($links as $link => $value){

                   if($ipanelApp->verificaPermissaoSetor($link) || $tab == "Iniciar"){
                       $writeTab = true;
                       $contador = 0;
                       if($value['mode'] != null && $value['mode'] != ""){
                           $mode = $value['mode'];
                       }else{
                           $mode = "Lista";
                       }
                       $linkUrl = $value['link'] != "" ? $value['link'] : "?lc=".$link."&md=".$mode;
                       $target = $value['target'] != "" ? "target='".$value['target']."'" : "";

                       if($this->getCurrentArea() == $link){
                           $css = "class='mselect'";
                       }else{
                           $css = "";
                       }
                       $newTab.= "<li>\n";
                       $newTab.= "<h2 ".$css.">\n";
                       $newTab.= "  <a title='".$value['name']."' alt='".$value['name']."' href='".$linkUrl."' ".$target.">".$value['name']."</a>\n";
                       $newTab.= "</h2>\n";
                       $newTab.= "</li>\n";
                   }
               }

               $newTab.= "</ul>\n";
               $newTab.= "<div class='box_menu_bt'><span class='mcbl'></span><span class='mcbr'></span></div>\n";
               $newTab.= "</div>\n";

               if($writeTab){
                   $html.= $newTab;
                   $tabs.= $util->nameForWeb($tab).";";
               }
            }
        }
        $html.= "<input type='hidden' id='tabs' value='".$tabs."'/>";
        $html.= "</div>\n";
        print $html;   
    }


}
?>
