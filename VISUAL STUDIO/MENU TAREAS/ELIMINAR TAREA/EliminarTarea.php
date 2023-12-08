<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="EliminarTarea.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
</head>
<body>
    <div id="menu-barra" class="col-md-1">
        <a href="/VISUAL STUDIO/MENU USUARIO/Usuario.php" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU TAREAS/TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="/VISUAL STUDIO/MENU EVENTO/Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
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
// traemos los datos del inicio de sesion
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';
// en la carpeta de config traemos la conexion a la base de datos
require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
// definimos la coleccion de las tareas

$tareas = $breakbdy ->selectCollection('tareas');
$descansos = $breakbdy -> selectCollection('Descansos');
// hacemos la respectiva consulta de las tareas que tiene el usuario que inicio sesion
$especificacion = ['asignado' => $_SESSION['usuarioBreak']];
$consultaTarea = $tareas ->find($especificacion);
$resultadoConsultaTarea = $consultaTarea ->toArray();
?>
  <div id="menu-barra-der" class="col-md-1">
    <form action="EliminarTarea.php" method="post">
    <section id="Tarea" name="Tarea">
      <?php foreach($resultadoConsultaTarea as $documento){?>
        <a href="../Tareas.html"><input type="checkbox" name="EliminarTarea[]" value="<?php echo $documento['_id']; ?>"> <?php echo $documento['nombreTarea']. "<br>";?>
        <p>Descripcion: <?php echo $documento['descripcionTarea'] . "<br>";?></p>
        <p>Tiempo: <?php echo $documento['hora']['horaInicial']. " - " . $documento['hora']['horaInicial']."<br>"?></p>
        <p>Fecha: <?php echo $documento['fechaTarea'];?></p></a>
        <?php }?>
    </section>


    <div id="barra-control" class="col-md-1">
     <section id="control">
        <script src="/VISUAL STUDIO/MENU TAREAS/Tareas.js"></script>
     </section>
     <section class="botones-control">
      <a class="boton" href="../Tareas.php">←</a>
          <input type="submit" class="boton2" value="x" name="eliminar">
      </section>
      </form>
      </div>
    </div>
  </div>

  <?php 
  // cuando se envie el comando de eliminar
  if(isset($_POST['eliminar'])){
    try{
      include '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
      $tareas = $breakbdy ->selectCollection('tareas');
      $busquedaEliminar = [
        'asignado' => $_SESSION['usuarioBreak']
      ];
      $busquedaEliminarDescansos = [
        'asignado' => $_SESSION['usuarioBreak'],
        'tareaAsignada' => $tareasEliminadas['nombreTarea']
      ];
    // se verifica si se presiono un checkbox o no
    if(isset($_POST['EliminarTarea']) && is_array($_POST['EliminarTarea'])){
      foreach($_POST['EliminarTarea'] as $tareasEliminadas){
        $elimiarTarea= $tareas ->deleteOne($busquedaEliminar);
foreach($tareasEliminadas as $descansosEliminados){

  $busquedaEliminarDescansos = [
    'asignado' => $_SESSION['usuarioBreak'],
    'tareaAsignada' => $tareasEliminadas['nombreTarea']
  ];

  $buscar = $descansos ->Find($busquedaEliminarDescansos);
  $elimiarDescanso = $descansos ->deleteOne($busquedaEliminar);

}
      }
      if($elimiarTarea->getDeletedCount() > 0){
        echo "SE HAN ELIMINADO";
        header('location:../TAREAS.php');
        sleep(1);
      }
    }else{
      echo "NO SE HA ELIMINADO NINGUNA TAREA \n.";
    }
  }catch(\Throwable $e){
      echo "Error:" . $e->getMessage();
    }
  }
  ?>
 

</body>
</html>