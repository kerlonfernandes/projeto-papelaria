-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2024 at 10:52 PM
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
-- Table structure for table `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `adicionado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `item_selecionado` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = sim, 0 = não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrinho`
--

INSERT INTO `carrinho` (`id`, `user_id`, `produto_id`, `quantidade`, `adicionado_em`, `item_selecionado`) VALUES
(697, 1, 1, 1, '2024-05-10 02:32:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `slug_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`, `slug_categoria`) VALUES
(1, 'CADERNOS', 'CATEGORIA DE CADERNOS', 'cadernos'),
(2, 'MOCHILAS', NULL, ''),
(15, 'CANETAS', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `codigo_ibge` varchar(4) NOT NULL,
  `sigla` char(2) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`codigo_ibge`, `sigla`, `nome`) VALUES
('12', 'AC', 'Acre'),
('27', 'AL', 'Alagoas'),
('13', 'AM', 'Amazonas'),
('16', 'AP', 'Amapá'),
('29', 'BA', 'Bahia'),
('23', 'CE', 'Ceará'),
('53', 'DF', 'Distrito Federal'),
('32', 'ES', 'Espírito Santo'),
('52', 'GO', 'Goiás'),
('21', 'MA', 'Maranhão'),
('31', 'MG', 'Minas Gerais'),
('50', 'MS', 'Mato Grosso do Sul'),
('51', 'MT', 'Mato Grosso'),
('15', 'PA', 'Pará'),
('25', 'PB', 'Paraíba'),
('26', 'PE', 'Pernambuco'),
('22', 'PI', 'Piauí'),
('41', 'PR', 'Paraná'),
('33', 'RJ', 'Rio de Janeiro'),
('24', 'RN', 'Rio Grande do Norte'),
('11', 'RO', 'Rondônia'),
('14', 'RR', 'Roraima'),
('43', 'RS', 'Rio Grande do Sul'),
('42', 'SC', 'Santa Catarina'),
('28', 'SE', 'Sergipe');

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
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `data_pedido` date DEFAULT NULL,
  `hora_pedido` time NOT NULL,
  `total_pedido` decimal(10,2) DEFAULT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `cep` varchar(30) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `numero_residencia` int(11) DEFAULT NULL,
  `complemento` text DEFAULT NULL,
  `bairro` text DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `metodo_pagamento` varchar(50) DEFAULT NULL,
  `taxa_envio` decimal(10,2) DEFAULT NULL,
  `codigo_rastreamento` varchar(100) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `cupom_desconto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`id`, `id_cliente`, `data_pedido`, `hora_pedido`, `total_pedido`, `nome_completo`, `telefone`, `cep`, `endereco`, `numero_residencia`, `complemento`, `bairro`, `cidade`, `estado`, `metodo_pagamento`, `taxa_envio`, `codigo_rastreamento`, `observacoes`, `cupom_desconto`) VALUES
(1, 1, '2024-05-05', '22:51:22', 451.23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, '2024-05-05', '23:57:56', 452.34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, '2024-05-06', '07:58:39', 30.42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, '2024-05-06', '08:12:59', 100228.16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, '2024-05-06', '08:18:58', 450.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, '2024-05-06', '08:31:51', 300.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, '2024-05-07', '08:19:12', 300.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, '2024-05-09', '20:18:16', 3439.15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, '2024-05-09', '20:59:00', 3439.15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, '2024-05-09', '23:27:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, '2024-05-09', '23:28:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, '2024-05-09', '23:32:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `slug` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_id` int(11) DEFAULT NULL,
  `tipo_produto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `imagens`, `preco`, `preco_anterior`, `quantidade`, `slug`, `data_cadastro`, `categoria_id`, `tipo_produto_id`) VALUES
(1, 'Mochila HotWhells ', 'é doida mano', 'img_662dc68dcaf6a8.77394343_mochila_escolar_rodinha_lancheira_estojo_hot_wheels_luxcel_2605_1_9bfe5c0bfa3e0f435a238f8ace5928cb.webp', 150.00, 230, 100, '', '2024-04-22 14:32:34', 2, 2),
(74, 'asdsadsasddasd', 'sadasdsa', '', 1.23, 231, 1, 'asdsadsasddasd', '2024-04-28 03:59:02', 2, 2),
(75, 'wfdwdeewdwe', 'rererewrew', '', 3132.13, 21332, 1, 'wfdwdeewdwe', '2024-04-28 03:59:13', 1, 2),
(76, 'não pão ão mão lingîça mínha', 'rewtgdff', '', 2.34, 43, 1, 'nao-pao-ao-mao-lingica-minha', '2024-04-28 03:59:37', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_produto`
--

CREATE TABLE `tipo_produto` (
  `id` int(11) NOT NULL,
  `tipo_produto` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `slug_tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_produto`
--

INSERT INTO `tipo_produto` (`id`, `tipo_produto`, `descricao`, `slug_tipo`) VALUES
(1, 'Material para escritório', 'Material para escritório', 'material-para-escritorio'),
(2, 'Material Escolar', NULL, 'material-escolar'),
(3, 'Mochilas', '', 'mochilas');

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
-- Indexes for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produto_id` (`produto_id`);

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
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

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
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=698;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tipo_produto`
--
ALTER TABLE `tipo_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD CONSTRAINT `nivel_acesso_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `users` (`id`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

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
