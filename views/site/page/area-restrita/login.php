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
				<b>COLABORE</b> COM A O DESENVOLVIMENTO DE UM <b>CENÁRIO POSITIVO</b> PARA O TURISMO EM FORTLAEZA. <br><br>
				<small>PREENCHA AS  PESQUISAS <br>
				MENSAIS DO OBSERVATÓRIO.</small> <br><br>
				<form method="post" action="<?=FrontEnd::raiz()?>area-restrita">
					<input type="email" name="email" placeholder="EMAIL">
					<input type="password" name="senha" placeholder="SENHA">
					<input type="text" name="_token" value="<?=User::getToken()?>">
					<button class="btn btn-warning btn-sm">entrar</button>
				</form>
			</div>
		</div>
	</div>
</div>