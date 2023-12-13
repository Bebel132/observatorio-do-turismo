<?php 
/**
 * @Table = {"name":"textos"}
 */
class Texto extends Entity
{

	/**
	* @Column = {"name":"label" , "type":"varchar" , "size" : "255" , "label":"Label"}
	*/
	public $label;

	/**
	* @Column = {"name":"texto" , "type":"text" , "label":"Texto"}
	*/
	public $texto;

	/**
	* @Column = {"name":"filename" , "type":"varchar" , "size" : "255" , "mask" : "file" , "label":"Imagem"}
	*/
	public $filename;

	/**
	* @Column = {"name":"flstatus" , "type":"integer" , "size" : "" , "label":"Status" , "domain":{"1":"Ativo","2":"Inativo"} }
	*/
	public $flstatus;

	/**	
	 * @Column = {"name":"timestamp","type":"timestamp","index":"NOT NULL"}
	 */
	public $timestamp; 
	

}