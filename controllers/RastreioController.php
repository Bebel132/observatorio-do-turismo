<?php 
/**
 * Controller
 */
class RastreioController extends Controller
{
	
	public function index()
	{
		
		$return = [];
		$return['lista'] = DaoSi::querySelect('SELECT * FROM rastreio ORDER BY id desc');
		$return['maxListView'] = R_MAX_LISTA;

		return $return;
	}

}