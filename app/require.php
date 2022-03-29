<?php 
    //Archivo necesario para el control de rutas (existentes y no existentes)
    require_once 'libraries/Core.php';
    //Clase padre; heredará sus métodos a cualquier controlador existente (que extienda de él)
    require_once 'libraries/Controller.php';
    //Clase necesaria para abrir las conexiones a la base de datos (y manipularla gracias a los métodos creados en ella)
    require_once 'libraries/Database.php';

    //Constantes necesarias para la conexión a la base de datos
    require_once 'config/config.php';
    
    //Cada vez que este archivo (REQUIRE.PHP) sea llamado (en INDEX.php), se ejecturá de forma automática la validación (filtro) de URLs
    $init = new Core();
?>