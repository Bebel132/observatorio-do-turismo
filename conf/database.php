<?php 

if(APPLICATION_ENV=='production'){

	$GLOBALS['db']['default'] = array(
		'dsn'	=> '',
		// 'hostname' => '172.30.79.252',
		'hostname' => 'localhost',
		'username' => 'postgres',
		'password' => '6f@pbW6AzV&*',
		'database' => 'observatorio',
		'schema'   => 'public',
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
		'dsn'	=> '',
		'hostname' => '172.31.3.48',
		'username' => 'homolog_user',
		'password' => 'homolog_user@59753',
		'database' => 'obsturismo',
		'schema'   => 'public',
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

	// development
	$GLOBALS['db']['default'] = array(
		'dsn'	=> '',
		'hostname' => '172.31.3.48',
		'username' => 'homolog_user',
		'password' => 'homolog_user@59753',
		'database' => 'obsturismo',
		'schema'   => 'public',
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