<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Observatório do Turismo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="icon" href="<?=FrontEnd::resource('logo.svg',1)?>" />
<<<<<<< HEAD

=======
	<?= FrontEnd::resource('jquery-3.3.1.min.js'); ?>
	<script> jq = jQuery.noConflict( true ); </script>
>>>>>>> release/v1.2
	<?php

	// FrontEnd::resource('jquery-3.3.1.min.js');
	// FrontEnd::resource('cookie.js');
	// FrontEnd::resource('main.js');
	FrontEnd::resource('reset.css');
	FrontEnd::resource('style-site.css');

	?>
<<<<<<< HEAD

	<script> //jq = jQuery.noConflict( true ); </script>


=======
>>>>>>> release/v1.2
</head>
<body>

	<center>


		<header>
			<div class="container">
				<div class="logo fleft">
<<<<<<< HEAD
					<?=FrontEnd::resource('logo.svg')?>
=======
					<a href="<?=FrontEnd::raiz()?>./">
						<?=FrontEnd::resource('logo.svg')?>
					</a>
>>>>>>> release/v1.2
				</div>
				<div class="navbar fleft">
					<nav>
						<a href="#" class="active">Home</a>
						<a href="#">Pesquisas</a>
						<a href="#">Indicadores</a>
						<a href="#">Dashboards</a>
						<a href="#">Aplicativos e Sites</a>
					</nav>
				</div>
			</div>
		</header>

		<div class="superbanner">
			<div id="carouselSuperbanner" class="carousel slide" data-ride="carousel">
				
				<div class="carousel-inner">
					<div class="carousel-item active">
						<?=FrontEnd::resource('test-banner.jpg')?>
					</div>
					<div class="carousel-item">
						<?=FrontEnd::resource('test-banner.jpg')?>
					</div>
					<div class="carousel-item">
						<?=FrontEnd::resource('test-banner.jpg')?>
					</div>
				</div>

<<<<<<< HEAD
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


			<h2>Pesquisas</h2>

			<div class="pesquisas">
				<div id="carouselPesquisas" class="carousel slide" data-ride="carousel">
					
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="fleft w33"><?=FrontEnd::resource('test-pesquisa1.jpg')?></div>
							<div class="fleft w33"><?=FrontEnd::resource('test-pesquisa2.jpg')?></div>
							<div class="fleft w33"><?=FrontEnd::resource('test-pesquisa3.jpg')?></div>
						</div>
						<div class="carousel-item">
							<div class="fleft w33"><?=FrontEnd::resource('test-pesquisa1.jpg')?></div>
							<div class="fleft w33"><?=FrontEnd::resource('test-pesquisa2.jpg')?></div>
							<div class="fleft w33"><?=FrontEnd::resource('test-pesquisa3.jpg')?></div>
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
			</div>


			<h2>Indicadores</h2>



			<!-- iframe -->
			<div style="height: 500px; background: #EEE">
				<div class="middle">
					<h2 style="color: #CCC">IFRAME DASHBOARD</h2>
=======
		<footer>
			<div class="container">
				<div class="fleft">
					<span class="rs"> 
						<a href="https://www.facebook.com/secretariadoturismodefortaleza/" target="_blank">
							<?=FrontEnd::resource('footer_01.png')?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="https://www.instagram.com/secretariadoturismodefortaleza/" target="_blank">
							<?=FrontEnd::resource('footer_02.png')?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="#" target="_blank">
							<?=FrontEnd::resource('footer_03.png')?>
						</a> 
					</span>
				</div>
				<div class="fright">
					<span class="rs caf"> 
						<a href="#" target="_blank">
							<?=FrontEnd::resource('caf-rdp.png')?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="<?=FrontEnd::raiz()?>./">
							<?=FrontEnd::resource('footer_06.png')?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="#" target="_blank">
							<?=FrontEnd::resource('footer_07.png')?>
						</a> 
					</span>
					<span class="rs"> 
						<a href="#" target="_blank">
							<?=FrontEnd::resource('footer_08.png')?>
						</a> 
					</span>
>>>>>>> release/v1.2
				</div>
			</div>



			

		</div>



	</center>


	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
