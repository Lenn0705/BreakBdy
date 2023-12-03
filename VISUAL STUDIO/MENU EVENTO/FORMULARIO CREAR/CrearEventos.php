<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="stylesheet" href="CrearEvento.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo evento</title>
</head>
<body>
    <div id="menu-barra">
    <a href="Usuario.php" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU TAREAS/TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="../Eventos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU COMPROMISOS/Compromisos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
    <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
  </div>

    <div class="col-md-1" >
        <form action="CrearEventos.php" method="post" id="Formulario">
        <section class=""> 
        <label for="Nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        </section>
        <section>
            <label for="Descripcion">Descripcion:</label>
            <input type="text" name="descripcion" id="Nombre">
        </section>
        <section>
            <label for="Hora">Hora:</label>
            <input type="time" name="Hora" id="Hora">
        </section>
        <section>
        <label for="Prioridad">Prioridad:</label><select name="Prioridad" id="Prioridad">
            <option value="Baja">Baja</option>
            <option value="Media">Media</option>
            <option value="Alta">Alta</option>
        </select>
        </section>
        <section>
        <label for="Fecha">Fecha:</label>
        <input type="date" name="Fecha" id="Fecha">
        </section>
        <section class="botones-control">
            <a class="boton" href="../Evento.php">←</a>
            <input type="submit" class="boton" value="+">
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

if($_SERVER['REQUEST_METHOD'] === 'POST'){
$razon = 'Eventos';
    $nombreEvento = $_POST['nombre'];
    $descripcionEvento = $_POST['descripcion'];
    $horaEvento = $_POST['Hora'];
    $prioridadEvento = $_POST['Prioridad'];
    $fechaEvento = $_POST['Fecha'];

    try{
 
        require_once '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';
        require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';

        $eventos = $breakbdy ->selectCollection('Eventos');

        $datosEvento = [
            'asignado' => $_SESSION['usuarioBreak'],
            'nombre'.$razon => $_POST['nombre'],
            'descripcion'.$razon => $_POST['descripcion'],
            'prioridad'.$razon => $_POST['Prioridad'],
            'fecha'.$razon => $_POST['Fecha'],
            'hora' => $_POST['Hora'],
            '_id' => uniqid()
            
        ];

        $insertarEvento = $eventos -> insertOne($datosEvento);

        if($insertarEvento){
            echo "SE HA AGENDADO SU EVENTO!!! \n.";
        }else{
            echo "UPS, HUBO UN PROBLEMA AGENDANDO \n.";
        }


    }catch(\Throwable $e){
        echo "Error:" . $e->getMessage();
    }
}
?>