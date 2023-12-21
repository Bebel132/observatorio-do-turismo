<!-- $variavel = new Objeto(ID) == CRIAÇÃO DE UM NOVO OBJETO

	objeto::metodo        ===  chama uma função  | EXEMPLO: DaoSI::getList($IndicadorTipo,'titulo asc');  ==> gera uma lista com o titulo dos indicadores que estão no banco de dados
	$variavel->atributo   ===  chama um atriburo | EXEMPLO: $Texto_QuemSomos->texto                       ==> chama o texto que está no banco de dados -->

<div class="ponteDosIngleses">
	<div class="historia">
		<div class="historia-texto">
			<h2>História da Beira Mar</h2>
			<p>A Avenida Beira-Mar, um dos principais pontos turísticos de Fortaleza, começou a ser construída em 1961 durante o governo de Manoel Cordeiro Neto. Antes disso, a região era habitada principalmente por pescadores e algumas casas de veraneio.me  Ao longo dos anos, a avenida passou por várias fases de urbanização e requalificação, transformando-se em um importante centro de negócios, turismo e lazer</p>
		</div>
		<a target="_blank" href="https://maps.app.goo.gl/adYtun5fXWq3xcM76" class="historia-botao"><i class="fa-solid fa-location-arrow"></i>Ver no mapa</a>
	</div>
</div>
<img src="resource/vetores/vector-wave.png" alt="" class="vector-wave">
<section>
	<div class="section-container quemSomos" id="quemSomos">
		<div class="quemSomos-title title">
			<h1>Sobre Nós</h1>
		</div>
		<div class="quemSomos-content content">
			<div class="quemSomos-boxes">
				<?php
					for($i = 1; $i<=3; $i++){
						$Texto_QuemSomos = new Texto($i);
						if ($Texto_QuemSomos->flstatus==1){
							?>
							<div class="quemSomos-box">
								<div class="quemSomos_box-title title">
									<img src="resource/uploads/textos/<?=$Texto_QuemSomos->filename?>" alt="" class="quemSomos_boxes_title-img">
									<h2 id="quemSomos"><?=$Texto_QuemSomos->label?></h2>
								</div>
								<div class="quemSomos_boxes-content content">
									<p><?=nl2br($Texto_QuemSomos->texto)?></p>
									<button class="ler-mais">Ler mais</button>
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
			<?php
				$Texto_QuemSomos = new Texto(4);
				if ($Texto_QuemSomos->flstatus==1):?>
				<b><?= $Texto_QuemSomos->label ?>:</b><span> <?= $Texto_QuemSomos->texto ?></span>
			<?php endif ?>
		</div>
	</div>
</section>
<section>
	<img src="resource/vetores/dtiSVG.svg" alt="" class="dtiSVG">
	<div class="section-container dti">
		<div class="dti-title title" id="dti">
			<h1>DTI</h1>
		</div>
		<div class="dti-content content">
			<div class="dti-boxes">
				<?php
				for($i = 5; $i <= 14; $i++):
					$texto_dti_box = new Texto($i);
					if ($texto_dti_box->flstatus==1):?>
					<div class="dti-box" id="">
						<div class="dti_box-title title">
							<img src="resource/uploads/textos/<?= $texto_dti_box->filename ?>" class="dti-icon" alt="">
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
	</div>
</section>
<section>
	<div class="section-container inteligenciaTuristica">
		<div class="inteligenciaTuristica-content content" id="inteligenciaTuristica">
			<?php
				$inteligenciaTuristica = new Texto(16);
			?>
			<iframe src="<?php echo $inteligenciaTuristica->texto ?>" frameborder="0"></iframe>
		</div>
	</div>
</section>
<section>
	<div class="section-container pesquisas" id="pesquisas">
		<div class="pesquisas-content content">
			<div class="pesquisas-container">
				<div class="pesquisas-barraLateral">
					<ul class="pesquisas_barraLateral-lista">
					<?php
					$IndicadorTipo = new IndicadorTipo();
					$IndicadorTipo->flstatus = 1;
					$IndicadorTipos = DaoSI::getList($IndicadorTipo,'titulo asc');

					foreach (array_reverse($IndicadorTipos) as $indicador) {
						if ($indicador->titulo != "SISTEMA DE INTELIGÊNCIA TURÍSTICA") {
							echo "<li class='pesquisas_barraLateral_lista-opcao $indicador->id'>$indicador->titulo</li>";
						}
					}
					?>
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
 <section>
	<div class="section-container geoinformacao">
		<div class="geoinformacao-title title">
			<h1>GeoInformação</h1>
		</div>
		<div class="geoinformacao-content content" id="geoinformacao">
			<?php
				$geoinformacao = new Texto(15);
			?>
			<iframe src="<?php echo $geoinformacao->texto ?>" frameborder="0"></iframe>
		</div>
	</div>
</section> 
<section class="section-container" id="parceiros">
	<div class="parceiros-container">
		<div class="parceiros-title title">
			<h1>Parceiros</h1>
		</div>
		<div class="parceiros-content">
			<?=FrontEnd::resource('abav.png')?>
			<?=FrontEnd::resource('abih.png')?>
			<?=FrontEnd::resource('abrasel.png')?>
			<?=FrontEnd::resource('caf.png')?>
			<?=FrontEnd::resource('fraport.png')?>
			<?=FrontEnd::resource('ipece.png')?>
			<?=FrontEnd::resource('prefeitura.png')?>
			<?=FrontEnd::resource('socicam.png')?>
			<?=FrontEnd::resource('visiteFortaleza.png')?>
		</div>
	</div>
</section>
<section>
	<div class="section-container assinantes">
		<div class="assinantes-content">
			<div class="assinantes-box" id="assinantes">
					<div class="assinantes_box-img">
						<img src="resource/vetores/Frame.svg" alt="">
					</div>
					<div class="assinantes_box-title">
						<h2>Seja um de nossos assinantes você também</h2>
					</div>
					<div class="assinantes_box-content">
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio alias quaerat tempora illo odit. Assumenda eius, non repudiandae suscipit fugiat blanditiis voluptatem tempore dolorem minima, maxime nobis veniam, rerum tenetur?
					</div>
			</div>
			<div class="assinantes-form">
				<form action="#" method="get" class="assinantes_content-form">
					<div class="form-campo">
						<input type="nome" name="nome" required placeholder="nome completo">
					</div>
					<div class="form-campo">
						<input type="email" name="email" required placeholder="exemplo@mail.com">
					</div>
					<div class="form-campo">
						<input type="text" name="whatsapp" required placeholder="xx xxxxx-xxxx" pattern="\d{2} \d{5}-\d{4}">
					</div>
					<span>ao enviar, você estará concordando em usar seu e-mail para futuras pesquisas</span>
					<input type="submit" value="enviar">
				</form>
			</div>
		</div>
	</div>
</section>