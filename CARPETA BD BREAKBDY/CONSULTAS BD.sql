`descanso``registro``tarea``usuario`
SELECT Usuario.`nombreUsuario`,usuario.`edadUsuario`,usuario.`contraseñaUsuario` , registro.`correoUsuario` FROM usuario
INNER JOIN registro
ON usuario.`Registro_idRegistro` =  registro.`idRegistro`


