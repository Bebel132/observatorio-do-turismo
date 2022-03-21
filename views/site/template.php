<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Observatório do Turismo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="icon" href="<?=FrontEnd::resource('logo.svg',1)?>" />
	<?= FrontEnd::resource('jquery-3.3.1.min.js'); ?>
	<script> jq = jQuery.noConflict( true ); </script>
	<?php
	// echo FrontEnd::resource('cookie.js');
	echo FrontEnd::resource('main.js');
	// echo FrontEnd::resource('reset.css');
	echo FrontEnd::resource('style-site.css');
	?>
</head>
<body>
	<center>
		<div class="backheader"></div>
		<header>
			<div class="container">
				<div class="logo fleft">
					<a href="<?=FrontEnd::raiz()?>./">
						<?=FrontEnd::resource('logo.svg')?>
					</a>
				</div>
				<div class="navbar fleft">
					<nav>
						<a href="<?=FrontEnd::raiz()?>./#inicio" class="rollto">Início</a>
						<a href="<?=FrontEnd::raiz()?>./#quem-somos" class="rollto">
							Quem Somos
							<span>Missão do Observatório!</span>
						</a>
						<a href="<?=FrontEnd::raiz()?>./#pesquisas" class="rollto">
							Pesquisas
							<span>Veja resultados ou preencha nossas pesquisas!</span>
						</a>
						<a href="<?=FrontEnd::raiz()?>./#indicadores" class="rollto">
							Indicadores
							<span>Acesse os nossos indicadores!</span>
						</a>
						<a href="<?=FrontEnd::raiz()?>./area-restrita/cadastro/?t=assinante" class="rollto">
							Assinantes
							<span>Seja nosso assinante e receba nossas publicações!</span>
						</a>
						<a href="<?=FrontEnd::raiz()?>./#aplicativos" class="rollto">
							Aplicativos e Sites
							<span>Acesse aplicativos e stites que recomendamos!</span>
						</a>
					</nav>
					<div class="shm"><div></div></div>
				</div>
			</div>
		</header>

		<section class="page">
			<?php FrontEnd::page(); ?>
		</section>

		<footer>
			<div class="container">
				<div class="fleft">
					<span class="rs"> 
						<a href="https://www.facebook.com/secretariadoturismodefortaleza/" target="_blank">
							<?=FrontEnd::resource('footer_01.png',false,'Facebook '.APP_TITLE)?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="https://www.instagram.com/secretariadoturismodefortaleza/" target="_blank">
							<?=FrontEnd::resource('footer_02.png',false,'Instagram '.APP_TITLE)?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="#" target="_blank">
							<?=FrontEnd::resource('footer_03.png',false,'LinkedIn '.APP_TITLE)?>
						</a> 
					</span>
				</div>
				<div class="fright">
					<span class="rs caf"> 
						<a href="#" target="_blank">
							<?=FrontEnd::resource('caf-rdp.png',false,'CAF')?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="<?=FrontEnd::raiz()?>./">
							<?=FrontEnd::resource('footer_06.png')?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="#" target="_blank">
							<?=FrontEnd::resource('logo-turismo-ceara.png',false,'Secretaria de Turismo de Fortaleza')?>
						</a> 
					</span>
				</div>
			</div>
		</footer>

	</center>


	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
