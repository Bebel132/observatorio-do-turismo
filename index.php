<?php 

session_start();

// helper function
function require_path($diretorio){$dir = dir($diretorio);while($arquivo = $dir->read()){if(substr($arquivo, -4,4) == '.php'){include_once($diretorio.$arquivo);}}$dir -> close();}

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

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