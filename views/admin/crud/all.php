<?php 

$EntityClass = get_class($Entity);

$Controller = new CrudController();
$Controller->request($Entity,'Banner_adicionar');

if(isset($vars[3]) && is_numeric($vars[3])){
	if($vars[2] == "del") $Controller->deleteByObj( new $EntityClass($vars[3]) );
	if($vars[2] == "edit") $Controller->request($Entity,'Banner_editar');
}

// alerts
if($Controller->alerts){ foreach ($Controller->alerts as $alert) { FrontEnd::alert($alert[1],$alert[0]); } }

$raiz = FrontEnd::raiz();
$href = "{$raiz}{$vars[0]}/{$vars[1]}";

require_once("lista.php");
require_once("adicionar.php");
require_once("editar.php");

