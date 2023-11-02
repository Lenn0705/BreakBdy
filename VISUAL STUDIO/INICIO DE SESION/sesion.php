<?php

use MongoDB\Operation\FindOne;

if($_SERVER['REQUEST_METHOD']== 'POST'){

    // funcion que reconocera los datos como validos o invalidos

    function IniciarSesion(){

    
        // extraemos los datos ingresados

        $usuario = $_POST['NombUsuario'];
        $contraseña = $_POST['contraseña'];

        //creamos la cadena de conexion para la base de datos

        $servidor = 'localhost';
        $baseDatos = "BREAKBDY";
        $puerto = "27017";
        $cadenConexion = "mongodb://" .
        $usuario . ":" . 
        $contraseña . "@" .
        $servidor . ":" .
        $puerto . "/" .
        $baseDatos;

        //seleccion de la base de datos y la coleccion donde buscara la informacion

        $clients = new MongoDB\Client($cadenConexion);
        $breakbdy = $clients->selectDatabase("BREAKBDY");

        $datos = $breakbdy->selectCollection("usuario");
        $usser = $datos ->FindOne($usuario , $contraseña);

        if($usser){
            //datos ingresados correctamente
            header('Location:Menu.php');
        }else{
            //datos ingresados incorrectamente
            echo "<h3 class='titulos'>Este usuario o contraseña no esta agendado con nosotros</h3>";
        }
        }

}
IniciarSesion();

?>