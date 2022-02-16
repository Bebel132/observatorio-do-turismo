<?php 

if(isset($_REQUEST['t']) && $_REQUEST['t']=='assinante'){
	$tipoCadastro = 'ASSINANTE';
	$tipoCadastroId = 3;
}else{
	$tipoCadastro = 'ENTREVISTADO';
	$tipoCadastroId = 2;
}

if(
	count($_POST) 
	&& isset($_POST['email'])
	&& isset($_POST['senha'])
	&& isset($_POST['senha_confirma'])
){
	$cadastro = User::registerUsuarioSite($_POST['email'],$_POST['senha'],$_POST['senha_confirma'],$tipoCadastroId,$_POST['csrf_token']);

	if($cadastro){
		Utils::redirect('./',0);

	}
}

// dd($_SERVER);

// $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $parts = parse_url($actual_link);
// parse_str($parts['query'], $query);
// echo $query['email'];

// dd( parse_url($_))

?><div class="temp-caixa cadastro">

	<div class="middle">
		<div class="caixa">
			<div class="txt">
				<b>COLABORE</b> COM A O DESENVOLVIMENTO DE UM <b>CENÁRIO POSITIVO</b> PARA O TURISMO EM FORTALEZA. <br><br>
				<small>PREENCHA AS  PESQUISAS <br>
				MENSAIS DO OBSERVATÓRIO.</small> <br><br>

				<?php 
				if(isset($cadastro) && !$cadastro){
					foreach (User::$error as $erro) {
						FrontEnd::alert($erro,'danger');
					}
				}
				?>

				<b>CADASTRO DE <?=$tipoCadastro?></b>
				<form method="post">
					<input type="hidden" name="csrf_token" value="<?=User::getToken()?>">

					<div class="row">
						<div class="col-12">
							Digite seu e-mail
							<input type="email" name="email" placeholder="E-MAIL">
						</div>

					</div>

					<div class="row">
						<div class="col-8 mt-2">
							Digite a senha
							<input type="password" name="senha" placeholder="SENHA">
						</div>
						<div class="col-8 mt-2">
							Confirme a senha
							<input type="password" name="senha_confirma" placeholder="SENHA">
						</div>
						<div class="col-12 mt-3">
							<button class="btn btn-warning ">cadastrar</button>
						</div>
					</div>

				</form>
			</div>

		</div>
		
		<div class="mt-2">
			Já tem cadastro? <a href="<?=FrontEnd::raiz()?>./area-restrita/login">Faça login</a>.
		</div>

	</div>
</div>

