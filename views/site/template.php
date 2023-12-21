
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Observatório do Turismo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="icon" href="<?=FrontEnd::resource('logo2.svg',1)?>" />
	<?= FrontEnd::resource('jquery-3.3.1.min.js'); ?>
	<script> jq = jQuery.noConflict( true ); </script>

	<!-- Google tag GA4 (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-3MB1CV4504"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-3MB1CV4504');
	</script>
	<script src="https://kit.fontawesome.com/4b1186e948.js" crossorigin="anonymous"></script>

	<?php
	// echo FrontEnd::resource('cookie.js');
	echo FrontEnd::resource('main.js');
	// echo FrontEnd::resource('reset.css');
	echo FrontEnd::resource('style-site.css');
	?>
</head>
<body>
	<a href="<?=FrontEnd::raiz()?>.#inicio"><i class="fa-solid fa-angle-up"></i></a>
    <header id="inicio">
        <div class="header-topbar-container">
            <div class="header-topBar">
				<?=FrontEnd::resource('logo2.svg')?>
                <!-- MENU DESKTOP -->
                <div class="menu-container">
                    <ul class="menu">
                        <a href="<?=FrontEnd::raiz()?>.#quemSomos">
                            <li class="menu-item">Quem Somos</li>
                        </a>
						<a href="<?=FrontEnd::raiz()?>.#dti">
                            <li class="menu-item">DTI</li>
                        </a>
                        <a href="<?=FrontEnd::raiz()?>.#inteligenciaTuristica">
                            <li class="menu-item">Inteligência Turística</li>
                        </a>
                        <a href="<?=FrontEnd::raiz()?>.#pesquisas">
                            <li class="menu-item">Pesquisas</li>
                        </a>
                        <a href="<?=FrontEnd::raiz()?>.#geoinformacao">
                            <li class="menu-item">Geoinformação</li>
                        </a>
                        <a href="<?=FrontEnd::raiz()?>.#parceiros">
                            <li class="menu-item">Parceiros</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-sideBar-container">
            <i class="fa-solid fa-bars"></i>
            <div class="header-sideBar closed">
                <!-- MENU MOBILE -->
                <div class="menu-container">
                    <ul class="menu">
                        <a href="<?=FrontEnd::raiz()?>.#quemSomos">
                            <li class="sidebar_menu-item">Quem Somos</li>
                        </a>
						<a href="<?=FrontEnd::raiz()?>.#dti">
                            <li class="sidebar_menu-item">DTI</li>
                        </a>
                        <a href="<?=FrontEnd::raiz()?>.#inteligenciaTuristica">
                            <li class="sidebar_menu-item">Inteligência Turística</li>
                        </a>
                        <a href="<?=FrontEnd::raiz()?>.#pesquisas">
                            <li class="sidebar_menu-item">Pesquisas</li>
                        </a>
                        <a href="<?=FrontEnd::raiz()?>.#geoinformacao">
                            <li class="sidebar_menu-item">Geoinformação</li>
                        </a>
                        <a href="<?=FrontEnd::raiz()?>.#parceiros">
                            <li class="sidebar_menu-item">Parceiros</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </header>
        <!-- 

            O arquivo template.php é como se fosse um arquivo "fixo",
            ele vai servir como um "base" onde as coisas serão atualizadas e carregadas
            
            abaixo será carregado o arquivo da página usando um método da classe FrontEnd

         -->
		<main class="page">
			<?php FrontEnd::page(); ?>
		</main>
	<?=FrontEnd::resource('script.js')?>
	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
