<?php 

<<<<<<< HEAD
// session_start();
=======
session_start();
>>>>>>> release/v1.2

// helper function
// function require_path($diretorio){$dir = dir($diretorio);while($arquivo = $dir->read()){if(substr($arquivo, -4,4) == '.php'){include_once($diretorio.$arquivo);}}$dir -> close();}

<<<<<<< HEAD
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
=======
// defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

if(!defined('APPLICATION_ENV')){
	if($_SERVER['SERVER_ADDR']=="172.30.79.252")
		define('APPLICATION_ENV','production');
	else
		define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
}
>>>>>>> release/v1.2

echo "test:";
echo APPLICATION_ENV;
echo "master";
exit;

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