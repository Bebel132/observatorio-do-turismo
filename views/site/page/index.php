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
	<h2>O que é o Observatório do Turismo</h2>
	<div id="quem-somos"></div>
	<div class="txt">
		<p>
			O turismo é a atividade do setor terciário que mais cresce no mundo. E é uma fonte relevante de geração de renda e de empregos diretos e indiretos fundamental para a economia de diversos países. Como em outros lugares do mundo, a movimentação turística representa expressivos resultados no PIB da economia de Fortaleza.
		</p>
		<p>
			Para promover a qualidade desta atividade é de extrema importância a constante realização de pesquisas, de forma que possamos conhecer, além do número de entrada e saída de turistas em um destino, o perfil da demanda real, suas necessidades e desejos, bem como detectar a demanda potencial e realizar estudos de posicionamento de mercado desses locais.
		</p>
		<p>
			Atualmente, os dados sobre o turismo no município de Fortaleza são praticamente inexistentes, o que dificulta mensurar a importância desse setor para a economia do município. Daí a relevância do Observatório do Turismo de Fortaleza. Ele tem a finalidade de pesquisar, registrar, informar e gerenciar os resultados como instrumento de planejamento e gestão estratégica.
		</p>
		<p>
			Dessa forma, trata-se de uma ferramenta da Ciência da Informação que, quando devidamente usada, melhora os processos de gestão pública e das organizações do sistema turístico. Isso porque possibilita ao setor turístico estabelecer novas ações e programas, bem como definir políticas públicas que maximizem os resultados e implementem benefícios econômicos à cidade e à região. Serve também para estabelecer padrões de comportamento, relações e tendências que auxiliem na tomada de decisão. Além de fornecer dados da realidade do nosso município, o que possibilita acompanhar a evolução do setor.
		</p>
		
	</div>
	<div class="institucional">


		<div class="row">
			
			<div class="col-12 col-md-4">
				<div class="row">
					<div class="col-3 icon">
						<?=FrontEnd::resource('icon-missao.svg')?>
						<span>MISSÃO</span>
					</div>
					<div class="col-9">
						Auxiliar na tomada de decisão dos setores
						público e privado para o desenvolvimento da
						economia do Turismo, fornecendo informações
						segmentadas e específicas, agregando à
						cadeia produtiva.
					</div>
				</div>
			</div>


			<div class="col-12 col-md-4">
				<div class="row">
					<div class="col-3 icon">
						<?=FrontEnd::resource('icon-visao.svg')?>
						<span>VISÃO</span>
					</div>
					<div class="col-9">
						Ser referência no provimento de
						informações capazes de promover o
						desenvolvimento econômico através de
						qualificação continuada e
						processos bem definidos.
					</div>
				</div>
			</div>


			<div class="col-12 col-md-4">
				<div class="row">
					<div class="col-3 icon">
						<?=FrontEnd::resource('icon-valores.svg')?>
						<span>VALORES</span>
					</div>
					<div class="col-9">
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



		</div>


		
	</div>

	<!-- Pesquisas -->
	<div class="my-5 overflow-hidden"></div>
	<h2>Pesquisas</h2>
	<div id="pesquisas"></div>
	<div class="pesquisas">
		<div id="carouselPesquisas" class="carousel azul slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="row justify-content-center">
					<?php 
					$pesquisa = new Pesquisa();
					$pesquisa->tipo = 2;
					$pesquisa->flstatus = 1;
					$pesquisas = DaoSI::getList($pesquisa);
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
		<br>
		<br>
		<a href="area-restrita" class='btn btn-sm btn-primary'> Responda as pesquisas </a>
	</div>



	<!-- Indicadores -->
	<?php 

	$IndicadorTipo = new IndicadorTipo();
	$IndicadorTipo->flstatus = 1;
	$IndicadorTipos = DaoSI::getList($IndicadorTipo,'titulo asc');


	// $tipos = [1=>"Demanda Turística",
	// "Prestadores de Serviço",
	// "Sazonalidade / Ocupação",
	// "Impacto na Economia",
	// "Movimentação Aeroportuária",
	// "Empregos",
	// "Investimento Público",
	// "Receita Turística"];

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
			<a class="carousel-control-prev" href="#carouselAplicativos" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselAplicativos" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
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