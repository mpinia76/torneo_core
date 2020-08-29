<?php
namespace Torneo\Core\service;

/**
 * Factory de servicios
 *  
 *  
 *  @author Marcos
 * @since 03-08-2020
 *
 */




use Torneo\Core\service\impl\TorneoServiceImpl;
use Torneo\Core\service\impl\GrupoServiceImpl;
use Torneo\Core\service\impl\JugadorServiceImpl;



class ServiceFactory {


	
	
	/**
	 * @return ITorneoService
	 */
	public static function getTorneoService(){
	
		return new TorneoServiceImpl();	
	}
	
	
	/**
	 * @return IGrupoService
	 */
	public static function getGrupoService(){
	
		return new GrupoServiceImpl();	
	}
	
	/**
	 * @return IJugadorService
	 */
	public static function getJugadorService(){
	
		return new JugadorServiceImpl();	
	}
	
}