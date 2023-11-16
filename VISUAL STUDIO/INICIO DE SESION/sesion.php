<?php

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
require_once '/xampp/htdocs/BreakBdy/CONFIGURACIONES/config.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){

    // extraemos los datos ingresados

    $usuarioBreak = $_POST['NombUsuario'];
    $contraseñaBreak = $_POST['contraseña'];

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
        $datos = $breakbdy->selectCollection("usuario");
        
        $usser = $datos ->FindOne(['usuarioBreak' => $usuarioBreak]);

        if($usser){

            $hash = $usser['contraseñaBreak'];
            if(password_verify($contraseñaBreak, $hash)){

                            //datos ingresados correctamente
            session_start();
            $_SESSION['usuario'] = $usuarioBreak;
            header('Location:../MENU PRINCIPAL/Menu.php');
            exit;
            }else{
                echo "<h3 class='titulos'>Esta contraseña no es valida</h3>";
            }
     
        }else{
            //datos ingresados incorrectamente
            echo "<h3 class='titulos'>Este usuario no esta agendado con nosotros</h3>";
        }
        }




?>