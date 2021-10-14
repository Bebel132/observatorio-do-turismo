<?php 
/**
 * Utils class
 */
class Utils
{
	
	static function getUrlVars()
	{
		$vars = array();
		$urlVars = $_SERVER['REDIRECT_URL'];

		if(PATH_APP){
			$urlVars = explode(PATH_APP, $urlVars);
			$urlVars = $urlVars[1];
		}

		// if(substr($urlVars, 0, strlen(PATH_APP)) == PATH_APP)
			// $urlVars = substr_replace($urlVars, '', 0, strlen(PATH_APP));

		$exploded = explode('/', $urlVars);
		if($exploded && count($exploded)>0)
		{
			foreach ($exploded as $k => $v) {
				if(trim($v))
				$vars[] = $v;
			}
		}


		return $vars;
	}


	static function getUrlVarActive()
	{
		$vars = self::getUrlVars();
		if($vars && count($vars)>0)
		{
			return $vars[count($vars)-1];
		}
	}

	public static function recursive($function,$str){
		//recursive
		if( is_array($str) ){
			foreach ($str as $k => $v) {
				$str[$k] = self::recursive($function,$v);
			}
			return $str;

		}elseif( is_object($str) ){
			foreach ($str as $k => $v) {
				$str->$k = self::recursive($function,$v);
			}
			return $str;

		}elseif(is_numeric(trim($str))){
			return $str;
		}elseif($str){

			$serialized = @unserialize($str); 
			if($serialized){
				return self::recursive($function,unserialize($str));
			}else{
				if(function_exists($function))
					return $function($str);
				else
					return self::$function($str);
			}
		}else{
			return $str;
		}
	}



	public static function charset($str){
		if(COD_CHARSET=='utf8_decode')
			return self::recursive('utf8_decode',$str);
		if(COD_CHARSET=='utf8_encode')
			return self::recursive('utf8_encode',$str);
		return $str;
	}

	public static function inverte_charset($str){
		
		if(COD_CHARSET=='utf8_decode')
			return self::recursive('utf8_encode',$str);
		if(COD_CHARSET=='utf8_encode')
			return self::recursive('utf8_decode',$str);
		return $str;
	}

	public static function semcharset($str){
		return $str;
	}

	public static function utf8_decode($str){
		return self::recursive('utf8_decode',$str);
	}

	public static function utf8_encode($str){
		return self::recursive('utf8_encode',$str);
	}

	public static function utf8_detect($string){
		return preg_match('%(?:
			[\xC2-\xDF][\x80-\xBF]        # non-overlong 2-byte
			|\xE0[\xA0-\xBF][\x80-\xBF]               # excluding overlongs
			|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}      # straight 3-byte
			|\xED[\x80-\x9F][\x80-\xBF]               # excluding surrogates
			|\xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
			|[\xF1-\xF3][\x80-\xBF]{3}                  # planes 4-15
			|\xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
		)+%xs', $string);
	}

	static function to_iso8859($string)
	{
		if(is_string($string)){
			if(Utils::utf8_detect($string))
				$string = Utils::utf8_decode($string);
		}else{
			$string = self::recursive('to_iso8859',$string);
		}
		return $string;
	}

	static function to_utf8($string)
	{
		if(is_string($string)){
			if(!Utils::utf8_detect($string))
				$string = Utils::utf8_encode($string);
		}else{
			$string = self::recursive('to_utf8',$string);
		}
		return $string;
	}


	public static function toSlug($string,$delimiter = '-'){

		if(!self::utf8_detect($string))
			$string = self::recursive('utf8_encode',$string);

		$string = mb_strtolower($string);

		$caracteres = array(" " => "_","'" => "_","á" => "a","à" => "a","ã" => "a","â" => "a","é" => "e","è" => "e","ê" => "e","í" => "i","ì" => "i","î" => "i","ó" => "o","ò" => "o","ô" => "o","õ" => "o","ú" => "u","ù" => "u","û" => "u","ü" => "u","ç" => "c","|" => "-","!" => "-","@" => "-","%" => "-","?" => "-","/" => "-",'\\' => "-","[" => "-","]" => "-","{" => "-","}" => "-","(" => "-",")" => "-","&" => "-","$" => "-","#" => "-","=" => "-","~" => "-","^" => "-","´" => "-","`" => "-","+" => "-","%" => "-","," => "-",";" => "-","'" => "-",'"' => "-");

		foreach ($caracteres as $k => $v) {
			$string = str_replace($k, $v, $string);
		}

		$string = str_replace("_", $delimiter, $string);
		$string = preg_replace('~-+~', $delimiter, $string);

		return $string;
		
		
	}

	public static function redirect($url=false,$time=0){

		$timeJs = $time*1000;
		if($url){
			$urlPhp = ';url='.$url;
			$urlJs = $url;
		}
		else{
			$urlPhp = '';
			$urlJs = './';
		}

		if (!headers_sent()) {
			if($time>0)
				header ('Refresh:'.$time.' '.$urlPhp,true,303);
			else{
				header ('Location: '.$url);
				exit();
			}
		}else{
			echo "<div style='display:none'> Redirecting to {$urlJs} ";
			echo "<script> setTimeout(function(){document.location.href='".$urlJs."'},$timeJs); </script>";
			echo "</div>";
		}
		
	}

	public static function back($time=0)
	{
		$timeJs = $time*1000;
		$back = "window.history.back();";
		$script = ($time)?"setTimeout(function(){ {$back} },$timeJs)":$back;
		echo "<script> {$script} </script>";
	}

	static function printTable($arr)
	{
		if(!is_array($arr) && !is_object($arr))
		{
			return $arr;
		}else{
			$bgcolor = '#FFFFFF';
			$temp = '<table class="datatable">';
			foreach ($arr as $k => $v) {
				$bgcolor = ($bgcolor=='#FFFFFF')?'#F9F9F9':'#FFFFFF';
				$temp .= '<tr>';
				$temp .= '<td bgcolor="'.$bgcolor.'">'.$k.' </td>';
				if(is_array($v) || is_object($v))
				{
					$temp .= '<td bgcolor="'.$bgcolor.'">';
					$temp .= self::printTable($v);
					$temp .= '</td>';
				}else{
					$temp .= '<td bgcolor="'.$bgcolor.'">'.$v.'</td>';
				}
				$temp .= '</tr>';
			}
			$temp .= '</table>';
		}
		return $temp;
	}

	static function datatable($array)
	{
		$p = '';
		$dado = array();
		$p .= "<div class='overflow-auto'>";
		$p .= "<table class='table table-striped table-sm table-bordered '>";
		foreach ($array as $k => $v) {
			$dado = $v;
			break;
		}
		$p .= "<thead>";
		foreach ($dado as $k => $v) {
			$p .= "<th>";
			$p .= ucfirst(str_replace('_', ' ', $k));
			$p .= "</th>";
		}
		$p .= "</thead>";
		$p .= "</tbody>";
		foreach ($array as $k => $v) {
			$p .= "<tr>";
			foreach ($v as $kk => $vv) {
				$p .= "<td>";
				if(is_array($vv))
					{ $p.=$this->datatable($vv); }else{ $p.=$vv;}
				$p .= "</td>";
			}
			$p .= "</tr>";
		}
		$p .= "</tbody>";
		$p .= "</table>";
		$p .= "</div>";
		return $p;
	}


	public static function multiSort() { //ARRAY, CAMP1, CAMP2, ...//
		$args = func_get_args(); 
		$c = count($args); 
		if ($c < 2) { 
			return false; 
		} 
		$array = array_splice($args, 0, 1); 
		$array = $array[0]; 
		foreach ($array as $k => $v) {
			$array[$k]['multiSortKeyTemp'] = $k; 
		}
		usort($array, function($a, $b) use($args) { 

			$i = 0; 
			$c = count($args); 
			$cmp = 0; 
			while($cmp == 0 && $i < $c) 
			{ 
				$cmp = strcmp($a[ $args[ $i ] ], $b[ $args[ $i ] ]); 
				$i++; 
			} 
			return $cmp; 

		}); 
		foreach ($array as $k => $v) {
			$kk = $v['multiSortKeyTemp'];
			unset($v['multiSortKeyTemp']);
			$array2[$kk] = $v;
		}
		return $array2; 
	}

	public static function escapeHtml($str,$codJson=true,$charset='semcharset'){
		//recursive
		if(is_array($str)){
			foreach ($str as $k => $v) {
				$str[$k] = self::escapeHtml($v,$codJson,$charset);
			}
			return $str;
		}elseif(is_object($str)){
			foreach ($str as $k => $v) {
				$str->$k = self::escapeHtml($v,$codJson,$charset);
			}
			return $str;
		}else{

			if($codJson===false && self::is_json($str)){
				return $str;
			}

			return htmlspecialchars(self::$charset($str));
		}
	}

	static function json_decode($json){
		if(get_magic_quotes_gpc()){
			$json = stripslashes($json);
		}

		return json_decode($json,true);
	}

	static function json_encode($dados){
		return json_encode($dados,JSON_UNESCAPED_UNICODE);
	}

	static function isJson($str)
	{
		$r = self::json_decode($str);
		if($r!='' && $r != NULL)
			return true;
		return false;
	}

	static function microtimeFloat(){
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	static function telFormat($tel){

		$tel = preg_replace("/\D/", "", $tel);

		$tam = strlen($tel);

		if($tam==8) // XxXx-XxXx
		return substr($tel, 0,4).'-'.substr($tel, 4,4);
		if($tam==9) // XxXxX-XxXx
		return substr($tel, 0,5).'-'.substr($tel, 5,4);
		if($tam==10) // (Xx) XxXx-XxXx
		return '('.substr($tel, 0,2).') '.substr($tel, 2,4).'-'.substr($tel, 6,4);
		if($tam==11) // (Xx) XxXxX-XxXx
		return '('.substr($tel, 0,2).') '.substr($tel, 2,5).'-'.substr($tel, 7,4);

		return $tel;

	}


	static function clearString($string)
	{
		$string = str_replace(['../','..\\','javascript:','javascript'], '', $string);
		$string = strip_tags($string);
		$string = addslashes($string);
		$string = htmlspecialchars($string);

		return $string;
	}


}
?>