<?php 
/**
 * @Table = {"name":"fontes","database":"acervo"}
 */
class CadastroFonte extends Entity
{

	/**
	* @Id = {"name":"id_fonte" , "type":"serial" }
	*/
	public $id;

	/**
	* @Column = {"name":"nome" , "type":"varchar" , "size" : "255"}
	*/
	public $nome;

}