<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="stylesheet" href="CrearTarea.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
</head>
<body>
    <div id="menu-barra" class="col-md-1">

        <a href="../MENU USUARIO/Usuario.php"><img class="imagen4" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-logo.jpeg?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU EVENTO/Evento.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Calendario.png?raw=true" alt=":v"></a>
        <a href="../TAREAS.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Tareas.png?raw=true" alt=":v"></a>

        <a href="/VISUAL STUDIO/MENU DESCANSOS/Descansos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-descansos.png?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU EVENTO/Eventos.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/Imagen-Eventos.png?raw=true" alt=":v"></a>
        <a href="/VISUAL STUDIO/MENU COMPROMISOS/Compromiso.php"> <img class="imagen2" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/imagen-compromisos.png?raw=true" alt=":v"></a>
        <a href="Expandir"><img class="imagen3" src="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/IMAGENES%20BREAKBDY/menu.png?raw=true" alt=""></a>
      </div>

    <div class="col-md-1" >
        <form method="post" action="CrearTarea.php" id="Formulario">
        <section class="">
            
        <label for="Nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        </section>
        <section>

            <label for="descripcion">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion">

        </section>
        <section>
            <label for="HoraInicial">Hora Inicial:</label>
            <input type="time" step="60" name="HoraInicial" id="Hora">
            <label for="HoraFinal">Hora Final:</label>
            <input type="time" step="60" name="HoraFinal" id="Hora">
        </section>
        <section>
        <label for="Prioridad">Prioridad:</label><select name="Prioridad" id="Prioridad">
            <option value="Baja">Baja</option>
            <option value="Alta">Media</option>
            <option value="Alta">Alta</option>
        </select>
        </section>
        <section>
         <label for="Fecha">Fecha:</label>
         <input type="date" name="fecha" id="fecha">
        </section>
        <section class="botones-control">
            <input type="submit" class="boton" value="+">
            </form>
            <a class="boton" href="../Tareas.php">←</a>
        </section>
        </form>
    </div>
</body>
</html>

<?php 

session_start();

use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;
use MongoDB\Client;
use MongoDB\Operation\FindOne;
use MongoDB\Operation\InsertOne;

// traemos un archivo con los datos para el ingreso a la base de datos
require '/xampp/htdocs/BREAKBDY/VISUAL STUDIO/INICIO DE SESION/sesion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){


$nombreTarea = $_POST['nombre'];
$descripcionTarea = $_POST['descripcion'];
$prioridadTarea = $_POST['Prioridad'];
$horaFinal = $_POST['HoraFinal'];
$horaInicial = $_POST['HoraInicial'];
$fechaTarea = $_POST['fecha'];

try{

// traemos un archivo con los datos para el ingreso a la base de datos



require '/xampp/htdocs/BreakBdy/CONFIGURACIONES/bd.php';

// definimos las colecciones


$tareas = $breakbdy ->selectCollection('tareas');
$eventos = $breakbdy ->selectCollection('Eventos');
$compromisos = $breakbdy ->selectCollection('Compromisos');
$descanso = $breakbdy ->selectCollection('descansos');

$especificacionTareas = [
    'fechaTarea' => $fechaTarea,
    'asignado' => $_SESSION['usuarioBreak'],
    '$or' => [
        ['hora' =>['horaFinal' => ['$gt' => $horaInicial], 'horaInicial' => ['$lt' => $horaFinal]]],
        ['hora' =>['horaFinal' => ['$gt' => $horaFinal], 'horaInicial' => ['$lt' => $horaFinal]]],
        ['hora' =>['horaInicial'=> ['$gte' => $horaInicial], 'horaFinal' => ['$lte' => $horaFinal]]]
    ]
];

$especificacionEventos = [
    'fechaEventos' => $fechaTarea,
'asignado' => $_SESSION['usuarioBreak'],
'$or' =>[
    ['hora' =>['$gt' => $horaInicial], 'hora' => ['$lt' => $horaFinal]]
]
];

$especificacionCompromisos = [
    'fechaCompromisos' => $fechaTarea,
    'asignado' => $_SESSION['usuarioBreak'],
    '$or' =>[
        ['hora' =>['$gt' => $horaInicial], 'hora' => ['$lt' => $horaFinal]]
    ]
    ];

$busquedaOcupacionTareas = $tareas -> find($especificacionTareas);
$busquedaOcupacionEventos = $eventos -> find($especificacionEventos);
$busquedaOcupacionCompromisos = $compromisos -> find($especificacionCompromisos);

$arraytareas = iterator_to_array($busquedaOcupacionCompromisos);
$arrayeventos = iterator_to_array($busquedaOcupacionEventos);
$arraycompromisos = iterator_to_array($busquedaOcupacionTareas);

if(count($arraytareas)>0|| count($arrayeventos)>0 || count($arraycompromisos)>0){
    echo "LO SIENTO, YA TIENES AGENDADO A ESA HORA";
}else{

$datosTarea = [
    'asignado' =>$_SESSION['usuarioBreak'],
    'nombreTarea' => $nombreTarea,
    'descripcionTarea' => $descripcionTarea,
    'prioridadTarea' => $prioridadTarea,
    'fechaTarea' => $fechaTarea,
    'hora' => [
        'horaInicial' => $horaInicial,
        'horaFinal'=> $horaFinal
    ],
    'clase'=> "Tarea",
    '_id' => uniqid()
    ];

    //insertamos los datos

    $insertarTarea = $tareas ->insertOne($datosTarea);

if($insertarTarea){

    echo "AGENDADO!!! \n";

    // agendamiento automatico de descansos

if($prioridadTarea == "Baja"){

    require '/xampp/htdocs/BreakBdy/VISUAL STUDIO/ALMACEN DESCANSOS/almacenDescansos.php';

    $descansoAleatorio = array_rand($descansos);

function HorasAMinutos($hora){
list($horas , $minutos) = explode(":",$hora);
return($horas * 60) + $minutos;
}

function MinutosAHoras($minutos){
$horas = floor($minutos/60);
$minutos = $minutos % 60;
return sprintf("%02d:%02d", $horas, $minutos);
}
$minutosInicial_a= HorasAMinutos($horaInicial);
$minutosFinal_a= HorasAMinutos($horaFinal);

$mitadTiempo = (($minutosFinal_a - $minutosInicial_a)/2) + $minutosInicial_a;
$hora_mitad = MinutosAHoras($mitadTiempo);

    $datosDescanso = [
        'asignado' => $_SESSION['usuarioBreak'],
        'tareaAsignada' => $nombreTarea,
        'nombreDescanso' => $descansos[$descansoAleatorio]['nombreDescanso'],
        'descripcionDescanso' => $descansos[$descansoAleatorio]['descripcionDescanso'],
        'imagenDescanso' => $descansos[$descansoAleatorio]['imagenDescanso'],
        'duracionDescanso' => $descansos[$descansoAleatorio]['duracionDescanso'],
        'hora' => $hora_mitad,
        'clase' => "Descanso",
        'fechaDescanso' => $fechaTarea,
        'id' => uniqid()
    ];

$insertarDescanso = $descanso -> insertOne($datosDescanso);

if($insertarDescanso){
    echo "<br>";
    echo "SE LE AGENDO SU RESPECTIVO DESCANSO ;)";
}else{
    echo "PERO NO SE PUDO AGENDAR SU DESCANSO :c";
    echo "<br>";
}

}elseif($prioridadTarea == "Media"){
    // codigo para agendar descansos si es prioridad media

    require '/xampp/htdocs/BreakBdy/VISUAL STUDIO/ALMACEN DESCANSOS/almacenDescansos.php';

    function HorasAMinutos($hora){
        list($horas , $minutos) = explode(":",$hora);
        return($horas * 60) + $minutos;
        }
        
        function MinutosAHoras($minutos){
        $horas = floor($minutos/60);
        $minutos = $minutos % 60;
        return sprintf("%02d:%02d", $horas, $minutos);
        }

        $minutosInicial_a= HorasAMinutos($horaInicial);
        $minutosFinal_a= HorasAMinutos($horaFinal);
        
        $tercioTiempo = ($minutosFinal_a - $minutosInicial_a)/3;

            for($i = 1 ; $i < 2 ; $i++){

                $descansoAleatorio = array_rand($descansos);
                $horaOperada = ($tercioTiempo * $i) + $minutosInicial_a;
                $hora_tercio = MinutosAHoras($horaOperada);
        
            $datosDescanso = [
                'asignado' => $_SESSION['usuarioBreak'],
                'tareaAsignada' => $nombreTarea,
                'nombreDescanso' => $descansos[$descansoAleatorio]['nombreDescanso'],
                'descripcionDescanso' => $descansos[$descansoAleatorio]['descripcionDescanso'],
                'imagenDescanso' => $descansos[$descansoAleatorio]['imagenDescanso'],
                'duracionDescanso' => $descansos[$descansoAleatorio]['duracionDescanso'],
                'hora' => $hora_tercio,
                'fechaDescanso' => $fechaTarea,
                'id' => uniqid()
            ];
        
        $insertarDescanso = $descanso -> insertMany($datosDescanso);

            }
            
            if($insertarDescanso){
                echo "<br>";
                echo "SE HAN AGENDADO SUS DESCANSOS ;)";
            }else{
                echo "<br>";
                echo "UPS, HA HABIDO UN PROBLEMA AL AGENDAR";
            }

}elseif($prioridadTarea == "Alta"){
    // codigo para agendar descansos si es prioridad alta

    require '/xampp/htdocs/BreakBdy/VISUAL STUDIO/ALMACEN DESCANSOS/almacenDescansos.php';

    function HorasAMinutos($hora){
        list($horas , $minutos) = explode(":",$hora);
        return($horas * 60) + $minutos;
        }
        
        function MinutosAHoras($minutos){
        $horas = floor($minutos/60);
        $minutos = $minutos % 60;
        return sprintf("%02d:%02d", $horas, $minutos);
        }

        $minutosInicial_a= HorasAMinutos($horaInicial);
        $minutosFinal_a= HorasAMinutos($horaFinal);
        
        $cuartoTiempo = ($minutosFinal_a - $minutosInicial_a)/4;
        

            for($i = 1 ; $i < 3 ; $i++){

                $descansoAleatorio = array_rand($descansos);
                $horaOperada = ($cuartoTiempo * $i) + $minutosInicial_a;
                $hora_cuarto = MinutosAHoras($horaOperada);
            $datosDescanso = [
                'asignado' => $_SESSION['usuarioBreak'],
                'tareaAsignada' => $nombreTarea,
                'nombreDescanso' => $descansos[$descansoAleatorio]['nombreDescanso'],
                'descripcionDescanso' => $descansos[$descansoAleatorio]['descripcionDescanso'],
                'imagenDescanso' => $descansos[$descansoAleatorio]['imagenDescanso'],
                'duracionDescanso' => $descansos[$descansoAleatorio]['duracionDescanso'],
                'hora' => $hora_cuarto,
                'fechaDescanso' => $fechaTarea,
                'id' => uniqid()
            ];
        
        $insertarDescanso = $descanso -> insertOne($datosDescanso);

            }
            
            if($insertarDescanso){
                echo "<br>";
                echo "SE HAN AGENDADO SUS DESCANSOS ;)";
            }else{
                echo "<br>";
                echo "UPS, HA HABIDO UN PROBLEMA AL AGENDAR";
            }
}


}else{
    echo "ups, hubo un problema agendando";
}
}
}catch(\Throwable $e){
    echo "Error: " . $e->getMessage();
}
}

?>