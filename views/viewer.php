<?php 

$vars = Utils::getUrlVars();

if(isset($vars[0]) && $vars[0]=='admin')
	require_once('admin/template.php');
else
	require_once('site/template.php');