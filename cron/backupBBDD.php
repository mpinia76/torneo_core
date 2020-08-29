<?php


include_once  dirname(__DIR__) . '/vendor/autoload.php';


use Torneo\Core\conf\TorneoConfig;
use Cose\persistence\PersistenceContext;
use Torneo\Core\notificaciones\backupBBDD\BackupBBDD;

//inicializamos cuentas core.
TorneoConfig::getInstance()->initialize();
TorneoConfig::getInstance()->initLogger( dirname(__FILE__).  "/log4php.xml");
				
$persistenceContext =  PersistenceContext::getInstance();


$notificacion = new BackupBBDD();
$notificacion->send();

//cerramos la conexión a la base.
$persistenceContext->close();
    



?>