<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://github.com/Lenn0705/BreakBdy/blob/main/VISUAL%20STUDIO/bootstrap-4.0.0-dist/css/bootstrap-grid.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="sesion.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
</head>
<body >
<form action="sesion.php" method="post">
    <h1 class="titulos">Bienvenido a BreakBdy</h1>
    <img id="logo" src="/VISUAL STUDIO/IMAGENES BREAKBDY/Imagen-logo.jpeg" alt="">
    <input name="NombUsuario" class="entradas" type="text" placeholder="Escriba el usuario">
    <label class="titulos" for="titulos">Ingrese Su usuario BreakBdy</label>

  
    <input name="contraseña" class="entradas" type="password" placeholder="Escriba la contraseña">
    <label for="contraseña" class="titulos">Ingrese su contraseña BreakBdy</label>

    <input type="submit" value="Ingresar" name="iniciar_sesion" class="boton">
    
     <a name="breakbdy" class="tituloInferior" href="https://breakbdy.ccvcolombia.com.co/">Olvidaste tu contraseña?...</a>
     <a name="breakbdy" class="tituloInferior" href="/VISUAL STUDIO/REGISTRO/breakbdy.html">No te has agendado con nosotros..</a>
    </form>
</body>
</html>