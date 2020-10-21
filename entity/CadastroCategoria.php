<?php 
/**
 * @Table = {"name":"categorias","database":"acervo"}
 */
class CadastroCategoria extends Entity
{

	/**
	* @Id = {"name":"id_categoria" , "type":"serial" }
	*/
	public $id;

	/**
	* @Column = {"name":"nome" , "type":"varchar" , "size" : "255"}
	*/
	public $nome;

}