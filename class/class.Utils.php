<?php 
/**
 * Utils class
 */
class Utils
{
	
	static function getUrlVars()
	{
		$vars = [];
		$urlVars = $_SERVER['REDIRECT_URL'];
		$urlVars = str_replace(PATH_APP, '', $urlVars);
		$exploded = explode('/', $urlVars);
		if($exploded && count($exploded)>0)
		{
			foreach ($exploded as $k => $v) {
				if(trim($v)!='')
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

	public static function redirect($url=false,$time=0)
	{
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
			header ('Refresh:'.$time.' '.$urlPhp,true,303);
			// header ('Location: '.$url);
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
			$p .= $k;
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

}
?>