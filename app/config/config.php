<?php
    //Constantes utilizadas para la conexión a la base de datos (es raro que cambie, así que, es preferible que su modificación sea prohibida - NATURALEZA DE LAS CONSTANTES)
    define('DB_HOST', 'localhost');
    define('DB_USER', 'postgres');
    define('DB_PASS', "1234567A");
    define('DB_NAME', 'QueSazon');
    define('DB_PORT', '5432');

    //Dirección raíz (utilizada para localización local)
    define('APPROOT', dirname(dirname(__FILE__)));
    //Dirección raíz (utilizada para localización en internet (cuando esté hospedado en el HOST))
    define('URLROOT', 'localhost/quesazon');
    //Nombre del sitio web
    define('SITENAME', 'Qué Sazón');
?>