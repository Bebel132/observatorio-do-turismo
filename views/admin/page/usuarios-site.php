<h2>
	Usuários do site
	<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAdicionar"> <i class="fas fa-plus"></i> Adicionar </button>
</h2>

<?php 
$Entity = new UsuarioSite();
require_once(__DIR__."/../crud/all.php");
?>