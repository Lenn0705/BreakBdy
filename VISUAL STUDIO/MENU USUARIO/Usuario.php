<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="Usuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
</head>
<body>
    <div id="menu-barra">

        <a href="../MENU USUARIO/Usuario.php" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"><p id="texto">Usser</p></a>
        <a href="../MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"><p id="texto">Inicio</p></a>
        <a href="../MENU TAREAS/Tareas.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"><p id="texto">Tareas</p></a>
        <a href="../MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
        <a href="../MENU EVENTO/Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"><p id="texto">Eventos</p></a>
        <a href="../MENU COMPROMISOS/Compromiso.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"><p id="texto">Compromiso</p></a>
        <a href="#" id="expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
    
       
      </div>
      <div class="menu-der-usser">
        <a href="#Cambiar imagen de perfil"><img src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=""></a>

       <?php
              use MongoDB\Client;
              use MongoDB\Collection;
              use MongoDB\Operation\ReplaceOne;
              use MongoDB\Operation\FindOneAndReplace;
              use MongoDB\BSON\ObjectId;
              use MongoDB\Model\BSONDocument;
              use MongoDB\Operation\FindOne;
              use MongoDB\Operation\InsertOne;
       session_start();

       require '/xampp/htdocs/BreakBdy/VISUAL STUDIO/INICIO DE SESION/sesion.php';
       require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
       echo "<h1>{$_SESSION['usuarioBreak']}</h1>";
       
    //    traeremos la consulta del usuario para mostrar sus datos 
    $consultaUsuario = $breakbdy ->selectCollection('usuario');

    $especificacion = ['usuarioBreak' => $_SESSION['usuarioBreak']];
    $consultarUsuarioUnico = $consultaUsuario -> find($especificacion);
    $resultadoConsultaUsuario = $consultarUsuarioUnico -> toArray();
    foreach($resultadoConsultaUsuario as $documentoDatos){
    $nombreReal = $documentoDatos['nombreReal'];
    $apellidosReales = $documentoDatos['ApellidosReales'];
    $usuarioAplicacion = $documentoDatos['usuarioBreak'];
    $usuarioCorreo = $documentoDatos['CorreoElectronico'];
    }
       ?>


<div class="menu-der-usser">
    <div class="menu-der-usser-extra">
        <form action="Usuario.php" method="post">
    <section>
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
    <section id="barra-control">
        <form action="Usuario.php" method="post">
        <input type="submit" name = "cerrar_sesion" id = "boton_cerrar_sesion" value="Cerrar Sesion"></Input>
        </form>
        <form action="Usuario.php" method="post">
            <input type="submit" name="cambiar_contraseña" id = "boton_cambiar_contraseña" value="Cambiar Contraseña">
        </form>
        <button onclick="location.href='../MENU PRINCIPAL/Menu.php'">←</button>
    </section>
  </div>
  <div>
    <?php

    if(isset($_POST['cerrar_sesion'])){
        session_abort();
        header('location:../INICIO DE SESION/iniciarSesion.php');
    }

    if(isset($_POST['cambiar_contraseña'])){
        // si se quiere cambiar la contraseña, se generara una seccion para cambiarla
echo "<section><form action='Usuario.php' method='post'><label for='Contraseña'>Contraseña:</label>";
echo "<Input type='password' name='Contraseña' placeholder='ingrese la nueva contraseña'></Input> <br>";
echo "<Input type='submit' name='nueva_contraseña' value='Confirmar'></Input></form></section>";
if(isset($_POST['nueva_contraseña'])){
    $contraseñaCambiada = $_POST['Contraseña'];
    try{   
        include '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';
        $arregloContraseñaCambiada =[
            '$set'=>[
            'contraseñaBreak' => password_hash($contraseñaCambiada , PASSWORD_DEFAULT)]
        ];

        $criterios_busqueda = [
            'usuarioBreak' => $_SESSION['usuarioBreak']
        ];
    
    $busqueda = $coleccion ->updateOne($criterios_busqueda, $arregloContraseñaCambiada);
    
    if ($busqueda->getModifiedCount() > 0) {
        // avisa de que los datos si se cambiaron
        echo "SE HA CAMBIADO EXITOSAMENTE LA CONTRASEÑA .\n";
        header('Location:../INICIO DE SESION/iniciarSesion.php');
    }elseif($contraseñaCambiada = $_SESSION['contraseñaBreak']){
        // si los datos son los mismos, avisara
        echo "LA CONTRASEÑA ES IDENTICA A LA ANTERIOR, INTENTE PONER OTRA \n.";
    } else {
        // si los datos no se cambiaron , avisara
        echo "LA CONTRASEÑA NO SE HA PODIDO CAMBIAR .\n";
    }

     }catch(\Throwable $th){
        echo "Error: " . $th->getMessage();
    }
    }
}
    ?>
  </div>
      </div>

</body>
</html>

<?php


//boton para cerrar sesion

if(isset($_POST['cerrar_sesion'])){
    session_destroy();
    if(!isset($_SESSION['usuario'])){
        header('Location:/BreakBdy/VISUAL STUDIO/INICIO DE SESION/iniciarSesion.php');
        exit();
    }
}

if(isset($_POST['Cambiar_datos'])){

    $nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Usuario = $_POST['Usuario'];
    $Correo = $_POST['Correo'];

try{

require_once '/xampp/htdocs/BreakBdy/CONFIGURACIONES/config.php';

$cadenConexion = "mongodb://" .
$db_components['usuario'] . ":" . 
$db_components['contraseña'] . "@" .
$db_components['servidor'] . ":" .
$db_components['puerto'] . "/" .
$db_components['baseDatos'];
    
require_once '/xampp/htdocs/BreakBdy/vendor/autoload.php';


    $cliente = new MongoDB\Client($cadenConexion);
    $breakbdy = $cliente ->selectDatabase('BREAKBDY');
    $coleccion = $breakbdy -> selectCollection('usuarios');

    $datos_cambiados = [
        '$set' =>[
        'nombreReal' => $nombre,
        'ApellidosReales' => $Apellido,
        'usuarioBreak' => $Usuario,
        'CorreoElectronico' => $Correo
        ]
    ];

    $criterios_busqueda = [
        'usuarioBreak' => $_SESSION['usuarioBreak']
    ];

$busqueda = $coleccion ->updateOne($criterios_busqueda, $datos_cambiados);

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