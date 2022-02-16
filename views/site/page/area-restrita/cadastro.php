<?php 

if(isset($_REQUEST['t']) && $_REQUEST['t']=='assinante'){
	$tipoCadastro = 'ASSINANTE';
	$tipoCadastroId = 3;
}else{
	$tipoCadastro = 'ENTREVISTADO';
	$tipoCadastroId = 2;
}

?><div class="temp-caixa cadastro">

	<div class="middle">
		<div class="caixa">
			<div class="txt">
				<b>COLABORE</b> COM A O DESENVOLVIMENTO DE UM <b>CENÁRIO POSITIVO</b> PARA O TURISMO EM FORTALEZA. <br><br>
				<small>PREENCHA AS  PESQUISAS <br>
				MENSAIS DO OBSERVATÓRIO.</small> <br><br>

				<?php 
				if(isset($login) && !$login){
					foreach (User::$error as $erro) {
						FrontEnd::alert($erro,'danger');
					}
				}
				?>

				<b>CADASTRO DE <?=$tipoCadastro?></b>
				<form method="post" action="<?=FrontEnd::raiz()?>area-restrita">
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
							<input type="password" name="senha" placeholder="SENHA">
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

