<?php 

date_default_timezone_set('America/Fortaleza');

// application
define('SHOWSQL_CRUD', false);

if(APPLICATION_ENV=='production'){
	define('PATH_APP', '/');
}elseif(APPLICATION_ENV=='testing'){
	define('PATH_APP', '/obsturismo/');
}else{
	define('PATH_APP', '/iplanfor/obsturismo/');
}

// Login
define('LOGIN_TENTATIVAS', 3);
define('LOGIN_TENTATIVAS_WAIT', '3 minutes');


// Rastreio
define('R_MAX_LISTA', 300);