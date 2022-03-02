<div class="container mb-5">

	<div class="my-5">
		<h3>Pesquisas</h3>
		<div class="barlogado"><?=$UsuarioSiteLogado->email?> - <?=$perfil?> | <a href="<?=FrontEnd::raiz()?>area-restrita/sair"> <i class="fas fa-sign-out-alt"></i> Sair</a></div>
	</div>

	<div class="pb-4">
		<h5 class="mb-3 text-info">Formulários disponíveis</h5>
		<div class="row justify-content-center">
			<?php 
			$pesquisa = new Pesquisa();
			$pesquisa->flstatus = 1;
			$pesquisa->tipo = 1;
			$pesquisas = DaoSI::getList($pesquisa);
			foreach ($pesquisas as $kk => $pesquisa)
			{

				$link = "#indiponivel";
				if($pesquisa->link_form)
					$link = Utils::urlFormat($pesquisa->link_form);

				?>
				<div class="col-12 col-sm-3 pb-5">
					<div class="card shadow">
						<div class="img-center"> <?=$pesquisa->getImg('filename')?> </div>
						<div class="card-body">
							<h5 class="card-title"><?=$pesquisa->titulo?></h5>
							<p class="card-text"><?=$pesquisa->descricao?></p>
							<a href="<?=$link?>" class="btn btn-sm btn-primary" target="_blank">Preencher formulário</a>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php if (!count($pesquisas)): ?>
				<span class="alert alert-warning">Nenhum formulário disponível no momento</span>
			<?php endif ?>
		</div>
	</div>

	<?php 
	$resultado = new Pesquisa();
	$resultado->flstatus = 1;
	$resultado->tipo = 2;
	$resultados = DaoSI::getList($resultado);
	?>
	<div class="pb-4">
		<h5 class="mb-3 text-info mt-5">Resultados disponíveis</h5>
		<div class="row justify-content-center">
			<?php 

			foreach ($resultados as $kk => $resultado)
			{

				$link = "#indiponivel";
				if($resultado->file_resultado)
					$link = $resultado->getImg('file_resultado',1);
				if($resultado->link_resultado)
					$link = Utils::urlFormat($resultado->link_resultado);

				?>
				<div class="col-12 col-sm-3 pb-5">
					<div class="card">
						<div class="img-center"> <?=$resultado->getImg('filename')?> </div>
						<div class="card-body">
							<h5 class="card-title"><?=$resultado->titulo?></h5>
							<p class="card-text"><?=$resultado->descricao?></p>
							<a href="<?=$link?>" class="btn btn-sm btn-info" target="_blank">Ver resultado</a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

	<?php if (!count($resultados)): ?>
		<span class="alert alert-warning">Nenhum resultado disponível no momento</span>
	<?php endif ?>

</div>

