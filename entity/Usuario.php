<?php 
/**
 * @Table = {"name":"usuarios"}
 */
class Usuario extends Entity
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
	* @Column = {"name":"senha" , "type":"varchar" , "size" : "255" , "label":"Senha" , "mask":"password"}
	*/
	public $senha;

	/**
	* @Column = {"name":"perfil" , "type":"integer" , "size" : "" , "label":"Perfil" , "domain":{"1":"Administrador"} }
	*/
	public $perfil; //admin, parceiro, setfot

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