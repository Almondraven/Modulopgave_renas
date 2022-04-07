SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `Klager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `virksomhed` varchar(100) NOT NULL,
  `emne` varchar(100) NOT NULL,
  `klageinfo` varchar(255) NOT NULL,
  `dato` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `Klager` (`id`, `virksomhed`, `emne`, `klageinfo`, `dato`) VALUES
(1, 'House of Code', 'Manglende rengøring','Der mangler at blive vasket gulv', '04/04/2022'),
(2, 'House of Code', 'Stjålet ur','Sørens ur er blevet stjålet i onsdags', '03/04/2022'),
(3, 'UCL', 'Manglende rengøring','Der skal tørres borde af', '24/03/2022');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;