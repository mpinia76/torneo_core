<?php
namespace Cuentas\Core\dao\impl;

use Cuentas\Core\dao\IProveedorDAO;

use Cuentas\Core\model\Proveedor;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Proveedor
 *  
 * @author Bernardo
 * @since 10-06-2014
 * 
 */
class ProveedorDoctrineDAO extends CrudDAO implements IProveedorDAO{
	
	protected function getClazz(){
		return get_class( new Proveedor() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('p', 'ctacte'))
	   				->from( $this->getClazz(), "p")
					->leftJoin('p.cuentaCorriente', 'ctacte');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(p.oid)')
	   				->from( $this->getClazz(), "p")
					->leftJoin('p.cuentaCorriente', 'ctacte');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "p.oid <> $oid");
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "p.nombre like '%$nombre%'");
		}
		
		$apellido = $criteria->getApellido();
		if( !empty($apellido) ){
			$queryBuilder->andWhere( "p.apellido like '%$apellido%'");
		}
		
		$nombreEq = $criteria->getNombreEqual();
		if( !empty($nombreEq) ){
			$queryBuilder->andWhere("p.nombre = '$nombreEq'");
		}
		

		$nroDocumento = $criteria->getNroDocumento();
		if( !empty($nroDocumento) ){
			$queryBuilder->andWhere("p.nroDocumento = '$nroDocumento'");
		}

		$tipoDocumento = $criteria->getTipoDocumento();
		if( !empty($tipoDocumento) ){
			$queryBuilder->andWhere("p.tipoDocumento = '$tipoDocumento'");
		}		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "p.$name";	
		}	
		
	}	
}