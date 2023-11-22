<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="Usuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
</head>
<body>
    <div id="menu-barra">

        <a href="../MENU USUARIO/Usuario.html" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"><p id="texto">Usser</p></a>
        <a href="../MENU PRINCIPAL/Menu.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"><p id="texto">Inicio</p></a>
        <a href="../MENU TAREAS/Tareas.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"><p id="texto">Tareas</p></a>
        <a href="../MENU DESCANSOS/Descansos.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
        <a href="../MENU EVENTO/Evento.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"><p id="texto">Eventos</p></a>
        <a href="../MENU COMPROMISOS/Compromiso.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"><p id="texto">Compromiso</p></a>
        <a href="#" id="expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
    
       
      </div>
      <div class="menu-der-usser">
        <a href="#Cambiar imagen de perfil"><img src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=""></a>
       <?php
       session_start();

       use MongoDB\BSON\ObjectId;
       use MongoDB\Model\BSONDocument;
       use MongoDB\Operation\FindOne;
       use MongoDB\Operation\InsertOne;

       require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';
       echo "<h1>{$_SESSION['usuarioBreak']}</h1>"; ?>

<div class="menu-der-usser">
    <div class="menu-der-usser-extra">
        <form action="Usuario.php" method="post">
    <section>
        <label for="Nombre">Nombre Real:</label>
        <Input type="text" name="Nombre"></Input>
    </section>
    <section>
        <label for="Apellido">Apellido Real:</label>
        <Input type="text" name="Apellido"></Input>
    </section>
    <div class="menu-der-usser-extra">
    <section>
        <label for="Usuario">Nombre de Usuario:</label>
        <Input type="text" name="Usuario"></Input>
    </section>
    <section>
        <label for="Contraseña">Contraseña:</label>
        <Input type="password" name="Contraseña"></Input>
    </section>
    <section>
        <label for="Correo">Correo:</label>
        <Input type="text" name="Correo"></Input>
    </section>
    <section>
        <Input type="submit" name="Cambiar_datos" value="modificar datos"></Input>
    </section>
    </form>
       </div>
    </div>
</div>
<div>
    <section id="barra-control">
        <form action="Usuario.php" method="post">
        <input type="submit" name = "cerrar_sesion" id = "boton_cerrar_sesion"></Input>
        </form>
        <button>←</button>
    </section>
  </div>
      </div>

</body>
</html>

<?php
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Operation\ReplaceOne;
use MongoDB\Operation\FindOneAndReplace;

//boton para cerrar sesion

if(isset($_POST['cerrar_sesion'])){
    session_destroy();
    
}

if(isset($_POST['Cambiar_datos'])){

    $nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Usuario = $_POST['Usuario'];
    $Contraseña = $_POST['Contraseña'];
    $Correo = $_POST['Correo'];

try{

require_once '../BreakBdy/CONFIGURACIONES/config.php';

$cadenConexion = "mongodb://" .
$db_components['usuario'] . ":" . 
$db_components['contraseña'] . "@" .
$db_components['servidor'] . ":" .
$db_components['puerto'] . "/" .
$db_components['baseDatos'];
    
require_once '/xampp/htdocs/BreakBdy/vendor/autoload.php';

    $cliente = new MongoDB\Client($cadenConexion);
    $breakbdy = $cliente ->selectDatabase('BREAKBDY');
    $coleccion = $breakbdy -> selectCollection('usuarios');

    $datos_cambiados = [
        'nombreReal' => $nombre,
        'ApellidosReales' => $Apellido,
        'usuarioBreak' => $Usuario,
        'contraseñaBreak' => password_hash($Contraseña, PASSWORD_DEFAULT),
        'CorreoElectronico' => $Correo,
    ];

    $criterios_busqueda = [
        'usuarioBreak' => $_SESSION('usuarioBreak')
    ];

$busqueda = $coleccion ->replaceOne($criterios_busqueda, $datos_cambiados);

if ($busqueda->getModifiedCount() > 0) {
    echo "LOS DATOS SE HAN AGENDADO SATISFACTORIAMENTE .\n";
    header('Location:../INICIO DE SESION/iniciarSesion.php');
} else {
    echo "LOS DATOS NO SE HAN REEMPLAZADO SATISFACTORIAMENTE .\n";
}

    }catch(\Throwable $th){
        echo "Error: " . $th->getMessage();
    }
}



?>