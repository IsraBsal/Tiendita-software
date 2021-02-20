-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2021 at 11:10 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `idadmin` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`idadmin`, `usuario`, `password`) VALUES
(1, 'isra', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `calificaciones`
--

CREATE TABLE `calificaciones` (
  `Calificacion` int(11) NOT NULL,
  `Descripcion_Calif` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calificaciones`
--

INSERT INTO `calificaciones` (`Calificacion`, `Descripcion_Calif`) VALUES
(1, 'Pesimo'),
(2, 'Mala'),
(3, 'Regular'),
(4, 'Buena'),
(5, 'Excelente');

-- --------------------------------------------------------

--
-- Table structure for table `carro`
--

CREATE TABLE `carro` (
  `IdCarro` int(11) NOT NULL,
  `cant` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `IdCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(45) NOT NULL,
  `Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`IdCategoria`, `NombreCategoria`, `Descripcion`) VALUES
(1, 'Palomitas', 'Palomitas de maiz'),
(2, 'Refrescos', 'Bebida de cola'),
(3, 'Nachos', 'Nachos'),
(4, 'Combos', 'Combinacion de productos');

-- --------------------------------------------------------

--
-- Table structure for table `compañias_de_envios`
--

CREATE TABLE `compañias_de_envios` (
  `IdCompañiaEnvios` int(11) NOT NULL,
  `NombreCompañia` varchar(45) NOT NULL,
  `Telefono` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `compañias_de_envios`
--

INSERT INTO `compañias_de_envios` (`IdCompañiaEnvios`, `NombreCompañia`, `Telefono`) VALUES
(0, 'Personal', NULL),
(1, 'DHL', '55-123-234-456'),
(2, 'Fedex', '55-888-452-632'),
(3, 'Correos De Mexico', '55-965-456-631');

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` float(6,2) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detalles_pedidos`
--

CREATE TABLE `detalles_pedidos` (
  `IdPedido` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Total` float(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `comprobante` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `IdPedido` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `FechaPedido` date NOT NULL,
  `FechaEntrega` date DEFAULT NULL,
  `FechaEnvio` date DEFAULT NULL,
  `IdCompañiaEnvios` int(11) NOT NULL,
  `Cargo_Envio` float(3,2) NOT NULL,
  `Destinatario` varchar(45) NOT NULL,
  `DireccionDestinatario` varchar(45) NOT NULL,
  `CiudadDestinatario` varchar(45) NOT NULL,
  `RegionDestinatario` varchar(45) NOT NULL,
  `CodPostalDestinatario` varchar(45) NOT NULL,
  `PaisDestinatario` varchar(45) NOT NULL,
  `Status_envio` enum('Pedido','Enviado','Entregado') NOT NULL,
  `Calificacion` int(11) DEFAULT NULL,
  `Total_Pago` float(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `IdProducto` int(11) NOT NULL,
  `NombreProducto` varchar(45) NOT NULL,
  `Marca` varchar(45) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `CantidadUnidades` int(11) NOT NULL,
  `Precio_Caja` float(6,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `UnidadesEnPedido` int(11) NOT NULL,
  `Suspendido` enum('Si','No') NOT NULL,
  `Imagen` varchar(45) NOT NULL,
  `oferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`IdProducto`, `NombreProducto`, `Marca`, `IdCategoria`, `CantidadUnidades`, `Precio_Caja`, `Stock`, `UnidadesEnPedido`, `Suspendido`, `Imagen`, `oferta`) VALUES
(100, 'Nachos con queso grandes', 'Cine', 3, 30, 80.00, 30, 0, 'No', '100.png', 0),
(101, 'Coca Col Grande', 'Cola', 2, 20, 30.00, 20, 0, 'No', '101.png', 20),
(102, 'Palomitas chicas', 'Cine', 1, 20, 30.00, 10, 0, 'No', '102.png', 0),
(103, 'Nachos con queso medianos', 'Cine', 3, 12, 40.00, 12, 0, 'No', '103.png', 0),
(104, 'Coca Col Mediana', 'Cola', 2, 20, 15.00, 100, 0, 'No', '104.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `productos_compra`
--

CREATE TABLE `productos_compra` (
  `id` int(11) NOT NULL,
  `IdCompra` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `monto` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `IdCliente` int(11) NOT NULL,
  `Correo_Electronico` varchar(45) NOT NULL,
  `Password` varchar(6) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellidos` varchar(45) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Codpostal` varchar(45) NOT NULL,
  `Telefono` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`IdCliente`, `Correo_Electronico`, `Password`, `Nombre`, `Apellidos`, `Direccion`, `Ciudad`, `Estado`, `Codpostal`, `Telefono`) VALUES
(1, 'is@hotmail.com', '123456', 'Israel', 'Contreras', 'San rafael Atlixco', 'Iztapalapa', 'CDMX', '15270', '5565734602'),
(2, '123', '123', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', '5543', '3745');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`Calificacion`);

--
-- Indexes for table `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`IdCarro`),
  ADD KEY `fk_carro_Usuarios1_idx` (`IdCliente`),
  ADD KEY `fk_carro_Productos1_idx` (`IdProducto`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IdCategoria`),
  ADD UNIQUE KEY `idCategoria_UNIQUE` (`IdCategoria`);

--
-- Indexes for table `compañias_de_envios`
--
ALTER TABLE `compañias_de_envios`
  ADD PRIMARY KEY (`IdCompañiaEnvios`),
  ADD UNIQUE KEY `IdCompañiaEnvios_UNIQUE` (`IdCompañiaEnvios`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_compra_Usuarios1_idx` (`IdCliente`);

--
-- Indexes for table `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD PRIMARY KEY (`IdPedido`,`IdProducto`),
  ADD KEY `fk_Pedidos_has_Productos_Productos1_idx` (`IdProducto`),
  ADD KEY `fk_Pedidos_has_Productos_Pedidos1_idx` (`IdPedido`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pagos_Usuarios1_idx` (`IdCliente`),
  ADD KEY `fk_pagos_compra1_idx` (`id_compra`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`IdPedido`),
  ADD UNIQUE KEY `IdPedido_UNIQUE` (`IdPedido`),
  ADD KEY `fk_Pedidos_Clientes1_idx` (`IdCliente`),
  ADD KEY `fk_Pedidos_Compañias_de_envios1_idx` (`IdCompañiaEnvios`),
  ADD KEY `fk_Pedidos_Calificaciones1_idx` (`Calificacion`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IdProducto`),
  ADD UNIQUE KEY `idProducto_UNIQUE` (`IdProducto`),
  ADD KEY `fk_Productos_Categorias1_idx` (`IdCategoria`);

--
-- Indexes for table `productos_compra`
--
ALTER TABLE `productos_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_compra_compra1_idx` (`IdCompra`),
  ADD KEY `fk_productos_compra_Productos1_idx` (`IdProducto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdCliente`),
  ADD UNIQUE KEY `IdCliente_UNIQUE` (`IdCliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carro`
--
ALTER TABLE `carro`
  MODIFY `IdCarro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `productos_compra`
--
ALTER TABLE `productos_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `fk_carro_Productos1` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carro_Usuarios1` FOREIGN KEY (`IdCliente`) REFERENCES `usuarios` (`IdCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_Usuarios1` FOREIGN KEY (`IdCliente`) REFERENCES `usuarios` (`IdCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD CONSTRAINT `fk_Pedidos_has_Productos_Pedidos1` FOREIGN KEY (`IdPedido`) REFERENCES `pedidos` (`IdPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedidos_has_Productos_Productos1` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_Usuarios1` FOREIGN KEY (`IdCliente`) REFERENCES `usuarios` (`IdCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pagos_compra1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_Pedidos_Calificaciones1` FOREIGN KEY (`Calificacion`) REFERENCES `calificaciones` (`Calificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedidos_Compañias_de_envios1` FOREIGN KEY (`IdCompañiaEnvios`) REFERENCES `compañias_de_envios` (`IdCompañiaEnvios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_Productos_Categorias1` FOREIGN KEY (`IdCategoria`) REFERENCES `categorias` (`IdCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productos_compra`
--
ALTER TABLE `productos_compra`
  ADD CONSTRAINT `fk_productos_compra_Productos1` FOREIGN KEY (`IdProducto`) REFERENCES `productos` (`IdProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_compra_compra1` FOREIGN KEY (`IdCompra`) REFERENCES `compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
