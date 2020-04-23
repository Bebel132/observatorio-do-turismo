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
	* @Column = {"name":"tipo" , "type":"integer" , "size" : "" , "label":"Status" , "domain":{"1":"Empregos","2":"Demandas","3":"Sazonalidade","4":"Receita","5":"Prestação de Serviços"} }
	*/
	public $tipo; 

	/**
	* @Column = {"name":"filename" , "type":"varchar" , "size" : "255" , "mask" : "file" , "label":"Imagem"}
	*/
	public $filename;

}