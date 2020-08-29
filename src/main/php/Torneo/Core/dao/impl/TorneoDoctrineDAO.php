<?php
namespace Torneo\Core\dao\impl;

use Torneo\Core\dao\ITorneoDAO;

use Torneo\Core\model\Torneo;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
/**
 * dao para Torneo
 *  
 *  @author Marcos
 * @since 03-08-2020
 * 
 */
class TorneoDoctrineDAO extends CrudDAO implements ITorneoDAO{
	
	protected function getClazz(){
		return get_class( new Torneo() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('t'))
	   				->from( $this->getClazz(), "t");
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(t.oid)')
	   				->from( $this->getClazz(), "t");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		/*$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "t.oid <> $oid");
		}*/
		
		$year = $criteria->getYear();
		if( !empty($year) ){
			$queryBuilder->andWhere( "t.year = '$year'");
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "t.nombre = '$nombre'");
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "t.$name";	
		}	
		
	}	
}