<?php
namespace Torneo\Core\model;

/**
 * Tipo de jugador 
 *  
 * @author Marcos
 * @since 17-08-2020
 */

class TipoJugador  {
    
    const Arquero = 1;
    const Defensor = 2;
    const Medio = 3;
    const Delantero = 4;
   
 
    private static $items = array( self::Arquero => "tipo.jugador.arquero.label", 
    								   self::Defensor => "tipo.jugador.defensor.label",
    								   self::Medio => "tipo.jugador.medio.label",
    								   self::Delantero => "tipo.jugador.delantero.label",);
    
	public static function getItems(){
		return self::$items;
	}
	
	public static function getLabel($value){
		if(array_key_exists($value, self::$items))
			return self::$items[$value];
	}
}
?>
