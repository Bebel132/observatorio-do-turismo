<?php 

$pageCadastro = Controller::get()->index();
$lista = Controller::get()->lista();

?>
<h2>
	Cadastro
	<a href="?new" class="btn btn-success" style="float: right;">
		<i class="fas fa-plus"></i> NOVO
	</a>
</h2>

<h4><?=$pageCadastro['titulo']?></h4>

<div class="cadastro">
	<div class="lista">
		<?php 
		foreach ($lista as $k => $v) {
			$id = reset($v);
			echo "<li class='list-group-item list-group-item-action'>
			<a href='?edit={$id}' class='btn-sm'><i class='fas fa-edit text-info'></i>
			{$v['nome']}
			</a>
			</li>";
		}
		?>
	</div>
</div>