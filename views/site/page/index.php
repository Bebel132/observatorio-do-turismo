<!-- 

	$variavel = new Objeto(ID) == CRIAÇÃO DE UM NOVO OBJETO

	objeto::metodo        ===  chama uma função  | EXEMPLO: DaoSI::getList($IndicadorTipo,'titulo asc');  ==> gera uma lista com o titulo dos indicadores que estão no banco de dados
	$variavel->atributo   ===  chama um atriburo | EXEMPLO: $Texto_QuemSomos->texto                       ==> chama o texto que está no banco de dados

 -->
<section>
	<div class="section-container quemSomos">
		<?php $Texto_QuemSomos = new Texto(1); ?>
		<?php if ($Texto_QuemSomos->flstatus==1): ?>
		<div class="quemSomos-title title">
			<h1 id="quemSomos"><?=$Texto_QuemSomos->label?></h1>
		</div>
		<div class="quemSomos-content content">
			<p><?=nl2br($Texto_QuemSomos->texto)?></p>
		<?php endif ?>
			<div class="quemSomos_content-boxes">
				<?php $TextoMissao = new Texto(2); ?>
				<?php if ($TextoMissao->flstatus==1): ?>
				<div class="quemSomos_content-box">
					<div class="quemSomos_content_box-title title">
						<i class="fa-regular fa-flag"></i>
						<h3><?=$TextoMissao->label?></h3>
					</div>
					<div class="quemSomos_content_box-content content">
						<p><?=nl2br($TextoMissao->texto)?></p>
					</div>
				</div>
				<?php endif ?>

				<?php $TextoVisao = new Texto(3); ?>
				<?php if ($TextoVisao->flstatus==1): ?>
				<div class="quemSomos_content-box">
					<div class="quemSomos_content_box-title title">
						<i class="fa-solid fa-eye"></i>
						<h3><?=$TextoVisao->label?></h3>
					</div>
					<div class="quemSomos_content_box-content content">
						<p><?=$TextoVisao->texto?></p>
					</div>
				</div>
				<?php endif ?>
				
				<?php $TextoValores = new Texto(4); ?>
				<?php if ($TextoValores->flstatus==1): ?>
				<div class="quemSomos_content-box">
					<div class="quemSomos_content_box-title title">
						<i class="fa-regular fa-star"></i>
						<h3><?=$TextoValores->label?></h3>
					</div>
					<div class="quemSomos_content_box-content content">
						<p><?=nl2br($TextoValores->texto)?></p>
					</div>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="section-container dti">
		<?php $Texto_DTI = new Texto(5); ?>
		<?php if ($Texto_DTI->flstatus==1): ?>
		<div class="dti-title title" id="dti">
			<h1><?= $Texto_DTI->label ?></h1>
		</div>
		<div class="dti-content content">
			<p><?=nl2br($Texto_DTI->texto)?></p>
			<div class="dti-boxes">
				<?php
				for($i = 6; $i <= 14; $i++):
					$texto_dti_box = new Texto($i);
					if ($texto_dti_box->flstatus==1):?>
					<div class="dti-box" id="">
						<div class="dti_box-title title">
							<h2><?= $texto_dti_box->label ?></h2>
						</div>
						<div class="dti_box-content content">
							<p class="closed-text"><?= $texto_dti_box->texto ?></p>
						</div>
					</div>
				<?php
					endif; 
				endfor
				?>
			</div>
		</div>
		<?php endif ?>
	</div>
</section>
<section>
	<div class="section-container inteligenciaTuristica">
		<div class="inteligenciaTuristica-title title">
			<h1 id="inteligenciaTuristica">inteligência turística</h1>
		</div>
		<div class="inteligenciaTuristica-content content">
			<div class="inteligenciaTuristica-boxes">
				<ul>
				<?php 

				$IndicadorTipo = new IndicadorTipo();
				$IndicadorTipo->flstatus = 1;
				$IndicadorTipos = DaoSI::getList($IndicadorTipo,'titulo asc');

				foreach($IndicadorTipos as $indicador) {
					if($indicador->titulo=="SISTEMA DE INTELIGÊNCIA TURÍSTICA"){
						$name = $indicador->titulo;
						$psqTuristica = new Indicador();
						$psqTuristica->tipo = $indicador->id;
						$psqTuristica->flstatus = 1;
						$psqTuristicaList = DaoSI::getList($psqTuristica);

						foreach($psqTuristicaList as $box){
							?>
							<li class="inteligenciaTuristica-box">
								<a href="<?php echo $box->link ?>" target="_blank" rel="noopener noreferrer">
									<i class="fa-solid <?php echo $box->icone ?>"></i>
									<h3><?php echo $box->titulo ?></h3>
								</a>
							</li>
							<?php
						}
					}
				}
				?>
				</ul>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="section-container pesquisas">
		<div class="pesquisas-title title">
			<h1 id="pesquisas">pesquisas</h1>
		</div>
		<div class="pesquisas-content content">
			<div class="pesquisas-container">
				<div class="pesquisas-barraLateral">
					<ul class="pesquisas_barraLateral-lista">
					<?php
					foreach (array_reverse($IndicadorTipos) as $indicador) {
						if ($indicador->titulo != "SISTEMA DE INTELIGÊNCIA TURÍSTICA") {
							echo "<li class='pesquisas_barraLateral_lista-opcao $indicador->id'>$indicador->titulo</li>";
						}
					}
					?>
					</ul>
				</div>
				<div class="pesquisas-boxes">
					<?php
					
					$pesquisa = new Pesquisa();
					$pesquisa->flstatus = 1;
					$pesquisas = DaoSI::getList($pesquisa);
					foreach($pesquisas as $pesquisaBox) {
						?>
						<div class="pesquisas-box <?php echo $pesquisaBox->indicador_tipo_id ?>">
							<div class="pesquisas_box-title title">
								<div class="pesquisas_box_title-bg">
									<img src="resource/uploads/pesquisas/<?php echo $pesquisaBox->filename ?>" alt="">
								</div>
								<h3><?php echo $pesquisaBox->titulo ?></h3>
								<span><?php echo $pesquisaBox->timestamp ?></span>
							</div>
							<div class="pesquisas_box-content content">
								<span><?php echo $pesquisaBox->descricao ?></span>
							</div>
								<?php
									if($pesquisaBox->link_painel_interativo != null){
										echo '<a target="_blank" href="'.$pesquisaBox->link_painel_interativo.'">painel interativo</a>';
									}
									if($pesquisaBox->link_relatorio != null){
										echo '<a target="_blank" href="'.$pesquisaBox->link_relatorio.'">relatório</a>';
									}
								?>
						</div>
						<?php
					}
					?>
				</div>
				<div class="controller closed">
					<span class="prev"><</span>
					<span class="count"></span>
					<span class="pos">></span>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="geoinformacao">
	<iframe src="<?php $endereco_mapa = new Texto(15); echo $endereco_mapa->texto ?>" frameborder="0" id="geoinformacao"></iframe>
</section>
<section>
	<div class="assinantes-container">
		<div class="assinantes-content">
			<div class="assinantes_content-text">
				<p id="assinantes" class="title">cadastro de assinante</p>
				<p class="title">colabore com o desenvolvimento de um cenário positivo para o turismo em fortaleza</p>
				<p>
					R. dos Tabajaras, 397 - Praia de Iracema,<br>
					Fortaleza - CE<br>
					CEP - 60060-510<br>
				</p>
			</div>
			<form action="#" method="get" class="assinantes_content-form">
				<div class="form-campo">
					<label for="nome">Digite o seu nome completo</label>
					<input type="nome" name="nome" required>
				</div>
				<div class="form-campo">
					<label for="email">Digite o seu e-mail</label>
					<input type="email" name="email" required placeholder="example@mail.com">
				</div>
				<div class="form-campo">
					<label for="whatsapp">Digite o seu número de whatsapp</label>
					<input type="text" name="whatsapp" required placeholder="xx xxxxx-xxxx" pattern="\d{2} \d{5}-\d{4}">
				</div>
				<input type="submit" value="enviar">
			</form>
		</div>
	</div>
</section>
<section class="section-container" id="parceiros">
	<div class="parceiros-container">
		<div class="parceiros-title title">
			<h1>Parceiros</h1>
		</div>
		<div class="parceiros-content">
			<?=FrontEnd::resource('abav.jpg')?>
			<?=FrontEnd::resource('abh.jpg')?>
			<?=FrontEnd::resource('abrasel.jpg')?>
			<?=FrontEnd::resource('caf.jpg')?>
			<?=FrontEnd::resource('fortalezaAirport.jpg')?>
			<?=FrontEnd::resource('ipece.jpg')?>
			<?=FrontEnd::resource('prefeitura.jpg')?>
			<?=FrontEnd::resource('socicam.jpg')?>
			<?=FrontEnd::resource('visiteCeara.jpg')?>
		</div>
	</div>
</section>
<footer>
	<div class="footer-container">
		<div class="social">
			<a href="https://www.facebook.com/secretariadoturismodefortaleza/?locale=pt_BR"><i class="fa-brands fa-facebook-f"></i></a>
			<a href="https://www.instagram.com/secretariadoturismodefortaleza/?hl=pt"><i class="fa-brands fa-instagram"></i></a>
		</div>
		<div class="icons">
			<?=FrontEnd::resource('caf.jpg')?>
			<?=FrontEnd::resource('logo2.svg')?>
			<?=FrontEnd::resource('prefeitura.jpg')?>
		</div>
	</div>
</footer>