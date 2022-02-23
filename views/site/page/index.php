<div id="inicio"></div>
<div class="superbanner">
	<div id="carouselSuperbanner" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php 
			$banner = new Banner();
			$banner->tipo = 1;
			$banner->flstatus = 1;
			$banners = DaoSI::getList($banner);
			$a=0;
			foreach ($banners as $banner)
			{

				$img1 = $imgm = $banner->getImg('filename');
				if($banner->filename_m) $imgm = $banner->getImg('filename_m');

				$a++;
				$active = ($a==1)?'active':'';
				
				?>
				<div class="carousel-item <?=$active?>">
					<?php 
					if($banner->link) echo "<a target='_blank' href='{$banner->link}'>";
					echo "<span class='w-only'>{$img1}</span>";
					echo "<span class='m-only'>{$imgm}</span>";
					if($banner->link) echo "</a>"; 
					?>
				</div>
				<?php 
			} ?>
		</div>
		<a class="carousel-control-prev" href="#carouselSuperbanner" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselSuperbanner" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>


<!-- Institucional -->
<div class="container">

	<?php $Texto_QuemSomos = new Texto(1); ?>

	<?php if ($Texto_QuemSomos->flstatus==1): ?>
		<h2><?=$Texto_QuemSomos->label?></h2>
		<div id="quem-somos"></div>
		<div class="txt">
			<?=nl2br($Texto_QuemSomos->texto)?>
		</div>
	<?php endif ?>
	<div class="institucional">


		<div class="row">
			
			<?php $TextoMissao = new Texto(2); ?>
			<?php if ($TextoMissao->flstatus==1): ?>
				<div class="col-12 col-md-4">
					<div class="row">
						<div class="col-3 icon">
							<?=FrontEnd::resource('icon-missao.svg')?>
							<span><?=$TextoMissao->label?></span>
						</div>
						<div class="col-9">
							<?=nl2br($TextoMissao->texto)?>
						</div>
					</div>
				</div>
			<?php endif ?>


			<?php $TextoVisao = new Texto(3); ?>
			<?php if ($TextoVisao->flstatus==1): ?>
				<div class="col-12 col-md-4">
					<div class="row">
						<div class="col-3 icon">
							<?=FrontEnd::resource('icon-visao.svg')?>
							<span><?=$TextoVisao->label?></span>
						</div>
						<div class="col-9">
							<?=nl2br($TextoVisao->texto)?>
						</div>
					</div>
				</div>
			<?php endif ?>


			<?php $TextoValores = new Texto(4); ?>
			<?php if ($TextoValores->flstatus==1): ?>
				<div class="col-12 col-md-4">
					<div class="row">
						<div class="col-3 icon">
							<?=FrontEnd::resource('icon-valores.svg')?>
							<span><?=$TextoValores->label?></span>
						</div>
						<div class="col-9">
							<?=nl2br($TextoValores->texto)?>
						</div>
					</div>
				</div>
			<?php endif ?>



		</div>


		
	</div>

	<!-- Pesquisas -->
	<div class="my-5 overflow-hidden"></div>
	<h2>Pesquisas</h2>
	<div id="pesquisas"></div>

	<div id="carouselPesquisas" class="carousel slide azul" data-ride="carousel">
		<div class="carousel-inner">
			<?php 
			$banner = new Banner();
			$banner->tipo = 5;
			$banner->flstatus = 1;
			$banners = DaoSI::getList($banner);
			$a=0;
			foreach ($banners as $banner)
			{

				$img1 = $imgm = $banner->getImg('filename');
				if($banner->filename_m) $imgm = $banner->getImg('filename_m');

				$a++;
				$active = ($a==1)?'active':'';

				?>
				<div class="carousel-item mb-4 <?=$active?>">
					<?php 
					if($banner->link) echo "<a target='_blank' href='{$banner->link}'>";
					echo "<span class='w-only'>{$img1}</span>";
					echo "<span class='m-only'>{$imgm}</span>";
					if($banner->link) echo "</a>"; 
					?>
				</div>
				<?php 
			} ?>
		</div>
		<?php if (count($banners)>1): ?>
			<a class="carousel-control-prev" href="#carouselPesquisas" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselPesquisas" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		<?php endif ?>
	</div>

	<?php 
	$pesquisa = new Pesquisa();
	$pesquisa->tipo = 2;
	$pesquisa->flstatus = 1;
	$pesquisas = DaoSI::getList($pesquisa);
	if (count($pesquisas)){ ?>
		
		<div class="pesquisas">
			<div id="carouselPesquisas" class="carousel azul slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="row justify-content-center">
							<?php 

							$t = count($pesquisas);
							$b=$a=0;
							foreach ($pesquisas as $kk => $pesquisa)
							{
								$a++;
								$b++;
								?>
								<div class="col-12 col-md-4">
									<?php 

									$link = "";
									if($pesquisa->link_resultado){
										$link = $pesquisa->link_resultado;
										if(substr($link, 0,4)!="http") $link = "https://".$link;
									}
									elseif($pesquisa->file_resultado){
										$link = "resource/uploads/pesquisas/".$pesquisa->file_resultado;
									}

									if($link) echo "<a target='_blank' href='{$link}'>";
									echo $pesquisa->getImg('filename');
									if($link) echo "</a>"; 
									?>
								</div>
								<?php if($b==3 && $a<$t){echo '</div></div><div class="carousel-item"><div class="row justify-content-center">'; $b=0; } 
							} ?>
						</div>
					</div>
				</div>
				<?php if (count($pesquisas)>3): ?>
					<a class="carousel-control-prev" href="#carouselPesquisas" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselPesquisas" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				<?php endif ?>
			</div>
			
		</div>

	<?php }else{ ?>
		<div class="text-warning">Nenhum resultado disponível no momento</div>
	<?php } ?>

	<?php 

	$pesquisa = new Pesquisa();
	$pesquisa->tipo = 1;
	$pesquisa->flstatus = 1;
	$formularios = DaoSI::getList($pesquisa);

	if(count($formularios)){
		?>

		<br>
		<a href="area-restrita" class='btn btn-sm btn-primary'> Responda as pesquisas </a>
	<?php } ?>

	<!-- Indicadores -->
	<?php 

	$IndicadorTipo = new IndicadorTipo();
	$IndicadorTipo->flstatus = 1;
	$IndicadorTipos = DaoSI::getList($IndicadorTipo,'titulo asc');

	?>
	<div class="my-5 overflow-hidden"></div>
	<h2>Indicadores</h2>
	<div id="indicadores"></div>
	<div class="carouselIndicadores">
		<div class="naver">
			<?php
			$a=0; foreach ($IndicadorTipos as $key => $indicadorTipo){ 
				$k = $indicadorTipo->id;
				$name = $indicadorTipo->titulo;
				$a++; $active = ($a==1)?'active':''; ?>
				<a href="#indicadores" class="gotab rollto <?=$active?>" tab=".tab<?=$k?>" container=".carouselIndicadores"><?=$name?></a>
			<?php } ?>
		</div>
		<br>
		<?php 
		$hide = "";
		$a=0;
		foreach ($IndicadorTipos as $key => $indicadorTipo)
		{
			$k = $indicadorTipo->id;
			$name = $indicadorTipo->titulo;
			$a++;
			$Indicador = new Indicador();
			$Indicador->tipo = $k;
			$Indicador->flstatus = 1;
			$indicadores = DaoSI::getList($Indicador);
			?>
			<div id="carouselIndicadores<?=$k?>" class="carousel azul slide tab tab<?=$k?><?=$hide?>" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="row justify-content-center">
							<?php 
							$b=$a=0;
							$t=count($indicadores);
							foreach ($indicadores as $kk => $indicador)
							{
								$a++;
								$b++;

								$link = "";
								if($indicador->link){
									$link = $indicador->link;
									if(substr($link, 0,4)!="http") $link = "https://".$link;
								}

								?>
								<div class="col-12 col-md-4">
									<?php 
									if($link) echo "<a target='_blank' href='{$link}'>";
									echo $indicador->getImg('filename');
									?>
									<div class="title"><?=$indicador->titulo?></div>
									<div class="subtitle"><?=$indicador->descricao?></div>
									<?php if($link) echo "</a>";  ?>
								</div>
								<?php if($b==3 && $a<$t){echo '</div></div><div class="carousel-item"><div class="row justify-content-center">'; $b=0; } } ?>
							</div>
						</div>
					</div>
					<?php if ($t>3): ?>
						<a class="carousel-control-prev" href="#carouselIndicadores<?=$k?>" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselIndicadores<?=$k?>" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					<?php endif ?>
				</div>
				<?php $hide=" hide"; } ?>
			</div>


			<?php 
		/*
		<br><br><br>
		<!-- Dashboard -->
		<!-- <div id="dashboards"></div>
		<div style="height: 500px; background: #EEE">
			<iframe frameborder="0" width="100%" height="100%" src="<?=IFRAME_POWERBI?>"></iframe>
		</div> -->
		<br><br>
		<br><br>
		*/
		?>



		<!-- Aplicativos e Sites -->
		<div class="my-5 overflow-hidden"></div>
		<h2>Aplicativos e Sites</h2>
		<div id="aplicativos"></div>


		<div id="carouselAplicativos" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php 
				$banner = new Banner();
				$banner->tipo = 2;
				$banner->flstatus = 1;
				$banners = DaoSI::getList($banner);
				$a=0;
				foreach ($banners as $banner)
				{

					$img1 = $imgm = $banner->getImg('filename');
					if($banner->filename_m) $imgm = $banner->getImg('filename_m');

					$a++;
					$active = ($a==1)?'active':'';

					?>
					<div class="carousel-item <?=$active?>">
						<?php 
						if($banner->link) echo "<a target='_blank' href='{$banner->link}'>";
						echo "<span class='w-only'>{$img1}</span>";
						echo "<span class='m-only'>{$imgm}</span>";
						if($banner->link) echo "</a>"; 
						?>
					</div>
					<?php 
				} ?>
			</div>
			<?php if (count($banners)): ?>
				<a class="carousel-control-prev" href="#carouselAplicativos" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselAplicativos" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			<?php endif ?>
		</div>


		<!-- Parceiros -->
		<div class="my-5 overflow-hidden"></div>
		<h2>Parceiros</h2>
		<div id="parceiros"></div>
		<div class="parceiros">
			<?php

			$banner = new Banner();
			$banner->tipo = 3;
			$banner->flstatus = 1;
			$banners = DaoSI::getList($banner);

			foreach ($banners as $banner){

				$img1 = $imgm = $banner->getImg('filename');
				if($banner->filename_m) $imgm = $banner->getImg('filename_m');

				if($banner->link) echo "<a target='_blank' href='{$banner->link}'>";
				?>
				<span class="u">
					<span class="w-only"><?=$img1?></span>
					<span class="m-only"><?=$imgm?></span>
				</span>
				<?php if($banner->link) echo "</a>";
			} ?>
		</div>

		<br>
		<br>
		<br>
		<br>
		<br>

	</div>