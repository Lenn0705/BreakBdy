<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Tareas.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
</head>
<body>
    <script src="Tareas.js"></script>
    <div id="menu-barra" class="col-md-1">
    <a href="../MENU USUARIO/Usuario.php"><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="../MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="../MENU TAREAS/Tareas.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="../MENU DESCANSOS/Descansos.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="../MENU EVENTO/Evento.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
    <a href="../MENU COMPROMISOS/Compromiso.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
    <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
  </div>
<!-- abrimos etiqueta php para generar una consulta y hacer un ciclo -->

<?php 
session_start();

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
use MongoDB\Operation\InsertOne;
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';

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

// definimos la coleccion de las tareas

$tareas = $breakbdy ->selectCollection('tareas');

$especificacion = ['asignado' => $_SESSION['usuarioBreak']];
$consultaTarea = $tareas ->find($especificacion);
$resultadoConsultaTarea = $consultaTarea ->toArray();

?>


  <div id="menu-barra-der">
    <section id="Tarea" name="Tarea">
    
      <?php foreach($resultadoConsultaTarea as $documento){?>
          <a href="../MENU TAREAS/EDITAR TAREA/EditarTarea.html">
            <?php echo $documento['nombreTarea']. "<br>"; ?>
            <p><?php echo $documento['descripcionTarea']. "<br>";?></p>
            <p><?php echo $documento['hora']['horaInicial'] . " - " . $documento['hora']['horaFinal']. "<br>"; ?></p>
            <p><?php echo $documento['fechaTarea'];?></p></a>
        <?php }?>
    </section>

    <div id="barra-control">
     <section id="control">
        <button onclick="location.href='/xampp/BreakBdy/VISUAL STUDIO/MENU TAREAS/CREAR TAREA/CrearTarea.php'">Crear Tarea
      </button>
        <button
         onclick="location.href='/VISUAL%20STUDIO/MENU%20TAREAS/ELIMINAR%20TAREA/EliminarTarea.html'">Eliminar Tarea
        </button>
     </section>
    </div>
  
  </div>
  

</body>
</html>