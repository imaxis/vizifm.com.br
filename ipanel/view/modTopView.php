<?
/*****************************************************************************************************
*                                                                                                    *
*                             Arquivo de inicialização de listagens                                  *
*                            Desenvolvido por Agência Studio iMAXIS                                  *
*                                                                                                    *
*****************************************************************************************************/

if(!class_exists('Data'))
    require_once(APP_PATH."/util/Data.php");
$data = new Data();

if(!class_exists('Util'))
    require_once(APP_PATH."/util/Util.php");
$util = new Util();

if($this->controlClass == "GenericCtrl"){
    $control = new GenericCtrl($this->getArea());
}else{
    $control = new $this->controlClass;
}


$arrayFields = array();
$arrayValues = array();
$arrayOperators = array();
$page = empty($_GET['page']) ? 1 : $_GET['page'];
$order = empty($_GET['order']) ? $this->getConfig()->getParameter("orderBy") : $_GET['order'];
$search = $this->getConfig()->getParameter("searchType") == "advanced" ? "advanced" : "normal";
$resultByPage = empty($_GET['resultByPage']) ? 30 : $_GET['resultByPage'];
$start = ($page - 1) * $resultByPage;



//
// Caso ocorra a pesquisa pelo formulário
//
if($_GET['action'] == "Busca"){
    if($search == "normal"){
        $count = 1;
    }else{
        $count = $this->getNumFieldsSearch();
    }

    for($i=0; $i < $count; $i++){
        $valueIni = $valueEnd = "";
        if($search == "normal"){
            list($fieldSearch, $typeSearch) = explode("|", $_GET['buscarPor']);
        }else{
            $listFields = explode(",",$_GET['listFields']);
            list($fieldSearch, $typeSearch) = explode("|", $listFields[$i]);
        }
        switch($typeSearch){
           case "money": {
                    $operator = "BETWEEN";
                    $fieldIni = $fieldSearch.'Ini';
                    $fieldEnd = $fieldSearch.'End';
                    $valueIniRetorno = $_GET[$fieldSearch.'Ini'];
                    $valueEndRetorno = $_GET[$fieldSearch.'End'];
                    if(!empty($_GET[$fieldSearch.'Ini'])){
                        $valueIni = $util->formatFloat($_GET[$fieldSearch.'Ini']);
                    }
                    if(!empty($_GET[$fieldSearch.'End'])){
                        $valueEnd = $util->formatFloat($_GET[$fieldSearch.'End']);
                    }
                 } break;
           case "date": {
                    $operator = "BETWEEN";
                    $fieldIni = $fieldSearch.'Ini';
                    $fieldEnd = $fieldSearch.'End';
                    $valueIniRetorno = $_GET[$fieldSearch.'Ini'];
                    $valueEndRetorno = $_GET[$fieldSearch.'End'];
                    if(!empty($_GET[$fieldSearch.'Ini'])){
                        $valueIni = $data->convertDateBRtoDateSQL($_GET[$fieldSearch.'Ini']);
                    }
                    if(!empty($_GET[$fieldSearch.'End'])){
                        $valueEnd = $data->convertDateBRtoDateSQL($_GET[$fieldSearch.'End']);
                    }
                 } break;
           case "time": {
                    $operator = "BETWEEN";
                    $fieldIni = $fieldSearch.'Ini';
                    $fieldEnd = $fieldSearch.'End';
                    $valueIniRetorno = $_GET[$fieldSearch.'Ini'];
                    $valueEndRetorno = $_GET[$fieldSearch.'End'];
                    $valueIni = $_GET[$fieldSearch.'Ini'];
                    $valueEnd = $_GET[$fieldSearch.'End'];

                 } break;
           case "integer": {
                    $operator = "BETWEEN";
                    $fieldIni = $fieldSearch.'Ini';
                    $fieldEnd = $fieldSearch.'End';
                    $valueIniRetorno = $_GET[$fieldSearch.'Ini'];
                    $valueEndRetorno = $_GET[$fieldSearch.'End'];
                    $valueIni = $_GET[$fieldSearch.'Ini'];
                    $valueEnd = $_GET[$fieldSearch.'End'];
                 } break;
           case "subselect": {
                    $operator = "EQUALS";
                    $fieldIni = $fieldSearch;
                    $valueIniRetorno = $_GET[$fieldSearch];
                    $valueIni = $_GET[$fieldSearch];
                 } break;
           case "select": {
                    $operator = "EQUALS";
                    $fieldIni = $fieldSearch;
                    $valueIniRetorno = $_GET[$fieldSearch];
                    $valueIni = $_GET[$fieldSearch];
                 } break;
           default:{
                    $operator = "LIKE";
                    $fieldIni = $fieldSearch;
                    $valueIniRetorno = $_GET[$fieldSearch];
                    $valueIni = $_GET[$fieldSearch];
                } break;
        }
        $fieldSearch = str_replace("_", ".", $fieldSearch);
        array_push($arrayFields, array("field" => $fieldSearch));
        array_push($arrayValues, array("valueIni" => $valueIni, "valueEnd" => $valueEnd));
        array_push($arrayOperators, array("operator" => $operator));
    }

    
    //
    // Caso seja a pesquisa normal, com apenas um campo
    //
    if($search == "normal"){
        $arrayList = $control->getObjectsIPanel($fieldSearch, $valueIni, $valueEnd, true, $resultByPage, $start, $order);
        $arrayListTotal = $control->getObjectsIPanel($fieldSearch, $valueIni, $valueEnd);
    }

    //
    // Caso seja a pesquisa avançada, com vários campos
    //
    else{
        $arrayList = $control->getObjectsByAdvancedSearch($arrayFields, $arrayValues, $arrayOperators, true, $resultByPage, $start, $order);
        $arrayListTotal = $control->getObjectsByAdvancedSearch($arrayFields, $arrayValues, $arrayOperators);
    }
}



//
// Caso ocorra a ordenação pela letra inicial
//
if(!empty($_GET['letter'])){
    $field = $_GET['field'];
    $value = $_GET['letter'];
    $arrayList = $control->getObjectsByStartLetter($field, $value, true, $resultByPage, $start, $order);
    $arrayListTotal = $control->getObjectsByStartLetter($field, $value);
}

//
// Caso seja a listagem normal
//
else{
    if(empty($_GET['letter']) && $_GET['action'] != "Busca"){
       $arrayList = $control->getObjects("", "", true, $resultByPage, $start, $order);
       $arrayListTotal = $control->getObjects("", "");
    }
}

//
// Lista de ids para controle das linhas da tabela
//
foreach($arrayList as $object){
    $ids =  "i".$object['id']."-".$ids;
}

//
// Contagem para paginação
//
$atualPages = count($arrayList);
$totalPages = ceil(count($arrayListTotal)/$resultByPage);

//
// Geração da url com os parâmetros para pesquisa normal
//
if($search == "normal"){
    $parameters = "&action=".$_GET['action']."&buscarPor=".$_GET['buscarPor']."&".$fieldIni."=".$valueIni."&".$fieldEnd."=".$valueEnd;
}

//
// Geração da url com os parâmetros para pesquisa avançada
//
if($search == "advanced"){
    $parameters = "&action=".$_GET['action'].$this->getUrlParametersSearch($_GET)."&listFields=".$_GET['listFields'];
}
$parametersUrl = $parameters."&order=".$order."&page=".$page."&resultByPage=".$resultByPage;

?>