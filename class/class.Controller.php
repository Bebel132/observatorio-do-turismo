<?php 
/**
 * Controller
 */
class Controller
{
	
	private static $current;

	public static function current()
	{
		if(!isset(self::$current)) 
		{
			$vars = Utils::getUrlVars();
			$section = (count($vars)>0)?$vars[1]:PAGE_INITIAL;
			$nameClass = str_replace(' ', '', ucwords(str_replace('-', ' ', $section))).'Controller';

			if(class_exists($nameClass))
				self::$current = new $nameClass;
			else
				self::$current = false;
		}
		return self::$current;
	}

	static function get()
	{
		return self::current();
	}

}

?>