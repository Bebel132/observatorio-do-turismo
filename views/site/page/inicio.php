<div id="home"></div>
<div class="superbanner">
	<div id="carouselSuperbanner" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php 
			$banner = new Banner();
			$banner->tipo = 1;
			$banners = DaoSI::getList($banner);
			$a=0;
			foreach ($banners as $banner)
			{
				$a++;
				$active = ($a==1)?'active':'';
				
				?>
				<div class="carousel-item <?=$active?>">
					<?php 
					if($banner->link) echo "<a target='_blank' href='{$banner->link}'>";
					echo $banner->getImg('filename');
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
	<h2>O que é o Observatório do Turismo</h2>
	<div class="txt">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
	<div class="institucional">
		<div class="fleft w33">
			<div class="icon">
				<?=FrontEnd::resource('icon-missao.svg')?>
				<span>MISSÃO</span>
			</div>
			<div class="txt">
				Auxiliar na tomada de decisão dos setores
				público e privado para o desenvolvimento da
				economia do Turismo, fornecendo informações
				segmentadas e específicas, agregando à
				cadeia produtiva.
			</div>
		</div>
		<div class="fleft w33">
			<div class="icon">
				<?=FrontEnd::resource('icon-visao.svg')?>
				<span>VISÃO</span>
			</div>
			<div class="txt">
				Ser referência no provimento de
				informações capazes de promover o
				desenvolvimento econômico através de
				qualificação continuada e
				processos bem definidos.
			</div>
		</div>
		<div class="fleft w33">
			<div class="icon">
				<?=FrontEnd::resource('icon-valores.svg')?>
				<span>VALORES</span>
			</div>
			<div class="txt">
				VALORES: <br>
				1. Inovação <br>
				2. Sustentabilidade <br>
				3. Criatividade <br>
				4. Credibilidade <br>
				5. Compromisso com a gestão <br>
				6. Respeito às pessoas <br>
				7. Ética, transparência e honestidade <br>
				8. Integração e Colaboração <br>
			</div>
		</div>
	</div>

	<!-- Pesquisas -->
	<h2>Pesquisas</h2>
	<div id="pesquisas"></div>
	<div class="pesquisas">
		<div id="carouselPesquisas" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<?php 
					$pesquisa = new Pesquisa();
					$pesquisa->status = 2;
					$pesquisas = DaoSI::getList($pesquisa);
					$t = count($pesquisas);
					$b=$a=0;
					foreach ($pesquisas as $kk => $pesquisa)
					{
						$a++;
						$b++;
						?>
						<div class="fleft w33">
							<?php 
							if($pesquisa->link_resultado) echo "<a target='_blank' href='{$pesquisa->link_resultado}'>";
							echo $pesquisa->getImg('filename');
							if($pesquisa->link_resultado) echo "</a>"; 
							?>
						</div>
						<?php if($b==3 && $a<$t){echo '</div><div class="carousel-item">'; $b=0; } 
					} ?>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselPesquisas" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselPesquisas" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<br>
		<a href="area-restrita" class='btn btn-sm btn-primary'> Responda as pesquisas </a>
	</div>


	<!-- Indicadores -->
	<?php $tipos = [1=>"Empregos","Demandas","Sazonalidade","Receita","Prestação de Serviços"]; ?>
	<h2>Indicadores</h2>
	<div id="indicadores"></div>
	<div class="carouselIndicadores">
		<div class="naver">
			<?php
			$a=0; foreach ($tipos as $k => $name)
			{ $a++; $active = ($a==1)?'active':''; ?>
			<a href="#indicadores" class="gotab rollto <?=$active?>" tab=".tab<?=$k?>" container=".carouselIndicadores"><?=$name?></a>
		<?php } ?>
	</div>
	<br>
	<?php 
	$hide = "";
	$a=0;
	foreach ($tipos as $k => $name)
	{
		$a++;
		$Indicador = new Indicador();
		$Indicador->tipo = $k;
		$indicadores = DaoSI::getList($Indicador);
		?>
		<div id="carouselIndicadores<?=$k?>" class="carousel azul slide tab tab<?=$k?><?=$hide?>" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<?php 
					$b=$a=0;
					foreach ($indicadores as $kk => $indicador)
					{
						$a++;
						$b++;
						?>
						<div class="fleft w33">
							<?php 
							if($pesquisa->link_resultado) echo "<a target='_blank' href='{$pesquisa->link_resultado}'>";
							echo $indicador->getImg('filename');
							?>
							<div class="title"><?=$indicador->titulo?></div>
							<div class="subtitle"><?=$indicador->descricao?></div>
							<?php if($pesquisa->link_resultado) echo "</a>";  ?>
						</div>
						<?php if($b==3 && $a<$t){echo '</div><div class="carousel-item">'; $b=0; } } ?>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselIndicadores<?=$k?>" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselIndicadores<?=$k?>" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<?php $hide=" hide"; } ?>
		</div>

		<br><br><br>

		<!-- Dashboard -->
		<div id="dashboards"></div>
		<div style="height: 500px; background: #EEE">
			<iframe frameborder="0" width="100%" height="100%" src="<?=IFRAME_POWERBI?>"></iframe>
		</div>


		<br><br>
		<br><br>

		<!-- Aplicativos e Sites -->
		<h2>Aplicativos e Sites</h2>
		<div id="aplicativos"></div>
		<?php 
		$banner = new Banner();
		$banner->tipo = 2;
		$banners = DaoSI::getList($banner);
		$a=0;
		foreach ($banners as $banner)
		{
			$a++;
			$active = ($a==1)?'active':'';
			if($banner->link) echo "<a target='_blank' href='{$banner->link}'>";
			?>
			<div class="img">
				<?=$banner->getImg('filename')?>
			</div>
			<?php if($banner->link) echo "</a>"; 
		} ?>

		<!-- Parceiros -->
		<h2>Parceiros</h2>
		<div id="parceiros"></div>
		<div class="parceiros">
			<?php for ($i=0; $i < 15; $i++) { ?>
				<span class="u">
					Lorem ipsum
				</span>
			<?php } ?>
		</div>

		<br>
		<br>
		<br>
		<br>
		<br>

	</div>