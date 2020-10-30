<?php 

if(APPLICATION_ENV=='production'){

	$GLOBALS['db']['default'] = array(
		'dsn'	=> '',
<<<<<<< HEAD
		'hostname' => '172.31.3.8',
		'username' => 'postgres',
		'password' => '@1a2b3c4d*',
		'database' => 'acervoadmin',
=======
		'hostname' => '172.30.79.252',
		'username' => 'postgres',
		'password' => '6f@pbW6AzV&*',
		'database' => 'observatorio',
>>>>>>> release/v1.2
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

	$GLOBALS['db']['acervo'] = array(
		'dsn'	=> '',
		'hostname' => '172.31.3.8',
		'username' => 'root',
		'password' => '@1a2b3c4d*',
		'database' => 'acervo',
		'dbdriver' => 'mysql',
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
		'username' => 'postgres',
		'password' => '@1a2b3c4d*',
		'database' => 'acervoadmin',
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

	$GLOBALS['db']['acervo'] = array(
		'dsn'	=> '',
		'hostname' => '172.31.3.8',
		'username' => 'root',
		'password' => '@1a2b3c4d*',
		'database' => 'acervo',
		'dbdriver' => 'mysql',
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
		'hostname' => '172.31.3.8',
		'username' => 'postgres',
		'password' => '@1a2b3c4d*',
		'database' => 'acervoadmin',
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

	$GLOBALS['db']['acervo'] = array(
		'dsn'	=> '',
		'hostname' => '172.31.3.8',
		'username' => 'root',
		'password' => '@1a2b3c4d*',
		'database' => 'acervo',
		'dbdriver' => 'mysql',
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