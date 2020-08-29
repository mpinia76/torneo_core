<?php
namespace Torneo\Core\service\impl;


use Torneo\Core\criteria\GrupoCriteria;

use Torneo\Core\service\IGrupoService;

use Torneo\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Grupo
 *  
*  @author Marcos
 * @since 03-08-2020
 *
 */
class GrupoServiceImpl extends CrudService implements IGrupoService {

	
	protected function getDAO(){
		return DAOFactory::getGrupoDAO();
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