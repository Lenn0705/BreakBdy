<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="stylesheet" href="EditarTarea.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="EditarTarea.js"></script>
    <title>Editar Tarea</title>
</head>
<body>

<?php
session_start();

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
use MongoDB\Operation\InsertOne;
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/MENU TAREAS/TAREAS.php';
include '../TAREAS.php';

$id = $_GET['id'];

// definimos la coleccion de las tareas

$tareas = $breakbdy ->selectCollection('tareas');

// consultamos los datos existentes

$especificacion = ['id'=> $id,'asignado' => $_SESSION['usuarioBreak']];
$consultaTarea = $tareas ->find($especificacion);
$resultadoConsultaTarea = $consultaTarea ->toArray();



?>

    <div id="menu-barra">
    <a href="Menu.html" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU PRINCIPAL/Menu.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="#Tarea.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="#Descansos.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU EVENTO/Evento.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
    <a href="../Compromiso.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
    <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
  </div>

    <div class="col-md-1" >
        <form action="EditarTarea.php" method="post" id="Formulario">
        <section class="">
            
        <label for="Nombre">Tarea:</label>
        <input type="text" name="nombre" id="nombre" value=<?php echo $resultadoConsultaTarea['nombreTarea'];?>>
        </section>
        <section>
            <label for="Prioridad">Prioridad:</label>
            <select name="Prioridad" id="Prioridad" value=<?php echo $resultadoConsultaTarea['prioridadTarea'];?>>
                <option value="0">Baja</option>
                <option value="1">Alta</option>
            </select>
        </section>
        <section>
            <label for="Descripcion">Descripcion:</label>
            <input type="text" name="descripcion" value=<?php echo "<p>".$resultadoConsultaTarea['descripcionTarea'] . "</p>";?>>
        </section>
        <section>
            <label for="HoraInicial">Hora Inicial:</label>
            <input type="time" name="horaInicial" value=<?php echo "<p>".$resultadoConsultaTarea['horaInicial'] . "</p>";?>>
            <label for="HoraFinal">Hora Final:</label>
            <input type="time" name="horaFinal" value=<?php echo "<p>".$resultadoConsultaTarea['horaFinal'] . "</p>";?>>
        </section>
        <section>
<label for="Fecha">Fecha:</label>
<input type="date" name="Fecha" id="Fecha" value=<?php echo $resultadoConsultaTarea['fechaTarea'];?>>
        </section>
        <section class="botones-control">
        <a class="boton" href="../Tareas.html">←</a>
        <input type="submit" value="Editar"  class="boton2" name="editar">
        </section>
    </form>
    </div>

</body>
</html>

<?php
if(isset($_POST['editar'])){
$nuevonombreTarea = $_POST['nombre'];
$nuevodescripcionTarea = $_POST['descripcion'];
$nuevoprioridadTarea = $_POST['Prioridad'];
$nuevohoraFinal = $_POST['HoraFinal'];
$nuevohoraInicial = $_POST['HoraInicial'];
$nuevofechaTarea = $_POST['Fecha'];

try{

    $datosnuevos = [
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

$crit = ['asignado' => $_SESSION['usuarioBreak'], 'nombreTarea' =>$resultadoConsultaTarea['nombreTarea']];
        $busqueda = $coleccion ->replaceOne($criterios_busqueda, $datosnuevos);

if ($busqueda->getModifiedCount() > 0) {
    echo "LOS DATOS SE HAN AGENDADO SATISFACTORIAMENTE .\n";
    header('Location:../INICIO DE SESION/iniciarSesion.php');
} else {
    echo "LOS DATOS NO SE HAN REEMPLAZADO SATISFACTORIAMENTE .\n";
}
}catch(\Throwable $e){
    echo "Error: " . $e->getMessage();
}
}
?>