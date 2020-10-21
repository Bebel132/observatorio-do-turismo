<?php 

$lista = $Controller->getLista($Entity);

$exclusao = ['id','timestamp'];

$anon = $Entity->getAnnotation();

$tb = DaoSI::getTableObj($Entity)['name'];

echo "<div style='overflow-x:auto'>";

echo '<table class="table table-striped">';

echo "<thead><tr>";
echo "<th>ID</th>";
foreach ($Entity as $attr => $value) {
	if(in_array($attr, $exclusao)) continue;
	if(isset($anon['properties'][$attr]['Column']['mask']) && $anon['properties'][$attr]['Column']['mask']=='password') continue;

	$listaConfig = isset($anon['properties'][$attr]['Column']['lista'])?$anon['properties'][$attr]['Column']['lista']:null;
	if($listaConfig){ if($listaConfig['display']=='none') continue; }

	$ColumnName = (isset($anon['properties'][$attr]['Column']['label']))?$anon['properties'][$attr]['Column']['label']:$anon['properties'][$attr]['Column']['name'];
	echo "<th>".$ColumnName."</th>";
}

echo "<th>Ação</th>";

echo "</tr></thead>";

echo "<tbody>";
foreach ($lista['results'] as $id => $objs) {
	echo "<tr>";
	echo "<td>{$objs->id}</td>";
	foreach ($objs as $attr => $value) {
		if(in_array($attr, $exclusao)) continue;

		$addclass = '';

		$listaConfig = isset($anon['properties'][$attr]['Column']['lista'])?$anon['properties'][$attr]['Column']['lista']:null;
		if($listaConfig){ if($listaConfig['display']=='none') continue; }

		$mask = isset($anon['properties'][$attr]['Column']['mask'])?$anon['properties'][$attr]['Column']['mask']:null;
		$domain = isset($anon['properties'][$attr]['Column']['domain'])?$anon['properties'][$attr]['Column']['domain']:null;

		if($mask=='password') continue;

		if($mask=='file'){
			$parts = explode('.', $value);
			$ext = strtolower($parts[count($parts)-1]);
			if(in_array($ext, ['jpg','jpeg','gif','png'])){
				$value = FrontEnd::resource("../uploads/{$tb}/".$value);
			}
		}

		if($mask=='url'){
			$parts = explode('.', $value);
			$ext = strtolower($parts[count($parts)-1]);
			if(in_array($ext, ['jpg','jpeg','gif','png'])){
				$value = "<img src='{$value}'>";
			}elseif($value){
				$value = "<a href='{$value}' target='_blank' title='{$value}' class='ellipsis'>{$value}</a>";
				$addclass = 'ellipsis';
			}
		}

		if(in_array($mask, ['datetime','date'])){
			$parts = explode(' ', $value);
			if(count($parts)>1){ $format="d/m/Y"; }else{ $format="d/m/Y \à\s H:i"; }
			$value = date($format,strtotime($value));
		}

		if($domain){
			if(isset($domain[$value])) $value = $domain[$value];
		}

		echo "<td><span class='value {$addclass}'>".$value."</span></td>";
	}

	echo "<td>
	<a href='{$href}/edit/{$objs->id}'><i class='fas fa-edit'></i></a>
	<a href='{$href}/del/{$objs->id}' onclick='return confirm(\"Esta ação não poderá ser desfeita\")'><i class='fas fa-trash-alt'></i></a>
	</td>";

	echo "</tr>";
}
echo "</tbody>";

echo "</table>";
echo "</div>";


$page = isset($_GET['page']) ? $_GET['page'] : 1;
echo '<div class="paginacao">';
echo "PAGINAÇÃO <br>";
$tPage = ceil($lista['total'] / 100);
echo "<a href='?page=1' ".(($page==1)?"class='active'":"").">1</a>";
$ini = $page - 5;
if($ini < 2) $ini = 2;
for ($i=$ini; $i < $tPage; $i++) { 
	echo "<a href='?page={$i}' ".(($page==$i)?"class='active'":"")." >{$i}</a>";
}
if($tPage>1) echo "<a href='?page={$tPage}'>{$tPage}</a>";
echo '</div>';