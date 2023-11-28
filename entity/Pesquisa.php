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
	* @Column = {"name":"filename" , "type":"varchar" , "size" : "255" , "mask" : "file" , "label":"Imagem"}
	*/
	public $filename;

	/**
	* @Column = {"name":"link_relatorio" , "type":"varchar" , "size" : "255" , "label":"Link Relatório"}
	*/
	public $link_relatorio;

	/**
	* @Column = {"name":"link_painel_interativo" , "type":"varchar" , "size" : "255" , "label":"Link Painel Interativo"}
	*/
	public $link_painel_interativo;

	/**
	* @Column = {"name":"flstatus" , "type":"integer" , "size" : "" , "label":"Status" , "domain":{"1":"Ativo","2":"Inativo"} }
	*/
	public $flstatus;

	/**	
	 * @Column = {"name":"timestamp","type":"timestamp","index":"NOT NULL"}
	 */
	public $timestamp; 
	
	/**
	* @Column = {"name":"indicador" , "type":"integer" , "size" : "" , "label":"Tipo" , "domain": "IndicadorTipo|id|titulo|(1)" }
	*/
	public $indicador_tipo_id;

}