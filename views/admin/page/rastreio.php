<?php 

$index = Controller::get()->index();

$totais = array();
$ultimoDia='';
$boldDia=false;
$totalHoje=0;
$totalOntem=0;
$c=0;
$t=0;
$total = count($index['lista']);

?>
<div class="rastreio">
	<div class="lista">
		<table class="table table-striped table-sm">
			<thead>
				<th>Date</th>
				<th>User</th>
				<th>Page</th>
				<th><i class="fas fa-eye"></i></th>
			</thead>
			<tbody>
				<?php 
				foreach ($index['lista'] as $line) {

					$c++;
					$t++;

					if($t > $index['maxListView']){ break; }

					if ($c > $total/4 || $c > $index['maxListView']/4) {
						$c=0;
						echo "</tbody>
						</table>
						<table class='table table-striped table-sm'>
						<thead>
						<th>Date</th>
						<th>User</th>
						<th>Page</th>
						<th><i class='fas fa-eye'></i></th>
						</thead>
						<tbody>";
					}


					$timestamp = $line['timestamp'];
					$username = $line['username'];
					$page = $line['page'];
					$request = $line['request'];

					$dia = date('Y-m-d',strtotime($timestamp));

					if($ultimoDia != $dia){
						$ultimoDia = $dia;
						$boldDia=true;
					}

					if($dia==date('Y-m-d')){
						$dia = '<span class="hoje">Hoje</span>';
						$totalHoje++;
					}elseif($dia==date('Y-m-d',strtotime(date('Y-m-d').' - 1 day'))){
						$dia = '<span class="ontem">Ontem</span>';
						$totalOntem++;
					}else{
						$dia = date('d/m/Y',strtotime($timestamp));
					}

					if($boldDia){
						$boldDia=false;
						$dia = "<b>{$dia}</b>";
					}

					$timestamp = $dia.' às '.date('H\hi',strtotime($timestamp));

					$pages = Utils::json_decode($page);
					$pageStr = '';
					foreach ($pages as $pageName) {
						$pageStr .= '<span class="'.$pageName.'">'.$pageName.'</span>';
					}

					$username = ($username)?$username:'anonimo';
					$usernameStr = "<span class='".str_replace('.', '', $username)."'>{$username}</span>";

					$requests = Utils::json_decode($request);
					$requestStr = Utils::printTable($requests);

					if(trim($username))
						$totais['username'][$usernameStr] = (isset($totais['username'][$usernameStr]))?$totais['username'][$usernameStr]+1:1;
					if(trim($pageStr))
						$totais['page'][$pageStr] = (isset($totais['page'][$pageStr]))?$totais['page'][$pageStr]+1:1;

					?>
					<tr>
						<td class="timestamp"><?=$timestamp?></td>
						<td class="username"><?=$usernameStr?></td>
						<td class="page"><?=$pageStr?></td>
						<td class="request">

							<?php if(count($requests)>0){ ?>
								<a href="#" data-toggle="modal" data-target=".modal-lg<?=$line['id']?>">
									<i class="fas fa-eye"></i>
								</a>
								<div class="modal fade modal-lg<?=$line['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle"><?=$username?> - <?=$timestamp?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?=$requestStr?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>

						</td>
					</tr>
				<?php }

				$totais['timestamp']['<span class="hoje">hoje</span>'] = $totalHoje;
				$totais['timestamp']['<span class="ontem">ontem</span>'] = $totalOntem;
				$totais['total']['<span class="registros">registros</span>'] = $total;

				?>
			</tbody>
		</table>
	</div>

	<div class="totais">
		<?php 
		foreach ($totais as $k => $v) {
			echo "<div class='{$k}'> {$k}: ";
			foreach ($v as $kk => $vv) {
				echo " {$kk} {$vv}";
			}
			echo "</div>";
		}
		?>
	</div>
</div>