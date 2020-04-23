<?php 

$token = User::getToken();

?><div class="temp-caixa">
	<div class="middle">
		<div class="caixa">
			<div class="txt">
				<b>COLABORE</b> COM A O DESENVOLVIMENTO DE UM <b>CENÁRIO POSITIVO</b> PARA O TURISMO EM FORTLAEZA. <br><br>
				<small>PREENCHA AS  PESQUISAS <br>
				MENSAIS DO OBSERVATÓRIO.</small> <br><br>
				<form method="post" action="<?=FrontEnd::raiz()?>area-restrita">
					<input type="email" name="email" placeholder="EMAIL">
					<input type="password" name="senha" placeholder="SENHA">
					<input type="hidden" name="token" value="<?=$token?>">
					<button class="btn btn-warning btn-sm">entrar</button>
				</form>
			</div>
		</div>
	</div>
</div>