<?php 

$index = Controller::get()->index();

// dd($index);

?>
<h1>Relatório</h1>

<div class="row">
	
	<!-- Histórico -->
	<div class="col-md-6">
		<h3>Histórico</h3>
		<canvas id="grafHistorico"></canvas>
	</div>
	<script>
		setTimeout(function(){
			var ctx = document.getElementById('grafHistorico').getContext('2d');
			var chart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: <?=Utils::json_encode($index['labels'])?>,
					datasets: [{
						fill:false,
						label: "Indexados Acervo F2040",
						borderColor: 'rgb(100, 200, 100)',
						data: <?=Utils::json_encode($index['tindexados'])?>,
					},{
						fill:false,
						label: "Indexados Memória Institucional",
						borderColor: '#4cb9e1',
						data: <?=Utils::json_encode($index['tmemoria'])?>,
					},{
						fill:false,
						label: "Rascunhados",
						borderColor: 'rgb(200, 200, 100)',
						data: <?=Utils::json_encode($index['trascunhados'])?>,
					},{
						fill:false,
						label: "Excluídos",
						borderColor: 'rgb(255, 0, 0)',
						data: <?=Utils::json_encode($index['texcluidos'])?>,
					}
					],
				},
				options: {
					responsive: true,
					tooltips: {
						mode: 'index',
						intersect: false,
					},
					hover: {
						mode: 'nearest',
						intersect: true
					},
				}
			});
		},200);
	</script>

	<!-- Categorias -->
	<div class="col-md-6">
		<h3>Categorias</h3>
		<canvas id="myChart"></canvas>
	</div>
	<script>
		setTimeout(function(){
			var ctx2 = document.getElementById('myChart').getContext('2d');
			var chart2 = new Chart(ctx2, {
				type: 'pie',
				data: {
					labels: <?=Utils::json_encode(array_keys($index['categorias']))?>,
					datasets: [{
						label: "Categorias",
						backgroundColor: ['#000','#f67019','#acc236','#f53794','#537bc4','#166a8f','#00a950','#4cb9e1','#8549ba'],
						data: <?=Utils::json_encode(array_values($index['categorias']))?>,
					}
					],
				},
				options: {
					responsive: true
				}
			});
		},400);
	</script>
</div>


<br>


<!-- Totais por categorias -->
<div class="col-md-12">
	<h3>Acervo Fortaleza 2040</h3>
	<div class="line">
		<?php foreach ($index['categorias'] as $nome => $total) { ?>
			<div class="block">
				<div class="title"><?=$nome?></div>
				<div class="number"><?=$total?></div>
			</div>
		<?php } ?>

		<div class="block">
			<div class="title">TOTAL INDEXADOS</div>
			<div class="number"><?=$index['totalindexados']?></div>
		</div>

	</div>
	<br>
	<h3>Memória Institucional</h3>
	<div class="line">
		<div class="block">
			<div class="title">TOTAL NÃO INDEXADOS</div>
			<div class="number"><?=$index['totalMemoriaInstitucional'][0]?></div>
		</div>
		<div class="block">
			<div class="title">TOTAL INDEXADOS</div>
			<div class="number"><?=$index['totalMemoriaInstitucional'][1]?></div>
		</div>
	</div>

</div>


<?php // echo Utils::printTable($index); ?>