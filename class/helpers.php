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


function header_status($statusCode,$msgCustomize=null) {
	static $status_codes = null;

	if ($status_codes === null) {
		$status_codes = array (
			100 => 'Continue',
			101 => 'Switching Protocols',
			102 => 'Processing',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			207 => 'Multi-Status',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			422 => 'Unprocessable Entity',
			423 => 'Locked',
			424 => 'Failed Dependency',
			426 => 'Upgrade Required',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
			506 => 'Variant Also Negotiates',
			507 => 'Insufficient Storage',
			509 => 'Bandwidth Limit Exceeded',
			510 => 'Not Extended'
		);
	}

	if ($status_codes[$statusCode] !== null) {
		$status_string = $statusCode . ' ' . $status_codes[$statusCode];
		header($_SERVER['SERVER_PROTOCOL'] . ' ' . $status_string, true, $statusCode);
	}


	if($statusCode>200){
		$msgCustomize = 
		require_once('views/errors/generic.php');
		exit;
	}

}





function getUniarrayDb($Classe,$key,$value,$where='(1)'){

	$arr = $r = array();

	$where = $where != '(1)' ? "WHERE $where" : '';

	$Entity = new $Classe();

	$tb = DaoSI::getTableObj($Entity)['name'];
	$r = DaoSi::querySelect("SELECT $key , $value FROM {$tb} $where");

	$r = Utils::escapeHtml($r);

	for ($a=0; $a < count($r); $a++) { 
		$k = $r[$a][$key];
		$v = $r[$a][$value]." #{$k}";
		$arr[$k] = $v;
	}
	return $arr;

}