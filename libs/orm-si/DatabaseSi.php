<?php 
/**
 * DatabaseSi
 */
class DatabaseSi
{

	public function recreate()
	{
		return self::create(true);
	}

	static function create($drop=false)
	{

		$entities = self::listEntities();

		echo "<pre>";

		foreach ($entities as $k => $EntityName) {

			$Entity = new $EntityName();
			$anotations = PhpAnnotation::get($Entity);

			$table = $anotations['class']['Table']['name'];

			echo '-- '.$EntityName." 
			";

			if($drop){
				echo "DROP TABLE {$table}
				";
				DaoSi::execute("DROP TABLE IF EXISTS {$table}");
			}

			$sql = self::getSqlByEntity($Entity);

			$ok = DaoSi::execute($sql);

			echo "-- [{$ok}]
			";
			
			echo $sql;

		}

		echo "</pre>";

	}

	static function getSqlByEntity($Entity)
	{

		$anotations = PhpAnnotation::get($Entity);

		$table = $anotations['class']['Table']['name'];

		$SQL = "CREATE TABLE IF NOT EXISTS {$table} (";

		foreach ($anotations['properties'] as $kk => $vv) {


			$type = isset($vv['Column']['type'])?$vv['Column']['type']:'varchar';
			$size = isset($vv['Column']['size'])?$vv['Column']['size']:self::getOptionsType($type)['size'];
			$index = isset($vv['Column']['index'])?$vv['Column']['index']:self::getOptionsType($type)['index'];

			foreach ($vv['Column'] as $kkk => $vvv) {
				$$kkk = $vvv;
			}

			
			if($size)
			$size = '('.str_replace(['(',')'], '', $size).')';
			$SQL .= "
			{$vv['Column']['name']} {$type}{$size} $index,";
		}
		$SQL = substr($SQL, 0,-1);

		$SQL .=", PRIMARY KEY (id)" ;
		$SQL .="
		);

		";

		return $SQL;

	}


	static function getOptionsType($type)
	{
		$padrao['int'] 		= ['size'=>'(11)'	, 'index' => 'NOT NULL'];
		$padrao['integer'] 	= ['size'=>'' 		, 'index' => 'NOT NULL'];
		$padrao['varchar'] 	= ['size'=>'(255)' 	, 'index' => ''];
		$padrao['text'] 	= ['size'=>'' 		, 'index' => ''];
		$padrao['timestamp']= ['size'=>'(6)' 	, 'index' => 'NOT NULL'];


		$res = (isset($padrao[$type])) ? $padrao[$type] : $padrao['varchar'];
		return $res;
	}

	static function listEntities()
	{
		$cls = get_declared_classes();

		$a = array();
		foreach ($cls as $k => $class) {
			if(is_subclass_of($class, 'Entity'))
				$a[] = $class;
		}

		return $a;

	}

}
?>