<?php
namespace Cuentas\Core\dao\impl;

use Cuentas\Core\dao\IClienteDAO;

use Cuentas\Core\model\Cliente;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Cliente
 *  
 * @author Bernardo
 * @since 23-05-2014
 * 
 */
class ClienteDoctrineDAO extends CrudDAO implements IClienteDAO{
	
	protected function getClazz(){
		return get_class( new Cliente() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('c', 'ctacte'))
	   				->from( $this->getClazz(), "c")
					->leftJoin('c.cuentaCorriente', 'ctacte');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(c.oid)')
	   				->from( $this->getClazz(), "c")
					->leftJoin('c.cuentaCorriente', 'ctacte');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "c.oid <> $oid");
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "c.nombre like '%$nombre%'");
		}
		
		$apellido = $criteria->getApellido();
		if( !empty($apellido) ){
			$queryBuilder->andWhere( "c.apellido like '%$apellido%'");
		}
		
		$nombreEq = $criteria->getNombreEqual();
		if( !empty($nombreEq) ){
			$queryBuilder->andWhere("c.nombre = '$nombreEq'");
		}
		
		$apellidoEq = $criteria->getApellidoEqual();
		if( !empty($apellidoEq) ){
			$queryBuilder->andWhere("c.apellido = '$apellidoEq'");
		}
		
		

		$nroDocumento = $criteria->getNroDocumento();
		if( !empty($nroDocumento) ){
			$queryBuilder->andWhere("c.nroDocumento = '$nroDocumento'");
		}

		$tipoDocumento = $criteria->getTipoDocumento();
		if( !empty($tipoDocumento) ){
			$queryBuilder->andWhere("c.tipoDocumento = '$tipoDocumento'");
		}		

		$nombreApellido = $criteria->getNombreApellido();
		if( !empty($nombreApellido) ){
			$queryBuilder->andWhere( "concat(c.apellido,' ', c.nombre) like :nombreApellido");
			$queryBuilder->setParameter("nombreApellido", "%$nombreApellido%" );
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "c.$name";	
		}	
		
	}	
}