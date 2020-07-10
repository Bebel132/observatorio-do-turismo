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


		$sqls = self::getSqls($drop);

		foreach ($sqls as $sql) {
			echo $sql;
			$ok = DaoSi::execute($sql);
			echo "-- response [{$ok}]
			";
		}


	}

	static function getSqls($drop=false)
	{

		$entities = self::listEntities();

		$sqls = [];

		foreach ($entities as $k => $EntityName) {

			$Entity = new $EntityName();
			$anotations = PhpAnnotation::get($Entity);
			$table = $anotations['class']['Table']['name'];

			// $sqls[] = '-- '.$EntityName." 
			// ";

			if($drop){
				$sqls[] = "DROP TABLE IF EXISTS {$table}";
			}

			$sqls[] = self::getSqlByEntity($Entity);

		}

		return $sqls;


	}

	static function getSqlByEntity($Entity)
	{

		$anotations = PhpAnnotation::get($Entity);

		$table = $anotations['class']['Table']['name'];

		$primary_key = '';

		$SQL = "CREATE TABLE IF NOT EXISTS {$table} (";

		foreach ($anotations['properties'] as $kk => $vv) {


			$type = isset($vv['Column']['type'])?$vv['Column']['type']:'varchar';
			$size = isset($vv['Column']['size'])?$vv['Column']['size']:self::getOptionsType($type)['size'];
			$index = isset($vv['Column']['index'])?$vv['Column']['index']:self::getOptionsType($type)['index'];

			foreach ($vv['Column'] as $kkk => $vvv) {
				$$kkk = $vvv;
			}

			if($type=='serial'){
				$primary_key = $name;
			}

			
			if($size)
				$size = '('.str_replace(['(',')'], '', $size).')';
			$SQL .= "
			{$vv['Column']['name']} {$type}{$size} $index,";
		}
		$SQL = substr($SQL, 0,-1);


		if($primary_key){

			$SQL .=",
			";

			if($GLOBALS['db']['default']['dbdriver'] == 'pgsql'){
				$SQL .=" CONSTRAINT {$table}_pkey" ;
			}

			$SQL .=" PRIMARY KEY ({$primary_key})" ;
		}



		$SQL .="
		);

		";

		self::toDriver($SQL);

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

	static function toDriver(&$sqlStr)
	{

		// Postgres
		if($GLOBALS['db']['default']['dbdriver'] == 'pgsql'){

			$sqlStr = str_replace('varchar', 'character varying', $sqlStr);

		// MySQL
		}else{

			$sqlStr = str_replace('character varying', 'varchar', $sqlStr);

		}

	}

}
?>