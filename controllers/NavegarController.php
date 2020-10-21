<?php 
/**
 * Controller
 */
class NavegarController extends Controller
{

	var $alerts = [];
	
	public function index()
	{

		$return['error'] = [];
		
		$objId = (isset($_GET['objId']))?$_GET['objId']:NAVIGATE_INITIAL_ID;

		$CmisObjPath = false;
		$listagem = array();
		$listagem2 = array();
		$parentId = false;
		$type = false;
		$pathUrl = false;

		try {

			$CmisObjPath = new CmisObj($objId);

			$pathUrl = $CmisObjPath->path;
			$pathUrl = str_replace('/Sites/iplanfor/documentLibrary/IPLANFOR', '', $pathUrl);

			$type = $CmisObjPath->type();

			// subir um nível
			if( !strstr($objId, NAVIGATE_INITIAL_ID) ){
				$parentId = ($CmisObjPath->parentId)?$CmisObjPath->parentId:$_SESSION['ultnoderef'];
				$_SESSION['ultnoderef'] = $objId;
			} 


			$listagem = $CmisObjPath->getList();
			if($listagem){
				foreach ($listagem as $obj) {

					$item['type'] = ($obj->type()=='folder')?'a':'b';
					$item['name'] = strtoupper($obj->name);
					$item['obj'] = $obj;

					$listagemOrdernada[] = $item;

				}

				$listagem2 = Utils::multiSort($listagemOrdernada,'type','name');
			}

		} catch (Error $e){
			$this->alert("Falha no carregamento. ".$e->getmessage(),'danger');
		}

		$return['objId'] = $objId;
		$return['parentId'] = $parentId;
		$return['listagem'] = $listagem2;
		$return['type'] =  $type;
		$return['pathUrl'] =  $pathUrl;
		$return['CmisObjPath'] =  $CmisObjPath;


		return $return;

	}


	public function formats()
	{
		return [

			'pdf' => 'file-pdf'

			,'tif' => 'image'
			,'jpg' => 'image'
			,'png' => 'image'

			,'zip' => 'file-archive'
			,'rar' => 'file-archive'
			,'7z' => 'file-archive'

		];
	}


	public function act()
	{
		if(isset($_GET['act'])){

			// delete
			if($_GET['act']=='del'){
				$this->deleteObj();
			}

		}
	}

	private function deleteObj()
	{

		$objId = (isset($_GET['objId']))?$_GET['objId']:false;
		$CmisObj = new CmisObj($objId);

		if($objId && $CmisObj->type()=='file'){

			$filename = $CmisObj->name;

			$ok = Cmis::deleteObject($objId);

			if($ok){
				$this->alert("Arquivo <b>{$filename}</b> excluído com sucesso!","success");

				$Historico = new Historico();
				foreach ($CmisObj as $key => $value) {
					if(property_exists($Historico,$key))
						$Historico->$key = $value;
				}
				$Historico->noderef = $objId;
				$Historico->indexado = 2; // deleted
				$Historico->username = User::getUsername();
				DaoSi::persist($Historico,['forcenull'=>true]);

			}else{
				$this->alert("Arquivo <b>{$filename}</b> impossível de excluir!","danger");
			}

			Utils::back(2);

		}else{
			$this->alert("Arquivo à excluir inválido",'danger');
		}

	}

	private function alert($mensagem,$type='info')
	{
		$this->alerts[] = [$type,$mensagem];
	}

}