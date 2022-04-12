SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `Login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `virksomhed` varchar(100) NOT NULL,
  `brugernavn` varchar(100) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `ansvarlig` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `Login` (`id`, `virksomhed`, `brugernavn`, `kode`, `ansvarlig`) VALUES
(1, 'House of code', 'Henrik2022','huskode', 'Søren Hansen'),
(2, 'UCL', 'BOSTÆ','Christinaersej', 'Søren Hansen'),
(3, 'Dataforståelse', 'Kimmo','GoØkit', 'Kim Mogensen');
    

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
