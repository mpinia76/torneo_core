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
class GrupoDoctrineDAO extends CrudDAO implements IGrupoDAO{
	
	protected function getClazz(){
		return get_class( new Grupo() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('g','t'))
	   				->from( $this->getClazz(), "g")
	   				->leftJoin('g.torneo', 't');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(g.oid)')
	   				->from( $this->getClazz(), "g")
	   				->leftJoin('g.torneo', 't');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere("upper(g.nombre)  like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}
		
		
		
		$torneo = $criteria->getTorneo();
		if( !empty($torneo) && $torneo!=null){
			if (is_object($torneo)) {
				$torneoOid = $torneo->getOid();
				if(!empty($torneoOid))
					$queryBuilder->andWhere( "t.oid= $torneoOid" );
			}
			else $queryBuilder->andWhere( "t.nombre like '%$torneo%'");
			
		}
		
	}	
	
	protected function getFieldName($name){
		
		switch ($name) {
		 	
		 	case "torneo":
		 		return "t.nombre";
		 	break;
		 	
		 }
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "g.$name";	
		}	
		
	}	
}