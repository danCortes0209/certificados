-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.19 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla certificados.alumnos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
REPLACE INTO `alumnos` (`idalumno`, `numerocontrol`, `fechanacimiento`, `curp`, `nombre`, `appaterno`, `apmaterno`, `idgenero`) VALUES
	(1, '1715110513', '1998-11-24', 'HECO981124HHGRS07', 'Oswaldo Daniel', 'Hernandez', 'Cortes', 251);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.asignaturas: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `asignaturas` DISABLE KEYS */;
REPLACE INTO `asignaturas` (`idasignatura`, `nombre`, `descripcion`) VALUES
	(1, 'Matematicas', 'Matematicas'),
	(2, 'Español 1', 'Español 1'),
	(3, 'EspaÃ±ol II', 'EspaÃ±ol II'),
	(4, 'Matematicas II', 'Matematicas II'),
	(5, 'Computacion', 'Computacion'),
	(6, 'Ofimatica', 'Ofimatic'),
	(7, 'Biologia', 'Biologia'),
	(8, 'Quimica', 'Quimica'),
	(9, 'Fisica', 'Fisica'),
	(10, 'Civica y etica', 'Civica y etica'),
	(11, 'Derecho fiscal', 'Derecho fiscal'),
	(12, 'Logica matematica', 'Logica matematica'),
	(13, 'Soporte tecnico', 'Soporte tecnico'),
	(14, 'Programacion I', 'Programacion'),
	(15, 'Desarrollo de Aplicaciones', 'Desarrollo de Aplicaciones'),
	(16, 'Soporte tecnico II', 'Soporte tecnico II');
/*!40000 ALTER TABLE `asignaturas` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.asignaturas_alumno: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `asignaturas_alumno` DISABLE KEYS */;
REPLACE INTO `asignaturas_alumno` (`idasignaturaalumno`, `idalumno`, `idasignatura`, `ciclo`, `calificacion`, `observaciones`) VALUES
	(1, 1, 1, '2015-4', 10, 100),
	(2, 1, 2, '2015-4', 9, 100),
	(3, 1, 5, '2015-4', 9.7, 100),
	(4, 1, 7, '2015-4', 10, 100),
	(5, 1, 3, '2016-1', 10, 100),
	(6, 1, 4, '2016-1', 10, 100),
	(7, 1, 6, '2016-1', 9, 100),
	(8, 1, 8, '2016-1', 10, 100),
	(9, 1, 9, '2016-2', 10, 100),
	(10, 1, 10, '2016-2', 9, 100),
	(11, 1, 12, '2016-2', 10, 100),
	(12, 1, 13, '2016-2', 9.3, 100),
	(13, 1, 11, '2016-3', 10, 100),
	(14, 1, 14, '2016-3', 10, 100),
	(15, 1, 15, '2016-3', 9, 100),
	(16, 1, 16, '2016-3', 8, 100);
/*!40000 ALTER TABLE `asignaturas_alumno` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.carreras: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `carreras` DISABLE KEYS */;
REPLACE INTO `carreras` (`idcarrera`, `nombre`, `descripcion`) VALUES
	(1, 'Ingenieria en Sistemas', 'Ingenieria en Sistemas'),
	(2, 'Contaduria', 'Contaduria');
/*!40000 ALTER TABLE `carreras` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.certificado: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `certificado` DISABLE KEYS */;
REPLACE INTO `certificado` (`idcertificado`, `tipocertificado`, `foliocontrol`, `sello`, `certresp`, `nocertresp`, `idresponsable`, `idalumno`) VALUES
	(1, 79, 'asfasdsa', 'asdasd', 'asdasd', 'asdasd', 1, 1),
	(2, 79, '1725fv15r1v15', '18736tb152v1vb1', '18181 171n181n', '181635765', 1, 1);
/*!40000 ALTER TABLE `certificado` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.expedicion: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `expedicion` DISABLE KEYS */;
REPLACE INTO `expedicion` (`idexpedicion`, `idtipocertificacion`, `fecha`, `entidadfederativa`, `idcertificado`) VALUES
	(1, 79, '2018-12-03 14:59:30', 13, 1),
	(2, 79, '2018-12-03 15:08:18', 13, 1),
	(3, 79, '2018-12-03 15:09:33', 13, 1),
	(4, 79, '2018-12-03 15:12:17', 13, 1),
	(5, 79, '2018-12-03 15:13:47', 13, 1),
	(6, 79, '2018-12-03 15:15:00', 13, 1),
	(7, 79, '2018-12-03 18:03:43', 13, 2),
	(8, 79, '2018-12-03 18:05:05', 13, 2);
/*!40000 ALTER TABLE `expedicion` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.ipes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ipes` DISABLE KEYS */;
REPLACE INTO `ipes` (`idipes`, `idnombreinstitucion`, `idcampus`, `identidadfederativa`, `nombre`) VALUES
	(1, 15, 6, 13, 'utec tulancingo');
/*!40000 ALTER TABLE `ipes` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.plancarrera: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `plancarrera` DISABLE KEYS */;
REPLACE INTO `plancarrera` (`idplan`, `idcarrera`, `claveplan`, `idtipoperiodo`, `idalumno`) VALUES
	(1, 1, '2018', 93, 1);
/*!40000 ALTER TABLE `plancarrera` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.responsable: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `responsable` DISABLE KEYS */;
REPLACE INTO `responsable` (`idresponsable`, `idipes`, `curp`, `nombre`, `appaterno`, `apmaterno`, `contraseña`, `usuario`, `idcargo`) VALUES
	(1, 1, 'HECO981124HHGRS00', 'Oswaldo Daniel', 'Hernandez', 'Cortes', '1234567', 'dancortes', 2);
/*!40000 ALTER TABLE `responsable` ENABLE KEYS */;

-- Volcando datos para la tabla certificados.rvoe: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `rvoe` DISABLE KEYS */;
REPLACE INTO `rvoe` (`idrvoe`, `numero`, `fecha`, `idcertificado`) VALUES
	(1, 1422312, '2018-12-03 14:59:30', 1),
	(2, 1865472, '2018-12-03 18:03:43', 2),
	(3, 172612721, '2018-12-03 18:05:05', 2);
/*!40000 ALTER TABLE `rvoe` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
