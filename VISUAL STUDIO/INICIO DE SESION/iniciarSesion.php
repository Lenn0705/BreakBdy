<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="sesion.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
</head>
<body >
<form action="iniciarSesion.php" method="post">
    <h1 class="titulos">Bienvenido a BreakBdy</h1>
    <img id="logo" src="/VISUAL STUDIO/IMAGENES BREAKBDY/Imagen-logo.jpeg" alt="">
    <input name="NombUsuario" class="entradas" type="text" placeholder="Escriba el usuario">
    <label class="titulos" for="titulos">Ingrese Su usuario BreakBdy</label>

  
    <input name="contraseña" class="entradas" type="password" placeholder="Escriba la contraseña">
    <label for="contraseña" class="titulos">Ingrese su contraseña BreakBdy</label>

    <select name="Rol" class="entradas" id="rol">
    <option value="Administrador">Administrador</option>
    <option value="Usuario">Usuario</option>
    </select>

    <input type="submit" value="Ingresar" name="iniciar_sesion" class="boton">
    
     <a name="breakbdy" class="tituloInferior" href="https://www.breakbdy.com">Olvidaste tu contraseña?...</a>
     <a name="breakbdy" class="tituloInferior" href="/VISUAL STUDIO/REGISTRO/breakbdy.html">No te has agendado con nosotros..</a>
    </form>
</body>
</html>

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
    $rol = $_POST['Rol'];

    if(empty($usuarioBreak) or empty($contraseñaBreak)){
        echo "<h3 class='titulos'>ESTOS CAMPOS SON REQUERIDOS</h3>";
    }

require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
        $datos = $breakbdy->selectCollection("usuario");
        
        $usser = $datos ->FindOne(['usuarioBreak' => $usuarioBreak, 'Rol' => $rol]);

        if($usser){

            $hash = $usser['contraseñaBreak'];
            if(password_verify($contraseñaBreak, $hash)){

            //datos ingresados correctamente

            //inicia una sesion
            session_start();
            //guarda el dato del usuario para mas adelante
            $_SESSION['usuarioBreak'] = $usuarioBreak;
            $_SESSION['contraseñaBreak'] = $contraseñaBreak;
            $_SESSION['Rol'] = $rol;
            header('Location:../SLIDE INICIO DE SESION/Slide.php');
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