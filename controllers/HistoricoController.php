<?php 
/**
 * Controller
 */
class HistoricoController extends Controller
{
	
	public function index()
	{
		
		$return['colunas'] = [
			"timestamp" 	=> ["title" => "DATA", "input" => "datetime"]
			,"name" 		=> ["title" => "ARQUIVO", "input" => "readonly"]
			,"categoria" 	=> ["title" => "CATEGORIA", "input" => "select"]
			,"tema" 		=> ["title" => "TEMA", "input" => "select"]
			,"titulo" 		=> ["title" => "TÍTULO DO TRABALHO", "input" => "text"]
			,"local" 		=> ["title" => "LOCAL", "input" => "select"]
			,"fonte" 		=> ["title" => "FONTE", "input" => "select"]
			,"ano" 			=> ["title" => "ANO", "input" => "text"]
			,"tipodocumento"=> ["title" => "TIPO DE DOCUMENTO", "input" => "select"]
			,"autor" 		=> ["title" => "AUTOR", "input" => "text"]
			,"numero" 		=> ["title" => "NÚMERO", "input" => "text"]
			,"ambito" 		=> ["title" => "ÂMBITO", "input" => "text"]
			,"descricao" 	=> ["title" => "DESCRIÇÃO DO DOCUMENTO", "input" => "textarea"]
			,"localizacao" 	=> ["title" => "LOCALIZAÇÃO", "input" => "text"]
			// ,"id" 			=> ["title" => "ID", "input" => "hidden" ]
		];


		$return['lista'] = DaoSi::querySelect('select * from historicos order by id desc');

		foreach ($return['lista'] as $line) {

			if(!$line['pathmae'] & $line['pathmae']!==0 & $line['pathmae']!=="0"){

				$obj = new CmisObj($line['noderef']);
				// if(!$obj | !$obj->nodeRef) continue;
				
				$Historico = new Historico($line['id']);

				if(!$obj | !$obj->nodeRef){
					$Historico->pathcompleto = '';
					$Historico->pathmae = 0;
				}else{

					$path = $obj->getPath();
					$pathMae = (strtolower(substr($path, 0,10))=='/fortaleza') ? 1 : 2;

					$Historico->pathcompleto = $path;
					$Historico->pathmae = $pathMae;
				}

				// echo "[{$line['id']}]";

				DaoSi::merge($Historico);

			}

		}

		return $return;

	}

	public function total()
	{
		$total = DaoSi::querySelect('SELECT count(*) AS total FROM historicos WHERE indexado=1 AND categoria <> \'\' ')
		[0]['total'];
		return $total;
	}

	public function totalHoje()
	{
		$total =  DaoSi::querySelect('SELECT count(*) AS total FROM historicos WHERE indexado=1 AND categoria <> \'1\' AND timestamp::date >= CURRENT_DATE')
		[0]['total'];
		return $total;
	}

}