<?php
namespace Torneo\Core\dao;

/**
 * Factory de DAOs
 *  
 *  @author Marcos
 * @since 03-08-2020
 *
 */




use Torneo\Core\dao\impl\TorneoDoctrineDAO;
use Torneo\Core\dao\impl\GrupoDoctrineDAO;
use Torneo\Core\dao\impl\EmpleadoDoctrineDAO;




class DAOFactory {


	/**
	 * DAO para Torneo.
	 * 
	 * @return ITorneoDAO
	 */
	public static function getTorneoDAO(){
	
		return new TorneoDoctrineDAO();	
	}
	
	/**
	 * DAO para Grupo.
	 * 
	 * @return IGrupoDAO
	 */
	public static function getGrupoDAO(){
	
		return new GrupoDoctrineDAO();	
	}
	
	/**
	 * DAO para Empleado.
	 * 
	 * @return IEmpleadoDAO
	 */
	public static function getEmpleadoDAO(){
	
		return new EmpleadoDoctrineDAO();	
	}
		
}
