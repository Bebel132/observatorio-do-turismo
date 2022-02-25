<?php 

date_default_timezone_set('America/Fortaleza');

// application
define('SHOWSQL_CRUD', false);

if(APPLICATION_ENV=='production'){
	define('PATH_APP', '');
	define('ISHTTPS', true);
}elseif(APPLICATION_ENV=='testing'){
	define('PATH_APP', 'observatorio-do-turismo/');
	define('ISHTTPS', true);
}else{
	define('PATH_APP', 'IPLANFOR/observatorio-do-turismo/');
	define('ISHTTPS', false);
}

// Login
define('PAGE_INITIAL', 'home');
define('LOGIN_TENTATIVAS', 3);
define('LOGIN_TENTATIVAS_WAIT', '3 minutes');

define('IFRAME_POWERBI', "https://app.powerbi.com/view?r=eyJrIjoiNGY0ZDg4NTYtYTg1ZC00MjNiLThmN2EtNDg0MDg2ZTRiNDkzIiwidCI6ImI2NzIwZDEzLTAwMWQtNDMyMS05NGZhLTBhMmVmY2UwNWMzNiIsImMiOjh9");

// Rastreio
define('R_MAX_LISTA', 300);

// Application text values
define('APP_TITLE', 'Observatorio do Turismo');
define('APP_TITLE_LOWER', 'Observatorio do Turismo');

define('CENTRAL_PAGINACAO', 100);


// E-mail
define('EMAIL_RECOVERY', 'observatorio.setfor@setfor.fortaleza.ce.gov.br');
define('EMAIL_RECOVERY_PASS', '@2qzwxEC2@');

define('SMTP_HOST', 'mail.setfor.fortaleza.ce.gov.br');
define('SMTP_PORT', 587);