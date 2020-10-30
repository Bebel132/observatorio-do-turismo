<?php 

/**
 * PhpAnnotation
 */
class PhpAnnotation
{

	static $ReflectionClass;
	static $ReflectionClassParent;

	static function get($class)
	{
		
		self::$ReflectionClass = new ReflectionClass($class);
		self::$ReflectionClassParent = self::$ReflectionClass->getParentClass();
		
		$res['class'] = self::commentToArray(self::$ReflectionClass->getDocComment());

		$res['properties'] = self::getPropriedades();
		
		return $res;

	}


	private function getPropriedades($value='')
	{

		$a = array();

		$propsParent = self::$ReflectionClassParent->getProperties();
		foreach ($propsParent as $k => $v) {
			$a[$v->name] = self::getPropertyParentAnnotations($v->name);
		}

		$props = self::$ReflectionClass->getProperties();
		foreach ($props as $k => $v) {
			$a[$v->name] = self::getPropertyAnnotations($v->name);
		}

		return $a;

	}

	private function getPropertyAnnotations($propertyName)
	{
		$property = self::$ReflectionClass->getProperty($propertyName);
		return self::commentToArray($property->getDocComment());
	}

	private function getPropertyParentAnnotations($propertyName)
	{
		$property = self::$ReflectionClassParent->getProperty($propertyName);
		return self::commentToArray($property->getDocComment());
	}

	private function commentToArray($text)
	{
		$attrs = explode('@', $text);

		$a = array();
		$charAspas = '[AxP$z]';

		foreach ($attrs as $k => $v) {

			$v= trim(str_replace(['*','/','\\'], '', $v));

			// echo $v;

			$q = explode('=', $v);

			$i = trim($q[0]);

			// print_r($q);
			if(!$q[0] || !isset($q[1])){
				

				if($i)
					$a[$i] = true;

				continue;

			}elseif(self::isJson($q[1])){

				$a[$i] = self::json_decode($q[1]);

			}else{

				$val = str_replace('\"', $charAspas, $v);
				$vals = explode('"', $val);
				$valFinal = (isset($vals[1]) && $vals[1])?$vals[1]:'';
				$valFinal = str_replace($charAspas, '"', $valFinal);
				$a[trim($q[0])] = trim($valFinal);
			}
		}

		return $a;

	}


	private function json_decode($json){
		if(get_magic_quotes_gpc()){
			$json = stripslashes($json);
		}

		return json_decode($json,true);
	}

	private function json_encode($dados){
		return json_encode($dados);
	}

	private function isJson($str)
	{
		$r = self::json_decode($str);
		if($r!='' && $r != NULL)
			return true;
		return false;
	}



}


?>