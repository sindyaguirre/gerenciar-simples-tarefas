-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Nov-2018 às 13:49
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdtarefas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `idFuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`idFuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `nome`, `email`, `senha`, `data_cadastro`) VALUES
(1, 'maria de lourdes', 'maria@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2018-11-13 13:15:01'),
(2, 'maria', 'maria@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2018-11-13 13:15:37'),
(3, 'teste', 'teste@teste.com', '8cb2237d0679ca88db6464eac60da96345513964', '2018-11-13 13:16:43'),
(4, 'TESTE2', 'teste2@teste.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2018-11-13 15:53:37'),
(5, 'Jorge Benjor', 'jorge@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2018-11-13 16:32:06'),
(6, 'Eduarda Maria', 'eduma@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2018-11-13 18:40:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

DROP TABLE IF EXISTS `projeto`;
CREATE TABLE IF NOT EXISTS `projeto` (
  `idProjeto` int(11) NOT NULL AUTO_INCREMENT,
  `projeto` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`idProjeto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`idProjeto`, `projeto`, `descricao`, `data_cadastro`) VALUES
(4, 'blabla produto', 'tse descri teste', '2018-11-13 17:33:31'),
(5, 'wer', 'sim', '2018-11-13 17:36:18'),
(6, 'Uecoin', NULL, '2018-11-15 15:02:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefa`
--

DROP TABLE IF EXISTS `tarefa`;
CREATE TABLE IF NOT EXISTS `tarefa` (
  `idTarefa` int(3) NOT NULL AUTO_INCREMENT,
  `idProjeto` int(3) NOT NULL,
  `idFuncionario` int(3) DEFAULT NULL,
  `tarefa` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `idTempoEstimado` int(3) DEFAULT NULL,
  `idNivel` int(3) DEFAULT NULL,
  `dataCadastro` datetime DEFAULT NULL,
  `dataAlteracao` datetime DEFAULT NULL,
  `idStatus` int(3) DEFAULT NULL,
  PRIMARY KEY (`idTarefa`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tarefa`
--

INSERT INTO `tarefa` (`idTarefa`, `idProjeto`, `idFuncionario`, `tarefa`, `descricao`, `idTempoEstimado`, `idNivel`, `dataCadastro`, `dataAlteracao`, `idStatus`) VALUES
(4, 4, 6, 'Formulário Tarefa editado', 'Criar função para carregar os dados para UPDATE. ', 1, 1, '2018-11-15 01:09:04', '2018-11-16 12:22:36', 2),
(7, 6, 6, 'Escrever código fonte', 'asdaafdadf', 1, 1, '2018-11-16 10:01:12', NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `email`, `senha`, `data_cadastro`) VALUES
(1, 'asd', 'asdsadsadas@sdf.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2018-11-13 12:50:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
