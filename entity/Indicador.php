<?php 
/**
 * @Table = {"name":"indicadores"}
 */
class Indicador extends Entity
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
	* @Column = {"name":"tipo" , "type":"integer" , "size" : "" , "label":"Tipo" , "domain": "IndicadorTipo|id|titulo|(1)" }
	*/
	public $indicador_tipo_id;

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

