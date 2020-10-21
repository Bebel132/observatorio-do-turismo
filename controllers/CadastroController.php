<?php 
/**
 * Controller
 */
class CadastroController extends Controller
{
	
	public function index()
	{
		

		$tabelasDominio = 
		[
			 'categorias' 		=> ['titulo' => 'Categorias' 		, 'class' => 'CadastroCategoria']
			,'fontes' 			=> ['titulo' => 'Fontes' 			, 'class' => 'CadastroFonte']
			,'locais' 			=> ['titulo' => 'Locais' 			, 'class' => 'CadastroLocal']
			,'temas' 			=> ['titulo' => 'Temas' 			, 'class' => 'CadastroTema']
			,'tipo-documentos' 	=> ['titulo' => 'Tipos Documentos' 	, 'class' => 'CadastroTipoDocumento']
		];

		$tabelasDominio404 = ['titulo' => '404', 'tb' => false];

		$vars = Utils::getUrlVars();
		$page = (count($vars)>0)?$vars[ 1 ]:PAGE_INITIAL;


		return isset($tabelasDominio[$page])?$tabelasDominio[$page]:$tabelasDominio404;

	}


}