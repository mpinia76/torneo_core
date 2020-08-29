<?php
namespace Torneo\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de torneo
 *  
 * @author Marcos
 * @since 03-08-2020
 *
 */
class TorneoCriteria extends Criteria{

	private $nombre;
	
	private $year;


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
}