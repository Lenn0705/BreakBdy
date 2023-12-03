<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="EliminarEvento.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
</head>
<body>
    <div id="menu-barra" class="col-md-1">
        <a href="/VISUAL STUDIO/MENU USUARIO/Usuario.php" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU TAREAS/TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="../Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU COMPROMISOS/Compromiso.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
    <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
  </div>
  <?php
session_start();
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
use MongoDB\Operation\InsertOne;
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';
require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
$razon = 'Eventos';
$coleccion = $breakbdy ->selectCollection($razon);
$especificacion = ['asignado' => $_SESSION['usuarioBreak']];
$consultaColeccion = $coleccion ->find($especificacion);
$resultadoConsultaColeccion = $consultaColeccion ->toArray();
?>


  <div id="menu-barra-der" class="col-md-1">
    <form action="EliminarEventos.php" method="post">
    <section id="Evento" name="Evento">
    <?php foreach($resultadoConsultaColeccion as $documento){?>

        <a href="../MENU EVENTO/FORMULARIO EDITAR/Editar<?php echo $razon?>.php?id=<?php echo $documento['_id']?>">
        <input type="checkbox" name="EliminarEventos[]" value="<?php echo $documento['_id'];?>">
        <?php echo $documento['nombre'.$razon] . "<br>";?>
        <p>Descripcion: <?php echo $documento['descripcion'.$razon] . "<br>";?></p>
        <p>Hora:<?php echo $documento['hora']. "<br>";?></p>
        <p>Fecha:<?php echo $documento['fecha'.$razon]?></p></a>
       <?php }?>
    </section>
    <div id="barra-control" class="col-md-1">
     <section class="botones-control">
      <a class="boton" href="../Evento.php"> ← </a>
          <input type="submit" class="boton2" value="x" name="eliminar">
      </section>
     </form>
    </div>
  </div>

<?php 
if(isset($_POST['eliminar'])){
  try{
    include '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
    $eventos = $breakbdy ->selectCollection('Eventos');
    $busquedaEliminar = [
      'asignado' => $_SESSION['usuarioBreak']
    ];
  // se verifica si se presiono un checkbox o no
  if(isset($_POST['EliminarEventos']) && is_array($_POST['EliminarEventos'])){
    foreach($_POST['EliminarEventos'] as $EventosEliminados){
      $EliminarEventos= $eventos ->deleteOne($busquedaEliminar);
    }
    if($EliminarEventos->getDeletedCount() > 0){
      echo "SE HAN ELIMINADO";
      header('location/VISUAL STUDIO/MENU EVENTO/Eventos.php');
      sleep(1);
    }
  }else{
    echo "NO SE HA ELIMINADO NINGUN EVENTO \n.";
  }
}catch(\Throwable $e){
    echo "Error:" . $e->getMessage();
  }
}
?>


</body>
</html>
