-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2024 at 02:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `papelaria_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`) VALUES
(1, 'CADERNOS', 'CATEGORIA DE CADERNOS'),
(2, 'MOCHILAS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nivel_acesso`
--

CREATE TABLE `nivel_acesso` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nivel_acesso` int(11) DEFAULT NULL,
  `acesso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`id`, `id_user`, `nivel_acesso`, `acesso`) VALUES
(1, 1, 4, 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `numero_pedido` varchar(11) DEFAULT NULL,
  `status_pedido` varchar(100) DEFAULT NULL,
  `aguardando_reembolso` smallint(6) DEFAULT NULL,
  `hora_pedido` time DEFAULT NULL,
  `data_pedido` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `numero_pedido`, `status_pedido`, `aguardando_reembolso`, `hora_pedido`, `data_pedido`) VALUES
(1, 1, '0000001', 'Finalizado', 1, '13:00:05', '2024-04-22'),
(2, 2, '0000002', 'A entregar', 0, '13:00:05', '2024-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `pedido_produtos`
--

CREATE TABLE `pedido_produtos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedido_produtos`
--

INSERT INTO `pedido_produtos` (`id`, `id_pedido`, `id_produto`, `preco_unitario`) VALUES
(1, 1, 1, 150.00),
(2, 2, 1, 130.00);

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagens` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `preco_anterior` decimal(10,0) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_id` int(11) DEFAULT NULL,
  `tipo_produto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `imagens`, `preco`, `preco_anterior`, `quantidade`, `data_cadastro`, `categoria_id`, `tipo_produto_id`) VALUES
(1, 'Mochila HotWhells muito foda', 'é doida mano', NULL, 150.00, 230, 100, '2024-04-22 14:32:34', 2, 2),
(10, 'Camisa Rio Branco ES edição 2024', 'modelo treino', 'img_66281e081b7df8.28873036_Picsart_24-04-17_03-29-49-060.jpg', 169.00, 120, 1, '2024-04-23 20:46:00', 2, 1),
(13, 'Teste kkkkkkkkk', 'mais um teste de imagem kkkkk', 'img_6628f428290c91.95795771_Screenshot from 2024-02-21 13-34-39.png, img_6628f3fadd6152.95364726_408306345.jpg, img_6628f4196de496.92821975_Screenshot from 2024-04-23 17-09-57.png, img_6628f3fadd6938.25608782_374863409.jpg', 100.00, 100, 1, '2024-04-24 11:58:50', 1, 1),
(14, 'teste produto unico', 'teste 1', 'img_6628f7d15fd163.24237843_asdsafwd.jpg', 122.22, 122, 1, '2024-04-24 12:14:41', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_produto`
--

CREATE TABLE `tipo_produto` (
  `id` int(11) NOT NULL,
  `tipo_produto` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_produto`
--

INSERT INTO `tipo_produto` (`id`, `tipo_produto`, `descricao`) VALUES
(1, 'Material para escritório', 'Material para escritório'),
(2, 'Material Escolar', NULL),
(3, 'Mochilas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cpfcnpj` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `recover_key` varchar(255) DEFAULT NULL,
  `acessou_em` datetime DEFAULT NULL,
  `ultima_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nome`, `cpfcnpj`, `email`, `telefone`, `senha`, `recover_key`, `acessou_em`, `ultima_atualizacao`) VALUES
(1, 'Kerlon Fernandes', '111.111.111-11', 'kerlon1221@gmail.com', '(27) 9 999-9999', '$2y$10$p3Wmv3nUOIOCw75/P69J1erdzK8aTy.F.QUiixh/BK4VSb80wB462', NULL, '2024-04-19 21:27:23', '2024-04-20 01:14:35'),
(2, 'Cezar', '111.111.111-11', 'xtxwk414@gmail.com', '(27) 9 999-9999', '$2y$10$LzZV6G.AbADSX5PECfSmbu7/DcbOGeiippbTQFl/dhnOLWZE802sS', NULL, '2024-04-19 21:27:23', '2024-04-22 19:18:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido` (`id_pedido`),
  ADD KEY `fk_produto` (`id_produto`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `fk_tipo_produto` (`tipo_produto_id`);

--
-- Indexes for table `tipo_produto`
--
ALTER TABLE `tipo_produto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tipo_produto`
--
ALTER TABLE `tipo_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD CONSTRAINT `nivel_acesso_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Constraints for table `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  ADD CONSTRAINT `fk_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_tipo_produto` FOREIGN KEY (`tipo_produto_id`) REFERENCES `tipo_produto` (`id`),
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
