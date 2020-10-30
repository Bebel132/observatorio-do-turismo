<?php 
/**
 * @Table = {"name":"banners"}
 */
class Banner extends Entity
{

	/**
	* @Column = {"name":"titulo" , "type":"varchar" , "size" : "255" , "label":"Título"}
	*/
	public $titulo;

	/**
	* @Column = {"name":"descricao" , "type":"text" , "label":"Descrição"}
	*/
	public $descricao;

	/**
	* @Column = {"name":"link" , "type":"varchar" , "size" : "255" , "label":"Link"}
	*/
	public $link;

	/**
	* @Column = {"name":"tipo" , "type":"integer" , "size" : "" , "label":"Localização" , "domain":{"1":"Topo","2":"Aplicativos e Sites","3":"Parceiros","4":"Área Restrita"} }
	*/
	public $tipo;

	/**
	* @Column = {"name":"filename" , "type":"varchar" , "size" : "255" , "mask" : "file" , "label":"Imagem"}
	*/
	public $filename;

	/**
	* @Column = {"name":"filename_m" , "type":"varchar" , "size" : "255" , "mask" : "file" , "label":"Imagem Mobile"}
	*/
	public $filename_m;

	/**
	* @Column = {"name":"flstatus" , "type":"integer" , "size" : "" , "label":"Status" , "domain":{"1":"Ativo","2":"Inativo"} }
	*/
	public $flstatus;

	/**	
	 * @Column = {"name":"timestamp","type":"timestamp","index":"NOT NULL"}
	 */
	public $timestamp; 

}