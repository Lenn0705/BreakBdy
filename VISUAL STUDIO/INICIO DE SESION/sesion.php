<?php

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
require_once '/xampp/htdocs/BreakBdy/CONFIGURACIONES/config.php';

if(isset($_POST['iniciar_sesion'])){

    // extraemos los datos ingresados

    $usuarioBreak = $_POST['NombUsuario'];
    $contraseñaBreak = $_POST['contraseña'];

require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
        $datos = $breakbdy->selectCollection("usuario");
        
        $usser = $datos ->FindOne(['usuarioBreak' => $usuarioBreak]);

        if($usser){

            $hash = $usser['contraseñaBreak'];
            if(password_verify($contraseñaBreak, $hash)){

            //datos ingresados correctamente

            //inicia una sesion
            session_start();
            //guarda el dato del usuario para mas adelante
            $_SESSION['usuarioBreak'] = $usuarioBreak;
            $_SESSION['contraseñaBreak'] = $contraseñaBreak;
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