<?php


function getSession($key=null,$div='|')
{

	if (session_status() == PHP_SESSION_NONE) session_start();
	
	if(!isset($_SESSION)) $_SESSION = [];
	
	if($key===null){ return $_SESSION; }

	$chave = explode($div, $key);

	$session = $_SESSION;
	foreach ($chave as $key) {
		if(isset($session[$key]))
			$session = $session[$key];
		else
			return null;
	}

	if(@unserialize($session))
		$session = unserialize($session);

	return $session;

}

function setSession($key=null,$val=null)
{
	if (session_status() == PHP_SESSION_NONE) session_start();

	if($val===null){

		if(is_array($key)){
			$_SESSION[key($key)] = $key;
		}else{
			$_SESSION[varName($key)] = $key;
		}

	}else{

		if(is_object($val)) $val = serialize($val);

		$_SESSION[$key] = $val;
	}
	
}

function delSession($key)
{
	if(isset($_SESSION[$key])){
		unset($_SESSION[$key]);
		return true;
	}
	return false;
}

function varName($var) {
	foreach($GLOBALS as $var_name => $value) {
		if ($value === $var) {
			return $var_name;
		}
	}
	return false;
}

function dd($val){
	echo Utils::printTable($val);
}