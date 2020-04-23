<?php 

$vars = Utils::getUrlVars();
$raiz = FrontEnd::raiz();

if(isset($vars[0]) && $vars[0]=='admin')
	require_once('admin/template.php');
else
	require_once('site/template.php');