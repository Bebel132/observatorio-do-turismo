<?php 

if(APPLICATION_ENV=='production'){

	$GLOBALS['db']['default'] = array(
		'dsn'	=> 'xxxxxxxxxxx',
		'hostname' => 'xxx.xx.xx.xxx',
		'port' 	   => 'xxxx',
		'username' => 'xxxxxxxxxxx',
		'password' => 'xxxxxxxxxxx',
		'database' => 'xxxxxxxxxxx',
		'schema'   => 'xxxxxxxxxxx',
		'dbdriver' => 'pgsql',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => true,
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);



}elseif(APPLICATION_ENV=='testing'){

	$GLOBALS['db']['default'] = array(
		'dsn'	=> 'xxxxxxxxxxx',
		'hostname' => 'xxx.xx.xx.xxx',
		'port' 	   => 'xxxx',
		'username' => 'xxxxxxxxxxx',
		'password' => 'xxxxxxxxxxx',
		'database' => 'xxxxxxxxxxx',
		'schema'   => 'xxxxxxxxxxx',
		'dbdriver' => 'pgsql',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => true,
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);
}else{
	$GLOBALS['db']['default'] = array(
		'dsn'	=> 'xxxxxxxxxxx',
		'hostname' => 'xxx.xx.xx.xxx',
		'port' 	   => 'xxxx',
		'username' => 'xxxxxxxxxxx',
		'password' => 'xxxxxxxxxxx',
		'database' => 'xxxxxxxxxxx',
		'schema'   => 'xxxxxxxxxxx',
		'dbdriver' => 'pgsql',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => true,
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);
}