-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.18-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para corrida
CREATE DATABASE IF NOT EXISTS `corrida` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `corrida`;

-- Copiando estrutura para tabela corrida.corredor
CREATE TABLE IF NOT EXISTS `corredor` (
  `id_corredor` int(11) NOT NULL AUTO_INCREMENT,
  `nome_corredor` text NOT NULL,
  `cpf_corredor` text NOT NULL,
  `data_nascimento_corredor` date NOT NULL,
  `idade_corredor` int(11) NOT NULL,
  PRIMARY KEY (`id_corredor`),
  UNIQUE KEY `cpf_corredor` (`cpf_corredor`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela corrida.evento
CREATE TABLE IF NOT EXISTS `evento` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `id_prova` int(11) NOT NULL,
  `id_corredor` int(11) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `tempo_gasto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela corrida.prova
CREATE TABLE IF NOT EXISTS `prova` (
  `id_prova` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_prova` int(11) NOT NULL,
  `data_prova` date NOT NULL,
  PRIMARY KEY (`id_prova`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
