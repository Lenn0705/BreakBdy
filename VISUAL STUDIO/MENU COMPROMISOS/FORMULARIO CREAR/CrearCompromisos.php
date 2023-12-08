<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="stylesheet" href="CrearCompromiso.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo Compromiso</title>
</head>
<body>
    <div id="menu-barra" class="col-md-1">
        <a href="../MENU USUARIO/Usuario.php"><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU EVENTO/Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU TAREAS/TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU EVENTO/Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
        <a href="../Compromiso.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
        <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
      </div>

    <div class="col-md-1" >
        <form action="CrearCompromisos.php" method="post" id="Formulario">
        <section class="">
            
        <label for="Nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        </section>
        <section>
            <label for="Descripcion">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion">
        </section>
        <section>
            <label for="Hora">Hora:</label>
            <input type="time" name="Hora" id="Hora">
        </section>
        <section>
        <label for="Prioridad">Prioridad:</label><select name="Prioridad" id="Prioridad">
            <option value="Baja">Baja</option>
            <option value="Media">Med<ia</option>
            <option value="Alta">Alta</option>
        </select>
        </section>
        <section>
        <label for="Fecha">Fecha:</label>
        <input type="date" name="Fecha" id="Fecha">
        </section>
        </section>
        <section class="botones-control">
            <a class="boton" href="../Compromiso.php">←</a>
        <script src="/VISUAL STUDIO/MENU COMPROMISOS/Compromiso.js"></script>
            <input type="submit" name="crear" class="boton" value="+">
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
$razon = 'Compromisos';
    $nombreEvento = $_POST['nombre'];
    $descripcionEvento = $_POST['descripcion'];
    $horaEvento = $_POST['Hora'];
    $prioridadEvento = $_POST['Prioridad'];
    $fechaEvento = $_POST['Fecha'];

    try{
 
        require_once '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';
        require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';

        $compromisos = $breakbdy ->selectCollection('Compromisos');

        $datosCompromisos = [
            'asignado' => $_SESSION['usuarioBreak'],
            'nombre'.$razon => $_POST['nombre'],
            'descripcion'.$razon => $_POST['descripcion'],
            'prioridad'.$razon => $_POST['Prioridad'],
            'fecha'.$razon => $_POST['Fecha'],
            'hora' => $_POST['Hora'],
            'clase' => $razon,
            '_id' => uniqid()
            
        ];

        $insertarCompromisos = $compromisos -> insertOne($datosCompromisos);

        if($insertarCompromisos){
            echo "SE HA AGENDADO SU COMPROMISO!!! \n.";
        }else{
            echo "UPS, HUBO UN PROBLEMA AGENDANDO \n.";
        }


    }catch(\Throwable $e){
        echo "Error:" . $e->getMessage();
    }
}
?>