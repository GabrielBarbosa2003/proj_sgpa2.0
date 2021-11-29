-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 29-Nov-2021 às 17:54
-- Versão do servidor: 10.5.12-MariaDB
-- versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id18022680_sgpa`
--
CREATE DATABASE IF NOT EXISTS `id18022680_sgpa` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id18022680_sgpa`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `nome` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dataNasc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome`, `email`, `senha`, `dataNasc`, `cidade`, `estado`) VALUES
(1, 'GUTEMBERG PIMENTA', 'gutem14@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1998-12-25', 'Hortolândia', 'Espírito Santo'),
(2, 'Gabriel Barbosa de Carvalho', 'gabrieldecarvalhu@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2003-04-05', 'Sumaré', 'sp'),
(3, 'Gutemberg Pimenta', 'gutem@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1998-12-25', 'hortolandia', 'SP'),
(4, 'Cláudio César De Oliveira Sousa', 'claudiocesar.os12@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2003-03-18', 'Campinas', 'Solteiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `list_prod`
--

CREATE TABLE `list_prod` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precVend` float NOT NULL,
  `custProd` float NOT NULL,
  `qtdProd` float NOT NULL,
  `qtdVend` float NOT NULL,
  `lucroLiq` float NOT NULL,
  `dataCad` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `list_prod`
--

INSERT INTO `list_prod` (`id`, `id_user`, `nome`, `precVend`, `custProd`, `qtdProd`, `qtdVend`, `lucroLiq`, `dataCad`) VALUES
(10, 2, 'alek', 1, 1, 1, 1, 0, '2021-11-27'),
(4, 1, 'Arroz', 1, 1, 1, 1, 0, '2021-11-27'),
(5, 1, 'Arroz', 1, 1, 1, 1, 0, '2021-11-27'),
(7, 1, 'Arroz', 2, 2, 2, 2, 2, '2021-11-27'),
(11, 2, 'alek2.0', 2, 2, 2, 2, 2, '2021-11-27'),
(9, 1, 'Feijão', 3, 3, 3, 3, 6, '2021-11-27'),
(12, 2, 'alek3.0', 3, 3, 3, 3, 6, '2021-11-27'),
(13, 2, 'alek4.0', 4, 4, 4, 4, 12, '2021-11-27'),
(14, 2, 'alek5.0', 5, 5, 5, 5, 20, '2021-11-27'),
(15, 2, 'alek6.0', 6, 6, 6, 6, 30, '2021-11-27'),
(16, 2, 'alek7.0', 7, 7, 7, 7, 42, '2021-11-27'),
(17, 2, 'alek8.0', 8, 8, 8, 8, 56, '2021-11-27'),
(18, 2, 'alek9.0', 9, 9, 9, 9, 72, '2021-11-27'),
(19, 2, 'alek10', 10, 10, 10, 10, 90, '2021-11-27'),
(20, 2, 'alek11', 11, 11, 11, 11, 110, '2021-11-27'),
(21, 4, 'pao', 1, 10, 20, 20, 10, '2021-11-27'),
(22, 1, 'Arroz', 27.8, 150000, 1700, 1300, -113860, '2021-11-28'),
(23, 4, 'arroz', 9, 10, 20, 15, 125, '2021-11-29'),
(24, 4, 'pao', 50, 5, 50, 50, 2495, '2021-11-29');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `list_prod`
--
ALTER TABLE `list_prod`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `list_prod`
--
ALTER TABLE `list_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
