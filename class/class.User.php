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
		setSession('csrf_token',$token);
		return $token;
	}

	static function checkToken($token)
	{

		$tokenSession = getSession('csrf_token');
		if(!$tokenSession){
			self::setError('Token inativo');
			header_status(500,'Inactive token');
			return false;
		}
		elseif($token==$tokenSession)
		{
			return true;
		}else
		{
			delSession('csrf_token');
			header_status(500,'Invalid token');
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

	static function singonUsuarioSite($user,$pass,$token)
	{

		$user = trim($user);

		if(!$user || !$pass){
			self::setError('Username e Senha necessários');
		}elseif(self::checkToken($token)){

			$result = DaoSI::querySelect("SELECT * FROM usuarios_site WHERE email='{$user}' AND flstatus=1 LIMIT 1");

			if(isset($result[0]) && PasswordCompat::password_verify($pass,$result[0]['senha'])){
				setSession('UsuarioSiteLogado',new UsuarioSite($result[0]['id']));
				return true;
			}else{
				self::setError('Usuário e/ou senha inválido(s)');
			}
		}else{
			self::setError('Token inválido');
		}
		delSession('UsuarioSiteLogado');
		return false;
	}

	static function registerUsuarioSite($email,$pass,$pass_confirm,$typeUser,$token)
	{

		$email = trim($email);

		if(!$email || !$pass){
			self::setError('Email e Senha necessários');
		}elseif(self::checkToken($token)){

			if($pass != $pass_confirm){
				self::setError('Confirmação de senha inválido');
			}else{

				$result = DaoSI::querySelect("SELECT * FROM usuarios_site WHERE email='{$email}' AND perfil={$typeUser} LIMIT 1");

				if(isset($result[0]) && PasswordCompat::password_verify($pass,$result[0]['senha'])){
					self::setError('Cadastro já existente');
					return false;
				}else{

					$UsuarioSite = new UsuarioSite();
					$UsuarioSite->email = $email;
					$UsuarioSite->senha = PasswordCompat::password_hash($pass);
					$UsuarioSite->perfil = $typeUser;
					$UsuarioSite->flstatus = 1;
					$UsuarioSite->timestamp = date('Y-m-d H:i:s');

					if(DaoSI::merge($UsuarioSite)){
						setSession('UsuarioSiteLogado', $UsuarioSite);
						return true;
					}else{
						self::setError('Falha ao cadastrar');
						return false;

					}
				}

			}

		}else{
			self::setError('Token inválido');
		}
		delSession('UsuarioSiteLogado');
		return false;
	}

	static public function logout()
	{
		delSession('useron');
		Utils::redirect('./',1);
	}

}