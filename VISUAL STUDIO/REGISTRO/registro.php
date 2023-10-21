<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/rama-de-samuel/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="breakbdy.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img id="logo" src="/VISUAL STUDIO/IMAGENES BREAKBDY/Imagen-logo.jpeg" alt="">
    <h1 class="titulos">El registro ha sido exitoso</h1>
    <a class="boton" href="../INICIO DE SESION/sesion.html">Volver a Iniciar Sesion</a>
</body>
</html>

<?php

class Conexion{
public function conectar(){
    try{
        $servidor = 'localhost';
        $usuario = " ";
        $contraseña = " ";
        $baseDatos = "BREAKBDY";
        $puerto = "27017";
    
        $cadenConexion = "mongodb://" .
        $usuario . ":" . 
        $contraseña . "@" .
        $servidor . ":" .
        $puerto . "/" .
        $baseDatos;
    
        $cliente = new MongoDB\Client($cadenConexion)
        return $cliente->selectDatabase($baseDatos);
    }catch(\Trhowable $th){
return $th->getmessage();
    }

}
}


$conexion = mysqli_connect('localhost', 'root' , '' , 'breakbdy')or die(mysqli_error($mysqli));

datos($conexion);

function datos($conexion){
    $nombreReal = $_POST['NombReal'];
    $nacimiento = $_POST['fecha'];
    $usuarioBreak = $_POST['NombUsuario'];
    $correo = $_POST['Correo'];
    $apellidoReal = $_POST['ApellReal'];
    $contra = $_POST['contraseña'];


    $meterDatos = "INSERT INTO registro(correoUsuario, nombreReal , ApellidoReal, fechaNacimiento , nombreUsuario , contraseñaUsuario)
    VALUES ('$correo' , '$nombreReal' , '$apellidoReal' , '$nacimiento' , '$usuarioBreak' , '$contra')";
    mysqli_query($conexion , $meterDatos);
    mysqli_close($conexion);
}

