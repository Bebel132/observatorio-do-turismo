<?php 
/**
 * Manipulação do usuário logado
 */
class User
{

	public static $error;

	static function getToken()
	{
<<<<<<< HEAD
		$token = md5(time().'Melancia');
		$_SESSION['token'] = $token;
=======
		$token = md5(time().'Banana');
		setSession('_token',$token);
>>>>>>> release/v1.2
		return $token;
	}

	static function checkToken($token)
	{
<<<<<<< HEAD
		if(!isset($_SESSION['token'])){
=======

		$tokenSession = getSession('_token');
		if(!$tokenSession){
>>>>>>> release/v1.2
			self::setError('Token inativo');
			header_status(500,'Inactive token');
			return false;
		}
		elseif($token==$_SESSION['token'])
		{
			return true;
		}else
		{
<<<<<<< HEAD
			unset($_SESSION['token']);
=======
			delSession('_token');
			header_status(500,'Invalid token');
>>>>>>> release/v1.2
			return false;
		}
	}
	
	static function isLoged()
	{
		if(isset($_SESSION['useron']) && $_SESSION['useron'])
			return true;
		return false;
	}

	public static function setError($msgError)
	{
		if(!isset(self::$error)) 
		{
			self::$error = array();
		}
		self::$error[] = $msgError;
	}


	static function singon($user,$pass,$token)
	{

		$user = trim($user);

		if(!$user || !$pass){
			self::setError('Username e Senha necessários');
		}elseif(self::checkToken($token)){

			$_SESSION['tentativas_n'] = (isset($_SESSION['tentativas_n']))?$_SESSION['tentativas_n']-1:LOGIN_TENTATIVAS;

			if($_SESSION['tentativas_n']<=0){
				$_SESSION['tentativas_dt'] = date('Y-m-d H:i:s');
				self::setError('Acabaram suas tentativas');
				Utils::redirect('./');
			}else{
				$CMISService = new CMISService(CMIS_URL.CMIS_SERV, $user, $pass);
				if($CMISService->authenticated){
					unset($_SESSION['tentativas_n']);
					$_SESSION['useron']['user'] = $user;
					$_SESSION['useron']['pass'] = $pass;
					return true;
				}else{
					self::setError('Usuário e/ou senha inválido(s)');
				}
			}
		}else{
			self::setError('Token inválido');
		}
		if(isset($_SESSION['useron']))
			unset($_SESSION['useron']);
		return false;
	}

	static public function logout()
	{
		if(isset($_SESSION['useron']))
			unset($_SESSION['useron']);
		Utils::redirect('./',1);
	}

	static function getUsername()
	{
		if(isset($_SESSION['useron']['user']))
			return $_SESSION['useron']['user'];
		return false;
	}

	static function getPassword()
	{
		if(isset($_SESSION['useron']['pass']))
			return $_SESSION['useron']['pass'];
		return false;
	}

<<<<<<< HEAD
}
?>
=======
}
>>>>>>> release/v1.2
