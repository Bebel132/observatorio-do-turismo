<?php 
/**
 * @Table = {"name":"tipodocumentos","database":"acervo"}
 */
class CadastroTipoDocumento extends Entity
{

	/**
	* @Id = {"name":"id_tipodocumento" , "type":"serial" }
	*/
	public $id;

	/**
	* @Column = {"name":"nome" , "type":"varchar" , "size" : "255"}
	*/
	public $nome;

}