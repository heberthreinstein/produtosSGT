-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2021 at 06:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `produtossgt`
--

CREATE DATABASE IF NOT EXISTS produtossgt;

-- --------------------------------------------------------

--
-- Table structure for table `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `entrada` tinyint(1) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `quantidadeAnterior` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `nf` varchar(100) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `movimentacao`
--
DELIMITER $$
CREATE TRIGGER `deleteMovimentacao` AFTER UPDATE ON `movimentacao` FOR EACH ROW IF (NEW.deleted_at IS NOT NULL) THEN
        IF (NEW.entrada IS TRUE ) THEN
                    UPDATE produto SET quantidade = quantidade - NEW.Quantidade
                    WHERE id = NEW.produto;

          ELSE
                    UPDATE produto SET quantidade = quantidade + NEW.Quantidade
                    WHERE id = NEW.produto;

          END IF;
      END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateProduto` AFTER INSERT ON `movimentacao` FOR EACH ROW BEGIN
	
    IF (NEW.entrada IS TRUE ) THEN
            	UPDATE produto SET quantidade = quantidade + NEW.Quantidade
                WHERE id = NEW.produto;

      ELSE
            	UPDATE produto SET quantidade = quantidade - NEW.Quantidade
                WHERE id = NEW.produto;

      END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_movimentacao` (`produto`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `produto_movimentacao` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
