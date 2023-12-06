<?php
require_once '/xampp/htdocs/BreakBdy/CONFIGURACIONES/config.php';
// traemos un archivo con los datos para el ingreso a la base de datos

        //creamos la cadena de conexion para la base de datos

        $cadenConexion = "mongodb://" .
        $db_components['usuario'] . ":" . 
        $db_components['contraseña'] . "@" .
        $db_components['servidor'] . ":" .
        $db_components['puerto'] . "/" .
        $db_components['baseDatos'];

        //seleccion de la base de datos y la coleccion donde buscara la informacion

        require_once '/xampp/htdocs/BreakBdy/vendor/autoload.php';

        $clients = new MongoDB\Client($cadenConexion);
        $breakbdy = $clients->selectDatabase("BREAKBDY");
        // require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';

        ?>