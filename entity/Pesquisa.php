<?php 
/**
 * @Table = {"name":"pesquisas"}
 */
class Pesquisa extends Entity
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
	* @Column = {"name":"link_form" , "type":"varchar" , "size" : "255" , "label":"Link Formulário"}
	*/
	public $link_form;

	/**
	* @Column = {"name":"link_resultado" , "type":"varchar" , "size" : "255" , "label":"Link Resultado"}
	*/
	public $link_resultado;

	/**
	* @Column = {"name":"status" , "type":"integer" , "size" : "" , "label":"Status" , "domain":{"1":"Formulários","2":"Resultados","3":"Inatiivo"} }
	*/
	public $status;

	/**
	* @Column = {"name":"filename" , "type":"varchar" , "size" : "255" , "mask" : "file" , "label":"Imagem"}
	*/
	public $filename;

}