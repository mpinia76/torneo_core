<?php
namespace Torneo\Core\service\impl;


use Torneo\Core\criteria\TorneoCriteria;


use Torneo\Core\service\ITorneoService;

use Torneo\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Torneo
 *  
*  @author Marcos
 * @since 03-08-2020
 *
 */
class TorneoServiceImpl extends CrudService implements ITorneoService {

	
	protected function getDAO(){
		return DAOFactory::getTorneoDAO();
	}
	
	function add( $entity ){
		
		$entity->setSaldo( $entity->getSaldoInicial() );
		
		parent::add( $entity );

		
	}
	
	function validateOnAdd( $entity ){
	
		//TODO que tenga cliente?
			
		//TODO unicidad (cliente )
		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}

	
	
}	