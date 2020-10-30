<?php 
/**
 * Manipulação do usuário logado
 */
class User
{

	public static $error;

	static function getToken()
	{
		$token = md5(time().'Banana');
		setSession('_token',$token);
		return $token;
	}

	static function checkToken($token)
	{
		$tokenSession = getSession('_token');
		echo $tokenSession;
		echo '=';
		echo $token;
		if(!$tokenSession){
			self::setError('Token inativo');
			return false;
		}
		elseif($token==$tokenSession)
		{
			return true;
		}else
		{
			delSession('_token');
			return false;
		}
	}
	
	static function isLoged()
	{
		if(getSession('useron'))
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

			$tentativas_n = getSession('tentativas_n');

			if($tentativas_n){
				$tentativas_n--;
			}else{
				$tentativas_n = LOGIN_TENTATIVAS;
			}
			setSession('tentativas_n',$tentativas_n);

			if($tentativas_n<=0){
				setSession('tentativas_dt',date('Y-m-d H:i:s'));
				self::setError('Acabaram suas tentativas');
				Utils::redirect('./');
			}else{
				
				$result = DaoSI::querySelect("SELECT * FROM usuarios WHERE email='{$user}' AND perfil=1 LIMIT 1");

				if(isset($result[0]) && PasswordCompat::password_verify($pass,$result[0]['senha'])){
					delSession('tentativas_n');
					setSession('useron',new Usuario($result[0]['id']));
					return true;
				}else{
					self::setError('Usuário e/ou senha inválido(s)');
				}
			}
		}else{
			self::setError('Token inválido');
		}
		delSession('useron');
		return false;
	}

	static function singonParceiro($user,$pass,$token)
	{

		$user = trim($user);

		if(!$user || !$pass){
			self::setError('Username e Senha necessários');
		}elseif(self::checkToken($token)){

			$result = DaoSI::querySelect("SELECT * FROM usuarios WHERE email='{$user}' AND perfil=2 LIMIT 1");

			if(isset($result[0]) && PasswordCompat::password_verify($pass,$result[0]['senha'])){
				setSession('ParceiroLogado',new Usuario($result[0]['id']));
				return true;
			}else{
				self::setError('Usuário e/ou senha inválido(s)');
			}
		}else{
			self::setError('Token inválido');
		}
		delSession('ParceiroLogado');
		return false;
	}

	static public function logout()
	{
		delSession('useron');
		Utils::redirect('./',1);
	}


}