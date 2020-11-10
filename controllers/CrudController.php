<?php 
/**
 * Controller
 */
class CrudController extends Controller
{

	public $alerts = [];

	public function request($Entity,$nametoken=null)
	{
		$anon = $Entity->getAnnotation();
		$tb = DaoSI::getTableObj($Entity)['name'];
		if(!$nametoken) $nametoken = get_class($Entity);

		if(!$this->csrfToken($nametoken)){
			return;
		}

		if(count($_POST)>0){

			foreach ($Entity as $key => $value) {
				$mask = (isset($anon['properties'][$key]['Column']['mask'])) ? ($anon['properties'][$key]['Column']['mask']) : 'text';
				if(isset($_POST[$key])){
					if($mask=='password'){
						if(trim($_POST[$key])!="") $Entity->$key = PasswordCompat::password_hash($_POST[$key]);
						else unset($Entity->$key);
					}else{
						$Entity->$key = trim($_POST[$key]);
					}
				}
				if(isset($_FILES[$key]) && $_FILES[$key]['size']>0){
					$filename = $this->fileUpload($tb,$_FILES[$key]);
					if($filename) $Entity->$key = $filename;
					else unset($Entity->$key);
				}
				if($mask=='file' && empty($Entity->$key)){
					unset($Entity->$key);
				}
			}

			$type = ($Entity->id)?'alterar':'adicionar';
			$ok = DaoSi::merge($Entity);

			if($ok)
				$this->alerts[] = ["success","Sucesso ao {$type} registro."];
			else
				$this->alerts[] = ["danger","Falha ao {$type} registro."];

		}
		
	}

	public function csrfToken($nametoken)
	{
		$csrf_token = getSession('csrf_token_'.$nametoken);
		delSession('csrf_token_'.$nametoken);

		if(isset($_POST['csrf_token'])){
			if($_POST['csrf_token'] == $csrf_token)
				return true;
			header_status(500,'Invalid token');
		}
		return false;
	}

	public function deleteByObj($obj)
	{
		$del = DaoSI::exclude($obj);
		if($del)
			$this->alerts[] = ["success","Sucesso ao deletar registro."];
		else
			$this->alerts[] = ["danger","Falha ao deletar registro."];
	}

	public function getLista($Entity)
	{
		$result = [];
		$EntityClass = get_class($Entity);
		$tb = DaoSI::getTableObj($Entity);

		$offset = 0;
		$limitt = 100;


		if(isset($_GET['page']) && is_numeric($_GET['page'])){
			$offset = ($_GET['page'] - 1) * $limitt;
		}

		$limit = "LIMIT {$limitt} OFFSET {$offset}";

		DaoSI::setDatabase($Entity);
		$idField = DaoSI::getIdField($Entity);
		$ids = DaoSI::querySelect("SELECT {$idField} FROM {$tb['name']} ORDER BY {$idField} DESC {$limit}");
		foreach ($ids as $id) {
			$result[$id[$idField]] = new $EntityClass($id[$idField]); 
		}

		$total = DaoSI::querySelect("SELECT count({$idField}) as total FROM {$tb['name']}")[0]['total'];
		return ['results'=>$result,'total'=>$total];

	}


	public function fileUpload($dir,$file)
	{
		ini_set('upload_max_filesize', '100M');
		ini_set('post_max_size', '100M');
		ini_set('max_input_time', 300);
		ini_set('max_execution_time', 300);

		$dir = 'resource/uploads/'.$dir;
		$dir = substr($dir,-1,1)=='/'?$dir:$dir.'/';
		$SEP = '/';
		$temp='';
		$dirQue = explode($SEP, $dir);
		for ($a=0; $a < count($dirQue); $a++) { 
			if($dirQue[$a]!=''){
				$temp .= $dirQue[$a].$SEP;
				if(!is_dir($temp))
					mkdir($temp,0777);
			}
		}
		$dir = $temp;

		$parts = explode('.', $file['name']);
		$ext = $parts[count($parts)-1];
		$filename = str_replace($ext, '', $file['name']);

		$filename = time().'-'.$this->slugify($filename).".{$ext}";

		$destino = $dir.$filename;

		$destino1 = str_replace('/', DIRECTORY_SEPARATOR, getcwd().'/'.$destino);
		$destino2 = str_replace('/', DIRECTORY_SEPARATOR, __DIR__.'/'.$destino);

		if(@move_uploaded_file($file['tmp_name'], $destino1)){
			return $filename;
		}elseif(@move_uploaded_file($file['tmp_name'], $destino2)){
			return $filename;

		}elseif(@move_uploaded_file($file['tmp_name'], $destino)){
			return $filename;

		}elseif(@move_uploaded_file($file['tmp_name'], '../'.$destino)){
			return $filename;

		}elseif(@move_uploaded_file($file['tmp_name'], '../../'.$destino)){
			return $filename;

		}else{
			$this->alerts[] = ['danger','Falha ao enviar arquivo. ('.$file['error'].') Destiny: '.$destino.' Destiny: '.$destino1];
			return null;
		}


	}


	public function slugify($text)
	{
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);
		if (empty($text)) {
			return '';
		}
		return $text;
	}

}