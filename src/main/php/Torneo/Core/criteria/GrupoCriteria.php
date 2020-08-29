<?php
namespace Torneo\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de grupo
 *  
 * @author Marcos
 * @since 03-08-2020
 *
 */
class GrupoCriteria extends CuentaCriteria{

	private $nombre;
	
	private $torneo;


	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
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