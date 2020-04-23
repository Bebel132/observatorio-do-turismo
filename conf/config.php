<?php 

date_default_timezone_set('America/Fortaleza');

// application
define('SHOWSQL_CRUD', false);

if(APPLICATION_ENV=='production'){
	define('PATH_APP', '/');
}elseif(APPLICATION_ENV=='testing'){
	define('PATH_APP', '/obsturismo/');
}else{
	define('PATH_APP', '/IPLANFOR/obsturismo/');
}

// Login
define('LOGIN_TENTATIVAS', 3);
define('LOGIN_TENTATIVAS_WAIT', '3 minutes');

define('IFRAME_POWERBI', "https://app.powerbi.com/view?r=eyJrIjoiNGY0ZDg4NTYtYTg1ZC00MjNiLThmN2EtNDg0MDg2ZTRiNDkzIiwidCI6ImI2NzIwZDEzLTAwMWQtNDMyMS05NGZhLTBhMmVmY2UwNWMzNiIsImMiOjh9");

// Rastreio
define('R_MAX_LISTA', 300);