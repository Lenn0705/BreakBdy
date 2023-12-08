<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="stylesheet" href="EditarEvento.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo evento</title>
</head>
<body>

<?php
session_start();
$id = $_GET['id'];

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
use MongoDB\Operation\InsertOne;
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';
require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';

// definimos la coleccion de las tareas

$evento = $breakbdy ->selectCollection('Eventos');

// consultamos los datos existentes

$especificacion = ['_id'=> $id,'asignado' => $_SESSION['usuarioBreak']];

$consultaEvento = $evento ->find($especificacion);

$resultadoConsultaEvento = $consultaEvento ->toArray();

foreach ($resultadoConsultaEvento as $documento) {
    $idp = $documento['_id'];
    $nombreEvento = $documento['nombreEventos'];
    $descripcionEvento = $documento['descripcionEventos'];
    $prioridadEvento = $documento['prioridadEventos'];
    $fechaEvento = $documento['fechaEventos'];
    $hora = $documento['hora'];
}

?>

    <div id="menu-barra">
    <a href="/VISUAL STUDIO/MENU USUARIO/Usuario.php" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU TAREAS/TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="../Eventos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU COMPROMISOS/Compromiso.html"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
    <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
  </div>

    <div class="col-md-1" >
        <form action="EditarEventos.php?id=<?php echo $idp?>" method="post" id="Formulario">
        <section class="">
        <input type="hidden" name="idp" value=<?php echo $idp?>>
        <label for="Nombre">Evento:</label>
        <input type="text" name="nombre" id="nombre" value=<?php echo $nombreEvento;?>>
        </section>
        <section>
            <label for="Prioridad">Prioridad:</label>
            <select name="Prioridad" id="Prioridad" value="<? echo $prioridadEvento;?>" default="<? echo $prioridadEvento;?>">
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
            </select>
        </section>
        <section>
            <label for="Hora">Descripcion:</label>
            <input type="text" name="descripcion" value=<?php echo $descripcionEvento;?>>
        </section>
        <section>
        <label for="Hora">Hora:</label>
            <input type="time" name="Hora" value=<?php echo $hora;?>>
        </section>
        <section>
            <label for="Fecha">Fecha:</label>
            <input type="date" name="Fecha" id="Fecha" value=<?php echo $fechaEvento;?>>
        </section>
        <section class="botones-control">
        <a class="boton" href="../Evento.php">←</a>
        <input type="submit" value="Editar"  class="boton2" name="editar">
        </section>
    </form>
    </div>
    <?php
if(isset($_POST['editar'])){
    $idp = $_POST['idp'];
    $nuevonombreEvento = $_POST['nombre'];
    $nuevodescripcionEvento = $_POST['descripcion'];
    $nuevoprioridadEvento = $_POST['Prioridad'];
    $nuevohoraEvento = $_POST['Hora'];
    $nuevofechaEvento = $_POST['Fecha'];

try{

    $datosnuevos = [
        '$set'=>[
        'nombreEventos' => $nuevonombreEvento,
        'descripcionEventos' => $nuevodescripcionEvento,
        'prioridadEventos' => $nuevoprioridadEvento,
        'fechaEventos' => $nuevofechaEvento,
        'hora' => $nuevohoraEvento
        ]
        ];

$crit = ['asignado' => $_SESSION['usuarioBreak'], 'nombreEventos' =>$nombreEvento , '_id' =>$idp];
        $busqueda = $evento ->updateOne($crit, $datosnuevos);

if ($busqueda->getModifiedCount() > 0) {
    echo "LOS DATOS SE HAN AGENDADO SATISFACTORIAMENTE .\n";
    header('Location:../Evento.php');
} elseif ($datosnuevos = $documento){
    echo "LOS DATOS SON LOS MISMOS .\n";
}else {
    echo "LOS DATOS NO SE HAN REEMPLAZADO SATISFACTORIAMENTE .\n";
}
}catch(\Throwable $e){
    echo "Error: " . $e->getMessage();
}
}
?>

</body>
</html>

