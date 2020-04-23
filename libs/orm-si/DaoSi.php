<?php

class DaoSi {


	static $errorMessage;

	static $SHOWSQL_CRUD;

	static $db;
	static $config;
	static $CONN;
	static $lastInsertId;

	static function setDb($db)
	{
		self::$db = $db;
	}

	static function execute($query)
	{
		/* SHOW_CRUD */ if(self::$SHOWSQL_CRUD) { echo '<pre>['.$query.']</pre>'; }
		$con = self::conecta();
		if($con){
			$query = $con->prepare($query);
			return $query->execute();
		}
		return false;
	}

	static function querySelect($SQL)
	{
		
		/* SHOW_CRUD */ if(self::$SHOWSQL_CRUD) { echo '<pre>['.$SQL.']</pre>'; }
		$con = self::conecta();

		if($con){
			$query = $con->prepare($SQL);
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		return false;

	}

	static function conecta()
	{


		$db = $GLOBALS['db'];

		if(!self::$db)
		{
			self::$db = 'default';
		}

		self::$config = $db[self::$db];

		$dsn = 
		self::$config['dbdriver']
		.':host='.self::$config['hostname']
		.';dbname='.self::$config['database'];

		if(self::$config['dbdriver']!='pgsql'){
			$dsn .= ';charset='.self::$config['char_set'];
		}

		try{
			
			$conecta = new PDO($dsn,self::$config['username'],self::$config['password']);
			$conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			if(self::$config['dbdriver']=='pgsql'){
				$conecta->exec('SET search_path TO '.self::$config['schema']);
				if(self::$config['char_set']=='utf8'){
					$conecta->exec("SET NAMES 'UTF8'");
				}
			}



			/* SHOW_CRUD */ if(self::$SHOWSQL_CRUD) { echo '<pre>[open connection]</pre>'; }

			self::$CONN = $conecta;
			return $conecta;

		}catch(PDOexception $e_con)
		{

			$msg = "ERR0:".$e_con->getMessage();
			self::$errorMessage[] = $msg;
			if(self::$config['db_debug'])
				echo $msg;
			return false;

		}


	}
	
	static function insert($tb,$dados)
	{

		$arrCampos = array_keys($dados);
		$arrValores = array_values($dados);
		$numCampos = count($arrCampos);
		$numValores = count($arrValores);


		if($numCampos == $numValores)
		{
			$SQL = "INSERT INTO ".$tb." (";
			foreach($arrCampos as $campo)
			{
				$SQL .= "$campo, ";
			}
			$SQL = substr_replace($SQL, ")", -2, 1);
			
			$SQL .= " VALUES (";
			
			foreach($arrCampos as $campo)
			{
				$SQL .= ":".$campo.", ";
			}

			$SQL = substr_replace($SQL, ")", -2, 1);
			
		}


		try{

			$conn = self::conecta();
			$query = $conn->prepare($SQL);

			foreach($arrCampos as $campo)
			{		
				$query->bindValue(':'.$campo,$dados[$campo],PDO::PARAM_STR);
			}

			try {

				/* SHOW_CRUD */ if(self::$SHOWSQL_CRUD) { echo '<pre>['.$SQL.']</pre>'; }
				$conn->beginTransaction(); 
				$query->execute();
				

				$id = (int) $conn->lastInsertId();
				$conn->commit(); 

				self::$lastInsertId = $id;

				return $id;

			} catch(PDOExecption $e) { 
				$conn->rollback(); 
				$msg = "ERR1.2 ".$e->getMessage();
				self::$errorMessage[] = $msg;
				if(self::$config['db_debug'])
					echo $msg;
				return false;
			} 

		}catch(PDOexception $e)
		{
			$msg = "ERR1.1 ".$e->getMessage();
			self::$errorMessage[] = $msg;
			if(self::$config['db_debug'])
				echo $msg;
			return false;
		}

	}

	static function update($tb,$dados,$where)
	{
		
		$where = addslashes($where);
		
		$arrCampos = array_keys($dados);
		$arrValores = array_values($dados);
		$numCampos = count($arrCampos);
		$numValores = count($arrValores);
		
		if($numCampos == $numValores)
		{
			$SQL = "UPDATE ".$tb." SET ";
			for($i=0; $i < $numCampos; $i++)
			{
				$SQL .= $arrCampos[$i]." = :".$arrCampos[$i].",";
			}
			$SQL = substr_replace($SQL, " ",-1,1);
			$SQL .= "WHERE ".$where." ";
		}
		
		
		
		try{

			$conn = self::conecta();
			$query = $conn->prepare($SQL);

			$SQL2 = $SQL;
			foreach($arrCampos as $campo)
			{		
				$query->bindValue(':'.$campo,$dados[$campo],PDO::PARAM_STR);
				$SQL2 = str_replace(':'.$campo,$dados[$campo], $SQL2);
			}

			try {

				/* SHOW_CRUD */ if(self::$SHOWSQL_CRUD) { echo '<pre>['.$SQL2.']</pre>'; }
				$conn->beginTransaction(); 
				$query->execute();
				$conn->commit();
				

				if(isset($dados['id']))
					return $dados['id'];
				return true;

			} catch(PDOExecption $e) { 
				$conn->rollback(); 
				$msg = "ERR2.2 ".$e->getMessage();
				self::$errorMessage[] = $msg;
				if(self::$config['db_debug'])
					echo $msg;
				return false;
			} 

		}catch(PDOexception $e)
		{
			
			$msg = "ERR2.1: ".$e->getMessage();
			self::$errorMessage[] = $msg;
			if(self::$config['db_debug'])
				echo $msg;
			return false;

		}
		
	}
	
	static function delete($tb,$where='DEF')
	{
		
		if($where=='DEF')
		{
			self::$errorMessage[] = 'CondicaoIndefinida';
			return false;
		}
		
		
		//$where = addslashes($where);
		
		try{
			$SQL = "SELECT 'id' FROM ".$tb." WHERE ".$where." ";
			$query = self::conecta()->prepare($SQL);
			
			/* SHOW_CRUD */ if(self::$SHOWSQL_CRUD) { echo '<pre>['.$SQL.']</pre>'; }
			$query->execute();

			$reg = $query->fetchAll(PDO::FETCH_ASSOC);

			if(count($reg)>0)
			{

				$SQL = "DELETE FROM ".$tb." WHERE ".$where." ";
				$query = self::conecta()->prepare($SQL);

				/* SHOW_CRUD */ if(self::$SHOWSQL_CRUD) { echo '<pre>['.$SQL.']</pre>'; }

				$query->execute();

				return true;				
			}else{

				$msg = 'RegNotFound';
				self::$errorMessage[] = $msg;
				if(self::$config['db_debug'])
					echo $msg;
				return false;
			}


		}catch(PDOexception $e)
		{

			$msg = "ERR3: ".$e->getMessage();
			self::$errorMessage[] = $msg;
			if(self::$config['db_debug'])
				echo $msg;
			return false;

		}

	}
	



	static function close()
	{
		mysql_close();
	}

	static function truncate($tb)
	{
		$SQL = 'truncate '.$tb;
		$query = self::conecta()->prepare($SQL);
		/* SHOW_CRUD */ if(self::$SHOWSQL_CRUD) { echo '<pre>['.$SQL.']</pre>'; }
		$query->execute();
		
	}
	
	static private function error($msg)
	{
		self::$errorMessage[] = $msg;
		return false;
	}

	//PhpPA
	function persist(&$obj,$options=[])
	{

		$properties = $obj->getAnnotation()['properties'];

		$tableName = self::getTableObj($obj)['name'];

		if(isset($obj->id))
			unset($obj->id);

		// options
		$forcenull = (isset($options['forcenull']))?$options['forcenull']:false;

		foreach ($obj as $k => $v) {
			if(isset($properties[$k]['Column']['name'])){

				if($properties[$k]['Column']['type']=='integer') $v = ($v)?$v:0;

				if(is_array($v) || is_object($v)) $v = Utils::json_encode($v); 

				if($forcenull && $v==null) $v = "";

				$dados[$properties[$k]['Column']['name']] = $v;
			}
		}

		unset($dados['id']);
		$dados['timestamp'] = date('Y-m-d G:i:s');
		$insert = self::insert($tableName,$dados);

		if($insert){
			$obj->id = $insert;
		}

		return $insert;

	}

	function merge(&$obj)
	{	

		$properties = $obj->getAnnotation()['properties'];

		$tableName = self::getTableObj($obj)['name'];

		foreach ($obj as $k => $v) {
			if(isset($properties[$k]['Column']['name'])){

				if($properties[$k]['Column']['type']=='integer'){
					$v = ($v)?$v:0;
				}

				if(is_array($v) || is_object($v))
					$v = Utils::json_encode($v); 

				$dados[$properties[$k]['Column']['name']] = $v;
			}
		}

		if(isset($obj->id) && $obj->id){
			$where = "id=".$obj->id;
			unset($dados['timestamp']);
			$insert = self::update($tableName,$dados,$where);
		}else{
			unset($dados['id']);
			$dados['timestamp'] = date('Y-m-d G:i:s');
			$insert = self::insert($tableName,$dados);
		}

		if($insert){
			$obj->id = $insert;
		}

		return $insert;

	}

	function exclude($obj)
	{

		$tableName = self::getTableObj($obj)['name'];

		if(isset($obj->id)){
			$where = "id=".$obj->id;
			return self::delete($tableName,$where);
		}
		return false;
	}

	public function getObjById(Object $obj,Int $id)
	{

		$properties = $obj->getAnnotation()['properties'];

		$tableName = self::getTableObj($obj)['name'];

		$result = self::querySelect("SELECT * FROM {$tableName} WHERE id={$id} LIMIT 1");

		if($result)
		{
			foreach ($result[0] as $k => $v) {

				foreach ($properties as $kk => $vv) {
					if($vv['Column']['name']==$k)
					{
						$i = $kk;
						break;
					}
				}

				$obj->{$i} = $v;
			}
		}

		return $obj;

	}

	public function getList($obj)
	{
		$result = [];
		$EntityClass = get_class($obj);
		$tb = self::getTableObj($obj);
		$where = "(1)";
		foreach ($obj as $attr => $value) {
			if($value || $value===0 || $value==="0"){
				$value = (is_numeric($value)) ? (int) $value : '"'.$value.'"';
				$where .= " AND {$attr} = {$value}";
			}
		}

		$ids = self::querySelect("SELECT id FROM {$tb['name']} WHERE {$where} ORDER BY id DESC");
		foreach ($ids as $id) {
			$result[$id['id']] = new $EntityClass($id['id']); 
		}
		return $result;
	}


	public function getTableObj($obj)
	{
		$classAttr = $obj->getAnnotation()['class'];

		if(!isset($classAttr['tableName']) && !isset($classAttr['Table']['name']))
		{
			$table['name'] = strtolower(get_class($obj));
		}else{
			$table['name'] = (isset($classAttr['tableName']))?$classAttr['tableName']:$classAttr['Table']['name'];
		}

		return $table;

	}






}
?>