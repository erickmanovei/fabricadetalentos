-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Jan-2015 às 21:04
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


--
-- Estrutura da tabela `bloqueios`
--

CREATE TABLE IF NOT EXISTS `bloqueios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `bloqueios`
--

INSERT INTO `bloqueios` (`id`, `usuario`, `data`) VALUES
(2, 'erick', '2014-11-27 17:09:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE IF NOT EXISTS `configuracoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(255) COLLATE utf8_bin NOT NULL,
  `remetente` varchar(300) COLLATE utf8_bin NOT NULL,
  `email` varchar(300) COLLATE utf8_bin NOT NULL,
  `senha` varchar(50) COLLATE utf8_bin NOT NULL,
  `smtp` varchar(300) COLLATE utf8_bin NOT NULL,
  `porta` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `nome`, `descricao`, `remetente`, `email`, `senha`, `smtp`, `porta`) VALUES
(1, 'email', 'Configurações de E-mail', 'Fabrica de Talentos', 'contato@webcon.com.br', '123456', 'smtp.webcon.com.br', 587);

-- --------------------------------------------------------


--
-- Estrutura da tabela `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipousuario`
--

INSERT INTO `tipousuario` (`id`, `nome`) VALUES
(1, 'Cliente'),
(2, 'Editor'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtipousuario` int(11) NOT NULL,
  `usuario` varchar(45) COLLATE utf8_bin NOT NULL,
  `senha` varchar(100) COLLATE utf8_bin NOT NULL,
  `nome` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `ativo` varchar(3) COLLATE utf8_bin NOT NULL,
  `novasenha` varchar(3) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=51 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `idtipousuario`, `usuario`, `senha`, `nome`, `email`, `ativo`, `novasenha`) VALUES
(1, 3, 'erick', '123', 'Érick Nilson Souza Sodré Filho', 'informatica@crc-ba.org.br', 'sim', 'nao'),
(2, 1, 'iedo', '123', 'Iedo Anderson Moraes de Souza', 'iedo@crc-ba.org.br',  'sim', ''),
(3, 1, 'leandro', '123', 'Leandro Nunes Santos', 'comunicacao@crc-ba.org.br', 'sim', ''),
(4, 1, 'marilene', '123', 'Marilene Gonzaga Matos', 'diretoria@crc-ba.org.br', 'sim', ''),
(5, 1, 'maiane', '123', 'Maiane Silva de Jesus', 'imprensa@crc-ba.org.br', 'sim', ''),
(6, 1, 'tiago', '123', 'Tiago de Oliveira', 'tiago@crc-ba.org.br', 'sim', ''),
(14, 1, 'rosario', '123', 'Maria do Rosário Pinheiro', 'rosario@crc-ba.org.br', 'sim', ''),
(16, 2, 'rosa', '123', 'Rosa Maria', 'pessoal@crc-ba.org.br', 'sim', ''),
(50, 1, 'kleiton', '123', 'Kleiton Silva', 'erickmanovei@hotmail.com', 'sim', 'nao');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
