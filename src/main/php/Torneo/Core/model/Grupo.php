<?php

namespace Torneo\Core\model;

use Cose\model\impl\Entity;



/**
 * Grupo
 * 
 * @Entity @Table(name="torneo_grupo")
 * 
 * @author Marcos
 * @since 03-08-2020
 */

class Grupo extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
     **/
	private $nombre;
	
	/**
     * @ManyToOne(targetEntity="Torneo",cascade={"merge"})
     * @JoinColumn(name="torneo_oid", referencedColumnName="oid")
     * @var Torneo
     **/
	private $torneo;
	
	
	/**
	 * @Column(type="integer", nullable=true)
	 * 
	 */
	private $equipos;
	
    
	public function __construct(){
		
	}
	
	public function __toString(){
		  return  $this->getNombre() . " - " . $this->getTorneo() ;
	}


	

	

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	

	public function getEquipos()
	{
	    return $this->equipos;
	}

	public function setEquipos($equipos)
	{
	    $this->equipos = $equipos;
	}

	public function getTorneo()
	{
	    return $this->torneo;
	}

	public function setTorneo($torneo)
	{
	    $this->torneo = $torneo;
	}
}
?>