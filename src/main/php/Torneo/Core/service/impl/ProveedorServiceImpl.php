<?php
namespace Cuentas\Core\service\impl;

use Cuentas\Core\service\ServiceFactory;

use Cuentas\Core\model\CuentaCorriente;

use Cuentas\Core\criteria\ProveedorCriteria;

use Cuentas\Core\dao\DAOFactory;

use Cuentas\Core\service\IProveedorService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para proveedor
 *  
 * @author Bernardo
 * @since 10-06-2014
 *
 */
class ProveedorServiceImpl extends CrudService implements IProveedorService {

	/**
	 * redefino el add para agregar la cuenta corriente al
	 * proveedor.
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){
		
		$entity->setFechaAlta( new \Datetime() );
		
		//agregamos el proveedor.
		parent::add($entity);
		
		//agregamos su cuenta corriente.
		$ctacte = new CuentaCorriente();
		$ctacte->setFecha( new \Datetime() );
		$ctacte->setNumero( $entity->getOid() );
		$ctacte->setPersona( $entity );
		$ctacte->setSaldoInicial( 0 );

		ServiceFactory::getCuentaCorrienteService()->add( $ctacte );		

	}
	
	
	protected function getDAO(){
		return DAOFactory::getProveedorDAO();
	}
	
	
	function validateOnAdd( $entity ){
	
		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException("proveedor.nombre.required");

		//si tiene tipo + nro documento, que no se repita.
		$tipoDocumento = $entity->getTipoDocumento();
		$nroDocumento = $entity->getNroDocumento();
		if( !empty($nroDocumento) ){
			
			if( $this->existsByDocumento($tipoDocumento, $nroDocumento, $entity->getOid()) )
				
				throw new DuplicatedEntityException("proveedor.documento.unicity");
				
		}else{
			//si no tiene documento, que no exista otro con mismo nombre y sin documento.
			if( $this->existsByNombre($nombre,$tipoDocumento, $nroDocumento, $entity->getOid()) )
				
				throw new DuplicatedEntityException("proveedor.nombre.unicity");
		}
		
		
	}
	
	/**
	 * Retorna true si existe un proveedor dado un tipo y número de documento. 
	 * @param TipoDocumento $tipo
	 * @param string $numero
	 */
	private function existsByDocumento($tipo, $numero, $oid=null){
	
		$criteria = new ProveedorCriteria();
		$criteria->setNroDocumento($numero);
		$criteria->setTipoDocumento($tipo);
		$criteria->setOidNotEqual($oid);
		
		$exists = false;
		
		try{
			
			$proveedor = $this->getSingleResult( $criteria );
			$exists = true;
			
		}catch (ServiceNonUniqueResultException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = true;
		
		}catch (ServiceException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = false;
		
		}catch (\Exception $ex){
			\Logger::getLogger(__CLASS__)->info("error buscando por documento. " . $ex->getMessage());
			$exists = false;
		}
		return $exists;
	}
	
	/**
	 * Retorna true si existe un proveedor dado un nombre pero
	 * que no tenga documento. 
	 * @param string $nombre
	 * @param TipoDocumento $tipo
	 * @param string $numero
	 */
	private function existsByNombre($nombre, $tipoDocumento, $nroDocumento, $oid=null){
	
		$criteria = new ProveedorCriteria();
		$criteria->setNombreEqual($nombre);
		$criteria->setNroDocumento($nroDocumento);
		$criteria->setTipoDocumento($tipoDocumento);
		$criteria->setOidNotEqual($oid);
	
		$exists = false;
		
		try{
			
			$proveedor = $this->getSingleResult( $criteria );
			
			\Logger::getLogger(__CLASS__)->info("proveedor encontrado por nombre. ");
			
			$exists = true;
			
		}catch (ServiceNonUniqueResultException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = true;
		
		}catch (ServiceException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = false;
		
		}catch (\Exception $ex){
			\Logger::getLogger(__CLASS__)->info("error buscando por nombre. " . $ex->getMessage());
			$exists = false;
		}
		return $exists;
	}
	
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


}	