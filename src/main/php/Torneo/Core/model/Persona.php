<?php

namespace Torneo\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

/**
 * 
 * Representa una persona (jugador, tecnico, arbitro, etc)
 * 
 * @Entity @Table(name="torneo_persona")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"jugador" = "Jugador", "tecnico" = "Tecnico", "arbitro" = "Arbitro"}) 
 * 
 * 
 * @author Marcos
 * @since 17-08-2020
 */
abstract class Persona extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $apellido;
	

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $email;
	

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $telefono;
	

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $celular;
	
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $domicilio;
	
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $observaciones;
	
	/** 
	 * @Column(type="string", nullable=true)
	 *  
	 **/
	private $nroDocumento;

	/**
	 * @Column(type="integer", nullable=true)
	 * @var unknown_type
	 */
	private $tipoDocumento;
	
	
	/**
	 * @Column(type="integer", nullable=true)
	 * @var unknown_type
	 */
	private $sexo;
	
		 
	/** 
	 * @Column(type="date", nullable=true)
	 *  
	 **/
	private $fechaNacimiento;
	
	
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getApellido() . " " . $this->getNombre();
	}


	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}

	public function getTelefono()
	{
	    return $this->telefono;
	}

	public function setTelefono($telefono)
	{
	    $this->telefono = $telefono;
	}

	public function getCelular()
	{
	    return $this->celular;
	}

	public function setCelular($celular)
	{
	    $this->celular = $celular;
	}

	public function getDomicilio()
	{
	    return $this->domicilio;
	}

	public function setDomicilio($domicilio)
	{
	    $this->domicilio = $domicilio;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}

	public function getNroDocumento()
	{
	    return $this->nroDocumento;
	}

	public function setNroDocumento($nroDocumento)
	{
	    $this->nroDocumento = $nroDocumento;
	}

	public function getTipoDocumento()
	{
	    return $this->tipoDocumento;
	}

	public function setTipoDocumento($tipoDocumento)
	{
	    $this->tipoDocumento = $tipoDocumento;
	}

	public function getSexo()
	{
	    return $this->sexo;
	}

	public function setSexo($sexo)
	{
	    $this->sexo = $sexo;
	}

	public function getFechaNacimiento()
	{
	    return $this->fechaNacimiento;
	}

	public function setFechaNacimiento($fechaNacimiento)
	{
	    $this->fechaNacimiento = $fechaNacimiento;
	}
}
?>