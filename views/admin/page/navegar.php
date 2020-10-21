<?php 

$index = Controller::get()->index();

Controller::get()->act();

?>

<!-- alerts -->
<?php if(Controller::get()->alerts){ foreach (Controller::get()->alerts as $alert) { FrontEnd::alert($alert[1],$alert[0]); } } ?>

<h2>
	Navegação
	<a>
		<i class="fas fa-list" onclick="togglePathsView()"></i>
	</a>
</h2>

<h4>
	<?=$index['pathUrl']?>
	<?php if( $index['type'] == 'folder' ) { ?>
		<a class="btn btn-sm btn-info showloading text-right" href="nao-indexados?pathId=<?=$index['objId']?>"> <i class="fas fa-indent"></i> Listar todos não indexados </a>
		<a class="btn btn-sm btn-info showloading align-right" href="nao-indexados?pathId=<?=$index['objId']?>&maxItems=<?=NI_MAX_INDEXADOS?>"> <i class="fas fa-indent"></i> Listar <?=NI_MAX_INDEXADOS?> não indexados </a>
		<!-- <a class="btn btn-sm btn-info indisponivel" href="#new"> <i class="fas fa-folder-plus"></i> Nova pasta </a> -->
	<?php }else{ ?>
		<a class="btn btn-sm btn-info" target="_blank" href="http://salasituacional.fortaleza.ce.gov.br:8081/acervo/documentById?id=<?=$index['objId']?>"> <i class="fas fa-download"></i> Download </a>
		<!-- <a class="btn btn-sm btn-danger" href="?objId=<?=$index['objId']?>&act=del"> <i class="fas fa-trash-alt"></i> Excluir </a> -->
	<?php } ?>
</h4>

<div class="boxs">

	<?php

	if($index['parentId']){
		echo "<a href='?objId={$index['parentId']}'>
		<span class='u'>
		<span class='icon'> <i class='fas fa-level-up-alt'></i> </span>
		</span>
		</a>";
	}


	if($index['type'] != 'folder' && $index['CmisObjPath']){
		echo "<span class='u'>";
		echo "<span class='title'> {$index['CmisObjPath']->name} <br> <br> </span>";
		echo Utils::printTable($index['CmisObjPath']);
		echo "</span>";
	}else{

			// nova pasta
			// <a href='#'>
			// 	<span class='u indisponivel'>
			// 		<span class='icon'> <i class='fas fa-folder-plus'></i> </span>
			// 	</span>
			// </a>

		?>

		<?php 
		
		$letra = "";

		// listagem
		foreach ($index['listagem'] as $data)
		{

			$obj = $data['obj'];

			$type = $obj->type();
			$name = $obj->name;
			$objectId = $obj->objectId;

			if($type=='file'){
				$ext = explode('.', $name);
				$ext = $ext[count($ext)-1];

				$type = isset($formats[$ext])?$formats[$ext]:$type;
			}

			$letra2 = strtoupper(substr($name, 0,1));

			if($letra != $letra2){
				$letra = $letra2;
				echo "<div class='letra'>{$letra}</div>";
			}

			?>

			<span class='u'>
				<a href='?objId=<?=$objectId?>'>
					<span class='icon'> <i class='fas fa-<?=$type?>'></i> </span>
					<span class='title'> <?=$name?> </span>
				</a>
				<button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">Toggle Dropdown</span>
				</button>
				<div class="dropdown-menu dropdown-menu-right">
					<?php if( $type == 'folder' ) { ?>
						<a class="dropdown-item" href="?objId=<?=$objectId?>"> <i class="fas fa-folder-open"></i> Abrir </a>
						<a class="dropdown-item showloading" href="nao-indexados?pathId=<?=$objectId?>"> <i class="fas fa-indent"></i> Listar todos não indexados </a>
						<a class="dropdown-item showloading" href="nao-indexados?pathId=<?=$objectId?>&maxItems=<?=NI_MAX_INDEXADOS?>"> <i class="fas fa-indent"></i> Listar <?=NI_MAX_INDEXADOS?> não indexados </a>
						<!-- <a class="dropdown-item indisponivel" href="#new"> <i class="fas fa-folder-plus"></i> Nova pasta </a> -->
					<?php }else{ ?>
						<a class="dropdown-item" target="_blank" href="http://salasituacional.fortaleza.ce.gov.br:8081/acervo/documentById?id=<?=$objectId?>"> <i class="fas fa-download"></i> Download </a>
						<a class="dropdown-item" href="?objId=<?=$objectId?>"> <i class="fas fa-database"></i> Metadados </a>
						<a class="dropdown-item certeza" title="Tem certeza que deseja excluir este documento?" href="?objId=<?=$objectId?>&act=del"> <i class="fas fa-trash-alt"></i> Excluir </a>
					<?php } ?>
				</div>
			</span>

			<?php
		} 

		?>
	</div>

	<?php 
}
?>