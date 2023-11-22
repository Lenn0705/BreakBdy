<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="stylesheet" href="CrearTarea.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
</head>
<body>
    <div id="menu-barra" class="col-md-1">
        <a href="../MENU USUARIO/Usuario.html"><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU EVENTO/Evento.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
        <a href="#Tarea.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
        <a href="#Descansos.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU EVENTO/Evento.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
        <a href="../Compromiso.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
        <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
      </div>

    <div class="col-md-1" >
        <form method="post" action="CrearTarea.php" id="Formulario">
        <section class="">
            
        <label for="Nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        </section>
        <section>
            <label for="descripcion">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion">
        </section>
        <section>
            <label for="HoraInicial">Hora Inicial:</label>
            <input type="time" name="HoraInicial" id="Hora">
            <label for="HoraFinal">Hora Final:</label>
            <input type="time" name="HoraFinal" id="Hora">
        </section>
        <section>
        <label for="Prioridad">Prioridad:</label><select name="Prioridad" id="Prioridad">
            <option value="Baja">Baja</option>
            <option value="Alta">Alta</option>
        </select>
        </section>
        <section>
         <label for="Fecha">Fecha:</label>
         <input type="date" name="fecha" id="fecha">
        </section>
        <section class="botones-control">
            <input type="submit" class="boton" value="+"></input>
            <a class="boton" href="../Tareas.html">←</a>
        </section>
        </form>
    </div>
</body>
</html>

<?php 
session_start();
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
use MongoDB\Operation\InsertOne;
// traemos un archivo con los datos para el ingreso a la base de datos
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
// insertamos los datos del formulario

$nombreTarea = $_POST['nombre'];
$descripcionTarea = $_POST['descripcion'];
$prioridadTarea = $_POST['Prioridad'];
$horaFinal = $_POST['HoraFinal'];
$horaInicial = $_POST['HoraInicial'];
$fechaTarea = $_POST['fecha'];

try{

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

// convertimos los datos en una coleccion

$datosTarea = [
    'asignado' =>$_SESSION['usuarioBreak'],
    'nombreTarea' => $nombreTarea,
    'descripcionTarea' => $descripcionTarea,
    'prioridadTarea' => $prioridadTarea,
    'fechaTarea' => $fechaTarea,
    'hora' => [
        'horaInicial' => $horaInicial,
        'horaFinal'=> $horaFinal
    ],
    '_id' => uniqid()
    ];

    //insertamos los datos

    $insertarTarea = $tareas ->insertOne($datosTarea);

if($insertarTarea){
    echo "AGENDADO!!!";
}else{
    echo "ups, hubo un problema agendando";
}
}catch(\Throwable $e){
    echo "Error: " . $e->getMessage();
}

 }
?>