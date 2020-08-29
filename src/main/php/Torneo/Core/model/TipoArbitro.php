<?php
namespace Torneo\Core\model;

/**
 * Tipo de arbitro 
 *  
 * @author Marcos
 * @since 17-08-2020
 */

class TipoArbitro  {
    
    const Principal = 1;
    const Linea1 = 2;
    const Linea2 = 3;
    const Cuarto = 4;
    const delvar = 5;
   
 
    private static $items = array( self::Principal => "tipo.arbitro.principal.label", 
    								   self::Linea1 => "tipo.arbitro.linea1.label",
    								   self::Linea2 => "tipo.arbitro.linea2.label",
    								   self::Cuarto => "tipo.arbitro.cuarto.label",
    								   self::delvar => "tipo.arbitro.delvar.label",);
    
	public static function getItems(){
		return self::$items;
	}
	
	public static function getLabel($value){
		if(array_key_exists($value, self::$items))
			return self::$items[$value];
	}
}
?>
