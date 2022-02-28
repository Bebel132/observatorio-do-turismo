<?php 

if(
	count($_POST) 
	&& isset($_POST['email'])
){
	
	$cadastro = User::recoveryUsuarioSite($_POST['email'],$_POST['csrf_token']);


}


?>
<div class="temp-caixa cadastro">

	<div class="middle">
		<div class="caixa">
			<div class="txt">
				<?php 
				if(isset($cadastro)){
					if(!$cadastro){
						foreach (User::$error as $erro) {
							FrontEnd::alert($erro,'danger');
						}
					}else{
							FrontEnd::alert('Uma nova senha foi enviada para o e-mail solicitado!','success');
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

