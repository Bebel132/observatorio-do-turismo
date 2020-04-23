<?php 

if(APPLICATION_ENV=='production'){

	$GLOBALS['db']['default'] = array(
		'dsn'	=> '',
		'hostname' => '172.31.3.8',
		'username' => 'postgres',
		'password' => '@1a2b3c4d*',
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



}elseif(APPLICATION_ENV=='testing'){

	$GLOBALS['db']['default'] = array(
		'dsn'	=> '',
		'hostname' => '172.31.3.48',
		'username' => 'postgres',
		'password' => '@1a2b3c4d*',
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
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => '',
		'database' => 'iplanfor_obstur',
		'schema'   => 'public',
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

?>