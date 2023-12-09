<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/aquawax" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="Slide.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BreakBdy</title>
</head>
<body>
<?php if($_SESSION['Rol'] == 'Administrador'){ 
    $cadena = '../MENU ADMIN/MenuAdmin.php';
    }elseif($_SESSION['Rol'] == 'Usuario'){ 
        $cadena = '../MENU PRINCIPAL/Menu.php';
    }
        ?>

    <div id="logobreakbdy">
        <img src="../IMAGENES BREAKBDY/12a5e2c0-7bee-4e2d-abeb-7928d3819cef.png">
        <br>
        <button class="boton" style="white-space: pre;" onclick="location.href='<?php echo $cadena?>'">  &#x21E7;  </button>
        <br>
        <p>Desliza para agendar tu dia</p>
     </div>
    
</body>
</html>