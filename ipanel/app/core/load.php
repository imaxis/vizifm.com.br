<?php

/**
 *
 * Arquivo para carregamento automático de classes
 *
 */
include "config.php";


/**
 * Função para carregar as classes dinamicamente
 * @param <String> $className
 * @return <Object> 
 */
function __loadIPanel($className){
    $directories = array('cms', 'controller', 'model', 'system', 'system/email', 'util');
    foreach($directories as $directory){
        $path = realpath(dirname(__FILE__)).'/../'.$directory."/".$className.".php";
        if(file_exists($path)){
            include_once $path;
            return;
        }
    }
}
spl_autoload_register('__loadIPanel');
?>
