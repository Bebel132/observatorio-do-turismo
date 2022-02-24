<?php 

if(
	count($_POST) 
	&& isset($_POST['email'])
){
	$cadastro = User::registerUsuarioSite($_POST['email'],$_POST['senha'],$_POST['senha_confirma'],$_POST['csrf_token']);

	if($cadastro){
		Utils::redirect('./',0);
	}
}

?><div class="temp-caixa cadastro">

	<div class="middle">
		<div class="caixa">
			<div class="txt">
				<?php 
				if(isset($cadastro) && !$cadastro){
					foreach (User::$error as $erro) {
						FrontEnd::alert($erro,'danger');
					}
				}
				?>

				<b>RECUPERAÇÃO DE SENHA</b>
				<br>
				<br>
				<form method="post">
					<input type="hidden" name="csrf_token" value="<?=User::getToken()?>">

					<div class="row">
						<div class="col-12">
							Digite seu e-mail
							<input type="email" name="email" placeholder="E-MAIL">
						</div>

					</div>

					<div class="row">
						<div class="col-12 mt-3">
							<button class="btn btn-warning ">recuperar</button>
						</div>
					</div>

				</form>
			</div>

		</div>
		
		<div class="mt-2">
			Já sabe a senha? <a href="<?=FrontEnd::raiz()?>./area-restrita/login">Faça login</a>.
		</div>

	</div>
</div>

