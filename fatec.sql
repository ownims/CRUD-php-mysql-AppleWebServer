SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `professores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `disciplina` varchar(25) NOT NULL,
  `horario` varchar(10) NOT NULL,
  `curso` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `professores` (`id`, `nome`, `disciplina`, `horario`, `curso`) VALUES
(1, 'Roberto Cassio', 'Matematica', 'Manha', 'Jogos Eletronicos'),
(2, 'Cleiton Martinez Gonzales', 'Lingua Estrangeira', 'Manha', 'Jogos Eletronicos II'),
(3, 'Roberval O Connor', 'Socializacao', 'Tarde', 'Sociologia IV');
