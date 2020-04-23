<?php 

if(!isset($vars[3])) return;

$EntityClass = get_class($Entity);
$EntityEdit = new $EntityClass($vars[3]);

if(!$EntityEdit->id) return;

?><!-- Modal Editar -->
<div class="modal fade show" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Editar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php  if($Controller->alerts){ foreach ($Controller->alerts as $alert) { FrontEnd::alert($alert[1],$alert[0]); } } ?>
			<form method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<?php 
					echo FrontEnd::form($EntityEdit,'Banner_editar');
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script> jq(document).ready(function(){ $('#modalEditar').modal('show'); });</script>