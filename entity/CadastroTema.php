<?php 
/**
 * @Table = {"name":"temas","database":"acervo"}
 */
class CadastroTema extends Entity
{

	/**
	* @Id = {"name":"id_tema" , "type":"serial" }
	*/
	public $id;

	/**
	* @Column = {"name":"nome" , "type":"varchar" , "size" : "255"}
	*/
	public $nome;

}