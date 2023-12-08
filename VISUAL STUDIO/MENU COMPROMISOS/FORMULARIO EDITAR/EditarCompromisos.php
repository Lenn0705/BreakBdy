<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="stylesheet" href="EditarCompromiso.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="EditarCompromiso.js"></script>
    <title>Editar Compromiso</title>
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


$compromiso = $breakbdy ->selectCollection('Compromisos');


// consultamos los datos existentes

$especificacion = ['_id'=> $id,'asignado' => $_SESSION['usuarioBreak']];

$consultaCompromiso = $compromiso ->find($especificacion);

$resultadoConsultaCompromiso = $consultaCompromiso ->toArray();
foreach ($resultadoConsultaCompromiso as $documento) {
    $idp = $documento['_id'];
    $nombreCompromiso = $documento['nombreCompromisos'];
    $descripcionCompromiso = $documento['descripcionCompromisos'];
    $prioridadCompromiso = $documento['prioridadCompromisos'];
    $fechaCompromiso = $documento['fechaCompromisos'];
    $hora = $documento['hora'];
}

?>

    <div id="menu-barra">

    <a href="/Breakbdy/VISUAL STUDIO/MENU USUARIO/Usuario.php" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="/Breakbdy/VISUAL STUDIO/MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="/Breakbdy/VISUAL STUDIO/MENU TAREAS/TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="/Breakbdy/VISUAL STUDIO/MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="/Breakbdy/VISUAL STUDIO/MENU EVENTO/Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
    <a href="../Compromiso.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
    <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
  </div>

    <div class="col-md-1" >
        <form action="EditarCompromisos.php" method="post" id="Formulario">
        <section class="">
            
        <label for="Nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $nombreCompromiso?>">
        </section>
        <section>
            <label for="Descripcion">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcionCompromiso?>">
        </section>
        <section>
            <label for="Hora">Hora:</label>
            <input type="time" name="Hora" id="Hora" value="<?php echo $hora?>">
        </section>
        <section>
        <label for="Prioridad">Prioridad:</label><select name="Prioridad" id="Prioridad" value="<?php echo $prioridadCompromiso?>">
            <option value="Baja">Baja</option>
            <option value="Media">Med<ia</option>
            <option value="Alta">Alta</option>
        </select>
        </section>
        <section>
        <label for="Fecha">Fecha:</label>
        <input type="date" name="Fecha" id="Fecha" value="<?php echo $fechaCompromiso?>">
        </section>
        </section>
        <section class="botones-control">
            <a class="boton" href="../Compromiso.php">←</a>
        <script src="/VISUAL STUDIO/MENU COMPROMISOS/Compromiso.js"></script>
            <button type="submit" name="editar" class="boton"> + </button>
        </section>

    </form>
    </div>

<?php
    if(isset($_POST['editar'])){
    $idp = $_POST['idp'];
    $nuevonombreCompromiso = $_POST['nombre'];
    $nuevodescripcionCompromiso = $_POST['descripcion'];
    $nuevoprioridadCompromiso = $_POST['Prioridad'];
    $nuevohoraCompromiso = $_POST['Hora'];
    $nuevofechaCompromiso = $_POST['Fecha'];

try{

    $datosnuevos = [
        '$set'=>[
        'nombreCompromisos' => $nuevonombreCompromiso,
        'descripcionCompromisos' => $nuevodescripcionCompromiso,
        'prioridadCompromisos' => $nuevoprioridadCompromiso,
        'fechaCompromisos' => $nuevofechaCompromiso,
        'hora' => $nuevohoraCompromiso
        ]
        ];

$crit = ['asignado' => $_SESSION['usuarioBreak'], 'nombreCompromisos' =>$nombreCompromiso , '_id' =>$idp];
        $busqueda = $compromiso ->updateOne($crit, $datosnuevos);

if ($busqueda->getModifiedCount() > 0) {
    echo "LOS DATOS SE HAN AGENDADO SATISFACTORIAMENTE .\n";
    header('Location:../Compromiso.php');
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