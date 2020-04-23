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
	$ColumnName = (isset($anon['properties'][$attr]['Column']['label']))?$anon['properties'][$attr]['Column']['label']:$anon['properties'][$attr]['Column']['name'];
	echo "<th>".$ColumnName."</th>";
}

echo "<th>Ação</th>";

echo "</tr></thead>";

echo "<tbody>";
foreach ($lista as $id => $objs) {
	echo "<tr>";
	echo "<td>{$objs->id}</td>";
	foreach ($objs as $attr => $value) {
		if(in_array($attr, $exclusao)) continue;

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

		if($domain){
			if(isset($domain[$value])) $value = $domain[$value];
		}

		echo "<td>".$value."</td>";
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