<?php 

$index = Controller::get()->index();
$totalHoje = 0;

?>
<h2>Histórico</h2>
<div class="naoindexados">
	<table class="table table-striped">
		<thead>
			<?php 
			echo "<th class='id'>X</th>";
			echo "<th class='act'>A</th>";
			foreach ($index['colunas'] as $k => $v) {
				if($v['input']=='hidden')
					continue;
				echo "<th class='{$k}'>{$v['title']}</th>";
			}
			?>
		</thead>
		<tbody>
			<?php 
			foreach ($index['lista'] as $k => $v) {
				echo "<tr>";

				// Flag 
				echo "<td class='id'>{$v['id']}";
				if($v['indexado']==0) echo "<i title='Rascunho' class='r fas fa-highlighter'></i>";
				if($v['indexado']==1) echo "<i title='Indexado' class='i fas fa-check-circle'></i>";
				if($v['indexado']==2) echo "<i title='Excluído' class='e fas fa-ban'></i>";
				echo "</td>";

				// Actions
				echo "<td class='act'>";
				if($v['indexado']!=2){ 
					echo "<a href='nao-indexados?objId={$v['noderef']}' title='Editar'> <i class='fas fa-edit'></i> </a>
					<a target='_blank' href='http://salasituacional.fortaleza.ce.gov.br:8081/acervo/documentById?id={$v['noderef']}' title='Baixar'> <i class='fas fa-download'></i> </a>";
				}
				echo "</td>";

				foreach ($index['colunas'] as $kk => $vv) {

					$val = $v[$kk];

					if($vv['input']=='hidden')
						continue;

					if($vv['input']=='datetime'){

						$dia = date('Y-m-d',strtotime($val));

						if($dia==date('Y-m-d')){
							$dia = '<span class="hoje">Hoje</span>';
							$totalHoje++;
						}elseif($dia==date('Y-m-d',strtotime(date('Y-m-d').' - 1 day'))){
							$dia = 'Ontem';
						}else{
							$dia = date('d/m/Y',strtotime($val));
						}

						$val = $dia.' às '.date('H\hi',strtotime($val));
						$val .= "<span class='user'><i class='fas fa-user'></i> {$v['username']}</span>";
					}

					echo "<td class='{$kk}'>".$val."</td>";
				}

				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>

<?php FrontEnd::alert("Total de hoje: $totalHoje",'info',false) ?>