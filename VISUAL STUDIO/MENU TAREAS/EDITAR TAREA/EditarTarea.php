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
$id = $_GET['id'];

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
use MongoDB\Operation\InsertOne;
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';

require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
// definimos la coleccion de las tareas

$tareas = $breakbdy ->selectCollection('tareas');

// consultamos los datos existentes

$especificacion = ['_id'=> $id,'asignado' => $_SESSION['usuarioBreak']];

$consultaTarea = $tareas ->find($especificacion);

$resultadoConsultaTarea = $consultaTarea ->toArray();

foreach ($resultadoConsultaTarea as $documento) {
    $idp = $documento['_id'];
    $nombreTarea = $documento['nombreTarea'];
    $descripcionTarea = $documento['descripcionTarea'];
    $prioridadTarea = $documento['prioridadTarea'];
    $fechaTarea = $documento['fechaTarea'];
    $horaInicial = $documento['hora']['horaInicial'];
    $horaFinal = $documento['hora']['horaFinal'];
}


?>

    <div id="menu-barra">
    <a href="/VISUAL STUDIO/MENU USUARIO/Usuario.php" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="../TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU EVENTO/Eventos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU COMPROMISOS/Compromiso.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
    <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
  </div>

    <div class="col-md-1" >
        <form action="EditarTarea.php?id=<?php echo $idp?>" method="post" id="Formulario">
        <section class="">
            <input type="hidden" name="idp" value=<?php echo $idp?>>
        <label for="Nombre">Tarea:</label>
        <input type="text"  name="nombre" id="nombre" value=<?php echo $nombreTarea;?>>
        </section>
        <section>
            <label for="Prioridad">Prioridad:</label>
            <select name="prioridad" id="Prioridad" value=<?php echo $prioridadTarea;?> default="<?echo $prioridadTarea?>">
                <option value="Baja">Baja</option>
                <option value="Alta">Alta</option>
            </select>
        </section>
        <section>
            <label for="Descripcion">Descripcion:</label>
            <input type="text" name="descripcion" value=<?php echo $descripcionTarea;?>>
        </section>
        <section>
            <label for="HoraInicial">Hora Inicial:</label>
            <input type="time" name="horaInicial" value=<?php echo $horaInicial;?>>
            <label for="HoraFinal">Hora Final:</label>
            <input type="time" name="horaFinal" value=<?php echo $horaFinal;?>>
        </section>
        <section>
<label for="Fecha">Fecha:</label>
<input type="date" name="Fecha" id="Fecha" value=<?php echo $fechaTarea;?>>
        </section>
        <section class="botones-control">
        <a class="boton" href="../Tareas.php">←</a>
        <input type="submit" value="Editar"  class="boton2" name="editar">
        </section>
    </form>
    </div>
    <?php
if(isset($_POST['editar'])){
    $idp = $_POST['idp'];
    $nuevonombreTarea = $_POST['nombre'];
    $nuevodescripcionTarea = $_POST['descripcion'];
    $nuevoprioridadTarea = $_POST['prioridad'];
    $nuevohoraFinal = $_POST['horaFinal'];
    $nuevohoraInicial = $_POST['horaInicial'];
    $nuevofechaTarea = $_POST['Fecha'];

try{

    $datosnuevos = [
        '$set'=>[
        'nombreTarea' => $nuevonombreTarea,
        'descripcionTarea' => $nuevodescripcionTarea,
        'prioridadTarea' => $nuevoprioridadTarea,
        'fechaTarea' => $nuevofechaTarea,
        'hora' => [
            'horaInicial' => $nuevohoraInicial,
            'horaFinal'=> $nuevohoraFinal
        ]]
        ];

$crit = ['asignado' => $_SESSION['usuarioBreak'], 'nombreTarea' =>$nombreTarea , '_id' =>$idp];
        $busqueda = $tareas ->updateOne($crit, $datosnuevos);

if ($busqueda->getModifiedCount() > 0) {
    echo "LOS DATOS SE HAN AGENDADO SATISFACTORIAMENTE .\n";
    header('Location:../TAREAS.php');
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
