<?php 

$banner = new Banner();
$banner->tipo = 4;
$banner->flstatus = 1;
$banner = DaoSI::getList($banner,null,1);

$img = "";
if($banner){
	$img = $banner->getImg('filename',true);
	$img = "background-image: url({$img});";
}

?><div class="temp-caixa">

	

	<div class="middle" style="<?=$img?>">
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

				<form method="post" action="<?=FrontEnd::raiz()?>area-restrita">
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
							<button class="w-100 btn btn-warning btn-sm">entrar</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>