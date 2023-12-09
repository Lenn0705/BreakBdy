<?php
session_start();
if(!isset($_SESSION['usuarioBreak'])){
    header('Location:../INICIO DE SESION/iniciarSesion.php');
    exit();
  }

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
use MongoDB\Operation\InsertOne;
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';
require  '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';

$usuarios = $breakbdy ->selectCollection('usuarios');
$especificacion = [];
$consultaUsuarios = $usuarios -> find($especificacion , ['sort'=>['fechaCreacion' =>1]])
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/VISUAL STUDIO/MENU PRINCIPAL/Menu.css">
    <title>ADMINISTRADOR</title>
</head>
<body>
<div id="menu-barra" class="col-md-1">
<a href="../MENU ADMIN/UsuarioAdmin.php" style="margin-top: 200px;" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"><p id="texto">Usser</p></a>
<a href="../MENU ADMIN/MenuAdmin.php" style="margin-top:200px"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"><p id="texto">Inicio</p></a>
</div>
<div id="menu-barra-der-2" class="col-md-1">
<?php
$usuarios = $breakbdy ->selectCollection('usuario');
$consultaUsuarios = $usuarios ->find();
$resultadoUsuarios = $consultaUsuarios -> toArray();
foreach($consultaUsuarios as $documento){
?>
<section id="Tarea">
<a>
  
  <?php echo $documento['usuarioBreak'] . "<br>";?>
  <p><?php echo $documento['nombreReal'] . " " . $documento['ApellidosReales'] . "<br>";?></p>
  <p><?php echo $documento['CorreoElectronico']. "<br>";?></p>
  <p><?php echo $documento['usuarioBreak']. "<br>";?></p>
  <p><?php echo $documento['Rol']?></p>
  <div class="row">
  <input type="submit" name="EliminarUsuario">
  <input type="submit" name="EditarUsuario">
</div>
</a>
</section>

<?php } ?>
</div>
</body>
</html>