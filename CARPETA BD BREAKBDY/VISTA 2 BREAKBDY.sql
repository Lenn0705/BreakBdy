
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `mydb`.`Cronograma Usuarios` 
    AS
(SELECT usuario.`nombreUsuario` , cantidadtareas.`estadoTareas` , tarea.`nombreTarea` , tarea.`descripcionTarea` ,cantidadtareas.`prioridadTarea` , cantidadtareas.`horaInicio` , cantidadtareas.`horaFinalizacion` FROM usuario INNER JOIN cantidadtareas ON cantidadtareas.`Usuario_idUsuario` = usuario.`idUsuario` INNER JOIN tarea ON cantidadtareas.`Tarea_idTarea` = tarea.`idTarea`);
