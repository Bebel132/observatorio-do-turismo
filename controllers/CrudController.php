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

		$csrf_token = getSession('csrf_token_'.$nametoken);
		if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $csrf_token) return;

		if(count($_POST)>0){

			foreach ($Entity as $key => $value) {
				if(isset($_POST[$key])){
					if(isset($anon['properties'][$key]['Column']['mask']) && $anon['properties'][$key]['Column']['mask']=='password'){
						if(trim($_POST[$key])!="") $Entity->$key = PasswordCompat::password_hash($_POST[$key]);
						else unset($Entity->$key);
					}else{
						$Entity->$key = $_POST[$key];
					}
				}
				if(isset($_FILES[$key]) && $_FILES[$key]['size']>0) $Entity->$key = $this->fileUpload($tb,$_FILES[$key]);
			}


			$type = ($Entity->id)?'alterar':'adicionar';
			$ok = DaoSi::merge($Entity);

			if($ok)
				$this->alerts[] = ["success","Sucesso ao {$type} registro."];
			else
				$this->alerts[] = ["danger","Falha ao {$type} registro."];

		}
		
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
		$ids = DaoSI::querySelect("SELECT id FROM {$tb['name']} ORDER BY id DESC");
		foreach ($ids as $id) {
			$result[$id['id']] = new $EntityClass($id['id']); 
		}
		return $result;
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

		$destino = str_replace('/', DIRECTORY_SEPARATOR, getcwd().'/'.$destino);

		if(@move_uploaded_file($file['tmp_name'], $destino)){
			return $filename;
		}else{
			$this->alerts[] = ['danger','Falha ao enviar arquivo. ('.$file['error'].')'.$destino];
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