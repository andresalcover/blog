-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-12-2012 a las 17:24:16
-- Versión del servidor: 5.1.50
-- Versión de PHP: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(45) COLLATE utf8_bin NOT NULL,
  `title` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `post_intro` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `post`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_detail`
--

CREATE TABLE IF NOT EXISTS `post_detail` (
  `id_post_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) DEFAULT NULL,
  `detail` mediumblob,
  PRIMARY KEY (`id_post_detail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `post_detail`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `password` varchar(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'andres', '231badb19b93e44f47da1bd64a8147f2');
