-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 31-Mar-2022 às 18:37
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `desafio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cargos`
--

CREATE TABLE `tb_cargos` (
  `id` int(11) NOT NULL,
  `nome_cargo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_cargos`
--

INSERT INTO `tb_cargos` (`id`, `nome_cargo`) VALUES
(1, 'Administrador'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_colaboradores`
--

CREATE TABLE `tb_colaboradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(150) DEFAULT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT 1,
  `id_funcao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_colaboradores`
--

INSERT INTO `tb_colaboradores` (`id`, `nome`, `usuario`, `senha`, `id_cargo`, `id_status`, `id_funcao`) VALUES
(14, 'Gercino A. S.', 'gercino', '1234', 2, 1, 2),
(15, 'João LTDA', 'joao', 'joao', 2, 2, 2),
(16, 'Master', 'adm', 'adm@123', 1, 1, 1),
(17, 'Gercino Neto', 'adm2', 'adm', 1, 1, 1),
(18, 'asdas', 'AKls', 'asswe', 2, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_funcao`
--

CREATE TABLE `tb_funcao` (
  `id` int(11) NOT NULL,
  `nome_funcao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_funcao`
--

INSERT INTO `tb_funcao` (`id`, `nome_funcao`) VALUES
(1, 'Usuário'),
(2, 'Fornecedor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL,
  `nome_produto` varchar(100) DEFAULT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id`, `nome_produto`, `id_fornecedor`, `id_status`) VALUES
(1, 'Cama', 14, 1),
(2, 'Cama elástica', 14, 1),
(3, 'Cama elástic', 15, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `nome_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_status`
--

INSERT INTO `tb_status` (`id`, `nome_status`) VALUES
(1, 'Ativo'),
(2, 'Inativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_cargos`
--
ALTER TABLE `tb_cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_colaboradores`
--
ALTER TABLE `tb_colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_colaboradores_ibfk_1` (`id_cargo`),
  ADD KEY `tb_colaboradores_ibfk_2` (`id_status`),
  ADD KEY `tb_colaboradores_ibfk_3` (`id_funcao`);

--
-- Índices para tabela `tb_funcao`
--
ALTER TABLE `tb_funcao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_status` (`id_status`);

--
-- Índices para tabela `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_cargos`
--
ALTER TABLE `tb_cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_colaboradores`
--
ALTER TABLE `tb_colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tb_funcao`
--
ALTER TABLE `tb_funcao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_colaboradores`
--
ALTER TABLE `tb_colaboradores`
  ADD CONSTRAINT `tb_colaboradores_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `tb_cargos` (`id`),
  ADD CONSTRAINT `tb_colaboradores_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id`),
  ADD CONSTRAINT `tb_colaboradores_ibfk_3` FOREIGN KEY (`id_funcao`) REFERENCES `tb_funcao` (`id`);

--
-- Limitadores para a tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD CONSTRAINT `tb_produtos_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `tb_colaboradores` (`id`),
  ADD CONSTRAINT `tb_produtos_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
