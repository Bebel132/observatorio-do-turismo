<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title><?=FrontEnd::navAdmin(true)['name']?> | Observatório do Turismo</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="icon" href="<?=FrontEnd::raiz()?>resource/imgs/favicon.png" />

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<!-- Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<?php
	echo FrontEnd::resource('jquery-3.3.1.min.js');
	echo FrontEnd::resource('cookie.js');
	echo FrontEnd::resource('style-admin.css');
	?>

	<script> jq = jQuery.noConflict( true ); </script>
	<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script> -->
	<!-- <script> jq(document).ready(function(){jq('input[type=datetime-local]').datepicker({format: "yy-mm-dd"}); }) </script>
	<script> jq(document).ready(function(){jq('input[type=datetime]').datepicker({format: "yyyy-mm-dd"}); }) </script> -->
	<?= FrontEnd::resource('admin.js'); ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

	<!-- Google tag GA4 (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-3MB1CV4504"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-3MB1CV4504');
	</script>
	
</head>
<body onload="appLoaded()">

	<?php 
	
	if(User::isLoged()){ ?>

		<div class="container-fluid">
			<div class="row">
				<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
					<div class="logo">
						<?= FrontEnd::resource('logo.svg'); ?>
					</div>
					<ul class="nav nav-pills flex-column">
						<?php FrontEnd::navAdmin(); ?>
					</ul>
					<div class="powered w-100">
						<!-- Powered IPLANFOR - Instituto de Planejamento de Fortaleza -->
					</div>
				</nav>
				<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
					<section>
						<?php FrontEnd::page('admin'); ?>
					</section>
					<div class="logo-iplanfor">
					</div>
				</main>
			</div>
		</div>

		<?php 

	}else{
		FrontEnd::login(); 
	}

	?>

	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>