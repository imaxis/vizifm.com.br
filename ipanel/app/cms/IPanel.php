<?php

 if(!class_exists('IPanelFunctions'))
    require_once(APP_PATH."/cms/IPanelFunctions.php");
 if(!class_exists('IPanelConfig'))
    require_once(APP_PATH."/cms/IPanelConfig.php");
 if(!class_exists('GenericCtrl'))
    require_once(APP_PATH."/controller/GenericCtrl.php");


/**
 * Description of SetoresAdmin
 *
 * @author Cledson
 */
class IPanel {

    protected $currentArea;
    protected $currentMode;
    protected $parameters;
    protected $arrayExcludeParameters;
    protected $config;
    protected $menu;
    protected $controlClass;
    protected $defaultFieldSize = 60;
    protected $defaultFieldMaxLength = 200;
    protected $defaultTextAreaRows = 3;
    protected $arrayIds;

    /**
     * Seta o local atual
     * @param String $local    Local atual
     *
     * @return void
     */
    function setArea($area) {
        $this->currentArea = $area;
    }


    /**
     * Retorna o local atual
     *
     * @return String
     */
    function getArea() {
        return $this->currentArea;
    }


    /**
     * Seta o modo atual (Ex: Lista, Form)
     * @param String $modo       Local atual
     *
     * @return void
     */
    function setMode($mode) {
        $this->currentMode = $mode;
    }


    /**
     * Retorna o modo atual (Ex: Lista, Form)
     *
     * @return String
     */
    function getMode() {
        return $this->currentMode;
    }


    /**
     * Seta a configuração do setor atual
     * @param Array $config    Configuração do local atual
     *
     * @return void
     */
    function setConfig($config) {
        $this->config = $config;
    }


    /**
     * Retorna a instancia da classe de configuração do sistema
     *
     * @return Object
     */
    function getConfig() {
        return $this->config;
    }


    /**
     * Seta os dados do menu
     * @param Object $menu    Dados do menu
     *
     * @return void
     */
    function setMenu($menu) {
        $this->menu = $menu;
    }

    /**
     * Retorna a instancia da classe de controle do menu
     *
     * @return Object
     */
    function getMenu() {
        return $this->menu;
    }


    /**
     * Retorna o local atual
     *
     * @return String
     */
    function getControlClass() {
        return $this->controlClass;
    }


    /**
     * Gera a url com os parametros de paginação e pesquisa <br>
     * Estes parâmetros são passados via GET pela url
     * @param String $paramaters    Lista de parametros enviadas via GET
     * @param String $arrayExclude  Lista de parametros a serem ignorados na geração da url, separados por ,
     *
     * @return String
     */
    public function getParameters($parameters, $arrayExclude="") {
        $data = "";
        $this->arrayExcludeparameters = $arrayExclude;
        foreach($parameters as $parameter => $value){
            if(!$this->isExcludedFromParameters($parameter)){
                if($parameter == "buscarPor"){
                    list($field, $type) = explode("|", $value);
                    $data.= "&buscarPor=".$value;
                    $data.= "&".$field."=".$parameters[$field];
                }
                if($parameter == "page"){
                    $data.= "&page=".$value;
                }
                if($parameter == "order"){
                    $data.= "&order=".$value;
                }
                if($parameter == "resultByPage"){
                    $data.= "&resultByPage=".$value; 
                }
                if($parameter == "listFields"){
                    $data.= "&listFields=".$value; 
                }
                if($parameter == "action"){
                    $data.= "&action=".$value; 
                }
            }
            $data.= $this->getUrlParametersSearch($parameters); 
        }
        return $data;
    }
    
    
   /**
     * Gera a url com os parâmetros informados na pesquisa
     *
     * @return String
     */
    public function getUrlParametersSearch($get){
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
     * Verifica se o parâmetro informado deve ser ecluido na geração da nova url
     * @param String $field    Campo a ser comparado
     *
     * @return boolean
     */
    public function isExcludedFromParameters($field){
        $array = explode(",", $this->arrayExcludeParameters);
        $status = false;
        for($i=0; $i < count($array); $i++){
            if($field == $array[$i]){
                $status = true;
            }
        }
        return $status;
    }


    /**
     * Gera o script Jquery para posicionamento das máscaras para recorte de imagens
     *
     * @return html
     */
    public function writeMaskPosition(){
        $imageFields = $this->config->getParameter("images");
        $count = 0;
        $script = "";
        foreach($imageFields as $field => $value){
            $count++;
            $script.= $field.": [25,25,".$value['width'].",".$value['height']."]";
            if($count != count($imageFields)){
                $script.= ",";
            }
        }
        echo $script;
    }


    /**
     * Gera o script Jquery para criar o evento de click nos botões de tipo de recorte
     *
     * @return html
     */
    public function writeMaskButtonClick(){
        $imageFields = $this->config->getParameter("images");
        $count = 0;
        $script = "";
        foreach($imageFields as $field => $value){
            $count++;
            $script.= "$('#".$field."').click(function(){";
            $script.= "   $('#tipo').val('$field');";
            $script.= "});";
        }
        echo $script;
    }


    /**
     * Gera o código html dos botões para seleção do tipo de recorte de imagem
     *
     * @return html
     */
    public function writeMaskButton(){
        $imageFields = $this->getConfig()->getParameter("images");
        $count = 0;
        $html = "";
        foreach($imageFields as $field => $value){
            $count++;
            $html.= '<li class="cselet">';
            $html.= '<h2><a id="'.$field.'" title="Mostrar Máscara: '.$field.'" alt="Mostrar Máscara: '.$field.'" href="javascript:;">'.$field.'</a></h2>';
            $html.= '<span class="ctl"></span>';
            $html.= '<span class="ctr"></span>';
            $html.= '</li>';
        }
        echo $html;    
    }
    
    /**
     * Gera o código em Jquery para funções dos botões de redimensionamento
     *
     * @return html
     */
    public function writeFunctionMaskButton(){
        $imageFields = $this->config->getParameter("images");
        $html = "";
        $cont = 0;
        $firstField = "";
        foreach($imageFields as $field => $value){
            if($cont == 0){
                $firstField = $field;
            }
            $width = $this->config->getParameter("images.".$field.".width");
            $height = $this->config->getParameter("images.".$field.".height");
            $aspectRatio = $width."/".$height;
            $html.= "$('#$field').click(function(){";
            $html.= "   api.setOptions({ aspectRatio: ".$aspectRatio."});";
            $html.= "   api.setOptions({ minSize: [".$width.",".$height."]});";
            $html.= "   });";
        }
        $html.= "$('#$firstField').click();";
        echo $html;
    }

    

    /**
     * Retorna o código html para o grid de listagem de registros
     * @param Array $arrayObjects      Array de objetos a serem listados no grid
     *
     * @return html
     */
    public function writeGrid($arrayObjects, $parameters){
        $html = '<table>';
        $html.= ' <tr>';
        $html.= '  <td>';
        $html.= '   <ul class="list_listing">';
        $html.= '   <li>';
        $html.= '<table>';
        $html.= $this->writeGridHeader($parameters);
        $html.= $this->writeGridBody($arrayObjects, $parameters);
        $html.= $this->writeGridHeader($parameters);
        $html.= '</table>';
        $html.= '   </li>';
        $html.= '   </ul>';
        $html.= '   </td>';
        $html.= '  </tr>';
        $html.= '</table>';
        $html.= '<input name="ids" type="hidden" id="ids" value="'.$this->arrayIds.'"/>';
        print $html;
    }


    /**
     * Retorna o código html para o sub grid de listagem de registros
     * @param Array $arrayObjects      Array de objetos a serem listados no grid
     *
     * @return html
     */
    public function writeGridDetails($arrayObjects, $fields, $title=""){
        $html.= '<table>';
        $html.= $this->writeGridHeaderDetails($fields);
        $html.= $this->writeGridBodyDetails($arrayObjects, null, true, $fields);
        $html.= '</table>';
        return $html;
    }


   /**
     * Retorna o código html para o cabeçalho do grid de listagem de registros
     *
     * @return html
     */
    public function writeGridHeader($parameters){
        $html.= ' <tr class="list_top">';
        $html.= '  <td width="2%"><input name="" type="checkbox" value="" /></td>';
        $html.= '  <td width="3%"><a href="?lc='.$this->getArea().'&md=Lista'.$parameters.'&order=id">ID</a></td>';
        // Retorna o nome e o tamanho dos campos de texto a serem exibidos
        foreach($this->config->getFields() as $fields){
            foreach($fields as $field => $value){
                if($value['grid'] == true){
                     $width = ($value['columnWidth'] != null) ? " width='".$value['columnWidth']."'" : "";
		     $order = ($value['orderByType'] != null) ? $field." ".$value['orderByType'] : $field;
                     $html.= '   <td '.$width.'><a href="?lc='.$this->getArea().'&md=Lista'.$parameters.'&order='.$order.'">'.$value['name'].'</a></td>';
                }
            }
        }
        $html.= '</tr>';
        return $html;
    }


    /**
     * Retorna o código html para o cabeçalho do grid de listagem de registros
     *
     * @return html
     */
    public function writeGridHeaderDetails($listFields){
        $html.= ' <tr class="list_top_details">';
        foreach($listFields as $fields){
            foreach($fields as $field => $value){
                if($value['grid'] == true){
                     $width = ($value['columnWidth'] != null) ? " width='".$value['columnWidth']."'" : "";
		     $order = ($value['orderByType'] != null) ? $field." ".$value['orderByType'] : $field;
                     $html.= '   <td '.$width.'>'.$value['name'].'</td>';
                }
            }
        }
        $html.= '</tr>';
        return $html;
    }
    
    
    /**
     * Retorna o código html com os registros para preenchimento do grid
     * @param Array $arrayObjects      Array de objetos a serem listados no grid
     *
     * @return html
     */
    public function writeGridBody($arrayObjects, $parameters, $isDetail=false, $configFields=null){
        $form = new IPanelForm();
        $html = "";
        // Efetua um laço no array de objetos
        if(count($arrayObjects) > 0){
            foreach($arrayObjects as $objects => $object){
                $this->arrayIds =  "i".$object['id']."-".$this->arrayIds;
                $this->arrayIds =  "reg".$object['id']."-".$this->arrayIds;
                $colunas = 0;
                $html.= '<tr class="iten_list" id="reg'.$object['id'].'">';
                $html.= ' <td width="2%"><input type="checkbox" name="check[]" value="'.$object['id'].'"/></td>';
                $html.= ' <td width="3%">'.$object['id'].'</td>';
                $listFields = ($configFields != null) ? $configFields : $this->config->getFields();
                foreach($listFields as $fields){
                    foreach($fields as $field => $value){
                        if($value['grid'] == true){
                            $colunas++;
                            // Verifica se foi especificada uma função para tratamento do campo
                            $valueField = $form->getValueField($field, $value, $object);
                            if($value['strong'] == true){
                                $html.= '<td class="tx_titulo">';
                                $html.= '<h1> '.$valueField.'</h1>';
                            }else{
                                $html.= '<td>';
                                $html.= $valueField;
                            }

                            if($colunas == 1 && !$isDetail){
                                $html.= ' <div id="editTools'.$object['id'].'" class="list_actions" style="display:block">';
                                if($this->config->getParameter("showEditButton") && $this->verificaPermissao($this->getArea(), "Alterar")){
                                    $html.= ' <a title="Editar Registro" href="?lc='.$this->getArea().'&md=Form&id='.$object['id'].$parameters.'">Editar</a> |';
                                } if($this->config->getParameter("showDeleteButton") && $this->verificaPermissao($this->getArea(), "Excluir")){
                                    $html.= ' <a title="Apagar Registro" href="javascript:if(confirm('.chr(39).'Deseja realmente excluir este registro ?'.chr(39).')){window.parent.location='.chr(39).'../app/cms/processa.php?lc='.$this->getArea().'&md=DeleteUnique&id='.$object['id'].$parameters.chr(39).'}">Apagar</a> |';
                                } if($this->config->getParameter("showEditButton") && $this->verificaPermissao($this->getArea(), "Alterar")){
                                    if($this->hasImageCrop()){
                                        $html.= ' <a title="Recorte de Imagens" href="?lc='.$this->getArea().'&md=Recorte&id='.$object['id'].'&folder='.$this->config->getParameter("uploads.folder").'&imagem='.$object['imagem'].$parameters.'">Recorte de Imagens</a> |';
                                    }
                                } if($this->config->getParameter("showEditButton") && $this->verificaPermissao($this->getArea(), "Alterar")){
                                    if($this->hasImageGallery()){
                                        $html.= ' <a title="Galeria de Imagens" href="?lc='.$this->getArea().'&md=Fotos&id='.$object['id'].$parameters.'">Galeria de Fotos</a> |';
                                    }
                                }
                                $html.= '<a title="Ver Detalhes" href="javascript:;" onclick="showHideDiv('.chr(39).'i'.$object['id'].chr(39).','.chr(39).'reg'.$object['id'].chr(39).')">Ver Detalhes</a>';
                                if($this->config->getRelations() != ""){
                                    foreach($this->config->getRelations() as $relations){
                                        foreach($relations as $relation => $relationValue){
                                            if($relationValue['type'] == "expansive"){
                                                $html.= ' | <a title="'.$relationValue['title'].'" href="javascript:;" onclick="showHideDiv('.chr(39).strtolower($relation).$object['id'].chr(39).', '.chr(39).'reg'.$object['id'].chr(39).')">'.$relationValue['title'].'</a>';
                                            }else{
                                                $target = ($relationValue['target'] != null && $relationValue['target'] != "") ? $relationValue['target'] : "_self";
                                                $additionalData= ($relationValue['additionalData'] != null && $relationValue['additionalData'] != "") ? "&".$relationValue['additionalData'] : "";
                                                $attributes = explode(",", $relationValue['relationFields']);
                                                $strAttributes = $additionalData;
                                                for($i=0; $i < count($attributes); $i++){
                                                    $strAttributes.= "&".$attributes[$i]."=".$object[$attributes[$i]];
                                                }
                                                $html.= ' | <a title="'.$relationValue['title'].'" target="'.$target.'" href="'.$relationValue['url'].'?lc='.$this->getArea().$strAttributes.$parameters.'">'.$relationValue['title'].'</a>';
                                            }
                                        }
                                    }
                                }
                               $html.= '</div>';

                            }
                             
                            $html.= '</td>';
                          }
                       }
                   }
                   $html.= '</tr>';
                   $html.= '<tr class="iten_list" style="display:none" id="i'.$object['id'].'">';
                   $html.= ' <td colspan="'.($colunas + 2).'">';
                   $html.=   $this->writeDetails($object);
                   $html.= ' </td>';
                   $html.= '</tr>';
                   if($this->config->getRelations() != ""){
                       foreach($this->config->getRelations() as $relations){
                           foreach($relations as $relation => $relationValue){
                               if($relationValue['type'] == "expansive"){
                                    $html.= '<tr class="iten_list bg_listing" style="display:none" id="'.strtolower($relation).$object['id'].'">';
                                    $html.= ' <td colspan="'.($colunas + 2).'">';
                                    $ipanelConfig = new IPanelConfig($relation);
                                    $html.= $this->writeGridDetails($object[$relationValue['listField']], $ipanelConfig->getFields());
                                    $html.= ' </td>';
                                    $html.= '</tr>';
                                    $this->arrayIds =  strtolower($relation).$object['id']."-".$this->arrayIds;
                               }
                           }
                       }
                   }
            }
        }

        return $html;
    }


    /**
     * Retorna o código html com os registros para preenchimento do grid
     * @param Array $arrayObjects      Array de objetos a serem listados no grid
     *
     * @return html
     */
    public function writeGridBodyDetails($arrayObjects, $parameters, $isDetail=false, $configFields=null){
        $form = new IPanelForm();
        $html = "";
        // Efetua um laço no array de objetos
        if(count($arrayObjects) > 0){
            foreach($arrayObjects as $objects => $object){
                $colunas = 0;
                $html.= '<tr>';
                $listFields = ($configFields != null) ? $configFields : $this->config->getFields();
                foreach($listFields as $fields){
                    foreach($fields as $field => $value){
                        if($value['grid'] == true){
                            $valueField = $form->getValueField($field, $value, $object);
                            if($value['strong'] == true){
                                $html.= '<td class="tx_titulo">';
                                $html.= '<h1> '.$valueField.'</h1>';
                            }else{
                                $html.= '<td>';
                                $html.= $valueField;
                            }
                            $html.= '</td>';
                          }
                       }
                   }
                   $html.= '</tr>';
            }
        }

        return $html;
    }

    

    public function getTitleIcon(){
        $arrayIcones = $this->getConfig()->getParameter("icons");
        $arrayRetorno = array();
        if($arrayIcones != null){
            foreach($arrayIcones as $icones => $icone){
                array_push($arrayRetorno, array("name" => $icone['name'], "field" => $icones));
            }
        }
        return $arrayRetorno;
    }



    public function getImageIcon($object){
        $arrayIcones = $this->getConfig()->getParameter("icons");
        $arrayRetorno = array();
        if($arrayIcones != null){
            foreach($arrayIcones as $icones => $icone){
                 foreach($icone as $value => $data){
                     if(!(strpos($value, "conditional") === false)){

                         $valueToCompare = ($data['value'] == "()") ? "" : $data['value'];
                         $operator = $data['operator'];

                         if($operator == "!=" && $object[$icones] != $valueToCompare) {
                                 array_push($arrayRetorno, array("src" => $data['icon'], "title" => $data['title']));
                         }
                         if($operator == "==" && $object[$icones] == $valueToCompare) {
                                 array_push($arrayRetorno, array("src" => $data['icon'], "title" => $data['title']));
                         }
                         if($operator == ">=" && $object[$icones] >= $valueToCompare) {
                                 array_push($arrayRetorno, array("src" => $data['icon'], "title" => $data['title']));
                         }
                         if($operator == ">" && $object[$icones] > $valueToCompare) {
                                 array_push($arrayRetorno, array("src" => $data['icon'], "title" => $data['title']));
                         }
                         if($operator == "<=" && $object[$icones] <= $valueToCompare) {
                                 array_push($arrayRetorno, array("src" => $data['icon'], "title" => $data['title']));
                         }
                         if($operator == "<" && $object[$icones] < $valueToCompare) {
                                 array_push($arrayRetorno, array("src" => $data['icon'], "title" => $data['title']));
                         }
                     }
                 }
            }
        }
        return $arrayRetorno;
    }

    /**
     * Retorana a imagem para uso na pagina interna
     * A primeira imagem buscada é sempre o nome da área em minusculo e singular .png
     * Ex: Area de Noticias, imagem = noticia.png
     *
     * @return html
     */
    public function getImage(){
        $image = "<img src='img/big_ico_edit.gif' width='80' height='60'  class='left'/>";
        if(file_exists(IPANEL_PATH."/view/img/".strtolower($this->getArea().".png")))
           $image = "<img src='img/".$this->getArea().".png' width='80' height='60'  class='left'/>";
        return $image;
    }


    /**
     * Verifica se existem imagens a serem redimensionadas via recorte
     *
     * @return Boolean
     */
    public function hasImageCrop(){
        $imageFields = $this->config->getParameter("images");
        $status = false;
        if($imageFields != null){
            foreach($imageFields as $field => $value){
                $status = true;
            }
        }
        return $status;
    }


    /**
     * Verifica se existe galeria de imagens para o setor atual
     *
     * @return Boolean
     */
    public function hasImageGallery(){
        $galleryFields = $this->config->getParameter("gallery");
        $status = false;
        if($galleryFields != null){
            foreach($galleryFields as $gallery => $value){
                $status = true;
            }
        }
        return $status;
    }



    /**
     * Inclui o arquivo referente ao setor atual para geração do visual
     * @param String $prm    Parametros adicionais
     *
     * @return void
     */
    function output(){
        $class = $this->getConfig()->getParameter("controlClass");
        $this->controlClass = $class != null ? $class : $this->getArea()."Ctrl";
        $view = $this->getConfig()->getParameter("viewFile");
        $form = $this->getConfig()->getParameter("formFile");
        if($view == null){
            $view = "viewDefault";
            $form = "formDefault";
        }
        if($this->getArea() == "Iniciar"){
            $view = "viewInicio";
            $form = "";
            $this->controlClass = "GenericCtrl";
        }
        /*if($this->getArea() == "Backup"){
            $view = "viewBackup";
            $form = "formBackup";
            $this->controlClass = "GenericCtrl";
        }*/
        if($this->getMode() == "Lista" || $this->getArea() == "Iniciar"){
            $include = $view != null ? $view.".php" : "view".$this->getArea().".php";
        }else if($this->getMode() == "Form"){
            $include = $form != null ? $form.".php" : "view".$this->getArea().".php";
        }else if($this->getMode() == "Recorte"){
            $include = "modRecorte.php";
        }else if($this->getMode() == "Fotos"){
            $include = "modFotos.php";
        }else{
            $include = strtolower($this->getMode()).$this->getArea().".php";
        }
        if(!class_exists($this->controlClass)){
            include(APP_PATH."/controller/".$this->controlClass.".php");
        }
        include $include;
    }

}

?>
