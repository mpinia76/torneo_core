<?php
namespace Cuentas\Core\service\impl;

use Cuentas\Core\criteria\ClienteCriteria;

use Cuentas\Core\dao\DAOFactory;

use Cuentas\Core\service\IClienteService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para cliente
 *  
 * @author Bernardo
 * @since 23-05-2014
 *
 */
class ClienteServiceImpl extends CrudService implements IClienteService {

	/**
	 * redefino el add para agregar la cuenta corriente al
	 * cliente.
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){
		
		$entity->setFechaAlta( new \Datetime() );
		
		//agregamos el cliente.
		parent::add($entity);
		
		//TODO agregamos su cuenta corriente.

	}
	
	
	protected function getDAO(){
		return DAOFactory::getClienteDAO();
	}
	
	
	function validateOnAdd( $entity ){

		//que tenga apellido
		$apellido = $entity->getApellido();
		if( empty($apellido) )
			throw new ServiceException("apellido.nombre.required");
		
		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException("cliente.nombre.required");

		//si tiene tipo + nro documento, que no se repita.
		$tipoDocumento = $entity->getTipoDocumento();
		$nroDocumento = $entity->getNroDocumento();
		if( !empty($nroDocumento) ){
			
			if( $this->existsByDocumento($tipoDocumento, $nroDocumento, $entity->getOid()) )
				
				throw new DuplicatedEntityException("cliente.documento.unicity");
				
		}else{
			//si no tiene documento, que no exista otro con mismo nombre+apellido y sin documento.
			if( $this->existsByNombreApellido($nombre,$apellido,$tipoDocumento, $nroDocumento, $entity->getOid()) )
				
				throw new DuplicatedEntityException("cliente.nombre.apellido.unicity");
		}
		
		
	}
	
	/**
	 * Retorna true si existe un cliente dado un tipo y número de documento. 
	 * @param TipoDocumento $tipo
	 * @param string $numero
	 */
	private function existsByDocumento($tipo, $numero, $oid=null){
	
		$criteria = new ClienteCriteria();
		$criteria->setNroDocumento($numero);
		$criteria->setTipoDocumento($tipo);
		$criteria->setOidNotEqual($oid);
		
		$exists = false;
		
		try{
			
			$cliente = $this->getSingleResult( $criteria );
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
	 * Retorna true si existe un cliente dado un nombre pero
	 * que no tenga documento. 
	 * @param string $nombre
	 * @param TipoDocumento $tipo
	 * @param string $numero
	 */
	private function existsByNombreApellido($nombre, $apellido, $tipoDocumento, $nroDocumento, $oid=null){
	
		$criteria = new ClienteCriteria();
		$criteria->setNombreEqual($nombre);
		$criteria->setApellidoEqual($apellido);
		$criteria->setNroDocumento($nroDocumento);
		$criteria->setTipoDocumento($tipoDocumento);
		$criteria->setOidNotEqual($oid);
	
		$exists = false;
		
		try{
			
			$cliente = $this->getSingleResult( $criteria );
			
			\Logger::getLogger(__CLASS__)->info("cliente encontrado por nombre y apellido. ");
			
			$exists = true;
			
		}catch (ServiceNonUniqueResultException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = true;
		
		}catch (ServiceException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = false;
		
		}catch (\Exception $ex){
			\Logger::getLogger(__CLASS__)->info("error buscando por nombre y apellido. " . $ex->getMessage());
			$exists = false;
		}
		return $exists;
	}
	
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


}	