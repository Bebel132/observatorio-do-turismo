<?php 
/**
 * Manipulação do usuário logado
 */
class Log
{

	public static $error;

	static function rastreio($ext=false)
	{

		if(isset($_REQUEST['password']))
			unset($_REQUEST['password']);

		$username = User::getUsername();
		if(!$username && isset($_REQUEST['username'])){
			$username = $_REQUEST['username']; unset($_REQUEST['username']);
		}

		$page = Utils::getUrlVars();
		if((!$page || count($page)==0) && isset($_REQUEST['page'])){
			$page = [$_REQUEST['page']]; unset($_REQUEST['page']);
		}

		$Rastreio = new Rastreio();
		$Rastreio->username = $username;
		$Rastreio->page = $page;
		$Rastreio->request = $_REQUEST;
		if($ext)
			$Rastreio->ext = $ext;
		dd('Rastreio');
		DaoSI::persist($Rastreio);

	}

	static function set($index,$values)
	{
		//charset
		$_REQUEST[$index] = $values;
	}

}
?>