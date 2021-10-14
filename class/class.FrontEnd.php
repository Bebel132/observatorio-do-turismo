<?php 
/**
 * FrontEnd class
 */
class FrontEnd
{

	static $raiz;
	static $cAlert;
	static $domains;

	static function raiz()
	{
		if(isset(self::$raiz))
			return self::$raiz;
		$raiz = 'http'.(ISHTTPS?'s':'').'://'.$_SERVER['HTTP_HOST'].'/'.PATH_APP;
		self::$raiz = $raiz;
		return self::$raiz;
	}

	static function navAdmin($name=false)
	{

		$vars = Utils::getUrlVars();
		$section = (count($vars)>1)?$vars[1]:'index';

		// badges

		$itens = [

			 ['href' => 'index'		,'name'=>'Início' 			, 'icon'=>'home' 	, 'class' => 'showloading']
			,['href' => 'banners'		,'name'=>'Banners'	 		, 'icon'=>'image' , 'class' => 'showloading']
			,['href' => 'pesquisas'		,'name'=>'Pesquisas' 		, 'icon'=>'list-alt' , 'class' => 'showloading']
			,['href' => 'indicadores'	,'name'=>'Indicadores' 		, 'icon'=>'chart-line' , 'class' => 'showloading']
			,['href' => 'indicadores-tipos'	,'name'=>'Indicadores Tipos' 		, 'icon'=>'chart-line' , 'class' => 'showloading']
			// ,['href' => 'noticias'		,'name'=>'Notícias' 		, 'icon'=>'newspaper' , 'class' => 'showloading']
			,['href' => 'usuarios'		,'name'=>'Usuários' 		, 'icon'=>'user' , 'class' => 'showloading']

		];


		$itens[] = ['href' => 'sair'		,'name'=>'Sair' 	, 'icon'=>'sign-out-alt' 	, 'class' => 'showloading'];


		if($name){
			$page = ['name'=>'Não encontrado','icon'=>'home'];
			foreach ($itens as $item) {
				if($section==$item['href'])
					$page = $item;
			}
			if($section=='login') $page = 'Login';
			return $page;
		}

		$html = self::navItensAdmin($itens,$section);

		echo $html;
	}

	private static function navItensAdmin($itens,$section,$href='')
	{


		$res = '';
		foreach ($itens as $item) {
			$selected = ($section==$item['href'])?'active':'';

			$subitens = '';
			$toggle = '';
			$badge = '';
			if(isset($item['subitens'])){
				$href = $item['href'];
				$show = ($selected)?'show':'hide';
				$subitens .= '<ul class="list-unstyled collapse '.$show.'" id="page'.$href.'">';
				$subitens .= self::navItensAdmin($item['subitens'],$section,$item['href'].'/');
				$subitens .= '</ul>';
				$toggle = 'data-toggle="collapse" aria-expanded="true" class="dropdown-toggle"';
				$item['href'] = '#page'.$href;
				$href = '';
			}else{
				$item['href'] = self::raiz().'admin/'.$href.$item['href'];
			}

			if(isset($item['badge'])){
				$badge = "<span class='badge badge-light'>{$item['badge']}</span>";
			}

			$res .=
			"<li class='nav-item'>
			<a class='nav-link {$item['class']} {$selected}' href='{$item['href']}' {$toggle}>
			<i class='fas fa-{$item['icon']}'></i>
			{$item['name']}
			{$badge}
			</a>
			{$subitens}
			</li>";
		}
		return $res;
	}

	static function page($area='site')
	{

		$i = ($area=='site')?0:1;

		$vars = Utils::getUrlVars();
		dd($vars);
		$section = (count($vars)>0 && isset($vars[$i]) && $vars[$i])?$vars[$i]:'index';
		$section = str_replace(['/','\\'], '', $section);
		$page = "views/{$area}/page/{$section}.php";

		if(is_file($page)){
			require_once($page);
		}else{
			self::pageError(404,$area);
		}

	}


	static function login()
	{
		if(isset($_SESSION['token'])){
			if( isset($_SESSION['tentativas_dt']) ){
				$page = 'wait';
			}else{
				$page = 'login';
			}
		}else{
			$page = 'token';
		}
		Log::set('page',$page);
		require_once('views/admin/secure/'.$page.'.php');
	}

	static function pageError($code=000,$area='site')
	{
		Log::set('page','pageErro '.$code);
		$page = "views/{$area}/error/{$code}.php";
		require_once($page);
	}

	static function alert($msg,$type='info',$close=true)
	{
		echo "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'> ";
		echo $msg;

		if($close){
			echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
		}
		echo "</div>";

		// count alert

		if(!isset(self::$cAlert))
			self::$cAlert = 0;
		self::$cAlert++;

		Log::set('alert-'.self::$cAlert, [$type=>$msg] );

	}

	static function error($errors)
	{
		if($errors){
			if(is_array($errors)||is_object($errors)){
				foreach ($errors as $k => $v) {
					self::error($v);
				}
			}else{
				self::alert($errors,'danger',false);
			}
			return true;
		}
		return false;
	}

	static function resource($filename,$onlyurl=false,$title=APP_TITLE)
	{
		$ext = explode('.', $filename);
		$ext = $ext[count($ext)-1];

		$atcss = APPLICATION_ENV=='development'?time():date('Ymd');

		if($ext=='css'){
			$url = self::raiz()."resource/css/{$filename}"."?i={$atcss}";
			$embed = "<link href='".$url."' rel='stylesheet'>";
		}elseif ($ext=='js') {
			$url = self::raiz()."resource/js/{$filename}"."?i={$atcss}";
			$embed = "<script src='".$url."'></script>";
		}elseif (in_array(strtolower($ext), ['jpg','jpeg','gif','png','svg'])) {
			$url = self::raiz()."resource/imgs/{$filename}"."?i={$atcss}";
			$embed = "<img title='".$title."' alt='".$title."' src='".$url."'>";
		}

		if($onlyurl) return $url;
		return $embed;

	}

	static function form($obj,$nametoken=null)
	{
		$anon = $obj->getAnnotation();

		if(!$nametoken) $nametoken = get_class($obj);

		$inputs = "";

		$inputs .= self::getInputToken($nametoken);

		foreach ($anon['properties'] as $key => $v) {

			$label = (isset($v['Column']['label']))?$v['Column']['label']:$v['Column']['name'];
			$mask = (isset($v['Column']['mask']))?$v['Column']['mask']:$v['Column']['type'];
			$domain = (isset($v['Column']['domain']))?$v['Column']['domain']:null;

			$inputType = $mask;
			if($mask == "varchar") $inputType = "text";
			if($mask == "text") $inputType = "textarea";
			if($mask == "password") $obj->$key = "";

			if($domain) { $inputType = "select"; }

			if(in_array($key, ['id','timestamp'])) $inputType = 'hidden';

			if($inputType != 'hidden') $inputs .= "<div class='form-group row'><label for='{$key}' class='col-sm-2 col-form-label'>{$label}</label>";
			$inputs .= self::formInput($inputType,$key,$obj->$key,$domain,['class'=>'col-sm-9']);
			if($inputType != 'hidden') $inputs .= "</div>";
		}

		return $inputs;

	}

	static function getInputToken($nametoken)
	{
		$_token = md5(Utils::microtimeFloat());
		setSession('_token_'.$nametoken,$_token);
		return self::formInput('hidden','_token',$_token);
	}

	static function formInput($inputType,$name,$value='',$domain=NULL,$attrs=array())
	{

		$attrStr = $addClass = '';
		if(is_array($attrs)){
			if(isset($attrs['class'])){
				$addClass = $attrs['class'];
				unset($attrs['class']);
			}

			foreach ($attrs as $k => $v) {
				$attrStr .= " {$k}='{$v}' ";
			}
		}

		if($domain){

			if(!self::$domains) self::$domains = [];

			if(!is_array($domain) && !isset(self::$domains[$name])){
				$a = explode('|', $domain);
				$domain = getUniarrayDb($a[0],$a[1],$a[2],$a[3]);
			}

			if(!isset(self::$domains[$name])) self::$domains[$name] = $domain;
			$domain = self::$domains[$name];
		}

		if($inputType=='textarea'){
			return "<textarea class='form-control form-control-sm {$addClass}' name='{$name}' data-default='{$value}' {$attrStr}>{$value}</textarea>";
		}elseif($inputType=='readonly'){
			return $value."<input type='hidden' name='{$name}' value='{$value}' {$attrStr}>";

		}elseif($inputType=='select'){
			$html = "<select class='form-control form-control-sm {$addClass}' name='{$name}' data-default='{$value}' {$attrStr}>";
			// $html .= "<option value=''>Selecione</option>";
			foreach ($domain as $k => $v) {
				$selected = ($k==$value)?'selected':'';
				$html .= "<option value='{$k}' {$selected}>{$v}</option>";
			}
			$html .= "</select>";
			return $html;
		}else{
			return "<input type='{$inputType}' class='form-control form-control-sm {$addClass}' name='{$name}' data-default='{$value}' {$attrStr} value='{$value}'>";
		}
	}

}
