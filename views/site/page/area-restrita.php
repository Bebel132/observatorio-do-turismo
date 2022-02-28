<?php 

if(isset($vars[1]) && $vars[1]=='sair'){
	delSession('UsuarioSiteLogado');
}

$UsuarioSiteLogado = getSession('UsuarioSiteLogado');


if($UsuarioSiteLogado){
	$anon = $UsuarioSiteLogado->getAnnotation();
	$domainTipoUsuarioSite = isset($anon['properties']['perfil']['Column']['domain'])?$anon['properties']['perfil']['Column']['domain']:null;
	$perfil = isset($domainTipoUsuarioSite[$UsuarioSiteLogado->perfil]) ? $domainTipoUsuarioSite[$UsuarioSiteLogado->perfil] : '';
	// dd($domainTipoUsuarioSite);
	require_once('area-restrita/pesquisas.php');
}
elseif(isset($vars[1]) && is_file(__DIR__.'/area-restrita/'.$vars[1].'.php')){
	require_once('area-restrita/'.$vars[1].'.php');
}else{
	require_once('area-restrita/login.php');
}