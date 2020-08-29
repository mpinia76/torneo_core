<?php

namespace Torneo\Core\model;

use Cose\model\impl\Entity;


use Cose\utils\Logger;

/**
 * @Entity @Table(name="torneo_jugador")
 * 
 * @author Marcos
 * @since 17-08-2020
 */
class Jugador extends Persona{

	//variables de instancia.
    
    
	/**
	 * @Column(type="integer", nullable=true)
	 * @var unknown_type
	 */
	private $tipoJugador;
	
	
	
	public function __construct(){
	}
	

	
	

	

	public function getTipoJugador()
	{
	    return $this->tipoJugador;
	}

	public function setTipoJugador($tipoJugador)
	{
	    $this->tipoJugador = $tipoJugador;
	}
}
?>