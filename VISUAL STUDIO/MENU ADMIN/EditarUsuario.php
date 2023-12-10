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

$consultaUsuario = $breakbdy ->selectCollection('usuario');

$especificacion = ['_id' => $id , 'usuarioBreak' => $_SESSION['usuarioEditar']];
$consultarUsuarioUnico = $consultaUsuario -> find($especificacion);
$resultadoConsultaUsuario = $consultarUsuarioUnico -> toArray();
foreach($resultadoConsultaUsuario as $documentoDatos){
$nombreReal = $documentoDatos['nombreReal'];
$apellidosReales = $documentoDatos['ApellidosReales'];
$usuarioAplicacion = $documentoDatos['usuarioBreak'];
$usuarioCorreo = $documentoDatos['CorreoElectronico'];
}
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
    <link rel="stylesheet" href="/VISUAL STUDIO/MENU USUARIO/Usuario.css">
    <title>EditarUsuario</title>
</head>
<body>
<div class="menu-der-usser">
    <div class="menu-der-usser-extra">
        <form action="EditarUsuario.php" method="post">
    <section>
        <input type="hidden" name="idp" value="<?php echo $id?>">
        <label for="Nombre">Nombre Real:</label>
        <Input type="text" name="Nombre" value = "<?php echo $nombreReal;?>"></Input>
    </section>
    <section>
        <label for="Apellido">Apellido Real:</label>
        <Input type="text" name="Apellido" value="<?php echo $apellidosReales;?>"></Input>
    </section>
    <div class="menu-der-usser-extra">
    <section>
        <label for="Usuario">Nombre de Usuario:</label>
        <Input type="text" name="Usuario" value = "<?php echo $usuarioAplicacion;?>"></Input>
    </section>
    <section>
        <label for="Correo">Correo:</label>
        <Input type="email" name="Correo" value="<?php echo $usuarioCorreo;?>"></Input>
    </section>
    <section>
        <Input type="submit" name="Cambiar_datos" value="modificar datos"></Input>
    </section>
    </form>
       </div>
    </div>
</div>
<div>
    <section id="barra-control" style="margin-top: 30px;">
        <button onclick="location.href='../MENU ADMIN/MenuAdmin.php'">←</button>
    </section>
  </div>

  <?php 
  if(isset($_POST['Cambiar_datos'])){

    $idp = $_POST['idp'];
    $nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Usuario = $_POST['Usuario'];
    $Correo = $_POST['Correo'];

try{

    $datos_cambiados = [
        '$set' =>[
        'nombreReal' => $nombre,
        'ApellidosReales' => $Apellido,
        'usuarioBreak' => $Usuario,
        'CorreoElectronico' => $Correo
        ]
    ];

    $criterios_busqueda = [
        '_id' => $idp
       ];

$busqueda = $consultaUsuario ->updateOne($criterios_busqueda, $datos_cambiados);

if ($busqueda->getModifiedCount() > 0) {
    // avisa de que los datos si se cambiaron
    echo "LOS DATOS SE HAN AGENDADO SATISFACTORIAMENTE .\n";
    header('Location:../INICIO DE SESION/iniciarSesion.php');
}elseif($datos_cambiados = $documentoDatos){
    // si los datos son los mismos, avisara
    echo "LOS DATOS SON LOS MISMOS \n.";
} else {
    // si los datos no se cambiaron , avisara
    echo "LOS DATOS NO SE HAN REEMPLAZADO SATISFACTORIAMENTE .\n";
}

    }catch(\Throwable $th){
        echo "Error: " . $th->getMessage();
    }
}
  ?>
</body>
</html>