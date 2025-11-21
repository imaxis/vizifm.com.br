<?php

if(!class_exists('IPanel'))
    require_once(APP_PATH."/cms/IPanel.php");
if(!class_exists('IPanelFunctions'))
    require_once(APP_PATH."/cms/IPanelFunctions.php");

 class IPanelForm extends IPanel{


    /**
     * Gera o código html do formulário do setor atual
     * Os campos são criados de acordo com a marcação form: true no arquivo de configuração
     * @param Object $object     Objeto a ser usado para popular o formulário
     *
     * @return html
     */
    public function writeForm($object){

        //
        // Abre a tabela para escrever o formulário
        //
        $html = '<div class="inputs_form">';

        //
        // Faz um laço nos campos
        //
        foreach($this->getConfig()->getFields() as $fields){
            foreach($fields as $field => $value){

                //
                // Se o campo está marcado para aparecer no formulário
                //
                if($value['form']){

                   //
                   // Se o campo está marcado obrigatório
                   //
                   if($value['required']){
                       $nameField = "<strong>".$value['name'].":</strong>";
                   }else{
                       $nameField = $value['name'].":";
                   }

                   if($value['type'] != "checkbox"){
                       $html.= ' <div class="sptl_fieldname">'.$nameField.'</div>';
                   }


                   $html.= '<div class="input_field">';

                   //
                   // Verifica se foi especificado uma função para tratamento do campo
                   //
                   $valueField = $this->getValueField($field, $value, $object);

                   //
                   // Caso o campo seja do tipo string, email ou data
                   //
                   if($value['type'] == "string" || $value['type'] == "email"){
                       $html.= $this->writeTextInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo string, email ou data
                   //
                   if($value['type'] == "date"){
                       $html.= $this->writeDateInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo password
                   //
                   if($value['type'] == "password"){
                       $html.= $this->writePasswordInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo color
                   //
                   if($value['type'] == "color"){
                       $html.= $this->writeColorInput($field, $value, $object[$field]);
                   }


                   //
                   // Caso o campo seja do tipo checkbox
                   //
                   if($value['type'] == "checkbox"){
                       $html.= $this->writeCheckBox($field, $value, $object[$field]);
                   }


                   //
                   // Caso o campo seja do tipo money
                   //
                   if($value['type'] == "money"){
                       $html.= $this->writeMoneyInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo password
                   //
                   if($value['type'] == "image" || $value['type'] == "file"){
                       $html.= $this->writeFileInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo password
                   //
                   if($value['type'] == "time"){
                       $html.= $this->writeTimeInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo inteiro
                   //
                   if($value['type'] == "integer"){
                       $html.= $this->writeIntegerInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo password
                   //
                   if($value['type'] == "select"){
                       $html.= $this->writeSelectInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo password
                   //
                   if($value['type'] == "subselect"){
                       $html.= $this->writeSubSelectInput($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo password
                   //
                   if($value['type'] == "subselectmultiple"){
                       $html.= $this->writeSubSelectMultiple($field, $value, $valueField);
                   }


                   //
                   // Caso o campo seja do tipo text ou editor
                   //
                   if($value['type'] == "text" || $value['type'] == "editor"){
                       $html.= $this->writeTextArea($field, $value, $valueField);
                   }

                   if($value['obsform'] != null){
                       $html.= '&nbsp<span class="text-alert">'.$value['obsform'].'</span>';
                   }
                   
                   
                   if($value['maxlength'] != "" && $value['maxlength'] != null){
                       $html.= '<div class="cont_right"> <span id="caracter_'.$field.'" class="cont_text1"> ** </span>';
                       $html.= '<span class="cont_text2"> caracteres </span></div>';
                   }

                   $html.= '</div>';
                   
                   //
                   // Caso o campo seja do tipo color
                   // Adiciona uma div ao final do elemento para mostra das opções de cores.
                   //
                   if($value['type'] == "color"){
                       $html.= '<div id="__'.$field.'"></div>';
                   }

                }
            }
        }
        //
        // Fecha a tabela e escreve o html
        //
        $html.= '</div>';
        return $html;
    }


    /**
     * Retorna o valor do campo caso este não esteja nulo, é verificado se o campo necessita
     * de uma função de tratamento antes de ser mostrado no formulário
     * @param String $field       Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    public function getValueField($field, $value, $object){
        $functions = new IPanelFunctions();
        $subfield = explode(".", $field);
        switch(count($subfield)){
            case "1": $valueField = $object[$subfield[0]]; break;
            case "2": $valueField = $object[$subfield[0]][$subfield[1]]; break;
            case "3": $valueField = $object[$subfield[0]][$subfield[1]][$subfield[2]]; break;
            case "3": $valueField = $object[$subfield[0]][$subfield[1]][$subfield[2]][$subfield[3]]; break;
         }
        if($value['formFunction'] != ""){
            $function = $value['formFunction'];
            $valueField = $functions->$function($object[$field]);
        }else if($value['listFunction'] != ""){
            $function = $value['listFunction'];
            $valueField = $functions->$function($object[$field]);
        }
        return $valueField;
    }


    /**
     * Retorna o código html do campo de acordo com o tipo do mesmo
     * @param String $nameField   Nome do campo atual
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    public function writeField($nameField, $object){
        $value = $this->getConfig()->getParameter("fields.".$nameField);
        $valueField = getValueField($nameField, $value, $object);

        if($value['type'] == "string" || $value['type'] == "email" || $value['type'] == "date"){
            $html.= $this->writeTextInput($nameField, $value, $valueField);
        }
        if($value['type'] == "text" || $value['type'] == "editor"){
            $html.= $this->writeTextArea($nameField, $value, $valueField);
        }
        return $html;
    }


    /**
     * Retorna o código html para criação de uma TextArea
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeTextArea($field, $value, $valueField, $searchForm=false){
        $html = '<textarea name="'.$field.'" id="'.$field.'" style="width:100%">'.$valueField.'</textarea>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um TextInput
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeTextInput($field, $value, $valueField, $searchForm=false){

        $size = ($value['size'] != "" && $value['size'] != null) ? $value['size'] : $this->defaultFieldSize;
        if($searchForm){
            $style = "fields_search_text";
        }else{
            if($size <= 50){
                 $style = "fields_form_medium";
            }else{
                $style = "fields_form_large";
            }
        }
        
        $maxlength = ($value['maxlength'] != "" && $value['maxlength'] != null) ? $value['maxlength'] : $this->defaultFieldMaxLength;
        $html = '<input id="'.$field.'" name="'.$field.'" class="'.$style.'" value="'.$valueField.'" size="11" ';
        if($value['maxlength'] != "" && $value['maxlength'] != null){
            $html.= 'maxlength="'.$maxlength.'" onKeyUp="javascript:countChars('.chr(39).$field.chr(39).','.$maxlength.')"';
        }
        $html.= '/>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um TextInput para Senha
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writePasswordInput($field, $value, $valueField, $searchForm=false){
        $size = ($value['size'] != "" && $value['size'] != null) ? $value['size'] : $this->defaultFieldSize;
        $maxlength = ($value['maxlength'] != "" && $value['maxlength'] != null) ? $value['maxlength'] : $this->defaultFieldMaxLength;
        $html = '<input id="'.$field.'" name="'.$field.'" class="fields_form_medium"  type="password"
                        value="'.$valueField.'" size="'.$size.'" maxlength="'.$maxlength.'"/>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um Seletor de cores
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeColorInput($field, $value, $valueField, $searchForm=false){
        if(empty($valueField)){
            $valueField = "#ffffff";
        }
        $size = ($value['size'] != "" && $value['size'] != null) ? $value['size'] : $this->defaultFieldSize;
        $maxlength = ($value['maxlength'] != "" && $value['maxlength'] != null) ? $value['maxlength'] : $this->defaultFieldMaxLength;
        $html = '<input id="'.$field.'" name="'.$field.'" class="fields_form_short"  type="text"
                        value="'.$valueField.'" size="'.$size.'" maxlength="'.$maxlength.'"/>';
        //$html.= '<div id="__'.$field.'"></div>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um TextInput para Data
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeDateInput($field, $value, $valueField, $searchForm=false){
        if($searchForm){
            $style = "fields_search_date";
        }else{
            $style = "fields_form_date"; 
        }
        $html = '<input id="'.$field.'" name="'.$field.'" class="'.$style.'" value="'.$valueField.'" size="11"/>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um TextInput para Valores monetários
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeMoneyInput($field, $value, $valueField, $searchForm=false){
        if($searchForm){
            $style = "fields_search_short";
        }else{
            $style = "fields_form_short";
        }
        $html = '<input id="'.$field.'" name="'.$field.'" class="'.$style.'" onkeydown="formataValor(this,event,17,2);"
                        value="'.$valueField.'" size="10" maxlength="15"/>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um TextInput para digitaçao de inteiro
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeIntegerInput($field, $value, $valueField, $searchForm=false){
        if($searchForm){
            $style = "fields_search_short";
        }else{
            $style = "fields_form_short";
        }
        $html = '<input name="'.$field.'" id="'.$field.'" class="'.$style.'" value="'.$valueField.'"
                        onkeyup="number(this);" size="5" maxlength="5"/>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um TextInput para digitaçao de hora
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeTimeInput($field, $value, $valueField, $searchForm=false){
        if($searchForm){
            $style = "fields_search_short";
        }else{
            $style = "fields_form_short";
        }
        $html = '<input name="'.$field.'" id="'.$field.'" class="'.$style.'" value="'.$valueField.'" size="5" maxlength="5"/>';
        return $html;
    }
    

    /**
     * Retorna o código html para criação de um CheckBox
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeCheckBox($field, $value, $valueField, $searchForm=false){
        if($value['value'] == $valueField){
            $checked = "checked";
        }else{
            $checked = "";
        }
        $valueField = !empty($value['value']) ? $value['value'] : "1";
        $html = '<input type="checkbox" name="'.$field.'" value="'.$valueField.'" '.$checked.'>';
        $html.= '<span class="sptl">'.(!empty($value['tooltip']) ? $value['tooltip'] : $value['name']).'</span>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um Input de seleção de arquivo
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeFileInput($field, $value, $valueField, $searchForm=false){
        $size = ($value['size'] != "" && $value['size'] != null) ? $value['size'] : $this->defaultFieldSize;
        $html = '<input name="'.$field.'" id="'.$field.'" type="file" class="fields_form_short" size="'.$size.'" />';
        return $html;
    }


    /**
     * Retorna o código html para criação de um TextInput para Senha
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeSelectInput($field, $value, $valueField, $searchForm=false){
        if($searchForm){
            $style = "fields_search_select";
        }else{
            $style = "fields_form_select";
        }
        $html = '<select name="'.$field.'" id="'.$field.'" class="'.$style.'">';
        if((str_replace(" ", "", $valueField) == "") && !$searchForm){
            $html.= ' <option value="" selected >Selecione</option>';
        }
        if($searchForm){
            $html.= ' <option value="" selected >Mostrar Todos</option>';
        }
        $arrayOptions = explode(",", $value['options']);
        for($i=0; $i < count($arrayOptions); $i++){
            $option = explode("=>", $arrayOptions[$i]);
            $data = ltrim($option[0]);
            $label = count($option) == 1 ? $data : $option[1];
            if($data == ltrim($valueField)){
                $sel = "selected";
            }else{
                $sel = "";
            }
            $html.= ' <option value="'.$data.'" '.$sel.' >'.$label.'</option>';
        }
        $html.= '</select>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um TextInput para Senha
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeSubSelectInput($field, $value, $valueField, $searchForm=false){
        $arrayFields = array();
        $arrayValues = array();
        if($searchForm){
            $style = "fields_search_select";
        }else{
            $style = "fields_form_select";
        }
        $html = '<select name="'.$field.'" id="'.$field.'" class="'.$style.'">';
        if((str_replace(" ", "", $valueField) == "") && !$searchForm){
            $html.= ' <option value="" selected >Selecione</option>';
        }
        if($searchForm){
            $html.= ' <option value="" selected >Mostrar Todos</option>';
        }
        if($this->getArea() == "Programa"){
            $html.= ' <option value=""></option>';
        }
        $control = new GenericCtrl($value['relation']);
        $order = $value['order'] != null ? $value['order'] : str_replace("|", ",", $value['labelField']);
        $condition = $value['condition'] != null ? $value['condition'] : "";
        if(!empty($condition)){
            $conditions = explode(",", $conditions);
            foreach($conditions as $condition){
                list($condField, $condValue) = explode("=>", $condition);
                $arrayFields = array_merge($arrayFields, array($condField));
                $arrayValues = array_merge($arrayValues, array($condValue));
            }
        }

        $result = $control->getObjectByFields($arrayFields, $arrayValues, false, false, false, $order);
        foreach($result as $object){
           // if($this->getValueField($value['relationField'], null, $object)){
            if($object[$value['relationField']] == $valueField){
                $sel = "selected";
            }else{
                $sel = "";
            }
            $labels = explode("|", $value['labelField']);
            $label = "";
            for($i=0; $i<count($labels); $i++){
                    $label.= $this->getValueField($labels[$i], $value, $object);
                    if($i < (count($labels) - 1)){
                            $label.= " | ";
                    }
            }
            $html.= ' <option value="'.$object[$value['relationField']].'" '.$sel.' >'.$label.'</option>';
        }
        $html.= '</select>';
        return $html;
    }


    /**
     * Retorna o código html para criação de um Select do Tipo Multiplo
     * @param String $nameField   Nome do campo atual
     * @param Array  $value       Array com os dados do campo
     * @param Object $object      Objeto atual a ser populado no formulario
     *
     * @return html
     */
    private function writeSubSelectMultiple($field, $value, $valueField, $searchForm=false){
        $html = '<select name="'.$field.'" id="'.$field.'" class="fields_form_select" multiple="multiple" size="10">';
        $control = new GenericCtrl($value['relation']);
        $result = $control->getAllObjects();
        foreach($result as $object){
            if($object[$value['relationField']] == $valueField){
                $sel = "selected";
            }else{
                $sel = "";
            }
            $html.= ' <option value="'.$object[$value['relationField']].'" '.$sel.' >'.$object[$value['labelField']].'</option>';
        }
        $html.= '</select>';
        return $html;
    }



    /**
     * Copia os dados enviados pelo formulario para os campos correspondentes no objeto
     *
     * @param Array $post            Array com os dados enviados via formulario
     * @param Array $files           Array com informações de arquivos enviados via formulário
     * @return Object
     */
    public function saveFormDataToObject($post, $files){
        $functions = new IPanelFunctions();
        $control = new GenericCtrl($this->getArea());
        $action = "";
        if($post['id'] != ""){
            $object = $control->getObject($post['id']);
            if(!is_object($object)){
                $object = new $this->currentArea;
                $action = "save";
            }else{
                $action = "update";
            }
        }else{
            $object = new $this->currentArea;
            $action = "save";
        }

        //
        // Efetua um laço nos campos para verificar quais vem do formulário
        //
        foreach($this->getConfig()->getFields() as $fields){
            foreach($fields as $field => $value){

                $updatable = $value['updatable'];
                $insertable = $value['insertable'];
                if($updatable == null || $updatable == "" || $updatable == true){
                    $updatable = true;
                }
                if($updatable == false){
                    $updatable == false;
                }
                if($insertable == null || $insertable == "" || $insertable == true){
                    $insertable = true;
                }
                if($insertable == false){
                    $insertable == false;
                }

                //
                // Caso o campo esteja marcado como pertencente ao formulário
                //
                if($value['form'] || $value['auto']){


                   //
                   // Caso seja um campo do tipo Imagem e não esteja vazio
                   //
                   if($value['type'] == "image" || $value['type'] == "file"){
                       if($files[$field]['name'] != ""){
                            $object[$field] = $functions->nameForWeb($files[$field]['name']);
                            //$object[$field] = $functions->nameOriginalFile($files[$field]['name']);
                       }

                   }

                   //
                   // Verifica se foi especificado uma função para tratamento do campo
                   //
                   if($value['saveFunction'] != ""){
                       $function = $value['saveFunction'];
                       $valueField = $functions->$function($post[$field]);
                   }else{
                       $valueField = $post[$field];
                   }
                   //
                   // Verifica se o campo deve ser salvo no update ou na inserção
                   //
                   if($updatable == true && $action == "update" && $value['type'] != "image" && $value['type'] != "file"){
                       $object[$field] = $valueField;
                   }
                   if($insertable == true && $action == "save" && $value['type'] != "image" && $value['type'] != "file"){
                       $object[$field] = $valueField;
                   }
               }
            }
        }
        return $object;
    }


    /**
     * Gera o script Jquery para validação e mascaramento dos campos
     * Os campos de data possuem mascara prédefinida não sendo necessário especificá-la
     * no arquivo de configuraçao.
     *
     * @return html
     */
    public function writeValidationScript(){
        $script = '<script type="text/javascript" language="javascript">';

        //
        // preparação do formulário
        //
        $script.= ' $(document).ready( function() {';
        $scriptColor = "";
        $contColor = 0;

        //
        // gera as máscaras para os campos
        //
        if($this->getArea() != "Backup"){
            foreach($this->config->getFields() as $fields){
                foreach($fields as $field => $value){
                    if($value['type'] == "date" && ($value['form'])){
                        $script.= '$("#'.$field.'").mask("99/99/9999");';
                    }
                    if($value['mask'] != "" && ($value['form'])){
                        $script.= '$("#'.$field.'").mask("'.$value['mask'].'");';
                    }
                }
            }
        }

        //
        // inicia o TiniMCE para validação via Jquery
        //
        $script.= 'var validator = $("#formreg").submit(function() {';
        $script.= '	tinyMCE.triggerSave();';
        $script.= '}).validate({';


   //     $script.= '    $("#formreg").validate({';
        //
        // Gera as obrigações de cada campo
        //
       $script.= '    rules:{';
        if($this->getArea() != "Backup"){
            foreach($this->config->getFields() as $fields){
                foreach($fields as $field => $value){
                    if($value['form']){
                        $script.= '    '.$field.':{';
                        if($value['required']){
                            $script.= '    required: true,';
                        }
                        if($value['type'] == "date" && $value['nullable'] != true){
                            $script.= ' dateBR: true,';
                        }
                        if($value['maxlength'] != ""){
                            $script.= ' maxlength: '.$value['maxlength'].',';
                        }
                        if($value['type'] == "email"){
                            $script.= ' email: true,';
                        }
                        $script.= '},';

                        if($value['type'] == "color"){
                            $contColor++;
                            $scriptColor.= 'setTimeout(function(){';
                            $scriptColor.= 'jQuery.farbtastic("#__'.$field.'").linkTo("#'.$field.'")';
                            $scriptColor.= '}, 100);';
                        }
                    }
                }
            }
        }

        $script.= '    },';
       // $script.= 'errorPlacement: function(label, element) {';
       // $script.= '	// position error label after generated textarea';
       // $script.= '	if (element.is("textarea")) {';
       // $script.= '	     label.insertAfter(element.next());';
       // $script.= '	else';
       // $script.= '		label.insertAfter(element)';
       // $script.= '};';
        $script.= '  });';
        $script.= '})';
        $script.= $scriptColor;
        $script.= '</script>';

        print $script;
    }

    
    
    /**
     * Gera o código html para os campos de acordo com o tipo do atributo
     *
     * @return html
     */
    public function writeSearchField($field, $value, $value01, $value02){
         switch($value['type']){
               case "date":{
                   $html.= $this->writeDateInput($field."Ini", $value, $value01, true);
                   $html.= ' <span class="sptl"> á </span>';
                   $html.= $this->writeDateInput($field."End", $value, $value02, true);
               } break;

               case "money":{
                   $html.= $this->writeMoneyInput($field."Ini", $value, $value01, true);
                   $html.= ' <span class="sptl"> á </span>';
                   $html.= $this->writeMoneyInput($field."End", $value, $value02, true);
               } break;

               case "time":{
                   $html.= $this->writeTimeInput($field."Ini", $value, $value01, true);
                   $html.= ' <span class="sptl"> á </span>';
                   $html.= $this->writeTimeInput($field."End", $value, $value02, true);
               } break;

               case "integer":{
                   $html.= $this->writeIntegerInput($field."Ini", $value, $value01, true);
                   $html.= ' <span class="sptl"> á </span>';
                   $html.= $this->writeIntegerInput($field."End", $value, $value02, true);
               } break;

               case "select":{
                   $html.= $this->writeSelectInput($field, $value, $value01, true);
               } break;

               case "subselect":{
                   $html.= $this->writeSubSelectInput($field, $value, $value01, true);
               } break;

               case "checkbox":{
                   $html.= $this->writeCheckBox($field, $value, $value01, true);
               } break;

               default: {
                   $html.= $this->writeTextInput($field, $value, $value01, true);
               } break;
           }
        return $html;
    }

    
    /**
     * Gera o script Jquery para validação e mascaramento dos campos
     * Os campos de data possuem mascara prédefinida não sendo necessário especificá-la
     * no arquivo de configuraçao.
     *
     * @return html
     */
    public function writeValidationSearch(){
        $script = '<script type="text/javascript" language="javascript">';
        $script.= ' $(document).ready( function() {';
        foreach($this->config->getFields() as $fields){
           foreach($fields as $field => $value){
               $field = str_replace(".", "_", $field);
               if($value['search'] == true){
                    if($value['type'] == "date"){
                        $script.= '$("#'.$field.'Ini").mask("99/99/9999");';
                        $script.= '$("#'.$field.'End").mask("99/99/9999");';
                    }
                    if($value['type'] == "time"){
                        $script.= '$("#'.$field.'Ini").mask("99:99");';
                        $script.= '$("#'.$field.'End").mask("99:99");';
                    }
                }
            }
        }
        $script.= '})';
        $script.= '</script>';

        return $script;
    } 
    

    /**
     * Gera o código html para o formulário de pesquisa
     *
     * @return html
     */
    public function writeSearchForm($selectedField, $valueIni, $valueEnd){
        $write = false;
        $html = $this->writeValidationSearch();
        $html.= '<div class="form">';
        $html.= '<form action="../view/" method="get" enctype="multipart/form-data" name="formBusca" id="formBusca" onSubmit="return verificaBusca()">';
        $html.= '<input type="hidden" value="'.$this->getArea().'" name="lc" />';
        $html.= '<input type="hidden" value="Lista" name="md" />';
        $html.= '<input type="hidden" value="Busca" name="action" />';
        $html.= '<input type="hidden" name="prm" value=""/>';
        $html.= $this->writeSearchOptions($selectedField);
        $arrayDivs = "";
        $count = 0;
        foreach($this->getConfig()->getFields() as $fields){
            foreach($fields as $field => $value){ 
                if($value['search'] == true){
                   if(!empty($selectedField)){
                       if($selectedField == $field){
                           $display = "block";
                           $value01 = $valueIni;
                           $value02 = $valueEnd;
                       }else{
                           $display = "none";
                           $value01 = "";
                           $value02 = "";
                       }
                   }else{
                      $display = $count==0 ? "block" : "none";
                      $value01 = "";
                      $value02 = "";
                   }
                   
                   $field = str_replace(".", "_", $field);
                   $html.='<div id="div_'.$field.'" style="float:left; display:'.$display.'; margin-left:10px">';

                   $html.= $this->writeSearchField($field, $value, $value01, $value02);
                  
                   $arrayDivs.= 'div_'.$field.'-';
                   $count++;
                   $html.='</div>';
                   $write = true;
                }
            }
        }
        /*
                <input id="busca" type="text" class="busca" value="Buscar" onblur="this.value='Buscar',mudacor(this,'#fff','italic','','')" onfocus="this.value='',mudacor(this,'#e2e7ed','normal','#00223e','bold')" />
        */
        $html.= '<input type="hidden" value="'.$arrayDivs.'" id="arrayDivs">';
        $html.= '<input type="image" value="Submit" src="img/ico_lopa.png" style="padding-top:5px">';
        $html.= '</form>';
        $html.= '</div>';
        if($write){
            return $html;
        }
    }

    /**
     * Gera o código html para o campo de seleção de tipo de pesquisa
     *
     * @return html
     */
    public function writeSearchOptions($selectedField){
        $write = false;
        $html = '<select name="buscarPor" class="busca_options" onChange="mostraCampoPesquisa(this.value)">';
        if(empty($selectedField)){
            $sel =  'selected="selected"';
        }
        $html.= '   <option value="" '.$sel.'>Buscar  por...</option>';
        foreach($this->getConfig()->getFields() as $fields){
            foreach($fields as $field => $value){
                if($value['search'] == true){
                   if($selectedField == $field){
                       $sel = 'selected="selected"';
                   }else{
                       $sel = "";
                   }
                   $html.= '<option value="'.str_replace(".", "_", $field).'|'.$value['type'].'" '.$sel.'>'.$value['name'].'</option>';
                   $write = true;
                }
            }
        }
        $html.= '<option value="todos">Mostrar Todos</option>';
        $html.= '</select>';

        if($write){
            return $html;
        }
    }

    
   /**
     * Gera o código html para o formulário de pesquisa
     *
     * @return html
     */
    public function writeAdvancedSearchForm($get){
        $write = false;
        $listFields = "";
        $html = $this->writeValidationSearch();
        $html.= '<div class="form_advanced_search">';
        $html.= '<form action="../view/" method="get" enctype="multipart/form-data" name="formBusca" id="formBusca" onSubmit="return verificaBusca()" style="min-height:30px;">';
        $html.= '<img src="img/ico_search_mini.png" style="margin-left:7px;float:left; padding-left:0px !important; padding-top:5px; padding-bottom:3px !important; padding-right:0px !important; background-color: #E6EFF9">';
        $html.= '<span class="sptl_fieldname" style="padding-left:5px; float:left ; padding-top:10px"><strong>Pesquisa Avançada</strong></span><br/>';
        $html.= '<div class="clear"></div>';
		$html.= '<style type="text/css">';
		$html.= '		.fields_search_text {';
		$html.=	'			width:55% !important;';
		$html.= '		}';
		$html.= '		.fields_search_select {';
		$html.=	'			width:58% !important;';
		$html.= '		}';
		$html.= '		.fields_search_date {';
		$html.=	'			width:24% !important;';
		$html.= '		}';
		$html.= '</style>';
        $html.= '<input type="hidden" value="'.$this->getArea().'" name="lc" />';
        $html.= '<input type="hidden" value="Lista" name="md" />';
        $html.= '<input type="hidden" value="Busca" name="action" />';
        $html.= '<input type="hidden" name="prm" value=""/>';
	$countfields = 0;
        foreach($this->getConfig()->getFields() as $fields){
            foreach($fields as $field => $value){
                if($value['search'] == true){
		    $countfields++;
                    $html.= "<div style='width:30%; padding:5px; float:left'>";
                    if($value['type'] == "checkbox"){
                        $html.= "&nbsp;<span class='sptl_fieldname' style='width:35% !important; float:left;text-align:right;'></span>";
                    }else{
                        $html.= "&nbsp;<span class='sptl_fieldname' style='width:35% !important; float:left;text-align:right;'>".$value['name'].": </span>";
                    }
                    $valueIni = $valueEnd = "";
                    $formField = str_replace(".", "_", $field);
                    if(!empty($get[$formField])){
                        $valueIni = $get[$formField];
                    }
                    if(!empty($get[$formField."Ini"])){
                        $valueIni = $get[$formField."Ini"];
                    }
                    if(!empty($get[$formField."End"])){
                        $valueEnd = $get[$formField."End"];
                    }
                    $html.= $this->writeSearchField($formField, $value, $valueIni, $valueEnd, "advanced");
                    $html.= "</div>";
					
                    if($countfields % 3 == 0) {
                        $html.=	'<div class="clear"></div>';
                    } 
                    $listFields.= $formField.'|'.$value['type'].",";
                    $write = true;
                }
            }
        }
        $html.= "<div style='width:30%; padding:5px; float:left'>";
		$html.= "<style type='text/css'> input[type='submit'][value='Buscar']:hover {background-color:#a9a5ff !important; color:#fff !important;}</style>";
        	$html.= '<input type="submit" id="buscar" value="Buscar" style="float:right;margin-right:25px; background-color:#b4c8ff;font-weight:bold; padding:2px 4px; border-radius:5px;border: 1px solid #ADB7C5; cursor:pointer; height:30px; width:80px;color:#516ac2">';
		$html.= '</div>';
        $html.= '<input type="hidden" value="'.$listFields.'" name="listFields" />';
        $html.= '</form>';
        $html.= '</div>';
        $html.= '<div class="clear"></div>';
        if($write){
            return $html;
        }
    }
    
    
   /**
     * Gera o código html para o formulário de pesquisa
     *
     * @return html
     */
    public function getArrayAdvancedSearch($get){
        $write = false;
        $html = $this->writeValidationSearch();
        $html.= '<div class="form_advanced_search">';
        $html.= '<form action="../view/" method="get" enctype="multipart/form-data" name="formBusca" id="formBusca" onSubmit="return verificaBusca()">';
        $html.= '<h3>Pesquisa Avançada</h3><br/>';
        $html.= '<input type="hidden" value="'.$this->getArea().'" name="lc" />';
        $html.= '<input type="hidden" value="Lista" name="md" />';
        $html.= '<input type="hidden" name="prm" value=""/>';
        foreach($this->getConfig()->getFields() as $fields){
            foreach($fields as $field => $value){
                if($value['search'] == true){
                    $html.= "<div style='width:290px; padding:5px; float:left'>";
                    if($value['type'] == "checkbox"){
                        $html.= "&nbsp;<span class='sptl_fieldname' style='width:80px'></span>";
                    }else{
                        $html.= "&nbsp;<span class='sptl_fieldname' style='width:80px'>".$value['name'].": </span>";
                    }
                    $valueIni = $valueEnd = "";
                    if(!empty($get[$field])){
                        $valueIni = $get[$field];
                    }
                    if(!empty($get[$field."Ini"])){
                        $valueIni = $get[$field."Ini"];
                    }
                    if(!empty($get[$field."End"])){
                        $valueEnd = $get[$field."End"];
                    }
                    $html.= $this->writeSearchField($field, $value, $valueIni, $valueEnd, "advanced");
                    $html.= "</div>";
                    $write = true;
                }
            }
        }
        /*
           <input id="busca" type="text" class="busca" value="Buscar" onblur="this.value='Buscar',mudacor(this,'#fff','italic','','')" onfocus="this.value='',mudacor(this,'#e2e7ed','normal','#00223e','bold')" />
        */
        $html.= '</form>';
        $html.= '</div>';
        if($write){
            return $html;
        }
    }
    
    
    

   /**
     * Gera a url com os parâmetros informados na pesquisa
     *
     * @return String
     */
    public function writeUrlParametersSearch($get){ 
        $url = "";
        $fields = $this->getConfig()->getFields();
        foreach($get as $getParameter => $parameter){
           foreach($this->getConfig()->getFields() as $fields){
               foreach($fields as $field => $value){
                   $exists = strpos($getParameter, $field);
                   if($exists !== false){
                       if($value['search'] == true){
                           $url.= "&".$field."=".$get[$getParameter];
                       }
                   }
               }
           }
        }
        return $url;
    }
   
}
   ?>