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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
/*Extraccion de datos*/

    $nombreReal = $_POST['NombReal'];
    $apellidos = $_POST['ApellReal'];
    $nacimiento = $_POST['fecha'];
    $correo = $_POST['Correo'];
    $UsuarioBreak = $_POST['NombUsuario'];
    $ContraseñaBreak = $_POST['contraseña'];

    try{

        //creamos la cadena de conexion para la base de datos

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

        //creamos la variable de conexion con la base de datos
        //definimos la variable breakbdy como la base de datos del cliente
        //definimos la variable usuario como la coleccion dentro de la base de datos

        $clients = new MongoDB\Client($cadenConexion);
        $breakbdy = $clients->selectDatabase("BREAKBDY");
        $usuario = $breakbdy->selectCollection("usuario");

        /*Conversion de los datos a un arreglo */

        $registro = [
            'nombreReal' => $nombreReal,
         'ApellidosReales' => $apellidos,
         'fechaNacimiento' => $nacimiento,
         'CorreoElectronico' => $correo,
         'usuarioBreak' => $UsuarioBreak,
         'contraseñaBreak' => $ContraseñaBreak
        ];
    
        $usuario ->insertOne($registro);


        return "<h1 class='titulos'>El registro ha sido exitoso</h1>";
    }catch(\Throwable $th){
return $th->getmessage();
    }
}
}
}




