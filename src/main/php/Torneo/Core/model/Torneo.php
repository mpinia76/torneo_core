<?php

namespace Torneo\Core\model;

use Torneo\Core\utils\TorneoUtils;

use Cose\model\impl\Entity;



/**
 * Torneo
 * 
 * @Entity @Table(name="torneo_torneo")
 * 
 *  @author Marcos
 * @since 03-08-2020
 */

class Torneo extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
     **/
	private $nombre;
	
	/**
	 * @Column(type="string")
	 * @var string
     **/
	private $year;
	
	/**
	 * @Column(type="integer", nullable=true)
	 * 
	 */
	private $equipos;
	
	/**
	 * @Column(type="integer", nullable=true)
	 * 
	 */
	private $grupos;
	
	/**
	 * @Column(type="integer", nullable=true)
	 * 
	 */
	private $playoffs;
	

	public function __construct(){
		
		
	}
	
	public function __toString(){
		 return  $this->getNombre() . " - " . $this->getYear() ;
	}

    

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	

	public function getYear()
	{
	    return $this->year;
	}

	public function setYear($year)
	{
	    $this->year = $year;
	}

	public function getEquipos()
	{
	    return $this->equipos;
	}

	public function setEquipos($equipos)
	{
	    $this->equipos = $equipos;
	}

	public function getGrupos()
	{
	    return $this->grupos;
	}

	public function setGrupos($grupos)
	{
	    $this->grupos = $grupos;
	}

	public function getPlayoffs()
	{
	    return $this->playoffs;
	}

	public function setPlayoffs($playoffs)
	{
	    $this->playoffs = $playoffs;
	}
}
?>