-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/04/2024 às 02:44
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `papelaria_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `slug_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`, `slug_categoria`) VALUES
(1, 'CADERNOS', 'CATEGORIA DE CADERNOS', 'cadernos'),
(2, 'MOCHILAS', NULL, ''),
(15, 'CANETAS', NULL, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel_acesso`
--

CREATE TABLE `nivel_acesso` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nivel_acesso` int(11) DEFAULT NULL,
  `acesso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`id`, `id_user`, `nivel_acesso`, `acesso`) VALUES
(1, 1, 4, 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
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
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `numero_pedido`, `status_pedido`, `aguardando_reembolso`, `hora_pedido`, `data_pedido`) VALUES
(1, 1, '0000001', 'Finalizado', 1, '13:00:05', '2024-04-22'),
(2, 2, '0000002', 'A entregar', 0, '13:00:05', '2024-04-22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_produtos`
--

CREATE TABLE `pedido_produtos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido_produtos`
--

INSERT INTO `pedido_produtos` (`id`, `id_pedido`, `id_produto`, `preco_unitario`) VALUES
(1, 1, 1, 150.00),
(2, 2, 1, 130.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
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
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `imagens`, `preco`, `preco_anterior`, `quantidade`, `slug`, `data_cadastro`, `categoria_id`, `tipo_produto_id`) VALUES
(1, 'Mochila HotWhells muito foda', 'é doida mano', NULL, 150.00, 230, 100, '', '2024-04-22 14:32:34', 2, 2),
(59, 'saddas', 'dasdsaads', 'img_662bb7305e39b0.30106597_176072z_2.webp', 1.23, 2, 1, '', '2024-04-26 14:16:16', 15, 2),
(60, 'imprescindível dicionário aurélio resiliência cônjuge recíproco intrínseco caráter efêmero cínico diligência anuência intempérie idôneo condolências escrúpulo contemporâneo supérfluo idílico âmbito propósito análogo genuíno essência parcimônia hipócrita v', 'qeqwe', 'img_662bb7e04033b1.39762308_176072z_2.webp', 22.23, 21, 1, 'imprescindivel-dicionario-aurelio-resiliencia-conjuge-reciproco-intrinseco-carater-efemero-cinico-diligencia-anuencia-intemperie-idoneo-condolencias-escrupulo-contemporaneo-superfluo-idilico-ambito-proposito-analogo-genuino-essencia-parcimonia-hipocrita-v', '2024-04-26 14:19:12', 15, 2),
(61, 'Cadernos escolar Básico', 'ótimo para o dia-a-dia leve e pequeno ótimo para estudos ', 'img_662bc813212de5.17743527_WhatsApp Image 2024-04-25 at 13.40.09 (1).jpeg', 15.00, 0, 1, '', '2024-04-26 15:28:19', 1, 2),
(68, 'Mochila muito loka', 'mochila categoria', 'img_662bd518b1d527.57005773_mochila_escolar_rodinha_lancheira_estojo_hot_wheels_luxcel_2605_1_9bfe5c0bfa3e0f435a238f8ace5928cb.webp', 150.00, 220, 1, '', '2024-04-26 16:23:52', 2, 3),
(69, 'Porta lapis', 'Porta lapis', 'img_662bd62929d074.59308738_61+y8UkBQpL._AC_SX679_.jpg', 9.99, 10, 1, '', '2024-04-26 16:28:25', 15, 1),
(70, 'não pão ão mão lingîça mínhaasdcvsadfvsadqsdbsfqedwffdfsf', 'adsasd', 'img_662c33fe5a8855.65851801_azul-caneta.webp', 10.00, 10, 1, 'nao-pao-ao-mao-lingica-minhaasdcvsadfvsadqsdbsfqedwffdfsf', '2024-04-26 16:35:41', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_produto`
--

CREATE TABLE `tipo_produto` (
  `id` int(11) NOT NULL,
  `tipo_produto` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `slug_tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo_produto`
--

INSERT INTO `tipo_produto` (`id`, `tipo_produto`, `descricao`, `slug_tipo`) VALUES
(1, 'Material para escritório', 'Material para escritório', 'material-para-escritorio'),
(2, 'Material Escolar', NULL, 'material-escolar'),
(3, 'Mochilas', '', 'mochilas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
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
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `cpfcnpj`, `email`, `telefone`, `senha`, `recover_key`, `acessou_em`, `ultima_atualizacao`) VALUES
(1, 'Kerlon Fernandes', '111.111.111-11', 'kerlon1221@gmail.com', '(27) 9 999-9999', '$2y$10$p3Wmv3nUOIOCw75/P69J1erdzK8aTy.F.QUiixh/BK4VSb80wB462', NULL, '2024-04-19 21:27:23', '2024-04-20 01:14:35'),
(2, 'Cezar', '111.111.111-11', 'xtxwk414@gmail.com', '(27) 9 999-9999', '$2y$10$LzZV6G.AbADSX5PECfSmbu7/DcbOGeiippbTQFl/dhnOLWZE802sS', NULL, '2024-04-19 21:27:23', '2024-04-22 19:18:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido` (`id_pedido`),
  ADD KEY `fk_produto` (`id_produto`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `fk_tipo_produto` (`tipo_produto_id`);

--
-- Índices de tabela `tipo_produto`
--
ALTER TABLE `tipo_produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `tipo_produto`
--
ALTER TABLE `tipo_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD CONSTRAINT `nivel_acesso_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `pedido_produtos`
--
ALTER TABLE `pedido_produtos`
  ADD CONSTRAINT `fk_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_tipo_produto` FOREIGN KEY (`tipo_produto_id`) REFERENCES `tipo_produto` (`id`),
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
