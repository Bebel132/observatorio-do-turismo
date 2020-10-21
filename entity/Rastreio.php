<?php 
/**
 * @Table = {"name":"rastreio","database":"default"}
 */
class Rastreio extends Entity
{

	/**
	* @Column = {"name":"username" , "type":"varchar" , "size" : "255"}
	*/
	public $username;

	/**
	* @Column = {"name":"page" , "type":"varchar" , "size" : "255"}
	*/
	public $page;

	/**
	* @Column = {"name":"ext" , "type":"varchar" , "size" : "255"}
	*/
	public $ext;

	/**
	* @Column = {"name":"request" , "type":"text"}
	*/
	public $request;

	/**	
	 * @Column = {"name":"timestamp","type":"timestamp","index":"NOT NULL"}
	 */
	public $timestamp; 

}
?>