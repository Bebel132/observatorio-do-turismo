<h2>Não Indexados</h2>
<?php 

if(isset($_REQUEST['type'])){
	FrontEnd::alert('Listagem não permitida devido a grande qauntidade de documentos a ser processado. Por favor acesse uma subpasta no menu <b>Navegação</b>.');
	return;
}

$index = Controller::get()->index();

$saved = false;
if(count($_POST)>0){
	$saved = Controller::get()->updatePost();
}

$lista = Controller::get()->lista();

$linkNavegar = isset($_REQUEST['pathId'])?"navegar?objId=".$_REQUEST['pathId']:"#";




if(!FrontEnd::error($lista['error'])){ ?>

	<div class="contador">
		<div class="listados"> <span><?=count($lista['lines'])?></span> Documentos listados</div>
		<div class="rascunhados"> <span><?=$lista['totalRascunhos']?></span> Documentos rascunhados</div>
		<div class="alterados"> <span>0</span> Documentos alterados</div>
	</div>

	<form>
		<div class="form-row align-items-center">
			<div class="col-auto">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">Quantidade:</div>
					</div>
					<input type="number" class="form-control" name="maxItems" value="<?=$lista['maxItems']?>">
				</div>
			</div>
			<div class="col-auto">
				<button type="submit" class="btn btn-primary mb-2 showloading">Mostrar</button>
			</div>
		</div>

		<?php if(isset($_GET['pathId'])){ ?>
			<input type="hidden" name="pathId" value="<?=$_GET['pathId']?>">
		<?php } ?>

	</form>

	<a href="<?=$linkNavegar?>" class="btn btn-info">
		<?=$lista['pathName']?> 
	</a>

	<br>
	<br>

	<?php 


	if($saved){
		$success = $saved['success'];
		$fail = $saved['fail'];
		$tipo = $saved['tipo'];
		if( $success ){
			FrontEnd::alert("Sucesso ao {$tipo} ({$success}) documento(s)",'success');
		}
		if( $fail ){
			FrontEnd::alert("Falha ao {$tipo} ({$fail}) documento(s)",'danger');
		}
	}
	?>

	<form method="POST">
		<div class="naoindexados">
			<table class="table table-striped">
				<thead>
					<?php 
					echo "<th class='ck'>X</th>";
					echo "<th class='ver'>-</th>";
					foreach ($index['colunas'] as $k => $v) {
						if($v['input']=='hidden')
							continue;
						echo "<th class='{$k}'>{$v['title']}</th>";
					}
					?>
				</thead>
				<tbody>
					<?php 

					$extCount = array();

					foreach ($lista['lines'] as $k => $v) {

						$isRascunho = false;
						$checked = NULL;
						if(isset($lista['rascunho'][$k])){
							$isRascunho = true;
							$checked = ['checked'=>'checked'];
						}

						$ext = $v['name'];
						$ext = explode('.', $ext);
						$ext = (count($ext)>1)?strtolower($ext[count($ext)-1]):'-';

						$extCount[$ext] = (isset($extCount[$ext]))?$extCount[$ext]+1:1;

						echo "<tr>";

						echo "<td class='ck edited'>".FrontEnd::formInput('checkbox','documents['.$k.'][edited]',1,[],$checked)."</td>";

						echo "<td class='ver exts'>
						<a target='_blank' href='http://salasituacional.fortaleza.ce.gov.br:8081/acervo/documentById?id={$k}'>
						<i class='fas fa-download'></i>
						</a>
						<span class='ext ext-{$ext}'>{$ext}</span>
						</td>";

						foreach ($index['colunas'] as $kk => $vv) {
							$dominio = isset($index['domain'][$kk])?$index['domain'][$kk]:[];
							$attr = isset($vv['attr'])?$vv['attr']:array();
							$nameInput = 'documents['.$k.']['.$kk.']';
							echo "<td class='{$kk}'>";

						//rascunho
							if($isRascunho){

								$ras = $lista['rascunho'][$k];
								if($ras[$kk]!=$v[$kk]){
									echo FrontEnd::formInput($vv['input'],'documents['.$k.']['.$kk.']',$ras[$kk],$dominio,$attr);
									$attr = ['disabled'=>'disabled','readonly'=>'readonly'];
									$nameInput = 'null';
								}

							}
							echo FrontEnd::formInput($vv['input'],$nameInput,$v[$kk],$dominio,$attr);
							echo "</td>";
						}

						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>

		<div class="text-primary" style="font-size: 12px"> Process: <?=$lista['timeProcess']?> segundos </div>


		<div style="text-align: center;">
			<button class="btn btn-info btn-sm showloading" style="width: 130px" name="func" value="rascunhar"> RASCUNHAR </button>
			<button class="btn btn-success btn-sm showloading" style="width: 130px" name="func" value="indexar"> INDEXAR </button>
			<br>
		</div>

		<div class="exts">
			<h3>Totais</h3>
			<?php foreach ($extCount as $ext => $val) {
				echo "<span class='u'> <span class='ext ext-{$ext}'>{$ext}</span> {$val} </span>";
			} ?>
		</div>

	</form>
	<?php } ?>