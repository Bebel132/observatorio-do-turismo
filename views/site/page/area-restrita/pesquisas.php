<div class="container">

	<br> 
	<h3>Pesquisas disponíveis </h3>
	<div class="barlogado"><?=$ParceiroLogado->nome?> - <?=$ParceiroLogado->instituicao?> | <a href="<?=FrontEnd::raiz()?>area-restrita/sair"> <i class="fas fa-sign-out-alt"></i> Sair</a></div>
	<br>

	<div class="row">
		<?php 
		$pesquisa = new Pesquisa();
		$pesquisa->status = 1;
		$pesquisas = DaoSI::getList($pesquisa);
		foreach ($pesquisas as $kk => $pesquisa)
		{
			?>
			<div class="col-sm-3" style="margin:20px">
				<div class="card">
					<?=$pesquisa->getImg('filename')?>
					<div class="card-body">
						<h5 class="card-title"><?=$pesquisa->titulo?></h5>
						<p class="card-text"><?=$pesquisa->descricao?></p>
						<a href="<?=$pesquisa->link_form?>" class="btn btn-primary" target="_blank">Formulário</a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<br><br>
<br><br>