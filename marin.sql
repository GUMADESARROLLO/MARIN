-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2017 a las 09:09:16
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marin`
--
CREATE DATABASE IF NOT EXISTS `marin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `marin`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `pc_Catalogo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pc_Catalogo` (IN `CATALOGO` INT)  BEGIN
		DECLARE v_IdCT, v_CodImg, v_Puntos,v_Desc 	INT;
		DECLARE v_Nombre VARCHAR(255);
		DECLARE v_Nombre2 VARCHAR(255);
		DECLARE v_Imagen VARCHAR(150);
	  DECLARE v_Imagen2 VARCHAR(150);
		DECLARE v_Und VARCHAR(10);
		
		
		DECLARE cont, conse INT DEFAULT 1;
		
		DECLARE CSQL VARCHAR(20000) DEFAULT "(";
		DECLARE RELLENO, errores INT DEFAULT 0;
		
		DECLARE data_cursor CURSOR FOR 
			SELECT detallect.IdCT, detallect.IdIMG, detallect.Nombre,detallect.Nombre2, detallect.IMG,detallect.IMG2,detallect.UndArti, detallect.Puntos,detallect.Descuento
			FROM detallect
			WHERE detallect.IdCT = CATALOGO AND detallect.Estado <> 1
			ORDER BY detallect.IdIMG;
		DECLARE CONTINUE HANDLER FOR NOT FOUND SET errores = 1;

		SELECT COUNT(IdCT) INTO RELLENO FROM detallect WHERE detallect.IdCT = CATALOGO AND detallect.Estado <> 1;
       
        IF RELLENO <> 0 THEN
          OPEN data_cursor;
               read_data: LOOP
                          FETCH data_cursor INTO v_IdCT, v_CodImg, v_Nombre,v_Nombre2, v_Imagen,v_Imagen2,v_Und,v_Puntos,v_Desc;
				
				           IF errores = 1 THEN LEAVE read_data; END IF;
                
				           SET CSQL = CONCAT(CSQL, v_IdCT, ",", v_CodImg, ",'", v_Nombre, "','",v_Nombre2,"','", v_Imagen,"','",v_Imagen2,"','",v_Und, "','", v_Puntos,"',",v_Desc);
                
				           IF cont = 4 THEN                    
                              IF conse = RELLENO THEN
                                 SET CSQL = CONCAT(CSQL, ")");
                              ELSE
                                  SET CSQL = CONCAT(CSQL, "),(");
                              END IF;	
                    
                              SET cont = 0;
                          ELSEIF conse < RELLENO THEN
                              SET CSQL = CONCAT(CSQL, ",");   
                          END IF;
				
				          SET cont = cont + 1;
				          SET conse = conse + 1;
                END LOOP read_data;
		    CLOSE data_cursor;
            	    
		    SET RELLENO = 4 - (((RELLENO/4) - FLOOR(RELLENO/4)) * 4);
		    
		    IF RELLENO < 4 THEN
               SET CSQL = CONCAT(CSQL, ",");
               
			   WHILE RELLENO <> 0 DO
			         SET CSQL = CONCAT(CSQL, "'0','0','','','','','','0','0'");
            		 SET RELLENO = RELLENO - 1;
                
				     IF RELLENO <> 0 THEN
				        SET CSQL = CONCAT(CSQL, ",");
                     ELSE
                        SET CSQL = CONCAT(CSQL, ")");
                     END IF;
               END WHILE;
           END IF;
   	       
		   DELETE FROM tmp_Catalogo;
           
		   SET @query = CONCAT("INSERT INTO tmp_Catalogo VALUES", CSQL);
           
		   PREPARE IC FROM @query; 
		   EXECUTE IC; 
		   DEALLOCATE PREPARE IC;
		END IF;
END$$

DROP PROCEDURE IF EXISTS `pc_Clientes_Facturas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pc_Clientes_Facturas` (IN `cod` VARCHAR(20))  NO SQL
SELECT GROUP_CONCAT(CONCAT("'",Factura,"'")) as Facturas  
FROM view_frp_factura
WHERE IdCliente = cod AND SALDO = 0 AND ANULADO = 'N'
GROUP BY IdCliente$$

DROP PROCEDURE IF EXISTS `pc_clientes_pa`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pc_clientes_pa` (IN `cod` NVARCHAR(20))  BEGIN
  SELECT T0.IdCliente, SUM(T0.Puntos) AS Puntos FROM view_frp_factura T0
  WHERE T0.Anulado = 'N' AND T0.IdCliente = cod
  GROUP BY T0.IdCliente;
END$$

DROP PROCEDURE IF EXISTS `pc_factura_parcial`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pc_factura_parcial` (IN `cfact` INT)  BEGIN
  SELECT SUM(Puntos) 
  FROM view_frp_factura
  WHERE SALDO <> 0 AND anulado = 'N' AND Factura = cfact;
END$$

DROP PROCEDURE IF EXISTS `pc_mfactura`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pc_mfactura` (IN `infactura` NCHAR(20), IN `inpuntos` INT, IN `fecha` DATETIME)  BEGIN
     UPDATE rfactura SET Puntos = (Puntos + INPUNTOS), FechaActualizacion = FECHA  WHERE Factura = INFACTURA;
END$$

DROP PROCEDURE IF EXISTS `pc_RFactura`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pc_RFactura` (IN `INFACTURA` CHAR(20), IN `INPUNTOS` INT, IN `CLIENTE` CHAR(30), IN `FECHA` DATETIME, IN `ttpuntos` INTEGER)  BEGIN
                IF EXISTS(SELECT Factura FROM rfactura  WHERE Factura=INFACTURA) THEN
                BEGIN
                    UPDATE rfactura SET Puntos= (Puntos - INPUNTOS), FechaActualizacion = FECHA  WHERE Factura = INFACTURA;
                END;
                ELSE
                BEGIN
                               INSERT INTO rfactura (IdCliente,Factura,ttPuntos,Puntos,FechaActualizacion) 
                               VALUES(CLIENTE,INFACTURA,ttpuntos,ttpuntos-INPUNTOS,FECHA);       
               END;
END IF ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

DROP TABLE IF EXISTS `catalogo`;
CREATE TABLE `catalogo` (
  `IdCT` int(11) NOT NULL,
  `Descripcion` varchar(150) DEFAULT NULL,
  `Estado` bit(1) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`IdCT`, `Descripcion`, `Estado`, `Fecha`) VALUES
(19, 'catalogo de octubre', b'1', '2016-10-01 00:00:00'),
(20, 'CATALOGO ENERO 2017', b'1', '2017-01-01 00:00:00'),
(22, 'CATALOGO MARZO 2017', b'0', '2017-03-14 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catrol`
--

DROP TABLE IF EXISTS `catrol`;
CREATE TABLE `catrol` (
  `IdRol` int(11) NOT NULL,
  `Descripcion` varchar(4000) DEFAULT NULL,
  `Estado` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `catrol`
--

INSERT INTO `catrol` (`IdRol`, `Descripcion`, `Estado`) VALUES
(1, 'SUPER ADMINISTRADOR', b'0'),
(2, 'ADMINISTRADOR', b'0'),
(5, 'VISTA', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallect`
--

DROP TABLE IF EXISTS `detallect`;
CREATE TABLE `detallect` (
  `IdCT` int(11) DEFAULT NULL,
  `IdIMG` varchar(150) DEFAULT NULL,
  `Nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nombre2` varchar(150) DEFAULT NULL,
  `IMG` varchar(150) DEFAULT NULL,
  `IMG2` varchar(150) DEFAULT NULL,
  `Puntos` varchar(150) DEFAULT NULL,
  `Descuento` int(11) DEFAULT NULL,
  `Estado` bit(1) DEFAULT NULL,
  `UndArti` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallect`
--

INSERT INTO `detallect` (`IdCT`, `IdIMG`, `Nombre`, `Nombre2`, `IMG`, `IMG2`, `Puntos`, `Descuento`, `Estado`, `UndArti`) VALUES
(22, '1', 'ME VALE', '1', 'noIMG.jpg', 'noIMG.jpg', '1', 1, b'1', 'UND'),
(22, '2', 'MARTIN', 'martin', 'noIMG.jpg', 'noIMG.jpg', '1', 0, b'1', 'undndnn'),
(22, '3', 'JLJLFDSKJ', 'lskjdflskjd', 'noIMG.jpg', 'noIMG.jpg', '1', 0, b'0', 'lksjdflksj'),
(22, '4', 'DFKJGL/-%KDJFXGL/-%KJ', 'slkñdjfglñkdjf', 'noIMG.jpg', 'noIMG.jpg', '1', 0, b'0', 'sdlkfjglsk'),
(22, '5', '/-%DKLF´/-%GSKDFLKQKG´/-%DLKBW', 'SFÑLGKDÑGKÑFKQQlskd', 'noIMG.jpg', 'noIMG.jpg', '1', 0, b'1', 'gggg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefrp`
--

DROP TABLE IF EXISTS `detallefrp`;
CREATE TABLE `detallefrp` (
  `IdFRP` int(10) NOT NULL,
  `Factura` varchar(10) NOT NULL,
  `Fecha` varchar(15) NOT NULL,
  `Faplicado` int(20) NOT NULL,
  `IdArticulo` int(10) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Puntos` int(20) NOT NULL,
  `Cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Detalles del FRP';

--
-- Volcado de datos para la tabla `detallefrp`
--

INSERT INTO `detallefrp` (`IdFRP`, `Factura`, `Fecha`, `Faplicado`, `IdArticulo`, `Descripcion`, `Puntos`, `Cantidad`) VALUES
(17, '20002503', '2016-11-07', 3100, 131312, 'HORNO MIC WHIRLP WMS07ZWHS 0.7CF BLC', 3100, 1),
(17, '20002529', '2016-11-16', 4300, 131312, 'HORNO MIC WHIRLP WMS07ZWHS 0.7CF BLC', 1498, 1),
(17, '20002529', '2016-11-16', 4300, 136494, 'ABAN PIE SANKEY CN40ST3B 16"', 1012, 1),
(17, '20002529', '2016-11-16', 4300, 118874, 'CAFETERA PSILEX 48524 12TZ NEG', 998, 1),
(16, '10002518', '2016-11-16', 7700, 151168, 'TV LED 24" LG 24MT48', 7700, 1),
(16, '10002548', '2016-11-22', 7700, 151168, 'TV LED 24" LG 24MT48', 4298, 1),
(16, '10002548', '2016-11-22', 7700, 118874, 'CAFETERA PSILEX 48524 12TZ NEG', 2994, 3),
(16, '10002548', '2016-11-22', 7700, 131312, 'HORNO MIC WHIRLP WMS07ZWHS 0.7CF BLC', 408, 3),
(16, '10002568', '2016-11-28', 13800, 131312, 'HORNO MIC WHIRLP WMS07ZWHS 0.7CF BLC', 13386, 3),
(16, '10002568', '2016-11-28', 13800, 136494, 'ABAN PIE SANKEY CN40ST3B 16"', 414, 5),
(16, '10002583', '2016-11-30', 9200, 136494, 'ABAN PIE SANKEY CN40ST3B 16"', 4646, 5),
(18, '10002545', '2016-11-21', 2750, 148524, 'CAFETERA B&amp;D DCM600B 5TZ NEG', 1238, 1),
(19, '10002583', '2016-11-30', 4554, 149532, 'MINICOMP LG CM4360 2500W', 4554, 1),
(19, '10002608', '2016-12-12', 8400, 149532, 'MINICOMP LG CM4360 2500W', 5444, 1),
(51, '10002602', '2016-12-05', 1500, 131192, 'OLLA PRES TELSTAR TPS0700NR 7L', 1498, 1),
(101, '10002522', '2016-11-21', 800, 136494, 'ABAN PIE SANKEY CN40ST3B 16"', 800, 5),
(101, '10002619', '2016-12-13', 3000, 136494, 'ABAN PIE SANKEY CN40ST3B 16"', 3000, 5),
(101, '10002682', '2016-12-29', 1500, 136494, 'ABAN PIE SANKEY CN40ST3B 16"', 1260, 5),
(20, '10002608', '2016-12-12', 2956, 134602, 'SART ELEC B&amp;D SK1212B 12"', 2956, 1),
(20, '10002642', '2016-12-19', 13800, 134602, 'SART ELEC B&amp;D SK1212B 12"', 302, 1),
(20, '10002642', '2016-12-19', 13800, 125686, 'ABAN BOX LASKO 3300', 3598, 1),
(20, '10002642', '2016-12-19', 13800, 148524, 'CAFETERA B&amp;D DCM600B 5TZ NEG', 1238, 1),
(20, '10002642', '2016-12-19', 13800, 131192, 'OLLA PRES TELSTAR TPS0700NR 7L', 2996, 2),
(20, '10002642', '2016-12-19', 13800, 136494, 'ABAN PIE SANKEY CN40ST3B 16"', 5666, 8),
(20, '10002665', '2016-12-23', 9200, 136494, 'ABAN PIE SANKEY CN40ST3B 16"', 2430, 8),
(21, '10002665', '2016-12-23', 6770, 150119, 'MINICOMP LG OM4560 2500W', 6770, 1),
(21, '10002691', '2017-01-06', 9000, 150119, 'MINICOMP LG OM4560 2500W', 5228, 1),
(252, '10002490', '2016-11-07', 1500, 134857, 'DVD SONY DVPSR370 USB', 1500, 1),
(252, '10002570', '2016-11-28', 1500, 134857, 'DVD SONY DVPSR370 USB', 1298, 1),
(201, '10002611', '2016-12-12', 1500, 131192, 'OLLA PRES TELSTAR TPS0700NR 7L', 1498, 1),
(22, '10002545', '2016-11-21', 1512, 131312, 'HORNO MIC WHIRLP WMS07ZWHS 0.7CF BLC', 1512, 1),
(22, '10002584', '2016-11-30', 1176, 131312, 'HORNO MIC WHIRLP WMS07ZWHS 0.7CF BLC', 1176, 1),
(22, '10002647', '2016-12-20', 2000, 131312, 'HORNO MIC WHIRLP WMS07ZWHS 0.7CF BLC', 1910, 1),
(22, '10002647', '2016-12-20', 2000, 148354, 'OLLA ARROC B&amp;D RC514B 14TZ', 90, 1),
(22, '10002693', '2017-01-10', 2080, 148354, 'OLLA ARROC B&amp;D RC514B 14TZ', 1908, 1),
(103, '20002558', '2016-11-25', 900, 149960, 'EXTRACTOR B&amp;D JE2400BD', 900, 1),
(103, '20002726', '2017-01-30', 900, 149960, 'EXTRACTOR B&amp;D JE2400BD', 900, 1),
(103, '20002869', '2017-03-08', 1500, 149960, 'EXTRACTOR B&amp;D JE2400BD', 1318, 1),
(104, '10002553', '2016-11-23', 1500, 148524, 'CAFETERA B&amp;D DCM600B 5TZ NEG', 1238, 1),
(104, '10002553', '2016-11-23', 1500, 150024, 'PLANCHA B&amp;D IR1830 VAPOR', 262, 1),
(104, '10002566', '2016-11-28', 900, 150024, 'PLANCHA B&amp;D IR1830 VAPOR', 900, 1),
(104, '10002822', '2017-02-07', 2400, 150024, 'PLANCHA B&amp;D IR1830 VAPOR', 296, 1),
(104, '10002822', '2017-02-07', 2400, 148784, 'MULTIFUNCIONAL INYEC HP DJ2135', 2058, 1),
(152, '10002613', '2016-12-12', 1500, 151325, 'OLLA ARROC B&amp;D RC5200M INOX 20TZ', 1500, 1),
(152, '10002764', '2017-01-24', 1500, 151325, 'OLLA ARROC B&amp;D RC5200M INOX 20TZ', 1418, 1),
(303, '20002500', '2016-11-03', 2000, 135374, 'COC GAS MABE EMG6135IIS1 24" 4Q INOX', 2000, 1),
(303, '20002555', '2016-11-25', 3000, 135374, 'COC GAS MABE EMG6135IIS1 24" 4Q INOX', 3000, 1),
(303, '10002621', '2016-12-13', 1500, 135374, 'COC GAS MABE EMG6135IIS1 24" 4Q INOX', 1500, 1),
(303, '20002625', '2016-12-22', 4000, 135374, 'COC GAS MABE EMG6135IIS1 24" 4Q INOX', 4000, 1),
(303, '10002741', '2017-01-19', 1000, 135374, 'COC GAS MABE EMG6135IIS1 24" 4Q INOX', 1000, 1),
(303, '10002826', '2017-02-08', 1500, 135374, 'COC GAS MABE EMG6135IIS1 24" 4Q INOX', 1500, 1),
(303, '10002865', '2017-02-20', 1000, 135374, 'COC GAS MABE EMG6135IIS1 24" 4Q INOX', 1000, 1),
(303, '20002794', '2017-02-20', 8000, 135374, 'COC GAS MABE EMG6135IIS1 24" 4Q INOX', 3998, 1),
(303, '20002794', '2017-02-20', 8000, 145171, 'REF SEMI FRIGID FRT13G3HNG 6CF 168L GR', 4002, 1),
(303, '20002880', '2017-03-10', 10000, 145171, 'REF SEMI FRIGID FRT13G3HNG 6CF 168L GR', 9996, 1),
(304, '10002860', '2017-02-15', 15000, 131311, 'HORNO MIC WHIRLP WMS07ZDHS 0.7CF SILVER', 4998, 1),
(304, '10002860', '2017-02-15', 15000, 139254, 'HORNO TOST B&amp;D TO1950SBD', 4338, 1),
(304, '10002860', '2017-02-15', 15000, 101345, 'LICUADORA OSTER 4108 PLAST 10 V', 2998, 1),
(304, '10002860', '2017-02-15', 15000, 120344, 'HORNO TOST B&amp;D TRO420', 2666, 1),
(304, '11540', '2017-04-03', 75, 120344, 'HORNO TOST B&amp;D TRO420', 72, 1),
(105, '10002682', '2016-12-29', 240, 133746, 'OLLA MULTIUSO TELSTAR TMU0655NH 6L INOX', 240, 1),
(105, '10002775', '2017-01-27', 2300, 133746, 'OLLA MULTIUSO TELSTAR TMU0655NH 6L INOX', 2300, 1),
(105, '10002834', '2017-02-10', 1500, 133746, 'OLLA MULTIUSO TELSTAR TMU0655NH 6L INOX', 800, 1),
(105, '10002834', '2017-02-10', 1500, 131359, 'COMODA KAPPERSBERG A414', 700, 1),
(105, '10002861', '2017-02-16', 1500, 131359, 'COMODA KAPPERSBERG A414', 1500, 1),
(105, '10002897', '2017-02-28', 4500, 131359, 'COMODA KAPPERSBERG A414', 3798, 1),
(105, '10002897', '2017-02-28', 4500, 150024, 'PLANCHA B&amp;D IR1830 VAPOR', 702, 1),
(105, '10002988', '2017-03-16', 800, 150024, 'PLANCHA B&amp;D IR1830 VAPOR', 756, 1),
(352, '20002636', '2016-12-27', 7500, 118172, 'CAMAROTE MAT CAPRI TOLEDO MET NEG', 7500, 1),
(352, '20002895', '2017-03-16', 9000, 118172, 'CAMAROTE MAT CAPRI TOLEDO MET NEG', 4898, 1),
(352, '20002895', '2017-03-16', 9000, 140950, 'ABAN TORRE TELSTAR TVT29015TM 29"', 3198, 1),
(6666, '10002517', '2016-11-16', 1500, 137825, 'MOCHILA P/PORT KLIP EXTREME KNB405 16.4"', 1049, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frp`
--

DROP TABLE IF EXISTS `frp`;
CREATE TABLE `frp` (
  `IdFRP` int(10) NOT NULL,
  `Fecha` datetime NOT NULL,
  `IdCliente` varchar(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Anulado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `frp`
--

INSERT INTO `frp` (`IdFRP`, `Fecha`, `IdCliente`, `Nombre`, `IdUsuario`, `Anulado`) VALUES
(17, '2017-01-12 00:00:00', 'CL008290', 'DISTRIBUIDORA DE OCCIDENTE', 23, 'N'),
(16, '2017-01-13 00:00:00', 'CL008227', 'LACTEOS CENTROAMERICANOS, S.A', 23, 'N'),
(18, '2017-01-18 00:00:00', 'CL008205', 'ADALINDA CONSUELO LARIOS SIRIAS (DISTRI. RAYOS DEL', 23, 'N'),
(19, '2017-01-19 00:00:00', 'CL008227', 'LACTEOS CENTROAMERICANOS, S.A', 23, 'N'),
(51, '2017-02-13 00:00:00', 'CL005107', 'FRANCELA ELIZABETH VALLEJOS GARCÍA', 23, 'N'),
(101, '2017-02-13 00:00:00', 'CL000373', 'JOVANNY ANTONIO PEREZ FLORES', 23, 'N'),
(20, '2017-02-14 00:00:00', 'CL008227', 'LACTEOS CENTROAMERICANOS, S.A', 23, 'N'),
(21, '2017-02-14 00:00:00', 'CL008227', 'LACTEOS CENTROAMERICANOS, S.A', 23, 'N'),
(252, '2017-02-22 00:00:00', 'CL000058', 'ERICK RAMON CASTRO', 23, 'N'),
(201, '2017-03-06 00:00:00', 'CL002643', 'JOSE CANDELARIO SEQUEIRA HERNANDEZ', 23, 'N'),
(22, '2017-03-08 00:00:00', 'CL008205', 'ADALINDA CONSUELO LARIOS SIRIAS (DISTRI. RAYOS DEL', 23, 'N'),
(103, '2017-03-14 00:00:00', 'CL007651', 'FRANCISCO GUADAMUZ', 23, 'N'),
(104, '2017-03-29 00:00:00', 'CL000305', 'ALFREDO JOSE CASTILLO LOPEZ', 23, 'N'),
(152, '2017-04-05 00:00:00', 'CL000346', 'JACSON URBINA URBINA', 23, 'N'),
(303, '2017-04-05 00:00:00', 'CL008280', 'JONATHAN FRANCISCO MENDOZA DAVILA', 23, 'N'),
(304, '2017-04-25 00:00:00', 'CL008362', 'FREDY ANDRES IBARRA CANALES', 23, 'N'),
(105, '2017-04-25 00:00:00', 'CL000373', 'JOVANNY ANTONIO PEREZ FLORES', 23, 'N'),
(352, '2017-04-25 00:00:00', 'CL008130', 'TEODORA JIMENEZ RIVERA', 23, 'N'),
(6666, '2017-05-09 00:00:00', 'CL000198', 'VILMA SOLANO LUMBI', 1, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rfactura`
--

DROP TABLE IF EXISTS `rfactura`;
CREATE TABLE `rfactura` (
  `IdCliente` varchar(20) NOT NULL,
  `Factura` varchar(20) NOT NULL,
  `ttPuntos` int(100) NOT NULL,
  `Puntos` int(20) NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rfactura`
--

INSERT INTO `rfactura` (`IdCliente`, `Factura`, `ttPuntos`, `Puntos`, `FechaActualizacion`) VALUES
('CL008290', '20002503', 3100, 0, '2017-01-12 03:21:23'),
('CL008290', '20002529', 4300, 792, '2017-01-12 03:21:23'),
('CL008227', '10002518', 7700, 0, '2017-01-13 10:11:14'),
('CL008227', '10002548', 7700, 0, '2017-01-13 10:11:14'),
('CL008227', '10002568', 13800, 0, '2017-01-13 10:11:14'),
('CL008227', '10002583', 9200, 0, '2017-01-19 08:33:11'),
('CL008205', '10002545', 2750, 0, '2017-03-08 05:29:55'),
('CL008227', '10002608', 8400, 0, '2017-02-14 09:32:46'),
('CL005107', '10002602', 1500, 2, '2017-02-13 03:56:44'),
('CL000373', '10002522', 800, 0, '2017-02-13 04:02:20'),
('CL000373', '10002619', 3000, 0, '2017-02-13 04:02:20'),
('CL000373', '10002682', 1500, 0, '2017-04-25 11:22:22'),
('CL008227', '10002642', 13800, 0, '2017-02-14 09:32:46'),
('CL008227', '10002665', 9200, 0, '2017-02-14 09:38:09'),
('CL008227', '10002691', 9000, 3772, '2017-02-14 09:38:09'),
('CL000058', '10002490', 1500, 0, '2017-02-22 11:24:31'),
('CL000058', '10002570', 1500, 202, '2017-02-22 11:24:31'),
('CL002643', '10002611', 1500, 2, '2017-03-06 10:41:17'),
('CL008205', '10002584', 1176, 0, '2017-03-08 05:29:55'),
('CL008205', '10002647', 2000, 0, '2017-03-08 05:29:55'),
('CL008205', '10002693', 2080, 172, '2017-03-08 05:29:55'),
('CL007651', '20002558', 900, 0, '2017-03-14 04:23:51'),
('CL007651', '20002726', 900, 0, '2017-03-14 04:23:51'),
('CL007651', '20002869', 1500, 182, '2017-03-14 04:23:51'),
('CL000305', '10002553', 1500, 0, '2017-03-29 02:38:28'),
('CL000305', '10002566', 900, 0, '2017-03-29 02:38:28'),
('CL000305', '10002822', 2400, 46, '2017-03-29 02:38:28'),
('CL000346', '10002613', 1500, 0, '2017-04-05 08:48:39'),
('CL000346', '10002764', 1500, 82, '2017-04-05 08:48:39'),
('CL008280', '20002500', 2000, 0, '2017-04-05 08:58:13'),
('CL008280', '20002555', 3000, 0, '2017-04-05 08:58:13'),
('CL008280', '10002621', 1500, 0, '2017-04-05 08:58:13'),
('CL008280', '20002625', 4000, 0, '2017-04-05 08:58:13'),
('CL008280', '10002741', 1000, 0, '2017-04-05 08:58:13'),
('CL008280', '10002826', 1500, 0, '2017-04-05 08:58:14'),
('CL008280', '10002865', 1000, 0, '2017-04-05 08:58:14'),
('CL008280', '20002794', 8000, 0, '2017-04-05 08:58:14'),
('CL008280', '20002880', 10000, 4, '2017-04-05 08:58:14'),
('CL008362', '10002860', 15000, 0, '2017-04-25 10:58:45'),
('CL008362', '11540', 75, 3, '2017-04-25 10:58:45'),
('CL000373', '10002775', 2300, 0, '2017-04-25 11:22:22'),
('CL000373', '10002834', 1500, 0, '2017-04-25 11:22:22'),
('CL000373', '10002861', 1500, 0, '2017-04-25 11:22:22'),
('CL000373', '10002897', 4500, 0, '2017-04-25 11:22:22'),
('CL000373', '10002988', 800, 44, '2017-04-25 11:22:22'),
('CL008130', '20002636', 7500, 0, '2017-04-25 11:34:22'),
('CL008130', '20002895', 9000, 904, '2017-04-25 11:34:22'),
('CL000198', '10002517', 1500, 451, '2017-05-09 08:09:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

DROP TABLE IF EXISTS `tblusuario`;
CREATE TABLE `tblusuario` (
  `IdUsuario` int(11) NOT NULL,
  `Usuario` varchar(50) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Clave` varchar(50) DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `Zona` varchar(255) DEFAULT NULL,
  `IdVendedor` varchar(10) DEFAULT NULL,
  `NombreVendedor` varchar(255) DEFAULT NULL,
  `FechaCreacion` datetime DEFAULT NULL,
  `FechaBaja` datetime DEFAULT NULL,
  `Estado` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`IdUsuario`, `Usuario`, `Nombre`, `Clave`, `IdRol`, `Zona`, `IdVendedor`, `NombreVendedor`, `FechaCreacion`, `FechaBaja`, `Estado`) VALUES
(1, 'Super Admin', 'Super Admin', '7c33fc4a0d1662cf5a5e8eb686a1dec3', 1, '', NULL, NULL, '2016-09-28 11:15:23', '2016-10-03 10:27:48', b'1'),
(37, 'vista', 'vista', 'e10adc3949ba59abbe56e057f20f883e', 5, NULL, '0', '0', '2017-07-25 16:56:31', NULL, b'1'),
(38, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 2, NULL, '0', '0', '2017-07-25 16:57:26', NULL, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_catalogo`
--

DROP TABLE IF EXISTS `tmp_catalogo`;
CREATE TABLE `tmp_catalogo` (
  `v_IdCT1` int(11) DEFAULT NULL,
  `v_IdIMG1` int(11) DEFAULT NULL,
  `v_Nombre1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `v_Nombre21` varchar(255) DEFAULT NULL,
  `v_IMG1` varchar(150) DEFAULT NULL,
  `v_IMG21` varchar(150) DEFAULT NULL,
  `v_Und1` varchar(10) DEFAULT NULL,
  `v_Puntos1` int(11) DEFAULT NULL,
  `v_Desc1` int(11) DEFAULT NULL,
  `v_IdCT2` int(11) DEFAULT NULL,
  `v_IdIMG2` int(11) DEFAULT NULL,
  `v_Nombre2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `v_Nombre22` varchar(255) DEFAULT NULL,
  `v_IMG2` varchar(150) DEFAULT NULL,
  `v_IMG22` varchar(150) DEFAULT NULL,
  `v_Und2` varchar(10) DEFAULT NULL,
  `v_Puntos2` int(11) DEFAULT NULL,
  `v_Desc2` int(11) DEFAULT NULL,
  `v_IdCT3` int(11) DEFAULT NULL,
  `v_IdIMG3` int(11) DEFAULT NULL,
  `v_Nombre3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `v_Nombre23` varchar(255) DEFAULT NULL,
  `v_IMG3` varchar(150) DEFAULT NULL,
  `v_IMG23` varchar(150) DEFAULT NULL,
  `v_Und3` varchar(10) DEFAULT NULL,
  `v_Puntos3` int(11) DEFAULT NULL,
  `v_Desc3` int(11) DEFAULT NULL,
  `v_IdCT4` int(11) DEFAULT NULL,
  `v_IdIMG4` int(11) DEFAULT NULL,
  `v_Nombre4` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `v_Nombre24` varchar(255) DEFAULT NULL,
  `v_IMG4` varchar(150) DEFAULT NULL,
  `v_IMG24` varchar(150) DEFAULT NULL,
  `v_Und4` varchar(10) DEFAULT NULL,
  `v_Puntos4` int(11) DEFAULT NULL,
  `v_Desc4` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tmp_catalogo`
--

INSERT INTO `tmp_catalogo` (`v_IdCT1`, `v_IdIMG1`, `v_Nombre1`, `v_Nombre21`, `v_IMG1`, `v_IMG21`, `v_Und1`, `v_Puntos1`, `v_Desc1`, `v_IdCT2`, `v_IdIMG2`, `v_Nombre2`, `v_Nombre22`, `v_IMG2`, `v_IMG22`, `v_Und2`, `v_Puntos2`, `v_Desc2`, `v_IdCT3`, `v_IdIMG3`, `v_Nombre3`, `v_Nombre23`, `v_IMG3`, `v_IMG23`, `v_Und3`, `v_Puntos3`, `v_Desc3`, `v_IdCT4`, `v_IdIMG4`, `v_Nombre4`, `v_Nombre24`, `v_IMG4`, `v_IMG24`, `v_Und4`, `v_Puntos4`, `v_Desc4`) VALUES
(22, 3, 'JLJLFDSKJ', 'lskjdflskjd', 'noIMG.jpg', 'noIMG.jpg', 'lksjdflksj', 1, 0, 22, 4, 'DFKJGL/-%KDJFXGL/-%KJ', 'slkñdjfglñkdjf', 'noIMG.jpg', 'noIMG.jpg', 'sdlkfjglsk', 1, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_catalogo_activo`
--
DROP VIEW IF EXISTS `view_catalogo_activo`;
CREATE TABLE `view_catalogo_activo` (
`IdIMG` varchar(150)
,`Nombre` varchar(255)
,`IMG` varchar(150)
,`Puntos` double
,`Descripcion` varchar(150)
,`IdCT` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_frp_articulo`
--
DROP VIEW IF EXISTS `view_frp_articulo`;
CREATE TABLE `view_frp_articulo` (
`IdFRP` int(10)
,`Cantidad` int(10)
,`IdArticulo` int(10)
,`Descripcion` varchar(50)
,`Puntos` decimal(45,4)
,`Total` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_frp_factura`
--
DROP VIEW IF EXISTS `view_frp_factura`;
CREATE TABLE `view_frp_factura` (
`IdFRP` int(10)
,`IdCliente` varchar(10)
,`Faplicado` int(20)
,`Factura` varchar(10)
,`Fecha` varchar(15)
,`Puntos` decimal(41,0)
,`SALDO` decimal(42,0)
,`Anulado` varchar(1)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_catalogo_activo`
--
DROP TABLE IF EXISTS `view_catalogo_activo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_catalogo_activo`  AS  select `detallect`.`IdIMG` AS `IdIMG`,`detallect`.`Nombre` AS `Nombre`,`detallect`.`IMG` AS `IMG`,(`detallect`.`Puntos` - (`detallect`.`Puntos` * (`detallect`.`Descuento` / 100))) AS `Puntos`,`catalogo`.`Descripcion` AS `Descripcion`,`catalogo`.`IdCT` AS `IdCT` from (`catalogo` left join `detallect` on((`detallect`.`IdCT` = `catalogo`.`IdCT`))) where (`catalogo`.`Estado` = 0) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_frp_articulo`
--
DROP TABLE IF EXISTS `view_frp_articulo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_frp_articulo`  AS  select `t0`.`IdFRP` AS `IdFRP`,`t0`.`Cantidad` AS `Cantidad`,`t0`.`IdArticulo` AS `IdArticulo`,`t0`.`Descripcion` AS `Descripcion`,((select sum(`t1`.`Puntos`) AS `sum(``t1``.``Puntos``)` from `detallefrp` `t1` where ((`t1`.`IdFRP` = `t0`.`IdFRP`) and (`t1`.`IdArticulo` = `t0`.`IdArticulo`))) / `t0`.`Cantidad`) AS `Puntos`,(select sum(`t1`.`Puntos`) AS `sum(``t1``.``Puntos``)` from `detallefrp` `t1` where ((`t1`.`IdFRP` = `t0`.`IdFRP`) and (`t1`.`IdArticulo` = `t0`.`IdArticulo`))) AS `Total` from `detallefrp` `t0` group by `t0`.`IdFRP`,`t0`.`IdArticulo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_frp_factura`
--
DROP TABLE IF EXISTS `view_frp_factura`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_frp_factura`  AS  select `t0`.`IdFRP` AS `IdFRP`,(select `t1`.`IdCliente` AS `IdCliente` from `frp` `t1` where (`t1`.`IdFRP` = `t0`.`IdFRP`)) AS `IdCliente`,`t0`.`Faplicado` AS `Faplicado`,`t0`.`Factura` AS `Factura`,`t0`.`Fecha` AS `Fecha`,sum(`t0`.`Puntos`) AS `Puntos`,(`t0`.`Faplicado` - (select sum(`t1`.`Puntos`) AS `sum(``t1``.``Puntos``)` from `detallefrp` `t1` where ((`t1`.`IdFRP` = `t0`.`IdFRP`) and (`t1`.`Factura` = `t0`.`Factura`)))) AS `SALDO`,(select `t1`.`Anulado` AS `Anulado` from `frp` `t1` where (`t1`.`IdFRP` = `t0`.`IdFRP`)) AS `Anulado` from `detallefrp` `t0` group by `t0`.`Factura`,`t0`.`IdFRP`,`t0`.`Faplicado` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`IdCT`);

--
-- Indices de la tabla `catrol`
--
ALTER TABLE `catrol`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `detallect`
--
ALTER TABLE `detallect`
  ADD KEY `FK_DetalleCT_IdCT` (`IdCT`) USING BTREE;

--
-- Indices de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `IdCT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `catrol`
--
ALTER TABLE `catrol`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
