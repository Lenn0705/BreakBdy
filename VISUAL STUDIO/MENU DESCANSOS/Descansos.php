<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descansos</title>
</head>
<body>
    <div id="menu-barra" class="col-md-1">
    <a href="../MENU USUARIO/Usuario.php"><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
    <a href="../MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
    <a href="../MENU TAREAS/Tareas.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>
    <a href="../MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="../MENU EVENTO/Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
    <a href="../MENU COMPROMISOS/Compromiso.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
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
require  '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';

$descansos = $breakbdy ->selectCollection('descansos');

$especificacion = ['asignado' => $_SESSION['usuarioBreak']];
$consultadescanso = $descansos ->Find($especificacion , ['sort' =>(['fechaDescanso' => 1 , 'hora' =>1])]);
$resultadoConsultaDescanso = $consultadescanso->toArray();
?>

  <div id="menu-lista-descansos">
    <section id="Descansos" name="Descansos">

    <?php foreach($resultadoConsultaDescanso as $documento){?>
        <a href="#"><?php echo $documento['nombreDescanso']. "<br>";?>
        <p style="font-size: smaller;">Descripcion: <?php echo $documento['descripcionDescanso']. "<br>";?></p>
        <p>Tiempo de descanso:<?php echo $documento['duracionDescanso']. " seg". "<br>";?></p>
        <p>Hora:<?php echo $documento['hora'] . "<br>";?></p>
        <p>Fecha:<?php echo $documento['fechaDescanso'];?></p>
        <p class="icono-visibilidad"><img class="imagenes_referencia" src="<?php echo $documento['imagenDescanso']?>" alt=""></p>
        </a>
<?php } ?>
    </section>

  
  </div>


 

</body>
</html>