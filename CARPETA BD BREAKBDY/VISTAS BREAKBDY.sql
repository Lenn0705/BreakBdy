
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `mydb`.`Datos Usuarios` 
    AS
(SELECT usuario.`nombreUsuario`,usuario.`contraseñaUsuario` , registro.`correoUsuario` , registro.`nombreReal` , registro.`apellidoReal` ,registro.`edadUsuario` FROM usuario , registro);
