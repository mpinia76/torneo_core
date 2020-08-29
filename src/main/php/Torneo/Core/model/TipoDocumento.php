<?php
namespace Torneo\Core\model;

/**
 * Tipo de documento 
 *  
 * @author Marcos
 * @since 17-08-2020
 */

class TipoDocumento  {
    
    const DNI = 1;
    const LibretaEnrolamiento = 2;
    const LibretaCivica = 3;
    const Pasaporte = 4;
    const CedulaIdentidad = 5;
 
    private static $items = array( self::DNI => "tipo.documento.dni.label", 
    								   self::LibretaEnrolamiento => "tipo.documento.le.label",
    								   self::LibretaCivica => "tipo.documento.lc.label",
    								   self::CedulaIdentidad => "tipo.documento.ci.label",
    								   self::Pasaporte => "tipo.documento.pasaporte.label",);
    
	public static function getItems(){
		return self::$items;
	}
	
	public static function getLabel($value){
		if(array_key_exists($value, self::$items))
			return self::$items[$value];
	}
}
?>
