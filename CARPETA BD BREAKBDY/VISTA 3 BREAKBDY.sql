DELIMITER $$

USE `mydb`$$

DROP VIEW IF EXISTS `plan de descansos para el usuario`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `plan de descansos para el usuario` AS (
SELECT
  `usuario`.`nombreUsuario`             AS `nombreUsuario`,
  `cantidadDescansos`.`horaDescanso` AS `horaDescanso`,
  `descanso`.`nombreDescanso`           AS `nombreDescanso`,
  `descanso`.`descripcionDescanso`      AS `descripcionDescanso`,
  `cantidaddescansos`.`tiempoNecesario` AS `tiempoNecesario`
FROM ((`usuario`
    JOIN `cantidaddescansos`
      ON (`cantidaddescansos`.`Usuario_idUsuario` = `usuario`.`idUsuario`))
   JOIN `descanso`
     ON (`cantidaddescansos`.`Descanso_idDescanso` = `descanso`.`idDescanso`)))$$

DELIMITER ;`plan de descansos para el usuario``plan de descansos para el usuario`