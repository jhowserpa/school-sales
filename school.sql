-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19-Ago-2019 às 13:22
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbaluno`
--

CREATE TABLE `tbaluno` (
  `id` int(11) NOT NULL,
  `sNome` varchar(200) DEFAULT NULL,
  `sTelefone` varchar(20) DEFAULT NULL,
  `sTurma` varchar(20) DEFAULT NULL,
  `sSexo` varchar(2) DEFAULT NULL,
  `sEndereco` varchar(20) DEFAULT NULL,
  `sBairro` varchar(20) DEFAULT NULL,
  `iNumero` int(11) DEFAULT NULL,
  `sObservacao` text,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fDeletado` int(11) DEFAULT NULL,
  `sEscola` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbaluno`
--

INSERT INTO `tbaluno` (`id`, `sNome`, `sTelefone`, `sTurma`, `sSexo`, `sEndereco`, `sBairro`, `iNumero`, `sObservacao`, `dataCadastro`, `fDeletado`, `sEscola`) VALUES
(1, 'JOAO ALVES', '(35)9.9875-8956', '1 ANO', 'M', 'RUA SAO JOSE', 'CENTRO', 77, 'TESTE DE CADASTRO', '2019-08-15 16:14:07', NULL, NULL),
(2, 'jhow', '(35) 9743-3853', '2 ANO', 'M', 'rua vitor', 'tanque', 66, 'teste', '2019-08-15 20:09:24', NULL, 'faat'),
(3, 'jackson', '(48) 5454-5454', 'test', 'M', 'teste', 'teste', 44, 'teste', '2019-08-15 20:19:31', NULL, 'teste'),
(4, 'analice', '(35) 4545-4564', 'teste', 'F', 'tests', 'tests', 45, 'etestsetestetset', '2019-08-15 20:21:32', NULL, 'testes'),
(5, 'roberta', '(11) 1321-3212', 'teste', 'F', 'teste', 'tests', 4, 'teste', '2019-08-15 20:29:05', NULL, 'teste'),
(6, 'valquiria teste', '(45) 7897-8978', 'testse', 'F', 'testes', 't', 6, 'testet', '2019-08-15 20:32:03', NULL, 'teste'),
(7, 'simone', '(35) 4879-8789', 'teste', 'F', 'teste', 'teste', 7, 'teste', '2019-08-15 20:33:21', 1, 'teste'),
(8, 'vanessa', '(54) 6545-4645', '', 'F', 'rua das oliveira', 'centro', 0, '', '2019-08-16 11:12:46', NULL, 'test');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `id` int(11) NOT NULL,
  `sDescricao` varchar(200) DEFAULT NULL,
  `iQuantidade` float DEFAULT NULL,
  `fpreco` float DEFAULT NULL,
  `sObservacao` text,
  `fDeletado` int(11) DEFAULT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sUnidade` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`id`, `sDescricao`, `iQuantidade`, `fpreco`, `sObservacao`, `fDeletado`, `dataCadastro`, `sUnidade`) VALUES
(1, 'NOTEBOOK', 2, 1596.56, 'Produto novo - i7', NULL, '2019-08-15 16:14:58', 'PEÃ‡A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvenda`
--

CREATE TABLE `tbvenda` (
  `id` int(11) NOT NULL,
  `idAluno` int(11) DEFAULT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `iquantidade` int(11) DEFAULT NULL,
  `fSubtotal` float DEFAULT NULL,
  `fPreco` varchar(30) DEFAULT NULL,
  `fTotal` float DEFAULT NULL,
  `sObservacao` varchar(200) DEFAULT NULL,
  `dataVenda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fDeletado` int(11) DEFAULT NULL,
  `istatus` varchar(50) DEFAULT NULL,
  `sCondicao` varchar(30) DEFAULT NULL,
  `sUnidade` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbvenda`
--

INSERT INTO `tbvenda` (`id`, `idAluno`, `idProduto`, `iquantidade`, `fSubtotal`, `fPreco`, `fTotal`, `sObservacao`, `dataVenda`, `fDeletado`, `istatus`, `sCondicao`, `sUnidade`) VALUES
(1, 1, 1, 2, 15.75, '15.75', 30.5, 'teste', '2019-08-19 12:06:40', NULL, 'Aguardando', 'A VISTA', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbaluno`
--
ALTER TABLE `tbaluno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbvenda`
--
ALTER TABLE `tbvenda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbaluno`
--
ALTER TABLE `tbaluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbvenda`
--
ALTER TABLE `tbvenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
