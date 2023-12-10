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
$id = $_GET['id'];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
</head>
<body>
    <h1> ¿ESTA SEGURO DE ELIMINAR ESTE USUARIO?</h1>
    <form action="BorrrarUsuario.php" method="post">
        <input type="hidden" name="idp" value="<?php echo $id?>">
        <input type="submit" name="si">
        <input type="submit" name="no">
    </form>
</body>
</html>

<?php 
if(isset($_POST['si'])){
    $idp = $_POST['idp'];
$usuarios = $breakbdy -> selectCollection('usuario');
$usuarioEliminado = [
'_id' => $idp
];
$eliminar = $usuarios ->deleteOne($usuarioEliminado);
if($eliminar->getdeletedCount()> 0 ){
    echo "<h3 class='titulos'> SE HA ELIMINADO EL USUARIO</h3>";
    sleep(4000);
    header('location:../MenuAdmin.php');
}
}elseif(isset($_POST['no'])){
    header('location:../MenuAdmin.php');
}

?>