<?php 

if(
	count($_POST) 
	&& isset($_POST['email'])
	&& isset($_POST['senha'])
){
	$login = User::singonUsuarioSite($_POST['email'],$_POST['senha'],$_POST['csrf_token']);

	if($login){
		Utils::redirect('./',0);
	}
}

$banner = new Banner();
$banner->tipo = 4;
$banner->flstatus = 1;
$banner = DaoSI::getList($banner,1,1);

$img = "";
if($banner){
	$banner = current($banner);
	$img = $banner->getImg('filename',true);
	$img_m = $banner->getImg('filename_m',true);
}

?>
<style type="text/css">
	.bnr{ background-image: url(<?=$img?>) !important }
	@media only screen and (max-width: 600px) {
		.bnr{ background-image: url(<?=$img_m?>) !important }
	}
</style>
<div class="temp-caixa">

	<div class="middle">
		<div class="bnr">
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

					<form method="post" action="<?=FrontEnd::raiz()?>area-restrita/login">
						<input type="hidden" name="csrf_token" value="<?=User::getToken()?>">

						<div class="row">
							<div class="col-12">
								<input type="email" name="email" placeholder="EMAIL">
							</div>

						</div>

						<div class="row mt-2">
							<div class="col-8">
								<input type="password" name="senha" placeholder="SENHA">
							</div>
							<div class="col-4">
								<button class="w-100 btn btn-warning btn">entrar</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>

		<div class="mt-2">
			Não tem acesso? <a href="<?=FrontEnd::raiz()?>./area-restrita/cadastro/?t=entrevistado">Cadastre-se</a>.
		</div>

	</div>
</div>