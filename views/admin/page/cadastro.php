<?php 

$pageCadastro = Controller::get()->index();

?>
<h2>
	Cadastro
	<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAdicionar" style="float: right;"> <i class="fas fa-plus"></i> Adicionar </button>
</h2>

<h4><?=$pageCadastro['titulo']?></h4>


<?php 
$Entity = new $pageCadastro['class']();
require_once(__DIR__."/../crud/all.php");
?>