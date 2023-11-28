<?php 
/**
 * @Table = {"name":"usuarios_site"}
 */
class UsuarioSite extends Entity
{

	/**
	* @Column = {"name":"nome" , "type":"varchar" , "size" : "255" , "label":"Nome"}
	*/
	public $nome;

	/**
	* @Column = {"name":"email" , "type":"varchar" , "size" : "255" , "label":"Email" , "mask" : "email"}
	*/
	public $email;

	/**
	* @Column = {"name":"telefone" , "type":"varchar" , "size" : "15" , "label":"Telefone" , "mask" : "telefone"}
	*/
	public $telefone;

	/**
	* @Column = {"name":"instituicao" , "type":"varchar" , "size" : "255" , "label":"Instituição"}
	*/
	public $instituicao;


	/**
	* @Column = {"name":"flstatus" , "type":"integer" , "size" : "" , "label":"Status" , "domain":{"1":"Ativo","2":"Inativo"} }
	*/
	public $flstatus;

	/**	
	 * @Column = {"name":"timestamp","type":"timestamp","index":"NOT NULL"}
	 */
	public $timestamp; 

}