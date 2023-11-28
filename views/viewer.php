<?php 
//
//
//	Existe uma lógica para a verificação de url para fazer o redirecionamento da página
//	praticamente, qualquer coisa que não for "index.php" ou as requisições $_GET abaixo vão levar para a página de erro
//
$vars = Utils::getUrlVars();
if(isset($_GET['nome']) && isset($_GET['nome']) && isset($_GET['whatsapp'])){
	// Função para validar um endereço de e-mail
	function validarEmail($email) {
		// Remove espaços em branco do início e do final do endereço de e-mail
		$email = trim($email);

		// Validação usando expressão regular
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true; // E-mail válido
		} else {
			return false; // E-mail inválido
		}
	}

	// Função para verificar o formato do número de telefone brasileiro
	function validarNumeroTelefoneBrasileiro($numero) {
		// Padrão de expressão regular para um número de telefone brasileiro
		$padrao = '/^\d{2} \d{5}-\d{4}$/';

		// Verifica se o número de  corresponde ao padrão
		return preg_match($padrao, $numero) === 1;
	}

	function retorno($texto){
		echo "
				<script>
					alert('$texto')
					window.history.back()
				</script>
				";
	}

	// Exemplo de uso
	$nome = $_GET['nome'];
	$email = $_GET['email'];
	$numero = $_GET['whatsapp'];

	echo $numero;

	if (validarEmail($email) && validarNumeroTelefoneBrasileiro($numero)) {
		$usuario = new UsuarioSite();
		$usuario->flstatus = 1;
		$resultado = true;

		$usuarios = DaoSI::getList($usuario);

		foreach($usuarios as $usuario){
			if($usuario->telefone == $numero && $usuario->email == $email){
				retorno('já existe alguém com esse mesmo telefone e mail');
				$resultado = false;
			} else if($usuario->email == $email){
				retorno("já existe alguém com esse mesmo email");
				$resultado = false;
			} else if($usuario->telefone == $numero ){
				retorno("já existe alguém com esse mesmo número para contato");
				$resultado = false;
			}
		}

		if($resultado){
			$timestamp = time();
			$dataFormatada = date('Y-m-d G:i:s', $timestamp);

			DaoSI::insert('usuarios_site', array("nome"=>$nome, "email"=>$email, "telefone"=>$numero, "timestamp"=>$dataFormatada, "flstatus"=>1));
			retorno("usuario cadastrado");
		}
	} else {
		retorno('número de telefone ou email inválido');
	}
} else {
	if(isset($vars[0]) && $vars[0]=='admin')
		require_once('admin/template.php');
	else
		require_once('site/template.php');
}