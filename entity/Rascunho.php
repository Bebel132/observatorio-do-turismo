<?php 
/**
 * @Table = {"name":"rascunhos"}
 */
class Rascunho extends Entity
{


	/**
	* @Column = {"name":"name" , "type":"varchar" , "size" : "255"}
	*/
	public $name;

	/**
	* @Column = {"name":"categoria" , "type":"varchar" , "size" : "255"}
	*/
	public $categoria;

	/**
	* @Column = {"name":"tema" , "type":"varchar" , "size" : "255"}
	*/
	public $tema;

	/**
	* @Column = {"name":"titulo" , "type":"varchar" , "size" : "255"}
	*/
	public $titulo;

	/**
	* @Column = {"name":"local" , "type":"varchar" , "size" : "255"}
	*/
	public $local;

	/**
	* @Column = {"name":"fonte" , "type":"varchar" , "size" : "255"}
	*/
	public $fonte;

	/**
	* @Column = {"name":"ano" , "type":"varchar" , "size" : "255"}
	*/
	public $ano;

	/**
	* @Column = {"name":"tipodocumento" , "type":"varchar" , "size" : "255"}
	*/
	public $tipodocumento;

	/**
	* @Column = {"name":"autor" , "type":"varchar" , "size" : "255"}
	*/
	public $autor;

	/**
	* @Column = {"name":"numero" , "type":"varchar" , "size" : "255"}
	*/
	public $numero;

	/**
	* @Column = {"name":"ambito" , "type":"varchar" , "size" : "255"}
	*/
	public $ambito;

	/**
	* @Column = {"name":"descricao" , "type":"text" }
	*/
	public $descricao;

	/**
	* @Column = {"name":"localizacao" , "type":"text" }
	*/
	public $localizacao;

	/**
	* @Column = {"name":"noderef" , "type":"varchar" , "size" : "255"}
	*/
	public $noderef;

	/**
	* @Column = {"name":"indexado" , "type":"integer" , "size" : ""}
	*/
	public $indexado;

	/**
	* @Column = {"name":"username" , "type":"varchar" , "size" : "255"}
	*/
	public $username;
	
	/**
	* @Column = {"name":"pathmae" , "type":"integer" , "size" : ""}
	*/
	public $pathmae;

	/**
	* @Column = {"name":"pathcompleto" , "type":"text"}
	*/
	public $pathcompleto;

	/**	
	 * @Column = {"name":"timestamp","type":"timestamp","index":"NOT NULL"}
	 */
	public $timestamp; 

}
?>