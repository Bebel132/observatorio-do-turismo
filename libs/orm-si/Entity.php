<?php 
/**
 * Entity
 */
class Entity
{
	
	/**	
	 * @Column = {"name":"id","type":"serial","size":"","index":""}
	 */
	public $id;

	/**	
	 * @Column = {"name":"timestamp","type":"timestamp","index":"NOT NULL"}
	 */
	public $timestamp; 

	function __construct($id=null)
	{
		if($id){
			return DaoSi::getObjById($this,$id);
		}
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAnnotation()
	{
		return PhpAnnotation::get($this);
	}

	public function getImg($attr,$onlysrc=false)
	{
		$anon = $this->getAnnotation();

		$tb = DaoSI::getTableObj($this)['name'];

		$value = "";

		if(
			isset($anon['properties'][$attr]['Column']['mask'])
			&& $anon['properties'][$attr]['Column']['mask']=='file'
		){
			$value = $this->$attr;
			$parts = explode('.', $value);
			$ext = strtolower($parts[count($parts)-1]);
			// if(in_array($ext, ['jpg','jpeg','gif','png'])){
				$value = FrontEnd::resource("../uploads/{$tb}/".$value,$onlysrc);
			// }
		}
		return $value;

	}

	// ---# Documentação
	
	// -- Tipos de Annotation de Classe
	// - @Table = {"name":"[name]"}
	
	// -- Tipos de Annotation de Atributo
	// - @Column = {"name":"[name]","type":"[type]"}
	// - @Form = {" atributes input "}

}
?>