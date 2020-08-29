<?php
namespace Torneo\Core\dao\impl;

use Torneo\Core\dao\IJugadorDAO;

use Torneo\Core\model\Jugador;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
use Cose\Security\model\User;

/**
 * dao para Jugador
 *  
 * @author Bernardo
 * @since 23-05-2014
 * 
 */
class JugadorDoctrineDAO extends CrudDAO implements IJugadorDAO{
	
	protected function getClazz(){
		return get_class( new Jugador() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('j'))
	   				->from( $this->getClazz(), "j");
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(j.oid)')
	   				->from( $this->getClazz(), "j");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "j.oid <> $oid");
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "j.nombre like '%$nombre%'");
		}
		
		$apellido = $criteria->getApellido();
		if( !empty($apellido) ){
			$queryBuilder->andWhere( "j.apellido like '%$apellido%'");
		}
		
		
		$nombreEq = $criteria->getNombreEqual();
		if( !empty($nombreEq) ){
			$queryBuilder->andWhere("j.nombre = '$nombreEq'");
		}
		

		$nroDocumento = $criteria->getNroDocumento();
		if( !empty($nroDocumento) ){
			$queryBuilder->andWhere("j.nroDocumento = '$nroDocumento'");
		}

		$tipoDocumento = $criteria->getTipoDocumento();
		if( !empty($tipoDocumento) ){
			$queryBuilder->andWhere("j.tipoDocumento = '$tipoDocumento'");
		}				
	}	
	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "j.$name";	
		}	
		
	}	
}