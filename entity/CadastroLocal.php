<?php 
/**
 * @Table = {"name":"locais","database":"acervo"}
 */
class CadastroLocal extends Entity
{

	/**
	* @Id = {"name":"id_local" , "type":"serial" }
	*/
	public $id;

	/**
	* @Column = {"name":"nome" , "type":"varchar" , "size" : "255"}
	*/
	public $nome;

}