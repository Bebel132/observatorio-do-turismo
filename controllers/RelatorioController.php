<?php 
/**
 * Controller
 */
class RelatorioController extends Controller
{
	
	public function index()
	{

		// delSession('ni_f2040_total');
		// delSession('ni_memoria');
		
		$return = [];

		// histórico
		$historico = DaoSi::querySelect('SELECT noderef, timestamp, indexado, pathmae FROM historicos ORDER BY timestamp ASC');

		$data = [];
		$nodes = [];
		$nodes[0] = [];
		$nodes[1] = [];
		$nodes[2] = [];
		$nodes[3] = [];
		foreach ($historico as $his) {
			$timestamp = $his['timestamp'];
			$indexado = $his['indexado'];
			$noderef = $his['noderef'];
			$pathmae = $his['pathmae'];

			if($indexado==1 && $pathmae==2) $indexado = 3;

			if(in_array($noderef, $nodes[$indexado]))
				continue;
			$nodes[$indexado][] = $noderef;

			$mesano = date('Y-m', strtotime($timestamp) );

			if(!isset($data[$mesano])){
				$data[$mesano][0] = 0;
				$data[$mesano][1] = 0;
				$data[$mesano][2] = 0;
				$data[$mesano][3] = 0;
			}

			$data[$mesano][$indexado] += 1;

		}

		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		$labels = [];
		foreach ($data as $d => $val) {
			$labels[] = ucfirst( utf8_encode( strftime("%B de %Y", strtotime($d) ) ) );
			$trascunhados[] = $val[0];
			$tindexados[] = $val[1];
			$texcluidos[] = $val[2];
			$tmemoria[] = $val[3];
		}

		$return['labels'] = $labels;
		$return['tindexados'] = $tindexados;
		$return['trascunhados'] = $trascunhados;
		$return['texcluidos'] = $texcluidos;
		$return['tmemoria'] = $tmemoria;
		// $return['data'] = $data;


		$totalNaoIndexados_acervo = NaoIndexadosController::totalNaoIndexadosAcervo();

		// por categoria
		DaoSi::setDb('acervo');
		$categorias = DaoSi::querySelect('SELECT count(*) as total, categoria as nome FROM documentosAlfresco GROUP BY categoria');
		DaoSi::setDb('default');

		$totalIndexadosHoje = HistoricoController::totalHoje();

		$categorias[0]['nome'] = 'NÃO INDEXADOS';
		$categorias[0]['total'] = $totalNaoIndexados_acervo;

		$totalIndexados = $totalIndexadosHoje;
		foreach ($categorias as $cat) {
			$return['categorias'][$cat['nome']] = $cat['total'];

			$totalIndexados += ($cat['nome']!='NÃO INDEXADOS')?$cat['total']:0;
		}

		$return['totalindexados'] = $totalIndexados;




		$return['totalMemoriaInstitucional'] = NaoIndexadosController::totalNaoIndexadosMemoria();

		// $return['totalIndexadosMemoriaInstitucional'] = DaoSi::querySelect('SELECT count(id) as total FROM historicos WHERE indexado=1 AND pathmae=2')[0]['total'];


		return $return;
	}

}