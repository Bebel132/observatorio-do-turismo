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
						<a href="<?=FrontEnd::raiz()?>./#home" class="rollto active">Home</a>
						<a href="<?=FrontEnd::raiz()?>./area-restrita" class="rollto">Formulários de Pesquisas</a>
						<a href="<?=FrontEnd::raiz()?>./#pesquisas" class="rollto">Pesquisas</a>
						<a href="<?=FrontEnd::raiz()?>./#aplicativos" class="rollto">Aplicativos e Sites</a>
					</nav>
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
				</div>
			</div>
		</footer>

	</center>

<?php 
DatabaseSi::create();
?>

	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
