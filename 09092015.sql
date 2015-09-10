-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2015 a las 04:19:16
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `rsidsprod`
--
DROP DATABASE `rsidsprod`;
CREATE DATABASE IF NOT EXISTS `rsidsprod` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rsidsprod`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anio`
--

CREATE TABLE IF NOT EXISTS `anio` (
  `ANIO_ID` int(11) DEFAULT NULL,
  `ANIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anio`
--

INSERT INTO `anio` (`ANIO_ID`, `ANIO`) VALUES
(2014, 14),
(2015, 15),
(2016, 16),
(2017, 17),
(2018, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anio_formulario`
--

CREATE TABLE IF NOT EXISTS `anio_formulario` (
  `ANFO_ID_ANIO` int(11) NOT NULL,
  `ANFO_ANIO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ANFO_ID_ANIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anio_formulario`
--

INSERT INTO `anio_formulario` (`ANFO_ID_ANIO`, `ANFO_ANIO`) VALUES
(2014, 2014),
(2015, 2015);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion`
--

CREATE TABLE IF NOT EXISTS `aplicacion` (
  `APLI_ID_APLICACION` int(11) NOT NULL AUTO_INCREMENT,
  `APLI_NOMBRE` varchar(60) NOT NULL,
  PRIMARY KEY (`APLI_ID_APLICACION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `aplicacion`
--

INSERT INTO `aplicacion` (`APLI_ID_APLICACION`, `APLI_NOMBRE`) VALUES
(1, 'seleccion_otra_aplicacion'),
(2, 'compiladores'),
(3, 'mpi'),
(4, 'openmp'),
(5, 'qchem'),
(6, 'gromacs'),
(7, 'gamess'),
(8, 'quantum'),
(9, 'gaussian'),
(10, 'nwchem'),
(11, 'namd'),
(12, 'epw'),
(13, 'Orca'),
(14, 'adf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_renovacion`
--

CREATE TABLE IF NOT EXISTS `archivos_renovacion` (
  `ARRE_ID_ARCHIVOS_RENOVACION` int(11) NOT NULL AUTO_INCREMENT,
  `ARRE_ID_SOLICITUD_RENOVACION` bigint(20) NOT NULL,
  `ARRE_TIP_ARCHIVO` text,
  `ARRE_RUTA_ARCHIVO` text,
  PRIMARY KEY (`ARRE_ID_ARCHIVOS_RENOVACION`),
  KEY `FK_REFERENCE_49` (`ARRE_ID_SOLICITUD_RENOVACION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `archivos_renovacion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo_trabajo`
--

CREATE TABLE IF NOT EXISTS `campo_trabajo` (
  `CATR_ID_CAMPO_TRABAJO` int(11) NOT NULL AUTO_INCREMENT,
  `CATR_NOMBRE_CAMPO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CATR_ID_CAMPO_TRABAJO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `campo_trabajo`
--

INSERT INTO `campo_trabajo` (`CATR_ID_CAMPO_TRABAJO`, `CATR_NOMBRE_CAMPO`) VALUES
(1, 'Otro Campo'),
(2, 'FISICA'),
(3, 'QUIMICA'),
(4, 'MATEMATICAS'),
(5, 'CIENCIAS DE LA TIERRA Y DEL COSMOS'),
(6, 'CIENCIAS DEL MAR'),
(7, 'VETERINARIA Y ZOOTECNIA'),
(8, 'MEDICINA Y PATOLOGIA HUMANA'),
(9, 'BIOLOGIA'),
(10, 'BIOTECNOLOGIA Y GENOMICA'),
(11, 'BIOQUIMICA'),
(12, 'INGENIERIA QUIMICA'),
(13, 'TECNOLOGIA DE LA ALIMENTACION'),
(14, 'INFORMATICA'),
(15, 'ANTROPOLOGIA'),
(16, 'ARQUEOLOGIA'),
(17, 'ARQUITECTURA'),
(18, 'AGRONOMIA'),
(19, 'ECONOMIA'),
(20, 'GEOGRAFIA'),
(21, 'INGENIERIA AERONAUTICA'),
(22, 'INGENIERIA AMBIENTAL'),
(23, 'INGENIERIA ELECTRONICA'),
(24, 'INGENIERIA ELECTRICA'),
(25, 'TECNOLOGIA INDUSTRIAL'),
(26, 'INGENIERIA DE MATERIALES'),
(27, 'INGENIERIA MECANICA'),
(28, 'ENERGIA'),
(29, 'INGENIERIA NUCLEAR'),
(30, 'INGENIERIA PETROLERA'),
(31, 'INGENIERIA QUIMICA'),
(32, 'ECOLOGIA'),
(33, 'METALURGIA'),
(34, 'CIENCIAS DE LA COMPUTACION'),
(35, 'TELECOMUNICACIONES'),
(36, 'MECATRONICA'),
(37, 'HIDRAULICA'),
(38, 'SISMOLOGIA'),
(39, 'INGENIERIA CIVIL'),
(40, 'ASTRONOMÍA Y ASTROFÍSICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contabilidad`
--

CREATE TABLE IF NOT EXISTS `contabilidad` (
  `CONT_ID_CONTABILIDAD` int(11) NOT NULL AUTO_INCREMENT,
  `CONT_ID_USUARIO` varchar(30) DEFAULT NULL,
  `CONT_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CONT_NUM_JOBS` double DEFAULT NULL,
  `CONT_TIEMPO_PARED` double DEFAULT NULL,
  `CONT_HRS_NODO` double DEFAULT NULL,
  `CONT_MEM_RAM` double DEFAULT NULL,
  `CONT_DISCO_DURO` double DEFAULT NULL,
  PRIMARY KEY (`CONT_ID_CONTABILIDAD`),
  KEY `FK_REFERENCE_29` (`CONT_ID_USUARIO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `contabilidad`
--

INSERT INTO `contabilidad` (`CONT_ID_CONTABILIDAD`, `CONT_ID_USUARIO`, `CONT_FECHA`, `CONT_NUM_JOBS`, `CONT_TIEMPO_PARED`, `CONT_HRS_NODO`, `CONT_MEM_RAM`, `CONT_DISCO_DURO`) VALUES
(1, 'yoli', '2015-02-26 04:21:15', 20, NULL, 1200, NULL, NULL),
(3, 'yoli', '2015-02-26 04:31:11', 20, NULL, 3086.62, NULL, NULL),
(4, 'yoli', '2015-02-26 04:31:11', 20, NULL, 3086.62, NULL, NULL),
(5, 'yoli', '2015-02-27 00:59:38', 5, NULL, 400, NULL, NULL),
(7, 'yoli', '2015-04-01 02:45:47', 20, NULL, 3086.62, NULL, NULL),
(8, 'yoli', '2015-04-01 02:45:47', 20, NULL, 3086.62, NULL, NULL),
(9, 'yoli', '2015-04-06 03:43:27', 20, NULL, 3086.62, NULL, NULL),
(10, 'yoli', '2015-04-06 03:43:27', 20, NULL, 3086.62, NULL, NULL),
(11, 'omarsan', '2015-04-17 23:52:53', 20, NULL, 900000.62, NULL, NULL),
(12, 'vicvall', '2015-04-17 23:52:53', 20, NULL, 900000.62, NULL, NULL),
(13, 'zach_cislack', '2015-08-10 02:07:01', 20, NULL, 900000.62, NULL, NULL),
(14, 'ellie_cislack', '2015-08-10 02:07:01', 20, NULL, 900000.62, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convocatoria`
--

CREATE TABLE IF NOT EXISTS `convocatoria` (
  `CONVO_ID` int(11) NOT NULL,
  `CONVO_ANIO_CONVO` text,
  `CONVO_PROY_APROBADOS` text,
  `CONVO_TOTAL_RECURSOS_SOL` text,
  `CONVO_TOTAL_HRS` text,
  `CONVO_PERIODO` text,
  `CONVO_PERIODO_COMP` text,
  `CONVO_RITMO_MENS` text,
  `CONVO_DEVOLUCION` text,
  `CONVO_FECHA` text,
  `CONVO_VIGENCIA` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`CONVO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `convocatoria`
--

INSERT INTO `convocatoria` (`CONVO_ID`, `CONVO_ANIO_CONVO`, `CONVO_PROY_APROBADOS`, `CONVO_TOTAL_RECURSOS_SOL`, `CONVO_TOTAL_HRS`, `CONVO_PERIODO`, `CONVO_PERIODO_COMP`, `CONVO_RITMO_MENS`, `CONVO_DEVOLUCION`, `CONVO_FECHA`, `CONVO_VIGENCIA`) VALUES
(1, '2015-1', '99', '50', '36', 'Marzo 2015 - Enero 2016', '1 de marzo de 2015 hasta 31 de enero de 2016', '5', '31 de marzo de 2015', '24 de febrero de 2015', 'el 3 de junio de 2014 hasta el 31 de enero de 2016');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE IF NOT EXISTS `dependencia` (
  `DEPE_ID_DEPENDENCIA` int(11) NOT NULL AUTO_INCREMENT,
  `DEPE_ID_TIPO_DEPENDENCIA` int(11) DEFAULT NULL,
  `DEPE_NOMBRE` varchar(100) DEFAULT NULL,
  `DEPE_ACRONIMO` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`DEPE_ID_DEPENDENCIA`),
  KEY `FK_REFERENCE_36` (`DEPE_ID_TIPO_DEPENDENCIA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`DEPE_ID_DEPENDENCIA`, `DEPE_ID_TIPO_DEPENDENCIA`, `DEPE_NOMBRE`, `DEPE_ACRONIMO`) VALUES
(1, 1, 'PLAN DE BECARIOS DE SUPERCOMPUTO', 'BECSUP-I'),
(2, 2, 'BENEMERITA UNIVERSIDAD AUTONOMA DE PUEBLA', 'BUAP-E'),
(3, 1, 'CENTRO DE CIENCIAS DE LA ATMOSFERA', 'CCA-I'),
(5, 1, 'CENTRO DE CIENCIAS APLICADAS Y DESARROLLO TECNOLOGICO', 'CCADET'),
(6, 1, 'CENTRO DE CIENCIAS NUCLEARES', 'CCN-I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_colaboradora`
--

CREATE TABLE IF NOT EXISTS `estado_colaboradora` (
  `ESCO_ID_ESTADO_COLABORADORA` int(11) NOT NULL,
  `ESCO_TIPO_ESTADO` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ESCO_ID_ESTADO_COLABORADORA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_colaboradora`
--

INSERT INTO `estado_colaboradora` (`ESCO_ID_ESTADO_COLABORADORA`, `ESCO_TIPO_ESTADO`) VALUES
(1, 'Pendiente'),
(2, 'Aceptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_proyecto`
--

CREATE TABLE IF NOT EXISTS `estado_proyecto` (
  `ESPR_ID_ESTADO_PROYECTO` int(11) NOT NULL,
  `ESPR_TIPO_ESTADO` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ESPR_ID_ESTADO_PROYECTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_proyecto`
--

INSERT INTO `estado_proyecto` (`ESPR_ID_ESTADO_PROYECTO`, `ESPR_TIPO_ESTADO`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Terminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_solicitud`
--

CREATE TABLE IF NOT EXISTS `estado_solicitud` (
  `ESSO_ID_ESADO_SOLICITUD` int(11) NOT NULL AUTO_INCREMENT,
  `ESSO_NOMBRE` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ESSO_ID_ESADO_SOLICITUD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `estado_solicitud`
--

INSERT INTO `estado_solicitud` (`ESSO_ID_ESADO_SOLICITUD`, `ESSO_NOMBRE`) VALUES
(1, 'Pendiente'),
(2, 'Aceptada'),
(3, 'Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_usuario`
--

CREATE TABLE IF NOT EXISTS `estado_usuario` (
  `ESUS_ID_ESTADO_USUARIO` int(11) NOT NULL,
  `ESUS_ESTADO_NOMBRE` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ESUS_ID_ESTADO_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_usuario`
--

INSERT INTO `estado_usuario` (`ESUS_ID_ESTADO_USUARIO`, `ESUS_ESTADO_NOMBRE`) VALUES
(1, 'Activa'),
(2, 'Inactiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE IF NOT EXISTS `grado` (
  `GRAD_ID_GRADO` int(11) NOT NULL,
  `GRAD_NOMBRE` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`GRAD_ID_GRADO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`GRAD_ID_GRADO`, `GRAD_NOMBRE`) VALUES
(1, 'Licenciatura'),
(2, 'Maestría'),
(3, 'Doctorado'),
(4, 'Sin grado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquina`
--

CREATE TABLE IF NOT EXISTS `maquina` (
  `MAQU_ID_MAQUINA` int(11) NOT NULL,
  `MAQU_NOMBRE` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`MAQU_ID_MAQUINA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquina_login`
--

CREATE TABLE IF NOT EXISTS `maquina_login` (
  `MALO_ID_MAQUINA_LOGIN` int(11) NOT NULL AUTO_INCREMENT,
  `MALO_LOGIN` varchar(30) NOT NULL,
  `MALO_NOMBRE` varchar(60) DEFAULT NULL,
  `MALO_PASSWORD` varchar(60) DEFAULT NULL,
  `MALO_GRUPO_PRINCIPAL` varchar(60) DEFAULT NULL,
  `MALO_GRUPO_SECUNDARIO` varchar(60) DEFAULT NULL,
  `MALO_MAQUINA` varchar(60) NOT NULL DEFAULT 'MZ',
  `OBFUSCADA` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MALO_ID_MAQUINA_LOGIN`),
  KEY `FK_REFERENCE_43` (`MALO_LOGIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `maquina_login`
--

INSERT INTO `maquina_login` (`MALO_ID_MAQUINA_LOGIN`, `MALO_LOGIN`, `MALO_NOMBRE`, `MALO_PASSWORD`, `MALO_GRUPO_PRINCIPAL`, `MALO_GRUPO_SECUNDARIO`, `MALO_MAQUINA`, `OBFUSCADA`) VALUES
(1, 'yoli', 'LOURDES YOLANDA_FLORES_SALGADO', 'xxxxxx', 'yo_g', NULL, 'MZ', 1),
(2, 'omarsancc', 'OMAR_SANCHEZ_CASTILLO', 'xxxxxx', 'om_g', NULL, 'MZ', 1),
(3, 'yolita', 'YOLANDA_FLORES_SALGADO', 'xxxxxx', 'yo_g', NULL, 'MZ', 1),
(4, 'yolita1', 'YOLANDA_FLORES_SALGADO', 'xxxxxx', 'yo_g', NULL, 'MZ', 1),
(5, 'omar1', 'OMAR_SANCHEZ_CASTILLO', 'xxxxxx', 'yo_g', NULL, 'MZ', 1),
(6, 'omarsan', 'OMAR_SANCHEZ_CASTILLO', 'xxxxxx', 'om_g', NULL, 'MZ', 1),
(7, 'vicvall', 'VICTOR_VALDEZ_', 'xxxxxx', 'om_g', NULL, 'MZ', 1),
(8, 'omasan11', 'OMAR_SANCHEZ_CASTILLO', '#$%$GFY%&/.-', 'om_g', NULL, 'MZ', 0),
(9, 'omasan13', 'OMAR_SANCHEZ_CASTILLO', 'wnNS$Tg(RiFF', 'om_g', NULL, 'MZ', 0),
(10, 'omarsancast', 'OMAR_SANCHEZ_CASTILLO', '&,2.u)ILz,A!', 'om_g', NULL, 'MZ', NULL),
(11, 'omarsancasttt', 'OMAR_SANCHEZ_CASTILLO', 'm(2qYLtTUGqc', 'om_g', NULL, 'MZ', NULL),
(12, 'okasin', 'OMAR_SANCHEZ_CASTILLO', 'bfr-6u}m*-%B', 'ok_g', NULL, 'MZ', NULL),
(13, 'okasinnnn', 'OMAR_SANCHEZ_CASTILLO', 'eZ7@k5r_([+L', 'ok_g', NULL, 'MZ', NULL),
(14, 'okasinnn', 'OMAR_SANCHEZ_CASTILLO', 'U-nU?F6y/J(k', 'ok_g', NULL, 'MZ', NULL),
(15, '455654', 'OMAR_SANCHEZ_CASTILLO', '+S=/5mNrxH-!', '45_g', NULL, 'MZ', NULL),
(16, '5454325', 'JOSE _CANSECO_', '?sxItXw,7}QK', '45_g', NULL, 'MZ', NULL),
(17, '4556545', 'OMAR_SANCHEZ_CASTILLO', 'CnHB(cSIB3iJ', '45_g', NULL, 'MZ', NULL),
(18, '664454', 'JOSE _CANSECO_', 'zK1Cp{td{1G*', '45_g', NULL, 'MZ', NULL),
(19, '56736452', 'OMAR_SANCHEZ_CASTILLO', 'dI&A?XE0Ua?E', '56_g', 'g09,adf', 'MZ', NULL),
(20, '56736055', 'JOSE _CANSECO_', '}[$&)!=.6Eu(', '56_g', 'g09,adf', 'MZ', NULL),
(21, 'zach_cislack', 'OMAR_SANCHEZ_CASTILLO', 'GjWR+%a/ZvM3', 'za_g', 'g09,adf', 'MZ', NULL),
(22, 'ellie_cislack', 'OMAR_SANCHEZ_CASTILLO', '8//V=JQ@F@sG', 'za_g', 'g09,adf', 'MZ', NULL),
(23, 'neworder', 'OMAR_SANCHEZ_CASTILLO', '%MU,(0z{C)W%', 'ne_g', 'g09', 'MZ', NULL),
(24, 'newordercol', 'OMAR_SANCHEZ_', 'z)=CqbIDUR4C', 'ne_g', 'g09', 'MZ', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquina_x_proyecto`
--

CREATE TABLE IF NOT EXISTS `maquina_x_proyecto` (
  `MAPR_ID_MAQUINA_X_PROYECTO` int(11) NOT NULL,
  `MAPR_ID_PROYECTO` int(11) NOT NULL,
  `MAPR_ID_MAQUINA` int(11) NOT NULL,
  `MAPR_NUM_MES` int(11) DEFAULT NULL,
  `MAPR_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MAPR_NUM_JOBS` double DEFAULT NULL,
  `MAPR_TOTAL_NUM_JOBS` double DEFAULT NULL,
  `MAPR_TIEMPO_PARED` double DEFAULT NULL,
  `MAPR_TOTAL_TIEMPO_PARED` double DEFAULT NULL,
  `MAPR_NUM_HRSCPU` double DEFAULT NULL,
  `MAPR_TOTAL_NUM_HRSCPU` double DEFAULT NULL,
  `MAPR_MEM_RAM` double DEFAULT NULL,
  `MAPR_TOTAL_MEM_RAM` double DEFAULT NULL,
  `MAPR_DISCO_DURO` double DEFAULT NULL,
  `MAPR_TOTAL_DISCO_DURO` double DEFAULT NULL,
  `MAPR_PORCENTAJE` double DEFAULT NULL,
  `MAPR_USO_APP` double DEFAULT NULL,
  `MAPR_TOTAL_USO_APP` double DEFAULT NULL,
  PRIMARY KEY (`MAPR_ID_MAQUINA_X_PROYECTO`,`MAPR_ID_PROYECTO`,`MAPR_ID_MAQUINA`),
  KEY `FK_REFERENCE_22` (`MAPR_ID_PROYECTO`),
  KEY `FK_REFERENCE_23` (`MAPR_ID_MAQUINA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_comunicacion`
--

CREATE TABLE IF NOT EXISTS `medio_comunicacion` (
  `MECO_ID_MEDIO_COMUNICACION` int(11) NOT NULL AUTO_INCREMENT,
  `MECO_TELEFONO1` char(10) DEFAULT NULL,
  `MECO_EXTENSION` char(10) DEFAULT NULL,
  `MECO_TELEFONO2` char(10) DEFAULT NULL,
  `MECO_CORREO` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`MECO_ID_MEDIO_COMUNICACION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `medio_comunicacion`
--

INSERT INTO `medio_comunicacion` (`MECO_ID_MEDIO_COMUNICACION`, `MECO_TELEFONO1`, `MECO_EXTENSION`, `MECO_TELEFONO2`, `MECO_CORREO`) VALUES
(1, '56228577', '28577', '', 'yoli@unam.mx'),
(2, '56228577', '28577', '', 'yoli@unam.mx'),
(3, '777', '', '', 'omar@super.unam.mx'),
(4, '56798', '898', '9898', 'moroccosc@gmail.com'),
(5, '89898', '9898989', '898989', '898@gmail.com'),
(6, '56736452', '', '', 'omarsanchezcas@gmail.com'),
(7, '56736452', '', '', 'omarsanchezcas@gmail.com'),
(8, '88990', '', '', 'yoli@super.unam.mx'),
(9, '777777', '', '', 'omar@super.unam.mx'),
(10, '777', '', '', 'yoli@super.unam.mx'),
(11, '777777', '', '', 'omar@super.unam.mx'),
(12, '5673498', '', '', 'omarsanchezcas@gmail.com'),
(13, '567989', '998', '989', 'victor@gmail.com'),
(14, '56735467', '', '', 'omarsanchezcas@gmail.com'),
(15, '56730808', '', '', 'julio@gmail.com'),
(16, '768787', '', '', 'omarsanchezcas@gmail.com'),
(17, '87877', '877', '', 'pepe@gmail.com'),
(18, '5673546', '8787', '', 'omarsanchezcas@gmail.com'),
(19, '', '', '', 'omar@gmail.com'),
(20, '56736452', '4152', '', 'omarsanchezcas@gmail.com'),
(21, '56736452', '', '', 'moroccosc@gmail.com'),
(22, '56736452', '4152', '', 'omarsanchezcas@gmail.com'),
(23, '', '', '', ''),
(24, '56736452', '', '', 'omarsanchezcas@gmail.com'),
(25, '56736452', '14330', '', 'moroccosc@gmail.com'),
(26, '56736452', '', '', 'omar_sanchezcas@live.com'),
(27, '5645455', '', '', 'jose@gmail.com'),
(28, '56736452', '', '', 'omar_sanchezcas@live.com'),
(29, '', '', '', 'moroccosc@gmail.com'),
(30, '', '', '', 'moroccosc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otra_app`
--

CREATE TABLE IF NOT EXISTS `otra_app` (
  `OTAP_ID_OTRA_APP` int(11) NOT NULL AUTO_INCREMENT,
  `OTAP_ID_SOLICITUD_ABSTRACTA` bigint(20) DEFAULT NULL,
  `OTAP_OPCION` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`OTAP_ID_OTRA_APP`),
  KEY `FK_REFERENCE_39` (`OTAP_ID_SOLICITUD_ABSTRACTA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `otra_app`
--

INSERT INTO `otra_app` (`OTAP_ID_OTRA_APP`, `OTAP_ID_SOLICITUD_ABSTRACTA`, `OTAP_OPCION`) VALUES
(1, 1, 'python'),
(2, 2, 'python');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otro_campo_trabajo`
--

CREATE TABLE IF NOT EXISTS `otro_campo_trabajo` (
  `OTCA_ID_OTRO_CAMPO` int(11) NOT NULL AUTO_INCREMENT,
  `OTCA_NOMBRE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`OTCA_ID_OTRO_CAMPO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `otro_campo_trabajo`
--

INSERT INTO `otro_campo_trabajo` (`OTCA_ID_OTRO_CAMPO`, `OTCA_NOMBRE`) VALUES
(1, ''),
(2, ''),
(3, 'sdoi'),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, 'N/A'),
(9, 'N/A'),
(10, 'Nanotecnología'),
(11, 'nanocomputer'),
(12, 'N/A'),
(13, 'N/A'),
(14, 'N/A'),
(15, 'N/A'),
(16, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE IF NOT EXISTS `proyecto` (
  `PROY_ID_PROYECTO` int(11) NOT NULL AUTO_INCREMENT,
  `PROY_ID_SOLICITUD_ABSTRACTA` bigint(20) DEFAULT NULL,
  `PROY_ID_COMPUESTO` varchar(100) DEFAULT NULL,
  `PROY_ID_ESTADO_PROYECTO` int(11) DEFAULT NULL,
  `PROY_ID_TIPO_PROYECTO` int(11) DEFAULT NULL,
  `PROY_NOMBRE` varchar(100) DEFAULT NULL,
  `PROY_FEC_INI_RECU` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PROY_FEC_TERM_RECU` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PROY_FEC_CAMBIO_EST` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PROY_FEC_REANUD_EST` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PROY_FECHA_REGISTRO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PROY_HRS_APROBADAS` int(11) DEFAULT NULL,
  PRIMARY KEY (`PROY_ID_PROYECTO`),
  KEY `FK_REFERENCE_11` (`PROY_ID_ESTADO_PROYECTO`),
  KEY `FK_REFERENCE_27` (`PROY_ID_TIPO_PROYECTO`),
  KEY `FK_REFERENCE_9` (`PROY_ID_SOLICITUD_ABSTRACTA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`PROY_ID_PROYECTO`, `PROY_ID_SOLICITUD_ABSTRACTA`, `PROY_ID_COMPUESTO`, `PROY_ID_ESTADO_PROYECTO`, `PROY_ID_TIPO_PROYECTO`, `PROY_NOMBRE`, `PROY_FEC_INI_RECU`, `PROY_FEC_TERM_RECU`, `PROY_FEC_CAMBIO_EST`, `PROY_FEC_REANUD_EST`, `PROY_FECHA_REGISTRO`, `PROY_HRS_APROBADAS`) VALUES
(1, 1, 'SC14-1-S-1', 1, 1, 'mi proyecto', '2015-04-14 02:19:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3000000),
(2, 3, 'SC14-1-S-3', 1, 1, 'mi proyecto 2', '2015-02-26 04:52:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10000),
(3, 5, 'SC15-1-I-5', 1, 2, 'Mi proyecto chi2', '2015-02-26 18:51:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000),
(4, 7, 'SC15-1-IG-7', 1, 5, 'mi proyecto', '2015-02-27 00:39:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000000),
(5, 7, 'SC15-1-IG-7', 1, 5, 'mi proyecto', '2015-02-27 00:39:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000000),
(6, 8, 'SC14-1-S-8', 1, 1, 'RSIDS', '2015-04-17 23:45:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000000),
(7, 9, 'SC15-2-I-9', 1, 2, 'Solar panel data', '2015-05-03 21:42:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 900000),
(8, 10, 'SC15-1-R-10', 1, 4, 'Yeoman', '2015-05-03 21:53:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 950000),
(9, 11, 'SC16-1-S-11', 1, 1, 'Grunt.js', '2015-05-03 22:06:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 900000),
(10, 13, 'SC14-1-S-13', 1, 1, 'Cluster Settlement in grid computing', '2015-07-09 03:14:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2000000),
(11, 13, 'SC14-1-S-13', 1, 1, 'Cluster Settlement in grid computing', '2015-07-09 03:16:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2000000),
(12, 13, 'SC14-1-S-13', 1, 1, 'Cluster Settlement in grid computing', '2015-07-09 03:17:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2000000),
(13, 13, 'SC14-1-S-13', 1, 1, 'Cluster Settlement in grid computing', '2015-07-09 03:19:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2000000),
(14, 12, 'SC14-1-S-12', 1, 1, 'Cluster Settlement in grid computing', '2015-07-09 03:22:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 452),
(15, 12, 'SC14-1-S-12', 1, 1, 'Cluster Settlement in grid computing', '2015-07-09 03:49:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 452),
(16, 12, 'SC14-1-S-12', 1, 1, 'Cluster Settlement in grid computing', '2015-07-09 03:55:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 452),
(17, 14, 'SC14-1-M-14', 1, 3, 'Juana Bolena', '2015-08-10 01:32:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000000),
(18, 16, 'SC15-2-M-16', 1, 3, 'Proyecto nuevo', '2015-08-31 02:36:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_abstracta`
--

CREATE TABLE IF NOT EXISTS `solicitud_abstracta` (
  `SOAB_ID_SOLICITUD_ABSTRACTA` bigint(20) NOT NULL AUTO_INCREMENT,
  `SOAB_ID_TIPO_SOLICITUD` int(11) DEFAULT NULL,
  `SOAB_ID_ESTADO_SOLICITUD` int(11) DEFAULT NULL,
  `SOAB_ID_DEPENDENCIA` int(11) DEFAULT NULL,
  `SOAB_ID_MEDIO_COMUNICACION` int(11) DEFAULT NULL,
  `SOAB_ID_GRADO` int(11) DEFAULT NULL,
  `SOAB_ID_CAMPO_TRABAJO` int(11) DEFAULT NULL,
  `SOAB_ID_OTRO_CAMPO` int(11) DEFAULT NULL,
  `SOAB_ID_SOLICITUD_RENOVACION` bigint(20) DEFAULT NULL,
  `SOAB_AP_PATERNO` varchar(50) DEFAULT NULL,
  `SOAB_AP_MATERNO` varchar(50) DEFAULT NULL,
  `SOAB_NOMBRES` varchar(55) DEFAULT NULL,
  `SOAB_NOMBRE_PROYECTO` varchar(100) DEFAULT NULL,
  `SOAB_SEXO` char(1) DEFAULT NULL,
  `SOAB_CURRICULUM` varchar(255) DEFAULT NULL,
  `SOAB_DESC_PROYECTO` varchar(255) DEFAULT NULL,
  `SOAB_CON_ADSCRIPCION` varchar(255) DEFAULT NULL,
  `SOAB_HRS_CPU` int(11) DEFAULT NULL,
  `SOAB_ESP_HD` int(11) DEFAULT NULL,
  `SOAB_MEM_RAM` int(11) DEFAULT NULL,
  `SOAB_PROG_PARALELA` smallint(6) DEFAULT NULL,
  `SOAB_NUM_PROC_TRAB` int(11) DEFAULT NULL,
  `SOAB_DURACION` int(11) DEFAULT NULL,
  `SOAB_FEC_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `SOAB_PROY_NOTIFICADO` smallint(6) DEFAULT NULL,
  `SOAB_ES_PROYECTO` smallint(6) DEFAULT NULL,
  `SOAB_LIN_ESPECIALIZACION` varchar(100) DEFAULT NULL,
  `SOAB_MOD_COMPUTACIONAL` varchar(100) DEFAULT NULL,
  `SOAB_DESC_RECHAZO` text,
  `SOAB_RUTA_ARCHIVOS` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SOAB_ID_SOLICITUD_ABSTRACTA`),
  KEY `FK_REFERENCE_18` (`SOAB_ID_MEDIO_COMUNICACION`),
  KEY `FK_REFERENCE_34` (`SOAB_ID_GRADO`),
  KEY `FK_REFERENCE_38` (`SOAB_ID_SOLICITUD_RENOVACION`),
  KEY `FK_REFERENCE_4` (`SOAB_ID_TIPO_SOLICITUD`),
  KEY `FK_REFERENCE_40` (`SOAB_ID_CAMPO_TRABAJO`),
  KEY `FK_REFERENCE_41` (`SOAB_ID_OTRO_CAMPO`),
  KEY `FK_REFERENCE_5` (`SOAB_ID_ESTADO_SOLICITUD`),
  KEY `FK_REFERENCE_6` (`SOAB_ID_DEPENDENCIA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `solicitud_abstracta`
--

INSERT INTO `solicitud_abstracta` (`SOAB_ID_SOLICITUD_ABSTRACTA`, `SOAB_ID_TIPO_SOLICITUD`, `SOAB_ID_ESTADO_SOLICITUD`, `SOAB_ID_DEPENDENCIA`, `SOAB_ID_MEDIO_COMUNICACION`, `SOAB_ID_GRADO`, `SOAB_ID_CAMPO_TRABAJO`, `SOAB_ID_OTRO_CAMPO`, `SOAB_ID_SOLICITUD_RENOVACION`, `SOAB_AP_PATERNO`, `SOAB_AP_MATERNO`, `SOAB_NOMBRES`, `SOAB_NOMBRE_PROYECTO`, `SOAB_SEXO`, `SOAB_CURRICULUM`, `SOAB_DESC_PROYECTO`, `SOAB_CON_ADSCRIPCION`, `SOAB_HRS_CPU`, `SOAB_ESP_HD`, `SOAB_MEM_RAM`, `SOAB_PROG_PARALELA`, `SOAB_NUM_PROC_TRAB`, `SOAB_DURACION`, `SOAB_FEC_REGISTRO`, `SOAB_PROY_NOTIFICADO`, `SOAB_ES_PROYECTO`, `SOAB_LIN_ESPECIALIZACION`, `SOAB_MOD_COMPUTACIONAL`, `SOAB_DESC_RECHAZO`, `SOAB_RUTA_ARCHIVOS`) VALUES
(1, 1, 2, 1, 1, 2, 14, 1, NULL, 'FLORES', 'SALGADO', 'LOURDES YOLANDA', 'mi proyecto', 'f', '/var/www/html/rsids/public/uploads/1_Solicitud_1424397684/1_CV.pdf', '/var/www/html/rsids/public/uploads/1_Solicitud_1424397684/1_DOCDESC.pdf', '/var/www/html/rsids/public/uploads/1_Solicitud_1424397684/1_CONSTANCIA.pdf', 2500000, 10, 200, 1, 16, 1, '2015-02-26 04:38:30', 1, 1, 'Administración UNIX', 'Programación paralela', NULL, '/var/www/html/rsids/public/uploads/1_Solicitud_1424397684'),
(2, 1, 3, NULL, 2, 2, 14, 2, NULL, 'FLORES', 'SALGADO', 'LOURDES YOLANDA', 'mi proyecto', 'm', '/var/www/html/rsids/public/uploads/2_Solicitud_1424397998/2_CV.pdf', '/var/www/html/rsids/public/uploads/2_Solicitud_1424397998/2_DOCDESC.pdf', '/var/www/html/rsids/public/uploads/2_Solicitud_1424397998/2_CONSTANCIA.pdf', 2500000, 10, 200, 1, 16, 1, '2015-02-20 02:19:17', NULL, NULL, 'Administración UNIX', 'Programación paralela', 'ud es elemento non grato', '/var/www/html/rsids/public/uploads/2_Solicitud_1424397998'),
(3, 1, 2, 1, 4, 1, 1, 3, NULL, 'Sanchez', 'Castillo', 'Omar', 'mi proyecto 2', 'f', '/var/www/html/rsids/public/uploads/3_Solicitud_1424926064/3_CV.pdf', '/var/www/html/rsids/public/uploads/3_Solicitud_1424926064/3_DOCDESC.pdf', '/var/www/html/rsids/public/uploads/3_Solicitud_1424926064/3_CONSTANCIA.pdf', 1000000, 324, 12, 1, 4, 3, '2015-02-26 18:27:38', 1, 1, 'informática', 'modelo comp', NULL, '/var/www/html/rsids/public/uploads/3_Solicitud_1424926064'),
(5, 1, 2, 3, 7, 1, 4, 5, NULL, 'Sanchez', 'Castillo', 'Omar', 'Mi proyecto chi2', 'm', '/var/www/html/rsids/public/uploads/5_Solicitud_1424976490/5_CV.pdf', '/var/www/html/rsids/public/uploads/5_Solicitud_1424976490/5_DOCDESC.pdf', '/var/www/html/rsids/public/uploads/5_Solicitud_1424976490/5_CONSTANCIA.pdf', 1000000, 54, 12, 1, 4, 3, '2015-02-26 18:59:01', 1, 1, 'mates para niños', 'hadoukeb', NULL, '/var/www/html/rsids/public/uploads/5_Solicitud_1424976490'),
(7, 1, 2, 5, 10, 2, 14, 7, NULL, 'Flores', 'Salgado', 'Yolanda', 'mi proyecto', 'f', '/var/www/html/rsids/public/uploads/7_Solicitud_1424997082/7_CV.pdf', '/var/www/html/rsids/public/uploads/7_Solicitud_1424997082/7_DOCDESC.pdf', '/var/www/html/rsids/public/uploads/7_Solicitud_1424997082/7_CONSTANCIA.pdf', 1000000, 0, 0, 1, 16, 1, '2015-02-27 00:46:45', 1, 1, 'unix', 'ni idea', NULL, '/var/www/html/rsids/public/uploads/7_Solicitud_1424997082'),
(8, 1, 2, 5, 12, 1, 6, 8, NULL, 'Sanchez', 'Castillo', 'Omar', 'RSIDS', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/8_Solicitud_1429314264/8_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/8_Solicitud_1429314264/8_DOCDESC.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/8_Solicitud_1429314264/8_CONSTANCIA.pdf', 1000000, 67, 12, 0, 1, 1, '2015-04-17 23:48:16', 1, 1, 'LO QUE SEA', 'OP', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/8_Solicitud_1429314264'),
(9, 1, 2, 3, 14, 3, 3, 9, NULL, 'Sánchez', 'Castillo', 'Omar', 'Solar panel data', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/9_Solicitud_1430689200/9_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/9_Solicitud_1430689200/9_DOCDESC.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/9_Solicitud_1430689200/9_CONSTANCIA.pdf', 100000, 56, 12, 1, 6, 2, '2015-05-03 21:42:24', 0, 1, 'Back-end development', 'markov line', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/9_Solicitud_1430689200'),
(10, 1, 2, 1, 16, 2, 1, 10, NULL, 'Sánchez', 'Castillo', 'Omar', 'Yeoman', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/10_Solicitud_1430689949/10_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/10_Solicitud_1430689949/10_DOCDESC.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/10_Solicitud_1430689949/10_CONSTANCIA.pdf', 100000, 56, 45, 1, 8, 1, '2015-05-03 21:55:16', 1, 1, 'Back-end development', 'Front end tools', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/10_Solicitud_1430689949'),
(11, 1, 2, 1, 18, 2, 1, 11, NULL, 'Sánchez', 'Castillo', 'Omar', 'Grunt.js', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/11_Solicitud_1430690687/11_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/11_Solicitud_1430690687/11_DOCDESC.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/11_Solicitud_1430690687/11_CONSTANCIA.pdf', 100000, 56, 5, 1, 5, 1, '2015-05-03 22:06:11', 0, 1, 'Front-end automatization', 'parallel', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/11_Solicitud_1430690687'),
(12, 1, 2, 3, 20, 1, 8, 12, NULL, 'Sánchez', 'Castillo', 'Omar', 'Cluster Settlement in grid computing', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/12_Solicitud_1436410400/12_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/12_Solicitud_1436410400/12_DOCDESC.pdf', NULL, 20000, 0, 0, 1, 4, 3, '2015-07-09 03:22:38', 0, 1, 'computo', 'computo mil', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/12_Solicitud_1436410400'),
(13, 1, 2, 3, 22, 1, 8, 13, NULL, 'Sánchez', 'Castillo', 'Omar', 'Cluster Settlement in grid computing', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/13_Solicitud_1436410463/13_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/13_Solicitud_1436410463/13_DOCDESC.pdf', NULL, 20000, 0, 0, 1, 4, 3, '2015-07-09 03:14:45', 0, 1, 'computo', 'computo mil', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/13_Solicitud_1436410463'),
(14, 2, 1, 3, 24, 2, 2, 14, 12, 'Sánchezc', 'Castillo', 'Omar', 'Juana Bolena', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/14_Solicitud_1439168339/14_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/14_Solicitud_1439168339/14_DOCDESC.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/14_Solicitud_1439168339/14_CONSTANCIA.pdf', 10000, 256, 54, 1, 4, 1, '2015-09-09 04:20:15', 1, 0, 'fisica cuántica', 'mod phys', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/14_Solicitud_1439168339'),
(15, 1, 1, 1, 26, 1, 5, 15, NULL, 'Sánchez', 'Castillo', 'omar', 'Proyecto nuevo', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/15_Solicitud_1440985472/15_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/15_Solicitud_1440985472/15_DOCDESC.pdf', NULL, 100000, 56, 256, 1, 4, 3, '2015-08-31 01:44:32', 0, NULL, 'Simulación de agujeros negros', 'Hola que hace', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/15_Solicitud_1440985472'),
(16, 1, 2, 1, 28, 1, 5, 16, NULL, 'Sánchez', 'Castillo', 'omar', 'Proyecto nuevo', 'm', 'C:\\xampp\\htdocs\\rsids\\public/uploads/16_Solicitud_1440985571/16_CV.pdf', 'C:\\xampp\\htdocs\\rsids\\public/uploads/16_Solicitud_1440985571/16_DOCDESC.pdf', NULL, 100000, 56, 256, 1, 4, 3, '2015-08-31 02:36:32', 0, 1, 'Simulación de agujeros negros', 'hola', NULL, 'C:\\xampp\\htdocs\\rsids\\public/uploads/16_Solicitud_1440985571');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_cta_colaboradora`
--

CREATE TABLE IF NOT EXISTS `solicitud_cta_colaboradora` (
  `SOCO_ID_SOLICITUD_COLABORADORA` bigint(20) NOT NULL AUTO_INCREMENT,
  `SOCO_ID_SOLICITUD_ABSTRACTA` bigint(20) DEFAULT NULL,
  `SOCO_ID_ESTADO_COLABORADORA` int(11) DEFAULT NULL,
  `SOCO_ID_MEDIO_COMUNICACION` int(11) DEFAULT NULL,
  `SOCO_ID_DEPENDENCIA` int(11) DEFAULT NULL,
  `SOCO_ID_GRADO` int(11) DEFAULT NULL,
  `SOCO_AP_PATERNO` varchar(50) DEFAULT NULL,
  `SOCO_AP_MATERNO` varchar(50) DEFAULT NULL,
  `SOCO_NOMBRES` varchar(55) DEFAULT NULL,
  `SOCO_SEXO` char(1) DEFAULT NULL,
  `SOCO_FEC_CAMBIO_EST` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `SOCO_FEC_REANUD_EST` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SOCO_FECHA_REGISTRO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`SOCO_ID_SOLICITUD_COLABORADORA`),
  KEY `FK_REFERENCE_26` (`SOCO_ID_SOLICITUD_ABSTRACTA`),
  KEY `FK_REFERENCE_31` (`SOCO_ID_ESTADO_COLABORADORA`),
  KEY `FK_REFERENCE_32` (`SOCO_ID_MEDIO_COMUNICACION`),
  KEY `FK_REFERENCE_33` (`SOCO_ID_DEPENDENCIA`),
  KEY `FK_REFERENCE_35` (`SOCO_ID_GRADO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `solicitud_cta_colaboradora`
--

INSERT INTO `solicitud_cta_colaboradora` (`SOCO_ID_SOLICITUD_COLABORADORA`, `SOCO_ID_SOLICITUD_ABSTRACTA`, `SOCO_ID_ESTADO_COLABORADORA`, `SOCO_ID_MEDIO_COMUNICACION`, `SOCO_ID_DEPENDENCIA`, `SOCO_ID_GRADO`, `SOCO_AP_PATERNO`, `SOCO_AP_MATERNO`, `SOCO_NOMBRES`, `SOCO_SEXO`, `SOCO_FEC_CAMBIO_EST`, `SOCO_FEC_REANUD_EST`, `SOCO_FECHA_REGISTRO`) VALUES
(1, 1, 2, 3, 1, 1, 'S', NULL, 'Omar', 'm', '2015-02-20 02:45:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 3, NULL, 5, 1, 1, 'Luis', 'Espinosa', 'Pepe', 'm', '2015-02-26 04:47:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 7, NULL, 11, 1, 4, 'Sánchez', 'Castillo', 'Omar', 'm', '2015-02-27 00:31:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 8, NULL, 13, 1, 2, 'Valdez', '', 'Victor', 'm', '2015-04-17 23:44:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 9, NULL, 15, 1, 2, 'Sánchez', 'Castillo', 'Julio', 'm', '2015-05-03 21:40:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 10, NULL, 17, 1, 1, 'perez', 'sanchez', 'pepe', 'm', '2015-05-03 21:52:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 11, NULL, 19, 1, 1, 'Sanchez', 'Castillo', 'Omar', 'm', '2015-05-03 22:04:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 12, NULL, 21, 1, 1, 'Canseco', '', 'Jose ', 'm', '2015-07-09 02:53:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 13, NULL, 23, 1, 1, 'sanchez', 'castillo', 'Omar', 'm', '2015-07-09 02:54:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 14, NULL, 25, 1, 1, 'Sánchez', 'Castillo', 'Omar', 'm', '2015-08-10 00:58:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 15, NULL, 27, 1, 1, 'Sánchez', 'Castillo', 'Jose ', 'm', '2015-08-31 01:44:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 16, NULL, 29, 1, 1, 'sanchez', '', 'omar', 'm', '2015-08-31 01:46:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 14, NULL, 30, 1, 1, 'sanchez', '', 'omar', 'm', '2015-09-04 01:56:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_renovacion`
--

CREATE TABLE IF NOT EXISTS `solicitud_renovacion` (
  `SORE_ID_SOLICITUD_RENOVACION` bigint(20) NOT NULL AUTO_INCREMENT,
  `SORE_ARGUMENTACION` text,
  `SORE_ART_INTERNAC` mediumtext CHARACTER SET latin1 COLLATE latin1_bin,
  `SORE_ART_NACIONAL` mediumtext CHARACTER SET latin1 COLLATE latin1_bin,
  `SORE_ART_INDEXADO` mediumtext CHARACTER SET latin1 COLLATE latin1_bin,
  `SORE_ART_DIFUSION` mediumtext CHARACTER SET latin1 COLLATE latin1_bin,
  `SORE_TESIS` mediumtext CHARACTER SET latin1 COLLATE latin1_bin,
  `SORE_CONGRESOS` mediumtext CHARACTER SET latin1 COLLATE latin1_bin,
  `SORE_LIBROS` mediumtext CHARACTER SET latin1 COLLATE latin1_bin,
  PRIMARY KEY (`SORE_ID_SOLICITUD_RENOVACION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `solicitud_renovacion`
--

INSERT INTO `solicitud_renovacion` (`SORE_ID_SOLICITUD_RENOVACION`, `SORE_ARGUMENTACION`, `SORE_ART_INTERNAC`, `SORE_ART_NACIONAL`, `SORE_ART_INDEXADO`, `SORE_ART_DIFUSION`, `SORE_TESIS`, `SORE_CONGRESOS`, `SORE_LIBROS`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_x_app`
--

CREATE TABLE IF NOT EXISTS `solicitud_x_app` (
  `SOAP_ID_SOLICITUD_X_APLICACION` int(11) NOT NULL AUTO_INCREMENT,
  `SOAP_ID_APLICACION` int(11) NOT NULL,
  `SOAP_ID_SOLICITUD_ABSTRACTA` bigint(20) NOT NULL,
  PRIMARY KEY (`SOAP_ID_SOLICITUD_X_APLICACION`,`SOAP_ID_APLICACION`,`SOAP_ID_SOLICITUD_ABSTRACTA`),
  KEY `FK_REFERENCE_24` (`SOAP_ID_SOLICITUD_ABSTRACTA`),
  KEY `FK_REFERENCE_25` (`SOAP_ID_APLICACION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Volcado de datos para la tabla `solicitud_x_app`
--

INSERT INTO `solicitud_x_app` (`SOAP_ID_SOLICITUD_X_APLICACION`, `SOAP_ID_APLICACION`, `SOAP_ID_SOLICITUD_ABSTRACTA`) VALUES
(3, 1, 1),
(6, 1, 2),
(11, 1, 3),
(19, 1, 5),
(25, 1, 7),
(30, 1, 8),
(34, 1, 9),
(39, 1, 10),
(43, 1, 11),
(46, 1, 12),
(49, 1, 13),
(54, 1, 14),
(58, 1, 15),
(62, 1, 16),
(1, 2, 1),
(4, 2, 2),
(16, 2, 5),
(23, 2, 7),
(27, 2, 8),
(31, 2, 9),
(55, 2, 15),
(59, 2, 16),
(2, 3, 1),
(5, 3, 2),
(24, 3, 7),
(35, 3, 10),
(40, 3, 11),
(7, 4, 3),
(28, 4, 8),
(32, 4, 9),
(63, 4, 16),
(17, 5, 5),
(36, 5, 10),
(41, 5, 11),
(8, 6, 3),
(33, 6, 9),
(9, 7, 3),
(18, 7, 5),
(37, 7, 10),
(42, 7, 11),
(10, 9, 3),
(26, 9, 7),
(38, 9, 10),
(50, 9, 13),
(51, 9, 12),
(52, 9, 14),
(56, 9, 15),
(60, 9, 16),
(29, 11, 8),
(64, 12, 16),
(44, 13, 12),
(47, 13, 13),
(57, 13, 15),
(61, 13, 16),
(45, 14, 12),
(48, 14, 13),
(53, 14, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_dependencia`
--

CREATE TABLE IF NOT EXISTS `tipo_dependencia` (
  `TIDE_ID_TIPO_DEPENDENCIA` int(11) NOT NULL,
  `TIDE_TIPO` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`TIDE_ID_TIPO_DEPENDENCIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_dependencia`
--

INSERT INTO `tipo_dependencia` (`TIDE_ID_TIPO_DEPENDENCIA`, `TIDE_TIPO`) VALUES
(1, 'Interna'),
(2, 'Externa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_proyecto`
--

CREATE TABLE IF NOT EXISTS `tipo_proyecto` (
  `TIPR_ID_TIPO_PROYECTO` int(11) NOT NULL,
  `TIPR_NOMBRE_TIPO_PROYECTO` varchar(35) DEFAULT NULL,
  `TIPR_CLAVE_TIPO_PROYECTO` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`TIPR_ID_TIPO_PROYECTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_proyecto`
--

INSERT INTO `tipo_proyecto` (`TIPR_ID_TIPO_PROYECTO`, `TIPR_NOMBRE_TIPO_PROYECTO`, `TIPR_CLAVE_TIPO_PROYECTO`) VALUES
(1, 'Semilla', 'S'),
(2, 'Investigación', 'I'),
(3, 'Mega proyecto de investigacion', 'M'),
(4, 'Investigacion Regular', 'R'),
(5, 'Investigacion grande', 'IG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_solicitud`
--

CREATE TABLE IF NOT EXISTS `tipo_solicitud` (
  `TISO_ID_TIPO_SOLICITUD` int(11) NOT NULL,
  `TISO_NOMBRE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`TISO_ID_TIPO_SOLICITUD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_solicitud`
--

INSERT INTO `tipo_solicitud` (`TISO_ID_TIPO_SOLICITUD`, `TISO_NOMBRE`) VALUES
(1, 'Del Periodo'),
(2, 'Renovación'),
(3, 'Ampliación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `TIUS_ID_TIPO_USUARIO` int(11) NOT NULL,
  `TIUS_TIPO_NOMBRE` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`TIUS_ID_TIPO_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`TIUS_ID_TIPO_USUARIO`, `TIUS_TIPO_NOMBRE`) VALUES
(1, 'Administrador'),
(2, 'Cuenta titular'),
(3, 'Cuenta colaboradora'),
(4, 'Adminstrador Colaborador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `USUA_ID_USUARIO` varchar(30) NOT NULL,
  `USUA_ID_TIPO_USUARIO` int(11) DEFAULT NULL,
  `USUA_ID_ESTADO_USUARIO` int(11) NOT NULL,
  `USUA_NOM_COMPLETO` varchar(60) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `remember_token` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`USUA_ID_USUARIO`),
  KEY `FK_REFERENCE_37` (`USUA_ID_TIPO_USUARIO`),
  KEY `FK_REFERENCE_46` (`USUA_ID_ESTADO_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`USUA_ID_USUARIO`, `USUA_ID_TIPO_USUARIO`, `USUA_ID_ESTADO_USUARIO`, `USUA_NOM_COMPLETO`, `password`, `remember_token`) VALUES
('455654', 2, 1, 'Omar Sánchez Castillo', '$2y$10$Ea61q1NzUBEIF6WHdgCN0O3sTeq0Nv5XkdqFYw6jF2AerAOJ54iK.', NULL),
('4556545', 2, 1, 'Omar Sánchez Castillo', '$2y$10$N.ygZmMiMdDiNnnN5Ok5GeLJBCdq6hCoxt9cHDbRhMtRdG7K00r62', NULL),
('5454325', 3, 1, 'Jose  Canseco ', '$2y$10$hWr0mreWTKq0owzCBe60.eLTZuPsIlugQPQcxm5SCJf4NGjZCIA8q', NULL),
('56736055', 3, 1, 'Jose  Canseco ', '$2y$10$83pagTopZSnymZKt14FpGeHNvZHq5ac0MYg7IT54kISF6Y6NdqPyC', NULL),
('56736452', 2, 1, 'Omar Sánchez Castillo', '$2y$10$U5E6t7Z4ytDqsbSDtF2qHeoGcdct9vugpZADXThMkgRDU4LY5858S', NULL),
('664454', 3, 1, 'Jose  Canseco ', '$2y$10$IEEDXga8K1Px.VqbENN0pOYdQD7KHRYv6nr0edo0pIIvOEU7rqN4O', NULL),
('ellie_cislack', 3, 1, 'Omar Sánchez Castillo', '$2y$10$PPvgvIjqou4fcRt0rvqEKejEBmZVZOOejBc192e5ltRSkDrBZYsOu', NULL),
('neworder', 2, 1, 'omar Sánchez Castillo', '$2y$10$fgk4BjFMHYWHWcaf/fen3O322gxd.XZj96sNggp4dcQAl2eYNzFyy', NULL),
('newordercol', 3, 1, 'omar sanchez ', '$2y$10$TGBcmLcW38iDJH/rAsTxu.5tY1Uw22pfyFGurmYzVp6d78kmSZjve', NULL),
('okasin', 2, 1, 'Omar Sánchez Castillo', '$2y$10$HU4Srm7Hh4eATqMTjQXPnOnDIwSx2am4ojPXc89evNVCV4r18qlUG', NULL),
('okasinnn', 3, 1, 'Omar sanchez castillo', '$2y$10$kXcc/iK5AZl6ztiUxotltuTeD645ZVTDboS/rhKmxEgfqAhyI1ZQq', NULL),
('okasinnnn', 2, 1, 'Omar Sánchez Castillo', '$2y$10$Oh/c/YPkAulgF9EeHvzfteOoSDcC7FMDiTnUuPyCppgMU6m5DrdH6', NULL),
('omar', 3, 1, 'Omar S ', '$2y$10$TeB8QNDfqNsdE2Us.VWiS.1N1PnDzYvQEjxnfxvEnK.k1VLPyc5ma', NULL),
('omar1', 3, 1, 'Omar Sánchez Castillo', '$2y$10$EBktMMfvUeugPp8e43oElekjg9H0l5L9BQrHavNWfV9NSy9vRd3La', NULL),
('omarcolaborador', 4, 1, 'colaborador', '$2y$10$iZp53GfjtVMcKXHSKcBO0OHirbdsx9FyFRfeGug.L9lbLPXCPFIle', 'XRcBCST45HPHI3WaT5CQL6wihvUxWpjQTp7WjykEQ5ffTZyWqh2v3YyG9loe'),
('omarsan', 2, 1, 'Omar Sanchez Castillo', '$2y$10$V2mJtdJVFMU9erENrPbyOOD8Lp1b5smfxS2WSIzvm0ceveFzSEbla', 'EmorEPESsk0bYIeJ5vDipKXBBSFLjViTpX3497efEG8JdiTis7ly0mvTj9k7'),
('omarsancast', 2, 1, 'Omar Sánchez Castillo', '$2y$10$J2DBvzZDfA2B/U5pbqUpJeWjW33bMz0pHzLITl2mt5yA0Y3F7RNeC', NULL),
('omarsancasttt', 2, 1, 'Omar Sánchez Castillo', '$2y$10$Vp5/sikGCPJ4YTpxGhBiu.XyT4rnAwQ7Pg/5SeMgB9XCvZkjbFOsG', NULL),
('omarsancc', 2, 1, 'Omar Sanchez Castillo', '$2y$10$yM2zM6CVsdu/vzKm0cH73.pZoo06CoITUKwnq/Ivx4oGGtHQixuUO', NULL),
('omasan', 2, 1, 'Omar Sanchez Castillo', '$2y$10$hKpBfkhHb1icqpi/LdbRZuSVOLhBTrwM9kMsqcDgA5SXSUgEmR2Nm', NULL),
('omasan10', 2, 1, 'Omar Sánchez Castillo', '$2y$10$4yEKEGMKT8/5kKEcNnaZx.A0YLVnBoqaX24DCRb3IQedBQq7fuz1K', NULL),
('omasan11', 2, 1, 'Omar Sánchez Castillo', '$2y$10$vTn3O9n1lrU9s3cWH6kxaepACIRCpr0SNpJOE96WgyOcqAf2cjFt.', 'KN7lLlHXW08xS0CVxOyen1L3oGH8kJr9ZJ95qYc6DmJIDIgwBWe961FtuMXD'),
('omasan13', 3, 1, 'Omar Sanchez Castillo', '$2y$10$jWGDXEOVDCrkfpgNWEM/9uqdqR6HyDUijO/99dnxJDWXuffn3b.86', NULL),
('omsan89', 2, 1, 'Omar Sánchez Castillo', '$2y$10$4klZKukEgDGRNL1qludWO.pRunzflR2QtRT4CCDmwqWSAXfnOPGmy', NULL),
('total', 2, 1, 'total', '$2y$10$6GABgDRxjnHgqVdxR7jTuuU6akvbHBAcYcKuzalHq.dzJyJZsGd96', NULL),
('vicvall', 3, 1, 'Victor Valdez ', '$2y$10$99rczs8VIFc69VFpIrEIU.RPwK.Wzo5h0T.nvrAi3YByA40K57I3u', NULL),
('yoli', 2, 1, 'LOURDES YOLANDA FLORES SALGADO', '$2y$10$Pe60BoFSI41sASv374e7EO1HKJjiCi7vspt.zIsZ5Xok.tmItSRY2', NULL),
('yolita', 2, 1, 'Yolanda Flores Salgado', '$2y$10$E7biHrzQRkp6HuEGoAX.6Otjq5t31cpfKPY88OAh.vJJWWAi3cSka', 'TndtEM2ZCoi7jRLN3Z6v8rGxarL3LBIWT8nCBRvXQFMFmh1wbv4BbzC43AMr'),
('yolita1', 2, 1, 'Yolanda Flores Salgado', '$2y$10$iTj1MRmz2Fhsl3ioBYo66.T.xb6xbzs1IgEUG1i0nW4bdKKKTMBTW', NULL),
('yoliztli', 1, 1, 'Yolanda Flores', '$2y$10$todWrxtwBYD5UeDWk/M5Uu.5yS0ax2cWbJS6DKOE3W0V92.qvpswm', 'SOEAbjjbyPDpDfzz3q2T3xCDpHpbRBGvc6PBULSr29ujRnIOcG2AhoOUD70p'),
('zach_cislack', 2, 1, 'Omar Sánchez Castillo', '$2y$10$XoAI.W6GdRdgAtkBf.rN8OVN2../GEQgzjvJdO5wD4/vf/y8nPJCG', 'd6XqgHotD4uGXVLq82zEuGB7XaDS2xiOWfQPA7tAMcobf4y2VObXqSxmjmPe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_x_proyecto`
--

CREATE TABLE IF NOT EXISTS `usuario_x_proyecto` (
  `USPR_ID_USUARIO_X_PROYECTO` int(11) NOT NULL AUTO_INCREMENT,
  `USPR_ID_USUARIO` varchar(30) DEFAULT NULL,
  `USPR_ID_PROYECTO` int(11) DEFAULT NULL,
  PRIMARY KEY (`USPR_ID_USUARIO_X_PROYECTO`),
  KEY `FK_REFERENCE_47` (`USPR_ID_USUARIO`),
  KEY `FK_REFERENCE_48` (`USPR_ID_PROYECTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `usuario_x_proyecto`
--

INSERT INTO `usuario_x_proyecto` (`USPR_ID_USUARIO_X_PROYECTO`, `USPR_ID_USUARIO`, `USPR_ID_PROYECTO`) VALUES
(1, 'yoli', 1),
(2, 'omarsancc', 3),
(3, 'yolita', 4),
(4, 'yolita1', 5),
(5, 'omar1', 5),
(6, 'omarsan', 6),
(7, 'vicvall', 6),
(8, 'omasan11', 9),
(9, 'omasan13', 9),
(10, 'omarsancast', 10),
(11, 'omarsancasttt', 11),
(12, 'okasin', 12),
(13, 'okasinnnn', 13),
(14, 'okasinnn', 13),
(15, '455654', 14),
(16, '5454325', 14),
(17, '4556545', 15),
(18, '664454', 15),
(19, '56736452', 16),
(20, '56736055', 16),
(21, 'zach_cislack', 17),
(22, 'ellie_cislack', 17),
(23, 'neworder', 18),
(24, 'newordercol', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vpn_login`
--

CREATE TABLE IF NOT EXISTS `vpn_login` (
  `VPLO_ID_VPN_LOGIN` int(11) NOT NULL AUTO_INCREMENT,
  `VPLO_LOGIN` varchar(30) DEFAULT NULL,
  `VPLO_NOMBRE` varchar(60) DEFAULT NULL,
  `VPLO_PASSWORD` varchar(60) DEFAULT NULL,
  `VPLO_GRUPO_PRINCIPAL` varchar(60) DEFAULT NULL,
  `VPLO_GRUPO_SECUNDARIO` varchar(60) DEFAULT NULL,
  `VPLO_MAQUINA` varchar(60) DEFAULT 'MZ',
  `OBFUSCADA` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`VPLO_ID_VPN_LOGIN`),
  KEY `FK_REFERENCE_44` (`VPLO_LOGIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `vpn_login`
--

INSERT INTO `vpn_login` (`VPLO_ID_VPN_LOGIN`, `VPLO_LOGIN`, `VPLO_NOMBRE`, `VPLO_PASSWORD`, `VPLO_GRUPO_PRINCIPAL`, `VPLO_GRUPO_SECUNDARIO`, `VPLO_MAQUINA`, `OBFUSCADA`) VALUES
(2, 'omarsancc', 'OMAR_SANCHEZ_CASTILLO', 'xxxxxx', 'om_g', NULL, 'MZ', 1),
(3, 'yolita', 'YOLANDA_FLORES_SALGADO', 'SDFDTdfgfd3#$%$#%.', 'yo_g', 'g009', 'MZ', 0),
(4, 'yolita1', 'YOLANDA_FLORES_SALGADO', 'xxxxxx', 'yo_g', 'g009', 'MZ', 1),
(5, 'omar1', 'OMAR_SANCHEZ_CASTILLO', 'G@P8(ALuMVKr', 'yo_g', NULL, 'MZ', 0),
(6, 'omarsan', 'OMAR_SANCHEZ_CASTILLO', 'etrfgdfgfgfd', 'om_g', NULL, 'MZ', 0),
(7, 'vicvall', 'VICTOR_VALDEZ_', 'bzj06={8km+Q', 'om_g', NULL, 'MZ', 0),
(8, 'omasan11', 'OMAR_SANCHEZ_CASTILLO', ',brzCej7HS(n', 'om_g', NULL, 'MZ', 0),
(9, 'omasan13', 'OMAR_SANCHEZ_CASTILLO', 'CXEavfp.QA50', 'om_g', NULL, 'MZ', 0),
(10, 'omarsancast', 'OMAR_SANCHEZ_CASTILLO', 'y1kGXy-=8S8X', 'om_g', NULL, 'MZ', 0),
(11, 'omarsancasttt', 'OMAR_SANCHEZ_CASTILLO', 'AemJ2n&4)D[w', 'om_g', NULL, 'MZ', 0),
(12, 'okasin', 'OMAR_SANCHEZ_CASTILLO', ',bFDp1YQ(YfN', 'ok_g', NULL, 'MZ', 0),
(13, 'okasinnnn', 'OMAR_SANCHEZ_CASTILLO', 'm%awshCdnh87', 'ok_g', 'g09,adf', 'MZ', 0),
(14, 'okasinnn', 'OMAR_SANCHEZ_CASTILLO', 'GCh-xazrFrUK', 'ok_g', NULL, 'MZ', 0),
(15, '455654', 'OMAR_SANCHEZ_CASTILLO', 'YG$n4{c3K8mI', '45_g', 'g09,adf', 'MZ', 0),
(16, '5454325', 'JOSE _CANSECO_', 'MA1v*b$cNE9)', '45_g', NULL, 'MZ', 0),
(17, '4556545', 'OMAR_SANCHEZ_CASTILLO', '3(yg,=XJiXBg', '45_g', 'g09,adf', 'MZ', 0),
(18, '664454', 'JOSE _CANSECO_', '&ZBxV4!dVm$H', '45_g', NULL, 'MZ', 0),
(19, '56736452', 'OMAR_SANCHEZ_CASTILLO', 'wbnhTiX$rryv', '56_g', NULL, 'MZ', 0),
(20, '56736055', 'JOSE _CANSECO_', '/L-]v+ki[8=E', '56_g', NULL, 'MZ', 0),
(21, 'zach_cislack', 'OMAR_SANCHEZ_CASTILLO', ',KW=2=GrGJva', 'za_g', NULL, 'MZ', 0),
(22, 'ellie_cislack', 'OMAR_SANCHEZ_CASTILLO', 'H(7gC/5gI5(L', 'za_g', NULL, 'MZ', 0),
(23, 'neworder', 'OMAR_SANCHEZ_CASTILLO', 'BIdSp5AA)/tJ', 'ne_g', NULL, 'MZ', 0),
(24, 'newordercol', 'OMAR_SANCHEZ_', 'F]p6hGs09G,Q', 'ne_g', NULL, 'MZ', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos_renovacion`
--
ALTER TABLE `archivos_renovacion`
  ADD CONSTRAINT `FK_REFERENCE_49` FOREIGN KEY (`ARRE_ID_SOLICITUD_RENOVACION`) REFERENCES `solicitud_renovacion` (`SORE_ID_SOLICITUD_RENOVACION`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contabilidad`
--
ALTER TABLE `contabilidad`
  ADD CONSTRAINT `FK_REFERENCE_29` FOREIGN KEY (`CONT_ID_USUARIO`) REFERENCES `usuario` (`USUA_ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD CONSTRAINT `FK_REFERENCE_36` FOREIGN KEY (`DEPE_ID_TIPO_DEPENDENCIA`) REFERENCES `tipo_dependencia` (`TIDE_ID_TIPO_DEPENDENCIA`);

--
-- Filtros para la tabla `maquina_login`
--
ALTER TABLE `maquina_login`
  ADD CONSTRAINT `FK_REFERENCE_43` FOREIGN KEY (`MALO_LOGIN`) REFERENCES `usuario` (`USUA_ID_USUARIO`);

--
-- Filtros para la tabla `maquina_x_proyecto`
--
ALTER TABLE `maquina_x_proyecto`
  ADD CONSTRAINT `FK_REFERENCE_22` FOREIGN KEY (`MAPR_ID_PROYECTO`) REFERENCES `proyecto` (`PROY_ID_PROYECTO`),
  ADD CONSTRAINT `FK_REFERENCE_23` FOREIGN KEY (`MAPR_ID_MAQUINA`) REFERENCES `maquina` (`MAQU_ID_MAQUINA`);

--
-- Filtros para la tabla `otra_app`
--
ALTER TABLE `otra_app`
  ADD CONSTRAINT `FK_REFERENCE_39` FOREIGN KEY (`OTAP_ID_SOLICITUD_ABSTRACTA`) REFERENCES `solicitud_abstracta` (`SOAB_ID_SOLICITUD_ABSTRACTA`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `FK_REFERENCE_11` FOREIGN KEY (`PROY_ID_ESTADO_PROYECTO`) REFERENCES `estado_proyecto` (`ESPR_ID_ESTADO_PROYECTO`),
  ADD CONSTRAINT `FK_REFERENCE_27` FOREIGN KEY (`PROY_ID_TIPO_PROYECTO`) REFERENCES `tipo_proyecto` (`TIPR_ID_TIPO_PROYECTO`),
  ADD CONSTRAINT `FK_REFERENCE_9` FOREIGN KEY (`PROY_ID_SOLICITUD_ABSTRACTA`) REFERENCES `solicitud_abstracta` (`SOAB_ID_SOLICITUD_ABSTRACTA`);

--
-- Filtros para la tabla `solicitud_abstracta`
--
ALTER TABLE `solicitud_abstracta`
  ADD CONSTRAINT `FK_REFERENCE_18` FOREIGN KEY (`SOAB_ID_MEDIO_COMUNICACION`) REFERENCES `medio_comunicacion` (`MECO_ID_MEDIO_COMUNICACION`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_34` FOREIGN KEY (`SOAB_ID_GRADO`) REFERENCES `grado` (`GRAD_ID_GRADO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_38` FOREIGN KEY (`SOAB_ID_SOLICITUD_RENOVACION`) REFERENCES `solicitud_renovacion` (`SORE_ID_SOLICITUD_RENOVACION`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_4` FOREIGN KEY (`SOAB_ID_TIPO_SOLICITUD`) REFERENCES `tipo_solicitud` (`TISO_ID_TIPO_SOLICITUD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_40` FOREIGN KEY (`SOAB_ID_CAMPO_TRABAJO`) REFERENCES `campo_trabajo` (`CATR_ID_CAMPO_TRABAJO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_41` FOREIGN KEY (`SOAB_ID_OTRO_CAMPO`) REFERENCES `otro_campo_trabajo` (`OTCA_ID_OTRO_CAMPO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_5` FOREIGN KEY (`SOAB_ID_ESTADO_SOLICITUD`) REFERENCES `estado_solicitud` (`ESSO_ID_ESADO_SOLICITUD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_6` FOREIGN KEY (`SOAB_ID_DEPENDENCIA`) REFERENCES `dependencia` (`DEPE_ID_DEPENDENCIA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_cta_colaboradora`
--
ALTER TABLE `solicitud_cta_colaboradora`
  ADD CONSTRAINT `FK_REFERENCE_26` FOREIGN KEY (`SOCO_ID_SOLICITUD_ABSTRACTA`) REFERENCES `solicitud_abstracta` (`SOAB_ID_SOLICITUD_ABSTRACTA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_31` FOREIGN KEY (`SOCO_ID_ESTADO_COLABORADORA`) REFERENCES `estado_colaboradora` (`ESCO_ID_ESTADO_COLABORADORA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_32` FOREIGN KEY (`SOCO_ID_MEDIO_COMUNICACION`) REFERENCES `medio_comunicacion` (`MECO_ID_MEDIO_COMUNICACION`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_33` FOREIGN KEY (`SOCO_ID_DEPENDENCIA`) REFERENCES `dependencia` (`DEPE_ID_DEPENDENCIA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_35` FOREIGN KEY (`SOCO_ID_GRADO`) REFERENCES `grado` (`GRAD_ID_GRADO`);

--
-- Filtros para la tabla `solicitud_x_app`
--
ALTER TABLE `solicitud_x_app`
  ADD CONSTRAINT `FK_REFERENCE_24` FOREIGN KEY (`SOAP_ID_SOLICITUD_ABSTRACTA`) REFERENCES `solicitud_abstracta` (`SOAB_ID_SOLICITUD_ABSTRACTA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_25` FOREIGN KEY (`SOAP_ID_APLICACION`) REFERENCES `aplicacion` (`APLI_ID_APLICACION`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_REFERENCE_37` FOREIGN KEY (`USUA_ID_TIPO_USUARIO`) REFERENCES `tipo_usuario` (`TIUS_ID_TIPO_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_46` FOREIGN KEY (`USUA_ID_ESTADO_USUARIO`) REFERENCES `estado_usuario` (`ESUS_ID_ESTADO_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_x_proyecto`
--
ALTER TABLE `usuario_x_proyecto`
  ADD CONSTRAINT `FK_REFERENCE_47` FOREIGN KEY (`USPR_ID_USUARIO`) REFERENCES `usuario` (`USUA_ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REFERENCE_48` FOREIGN KEY (`USPR_ID_PROYECTO`) REFERENCES `proyecto` (`PROY_ID_PROYECTO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vpn_login`
--
ALTER TABLE `vpn_login`
  ADD CONSTRAINT `FK_REFERENCE_44` FOREIGN KEY (`VPLO_LOGIN`) REFERENCES `usuario` (`USUA_ID_USUARIO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
