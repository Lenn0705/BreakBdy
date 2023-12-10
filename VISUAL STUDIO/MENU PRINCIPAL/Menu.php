<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="Menu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Agent</title>
</head>

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

$tareas = $breakbdy ->selectCollection('tareas');
$compromisos = $breakbdy ->selectCollection('Compromisos');
$eventos = $breakbdy -> selectCollection('Eventos');
$descansos = $breakbdy ->selectCollection('descansos');

$especificacion = ['asignado' => $_SESSION['usuarioBreak']];
$consulta = $tareas ->Find($especificacion , ['sort' =>(['fecha' => 1 , 'hora.horaInicial' =>1])]);
$consultadescanso = $descansos -> Find($especificacion , ['sort' =>(['fechaDescanso' => 1 , 'hora' =>1])]);
$resultadoConsultaDescanso = $consultadescanso->toArray();
$razonArreglo = "Tarea";
$dia = date('d');
?>
<body>
    <div id="menu-barra" class="col-md-1">

    <a href="../MENU USUARIO/Usuario.php" ><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"><p id="texto">Usser</p></a>
    <a href="../MENU PRINCIPAL/Menu.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"><p id="texto">Inicio</p></a>
    <a href="../MENU TAREAS/TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"><p id="texto">Tareas</p></a>
    <a href="../MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
    <a href="../MENU EVENTO/Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"><p id="texto">Eventos</p></a>
    <a href="../MENU COMPROMISOS/Compromiso.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"><p id="texto">Compromiso</p></a>
    <a href="#" id="expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>

   
  </div>
    <div id="contenido" class="col-md-1" id="contenedor-grande">
        <h1>BreakBdy   <p name='reloj' id="reloj"></p></h1>
        <script>
        // Aquí iría tu código JavaScript para manejar la actualización del reloj
        function actualizarReloj() {
            var fechaHoraActual = new Date().toLocaleString("es-ES");
            document.getElementById("reloj").innerText = fechaHoraActual;
            setTimeout(actualizarReloj , 1000);
        }
        actualizarReloj();
    </script>
    
        <form action="Menu.php" method="post">
        <select name="mes" id="filtrar" class="col-md-10">
          <?php
          function actualizarfecha(){
            $fechita = date("Y-m-d");
            $horita = date("H:i");
            $fechorita = $fechita ."," . $horita;
            return $fechorita;
          }

  $mesActual = date('m');
  $nombresMeses = [
    'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
    'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
  ];

  foreach ($nombresMeses as $indice => $nombreMes) {
    $valorMes = sprintf('%02d', $indice + 1);
    $selected = ($valorMes == $mesActual) ? 'selected' : '';
    echo "<option value=\"$valorMes\" $selected>$nombreMes</option>";
  }
  ?>
        </select>

        <table id="calendar">
            <tr class="calendar-header">
              <th class="dia-calendario">Dom</th>
              <th class="dia-calendario">Lun</th>
              <th class="dia-calendario">Mar</th>
              <th class="dia-calendario">Mié</th>
              <th class="dia-calendario">Jue</th>
              <th class="dia-calendario">Vie</th>
              <th class="dia-calendario">Sáb</th>
            </tr>
            <tr class="encabezado-calendario">
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(1)">1</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(2)">2</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(3)">3</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(4)">4</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(5)">5</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(6)">6</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(7)">7</button></th>
    </tr>
    <tr class="encabezado-calendario">
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(8)">8</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(9)">9</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(10)">10</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(11)">11</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(12)">12</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(13)">13</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(14)">14</button></th>
    </tr>
    <tr class="encabezado-calendario">
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(15)">15</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(16)">16</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(17)">17</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(18)">18</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(19)">19</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(20)">20</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(21)">21</button></th>
    </tr>
    <tr class="encabezado-calendario">
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(22)">22</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(23)">23</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(24)">24</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(25)">25</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(26)">26</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(27)">27</button></th>
        <th class="dia-calendario"><button type="button" onclick="seleccionarDia(28)">28 </button></th>
        <input type="hidden" id="diaSeleccionado" name="diaSeleccionado" value="">
</tr>
<tr>
              <tr class="encabezado-calendario">
              <th class="dia-calendario"><button type="button" onclick="seleccionarDia(29)">29</button></th>
              <th class="dia-calendario"><button type="button" onclick="seleccionarDia(30)">30</button></th>
              <th class="dia-calendario"><button type="button" onclick="seleccionarDia(31)">31</button></th>
              </tr>

              <script>
    function seleccionarDia(dia) {
        
        document.getElementById('diaSeleccionado').value = dia;
       
        document.getElementById('formulario').submit();
    }
</script>

              <div id="menu-barra-der" class="col-md-1">
              <section id="Tarea" name="Tarea">
              <input type="submit" name="filtro" id="filtrar" class="boton2" value="Tarea">
              </section>

              <section id="Compromisos" name="Compromiso">
              <input type="submit" name="filtro" id="filtrar" class="boton2" value="Compromisos">
              </section>

              <section id="Eventos" name="Evento">
              <input type="submit" name="filtro" id="filtrar" class="boton2" value="Eventos">
              </section>

              </form>
              </div>

              <div>

              <?php 
              if(isset($_POST['filtrar']) || isset($_POST['diaSeleccionado'])){
              if(empty($_POST['mes'])){
                $mes = date('m');
              }
              $razonArreglo = $_POST['filtro'];
              $mes = $_POST['mes'];
              $dia = $_POST['diaSeleccionado'];
              if($_POST['diaSeleccionado'] == "0"){
                $dia = date('d');
              }
              $año = date('y');
              if($dia< 10){
                $dia = "0".$dia;
              }
              $fechaCadena = "20" . $año . "-" . $mes . "-" . $dia;
              echo "FECHA:" . $fechaCadena;
              $razonArreglo = $_POST['filtro'];
              $especificacion = ['asignado' => $_SESSION['usuarioBreak'],
              'fecha'.$razonArreglo => $fechaCadena
            ];
          
              ?>

<div id="menu-barra-der-2" class="col-md-1">
  <h2>AGENDA <?php echo " " . $razonArreglo?></h2>
  <?php if($razonArreglo == "Tarea"){
                  $especificacion = ['asignado' => $_SESSION['usuarioBreak'],
                  'fecha'.$razonArreglo => $fechaCadena
                ];
                $consulta = $tareas ->Find($especificacion , ['sort' =>(['fecha' => 1 , 'hora.horaInicial' =>1])]);
    ?>
  <?php foreach($consulta as $documento){
?>

<section  id="<?php echo $documento['clase'];?>">
  <a href="/VISUAL STUDIO/MENU TAREAS/EDITAR TAREA/EditarTarea.php?id=<?php echo $documento['_id'];?>"> 
<?php echo $documento['nombreTarea'] . "<br>";?>
<p><?php echo $documento['descripcionTarea'] . "<br>";?></p>
<p><?php echo $documento['hora']['horaInicial'] . " - " . $documento['hora']['horaFinal'] . "<br>";?></p>
<p><?php echo $documento['fechaTarea'] ?></p>
<?php 
if($documento['fechaTarea'].",".$documento['hora']['horaFinal'] == actualizarfecha()){
echo "<script>alert('se ha vencido la tarea ".$documento['nombreTarea']."')</script>";
echo "<input type='submit' name='EliminarTarea' value='Eliminar'>";
if(isset($_POST['EliminarTarea'])){
$eliminarEspecifica=[
  'asignado' => $_SESSION['usuarioBreak'],
  '_id' => $documento['_id']
];
$consultaEliminar = $tareas -> deleteOne($eliminarEspecifica);
if($consultaEliminar-> getDeletedCount() >0){
  $especificacionExtra = ['asignado' => $_SESSION['usuarioBreak'],
  'fechaDescanso' => $fechaCadena,
  'TareaAsignada' => $documento['nombreTarea']
];
$consultadescanso = $descansos -> deleteOne($especificacionExtra);
if($consultadescanso -> getDeletedCount() >0){
  echo "<script>alert('Tambien se eliminaron los descansos')</script>";
}
}
}
?>
</a>
</section>

<?php }

}}elseif($razonArreglo == "Eventos"){
  $consulta = $eventos ->Find($especificacion , ['sort' =>(['fechaEventos' => 1 , 'hora' =>1])]);
  foreach($consulta as $documento){
  ?>
<section  id="<?php echo $documento['clase']?>">
  <a href="/VISUAL STUDIO/MENU EVENTO/FORMULARIO EDITAR/EditarEventos.php?id=<?echo $documento['_id'];?>"> 
<?php echo $documento['nombreEventos'] . "<br>";?>
<p><?php echo $documento['descripcionEventos'] . "<br>";?></p>
<p><?php echo $documento['hora'] . "<br>";?></p>
<p><?php echo $documento['fechaEventos']?></p>
<?php
if($documento['fechaEventos'].",".$documento['hora'] == actualizarfecha()){
  echo "<script>alert('Tienes tu: ".$documento['nombreEventos']." ahora')</script>";
  echo "<input type='submit' name='EliminarEvento' value='Eliminar'>";
if(isset($_POST['EliminarEvento'])){
$eliminarEspecifica=[
  'asignado' => $_SESSION['usuarioBreak'],
  '_id' => $documento['_id']
];
$consultaEliminar = $tareas -> deleteOne($eliminarEspecifica);
if($consultaEliminar-> getDeletedCount() >0){
echo "Se elimino el evento";
}
  }
?>
</a>
</section>

<?php }

}}elseif($razonArreglo == "Compromisos"){
  $consulta = $compromisos ->Find($especificacion , ['sort' =>(['fechaCompromisos' => 1 , 'hora' =>1])]);

  foreach($consulta as $documento){
  ?>

<section  id="<?php echo $documento['clase'];?>">
  <a href="/VISUAL STUDIO/MENU COMPROMISOS/FORMULARIO EDITAR/EditarCompromisos.php?id=<?php echo $documento['_id'];?>"> 
<?php echo $documento['nombreCompromisos'] . "<br>";?>
<p><?php echo $documento['descripcionCompromisos'] . "<br>";?></p>
<p><?php echo $documento['hora']. "<br>";?></p>
<p ><?php echo $documento['fechaCompromisos']?></p>
<?php
if($documento['fechaCompromisos'].",".$documento['hora'] == actualizarfecha()){
  echo "<script>alert('Tienes que hacer tu compromiso: ".$documento['nombreCompromisos']."')</script>";
  echo "<input type='submit' name='EliminarCompromiso' value='Eliminar'>";
  if(isset($_POST['EliminarCompromiso'])){
  $eliminarEspecifica=[
    'asignado' => $_SESSION['usuarioBreak'],
    '_id' => $documento['_id']
  ];
  $consultaEliminar = $tareas -> deleteOne($eliminarEspecifica);
  if($consultaEliminar-> getDeletedCount() >0){
  echo "Se elimino el compromiso";
  }
    }
  }
?>
</a>
</section>

<?php }}?>


</div>
<div id="menu-barra-der-2" class="col-md-1" style="margin-left: 800px ;">
<h2>DESCANSOS</h2>
<?php
                  $especificacion = ['asignado' => $_SESSION['usuarioBreak'],
                  'fechaDescanso' => $fechaCadena
                ];
                $consultadescanso = $descansos -> Find($especificacion , ['sort' =>(['fechaDescanso' => 1 , 'hora' =>1])]);
                $resultadoConsultaDescanso = $consultadescanso->toArray();
foreach($resultadoConsultaDescanso as $listaDescansos){?>
<section id="Descanso" id="menu-barra-der-2" class="col-md-1">
<a href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.php">
  <?php echo $listaDescansos['hora'] . " ";?>
  <p><?php echo $listaDescansos['fechaDescanso']?></p>
  <p><?php echo $listaDescansos['duracionDescanso'] . " segundos";?></p>
  <?php
if($listaDescansos['fechaDescanso'].",".$listaDescansos['hora'] == actualizarfecha()){
  echo "<script>alert('Hora de descansar: ".$documento['duracionDescanso']." segundos')</script>";
  echo "<input type='submit'>";
  }
?>
</a>
</section>
<?php }}?>
</div>
</div>
</div>

</body>
</html>