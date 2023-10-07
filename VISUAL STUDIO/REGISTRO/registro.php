<?php

$conexion = mysqli_connect('localhost', 'root' , '' , 'breakbdy')or die(mysqli_error($mysqli));

datos($conexion);

function datos($conexion){
    $nombreReal = $_POST['NombReal'];
    $nacimiento = $_POST['fecha'];
    $usuarioBreak = $_POST['NombUsuario'];
    $correo = $_POST['Correo'];
    $apellidoReal = $_POST['ApellReal'];
    $contra = $_POST['contraseña'];


    $meterDatos = "INSERT INTO registro(correoUsuario, nombreReal , ApellidoReal, fechaNacimiento , nombreUsuario , contraseñaUsuario)
    VALUES ('$correo' , '$nombreReal' , '$apellidoReal' , '$nacimiento' , '$usuarioBreak' , '$contra')";
    mysqli_query($conexion , $meterDatos);
    mysqli_close($conexion);
}

