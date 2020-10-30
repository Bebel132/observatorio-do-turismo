<?php 

if(
	count($_POST) 
	&& isset($_POST['email'])
	&& isset($_POST['senha'])
){
	$login = User::singonParceiro($_POST['email'],$_POST['senha'],$_POST['_token']);
	if(!$login){
		foreach (User::$error as $erro) {
			FrontEnd::alert($erro,'danger');
		}
	}
}elseif(isset($vars[1]) && $vars[1]=='sair'){
	delSession('ParceiroLogado');
}

$ParceiroLogado = getSession('ParceiroLogado');

if($ParceiroLogado)
	require_once('area-restrita/pesquisas.php');
else
	require_once('area-restrita/login.php');
