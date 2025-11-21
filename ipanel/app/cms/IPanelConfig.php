<?php

require_once(APP_PATH . "/system/yaml/Spyc.php");
if(!class_exists('IPanel'))
    require_once(APP_PATH."/cms/IPanel.php");

/**
 * Description of AdminConfig
 *
 * @author Cledson
 */
class IPanelConfig extends IPanel {
    
    var $configArea;
    var $fields;
    var $relations;
    var $uploadFolder;
    var $imageWidth;
    var $imageHeight;
    
    

    public function  __construct($area="") {
        if(!empty($area)){
            $this->readConfigFile($area);
        }
    }
    

    public function readConfigFile($area){
        $array = Spyc::YAMLLoad(IPANEL_PATH . "//config//".$area.".yaml");
        $this->configArea = $array[$area];
        $this->fields = array("fields" => $this->configArea['fields']);
        if($this->configArea['relations'] != null){
            $this->relations = array("fields" => $this->configArea['relations']);
        }
    }

    public function getFields(){
        return $this->fields;
    }

    public function getRelations(){
        return $this->relations;
    }


    public function getField($field, $attribute){
        $value = null;
        if($this->fields[$field][$attribute] != null && $this->fields[$field][$attribute] != ""){
            $value = $this->fields[$field][$attribute];
        }
        return $value;
    }


    
    public function getParameter($parameter){
        $return = null;
        $config = $this->configArea;
        $fields = explode(".", $parameter);
        switch(count($fields)){
            case "0" : $return = ""; break;
            case "1" : $return = $config[$fields[0]]; break;
            case "2" : $return = $config[$fields[0]][$fields[1]]; break;
            case "3" : $return = $config[$fields[0]][$fields[1]][$fields[2]]; break;
            case "4" : $return = $config[$fields[0]][$fields[1]][$fields[2]][$fields[3]]; break;
            case "5" : $return = $config[$fields[0]][$fields[1]][$fields[2]][$fields[3]][$fields[4]]; break;
        }
        return $return;
    }


    /**
     * Retorna a lista de setores disponíveis no setor administrativo
     * A leitura é realizada a partir do arquivo configMenu.yml
     *
     * @return array    Array com os links e abas do setor administrativo
     */
    public function getConfig() {
        $array = Spyc::YAMLLoad(IPANEL_PATH . '//config//configMenu.yaml');
        return $array;
    }
}
?>
