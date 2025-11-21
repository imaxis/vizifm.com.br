<?php
//
// Definição do mapeamento das classes
//
define("APP_PATH", dirname(__FILE__) . "/../");
define("IPANEL_PATH", dirname(__FILE__) . "/../../");
define("CORE_PATH", dirname(__FILE__));
define("DOCTRINE_PATH", dirname(__FILE__) . "/doctrine");
define("BACKEND_MODELS_PATH", dirname(__FILE__) . "/../model/");

ini_set('default_charset', 'UTF-8');
if (function_exists('mb_internal_encoding')) {
    mb_internal_encoding('UTF-8');
}


//
// Definição dos parâmetros da base de dados
//
define("DB_ENGINE", "mysql");												// Database engine type
define("DB_NAME", "imaxis_vizifm");											// Database name
define("DB_HOST", "localhost");												// Database host
define("DB_USER", "root");											// Database user
define("DB_PASSWORD", "");											// Database password
define("CONNECTION_NAME", "doctrine");


// Connection name (internal feature)
require_once(CORE_PATH . "/Bootstrapper.php");
Bootstrapper::getInstance();


$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443)
	? "https://"
	: "http://";

// Define a constante BASE_URL dinamicamente
define('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . '/vizifmnovo.com.br/');

function base_url($path = '')
{
	return BASE_URL . ltrim($path, '/');
}
