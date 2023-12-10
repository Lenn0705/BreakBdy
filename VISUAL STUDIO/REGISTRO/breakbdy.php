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
    <title>Registro BreakBdy</title>
</head>
<body >
    
<form action="breakbdy.php" method="post">
    <img id="logo" src="/VISUAL STUDIO/IMAGENES BREAKBDY/Imagen-logo.jpeg" alt="">
    
    <input type="text" name="NombReal" id="" class="entradas" placeholder="ingrese su Nombre real">
    <label for="NombReal" class="titulos">Ingrese sus Nombres</label>

    <input type="text" name="ApellReal" id="" class="entradas" placeholder="ingrese su Apellido real">
    <label for="ApellReal" class="titulos">Ingrese sus Apellido</label>

    <input type="date" name="fecha" id="" class="entradas">
    <label for="fecha" class="titulos">Ingrese su Fecha de nacimiento</label>

    <input type="text" name="Correo" id="" class="entradas" placeholder="ingrese su Correo">
    <label for="Correo" class="titulos">Ingrese su Correo</label>

    <input name="NombUsuario" class="entradas" type="text" placeholder="Escriba el Usuario">
    <label class="titulos" for="titulos">Ingrese Su usuario BreakBdy</label>

    <select name="Rol" class="entradas" id="rol">
    <option value="Administrador">Administrador</option>
    <option value="Usuario">Usuario</option>
    </select>

    <input name="contraseña" class="entradas" type="password" placeholder="Escriba la Contraseña">
    <label for="contraseña" class="titulos">Ingrese su contraseña BreakBdy</label>

    <input type="submit" value="Ingresar" class="boton">
    
    <label for="breakbdy" class="tituloInferior">Ya tienes un usuario?</label>
     <a class="tituloInferior" href="../INICIO DE SESION/iniciarSesion.php">Inicia sesion con nosotros</a>

    </form>
</body>
</html>

<?php

//elementos requeridos
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;

require_once '/xampp/htdocs/BreakBdy/CONFIGURACIONES/config.php';

function conectar($db_components){
    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
/*Extraccion de datos*/

    $nombreReal = $_POST['NombReal'];
    $rol = $_POST['Rol'];
    $apellidos = $_POST['ApellReal'];
    $nacimiento = $_POST['fecha'];
    $correo = $_POST['Correo'];
    $UsuarioBreak = $_POST['NombUsuario'];
    $ContraseñaBreak = $_POST['contraseña'];

    if(empty($nombreReal) || empty($apellidos) || empty($nacimiento) || empty($correo) || empty($UsuarioBreak) || empty($ContraseñaBreak)){
        echo "<h3 class='titulos'>TODOS LOS CAMPOS SON REQUERIDOS</h3>";
        
    }else{

    try{


        //creamos la cadena de conexion para la base de datos



        $cadenConexion = "mongodb://" .
        $db_components['usuario'] . ":" . 
        $db_components['contraseña'] . "@" .
        $db_components['servidor'] . ":" .
        $db_components['puerto'] . "/" .
        $db_components['baseDatos'];

        //creamos la variable de conexion con la base de datos
        //definimos la variable breakbdy como la base de datos del cliente
        //definimos la variable usuario como la coleccion dentro de la base de datos

        require_once '/xampp/htdocs/BreakBdy/vendor/autoload.php';

        $clients = new MongoDB\Client($cadenConexion);
        $breakbdy = $clients->selectDatabase("BREAKBDY");

        $usser = $breakbdy->selectCollection("usuario");

        /*Conversion de los datos a un arreglo */

        $registro = [
         'nombreReal' => $nombreReal,
         'ApellidosReales' => $apellidos,
         'fechaNacimiento' => $nacimiento,
         'CorreoElectronico' => $correo,
         'Rol' => $rol,
         'usuarioBreak' => $UsuarioBreak,
         'contraseñaBreak' => password_hash($ContraseñaBreak, PASSWORD_DEFAULT),
         '_id' => uniqid(),
        ];
        
        $usser ->insertOne($registro);

        echo "<h1 class='titulos'>El registro ha sido exitoso</h1>";
        echo "   <a class='boton' href='../INICIO DE SESION/iniciarSesion.php'>Volver a Iniciar Sesion</a>";
    }catch(\Throwable $th){
        echo "Error: " . $th->getMessage();
    }}
}
}
conectar($db_components);
?>