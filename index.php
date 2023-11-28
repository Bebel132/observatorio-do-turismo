<?php 
// 
//
//
//	Na estrutura desse projeto, o arquivo inicial "index" serve para chamar todos os componentes do site
//	classes, arquivos de configuração e a página inicial do site são carregados aqui
//
//
session_start();
ini_set('display_errors', TRUE );

// helper function
function require_path($diretorio){
	$dir = dir($diretorio);
	while($arquivo = $dir->read()){
		if(substr($arquivo, -4,4) == '.php'){
			include_once($diretorio.$arquivo);
		}
	}
	$dir -> close();
}

// defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

if(!defined('APPLICATION_ENV')){
	if($_SERVER['SERVER_ADDR']=="172.30.79.251")
		define('APPLICATION_ENV','production');
	else
		define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
}

//echo constant('APPLICATION_ENV');

// Configurações
require_path('conf/');

// Classes
require_path('class/');

// ORM
require_path('libs/orm-si/');

// Entidades
require_path('entity/');

// Controllers
require_path('controllers/');

DaoSI::$SHOWSQL_CRUD = SHOWSQL_CRUD;

// View
require_once('views/viewer.php');