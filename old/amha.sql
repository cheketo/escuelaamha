-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-05-2014 a las 20:16:50
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `amha`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_group`
--

DROP TABLE IF EXISTS `admin_group`;
CREATE TABLE `admin_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `admin_group`
--

INSERT INTO `admin_group` (`group_id`, `name`) VALUES
(1, 'Grupo A'),
(2, 'Grupo B'),
(3, 'asadasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_profile`
--

DROP TABLE IF EXISTS `admin_profile`;
CREATE TABLE `admin_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `admin_profile`
--

INSERT INTO `admin_profile` (`profile_id`, `title`) VALUES
(1, 'Superadministrador'),
(2, 'Administrador'),
(4, 'Profesor'),
(11, 'Graduado'),
(14, 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` char(1) NOT NULL,
  `tries` int(11) NOT NULL,
  `last_access` datetime NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Volcado de datos para la tabla `admin_user`
--

INSERT INTO `admin_user` (`admin_id`, `user`, `password`, `first_name`, `last_name`, `profile_id`, `img`, `status`, `tries`, `last_access`) VALUES
(1, 'aromero', '311c5545870b0ac46cc3fa25a8b384c5', 'Alejandro', 'Romero', 1, '../../../skin/images/users/file7720.jpeg', 'A', 0, '2014-05-01 14:24:02'),
(21, 'smercado', '81dc9bdb52d04dc20036dbd8313ed055', 'Silvia Cristina', 'Mercado', 2, '', 'A', 0, '2014-04-12 18:41:47'),
(36, 'rdantonio', '81dc9bdb52d04dc20036dbd8313ed055', 'Romina', 'D''Antonio', 13, '', 'A', 0, '2014-04-05 14:02:33'),
(37, 'apalladino', '81dc9bdb52d04dc20036dbd8313ed055', 'Analía', 'Palladino', 13, '', 'A', 0, '2014-04-07 22:43:27'),
(38, 'gfoster', '81dc9bdb52d04dc20036dbd8313ed055', 'Gloria', 'Foster', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(39, 'mainete', '81dc9bdb52d04dc20036dbd8313ed055', 'Mariela', 'Ainete', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(40, 'lferreyra', '81dc9bdb52d04dc20036dbd8313ed055', 'Liliam', 'Ferreyra', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(41, 'ebusto', '81dc9bdb52d04dc20036dbd8313ed055', 'Esteban', 'Busto', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(42, 'lpoma', '81dc9bdb52d04dc20036dbd8313ed055', 'Leticia', 'Poma', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(43, 'vmartino', '81dc9bdb52d04dc20036dbd8313ed055', 'Viviana', 'Martino', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(44, 'vmurakami', '81dc9bdb52d04dc20036dbd8313ed055', 'Vera', 'Murakami', 13, '', 'A', 0, '2014-04-07 09:45:07'),
(45, 'calonso', '81dc9bdb52d04dc20036dbd8313ed055', 'Carolina', 'Alonso', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(46, 'lgarcia', '81dc9bdb52d04dc20036dbd8313ed055', 'Liliana', 'García', 13, '', 'A', 0, '2014-04-05 11:00:43'),
(47, 'mgalan', '81dc9bdb52d04dc20036dbd8313ed055', 'Marina', 'Galan', 13, '', 'A', 0, '2014-04-11 10:12:25'),
(48, 'gzuluaga', '81dc9bdb52d04dc20036dbd8313ed055', 'Graciela', 'Zuluaga', 16, '', 'A', 0, '0000-00-00 00:00:00'),
(49, 'kcarrasco', '81dc9bdb52d04dc20036dbd8313ed055', 'Karen', 'Carrasco', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(50, 'darteaga', '81dc9bdb52d04dc20036dbd8313ed055', 'Diana', 'Arteaga', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(51, 'acampanelli', '81dc9bdb52d04dc20036dbd8313ed055', 'Adolfo', 'Campanelli', 4, '', 'A', 0, '2014-04-12 12:05:34'),
(52, 'aarregui', '81dc9bdb52d04dc20036dbd8313ed055', 'Agustina', 'Arregui', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(53, 'mpignatelli', '81dc9bdb52d04dc20036dbd8313ed055', 'Marcelo Gustavo', 'Pignatelli ', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(54, 'efigari', '81dc9bdb52d04dc20036dbd8313ed055', 'Elena', 'Figari', 4, '', 'A', 0, '2014-04-12 15:43:46'),
(55, 'eblaho', '81dc9bdb52d04dc20036dbd8313ed055', 'Eva', 'Blaho', 3, '', 'A', 0, '0000-00-00 00:00:00'),
(56, 'rmaschiovargas', '81dc9bdb52d04dc20036dbd8313ed055', 'Rocío', 'Maschio Vargas', 17, '', 'A', 0, '0000-00-00 00:00:00'),
(57, 'cventrica', '81dc9bdb52d04dc20036dbd8313ed055', 'Claudia', 'Ventrica', 17, '', 'A', 0, '2014-04-12 20:06:29'),
(58, 'egonzalez', '81dc9bdb52d04dc20036dbd8313ed055', 'Ethel', 'González', 17, '', 'A', 0, '0000-00-00 00:00:00'),
(59, 'cbronstein', '81dc9bdb52d04dc20036dbd8313ed055', 'Claudia', 'Bronstein', 17, '', 'A', 0, '0000-00-00 00:00:00'),
(60, 'vbuedo', '81dc9bdb52d04dc20036dbd8313ed055', 'Victoria', 'Buedo', 17, '', 'A', 0, '2014-04-12 18:43:03'),
(61, 'smarques', '81dc9bdb52d04dc20036dbd8313ed055', 'Silvia', 'Marques', 17, '', 'A', 0, '0000-00-00 00:00:00'),
(62, 'lelizalde', '81dc9bdb52d04dc20036dbd8313ed055', 'Lucía', 'Elizalde', 17, '', 'A', 0, '0000-00-00 00:00:00'),
(63, 'lramallo', '81dc9bdb52d04dc20036dbd8313ed055', 'Lorena', 'Ramallo', 17, '', 'A', 0, '0000-00-00 00:00:00'),
(65, 'amotura', '81dc9bdb52d04dc20036dbd8313ed055', 'Astrid', 'Motura', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(66, 'spalacios', '81dc9bdb52d04dc20036dbd8313ed055', 'Silvia', 'Palacios', 4, '', 'A', 0, '2014-04-12 15:17:43'),
(67, 'mprunell', '81dc9bdb52d04dc20036dbd8313ed055', 'Mónica', 'Prunell', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(68, 'amfernandez', '81dc9bdb52d04dc20036dbd8313ed055', 'Ana María', 'Fernández', 4, '', 'A', 0, '2014-04-12 15:34:53'),
(69, 'hdemedio', '81dc9bdb52d04dc20036dbd8313ed055', 'Horacio', 'De Medio', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(70, 'eyahbes', '81dc9bdb52d04dc20036dbd8313ed055', 'Eduardo ', 'Yahbes', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(71, 'jctsuji', '81dc9bdb52d04dc20036dbd8313ed055', 'Juan Carlos', 'Tsuji', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(72, 'rfaingold', '81dc9bdb52d04dc20036dbd8313ed055', 'Ruth', 'Faingold', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(73, 'gmartello', '81dc9bdb52d04dc20036dbd8313ed055', 'Gustavo', 'Martello', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(74, 'lszabo', '81dc9bdb52d04dc20036dbd8313ed055', 'Liliana', 'Szabó', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(75, 'gmur', '81dc9bdb52d04dc20036dbd8313ed055', 'Guillermo', 'Mur', 4, '', 'A', 0, '2014-04-12 14:49:38'),
(76, 'acarmody', '81dc9bdb52d04dc20036dbd8313ed055', 'Andrés', 'Carmdoy', 4, '', 'A', 0, '2014-04-12 14:29:31'),
(77, 'dmilstein', '81dc9bdb52d04dc20036dbd8313ed055', 'David', 'Milstein', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(78, 'pdimatteo', '81dc9bdb52d04dc20036dbd8313ed055', 'Patricia', 'Di Matteo', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(79, 'fgoldstein', '81dc9bdb52d04dc20036dbd8313ed055', 'Francisco', 'Goldstein', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(80, 'lyraola2030', '81dc9bdb52d04dc20036dbd8313ed055', 'Lucas', 'Yraola', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(81, 'rderobertis', '81dc9bdb52d04dc20036dbd8313ed055', 'Roberto', 'De Robertis', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(82, 'ntaubin', '81dc9bdb52d04dc20036dbd8313ed055', 'Nora', 'Taubin', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(83, 'aminotti', '81dc9bdb52d04dc20036dbd8313ed055', 'Ángel', 'Minotti', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(84, 'rdiazcampos', '81dc9bdb52d04dc20036dbd8313ed055', 'Roberto', 'Díaz Campos', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(85, 'ngrzesko', '81dc9bdb52d04dc20036dbd8313ed055', 'Nilda', 'Grzesko', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(86, 'rpenna', '81dc9bdb52d04dc20036dbd8313ed055', 'Roque', 'Penna', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(87, 'saschkar', '81dc9bdb52d04dc20036dbd8313ed055', 'Silvia ', 'Aschkar', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(88, 'vtachella', '81dc9bdb52d04dc20036dbd8313ed055', 'Viviana', 'Tachella', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(89, 'mmorenog', '81dc9bdb52d04dc20036dbd8313ed055', 'Mónica', 'Moreno Galaud', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(90, 'mmuller', '81dc9bdb52d04dc20036dbd8313ed055', 'Mónica', 'Müller', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(91, 'lsvirnosvsky', '81dc9bdb52d04dc20036dbd8313ed055', 'Laura', 'Svirnovsky', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(92, 'mdraiman', '81dc9bdb52d04dc20036dbd8313ed055', 'Mario', 'Draiman', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(93, 'mmessia', '81dc9bdb52d04dc20036dbd8313ed055', 'Marisa', 'Messía', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(94, 'jcpellegrino', '81dc9bdb52d04dc20036dbd8313ed055', 'Juan Carlos', 'Pellegrino', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(95, 'jtraverso', '81dc9bdb52d04dc20036dbd8313ed055', 'Jorge', 'Traverso', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(96, 'rzaldua', '81dc9bdb52d04dc20036dbd8313ed055', 'Roberto', 'Zaldúa', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(97, 'gpirra', '81dc9bdb52d04dc20036dbd8313ed055', 'Gustavo', 'Pirra', 4, '', 'A', 0, '0000-00-00 00:00:00'),
(98, 'mzorrilla', '81dc9bdb52d04dc20036dbd8313ed055', 'María', 'Zorrilla', 13, '', 'A', 0, '0000-00-00 00:00:00'),
(99, 'iuboldi', '81dc9bdb52d04dc20036dbd8313ed055', 'Ivana', 'Uboldi', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(100, 'cdominguez', '81dc9bdb52d04dc20036dbd8313ed055', 'Carlos', 'Domínguez', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(101, 'nrivas', '81dc9bdb52d04dc20036dbd8313ed055', 'Noemí', 'Rivas', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(102, 'fsantillan', '81dc9bdb52d04dc20036dbd8313ed055', 'Facundo', 'Santillán', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(103, 'amarchese', '81dc9bdb52d04dc20036dbd8313ed055', 'Anabella', 'Marchese', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(104, 'rrodriguez', '81dc9bdb52d04dc20036dbd8313ed055', 'Rocío', 'Rodríguez', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(105, 'mgutierrez', '81dc9bdb52d04dc20036dbd8313ed055', 'Micaela', 'Gutiérrez', 15, '', 'A', 0, '2014-04-12 15:21:37'),
(106, 'tball', '81dc9bdb52d04dc20036dbd8313ed055', 'Teófilo', 'Ball', 15, '', 'A', 0, '2014-04-12 17:58:22'),
(107, 'mgarcia', '81dc9bdb52d04dc20036dbd8313ed055', 'Mirtha', 'García', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(108, 'agomez', '81dc9bdb52d04dc20036dbd8313ed055', 'Ana', 'Gómez', 15, '', 'A', 0, '2014-04-12 15:19:23'),
(109, 'vmelano', '81dc9bdb52d04dc20036dbd8313ed055', 'Vanesa', 'Melano', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(110, 'equerol', '81dc9bdb52d04dc20036dbd8313ed055', 'Eliana', 'Querol', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(111, 'areinoso', '81dc9bdb52d04dc20036dbd8313ed055', 'Alicia', 'Reinoso', 15, '', 'A', 0, '2014-04-12 15:41:57'),
(112, 'dmacana', '81dc9bdb52d04dc20036dbd8313ed055', 'Daniel', 'Macana', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(113, 'ejosemaria', '81dc9bdb52d04dc20036dbd8313ed055', 'José María', 'Emiliana', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(114, 'gaguero', '81dc9bdb52d04dc20036dbd8313ed055', 'Gerardo', 'Agüero', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(115, 'jgroisman', '81dc9bdb52d04dc20036dbd8313ed055', 'Judith', 'Groisman', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(116, 'cpandullio', '81dc9bdb52d04dc20036dbd8313ed055', 'Carolina', 'Pandullio', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(117, 'melusanse', '81dc9bdb52d04dc20036dbd8313ed055', 'Mabel', 'Elusanse', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(118, 'mroglic', '81dc9bdb52d04dc20036dbd8313ed055', 'Miriam', 'Roglic', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(119, 'fegoburo', '81dc9bdb52d04dc20036dbd8313ed055', 'Fabiana', 'Egoburo', 15, '', 'A', 0, '0000-00-00 00:00:00'),
(120, 'agutierrez', '81dc9bdb52d04dc20036dbd8313ed055', 'Antonio', 'Gutiérrez', 16, '', 'A', 0, '0000-00-00 00:00:00'),
(121, 'jorozco', '81dc9bdb52d04dc20036dbd8313ed055', 'Julia', 'Orozco', 16, '', 'A', 0, '2014-04-12 15:37:00'),
(122, 'pepelamder', '202cb962ac59075b964b07152d234b70', 'pepe', 'lamder', 4, '', 'A', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `description` text NOT NULL,
  `comment` char(1) NOT NULL DEFAULT 'Y',
  `reply` char(1) NOT NULL DEFAULT 'Y',
  `public` char(1) NOT NULL DEFAULT 'Y',
  `important` char(1) NOT NULL DEFAULT 'N',
  `status` char(1) NOT NULL DEFAULT 'A',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modification_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `section_id` (`section_id`,`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `article`
--

INSERT INTO `article` (`article_id`, `section_id`, `author_id`, `title`, `subtitle`, `description`, `comment`, `reply`, `public`, `important`, `status`, `start_date`, `end_date`, `creation_date`, `last_modification`, `last_modification_id`) VALUES
(1, 1, 51, 'Bienvenidos al Foro 3° Año', ' ', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Estimados Colegas.</p>\r\n<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp; Este Campus que se inicia en esta nueva etapa de la Escuela de Post Grado de la AMHA, tiene como objetivo primordial y definido por un lado, el interactuar compartiendo &nbsp;con ustedes informaci&oacute;n y bibliograf&iacute;a que consideremos trascendente, notas y art&iacute;culos a los que reconozcamos, o nos parezcan, de utilidad com&uacute;n para ayudar en el actual o futuro desempe&ntilde;o del devenir homeop&aacute;tico, dudas, incertidumbres, &eacute;xitos y fracasos pero, por otro lado, fundamentalmente conseguir, en el crecimiento mutuo, establecer un v&iacute;nculo real y efectivo entre cada uno de nosotros y nuestra Asociaci&oacute;n que se prolongue m&aacute;s all&aacute; de la inminente graduaci&oacute;n, ya sea en las c&aacute;tedras, en la ense&ntilde;anza o en el reci&eacute;n creado Campus de Graduados.&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp; La Homeopat&iacute;a es una ciencia maravillosa que nos devuelve ciento por uno todos los esfuerzos que le dedicamos. Ya sea haci&eacute;ndonos crecer interiormente como personas o deleit&aacute;ndonos con las mejor&iacute;as y recuperaciones que le brindamos a aquellos que ponen la esperanza de su curaci&oacute;n en Ella, a trav&eacute;s de nuestras manos.</p>\r\n<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp; En fin, hoy comenzamos. Les pido, a los que quieran hacerlo, que nos presentemos, para que nos conozcamos mejor, para que sepamos con quien vamos caminando a nuestro lado por este enigm&aacute;tico y placentero camino hacia el legado inmaculado de Samuel Hahnemann.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: center;">Confianza y Paz. Bienvenidos todos.</p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">Dr. Adolfo Campanelli</p>\r\n<p style="text-align: center;"><img src="../../../skin/images/body/logos/amha_logo.png" alt="" /></p>\r\n</body>\r\n</html>', 'Y', 'Y', 'N', 'N', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-05 06:11:48', '2014-04-16 02:33:07', 51),
(2, 1, 51, 'Autoevaluaciones', 'Links de descarga', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'Y', 'Y', 'Y', 'N', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-05 06:17:24', '2014-04-05 09:17:24', 0),
(3, 1, 51, 'Articulo de prueba', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><img src="http://www.lossimpsonsonline.com.ar/la-casa/la-casa.gif" alt="" /></p>\r\n<p style="text-align: center;"><span style="font-family: georgia, palatino; font-size: 24pt; color: #ff9900;">Esto es una prueba</span></p>\r\n</body>\r\n</html>', 'Y', 'Y', 'N', 'Y', 'I', '2014-04-12 00:00:00', '2014-05-10 00:00:00', '2014-04-05 19:40:59', '2014-04-05 22:43:32', 0),
(4, 12, 1, 'Bienvenidos al Foro 2° Año', ' ', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Estimados colegas:</p>\r\n<p>Les doy con alegría la bienvenida a éste Foro de 2° año. Soy la Dra Elena Figari , responsable del mismo en éste nivel.En él podrán acceder a  un nuevo aporte que implementamos este año con la esperanza que les sea de la mayor utilidad. Consiste en una auto evaluación (multiple choice) diseñada por el docente a cargo de la clase mensual del curso regular , cuyo fin es destacar los conceptos que deben tenerse especialmente en cuenta, lo que no se debe dejar de saber sobre el tema expuesto .  El mismo y sus respuestas correctas  estarán a disposición luego de la clase, y podrán acceder mediante una clave de usuario y contraseña  con la que podrán ingresar. También habrá artículos de interés y sugerencias de libros en los que se puede encontrar material para profundizar  y los invitamos a que nos envíen a su vez las sugerencias y comentarios que crean pertinentes  al respecto.</p>\r\n<p> Estoy a su disposición por cualquier  inquietud que tengan.</p>\r\n<p> </p>\r\n<p style="text-align: center;"><img src="../../../skin/images/body/logos/amha_logo.png" alt="" /></p>\r\n<p style="text-align: center;">Dra. Elena R. Figari<br />Profesora Adjunta</p>\r\n</body>\r\n</html>', 'Y', 'Y', 'N', 'N', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-10 15:26:43', '2014-04-10 18:26:43', 0),
(5, 0, 54, 'Autoevaluaciónes Clases 11 y 12 de abril', ' ', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Links de Descarga</p>\r\n</body>\r\n</html>', 'Y', 'Y', 'N', 'N', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-12 13:54:19', '2014-04-12 17:32:18', 21),
(6, 0, 54, 'Autoevaluaciones clases del 11 y 12-4-14', ' ', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'Y', 'Y', 'N', 'Y', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-12 14:44:57', '2014-04-12 18:27:07', 21),
(7, 13, 68, 'Autoevaluación clase del 7-4-14', '\r\n', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'Y', 'Y', 'N', 'N', 'I', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-12 14:48:55', '2014-04-12 18:33:56', 0),
(8, 16, 66, 'Autoevaluación clases del 11 y 12-4-14', '\r\n', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'Y', 'Y', 'N', 'N', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-12 15:18:56', '2014-04-12 18:18:56', 0),
(9, 13, 68, 'Autoevaluación clase del 7-4-14', '\r\n', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Link de descarga</p>\r\n</body>\r\n</html>', 'Y', 'Y', 'N', 'Y', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-04-12 15:36:30', '2014-04-12 18:36:30', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `article_file`
--

DROP TABLE IF EXISTS `article_file`;
CREATE TABLE `article_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `article_file`
--

INSERT INTO `article_file` (`file_id`, `article_id`, `author_id`, `name`, `url`, `description`, `creation_date`) VALUES
(1, 2, 51, 'Faingold3erano.doc', '../../../skin/files/articles/2/Faingold3erano.doc', '', '2014-04-05 06:17:24'),
(2, 2, 51, 'Szabo3erano2014.doc', '../../../skin/files/articles/2/Szabo3erano2014.doc', '', '2014-04-05 06:17:24'),
(3, 2, 51, 'YAHBES3erano.doc', '../../../skin/files/articles/2/YAHBES3erano.doc', '', '2014-04-05 06:17:24'),
(4, 3, 51, '22dejunio.doc', '../../../skin/files/articles/3/22dejunio.doc', '', '2014-04-05 19:40:59'),
(5, 0, 68, 'PARADIGMASMultiplechoice2014.docx', '../../../skin/files/articles/0/PARADIGMASMultiplechoice2014.docx', '', '2014-04-11 09:22:20'),
(6, 0, 68, 'PARADIGMASMultiplechoice2014.docx', '../../../skin/files/articles/0/PARADIGMASMultiplechoice2014.docx', '', '2014-04-11 09:29:22'),
(7, 5, 54, 'PARADIGMASMultiplechoice2014.docx', '../../../skin/files/articles/5/PARADIGMASMultiplechoice2014.docx', '', '2014-04-12 13:54:19'),
(8, 5, 54, 'VITALISMOMultiplechoice2014.docx', '../../../skin/files/articles/5/VITALISMOMultiplechoice2014.docx', '', '2014-04-12 13:54:19'),
(9, 5, 21, 'MultiplechoicePirra', '../../../skin/files/articles/5/MultiplechoicePirra', '', '2014-04-12 14:32:18'),
(10, 5, 21, 'MultiplechoiceMilstein12-4-14', '../../../skin/files/articles/5/MultiplechoiceMilstein12-4-14', '', '2014-04-12 14:32:18'),
(11, 6, 54, 'PARADIGMASMultiplechoice2014.docx', '../../../skin/files/articles/6/PARADIGMASMultiplechoice2014.docx', '', '2014-04-12 14:44:57'),
(12, 6, 54, 'MultiplechoiceMilstein12-4-14.docx', '../../../skin/files/articles/6/MultiplechoiceMilstein12-4-14.docx', '', '2014-04-12 14:44:57'),
(13, 6, 54, 'VITALISMOMultiplechoice2014.docx', '../../../skin/files/articles/6/VITALISMOMultiplechoice2014.docx', '', '2014-04-12 14:44:57'),
(14, 6, 54, 'MultipleChoicePirra12-4-14.docx', '../../../skin/files/articles/6/MultipleChoicePirra12-4-14.docx', '', '2014-04-12 14:44:57'),
(15, 7, 68, 'Yraolaclasefarmacia2014.doc', '../../../skin/files/articles/7/Yraolaclasefarmacia2014.doc', '', '2014-04-12 14:48:56'),
(17, 8, 66, 'VITALISMOMultiplechoice2014.docx', '../../../skin/files/articles/8/VITALISMOMultiplechoice2014.docx', '', '2014-04-12 15:18:56'),
(18, 8, 66, 'PARADIGMASMultiplechoice2014.docx', '../../../skin/files/articles/8/PARADIGMASMultiplechoice2014.docx', '', '2014-04-12 15:18:56'),
(19, 8, 66, 'MultiplechoiceMilstein12-4-14.docx', '../../../skin/files/articles/8/MultiplechoiceMilstein12-4-14.docx', '', '2014-04-12 15:18:56'),
(20, 8, 66, 'MultipleChoicePirra12-4-14.docx', '../../../skin/files/articles/8/MultipleChoicePirra12-4-14.docx', '', '2014-04-12 15:18:56'),
(21, 9, 68, 'Yraolaclasefarmacia2014.doc', '../../../skin/files/articles/9/Yraolaclasefarmacia2014.doc', '', '2014-04-12 15:36:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `article_img`
--

DROP TABLE IF EXISTS `article_img`;
CREATE TABLE `article_img` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `main` char(1) NOT NULL DEFAULT 'Y',
  `position` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `article_img`
--

INSERT INTO `article_img` (`img_id`, `article_id`, `url`, `main`, `position`, `status`) VALUES
(1, 2, '../../../skin/images/articles/2/main.png', 'Y', 1, 'A'),
(2, 3, '../../../skin/images/articles/3/main.jpeg', 'Y', 1, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`comment_id`, `article_id`, `parent_id`, `author_id`, `message`, `creation_date`) VALUES
(1, 1, 0, 1, 'ááááéééííííúúúúúñññññÑÑÑÑÑÑ', '2014-04-15 23:23:46'),
(2, 1, 1, 1, 'asd', '2014-04-15 23:33:14'),
(3, 1, 0, 1, 'asd', '2014-04-15 23:33:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_log`
--

DROP TABLE IF EXISTS `login_log`;
CREATE TABLE `login_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `tries` int(11) NOT NULL,
  `event` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Volcado de datos para la tabla `login_log`
--

INSERT INTO `login_log` (`log_id`, `user`, `password`, `ip`, `tries`, `event`, `date`) VALUES
(1, 'aromero', '', '190.245.8.228', 0, 'OK', '2014-04-05 08:34:32'),
(2, 'acampanelli', '', '190.245.8.228', 0, 'OK', '2014-04-05 09:01:50'),
(3, 'rdantonio', '', '190.245.8.228', 0, 'OK', '2014-04-05 09:18:41'),
(4, 'smercado', 'smercado98', '190.245.8.228', 1, 'Clave Incorrecta', '2014-04-05 09:20:15'),
(5, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-05 09:20:22'),
(6, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-05 12:35:16'),
(7, 'rdantonio', '', '190.245.8.228', 0, 'OK', '2014-04-05 13:07:39'),
(8, 'scmercado', 'scmercado9', '190.245.8.228', 0, 'Usuario invalido', '2014-04-05 13:09:19'),
(9, 'silvia mercado', 'scmercado9', '190.245.8.228', 0, 'Usuario invalido', '2014-04-05 13:19:51'),
(10, 'lgarcia', '', '190.245.8.228', 0, 'OK', '2014-04-05 13:29:33'),
(11, 'lgarcia', '', '190.172.80.238', 0, 'OK', '2014-04-05 13:31:37'),
(12, 'acampanelli', '', '190.245.8.228', 0, 'OK', '2014-04-05 13:55:22'),
(13, 'acampanelli', '', '190.17.73.121', 0, 'OK', '2014-04-05 13:59:57'),
(14, 'lgarcia', 'lgarcia 11211', '190.172.80.238', 1, 'Clave Incorrecta', '2014-04-05 14:00:31'),
(15, 'lgarcia', '', '190.172.80.238', 0, 'OK', '2014-04-05 14:00:43'),
(16, 'acampanelli', '', '190.245.8.228', 0, 'OK', '2014-04-05 14:08:28'),
(17, 'acampanelli', '', '190.17.73.121', 0, 'OK', '2014-04-05 14:10:02'),
(18, 'acampanelli', 'acampanelli1', '190.17.73.121', 1, 'Clave Incorrecta', '2014-04-05 14:17:50'),
(19, 'acampanelli', '', '190.17.73.121', 0, 'OK', '2014-04-05 14:18:16'),
(20, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-05 14:25:50'),
(21, 'aromero', '', '190.245.8.228', 0, 'OK', '2014-04-05 14:31:45'),
(22, 'aromero', '', '190.245.8.228', 0, 'OK', '2014-04-05 15:21:53'),
(23, 'rdantonio', '', '190.194.203.161', 0, 'OK', '2014-04-05 17:02:33'),
(24, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-05 18:33:28'),
(25, 'acampanelli', '', '170.51.219.150', 0, 'OK', '2014-04-05 22:19:39'),
(26, 'acampanelli', '', '170.51.219.150', 0, 'OK', '2014-04-05 22:23:40'),
(27, 'acampanelli', '', '190.17.73.121', 0, 'OK', '2014-04-06 00:39:55'),
(28, 'apalladino', '', '186.23.104.94', 0, 'OK', '2014-04-06 01:43:10'),
(29, 'aromero', '', '190.245.8.228', 0, 'OK', '2014-04-06 18:56:57'),
(30, 'mgalan', '', '190.194.203.161', 0, 'OK', '2014-04-07 12:42:34'),
(31, 'vmurakami', '', '190.194.203.161', 0, 'OK', '2014-04-07 12:45:07'),
(32, 'smercado', '', '190.194.203.161', 0, 'OK', '2014-04-07 12:52:31'),
(33, 'apalladino', '', '186.23.104.94', 0, 'OK', '2014-04-08 01:43:27'),
(34, 'aromero', '', '190.245.8.228', 0, 'OK', '2014-04-08 08:21:43'),
(35, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-09 12:54:07'),
(36, 'aromero', '', '200.70.32.3', 0, 'OK', '2014-04-09 13:55:19'),
(37, 'acampanelli', '', '190.17.73.121', 0, 'OK', '2014-04-09 13:58:18'),
(38, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-10 10:55:29'),
(39, 'aromero', '', '190.245.8.228', 0, 'OK', '2014-04-10 18:19:08'),
(40, 'cventrica', '', '190.245.8.228', 0, 'OK', '2014-04-10 18:42:05'),
(41, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-10 23:41:30'),
(42, 'aromero', '', '190.245.8.228', 0, 'OK', '2014-04-11 04:16:22'),
(43, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-11 12:00:22'),
(44, 'afernandez', 'afernandez1947', '190.245.8.228', 1, 'Clave Incorrecta', '2014-04-11 12:15:56'),
(45, 'amfernandez', '', '190.245.8.228', 0, 'OK', '2014-04-11 12:16:10'),
(46, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-11 12:33:26'),
(47, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-11 13:05:46'),
(48, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-11 13:11:19'),
(49, 'mgalan', '', '190.245.8.228', 0, 'OK', '2014-04-11 13:12:25'),
(50, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 14:50:30'),
(51, 'efigari', 'efigari1980', '190.245.8.228', 1, 'Clave Incorrecta', '2014-04-12 14:58:48'),
(52, 'efigari', 'efigari1980', '190.245.8.228', 2, 'Clave Incorrecta', '2014-04-12 14:59:07'),
(53, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 14:59:53'),
(54, 'efigari', 'efigari1980', '190.245.8.228', 3, 'Clave Incorrecta', '2014-04-12 15:01:34'),
(55, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 15:02:02'),
(56, 'efigari', 'efigari1980', '190.245.8.228', 4, 'Clave Incorrecta', '2014-04-12 15:03:11'),
(57, 'aromero', '', '190.245.8.228', 0, 'OK', '2014-04-12 15:03:27'),
(58, 'efigari', 'efigari1', '190.245.8.228', 5, 'Clave Incorrecta', '2014-04-12 15:05:11'),
(59, 'efigari', 'efigari', '190.245.8.228', 6, 'Inhabilitado', '2014-04-12 15:05:26'),
(60, 'acampanelli', '', '190.245.8.228', 0, 'OK', '2014-04-12 15:05:34'),
(61, 'efigari', 'efigari1', '190.245.8.228', 1, 'Clave Incorrecta', '2014-04-12 15:11:28'),
(62, 'efigari', '', '190.245.8.228', 0, 'OK', '2014-04-12 15:12:38'),
(63, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 16:42:30'),
(64, 'efigari', '', '190.245.8.228', 0, 'OK', '2014-04-12 16:44:19'),
(65, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 16:44:44'),
(66, 'efigari', '', '190.245.8.228', 0, 'OK', '2014-04-12 16:49:21'),
(67, 'amfernandez', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:06:27'),
(68, 'gmur', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:21:56'),
(69, 'smercado', 'scmercado9', '190.245.8.228', 1, 'Clave Incorrecta', '2014-04-12 17:23:17'),
(70, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:23:31'),
(71, 'amfernandez', 'amfernandez1948', '190.245.8.228', 1, 'Clave Incorrecta', '2014-04-12 17:25:20'),
(72, 'amfernandez', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:25:50'),
(73, 'acarmody', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:29:31'),
(74, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:30:15'),
(75, 'efigari', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:43:38'),
(76, 'amfernandez', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:46:14'),
(77, 'gmur', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:49:38'),
(78, 'amfernandez', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:50:16'),
(79, 'iuboldi', 'iuboldi203', '190.245.8.228', 0, 'Usuario invalido', '2014-04-12 17:53:33'),
(80, 'iuboldi', 'iuboldi203', '190.245.8.228', 0, 'Usuario invalido', '2014-04-12 17:53:54'),
(81, 'iuboldi', 'iuboldi203', '190.245.8.228', 0, 'Usuario invalido', '2014-04-12 17:54:29'),
(82, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 17:54:51'),
(83, 'spalacios', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:17:43'),
(84, 'agomez', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:19:23'),
(85, 'smercado', 'smercado', '190.245.8.228', 1, 'Clave Incorrecta', '2014-04-12 18:20:22'),
(86, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:20:26'),
(87, 'mgutierrez', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:21:37'),
(88, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:22:00'),
(89, 'tball', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:28:06'),
(90, 'vbuedo', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:29:06'),
(91, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:29:27'),
(92, 'jorozco', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:31:06'),
(93, 'jorozco', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:31:06'),
(94, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:31:32'),
(95, 'jorozco', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:32:44'),
(96, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:33:45'),
(97, 'amfernandez', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:34:53'),
(98, 'jorozco', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:37:00'),
(99, 'tball', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:37:58'),
(100, 'efigari', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:38:35'),
(101, 'areinoso', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:41:57'),
(102, 'efigari', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:43:46'),
(103, 'tball', 'tbal208', '190.245.8.228', 1, 'Clave Incorrecta', '2014-04-12 18:47:26'),
(104, 'tball', '', '190.245.8.228', 0, 'OK', '2014-04-12 18:47:48'),
(105, 'tball', '', '190.245.8.228', 0, 'OK', '2014-04-12 20:58:22'),
(106, 'smercado', '', '190.245.8.228', 0, 'OK', '2014-04-12 21:41:47'),
(107, 'vbuedo', '', '190.245.8.228', 0, 'OK', '2014-04-12 21:43:03'),
(108, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-04-12 22:03:38'),
(109, 'cventrica', '', '127.0.0.1', 0, 'OK', '2014-04-12 22:09:06'),
(110, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-04-12 23:00:06'),
(111, 'cventrica', '', '127.0.0.1', 0, 'OK', '2014-04-12 23:06:29'),
(112, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-04-12 23:59:08'),
(113, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-04-14 21:24:12'),
(114, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-04-15 09:58:31'),
(115, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-04-24 13:00:44'),
(116, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-04-25 14:32:21'),
(117, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-04-29 16:40:41'),
(118, 'aromero', '', '127.0.0.1', 0, 'OK', '2014-05-01 17:24:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`menu_id`, `parent_id`, `title`, `link`, `position`, `status`) VALUES
(1, 0, 'Home', '../principal/main.php', 0, 'A'),
(2, 7, 'Usuarios', '../user/list.php', 2, 'A'),
(3, 2, 'Nuevo Usuario', '../user/new.php', 2, 'A'),
(4, 7, 'Perfiles', '../profile/list.php', 3, 'A'),
(5, 4, 'Listado de Perfiles', '../profile/list.php', 1, 'A'),
(6, 4, 'Nuevo Perfil', '../profile/edit.php?id=newprofile', 2, 'A'),
(7, 0, 'Administración', '#', 2, 'A'),
(8, 7, 'Menu', '../menu/list.php', 3, 'A'),
(9, 8, 'Listado de Menues', '../menu/list.php', 1, 'A'),
(10, 8, 'Nuevo Menu', '../menu/new.php', 2, 'A'),
(11, 2, 'Listado de Usuarios', '../user/list.php', 1, 'A'),
(15, 7, 'Secciones', '../section/list.php', 2, 'A'),
(16, 15, 'Listado de Secciones', '../section/list.php', 1, 'A'),
(19, 15, 'Nueva Sección', '../section/new.php', 2, 'A'),
(20, 15, 'Listado de Secciones Eliminadas', '../section/list.php?status=I', 3, 'A'),
(21, 7, 'Artículos', '#', 5, 'A'),
(22, 21, 'Listado de Artículos', '../article/list.php', 1, 'A'),
(23, 21, 'Nuevo Artículo', '../article/new.php', 2, 'A'),
(24, 0, 'Secciones', '#', 3, 'A'),
(25, 24, 'Foro 3° Año', '../section/section.php?id=1', 0, 'A'),
(37, 0, 'Información', '../information/information.php', 4, 'A'),
(38, 24, 'Foro 2° Año', '../section/section.php?id=12', 0, 'A'),
(40, 24, 'Foro Farmacia', '../section/section.php?id=13', 0, 'A'),
(43, 24, 'Foro 1° Año', '../section/section.php?id=14', 0, 'A'),
(45, 24, 'Odontoestomatología', '../section/section.php?id=16', 0, 'A'),
(46, 7, 'Grupos', '', 4, 'A'),
(47, 46, 'Listado de Grupos', '../group/list.php', 1, 'A'),
(48, 46, 'Nuevo Grupo', '../group/new.php', 2, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_exception`
--

DROP TABLE IF EXISTS `menu_exception`;
CREATE TABLE `menu_exception` (
  `exception_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`exception_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `menu_exception`
--

INSERT INTO `menu_exception` (`exception_id`, `menu_id`, `admin_id`) VALUES
(1, 7, 122),
(2, 2, 122),
(3, 3, 122),
(4, 11, 122);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation_admin_group`
--

DROP TABLE IF EXISTS `relation_admin_group`;
CREATE TABLE `relation_admin_group` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`),
  KEY `admin_id` (`admin_id`,`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `relation_admin_group`
--

INSERT INTO `relation_admin_group` (`relation_id`, `admin_id`, `group_id`) VALUES
(3, 122, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation_article_group`
--

DROP TABLE IF EXISTS `relation_article_group`;
CREATE TABLE `relation_article_group` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation_article_profile`
--

DROP TABLE IF EXISTS `relation_article_profile`;
CREATE TABLE `relation_article_profile` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `relation_article_profile`
--

INSERT INTO `relation_article_profile` (`relation_id`, `article_id`, `profile_id`) VALUES
(2, 1, 13),
(4, 4, 15),
(5, 0, 15),
(6, 0, 15),
(7, 0, 16),
(9, 5, 15),
(10, 0, 15),
(13, 8, 16),
(14, 6, 15),
(15, 9, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation_group_profile`
--

DROP TABLE IF EXISTS `relation_group_profile`;
CREATE TABLE `relation_group_profile` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `relation_group_profile`
--

INSERT INTO `relation_group_profile` (`relation_id`, `group_id`, `profile_id`) VALUES
(2, 2, 4),
(5, 1, 14),
(10, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation_menu_group`
--

DROP TABLE IF EXISTS `relation_menu_group`;
CREATE TABLE `relation_menu_group` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `relation_menu_group`
--

INSERT INTO `relation_menu_group` (`relation_id`, `menu_id`, `group_id`) VALUES
(8, 1, 3),
(9, 7, 3),
(10, 2, 3),
(11, 3, 3),
(12, 11, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation_menu_profile`
--

DROP TABLE IF EXISTS `relation_menu_profile`;
CREATE TABLE `relation_menu_profile` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=422 ;

--
-- Volcado de datos para la tabla `relation_menu_profile`
--

INSERT INTO `relation_menu_profile` (`relation_id`, `menu_id`, `profile_id`) VALUES
(57, 2, 1),
(58, 4, 1),
(59, 3, 1),
(60, 5, 1),
(61, 6, 1),
(78, 2, 9),
(79, 4, 9),
(80, 3, 9),
(81, 5, 9),
(82, 6, 9),
(84, 2, 10),
(85, 3, 10),
(86, 4, 10),
(87, 5, 10),
(88, 6, 10),
(107, 4, 2),
(109, 5, 2),
(110, 6, 2),
(111, 7, 1),
(112, 11, 1),
(113, 8, 1),
(114, 9, 1),
(115, 10, 1),
(116, 15, 1),
(117, 16, 1),
(118, 19, 1),
(119, 20, 1),
(120, 21, 1),
(121, 22, 1),
(122, 23, 1),
(123, 7, 2),
(125, 8, 2),
(126, 9, 2),
(127, 10, 2),
(128, 15, 2),
(129, 16, 2),
(130, 19, 2),
(131, 20, 2),
(132, 21, 2),
(133, 22, 2),
(134, 23, 2),
(149, 7, 4),
(150, 21, 4),
(151, 22, 4),
(152, 23, 4),
(153, 15, 4),
(154, 16, 4),
(155, 19, 4),
(156, 20, 4),
(157, 2, 2),
(158, 3, 2),
(159, 11, 2),
(174, 27, 1),
(176, 24, 14),
(179, 24, 11),
(184, 28, 11),
(185, 28, 14),
(193, 24, 4),
(195, 27, 4),
(196, 28, 4),
(197, 24, 2),
(199, 27, 2),
(200, 28, 2),
(201, 24, 1),
(202, 28, 1),
(213, 30, 1),
(214, 30, 2),
(216, 30, 4),
(217, 30, 5),
(218, 30, 6),
(219, 30, 7),
(220, 30, 8),
(221, 30, 9),
(231, 32, 1),
(232, 32, 2),
(234, 32, 4),
(235, 32, 5),
(236, 32, 6),
(237, 32, 7),
(238, 32, 8),
(239, 32, 9),
(240, 32, 11),
(251, 25, 1),
(252, 25, 2),
(254, 25, 4),
(255, 25, 5),
(256, 25, 6),
(257, 25, 7),
(258, 25, 8),
(259, 25, 9),
(271, 38, 1),
(272, 38, 2),
(274, 38, 4),
(275, 38, 5),
(276, 38, 6),
(277, 38, 7),
(278, 38, 8),
(279, 38, 9),
(333, 43, 1),
(334, 43, 2),
(336, 43, 4),
(337, 43, 5),
(338, 43, 6),
(339, 43, 7),
(340, 43, 8),
(341, 43, 9),
(342, 43, 14),
(343, 44, 1),
(344, 44, 2),
(346, 44, 4),
(347, 44, 5),
(348, 44, 6),
(349, 44, 7),
(350, 44, 8),
(351, 44, 9),
(353, 45, 1),
(354, 45, 2),
(356, 45, 4),
(357, 45, 5),
(358, 45, 6),
(359, 45, 7),
(360, 45, 8),
(361, 45, 9),
(373, 40, 1),
(374, 40, 2),
(376, 40, 4),
(377, 40, 5),
(378, 40, 6),
(379, 40, 7),
(380, 40, 8),
(381, 40, 9),
(413, 50, 1),
(414, 50, 2),
(416, 50, 4),
(417, 50, 5),
(418, 50, 6),
(419, 50, 7),
(420, 50, 8),
(421, 50, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation_section_admin`
--

DROP TABLE IF EXISTS `relation_section_admin`;
CREATE TABLE `relation_section_admin` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `relation_section_admin`
--

INSERT INTO `relation_section_admin` (`relation_id`, `section_id`, `admin_id`) VALUES
(2, 1, 51),
(3, 12, 54),
(5, 14, 55),
(6, 14, 65),
(8, 16, 66),
(9, 13, 68);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation_section_profile`
--

DROP TABLE IF EXISTS `relation_section_profile`;
CREATE TABLE `relation_section_profile` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `relation_section_profile`
--

INSERT INTO `relation_section_profile` (`relation_id`, `section_id`, `profile_id`) VALUES
(2, 1, 13),
(3, 12, 15),
(5, 14, 14),
(7, 16, 16),
(8, 13, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` char(1) NOT NULL DEFAULT 'Y',
  `reply` char(1) NOT NULL DEFAULT 'Y',
  `public` char(1) NOT NULL DEFAULT 'Y',
  `creation_date` datetime NOT NULL,
  `modification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update_id` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `section`
--

INSERT INTO `section` (`section_id`, `author_id`, `title`, `comment`, `reply`, `public`, `creation_date`, `modification_date`, `last_update_id`, `status`) VALUES
(1, 1, 'Foro 3° Año', 'Y', 'Y', 'N', '2014-03-12 05:13:12', '2014-04-05 14:01:06', 51, 'A'),
(11, 21, 'Información', 'Y', 'Y', 'Y', '2014-04-09 09:54:59', '2014-04-09 12:55:46', 0, 'I'),
(12, 1, 'Foro 2° Año', 'Y', 'Y', 'N', '2014-04-10 15:23:54', '2014-04-10 18:23:54', 0, 'A'),
(13, 1, 'Foro Farmacia', 'Y', 'Y', 'N', '2014-04-10 15:40:29', '2014-04-12 17:09:38', 68, 'A'),
(14, 21, 'Foro 1° Año', 'Y', 'Y', 'N', '2014-04-12 11:55:46', '2014-04-12 14:55:46', 0, 'A'),
(15, 54, 'Odontoestomatología', 'Y', 'Y', 'N', '2014-04-12 13:41:53', '2014-04-12 16:42:14', 0, 'I'),
(16, 21, 'Odontoestomatología', 'Y', 'Y', 'N', '2014-04-12 13:43:31', '2014-04-12 16:43:31', 0, 'A');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
